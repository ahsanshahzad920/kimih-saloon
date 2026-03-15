<?php

namespace App\Http\Controllers\Admin;

use App\Models\BusinessInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class BusinessInfoController extends Controller
{
    public function index()
    {
        $businessInfos = BusinessInfo::where('user_id', Auth::id())->get();
        return view('admin.cms.business-info.index', compact('businessInfos'));
    }

    public function create()
    {
        return view('admin.cms.business-info.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('businessinfo', 'public');
        }

        BusinessInfo::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('business-info.index')->with('success', 'Business info added successfully.');
    }

    public function show(BusinessInfo $businessInfo)
    {
        // return view('business-infos.show', compact('businessInfo'));
    }

    public function edit(BusinessInfo $businessInfo)
    {
        return view('admin.cms.business-info.edit', compact('businessInfo'));
    }

    public function update(Request $request, BusinessInfo $businessInfo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($businessInfo->image) {
                Storage::disk('public')->delete($businessInfo->image);
            }
            $imagePath = $request->file('image')->store('businessinfo', 'public');
            $businessInfo->image = $imagePath;
        }

        $businessInfo->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $businessInfo->image,
        ]);

        return redirect()->route('business-info.index')->with('success', 'Info updated successfully.');
    }

    public function destroy(BusinessInfo $businessInfo)
    {
        if ($businessInfo->image) {
            Storage::disk('public')->delete($businessInfo->image);
        }

        $businessInfo->delete();

        return response()->json(['status' => true, 'message' => 'Business info deleted successfully!']);
    }
}
