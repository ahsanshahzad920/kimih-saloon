<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Client;
use App\Models\User;
use App\Models\SocialLogin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // public function toProvider($driver){
    //     return Socialite::driver($driver)->redirect();
    // }

    // public function handleCallback($driver){
    //     // $user = Socialite::driver($driver)->user();
    //     $user = Socialite::driver($driver)->stateless()->user();
    //     $user_account = SocialLogin::where('provider', $driver)->where('provider_id', $user->getId())->first();

    //     if($user_account){
    //         Auth::login($user_account->user);
    //         session()->regenerate();
    //         return redirect()->intended('/dashboard');
    //     }

    //     $db_user = User::where('email', $user->getEmail())->first();

    //     if($db_user){
    //         SocialLogin::create([
    //             'provider' => $driver,
    //             'provider_id' => $user->getId(),
    //             'user_id' => $db_user->id,
    //         ]);

    //         Auth::login($db_user);
    //         session()->regenerate();
    //         return redirect()->intended('/dashboard');


    //     }else{
    //         $new_user = User::create([
    //             'name' => $user->getName(),
    //             'email' => $user->getEmail(),
    //             'email_verified_at' => now(),
    //             'remember_token' => Str::random(10),
    //             'password' => Hash::make($user->getEmail()),
    //         ]);
    //         $new_user->assignRole('Business User');
    //         Business::create([
    //             'user_id' => $new_user->id,
    //         ]);

    //         SocialLogin::create([
    //             'provider' => $driver,
    //             'provider_id' => $user->getId(),
    //             'user_id' => $new_user->id,
    //         ]);

    //         Auth::login($new_user);
    //         session()->regenerate();
    //         return redirect()->intended('/dashboard');
    //     }

    // }

    public function toProvider($driver, $role)
    {
        session(['role' => $role]); // Store the role in the session
        return Socialite::driver($driver)->redirect();
    }

    public function handleCallback($driver)
    {
        $user = Socialite::driver($driver)->stateless()->user();
        $user_account = SocialLogin::where('provider', $driver)->where('provider_id', $user->getId())->first();
        $role = session('role'); // Retrieve the role from the session

        if ($user_account) {
            Auth::login($user_account->user);
            session()->regenerate();
            // dd($this->redirectTo($user_account->user));
            return redirect()->intended($this->redirectTo($user_account->user));
        }

        $db_user = User::where('email', $user->getEmail())->first();

        if ($db_user) {
            SocialLogin::create([
                'provider' => $driver,
                'provider_id' => $user->getId(),
                'user_id' => $db_user->id,
            ]);

            Auth::login($db_user);
            session()->regenerate();
            return redirect()->intended($this->redirectTo($db_user));
        } else {
            $new_user = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'password' => Hash::make($user->getEmail()),
            ]);

            // Assign the role based on the URL parameter
            if ($role == 'business') {
                $new_user->assignRole('Business User');
                Business::create([
                    'user_id' => $new_user->id,
                ]);
            } else {
                $new_user->assignRole('Client');
                Client::create([
                    'user_id' => $new_user->id,
                ]);
            }

            SocialLogin::create([
                'provider' => $driver,
                'provider_id' => $user->getId(),
                'user_id' => $new_user->id,
            ]);

            Auth::login($new_user);
            session()->regenerate();
            return redirect()->intended($this->redirectTo($new_user));
        }
    }

    protected function redirectTo($user)
    {
        // Redirect based on user role
        if ($user->hasRole('Business User')) {
            return '/dashboard';
        } elseif ($user->hasRole('Client')) {
            return '/';
        }

        // return '/'; // default redirect
    }
}
