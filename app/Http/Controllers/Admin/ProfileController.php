<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.profile.index');
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
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            // 'username' => 'required|string|unique:users,username,' . auth()->user()->id,
            // 'contact_no' => 'required',
        ]);

        // if($req->hasFile('img'))
        // {
        //     $file = $req->file('img');
        //     $filename = "profileImg".rand(1111,9999).'.'.$file->extension();
        //     $file->storeAs('public/images/profile',$filename);

        //     $name = $req->first_name;

        //     if($req->last_name){
        //         $name = $req->first_name.' '.$req->last_name;
        //     }
        //     $data = $req->all();
        //     $image = "/images/profile/".$filename;

        //     $data['image'] = $image;
        //     $data['name'] = $name;

        //     $user = User::find(auth()->user()->id);
        //     $user->update($data);
        //     return redirect()->back()->with('success','Profile Updated Successfully!');
        // }
        // else
        // {
        $name = $req->first_name;

        if ($req->last_name) {
            $name = $req->first_name . ' ' . $req->last_name;
        }
        $data = $req->all();
        $data['name'] = $name;
        $user = User::find(auth()->user()->id);
        $user->update($data);
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
        // }
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

        return redirect()->back()->with('success', 'Password updated successfully.');
    }


    public function updateProfileImage(Request $req, $id)
    {
        // dd($req->all());
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
