<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $record = About::first();
        return view('admin.about.index', compact('record'));
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
            'heading' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video_link' => 'nullable|string|max:255',
            'section_heading' => 'nullable|string|max:255',
            'section_title' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Fetch the single record
        $record = About::first();

        // Initialize arrays to hold image paths
        $imagePaths = $record ? json_decode($record->images, true) : [];

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('about/images', 'public');
                $imagePaths[] = $path;
            }
        } else {
            $imagePaths = json_decode($record->images, true);
        }

        // Handle single image uploads
        $videoBackgroundImagePath = null;
        $sectionImagePath = null;

        if ($request->hasFile('video_background_image')) {
            if (isset($record->video_background_image))
                Storage::disk('public')->delete($record->video_background_image);

            $videoBackgroundImagePath = $request->file('video_background_image')->store('about/images', 'public');
        } else {
            $videoBackgroundImagePath = $record->video_background_image;
        }

        if ($request->hasFile('section_image')) {
            if (isset($record->section_image))
                Storage::disk('public')->delete($record->section_image);

            $sectionImagePath = $request->file('section_image')->store('about/images', 'public');
        } else {
            $sectionImagePath = $record->section_image;
        }

        // If the record exists, update it; otherwise, create a new one
        if ($record) {
            $record->update([
                'heading' => $validated['heading'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'video_link' => $validated['video_link'],
                'section_heading' => $validated['section_heading'],
                'section_title' => $validated['section_title'],
                'images' => json_encode($imagePaths, true),
                'video_background_image' => $videoBackgroundImagePath,
                'section_image' => $sectionImagePath,
                'updated_by' => auth()->id()
            ]);
        } else {
            $record = About::create([
                'heading' => $validated['heading'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'video_link' => $validated['video_link'],
                'section_heading' => $validated['section_heading'],
                'section_title' => $validated['section_title'],
                'images' => json_encode($imagePaths, true),
                'video_background_image' => $videoBackgroundImagePath,
                'section_image' => $sectionImagePath,
                'created_by' => auth()->id()
            ]);
        }
        // Return a response
        return back()->with('success', 'Record updated successfully.');
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
    public function destroy(string $id, Request $request)
    {
        $record = About::find($id);
        $path = $request->imagePath;
        $images = json_decode($record->images, true);

        $key = array_search($path, $images);
        if ($key !== false) {
            Storage::disk('public')->delete($path);
            unset($images[$key]);

            $record->images = json_encode(array_values($images), true);
            $record->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Image path not found in record'], 404);
        }
    }

    public function frontEndShow()
    {
        $record = About::first();
        $blogs = Blog::with('user')->get();

        return view('front.about', compact('record', 'blogs'));
    }
}
