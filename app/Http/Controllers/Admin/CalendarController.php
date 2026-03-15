<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\TeamMember;
use Illuminate\Support\Str;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $team_members = auth()->user()->teamMember;
        // $services = auth()->user()->services;
        $services = Service::where('created_by',auth()->id())->get();
        $team_members = TeamMember::where('created_by',auth()->id())->get();
        $clientRole = Role::where('name', 'Client')->first();

        // $users = $clientRole ? $clientRole->users : collect();
        if ($clientRole) {
            $clients = $clientRole->users()->orderBy('created_at', 'desc')->get();
        } else {
            $clients = collect();
        }

        return view('admin.calendar.index',compact('services','team_members','clients',));
    }


    public function getAppointments(){
        $appointments = Appointment::with('services')->where('created_by',auth()->id())->get();

        // Format the data for FullCalendar
        $events = $appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->title, // Adjust according to your appointment title field
                'start' => $appointment->start, // Adjust according to your appointment start field
                'end' => $appointment->end,     // Adjust according to your appointment end field
                'description' => $appointment->description, // Adjust according to your appointment description field
                'location' => $appointment->location,       // Adjust according to your appointment location field
                'className' => $appointment->color,      // Adjust according to your appointment category field
                'services' => $appointment->services->map(function ($service) {
                    return [
                        'id' => $service->id,
                        'service_id' => $service->service_id,
                        'price' => $service->price,
                        'serviceDetails' => $service->service,
                    ];
                }),
                'team_member' => $appointment->teamMember,
                'client' => $appointment->client,
                'status' => $appointment->status,
            ];
        });

        return response()->json($events);
    }


    public function updateAppointment(Request $request,$eventId){
        $data = $request->all();
        // dd($data);
        if($request->input('services')){
            $data['service_ids'] = implode(',', $data['services']);
            $data['start'] = date('Y-m-d H:i:s', strtotime($data['start']));
            $data['end'] = date('Y-m-d H:i:s', strtotime($data['end']));
            $data['updated_by'] = auth()->id();
            $appointment = Appointment::find($eventId);
            $appointment->update($data);
            // delete appointment services and add new services
            $appointment->services()->delete();
            $data['grand_total'] = 0;
            $services = $request->services;
            foreach ($services as $service) {
                $service = Service::find($service);
                $appointment->services()->create([
                    'service_id' => $service->id,
                    'price' => $service->price ?? 0
                ]);
                $data['grand_total'] += $service->price;
            }

            $appointment->update(['grand_total' => $data['grand_total']]);
            // Format the appointment data
        }
        else {
            $data['start'] = date('Y-m-d H:i:s', strtotime($data['start']));
            $data['end'] = date('Y-m-d H:i:s', strtotime($data['end']));
            $appointment = Appointment::find($eventId);
            $appointment->update($data);
        }


        $event = [
            'id' => $appointment->id,
            'title' => $appointment->title,
            'start' => $appointment->start,
            'end' => $appointment->end,
            'description' => $appointment->description,
            'location' => $appointment->location,
            'className' => $appointment->color,
            'services' => $appointment->services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'service_id' => $service->service_id,
                    'price' => $service->price,
                    'serviceDetails' => $service->service, // Detailed service information
                ];
            }),
            'team_member' => $appointment->teamMember,
            'client' => $appointment->client,
            'status' => $appointment->status,
        ];

        return response()->json(['status' => 200,'message' => 'Appointment updated successfully.','event' => $event]);


    }


    public function deleteAppointment($eventId){
        $appointment = Appointment::find($eventId);
        if($appointment){
            $appointment->delete();
            return response()->json(['status' => 200,'message' => 'Appointment deleted successfully!']);
        }
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
        // dd($data);
        $data['service_ids'] = implode(',', $data['services']);
        $data['start'] = date('Y-m-d H:i:s', strtotime($data['start']));
        $data['end'] = date('Y-m-d H:i:s', strtotime($data['end']));
        $data['status'] = 'Booked';
        $data['payment_status'] = 'unpaid';
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;
        $data['deleted_by'] = auth()->user()->id;
        $data['grand_total'] = 0;
        $data['ref'] = 'AP-'.rand(111111,999999);
        // dd($data);
        $appointment = Appointment::create($data);

        $services = $request->services;
        // foreach ($services as $service) {
        //     $service = Service::find($service);
        //     $appointment->services()->attach($service->id, ['price' => $service->price ?? 0]);
        //     $data['grand_total'] += $service->price;
        // }
        foreach ($services as $service) {
            $service = Service::find($service);
            $appointment->services()->create([
                'service_id' => $service->id,
                'price' => $service->price ?? 0
            ]);
            $data['grand_total'] += $service->price;
        }

        $appointment->update(['grand_total' => $data['grand_total']]);

        // Format the appointment data
        $event = [
            'id' => $appointment->id,
            'title' => $appointment->title,
            'start' => $appointment->start,
            'end' => $appointment->end,
            'description' => $appointment->description,
            'location' => $appointment->location,
            'className' => $appointment->color,
            'services' => $appointment->services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'service_id' => $service->service_id,
                    'price' => $service->price,
                    'serviceDetails' => $service->service, // Detailed service information
                ];
            }),
            'team_member' => $appointment->teamMember,
            'client' => $appointment->client,
            'status' => $appointment->status,
        ];


        return response()->json(['status' => 200,'message' => 'Appointment created successfully.','event' => $event]);

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
