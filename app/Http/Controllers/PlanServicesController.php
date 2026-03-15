<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\PlanService;

class PlanServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planServices = PlanService::with('plans')->get();
        return view('admin.plan-services.index', compact('planServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans = Plan::all();
        return view('admin.plan-services.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $data['user_id'] = auth()->id();

        PlanService::create($data);

        return redirect()->route('plan_services.index')
            ->with('success', 'Plan Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $planService = PlanService::findOrFail($id);
        // return view('plan_services.show', compact('planService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $planService = PlanService::findOrFail($id);
        $plans = Plan::all();

        return view('admin.plan-services.edit', compact('planService', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $planService = PlanService::findOrFail($id);
        $planService->update($request->all());

        return redirect()->route('plan_services.index')
            ->with('success', 'Plan Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $planService = PlanService::findOrFail($id);
        $planService->delete();

        return response()->json(['status' => true, 'message' => 'Plan Services deleted successfully!']);
    }
}
