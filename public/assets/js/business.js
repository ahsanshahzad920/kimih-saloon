/* ==========================================================
   KIMIH — for-business page logic
   ========================================================== */
(function () {
  'use strict';
  var K = window.KIMIH, $ = K.$, $$ = K.$$, esc = K.esc, icon = K.icon;

  var DEMO_MODE = true;

  /* ---------------- pricing ---------------- */
  var DEMO_PRICING = [
    { name: 'Starter', price: '$0', period: '/month', featured: false, cta: 'Start free',
      features: ['Public business profile', 'Up to 50 bookings/mo', 'Basic calendar', 'Email support'] },
    { name: 'Growth', price: '$49', period: '/month', featured: true, cta: 'Choose Growth', flag: 'Most popular',
      features: ['Everything in Starter', 'Unlimited bookings', 'Automated reminders', 'Featured in search', 'Priority support'] },
    { name: 'Pro Salon', price: '$89', period: '/month', featured: false, cta: 'Choose Pro',
      features: ['Everything in Growth', 'Staff scheduling', 'Online payments & POS', 'SMS reminders', 'Analytics report'] },
    { name: 'Studio', price: '$149', period: '/month', featured: false, cta: 'Talk to sales',
      features: ['Everything in Pro', 'Multiple locations', 'Dedicated manager', 'API access & CRM', 'Custom branding'] }
  ];
  var PRICING = DEMO_MODE ? DEMO_PRICING : [];

  (function () {
    var row = $('#pricingRow'); if (!row) return;
    if (!PRICING.length) {
      $('#pricing').style.display = 'none';
      return;
    }
    var colClass = (PRICING.length >= 4) ? 'col-md-6 col-lg-3' : 'col-md-6 col-lg-4';
    row.innerHTML = PRICING.map(function (p) {
      return '<div class="' + colClass + '"><div class="price-card' + (p.featured ? ' featured' : '') + '">' +
        (p.flag ? '<span class="price-flag">' + esc(p.flag) + '</span>' : '') +
        '<h3 class="h-card">' + esc(p.name) + '</h3>' +
        '<div class="price-amt">' + esc(p.price) + '<small>' + esc(p.period || '') + '</small></div>' +
        '<ul style="list-style:none !important; padding:0 !important; margin:0 0 28px !important; display:flex !important; flex-direction:column !important; flex-grow:1 !important;">' + (p.features || []).map(function (f) {
          return '<li style="display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:10px !important; margin-bottom:10px !important; line-height:1.4 !important; font-size:.92rem !important; color:var(--ink) !important;">' +
                   '<span style="display:inline-flex !important; align-items:center !important; justify-content:center !important; width:18px !important; height:18px !important; min-width:18px !important; border-radius:50% !important; background:var(--violet-soft, #EDE6FB) !important; color:var(--violet, #6D28D9) !important; flex-shrink:0 !important; margin-top:2px !important;">' +
                     '<svg class="ic" style="width:11px !important; height:11px !important; stroke-width:2.5 !important; display:block !important; margin:0 !important;"><use href="#i-check"/></svg>' +
                   '</span>' +
                   '<span style="flex:1 1 auto !important; display:block !important; text-align:left !important;">' + esc(f) + '</span>' +
                 '</li>';
        }).join('') + '</ul>' +
        '<a href="/register" class="btn-k ' + (p.featured ? 'btn-primary-k' : 'btn-outline-k') + ' mt-auto">' +
        esc(p.cta || 'Choose plan') + '</a></div></div>';
    }).join('');
  })();

  /* ---------------- FAQ ---------------- */
  var FAQS = [
    { q: 'How much does Kimih cost?',
      a: '<p>There is a free Starter plan with a public profile and up to 50 bookings a month. Paid plans add unlimited bookings, automated reminders and featured placement in local search. Full details are in the <a href="#pricing">pricing</a> section above.</p>' },
    { q: 'How long does it take to get set up?',
      a: '<p>Most businesses are live the same afternoon. You add your services and prices, set your opening hours and team availability, upload a few photos, and your profile is ready to take bookings. If you already have a service list, setup usually takes under an hour.</p>' },
    { q: 'Can I keep taking walk-ins and phone bookings?',
      a: '<p>Yes. Kimih sits alongside how you already work. You can block time in the calendar for walk-ins, add phone bookings manually, and control exactly how much of your day is bookable online.</p>' },
    { q: 'How does Kimih reduce no-shows?',
      a: '<p>Every customer gets an instant confirmation plus automatic reminders before the appointment, by push notification, email or SMS. You can also set a cancellation window and require deposits on higher-value services.</p>' },
    { q: 'Can I manage a team or more than one location?',
      a: '<p>Yes. Add team members with their own calendars, services and working hours, and customers can pick who they book with. Multiple locations are supported on the Studio plan, each with its own address, hours and staff.</p>' },
    { q: 'Who owns my client data?',
      a: '<p>You do. Your client list, booking history and business data belong to your business, and you can export them at any time. Kimih does not sell your customer list to other businesses.</p>' },
    { q: 'What if I want to leave?',
      a: '<p>There is no lock-in contract. You can cancel a paid plan at any time and drop back to the free plan or close your account entirely, and export your data on the way out.</p>' },
    { q: 'How do I get paid?',
      a: '<p>You can take payment in the salon as you do today, or accept online payments and deposits through Kimih. Where online payments are enabled, earnings appear in your dashboard with a clear payout schedule.</p>' }
  ];

  (function () {
    var el = $('#faqList'); if (!el) return;
    el.innerHTML = FAQS.map(function (f, i) {
      return '<div class="faq-item' + (i === 0 ? ' open' : '') + '">' +
        '<button class="faq-q" type="button" aria-expanded="' + (i === 0) + '">' + esc(f.q) + icon('i-plus') + '</button>' +
        '<div class="faq-a"><div class="inner">' + f.a + '</div></div></div>';
    }).join('');
    $$('.faq-q', el).forEach(function (q) {
      q.addEventListener('click', function () {
        var item = q.parentElement;
        item.classList.toggle('open');
        q.setAttribute('aria-expanded', String(item.classList.contains('open')));
      });
    });
  })();

  /* ---------------- dashboard chart + 3D tilt ---------------- */
  (function () {
    var stage = $('#stage'), inner = $('#stageInner'), dash = $('#dash'), phone = $('#phone');
    if (!stage) return;

    var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var APPTS  = [87, 98, 68, 110, 78, 84, 50, 28, 92, 41, 89, 34];
    var SALES  = [35, 60, 48, 62, 50, 55, 40, 43, 72, 52, 64, 66];
    var REFUND = [8, 10, 12, 14, 18, 20, 15, 12, 10, 14, 16, 20];

    var chart = $('#chart');
    if (chart) {
      var W = 560, H = 210, PL = 34, PR = 8, PT = 8, PB = 22;
      var pw = W - PL - PR, ph = H - PT - PB, MAXY = 120;
      var x = function (i) { return PL + pw / MONTHS.length * (i + 0.5); };
      var y = function (v) { return PT + ph - (v / MAXY) * ph; };
      var pts = function (a) {
        return a.map(function (v, i) { return x(i).toFixed(1) + ',' + y(v).toFixed(1); }).join(' ');
      };
      var grid = [0, 30, 60, 90, 120].map(function (g) {
        return '<text x="' + (PL - 6) + '" y="' + (y(g) + 3).toFixed(1) + '" text-anchor="end" font-size="7" fill="#B5AFC2">' + g.toFixed(2) + '</text>';
      }).join('');
      var ticks = MONTHS.map(function (m, i) {
        return '<line x1="' + x(i).toFixed(1) + '" y1="' + PT + '" x2="' + x(i).toFixed(1) + '" y2="' + (PT + ph) + '" stroke="#F2EFF7" stroke-width="1"/>' +
          '<text x="' + x(i).toFixed(1) + '" y="' + (H - 7) + '" text-anchor="middle" font-size="7" fill="#9A94A8">' + m + '</text>';
      }).join('');
      var bars = APPTS.map(function (v, i) {
        return '<rect x="' + (x(i) - 5).toFixed(1) + '" y="' + y(v).toFixed(1) + '" width="10" rx="3" height="' + (PT + ph - y(v)).toFixed(1) + '" fill="url(#barg)"/>';
      }).join('');
      chart.innerHTML =
        '<svg class="chart-svg" viewBox="0 0 ' + W + ' ' + H + '" role="img" aria-label="Recent sales chart">' +
        '<defs><linearGradient id="barg" x1="0" y1="0" x2="0" y2="1">' +
        '<stop offset="0" stop-color="#C13BF0"/><stop offset="1" stop-color="#7C3AED"/></linearGradient>' +
        '<linearGradient id="areag" x1="0" y1="0" x2="0" y2="1">' +
        '<stop offset="0" stop-color="#F4D9F5" stop-opacity=".85"/>' +
        '<stop offset="1" stop-color="#FBF3FA" stop-opacity=".2"/></linearGradient></defs>' +
        grid + ticks +
        '<polygon points="' + PL + ',' + (PT + ph) + ' ' + pts(SALES) + ' ' + (PL + pw) + ',' + (PT + ph) + '" fill="url(#areag)"/>' +
        bars +
        '<polyline points="' + pts(SALES) + '" fill="none" stroke="#8B2FE0" stroke-width="1.8" stroke-linejoin="round"/>' +
        '<polyline points="' + pts(REFUND) + '" fill="none" stroke="#7C3AED" stroke-width="1.6" stroke-dasharray="5 4" stroke-linejoin="round"/>' +
        '</svg>';
    }

    var reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
    var BASE_W = 980, BASE_H = 660, M_W = 304, M_H = 590;

    function fit() {
      var mobile = innerWidth < 768;
      var bw = mobile ? M_W : BASE_W, bh = mobile ? M_H : BASE_H;
      inner.style.width = bw + 'px';
      inner.style.height = bh + 'px';
      var s = Math.min(1, stage.clientWidth / bw);
      inner.style.transform = 'scale(' + s + ')';
      stage.style.height = (bh * s) + 'px';
    }

    function tilt() {
      if (reduce || innerWidth < 768) {
        if (dash) {
          dash.style.setProperty('--rx', '0deg');
          dash.style.setProperty('--ry', '0deg');
        }
        return;
      }
      var r = stage.getBoundingClientRect();
      var raw = (innerHeight - r.top) / (innerHeight * 0.85);
      var t = 1 - Math.min(1, Math.max(0, raw));
      if (dash) {
        dash.style.setProperty('--rx', (9 * t).toFixed(2) + 'deg');
        dash.style.setProperty('--ry', (-13 * t).toFixed(2) + 'deg');
      }
      if (phone) {
        phone.style.setProperty('--py', (46 * t).toFixed(1) + 'px');
        phone.style.setProperty('--pry', (-9 * t).toFixed(2) + 'deg');
      }
    }

    var ticking = false;
    addEventListener('scroll', function () {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(function () { tilt(); ticking = false; });
    }, { passive: true });

    fit();
    tilt();
    addEventListener('resize', fit);
  })();
})();
