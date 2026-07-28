<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
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

        $defaultCategories = collect();
        $myCategoryClones = collect();
        $myServiceClones = collect();

        if (!auth()->user()->hasRole('Admin')) {
            $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'Admin'))->first();

            if ($admin) {
                $defaultCategories = ServiceCategory::where('created_by', $admin->id)
                    ->whereNull('default_category_id')
                    ->with(['services' => function ($q) {
                        $q->whereNull('default_service_id');
                    }])
                    ->get();
            }

            $myCategoryClones = ServiceCategory::where('created_by', auth()->id())
                ->whereNotNull('default_category_id')
                ->with('services')
                ->get()
                ->keyBy('default_category_id');

            $myServiceClones = Service::where('created_by', auth()->id())
                ->whereNotNull('default_service_id')
                ->get()
                ->keyBy('default_service_id');
        }

        return view('admin.services.index', compact('categories', 'defaultCategories', 'myCategoryClones', 'myServiceClones'));
    }

    /**
     * Enable/disable a default (admin-owned) service category for the
     * logged-in business by cloning it into their own catalog.
     */
    public function toggleDefaultCategory(Request $request)
    {
        $request->validate([
            'default_category_id' => 'required|integer|exists:service_categories,id',
            'enabled' => 'required|boolean',
        ]);

        $default = ServiceCategory::whereNull('default_category_id')->findOrFail($request->default_category_id);

        if ($request->boolean('enabled')) {
            $clone = ServiceCategory::firstOrCreate(
                ['default_category_id' => $default->id, 'created_by' => auth()->id()],
                [
                    'name' => $default->name,
                    'description' => $default->description,
                    'icon' => $default->icon,
                    'updated_by' => auth()->id(),
                    'is_active' => true,
                ]
            );

            if (!$clone->is_active) {
                $clone->update(['is_active' => true, 'updated_by' => auth()->id()]);
            }

            return response()->json(['status' => 200, 'message' => 'Category enabled successfully']);
        }

        $clone = ServiceCategory::where('default_category_id', $default->id)
            ->where('created_by', auth()->id())
            ->first();

        if ($clone) {
            $clone->update(['is_active' => false, 'updated_by' => auth()->id()]);
            $clone->services()->update(['is_active' => false, 'updated_by' => auth()->id()]);
        }

        return response()->json(['status' => 200, 'message' => 'Category disabled successfully']);
    }

    /**
     * Enable/disable a default (admin-owned) service for the logged-in
     * business by cloning it into their own catalog. Requires the parent
     * default category to already be enabled for this business.
     */
    public function toggleDefaultService(Request $request)
    {
        $request->validate([
            'default_service_id' => 'required|integer|exists:services,id',
            'enabled' => 'required|boolean',
        ]);

        $defaultService = Service::whereNull('default_service_id')->findOrFail($request->default_service_id);

        $myCategory = ServiceCategory::where('default_category_id', $defaultService->service_category)
            ->where('created_by', auth()->id())
            ->where('is_active', true)
            ->first();

        if (!$myCategory) {
            return response()->json(['status' => 422, 'message' => 'Enable the category first.'], 422);
        }

        if ($request->boolean('enabled')) {
            $clone = Service::firstOrCreate(
                ['default_service_id' => $defaultService->id, 'created_by' => auth()->id()],
                [
                    'service_name' => $defaultService->service_name,
                    'service_type' => $defaultService->service_type,
                    'service_category' => $myCategory->id,
                    'available_for' => $defaultService->available_for,
                    'aftercare_description' => $defaultService->aftercare_description,
                    'service_description' => $defaultService->service_description,
                    'online_bookings' => 0,
                    'team_member' => null,
                    'team_memeber_commission' => null,
                    'duration' => $defaultService->duration,
                    'price_type' => $defaultService->price_type,
                    'price' => $defaultService->price,
                    'notify' => 0,
                    'notify_count' => 0,
                    'notify_days' => 0,
                    'sales_tax' => $defaultService->sales_tax,
                    'updated_by' => auth()->id(),
                    'is_active' => true,
                ]
            );

            if (!$clone->is_active) {
                $clone->update(['is_active' => true, 'updated_by' => auth()->id()]);
            }

            return response()->json(['status' => 200, 'message' => 'Service enabled successfully']);
        }

        $clone = Service::where('default_service_id', $defaultService->id)
            ->where('created_by', auth()->id())
            ->first();

        if ($clone) {
            $clone->update(['is_active' => false, 'updated_by' => auth()->id()]);
        }

        return response()->json(['status' => 200, 'message' => 'Service disabled successfully']);
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
        $query = Service::query();
        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }
        $service = $query->findOrFail($id);

        $categories = ServiceCategory::where('created_by', auth()->id())->get();
        $team_members = TeamMember::where('created_by', auth()->id())->get();
        $plans = Plan::all();

        return view('admin.services.edit', compact('service', 'categories', 'team_members', 'plans'));
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

        $query = Service::query();
        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }
        $service = $query->findOrFail($id);

        $data = $request->except(['_token', '_method']);
        $data['online_bookings'] = $request->has('online_bookings') ? 1 : 0;
        $data['notify'] = $request->has('notify') ? 1 : 0;
        $data['team_member'] = implode(',', $data['team_member']);
        $data['updated_by'] = auth()->id();

        $service->update($data);
        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = Service::query();
        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }
        $service = $query->findOrFail($id);
        $service->delete();

        return response()->json(['status' => 200, 'message' => 'Service deleted successfully']);
    }

    public function deleteCategory(string $id)
    {
        $query = ServiceCategory::query();
        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }
        $category = $query->findOrFail($id);
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

        $query = ServiceCategory::query();
        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }
        $category = $query->findOrFail($id);

        $data = $request->except(['_token', '_method', 'icon']);
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . '_' . '.' . $file->extension();
            $file->move(public_path('uploads/icons'), $fileName);
            $data['icon'] = 'uploads/icons/' . $fileName;
        }

        $category->update($data);
        return redirect()->route('services.index')->with('success', 'Category updated successfully');
    }

    /**
     * Enable/disable any category owned by the business (custom or a clone
     * of a default) via the unified switch UI. Disabling cascades to its
     * services since they can't stay active under a disabled category.
     */
    public function toggleCategoryStatus(Request $request, string $id)
    {
        $query = ServiceCategory::query();
        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }
        $category = $query->findOrFail($id);

        $category->is_active = !$category->is_active;
        $category->updated_by = auth()->id();
        $category->save();

        if (!$category->is_active) {
            $category->services()->update(['is_active' => false, 'updated_by' => auth()->id()]);
        }

        return response()->json([
            'status' => 200,
            'message' => $category->is_active ? 'Category enabled successfully' : 'Category disabled successfully',
            'is_active' => $category->is_active,
        ]);
    }

    /**
     * Enable/disable any service owned by the business (custom or a clone
     * of a default) via the unified switch UI.
     */
    public function toggleServiceStatus(Request $request, string $id)
    {
        $query = Service::query();
        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }
        $service = $query->findOrFail($id);

        $service->is_active = !$service->is_active;
        $service->updated_by = auth()->id();
        $service->save();

        return response()->json([
            'status' => 200,
            'message' => $service->is_active ? 'Service enabled successfully' : 'Service disabled successfully',
            'is_active' => $service->is_active,
        ]);
    }
}
