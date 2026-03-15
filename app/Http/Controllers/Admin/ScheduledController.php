<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\TeamMember;
use App\Models\TeamSchedule;

class ScheduledController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $startOfWeek = Carbon::now()->startOfWeek();
        // $endOfWeek = Carbon::now()->endOfWeek();

        // $teamMembers = TeamMember::with(['shifts' => function($query) use ($startOfWeek, $endOfWeek) {
        //     $query->whereBetween('shift_date', [$startOfWeek, $endOfWeek]);
        // }])->where('created_by',auth()->id())->get();

        $teamMembers = TeamMember::where('created_by', auth()->id())->get();
        return view('admin.scheduled-shift.index', compact('teamMembers',));
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
        $data = $request->all();
        $data['start_time'] = Carbon::parse($request->start_time)->format('H:i');
        $data['end_time'] = Carbon::parse($request->end_time)->format('H:i');
        // dd($data);
        $schedule = TeamSchedule::where('team_member_id', $data['team_member_id'])
            ->where('day_of_week', $data['day_of_week'])
            ->first();

        if ($schedule) {
            $schedule->update([
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'is_off' => false,
            ]);
        } else {
            TeamSchedule::create([
                'team_member_id' => $data['team_member_id'],
                'day_of_week' => $data['day_of_week'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'is_off' => false,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        }

        return response()->json(['status' => 200, 'message' => 'Schedule added successfully']);
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
        $data = $request->all();
        $data['start_time'] = Carbon::parse($request->start_time)->format('H:i');
        $data['end_time'] = Carbon::parse($request->end_time)->format('H:i');
        // dd($data);

        $schedule = TeamSchedule::find($id);
        $schedule->update($data);
        return response()->json(['status' => 200, 'message' => 'Schedule updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $schedule = TeamSchedule::find($id);
        $schedule->delete();
        return response()->json(['status' => 200, 'message' => 'Schedule deleted successfully']);
    }


    public function addShift(Request $request)
    {

        $request->validate([
            'team_member_id' => 'required',
            'shift_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $data = $request->all();

        $shift = Shift::create($data);

        $shift->teamMembers()->attach($request->team_member_id, [
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);
        return response()->json(['status' => 200, 'message' => 'Shift added successfully']);
    }

    public function editShift(Request $request)
    {

        $request->validate([
            'team_member_id' => 'required',
            'shift_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $data = $request->all();

        $shift = Shift::find($request->shift_id);
        $shift->update($data);

        $shift->teamMembers()->sync([$request->team_member_id => [
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]]);

        return response()->json(['status' => 200, 'message' => 'Shift updated successfully']);
    }

    public function deleteShift($id)
    {
        Shift::find($id)->delete();
        return response()->json(['status' => 200, 'message' => 'Shift deleted successfully']);
    }
}
