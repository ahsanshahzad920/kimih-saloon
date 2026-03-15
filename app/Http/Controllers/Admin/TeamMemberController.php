<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\TeamMember;
use App\Models\TeamSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $team_member = collect();
        $team_members = TeamMember::where('created_by', auth()->id())->get();
        return view('admin.team-members.index', compact('team_members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('created_by', auth()->id())->get();
        return view('admin.team-members.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            // 'email' => 'required',
            'email' => 'required|email|unique:team_members,email',
            'phone' => 'required',
            'birth_date' => 'required',
            // 'services' => 'required',
            'start_date' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = $data['updated_by'] = auth()->id();

        if ($request->has('services')) {
            $data['services'] = implode(',', $request->services);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/team-members');
            $image->move($destinationPath, $name);
            $data['image'] = '/uploads/team-members/' . $name;
        }
        $data['created_by'] = $data['updated_by'] = auth()->user()->id;
        $team = TeamMember::create($data);
        foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day) {
            $schedule = new TeamSchedule();
            $schedule->team_member_id = $team->id;
            $schedule->day_of_week = $day;
            $schedule->start_time = '09:00';
            $schedule->end_time = '17:00';
            $schedule->is_off = 0;
            $schedule->created_by = auth()->id();
            $schedule->updated_by = auth()->id();
            $schedule->save();
        }

        return redirect()->route('team-members.index')->with('success', 'Team Member created successfully');
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
        $team_member = TeamMember::find($id);
        $services = Service::where('created_by', auth()->id())->get();;
        return view('admin.team-members.edit', compact('team_member', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // $team_member = TeamMember::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:team_members,email,' . $id,
            'phone' => 'required',
            'birth_date' => 'required',
            // 'services' => 'required',
            'start_date' => 'required',
        ]);

        $data = $request->all();
        $data['updated_by'] = auth()->id();

        if ($request->has('services')) {
            $data['services'] = implode(',', $request->services);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/team-members');
            $image->move($destinationPath, $name);
            $data['image'] = '/uploads/team-members/' . $name;
        }
        $data['updated_by'] = auth()->user()->id;
        TeamMember::find($id)->update($data);
        return redirect()->route('team-members.index')->with('success', 'Team Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TeamMember::find($id)->delete();
        return response()->json(['status' => 200, 'message' => 'Supplier deleted successfully']);
    }
}
