<?php

// Public Firebase Web SDK config — safe to expose client-side per Firebase's
// own docs (these are not secrets; access is controlled by Firebase Security
// Rules / Cloud Messaging's own auth, not by hiding these values).
return [
    'apiKey' => env('FIREBASE_WEB_API_KEY'),
    'authDomain' => env('FIREBASE_WEB_AUTH_DOMAIN'),
    'projectId' => env('FIREBASE_WEB_PROJECT_ID'),
    'storageBucket' => env('FIREBASE_WEB_STORAGE_BUCKET'),
    'messagingSenderId' => env('FIREBASE_WEB_MESSAGING_SENDER_ID'),
    'appId' => env('FIREBASE_WEB_APP_ID'),
    'vapidKey' => env('FIREBASE_WEB_VAPID_KEY'),
];
