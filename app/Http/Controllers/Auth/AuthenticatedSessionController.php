<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    public function emailCheck(Request $request){
        // dd($request->all());

        $user = User::where('email',$request->email)->first();

        // $user = User::role($request->role)->where('email',$request->email)->first();

        if($user){
            $role = $user->getRoleNames()->first();
            return response()->json(['status' => 200, 'message' => 'User found','email' => $user->email,'name' => $user->name,'id' => $user->id,'role' => $role]);
        }else{
            return response()->json(['status' => 402, 'message' => 'User not found']);
        }
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if(Auth::user()->hasRole('Client')){

                // $url = url()->previous() ? url()->previous() : '/';
                // redirect()->intended('/')->getTargetUrl();

                return Response::json(['status' => 200, 'redirect' => '/']);
            }

            return Response::json(['status' => 200, 'redirect' => route('dashboard')]);
        }

        // Authentication failed...
        return Response::json(['status' => 402, 'error' => 'Credentials do not match our records.'], 401);
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
