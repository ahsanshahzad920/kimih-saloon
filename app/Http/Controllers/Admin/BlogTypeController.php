<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogType;
use Illuminate\Http\Request;

class BlogTypeController extends Controller
{
    public function index()
    {
        $blogTypes = BlogType::all();
        return view('admin.blog-type.index', compact('blogTypes'));
    }

    public function create()
    {
        return view('admin.blog-type.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $data['user_id'] = auth()->id();

        BlogType::create($data);

        return redirect()->route('blog-types.index')->with('success', 'Blog Type created successfully.');
    }

    public function show(BlogType $blogType)
    {
        // return view('admin.blog-type.show', compact('blogType'));
    }

    public function edit(BlogType $blogType)
    {
        return view('admin.blog-type.edit', compact('blogType'));
    }

    public function update(Request $request, BlogType $blogType)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $blogType->update($request->all());
        return redirect()->route('blog-types.index')->with('success', 'Blog Type updated successfully.');
    }

    public function destroy(BlogType $blogType)
    {
        $blogType->delete();

        return response()->json(['status' => true, 'message' => 'Blog type deleted successfully.']);
    }
}
