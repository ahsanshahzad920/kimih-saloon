<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.send-sms.index');
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
        $request->validate([
            'phone' => 'required',
            'message' => 'required|string|max:255',
        ]);

        try {
            $user = auth()->user();
            $isBusinessUser = $user->hasRole('Business User');
            $messageCost = $isBusinessUser ? 1.0 : 0.0;

            if ($isBusinessUser && $user->balance < $messageCost) {
                return redirect()->back()->with('error', 'Please Recharge Your wallet!');
            }

            $this->sendSms($request->phone, $request->message);

            if ($isBusinessUser) {
                DB::beginTransaction();
                $newBalance = $user->balance - $messageCost;
                $user->update(['balance' => $newBalance]);
                DB::commit();
            }

            return redirect()->back()->with('success', 'SMS sent successfully!');
        } catch (\Exception $e) {
            if (isset($newBalance)) {
                DB::rollBack();
            }
            Log::error('Failed to send SMS: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send SMS: ' . $e->getMessage());
        }
    }

    private function sendSms($phone, $message)
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $twilioPhone = config('services.twilio.from');

        $twilio = new Client($sid, $token);
        $twilio->messages->create($phone, [
            "body" => $message,
            "from" => $twilioPhone,
        ]);
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
