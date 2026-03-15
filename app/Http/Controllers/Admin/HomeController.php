<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home = Home::first();
        return view('admin.cms.home',compact('home'));
        
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
        //
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
        $request->validate([
            'home_title' => 'required',
            'section1_title' => 'required',
            'section1_desc' => 'required',
            'section2_title' => 'required',
            'section2_video_link' => 'required',
            'last_section_title' => 'required',
            'last_section_desc' => 'required',
        ]);
        $data = $request->all();
        // dd($data);
        if($request->hasFile('section1_image')){
            $file = $request->file('section1_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/home/',$filename);
            $data['section1_image'] = 'uploads/home/'.$filename;
        }
        if($request->hasFile('last_section_image')){
            $file = $request->file('last_section_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/home/',$filename);
            $data['last_section_image'] = 'uploads/home/'.$filename;
        }
        Home::UpdateOrCreate(['id'=> 1],$data);
        return redirect()->back()->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
