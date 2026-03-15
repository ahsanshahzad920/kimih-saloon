<?php

namespace App\Http\Controllers\User;

use App\Models\Sale;
use App\Models\User;
use App\Models\PaidPlan;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopMembershipController extends Controller
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

        if (!$shop) {
            abort(404);
        }


        return view('user.shop.memberships.index', compact('shop'));
    }

    public function purchased_membership(){
        $memberships = PaidPlan::where('client_id',auth()->id())->get();
        // dd($memberships[0]->createdBy->businessUser->business_name);
        return view('user.memberships.index',compact('memberships'));
    }

    public function checkout(Request $request, $slug)
    {

        $request->validate([
            'membership_id' => 'required|exists:memberships,id',
            'shop_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:users,id',
        ]);

        $shop = User::whereHas('roles', function ($query) {
            $query->where('name', 'Business User');
        })->whereHas('businessUser', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();
        if (!$shop) {
            abort(404);
        }
        $data = $request->all();
        $data['invoice_number'] = 'INV-' . rand(10000, 99999) . date('Ymd') . rand(10000, 99999);
        $data['date'] = date('Y-m-d');
        $data['sub_total'] = $data['grand_total'] = $data['price'];
        $data['cash_received'] = $data['price'];
        $data['cash_return'] = 0;
        $data['due_amount'] = 0;
        $data['status'] = "Paid";
        $data['payment_method'] = "Cash";
        $data['created_by'] = $data['updated_by'] =  $data['shop_id'];

        $sale = Sale::create($data);

        $membership = Membership::find($data['membership_id']);
        $valid_for = $membership->valid_for;
        PaidPlan::create([
            'client_id' => $sale->client_id,
            'membership_id' => $membership->id,
            'type' => 'One-time',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d', strtotime('+' . $valid_for)),
            'total_charged' => $data['price'],
            'status' => '1',
            'created_by' => $data['shop_id'],
            'updated_by' => $data['shop_id'],
        ]);

        $sale->items()->create([
            'item_id' => $membership->id,
            'type' => 'membership',
            'quantity' => 1,
            'price' => $data['price'],
            'sub_total' => $data['price'],
            'created_by' => $data['shop_id'],
            'updated_by' => $data['shop_id'],
        ]);
        $sale->payments()->create([
            'client_id' => $sale->client_id,
            'payment_date' => $sale->date,
            'payment_method' => $sale->payment_method,
            'paid_amount' => $sale->cash_received,
            'type' => 'Sale',
            'created_by' => $data['shop_id'],
            'updated_by' => $data['shop_id'],
        ]);

        return redirect()->route('customer.membership.purchased', $slug)->with('success', 'Membership purchased successfully');
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
}
