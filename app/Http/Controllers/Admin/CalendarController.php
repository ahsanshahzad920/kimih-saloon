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


    /**
     * Find the appointment for the given id, scoped to the current business
     * (unless the caller is an Admin), or fail.
     */
    private function findOwnedAppointmentOrFail($eventId): Appointment
    {
        $query = Appointment::query();

        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }

        return $query->findOrFail($eventId);
    }

    public function updateAppointment(Request $request,$eventId){
        try {
            $appointment = $this->findOwnedAppointmentOrFail($eventId);

            $validated = $request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:500',
                'start' => 'required|date',
                'end' => 'required|date|after_or_equal:start',
                'color' => 'nullable|string',
                'status' => 'nullable|string',
                'client_id' => 'nullable|exists:users,id',
                'team_member_id' => 'nullable|exists:team_members,id',
                'services' => 'sometimes|array',
                'services.*' => 'exists:services,id',
            ]);

            $data = [
                'title' => $validated['title'] ?? $appointment->title,
                'description' => $validated['description'] ?? null,
                'location' => $validated['location'] ?? null,
                'start' => date('Y-m-d H:i:s', strtotime($validated['start'])),
                'end' => date('Y-m-d H:i:s', strtotime($validated['end'])),
                'color' => $validated['color'] ?? $appointment->color,
                'status' => $validated['status'] ?? $appointment->status,
                'updated_by' => auth()->id(),
            ];

            if (!empty($validated['client_id'])) {
                $data['client_id'] = $validated['client_id'];
            }
            if (!empty($validated['team_member_id'])) {
                $data['team_member_id'] = $validated['team_member_id'];
            }

            if (!empty($validated['services'])) {
                $data['service_ids'] = implode(',', $validated['services']);
                $appointment->update($data);

                // Rebuild appointment services and recompute grand total
                $appointment->services()->delete();
                $grandTotal = 0;
                foreach ($validated['services'] as $serviceId) {
                    $service = Service::find($serviceId);
                    if (!$service) {
                        continue;
                    }
                    $appointment->services()->create([
                        'service_id' => $service->id,
                        'price' => $service->price ?? 0,
                    ]);
                    $grandTotal += $service->price ?? 0;
                }
                $appointment->update(['grand_total' => $grandTotal]);
            } else {
                $appointment->update($data);
            }

            $appointment->refresh();

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
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 404, 'message' => 'Appointment not found or you do not have permission to update it.'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['status' => 422, 'message' => $e->getMessage(), 'errors' => $e->errors()], 422);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Appointment update failed', ['id' => $eventId, 'error' => $e->getMessage()]);
            return response()->json(['status' => 500, 'message' => 'Failed to update appointment. Please try again.'], 500);
        }
    }


    public function deleteAppointment($eventId){
        try {
            $appointment = $this->findOwnedAppointmentOrFail($eventId);
            $appointment->delete();
            return response()->json(['status' => 200,'message' => 'Appointment deleted successfully!']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 404, 'message' => 'Appointment not found or you do not have permission to delete it.'], 404);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Appointment delete failed', ['id' => $eventId, 'error' => $e->getMessage()]);
            return response()->json(['status' => 500, 'message' => 'Failed to delete appointment. Please try again.'], 500);
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
