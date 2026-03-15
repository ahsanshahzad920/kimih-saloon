<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('blogType')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $blogTypes = BlogType::all();
        return view('admin.blogs.create', compact('blogTypes'));
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'blog_type_id' => 'required',
            'image' => 'nullable|image|max:2048', // Validation for image
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('blogs/images', 'public') : null;

        Blog::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'blog_type_id' => $request->blog_type_id,
            'body' => $request->body,
            'slug' => Str::slug($request->title),
            'image' => $imagePath,
            'tags' => $request->tags,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $blogTypes  = BlogType::all();
        return view('admin.blogs.edit', compact('blog', 'blogTypes'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'blog_type_id' => 'required',
            'image' => 'nullable|image|max:2048', // Validation for image
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('blogs/images', 'public');
        } else {
            $imagePath = $blog->image; // Keep old image
        }

        $blog->update([
            'title' => $request->title,
            'body' => $request->body,
            'blog_type_id' => $request->blog_type_id,
            'slug' => Str::slug($request->title),
            'image' => $imagePath,
            'tags' => $request->tags,
            'updated_by' => auth()->id()
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        // Delete image if exists
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return response()->json(['status' => true, 'message' => 'Blog deleted successfully.']);
    }

    public function blogDetails(string $slug)
    {
        $blog = Blog::with('blogType', 'comments')->where('slug', $slug)->first();
        $typesWithCount = BlogType::withcount('blogs')->get();
        $recentBlogs = Blog::latest()->get();

        return view('front.blog-details', compact('blog', 'typesWithCount', 'recentBlogs'));
    }

    public function blogsOnFrontEnd()
    {
        $blogs = Blog::with('user')->latest()->paginate(9);

        return view('front.blogs', compact('blogs'));
    }

    public function blogsByTypes(string $blogType)
    {
        $blogs = Blog::whereHas('blogType', function ($query) use ($blogType) {
            $query->where('name', 'LIKE', '%' . $blogType . '%');
        })->paginate(9);

        return view('front.blogs', compact('blogs'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $blogs = Blog::where('title', 'LIKE', "%$keyword%")
            ->orWhereHas('blogType', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })->paginate(9);

        return view('front.blogs', compact('blogs'));
    }

    public function blogsByTags(string $tags)
    {
        // Split the tags input into an array
        $tagsArray = explode(',', $tags);

        $blogs =  Blog::where(function ($query) use ($tagsArray) {
            foreach ($tagsArray as $tag) {
                $query->orWhere('tags', 'LIKE', '%' . trim($tag) . '%');
            }
        })->paginate(9);

        return view('front.blogs', compact('blogs'));
    }
}
