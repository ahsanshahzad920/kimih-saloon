<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = ProductBrand::where('created_by', auth()->id())->get();
        return view('admin.brands.index',compact('brands'));
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
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $data = $request->all();
        $data['created_by'] = $data['updated_by'] = auth()->id();
        ProductBrand::create($data);
        return redirect()->back()->with('success','Brand created successfully!');
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
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);
        $data['updated_by'] = auth()->id();
        $data = $request->all();
        $brand = ProductBrand::find($id);
        $brand->update($data);
        return redirect()->back()->with('success','Brand updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = ProductBrand::find($id);
        $brand->delete();
        // return redirect()->back()->with('success','Brand delete successfully!');
        return response()->json(['status' => 200 , 'message' => 'Brand deleted successfully']);

    }
}
