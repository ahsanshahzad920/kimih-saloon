<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
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
        // Validate the request data
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_front' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_with_site_name' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'privacy_policy' => 'nullable|string',
            'term_of_service' => 'nullable|string',
            'cancellation_policy' => 'nullable|string',
            'partner_terms' => 'nullable|string',
        ]);

        // Fetch the single settings record or create a new one if it doesn't exist
        $settings = Setting::first();

        // Initialize old image paths
        $oldLogoPath = null;
        $oldLogoFrontPath = null;
        $oldLogoWithSiteNamePath = null;

        // If settings exist, store old image paths
        if ($settings) {
            $oldLogoPath = $settings->logo;
            $oldLogoFrontPath = $settings->logo_front;
            $oldLogoWithSiteNamePath = $settings->logo_with_site_name;
        }

        // Handle logo update if file is uploaded
        if ($request->hasFile('logo')) {
            // Store new logo and update path
            $logoPath = $request->file('logo')->store('logos', 'public');

            // Delete old logo if it exists and is different from new one
            if ($oldLogoPath && $oldLogoPath !== $logoPath) {
                Storage::disk('public')->delete($oldLogoPath);
            }
        } else {
            // Retain old logo path if not updated
            $logoPath = $oldLogoPath;
        }

        // Handle logo front update if file is uploaded
        if ($request->hasFile('logo_front')) {
            // Store new logo front and update path
            $logoFrontPath = $request->file('logo_front')->store('logos', 'public');

            // Delete old logo front if it exists and is different from new one
            if ($oldLogoFrontPath && $oldLogoFrontPath !== $logoFrontPath) {
                Storage::disk('public')->delete($oldLogoFrontPath);
            }
        } else {
            // Retain old logo front path if not updated
            $logoFrontPath = $oldLogoFrontPath;
        }

        // Handle logo with site name update if file is uploaded
        if ($request->hasFile('logo_with_site_name')) {
            // Store new logo with site name and update path
            $logoWithSiteNamePath = $request->file('logo_with_site_name')->store('logos', 'public');

            // Delete old logo with site name if it exists and is different from new one
            if ($oldLogoWithSiteNamePath && $oldLogoWithSiteNamePath !== $logoWithSiteNamePath) {
                Storage::disk('public')->delete($oldLogoWithSiteNamePath);
            }
        } else {
            // Retain old logo with site name path if not updated
            $logoWithSiteNamePath = $oldLogoWithSiteNamePath;
        }

        // Create or update settings
        if ($settings) {
            $settings->update([
                'site_name' => $validated['site_name'],
                'logo' => $logoPath,
                'logo_front' => $logoFrontPath,
                'logo_with_site_name' => $logoWithSiteNamePath,
                'privacy_policy' => $validated['privacy_policy'],
                'term_of_service' => $validated['term_of_service'],
                'cancellation_policy' => $validated['cancellation_policy'],
                'partner_terms' => $validated['partner_terms'],
                'updated_by' => auth()->id(),
            ]);
        } else {
            Setting::create([
                'site_name' => $validated['site_name'],
                'user_id' => auth()->id(),
                'logo' => $logoPath,
                'logo_front' => $logoFrontPath,
                'logo_with_site_name' => $logoWithSiteNamePath,
                'privacy_policy' => $validated['privacy_policy'],
                'term_of_service' => $validated['term_of_service'],
                'cancellation_policy' => $validated['cancellation_policy'],
                'partner_terms' => $validated['partner_terms'],
                'created_by' => auth()->id(),
            ]);
        }

        // Return a response
        return back()->with('success', 'Settings updated successfully.');
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
