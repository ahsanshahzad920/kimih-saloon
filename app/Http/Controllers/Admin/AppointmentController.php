<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        // Check if the authenticated user has the role 'Admin'
        if (auth()->user()->hasRole('Admin')) {
            // Fetch all appointments, clients, services, and team members
            $appointments = Appointment::all();
            $team_members = User::with(['teamMember'])->get();
            $services = Service::all();
            $clientRole = Role::where('name', 'Client')->first();
            $clients = $clientRole ? $clientRole->users : collect();
        } else {
            // Fetch only the appointments, clients, services, and team members related to the authenticated user
            $appointments = Appointment::where('created_by', auth()->id())->get();
            $team_members = auth()->user()->teamMember;
            $services = auth()->user()->services;
            $clientRole = Role::where('name', 'Client')->first();
            $clients = $clientRole ? $clientRole->users : collect();
        }

        return view('admin.appointment.index', compact('appointments', 'clients', 'services', 'team_members'));
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
