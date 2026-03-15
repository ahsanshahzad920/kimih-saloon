<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Appointment;
use App\Models\SalePayment;
use Illuminate\Http\Request;

class DailySalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('Admin')) {
            $serviceQty = SaleItem::where('type', 'services')->sum('quantity');
            $servicePrice = SaleItem::where('type', 'services')->sum('price');
            $membershipQty = SaleItem::where('type', 'memberships')->sum('quantity');
            $membershipPrice = SaleItem::where('type', 'memberships')->sum('price');
            $productQty = SaleItem::where('type', 'products')->sum('quantity');
            $productPrice = SaleItem::where('type', 'products')->sum('price');
            $appointments = SaleItem::where('type', 'appointment')->get();
        } else {
            $serviceQty = SaleItem::where('created_by', $user->id)->where('type', 'services')->sum('quantity');
            $servicePrice = SaleItem::where('created_by', $user->id)->where('type', 'services')->sum('price');
            $membershipQty = SaleItem::where('created_by', $user->id)->where('type', 'memberships')->sum('quantity');
            $membershipPrice = SaleItem::where('created_by', $user->id)->where('type', 'memberships')->sum('price');
            $productQty = SaleItem::where('created_by', $user->id)->where('type', 'products')->sum('quantity');
            $productPrice = SaleItem::where('created_by', $user->id)->where('type', 'products')->sum('price');
            $appointments = SaleItem::where('created_by', $user->id)->where('type', 'appointment')->get();
        }

        foreach ($appointments as $value) {
            $servicePrice += $value->price;
            $app = Appointment::find($value->item_id);
            $serviceQty += $app->services->count();
        }

        $totalQty = $serviceQty + $membershipQty + $productQty;
        $totalPrice = $servicePrice + $membershipPrice + $productPrice;

        if ($user->hasRole('Admin')) {
            // Payments for Admin
            $cash = SalePayment::where('payment_method', 'Cash')->sum('paid_amount');
            $other = SalePayment::where('payment_method', '!=', 'Cash')->sum('paid_amount');
            $payment_collected = $cash + $other;
            $outstanding = Sale::sum('cash_return');
        } else {
            // Payments for Non-Admin
            $cash = SalePayment::where('created_by', $user->id)->where('payment_method', 'Cash')->sum('paid_amount');
            $other = SalePayment::where('created_by', $user->id)->where('payment_method', '!=', 'Cash')->sum('paid_amount');
            $payment_collected = $cash + $other;
            $outstanding = Sale::where('created_by', $user->id)->sum('cash_return');
        }

        return view('admin.daily-sales.index', compact(
            'serviceQty',
            'servicePrice',
            'membershipQty',
            'membershipPrice',
            'productQty',
            'productPrice',
            'totalQty',
            'totalPrice',
            'cash',
            'other',
            'outstanding',
            'payment_collected'
        ));
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
