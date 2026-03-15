<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthCustomerController extends Controller
{
    public function index()
    {
        return view('admin.auth.customer.login');
    }


    public function signUpIndex($email)
    {
        // dd($email);
        return view('admin.auth.customer.sign-up', compact('email'));
    }


    public function signUp(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|min:10',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        DB::transaction(function () use ($data) {
            $data['email_verified_at'] = now();
            $user = User::create($data);

            $client = Client::create([
                'user_id' => $user->id
            ]);
            if (!$client) {
                throw new \Exception('Failed to create customer account');
            }

            Auth::login($user);

            $user->assignRole('Client');

        });
        return redirect('/')->with('success', 'Customer account created successfully');
    }


}
