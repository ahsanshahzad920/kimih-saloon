<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use App\Models\Service;
use App\Models\Membership;
use App\Models\TeamMember;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Models\PaidPlan;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the authenticated user has the role 'Admin'
        if (auth()->user()->hasRole('Admin')) {
            // Fetch all sales and team members
            $sales = Sale::all()->load('client');
            $team_members = TeamMember::all();
        } else {
            // Fetch only the sales and team members related to the authenticated user
            $sales = Sale::where('created_by', auth()->id())->get()->load('client');
            $team_members = TeamMember::where('created_by', auth()->id())->get();
        }

        return view('admin.sales.index', compact('sales', 'team_members'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::where('created_by',auth()->id())->get();
        // dd($clients);
        // $services = ServiceCategory::all();
        // $services->load('services');

        $services = Service::where('created_by',auth()->id())->get();
        $products = Product::where('retail_price','!=',null)->where('created_by',auth()->id())->get();
        $products->load('barcodes');
        $memberships = Membership::where('created_by',auth()->id())->get();
        $team_members = TeamMember::where('created_by',auth()->id())->get();
        $appointments = Appointment::where('created_by',auth()->id())->where('status','!=','Completed')->get();

        // dd($appointments);
        return view('admin.sales.create',compact('clients','services','products','memberships','team_members','appointments'));
    }

    // public function saleInvoie($id)
    // {

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'client_id' => 'required',
            // 'payment_method' => 'required',
            'cash_received' => 'required',
            'grand_total' => 'required',
            'order_items' => 'required',
        ]);

        $data = $request->all();
        $data['invoice_number'] = 'INV-'.rand(10000,99999).date('Ymd').rand(10000,99999);
        $data['date'] = date('Y-m-d');
        $data['created_by'] = $data['updated_by'] =  auth()->id();

        if(!isset($data['status']) || $data['status'] != "Unpaid"){
            if($data['grand_total'] > $data['cash_received']){
                $data['status'] = 'Part Paid';
            }
            elseif($data['cash_received'] == 0){
                $data['status'] = 'Unpaid';
            }
            else{
                $data['status'] = "Paid";
            }
        }

        // dd($data);
        $sale = Sale::create($data);

        foreach ($request->order_items as $item) {
            if($item['type'] == 'product'){
                $product = Product::find($item['item_id']);
                $product->current_stock_quantity = $product->current_stock_quantity - $item['quantity'];
                $product->save();
            }
            if($sale->cash_received > 0){
                if($item['type'] == 'appointment'){
                    $appointment = Appointment::find($item['item_id']);
                    $appointment->status = 'Completed';
                    $appointment->save();
                }
            }
            if($item['type'] == 'membership'){
                $membership = Membership::find($item['item_id']);
                $valid_for = $membership->valid_for;
                PaidPlan::create([
                    'client_id' => $sale->client_id,
                    'membership_id' => $item['item_id'],
                    'type' => 'One-time',
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d',strtotime('+'.$valid_for)),
                    'total_charged' => $item['price'],
                    'status' => '1',
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
            }
            $item['created_by'] = $item['updated_by'] = auth()->id();
            $sale->items()->create($item);
        }

        if(!isset($data['status']) || $data['status'] != "Unpaid"){
            $sale->payments()->create([
                'client_id' => $sale->client_id,
                'cash_received_by' => $sale->cash_received_by,
                'payment_date' => $sale->date,
                'payment_method' => $sale->payment_method,
                'paid_amount' => $sale->cash_received,
                'type' => 'Sale',
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        }



        return response()->json(['status' => 200,'message' => 'Sale created successfully',]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::find($id);
        // $sale->load('items','client','payments','items.product','items.service','items.membership','items.appointment');
        $sale->load('items','client','payments','createdBy');
        // dd($sale);
        return view('admin.sales.invoice',compact('sale'));
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
