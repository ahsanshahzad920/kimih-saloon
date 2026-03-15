<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessAcountSetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd("inside");
        // Check if the user is authenticated
        if (auth()->check()) {
            // Check if the user has the "Business User" role
            if (auth()->user()->hasRole('Business User')) {
                // Check if the associated business column is not null

                if (auth()->user()->businessUser && auth()->user()->businessUser->business_name !== null) {
                    return $next($request);
                } else {
                    // Redirect to account setup route
                    return redirect()->route('business.setup');
                }
            }
        }
        return $next($request);
    }
}
