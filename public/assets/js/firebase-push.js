(function () {
    if (!('serviceWorker' in navigator) || typeof window.firebaseConfig === 'undefined') return;
    if (!window.firebaseConfig.apiKey) return; // Firebase not configured yet
    if (typeof Notification === 'undefined') return;

    firebase.initializeApp(window.firebaseConfig);
    var messaging = firebase.messaging();

    var DISMISS_KEY = 'fcm_prompt_dismissed_at';
    var DISMISS_DAYS = 7;

    function registerToken() {
        navigator.serviceWorker.ready.then(function (registration) {
            messaging.getToken({
                vapidKey: window.firebaseConfig.vapidKey,
                serviceWorkerRegistration: registration
            }).then(function (token) {
                if (!token) return;
                if (window.localStorage.getItem('fcm_token') === token) return; // already registered, skip redundant request

                var csrf = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/fcm-token',
                    type: 'POST',
                    data: { _token: csrf, token: token },
                    success: function () {
                        window.localStorage.setItem('fcm_token', token);
                    },
                    error: function () {
                        // fail silently — token registration is best-effort
                    }
                });
            }).catch(function (err) {
                console.log('FCM getToken failed:', err);
            });
        });
    }

    function showPrimingBanner() {
        var dismissedAt = window.localStorage.getItem(DISMISS_KEY);
        if (dismissedAt && (Date.now() - parseInt(dismissedAt, 10)) < DISMISS_DAYS * 86400000) return;

        var $banner = $(
            '<div id="fcm-prime-banner" style="position:fixed;right:16px;bottom:16px;left:16px;max-width:360px;' +
            'margin-left:auto;background:#fff;border:1px solid #e5e7eb;border-radius:12px;' +
            'box-shadow:0 8px 24px rgba(0,0,0,.12);padding:16px;z-index:99999;font-size:14px;color:#111827;">' +
            '<div style="display:flex;gap:12px;align-items:flex-start;">' +
            '<i class="fa fa-bell" style="color:#2563eb;font-size:18px;margin-top:2px;"></i>' +
            '<div style="flex:1;">' +
            '<div style="font-weight:600;margin-bottom:4px;">Stay in the loop</div>' +
            '<div style="color:#6b7280;margin-bottom:12px;">Turn on notifications to get updates about your appointments and offers.</div>' +
            '<div style="display:flex;gap:8px;">' +
            '<button type="button" id="fcm-prime-enable" style="background:#2563eb;color:#fff;border:none;' +
            'border-radius:6px;padding:6px 14px;font-size:13px;cursor:pointer;">Enable</button>' +
            '<button type="button" id="fcm-prime-dismiss" style="background:transparent;color:#6b7280;border:none;' +
            'padding:6px 14px;font-size:13px;cursor:pointer;">Not now</button>' +
            '</div></div></div></div>'
        );

        $('body').append($banner);

        $('#fcm-prime-enable').on('click', function () {
            $banner.remove();
            Notification.requestPermission().then(function (permission) {
                if (permission === 'granted') registerToken();
            });
        });

        $('#fcm-prime-dismiss').on('click', function () {
            window.localStorage.setItem(DISMISS_KEY, String(Date.now()));
            $banner.remove();
        });
    }

    $(function () {
        if (Notification.permission === 'granted') {
            registerToken();
        } else if (Notification.permission === 'default') {
            showPrimingBanner();
        }
        // permission === 'denied' — respect it, don't nag
    });

    messaging.onMessage(function (payload) {
        var title = (payload.notification && payload.notification.title) || 'Notification';
        var body = (payload.notification && payload.notification.body) || '';

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'info',
                title: title,
                text: body,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        } else if (typeof Notification !== 'undefined') {
            new Notification(title, { body: body });
        }
    });
})();
