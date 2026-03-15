<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barcode;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        $products = Product::with('category', 'brand', 'supplier', 'images', 'barcodes')->where('created_by', auth()->id())->get();
        // $products = collect();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::where('created_by', auth()->id())->get();
        $brands = ProductBrand::where('created_by', auth()->id())->get();
        $suppliers = Supplier::where('created_by', auth()->id())->get();
        return view('admin.products.create', compact('categories', 'brands', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());


        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_short_description' => 'required',
            'description' => 'required',
            'measureType' => 'required',
            'amount' => 'required',
            'supply_price' => 'required',
            'productCode1' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = $data['updated_by'] = auth()->id();
        $product = Product::create($data);
        if ($request->has('img')) {
            $this->handleImageUpload($request, $product->id);
        }

        if ($product) {
            $productId = $product->id; // or however you get your product ID

            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'barcodeSymbology') === 0 && $value) {
                    // Extract the index to match with product code
                    $index = substr($key, -1);

                    $barcode = new Barcode();
                    $barcode->product_id = $productId;
                    $barcode->symbology = $value;
                    $barcode->code = $request->input('productCode' . $index);
                    $barcode->save();
                }
            }

            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');
        }

        return redirect()->route('products.index')
            ->with('error', 'Product creation failed.');
    }


    private function handleImageUpload(Request $request, $productId)
    {
        $images = $request->file('img');
        foreach ($images as $file) {
            // Validate the file
            $validatedData = $request->validate([
                'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Generate a unique filename
            $filename = "productImg" . '_' . time() . '_' . Str::uuid() . '.' . $file->extension();

            // Store the file and handle any potential errors
            try {
                $file->storeAs('public/images/products', $filename);
            } catch (\Exception $e) {
                // Handle the error
                return back()->with('error', 'Failed to upload image: ' . $e->getMessage());
            }

            // Insert the image path and product ID into the database and handle any potential errors
            try {
                ProductImage::create([
                    'img_path' => "/images/products/$filename",
                    'product_id' => $productId
                ]);
            } catch (\Exception $e) {
                // Handle the error
                return back()->with('error', 'Failed to save image: ' . $e->getMessage());
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images', 'barcodes')->find($id);
        $categories = ProductCategory::where('created_by', auth()->id())->get();
        $brands = ProductBrand::where('created_by', auth()->id())->get();
        $suppliers = Supplier::where('created_by', auth()->id())->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_short_description' => 'required',
            'description' => 'required',
            'measureType' => 'required',
            'amount' => 'required',
            'supply_price' => 'required',
        ]);

        $data = $request->all();
        $data['updated_by'] = auth()->id();
        $product = Product::find($id);
        if ($product) {
            $product->images()->delete();
            $product->barcodes()->delete();
            $product->delete();


            $productData = array_merge(['id' => $id], $data);
            $product  = Product::create($productData);

            if ($request->has('img')) {
                $this->handleImageUpload($request, $product->id);
            }

            $productId = $product->id; // or however you get your product ID

            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'barcodeSymbology') === 0 && $value) {
                    // Extract the index to match with product code
                    $index = substr($key, -1);

                    $barcode = new Barcode();
                    $barcode->product_id = $productId;
                    $barcode->symbology = $value;
                    $barcode->code = $request->input('productCode' . $index);
                    $barcode->save();
                }
            }

            return redirect()->route('products.index')
                ->with('success', 'Product created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->images()->delete();
            $product->barcodes()->delete();
            $product->delete();
            // return redirect()->route('products.index')
            //     ->with('success', 'Product deleted successfully.');
            return response()->json(['status' => 200 , 'message' => 'Product deleted successfully']);

        }
    }


    public function getProductDetails(Request $request){
        if (!$request->query) {
            return response()->json(['success' => false]);
        }
        $code = $request->input('query');


        $product = Product::where(function ($query) use ($code) {
            $query->orWhere('name', 'like', '%' . $code . '%')
                ->orWhereHas('barcodes', function ($barcodeQuery) use ($code) {
                    $barcodeQuery->where('code', 'like', '%' . $code . '%')
                        ->orWhere('name', 'like', '%' . $code . '%');
                });
        })->with('barcodes','category')->get();

        if ($product) {
            return response()->json(['success' => true, 'product' => $product]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function storeSupplier(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = $data['updated_by'] = auth()->id();
        Supplier::create($data);
        return redirect()->back()->with('success', 'Supplier created successfully');
    }
}
