<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessCrm;
use App\Models\BusinessInfo;
use App\Models\Feature;
use App\Models\FeaturePage;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = BusinessCrm::first();
        return view('admin.cms.business.index', compact('section'));
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
        // return $request;
        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'capterra_rating' => 'nullable|string|max:255',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'capterra_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'top_rating_title' => 'nullable|string|max:255',
            'top_rating_description' => 'nullable|string|max:255',
            'business_partner_count' => 'nullable|string',
            'business_partner_title' => 'nullable|string|max:255',
            'appointmens_count' => 'nullable|string',
            'appointmens_title' => 'nullable|string|max:255',
            'stylists_count' => 'nullable|string',
            'stylists_title' => 'nullable|string|max:255',
            'countries_count' => 'nullable|string',
            'countries_title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'extra_content' => 'nullable|array',
            'extra_content.*.heading' => 'nullable|string',
            'extra_content.*.description' => 'nullable|string',
        ]);

        $data = $request->only([
            'title', 'sub_title', 'capterra_rating', 'top_rating_title', 'top_rating_description',
            'business_partner_count', 'business_partner_title', 'appointmens_count', 'appointmens_title',
            'stylists_count', 'stylists_title', 'countries_count', 'countries_title'
        ]);

        // Fetch the existing record (assuming there is only one)
        $section = BusinessCrm::first();

        $data['user_id'] = Auth::id();

        // Handle header_image upload
        if ($request->hasFile('header_image')) {
            if($section && $section->header_image)
                Storage::disk('public')->delete($section->header_image);
            $data['header_image'] = $request->file('header_image')->store('cms/landing/images', 'public');
        }

        // Handle capterra_image upload
        if ($request->hasFile('capterra_image')) {
            if($section && $section->capterra_image)
                Storage::disk('public')->delete($section->capterra_image);
            $data['capterra_image'] = $request->file('capterra_image')->store('cms/landing/images', 'public');
        }

        // Extra Content
        if ($request->has('extra_content')) {
            $extra_content = [];

            foreach ($request->input('extra_content') as $key => $contentData) {
                if (!empty($contentData['heading'])) {
                    $extra_content[] = [
                        'heading' => $contentData['heading'],
                        'description' => $contentData['description'],
                    ];
                }
            }

            $data['capterra_review'] = !empty($extra_content) ? json_encode($extra_content, true) : null;
        }

        if ($section) {
            // Update the existing record
            $section->update($data);
        } else {
            // Create a new record if none exists
            $section = BusinessCrm::create($data);
        }

        return redirect()->back()->with('success', 'Section saved successfully!');
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

    public function showOnFrontEnd()
    {
        $data = BusinessCrm::first();
        $features = Feature::all();
        $businessInfo = BusinessInfo::all();
        $feedback = Feedback::where('status', 1)->get();
        $featurePage = FeaturePage::first();

        return view('front.business', compact('data', 'features', 'businessInfo', 'feedback', 'featurePage'));
    }
}
