<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::where('user_id', auth()->user()->id)->first();
        return view('user.profile.index',compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function deleteImage($id)
    {
        $user = User::find($id);
        // if(file_exists("public/storage".$profile->img))
        // {
        //     unlink(public/storage".$profile->img);
        // }
        $user->update(['image' => null]);
        return redirect()->route('profile.index')->with('success', 'Profile image deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {

        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ]);

        $data = $req->all();
        $user = User::find(auth()->user()->id);
        $user->update($data);
        $client = Client::where('user_id',auth()->id())->first();
        $client->update($data);
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        // $user = auth()->user();
        $user = User::find(auth()->user()->id);


        if (!Hash::check($data['current_password'], $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect!');
        }

        $updated = $user->update([
            'password' => Hash::make($data['password']),
        ]);

        if (!$updated) {
            return redirect()->back()->with('error', 'Password failed to update!');
        }

        return redirect()->route('profile.index')->with('success', 'Password updated successfully.');
    }


    public function updateProfileImage(Request $req, $id)
    {
        $req->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find($id);
        if ($req->hasFile('img')) {
            $file = $req->file('img');
            $filename = "profileImg" . rand(1111, 9999) . '.' . $file->extension();
            $file->storeAs('public/images/profile', $filename);
            

            $user->update(['image' => "/images/profile/" . $filename]);
            return response()->json(['status' => 200, 'success' => 'Profile image updated successfully!']);
        }
    }
}
