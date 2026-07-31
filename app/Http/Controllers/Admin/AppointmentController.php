<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Check if the authenticated user has the role 'Admin'
        if (auth()->user()->hasRole('Admin')) {
            $team_members = User::with(['teamMember'])->get();
            $services = Service::all();
            $clientRole = Role::where('name', 'Client')->first();
            $clients = $clientRole ? $clientRole->users : collect();
        } else {
            $team_members = auth()->user()->teamMember;
            $services = auth()->user()->services()->where('is_active', true)->get();
            $clientRole = Role::where('name', 'Client')->first();
            $clients = $clientRole ? $clientRole->users : collect();
        }

        return view('admin.appointment.index', compact('clients', 'services', 'team_members'));
    }

    /**
     * Server-side DataTables source for the appointments listing.
     */
    public function ajax(Request $request)
    {
        try {
            $query = Appointment::query()->with(['client', 'teamMember', 'userCreatedBy', 'services.service']);

            if (!auth()->user()->hasRole('Admin')) {
                $query->where('created_by', auth()->id());
            }

            return DataTables::of($query)
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search.value');
                    if ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('ref', 'like', "%{$search}%")
                                ->orWhere('title', 'like', "%{$search}%")
                                ->orWhere('status', 'like', "%{$search}%")
                                ->orWhereHas('client', fn($q) => $q->where('name', 'like', "%{$search}%"))
                                ->orWhereHas('teamMember', fn($q) => $q->where('name', 'like', "%{$search}%"));
                        });
                    }
                })
                ->addColumn('client_name', fn($appointment) => e($appointment->client->name ?? 'N/A'))
                ->addColumn('services_list', function ($appointment) {
                    return $appointment->services
                        ->map(fn($item) => e($item->service->service_name ?? 'N/A'))
                        ->implode('<br>');
                })
                ->addColumn('created_by_name', fn($appointment) => e($appointment->userCreatedBy->name ?? 'N/A'))
                ->addColumn('created_date', fn($appointment) => $appointment->created_at?->format('d-m-Y') ?? 'N/A')
                ->addColumn('duration', function ($appointment) {
                    if (!$appointment->start || !$appointment->end) {
                        return 'N/A';
                    }
                    $start = \Carbon\Carbon::parse($appointment->start);
                    $end = \Carbon\Carbon::parse($appointment->end);
                    return $start->diff($end)->format('%H:%I');
                })
                ->addColumn('team_member_name', fn($appointment) => e($appointment->teamMember->name ?? 'N/A'))
                ->addColumn('status_badge', function ($appointment) {
                    $status = e($appointment->status ?? 'N/A');
                    return '<span class="badge bg-success-subtle text-success text-uppercase">' . $status . '</span>';
                })
                ->addColumn('action', function ($appointment) {
                    return '<div class="d-flex flex-wrap gap-2">'
                        . '<div class="edit"><a href="#" class="btn btn-sm btn-success edit-item-btn" data-appointment-details=\'' . e($appointment->toJson()) . '\'>Edit</a></div>'
                        . '<button type="button" class="btn btn-sm btn-danger remove-item-btn delSubBtn" data-id="' . $appointment->id . '">Remove</button>'
                        . '</div>';
                })
                ->rawColumns(['services_list', 'status_badge', 'action'])
                ->make(true);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Appointments DataTables query failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Unable to load appointments right now. Please try again.'], 500);
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
