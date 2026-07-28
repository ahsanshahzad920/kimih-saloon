<?php

namespace App\Http\Controllers;

use App\Models\FcmToken;
use Illuminate\Http\Request;

class FcmTokenController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 401], 401);
        }

        $request->validate(['token' => 'required|string']);

        FcmToken::updateOrCreate(
            ['user_id' => auth()->id(), 'token' => $request->token],
            []
        );

        return response()->json(['status' => 200]);
    }
}
