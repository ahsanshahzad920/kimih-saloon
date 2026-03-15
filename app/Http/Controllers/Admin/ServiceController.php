<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = ServiceCategory::all();
        $categories = ServiceCategory::where('created_by', auth()->id())->get();
        $categories->load('services');
        return view('admin.services.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories  = ServiceCategory::where('created_by', auth()->id())->get();
        $team_members = TeamMember::where('created_by',auth()->id())->get();
        // $plans = Plan::all();

        return view('admin.services.create',compact('categories','team_members'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|file|mimes:svg|max:4048',
        ]);
        $data = $request->all();
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . '_' .'.'. $file->extension();
            $file->move(public_path('uploads/icons'), $fileName);
            $data['icon'] = 'uploads/icons/' . $fileName;
        }
        $data['created_by'] = $data['updated_by'] = auth()->id();
        ServiceCategory::create($data);

        return redirect()->route('services.index')->with('success', 'Category added successfully');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'service_name' => 'required|string',
            'service_type' => 'required|string',
            'service_category' => 'required|string',
            'service_description' => 'required|string',
            'duration' => 'required|string',
            'price_type' => 'required|string',
            'price' => 'required|string',
            'team_member' => 'required|array',
        ]);

        $data = $request->all();
        $data['online_bookings'] = $request->has('online_bookings') ? 1 : 0;
        $data['notify'] = $request->has('notify') ? 1 : 0;
        $data['team_member'] = implode(',',$data['team_member']);
        $data['created_by'] = $data['updated_by'] = auth()->id();
        Service::create($data);
        return redirect()->route('services.index')->with('success', 'Service added successfully');

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
        $service = Service::find($id);
        // dd($service);
        $categories = ServiceCategory::where('created_by', auth()->id())->get();
        $team_members = TeamMember::where('created_by',auth()->id())->get();
        $plans = Plan::all();

        return view('admin.services.edit',compact('service','categories','team_members', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'service_name' => 'required|string',
            'service_type' => 'required|string',
            'service_category' => 'required|string',
            'service_description' => 'required|string',
            'duration' => 'required|string',
            'price_type' => 'required|string',
            'price' => 'required|string',
            'team_member' => 'required|array',
        ]);

        $data = $request->all();
        $data['online_bookings'] = $request->has('online_bookings') ? 1 : 0;
        $data['notify'] = $request->has('notify') ? 1 : 0;
        $data['team_member'] = implode(',',$data['team_member']);
        $data['updated_by'] = auth()->id();
        $service = Service::find($id);
        $service->update($data);
        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return "yes";
        $service = Service::find($id);
        $service->delete();
        return response()->json(['status' => 200 , 'message' => 'Services deleted successfully']);

        // return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }

    public function deleteCategory(string $id)
    {
        $category = ServiceCategory::find($id);
        $category->delete();
        return redirect()->route('services.index')->with('success', 'Category deleted successfully');
    }

    public function editCategory(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|file|mimes:svg|max:4048',
        ]);
        $data = $request->all();
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . '_' .'.'. $file->extension();
            $file->move(public_path('uploads/icons'), $fileName);
            $data['icon'] = 'uploads/icons/' . $fileName;
        }
        $category = ServiceCategory::find($id);
        $category->update($data);
        return redirect()->route('services.index')->with('success', 'Category updated successfully');
    }
}
