<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Services\PushNotificationService;
use Illuminate\Http\Request;

class BroadcastNotificationController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('Business User')) {
            abort(403);
        }

        $recipientCount = $this->reachableCustomers()->count();

        return view('admin.broadcast-notification.index', compact('recipientCount'));
    }

    public function send(Request $request)
    {
        if (!auth()->user()->hasRole('Business User')) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $customers = $this->reachableCustomers()->get();

        if ($customers->isEmpty()) {
            return redirect()->route('broadcast-notification.index')
                ->with('error', 'No customers have notifications enabled yet — nothing was sent.');
        }

        try {
            $pushService = app(PushNotificationService::class);
            foreach ($customers as $customer) {
                $pushService->sendToUser($customer, $request->title, $request->message);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Broadcast push notification failed: ' . $e->getMessage());
        }

        return redirect()->route('broadcast-notification.index')
            ->with('success', 'Notification sent to ' . $customers->count() . ' customer(s) with notifications enabled.');
    }

    /**
     * Customers who booked with this business AND have at least one
     * registered device — the ones a broadcast can actually reach.
     */
    private function reachableCustomers()
    {
        $customerIds = Appointment::where('created_by', auth()->id())
            ->distinct()
            ->pluck('client_id');

        return User::whereIn('id', $customerIds)->whereHas('fcmTokens');
    }
}
