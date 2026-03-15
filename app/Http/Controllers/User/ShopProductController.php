<?php

namespace App\Http\Controllers\User;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\AddToCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $shop = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();
        if(!$shop) {
            abort(404);
        }

        $carts = AddToCart::where('store_id', $shop->id)->where('client_id',auth()->id())->get();
        // dd($carts);

        return view('user.products.index',compact('shop','carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkout(Request $request){
        $request->validate([
            'store_id' => 'required',
            'grand_total' => 'required',
            'items' => 'required',
            'items.*.product_id' => 'required',
            'items.*.quantity' => 'required',
        ]);
        $data = $request->all();
        $data['invoice_number'] = 'INV-' . rand(10000, 99999) . date('Ymd') . rand(10000, 99999);
        $data['date'] = date('Y-m-d');
        $data['sub_total'] = $data['grand_total'] = $data['grand_total'];
        $data['cash_received'] = $data['grand_total'];
        $data['cash_return'] = 0;
        $data['due_amount'] = 0;
        $data['status'] = "Completed";
        $data['payment_method'] = "Cash On Delivery";
        $data['created_by'] = $data['updated_by'] =  $data['store_id'];
        $data['client_id'] = auth()->id();

        $sale = Sale::create($data);

        foreach($data['items'] as $item){
            $product = Product::find($item['product_id']);
            $sale->items()->create([
                'item_id' => $item['product_id'],
                'type' => 'product',
                'quantity' => $item['quantity'],
                'price' => $product->retail_price,
                'sub_total' => $product->retail_price * $item['quantity'],
                'created_by' => $data['store_id'],
                'updated_by' => $data['store_id'],
            ]);
            AddToCart::find($item['cart_id'])->delete();
        }
        $sale->payments()->create([
            'client_id' => $sale->client_id,
            'payment_date' => $sale->date,
            'payment_method' => $sale->payment_method,
            'paid_amount' => $sale->cash_received,
            'type' => 'Sale',
            'created_by' => $data['store_id'],
            'updated_by' => $data['store_id'],
        ]);


        // $order = ProductOrder::create($data);
        // foreach($data['items'] as $item){
        //     $product = Product::find($item['product_id']);
        //     $order->items()->create([
        //         'product_id' => $item['product_id'],
        //         'quantity' => $item['quantity'],
        //         'price' => $product->retail_price,
        //     ]);
        //     AddToCart::find($item['cart_id'])->delete();
        // }
        return response()->json(['status' => 200,'message' => 'Order placed successfully']);

    }

    public function product_orders() {
        $orders = Sale::whereHas('items',function ($query) {
            $query->where('type','product');
        })->where('client_id',auth()->id())->get();

        return view('user.product-orders.index',compact('orders'));
    }
}
