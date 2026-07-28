<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Exception\Messaging\InvalidArgument;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class PushNotificationService
{
    public function __construct(private Messaging $messaging)
    {
    }

    /**
     * Send a push notification to every device this user has registered.
     * Never throws — a Firebase problem must never break the calling flow
     * (booking, broadcast, etc). Stale/unregistered tokens are pruned.
     */
    public function sendToUser(User $user, string $title, string $body, array $data = []): void
    {
        foreach ($user->fcmTokens as $tokenRow) {
            $message = CloudMessage::withTarget('token', $tokenRow->token)
                ->withNotification(FirebaseNotification::create($title, $body))
                ->withData($data);

            try {
                $this->messaging->send($message);
            } catch (NotFound|InvalidArgument $e) {
                // Token is stale/unregistered/invalid — prune it so we stop trying.
                $tokenRow->delete();
            } catch (\Throwable $e) {
                Log::warning('FCM send failed: ' . $e->getMessage());
            }
        }
    }
}
