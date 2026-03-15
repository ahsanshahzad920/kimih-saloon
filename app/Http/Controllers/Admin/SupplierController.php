<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::where('created_by', auth()->id())->get();
        // $suppliers = collect();
        return view('admin.suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = $data['updated_by'] = auth()->id();
        Supplier::create($data);
        return redirect()->route('suppliers.index')->with('success','Supplier created successfully');
        // return redirect()->back()->with('success', 'Supplier created successfully');
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
        $supplier = Supplier::find($id);
        return view('admin.suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $data['updated_by'] = auth()->id();
        $supplier = Supplier::find($id);
        $supplier->update($data);
        return redirect()->route('suppliers.index')->with('success','Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        // return redirect()->route('suppliers.index')->with('success','Supplier deleted successfully');
        return response()->json(['status' => 200 , 'message' => 'Supplier deleted successfully']);

    }
}
