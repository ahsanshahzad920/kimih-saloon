<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::where('created_by', auth()->id())->get();
        return view('admin.categories.index',compact('categories'));
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
        ProductCategory::create($data);
        return redirect()->back()->with('success','Category created successfully!');
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
        $data = $request->all();
        $data['updated_by'] = auth()->id();
        $category = ProductCategory::find($id);
        $category->update($data);
        return redirect()->back()->with('success','Category updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::find($id);
        $category->delete();
        // return redirect()->back()->with('success','Category delete successfully!');
        return response()->json(['status' => 200 , 'message' => 'Category deleted successfully']);
    }
}
