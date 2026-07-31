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
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the authenticated user has the role 'Admin'
        if (auth()->user()->hasRole('Admin')) {
            $team_members = TeamMember::all();
        } else {
            $team_members = TeamMember::where('created_by', auth()->id())->get();
        }

        return view('admin.sales.index', compact('team_members'));
    }

    /**
     * Server-side DataTables source for the sales listing.
     */
    public function ajax(Request $request)
    {
        try {
            $query = Sale::query()->with('client');

            if (!auth()->user()->hasRole('Admin')) {
                $query->where('created_by', auth()->id());
            }

            return DataTables::of($query)
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search.value');
                    if ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('status', 'like', "%{$search}%")
                                ->orWhere('date', 'like', "%{$search}%")
                                ->orWhereHas('client', fn($q) => $q->where('name', 'like', "%{$search}%"));
                        });
                    }
                })
                ->addColumn('checkbox', function () {
                    return '<div class="form-check"><input class="form-check-input" type="checkbox" name="chk_child"></div>';
                })
                ->addColumn('client_name', fn($sale) => e($sale->client->name ?? 'N/A'))
                ->addColumn('paid', fn($sale) => e($sale->cash_received ?? '0.00'))
                ->addColumn('due', fn($sale) => e($sale->due_amount ?? '0.00'))
                ->addColumn('gross_total', fn($sale) => e($sale->grand_total ?? '0.00'))
                ->addColumn('status_badge', function ($sale) {
                    return '<span class="badges green-border text-center">' . e($sale->status ?? '') . '</span>';
                })
                ->addColumn('action', function ($sale) {
                    $payNow = '';
                    if ($sale->due_amount != 0 && in_array($sale->status, ['Unpaid', 'Part Paid'])) {
                        $payNow = '<a href="#" class="dropdown-item payNowbtn" style="cursor: pointer" data-bs-target="#exampleModalToggle5" data-bs-toggle="modal" id="payNowbtn" data-sale=\'' . e($sale->toJson()) . '\'>'
                            . '<i class="fa fa-doller text-warning me-2"></i> Pay now</a>';
                    }

                    return '<div style="overflow: visible">'
                        . '<a class="btn btn-secondary bg-transparent border-0 text-dark" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                        . '<i class="fa-solid fa-ellipsis-v"></i></a>'
                        . '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">'
                        . $payNow
                        . '<a href="#" class="dropdown-item" style="cursor: pointer"><i class="fa fa-doller text-warning me-2"></i> Refund items</a>'
                        . '<a href="javascript:void(0);" class="dropdown-item"><i class="fa fa-pencil text-danger"></i> Edit sale Details</a>'
                        . '<a href="' . route('sales.show', $sale->id) . '" class="dropdown-item"><i class="fa fa-eye text-danger"></i> Invoice</a>'
                        . '</div></div>';
                })
                ->rawColumns(['checkbox', 'status_badge', 'action'])
                ->make(true);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Sales DataTables query failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Unable to load sales right now. Please try again.'], 500);
        }
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
