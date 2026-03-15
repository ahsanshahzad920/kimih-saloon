<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeaturePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::all();
        return view('admin.cms.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cms.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = $request->all();
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon');
        }

        $data['user_id'] = auth()->id();

        Feature::create($data);

        return redirect()->route('features.index')->with('success', 'Feature created successfully.');
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
        $feature = Feature::find($id);
        return view('admin.cms.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = $request->all();
        if ($request->hasFile('icon')) {
            Storage::delete($feature->icon);
            $data['icon'] = $request->file('icon');
        }

        $feature->update($data);

        return redirect()->route('features.index')->with('success', 'Feature updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        // Find the feature by id and delete it
        $feature = Feature::find($id);
        if ($feature) {
            $feature->delete();
            return response()->json(['status' => true, 'message' => 'Feature deleted successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Feature not found!'], 404);
        }
    }

    public function featurePageIndex()
    {
        $featurePage = FeaturePage::first();

        return view('admin.cms.features.page-heading', compact('featurePage'));
    }

    public function featurePageStore(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $obj = FeaturePage::first();

        if ($obj) {
            $obj->update([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
            ]);
        } else {
            FeaturePage::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }
        return redirect()->route('features.index')->with('success', 'Feature updated successfully.');
    }
}
