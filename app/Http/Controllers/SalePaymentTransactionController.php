<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SalePayment;
use Illuminate\Http\Request;

class SalePaymentTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $sales = Sale::where('created_by',auth()->id())->get();
        if(auth()->user()->hasRole('Admin')){
            $payments = SalePayment::all();
        }
        else{
            $payments = SalePayment::where('created_by',auth()->id())->get();
        }
        // $payments = SalePayment::where('created_by',auth()->id())->get();
        // $payments->load('cashReceiverId');
        // dd($payments->cashReceiverId);
        // return $payments->cash_receiver_id;
        return view('admin.sale-payment.index',compact('payments'));

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
            'sale_id' => 'required',
            'payment_method' => 'required',
            'paid_amount' => 'required',
            'cash_received_by' => 'required',
        ]);
        $data = $request->all();

        // dd($data);
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();
        $data['type'] = "Sale";
        $sale = Sale::find($data['sale_id']);
        $sale->due_amount = $sale->due_amount - $data['paid_amount'];
        $sale->cash_received = $sale->cash_received + $data['paid_amount'];
        $sale->save();
        if($sale->grand_total > $sale->cash_received){
            $sale->status = 'Part Paid';
        }
        else{
            $sale->status = 'Paid';
        }
        $sale->save();
        SalePayment::create($data);
        return response()->json(['status' => 200,'success' => 'Payment Added Successfully!']);

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
}
