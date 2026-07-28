/* ==========================================================
   KIMIH — content + page logic
   ========================================================== */
(function () {
  'use strict';
  var K = window.KIMIH, $ = K.$, $$ = K.$$, esc = K.esc, icon = K.icon;

  var DEMO_MODE = true;

  /* ---------------- data ---------------- */
  var CATEGORIES = [
    { id: 'hair',     label: 'Hair',     icon: 'i-scissors', count: '142 places', img: 'assets/img/cat-hair.jpg',     alt: 'Hair styling' },
    { id: 'barber',   label: 'Barber',   icon: 'i-barber',   count: '98 places',  img: 'assets/img/cat-barber.jpg',   alt: 'Barbering' },
    { id: 'nails',    label: 'Nails',    icon: 'i-nail',     count: '76 places',  img: 'assets/img/cat-nails.jpg',    alt: 'Nail services' },
    { id: 'spa',      label: 'Spa',      icon: 'i-spa',      count: '54 places',  img: 'assets/img/cat-spa.jpg',      alt: 'Spa treatments' },
    { id: 'massage',  label: 'Massage',  icon: 'i-massage',  count: '61 places',  img: 'assets/img/cat-massage.jpg',  alt: 'Massage therapy' },
    { id: 'makeup',   label: 'Makeup',   icon: 'i-makeup',   count: '47 places',  img: 'assets/img/cat-makeup.jpg',   alt: 'Makeup artistry' },
    { id: 'skincare', label: 'Skincare', icon: 'i-skincare', count: '39 places',  img: 'assets/img/cat-skincare.jpg', alt: 'Skincare and facials' },
    { id: 'wellness', label: 'Wellness', icon: 'i-wellness', count: '33 places',  img: 'assets/img/cat-wellness.jpg', alt: 'Wellness services' }
  ];

  var CITIES = ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar', 'Quetta'];
  var LOCATIONS = CITIES.map(function (c) { return c + ', Pakistan'; });

  var CHIPS = [
    ['i-scissors', 'Hair salons near me'], ['i-barber', 'Barbers near me'],
    ['i-nail', 'Nail salons near me'], ['i-spa', 'Spas open today'],
    ['i-massage', 'Massage near me'], ['i-makeup', 'Bridal makeup artists'],
    ['i-skincare', 'Facials near me'], ['i-wellness', 'Wellness studios'],
    ['i-users', 'Kid-friendly salons'], ['i-bolt', 'Same-day appointments'],
    ['i-heart', 'Ladies-only salons'], ['i-star', 'Top rated near me']
  ];

  var USE_CASES = [
    { art: 'hair', tag: 'Your person', no: 'Use case — 01', img: 'assets/img/use-salon.jpg',
      alt: 'Client in a salon chair after a fresh cut',
      title: 'Salons who get you', sub: 'The fastest way to find someone worth keeping.',
      bullets: ['Browse real portfolio photos', 'Filter by distance, price and rating', 'Specialists for every hair type', 'Top-rated professionals near you'],
      cta: 'Find a salon' },
    { art: 'spa', tag: 'Self care', no: 'Use case — 02', img: 'assets/img/use-selfcare.jpg',
      alt: 'Calm spa treatment room',
      title: 'Plan a self-care day', sub: 'Stack a facial, a massage and a fresh set into one afternoon.',
      bullets: ['Book several services in one go', 'See exact treatment durations', 'Compare full price lists', 'Licensed therapists only'],
      cta: 'Plan a day' },
    { art: 'makeup', tag: 'Big day', no: 'Use case — 03', img: 'assets/img/use-event.jpg',
      alt: 'Makeup artist preparing a client for an event',
      title: 'Get ready when it counts', sub: 'Weddings, interviews, shoots — do not risk it.',
      bullets: ['Book bridal and event packages', 'Reserve weeks in advance', 'Read reviews before committing', 'Team bookings for the whole party'],
      cta: 'Find event pros' },
    { art: 'barber', tag: 'On the go', no: 'Use case — 04', img: 'assets/img/use-onthego.jpg',
      alt: 'Barber finishing a client fade',
      title: 'New city, same standard', sub: 'Land anywhere and skip the bad-haircut phase.',
      bullets: ['Top-rated pros wherever you are', 'See who is free right now', 'Filter by exactly what you need', 'Start your routine on day one'],
      cta: 'Search a new city' }
  ];

  var DEMO_BUSINESSES = [
    { name: 'Velvet Hair Studio', art: 'hair', img: 'assets/img/biz-1.jpg', alt: 'Salon interior',
      rating: 4.9, reviews: 214, tags: ['Hair', 'Styling'], city: 'Clifton, Karachi', priceFrom: '$25.00', badge: 'Top rated', slots: ['11:30', '14:00', '16:45'] },
    { name: 'The Fade Room', art: 'barber', img: 'assets/img/biz-2.jpg', alt: 'Barbershop interior',
      rating: 4.8, reviews: 167, tags: ['Barber', 'Beard'], city: 'DHA Phase 5, Lahore', priceFrom: '$15.00', badge: 'Open today', slots: ['10:00', '12:15', '18:30'] },
    { name: 'Lumière Nail Bar', art: 'nails', img: 'assets/img/biz-3.jpg', alt: 'Nail studio',
      rating: 4.7, reviews: 98, tags: ['Nails', 'Beauty'], city: 'F-7 Markaz, Islamabad', priceFrom: '$20.00', badge: null, slots: ['13:00', '15:30'] },
    { name: 'Serenity Day Spa', art: 'spa', img: 'assets/img/biz-4.jpg', alt: 'Spa reception',
      rating: 4.9, reviews: 301, tags: ['Spa', 'Massage'], city: 'Gulberg, Lahore', priceFrom: '$45.00', badge: 'Popular', slots: ['09:45', '12:00', '17:15'] }
  ];

  var DEMO_STATS = [
    { value: '210K+', label: 'Appointments booked' },
    { value: '1,200+', label: 'Partner businesses' },
    { value: '18', label: 'Cities covered' },
    { value: '3,400+', label: 'Professionals listed' }
  ];

  var DEMO_BADGES = [
    { stars: 5, score: '4.8', label: 'App Store', meta: '2,100+ ratings' },
    { stars: 5, score: '4.7', label: 'Google Play', meta: '3,800+ ratings' }
  ];

  var DEMO_REVIEWS = [
    { title: 'Found my go-to salon', quote: 'I moved cities and found a stylist I actually trust within a week. Seeing prices before booking changed everything.', name: 'Ayesha R.', meta: 'Karachi · Hair', color: '#6D28D9', art: 'person' },
    { title: 'So much faster', quote: 'Booking a barber used to mean three WhatsApp messages and a wait. Now it takes about twenty seconds.', name: 'Bilal K.', meta: 'Lahore · Barber', color: '#E0218A', art: 'person' },
    { title: 'Planned my whole day off', quote: 'I booked a facial and a massage back to back. The entire afternoon was planned in one sitting.', name: 'Hina M.', meta: 'Islamabad · Spa', color: '#8B5CF6', art: 'person' },
    { title: 'The reminders are great', quote: 'I used to forget appointments constantly. The reminder the night before has saved me more than once.', name: 'Zara I.', meta: 'Lahore · Nails', color: '#F472B6', art: 'person' }
  ];

  var FAQS = [
    { q: 'Is booking on Kimih free for clients?', a: 'Yes, 100% free. You only pay the salon or studio for the services you book.' },
    { q: 'Can I cancel or reschedule an appointment?', a: 'Yes, you can cancel or change your time slot directly from your account or the mobile app.' },
    { q: 'How do I know a business is reliable?', a: 'Every business profile features verified customer reviews, real photos, and full service price lists.' },
    { q: 'How do I list my salon on Kimih?', a: 'Click "Kimih for business" in the menu to set up your profile and start accepting bookings in minutes.' }
  ];

  /* ---------------- rendering ---------------- */
  function renderMarquee() {
    var track = $('#track');
    if (!track) return;
    var html = CHIPS.concat(CHIPS).map(function (c) {
      return '<a class="chip" href="#discover">' + icon(c[0]) + esc(c[1]) + '</a>';
    }).join('');
    track.innerHTML = html;
  }

  function renderCategories() {
    var rail = $('#catRail');
    if (!rail) return;
    rail.innerHTML = CATEGORIES.map(function (c) {
      return '<a class="cat-card media-zoom" href="#discover">' +
        '<div class="cat-icon">' + icon(c.icon) + '</div>' +
        '<div><h3>' + esc(c.label) + '</h3><p>' + esc(c.count) + '</p></div>' +
        '<span class="cnt">Explore ' + icon('i-arrow') + '</span></a>';
    }).join('');
  }

  function renderUseCases() {
    var grid = $('#ucGrid');
    if (!grid) return;
    grid.innerHTML = USE_CASES.map(function (u) {
      var bullets = u.bullets.map(function (b) {
        return '<li style="display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:10px !important; margin-bottom:10px !important; line-height:1.4 !important; font-size:.88rem !important; color:var(--ink) !important;">' +
                 '<span style="display:inline-flex !important; align-items:center !important; justify-content:center !important; width:18px !important; height:18px !important; min-width:18px !important; border-radius:50% !important; background:var(--violet-soft, #EDE6FB) !important; color:var(--violet, #6D28D9) !important; flex-shrink:0 !important; margin-top:2px !important;">' +
                   '<svg class="ic" style="width:11px !important; height:11px !important; stroke-width:2.5 !important; display:block !important; margin:0 !important;"><use href="#i-check"/></svg>' +
                 '</span>' +
                 '<span style="flex:1 1 auto !important; display:block !important; text-align:left !important;">' + esc(b) + '</span>' +
               '</li>';
      }).join('');
      return '<div class="col-md-6 col-lg-3"><div class="uc-card">' +
        '<span class="uc-tag">' + esc(u.tag) + '</span>' +
        '<h3 style="font-size:1.25rem;">' + esc(u.title) + '</h3>' +
        '<p style="font-size:.9rem;color:var(--body);margin:0 0 6px 0;">' + esc(u.sub) + '</p>' +
        '<ul style="list-style:none !important; padding:0 !important; margin:12px 0 0 !important; display:flex !important; flex-direction:column !important;">' + bullets + '</ul>' +
        '<a class="btn-k btn-outline-k mt-auto" href="#discover">' + esc(u.cta) + ' ' + icon('i-arrow') + '</a>' +
        '</div></div>';
    }).join('');
  }

  function renderStats() {
    var sec = $('#statsSection'), row = $('#statsRow'), badges = $('#badgeRow');
    if (!sec || !DEMO_MODE) return;
    sec.style.display = '';
    if (row) {
      row.innerHTML = DEMO_STATS.map(function (s) {
        return '<div class="col-6 col-lg-3"><div class="stat-box"><div class="stat-n">' + esc(s.value) + '</div><div class="stat-l">' + esc(s.label) + '</div></div></div>';
      }).join('');
    }
    if (badges) {
      badges.innerHTML = DEMO_BADGES.map(function (b) {
        return '<div class="badge-item"><span style="color:#F59E0B;">★ ' + esc(b.score) + '</span> <b>' + esc(b.label) + '</b> <span style="opacity:.6;">(' + esc(b.meta) + ')</span></div>';
      }).join('');
    }
  }

  function renderFaqs() {
    var list = $('#faqList');
    if (!list) return;
    list.innerHTML = FAQS.map(function (f, i) {
      return '<div class="faq-item' + (i === 0 ? ' open' : '') + '">' +
        '<button type="button" class="faq-q">' + esc(f.q) + ' ' + icon('i-plus') + '</button>' +
        '<div class="faq-a"><p>' + esc(f.a) + '</p></div></div>';
    }).join('');
    list.addEventListener('click', function (e) {
      var btn = e.target.closest('.faq-q');
      if (btn) {
        var item = btn.closest('.faq-item');
        var wasOpen = item.classList.contains('open');
        $$('.faq-item', list).forEach(function (it) { it.classList.remove('open'); });
        if (!wasOpen) item.classList.add('open');
      }
    });
  }

  function renderTicker() {
    var el = $('#tickerNum');
    if (!el) return;
    var base = 1420;
    function update() {
      el.textContent = (base + Math.floor(Math.random() * 5)).toLocaleString();
    }
    update();
    setInterval(update, 6000);
  }

  document.addEventListener('DOMContentLoaded', function () {
    renderMarquee();
    renderCategories();
    renderUseCases();
    renderStats();
    renderFaqs();
    renderTicker();
  });
})();
