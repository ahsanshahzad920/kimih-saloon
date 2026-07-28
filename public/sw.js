// --- Firebase Cloud Messaging (push notifications) ---
// These values are the public Firebase Web SDK config (safe to expose
// client-side). A service worker can't read Blade/.env, so they're hardcoded
// here — update them if the Firebase project's web config ever changes.
// Wrapped in try/catch so that until real credentials are filled in (or if
// the CDN/Firebase has any issue), the existing PWA cache logic below is
// never affected — this whole block is best-effort/additive only.
try {
  importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js');
  importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging-compat.js');

  firebase.initializeApp({
    apiKey: "AIzaSyDMk3lM0Bi_Yf0kRHxGmwcDLc6gT6o-3cM",
    authDomain: "feb-21348.firebaseapp.com",
    projectId: "feb-21348",
    storageBucket: "feb-21348.firebasestorage.app",
    messagingSenderId: "757856474560",
    appId: "1:757856474560:web:0e2bae764ad92d0701e425"
  });

  const messaging = firebase.messaging();

  messaging.onBackgroundMessage(function (payload) {
    const title = (payload.notification && payload.notification.title) || 'Notification';
    const options = {
      body: (payload.notification && payload.notification.body) || '',
      icon: '/favicon.ico'
    };
    self.registration.showNotification(title, options);
  });
} catch (e) {
  console.log('Firebase messaging setup skipped/failed in service worker:', e);
}

// --- Existing PWA asset caching (unchanged below) ---
const CACHE_NAME = 'kimih-pwa-v1';
const ASSETS_TO_CACHE = [
  '/',
  '/manifest.json',
  '/assets/css/pwa-responsive.css',
  '/dash-assets/css/bootstrap.min.css',
  '/dash-assets/css/app.min.css'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(ASSETS_TO_CACHE).catch(() => {});
    })
  );
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => {
      return Promise.all(
        keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
      );
    })
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') return;

  event.respondWith(
    fetch(event.request)
      .then((networkResponse) => {
        if (networkResponse && networkResponse.status === 200 && networkResponse.type === 'basic') {
          const responseToCache = networkResponse.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, responseToCache);
          });
        }
        return networkResponse;
      })
      .catch(() => {
        return caches.match(event.request);
      })
  );
});
