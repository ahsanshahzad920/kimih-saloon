<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('plans/images', 'public');
        }

        $data['user_id'] = auth()->id();

        $plan = Plan::create($data);
        return redirect()->route('plans.index')->with('success', 'Plan created successfully.');
    }

    public function show(Plan $plan)
    {
        return view('plans.show', compact('plan'));
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($plan->image) {
                Storage::disk('public')->delete($plan->image);
            }
            $data['image'] = $request->file('image')->store('plans/images', 'public');
        }

        $plan->update($data);
        return redirect()->route('plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        if ($plan->image) {
            Storage::disk('public')->delete($plan->image);
        }
        $plan->delete();
        return response()->json(['status' => true, 'message' => 'Plan deleted successfully!']);
    }

    public function showOnFrontEnd()
    {
        $plans = Plan::with('planServices')->get();

        return view('front.pricing', compact('plans'));
    }
}
