<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Service;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::where('created_by', auth()->id())->get();
        // $memberships->load('services');
        // dd($memberships);
        // $memberships = collect();
        return view('admin.memberships.index',compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $services = Service::where('created_by', auth()->id())->get();
        // dd($services);
        return view('admin.memberships.create',compact('services'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'services' => 'required',
            'sessions' => 'required',
            'valid_for' => 'required',
            'price' => 'required',
            'tax_rate' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = $data['updated_by'] = auth()->id();

        $data['services'] = implode(',',$data['services']);

        Membership::create($data);

        return redirect()->route('memberships.index')->with('success','Membership created successfully!');

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
        $membership = Membership::find($id);
        $services = Service::where('created_by', auth()->id())->get();

        // in_array($membership->services, $services->pluck('id')->toArray());
        return view('admin.memberships.edit',compact('membership','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'services' => 'required',
            'sessions' => 'required',
            'valid_for' => 'required',
            'price' => 'required',
            'tax_rate' => 'required',
        ]);

        $data = $request->all();
        $data['updated_by'] = auth()->id();
        $membership = Membership::find($id);
        $data['services'] = implode(',',$data['services']);
        $membership->update($data);
        return redirect()->route('memberships.index')->with('success','Membership updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $membership = Membership::find($id);
        $membership->delete();
        // return redirect()->route('memberships.index')->with('success','Membership deleted successfully!');
        return response()->json(['status' => 200 , 'message' => 'Services deleted successfully']);

    }
}
