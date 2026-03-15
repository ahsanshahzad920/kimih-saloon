<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('Admin')) {
            $clients = Client::all();
        }else{
            $clients = Client::where('created_by',auth()->id())->get();
        }   
        return view('admin.clients.index',compact('clients'));
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

        $data = $request->all();
        $data['password'] = bcrypt('12345678');
        $data['created_by'] = $data['updated_by'] =  auth()->id();
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $user->load('client');
        return view('admin.clients.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'birth_date' => 'required',
            'phone' => 'required',
        ]);

        $data = $request->all();
        $data['updated_by'] =  auth()->id();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = "profile_".time().$image->getClientOriginalName();
            $image->move('uploads/clients',$image_name);
            $data['image'] = $image_name;
        }
        $user = User::find($id);
        $user->update($data);
        $data['user_id'] = $user->id;
        $client = Client::where('user_id',$id)->first();
        $client->update($data);
        return redirect()->route('clients.index')->with('success','Client updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        // return redirect()->route('clients.index')->with('success','Client deleted successfully');

        return response()->json(['status' => 200 , 'message' => 'Client deleted successfully']);
    }
}
