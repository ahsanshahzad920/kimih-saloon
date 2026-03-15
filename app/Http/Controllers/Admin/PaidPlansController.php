<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaidPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaidPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paid_plans = PaidPlan::where('created_by',auth()->id())->get();

        // dd($paid_plans);
        return view('admin.paid-plans.index',compact('paid_plans'));
    }

    public function changeStatus(Request $request){

        $paid_plan = PaidPlan::find($request->id);
        $status = $paid_plan->status;
        if($paid_plan->status==1){
            $paid_plan->status=0;

        }else{
            $paid_plan->status=1;

        }
        $paid_plan->save();
        return response()->json(['status'=> 200,'message' => 'Status changed successfully.']);
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
