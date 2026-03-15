<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use App\Models\StockOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $stock_orders = StockOrder::all();
        $stock_orders = StockOrder::where('created_by', auth()->id())->get();
        // $stock_orders = collect();
        return view('admin.stock-orders.index', compact('stock_orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('created_by', auth()->id())->get();
        return view('admin.stock-orders.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'supplier_id' => 'required',
            'order_items' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = "Ordered";
        $data['created_by'] = $data['updated_by'] = auth()->id();
        // $stock_order = StockOrder::create($request->all() + ['status' => 'Ordered']);
        $stock_order = StockOrder::create($data);


        foreach ($request->order_items as $item) {
            $stock_order->orderItems()->create($item);
        }

        if($request->total_fees) {
            foreach ($request->fees as $fee) {
                $stock_order->fees()->create($fee);
            }
        }

        return response()->json(['message' => 'Stock Order created successfully!']);

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
        // $stock_order = StockOrder::with('orderItems.product.barcodes', 'fees')->find($id);
        $stock_order = StockOrder::find($id);
        $stock_order->load('orderItems', 'fees');
        // dd($stock_order);
        $suppliers = Supplier::where('created_by', auth()->id())->get();
        return view('admin.stock-orders.edit', compact('stock_order', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_id' => 'required',
            'order_items' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = $data['updated_by'] = auth()->id();
        $stock_order = StockOrder::find($id);
        $stock_order->update($data);

        $stock_order->orderItems()->delete();
        foreach ($request->order_items as $item) {
            $stock_order->orderItems()->create($item);
        }

        $stock_order->fees()->delete();
        if($request->total_fees) {
            foreach ($request->fees as $fee) {
                $stock_order->fees()->create($fee);
            }
        }

        return response()->json(['message' => 'Stock Order updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock_order = StockOrder::find($id);
        $stock_order->delete();
        // return redirect()->route('stock-orders.index')->with('success', 'Stock Order deleted successfully!');
        return response()->json(['status' => 200 , 'message' => 'Order deleted successfully!']);

    }
}
