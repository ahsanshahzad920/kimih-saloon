<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.clients.index');
    }

    /**
     * Server-side DataTables source for the clients listing.
     */
    public function ajax(Request $request)
    {
        try {
            $query = Client::query()->with('user');

            if (!auth()->user()->hasRole('Admin')) {
                $query->where('created_by', auth()->id());
            }

            return DataTables::of($query)
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search.value');
                    if ($search) {
                        $query->whereHas('user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                    }
                })
                ->addColumn('checkbox', function () {
                    return '<div class="form-check"><input class="form-check-input" type="checkbox" name="chk_child"></div>';
                })
                ->addColumn('client_name', fn($client) => e($client->user->name ?? ''))
                ->addColumn('email', fn($client) => e($client->user->email ?? 'N/A'))
                ->addColumn('phone', fn($client) => '<span class="client-phone">' . e($client->user->phone ?? 'N/A') . '</span>')
                ->addColumn('sales', fn() => '0.00')
                ->addColumn('created_date', fn($client) => $client->created_at?->format('d-m-Y') ?? 'N/A')
                ->addColumn('action', function ($client) {
                    $userId = $client->user->id ?? '';
                    return '<div class="d-flex flex-wrap gap-2">'
                        . '<button type="button" class="btn btn-outline-primary me-2 send-message-btn" data-bs-toggle="modal" data-bs-target="#sendMessageModal">Send Message</button>'
                        . '<div class="edit"><a href="' . route('clients.edit', $userId) . '" class="btn btn-success edit-item-btn">Edit</a></div>'
                        . '<button type="button" class="btn btn-sm btn-danger remove-item-btn delSubBtn" data-id="' . $userId . '">Remove</button>'
                        . '</div>';
                })
                ->rawColumns(['checkbox', 'phone', 'action'])
                ->make(true);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Clients DataTables query failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Unable to load clients right now. Please try again.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'birth_date' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'pronouns' => 'required',
        ]);

        $data = $request->except(['_token', 'image']);
        $data['password'] = \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(16));
        $data['created_by'] = $data['updated_by'] = auth()->id();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = "profile_".time().$image->getClientOriginalName();
            $image->move('uploads/clients',$image_name);
            $data['image'] = $image_name;
        }

        DB::transaction(function () use ($data) {
            $user = User::create($data);
            $data['user_id'] = $user->id;

            $client = Client::create($data);
            if (!$client) {
                throw new \Exception('Failed to create client');
            }

            $user->assignRole('Client');
        });
        return redirect()->route('clients.index')->with('success','Client created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Find the client profile for the given user id, scoped to the current
     * business (unless the caller is an Admin), or fail.
     */
    private function findOwnedClientOrFail(string $userId): Client
    {
        $query = Client::where('user_id', $userId);

        if (!auth()->user()->hasRole('Admin')) {
            $query->where('created_by', auth()->id());
        }

        return $query->firstOrFail();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->findOwnedClientOrFail($id);

        $user = User::findOrFail($id);
        $user->load('client');
        return view('admin.clients.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = $this->findOwnedClientOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'birth_date' => 'required',
            'phone' => 'required',
        ]);

        try {
            $data = $request->except(['_token', '_method']);
            $data['updated_by'] =  auth()->id();
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = "profile_".time().$image->getClientOriginalName();
                $image->move('uploads/clients',$image_name);
                $data['image'] = $image_name;
            }
            $user = User::findOrFail($id);
            $user->update($data);
            $data['user_id'] = $user->id;
            $client->update($data);
            return redirect()->route('clients.index')->with('success','Client updated successfully');
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Client update failed', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'Failed to update client. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->findOwnedClientOrFail($id);

            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['status' => 200 , 'message' => 'Client deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => 404, 'message' => 'Client not found or you do not have permission to delete it.'], 404);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Client delete failed', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['status' => 500, 'message' => 'Failed to delete client. Please try again.'], 500);
        }
    }
}
