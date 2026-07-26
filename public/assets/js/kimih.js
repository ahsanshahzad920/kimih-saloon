/* ==========================================================
   KIMIH — shared runtime
   Injects the icon sprite, generates SVG artwork, and wires
   the nav / mobile menu / scroll reveals used on every page.
   ========================================================== */
(function () {
  'use strict';

  /* ---------- icon sprite (inlined so it works offline & from file://) ---------- */
  var SPRITE = '<svg id="sprite" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">' +
    '<defs><linearGradient id="bm" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#6D28D9"/><stop offset="1" stop-color="#E0218A"/></linearGradient></defs>' +
    '<symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M16.5 16.5 21 21"/></symbol>' +
    '<symbol id="i-geo" viewBox="0 0 24 24"><path d="M12 21s7-6.1 7-11a7 7 0 1 0-14 0c0 4.9 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></symbol>' +
    '<symbol id="i-calendar" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="3"/><path d="M8 3v4M16 3v4M3 10h18"/></symbol>' +
    '<symbol id="i-cal-check" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="3"/><path d="M8 3v4M16 3v4M3 10h18M9.5 15l2 2 3.5-3.6"/></symbol>' +
    '<symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5.2l3.4 2"/></symbol>' +
    '<symbol id="i-arrow" viewBox="0 0 24 24"><path d="M4 12h15M13 6l6 6-6 6"/></symbol>' +
    '<symbol id="i-arrow-left" viewBox="0 0 24 24"><path d="M20 12H5M11 6l-6 6 6 6"/></symbol>' +
    '<symbol id="i-chevron" viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></symbol>' +
    '<symbol id="i-check" viewBox="0 0 24 24"><path d="m5 12.5 5 5L19 7"/></symbol>' +
    '<symbol id="i-plus" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></symbol>' +
    '<symbol id="i-star" viewBox="0 0 24 24"><path d="m12 3 2.7 5.6 6.1.9-4.4 4.3 1 6.1-5.4-2.9-5.4 2.9 1-6.1L3.2 9.5l6.1-.9z"/></symbol>' +
    '<symbol id="i-crosshair" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="2"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></symbol>' +
    '<symbol id="i-scissors" viewBox="0 0 24 24"><circle cx="6" cy="18" r="2.6"/><circle cx="18" cy="18" r="2.6"/><path d="M7.8 16.2 19 3M16.2 16.2 5 3"/></symbol>' +
    '<symbol id="i-barber" viewBox="0 0 24 24"><path d="M4 6h16v4a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4z"/><path d="M12 14v7M8 6V3M12 6V3M16 6V3"/></symbol>' +
    '<symbol id="i-nail" viewBox="0 0 24 24"><rect x="8" y="8" width="8" height="13" rx="3"/><path d="M10 8V5.5A1.5 1.5 0 0 1 11.5 4h1A1.5 1.5 0 0 1 14 5.5V8M8 13h8"/></symbol>' +
    '<symbol id="i-spa" viewBox="0 0 24 24"><path d="M12 21c0-5 3-8 8-8 0 5-3 8-8 8zM12 21c0-5-3-8-8-8 0 5-3 8-8 8z"/><path d="M12 21c-1.5-4 0-8 0-8s1.5 4 0 8z"/><path d="M12 5.5V3"/></symbol>' +
    '<symbol id="i-massage" viewBox="0 0 24 24"><path d="M3 15c2-2 3.5-2 5 0s3 2 5 0 3.5-2 5 0"/><path d="M3 19c2-2 3.5-2 5 0s3 2 5 0 3.5-2 5 0"/><circle cx="12" cy="7" r="3.2"/></symbol>' +
    '<symbol id="i-makeup" viewBox="0 0 24 24"><path d="M12 3a9 9 0 1 0 0 18c1.3 0 2-.8 2-1.8 0-1.6-1.4-1.8-1.4-3 0-1 .8-1.7 1.9-1.7H17a4 4 0 0 0 4-4C21 6.4 17 3 12 3z"/><circle cx="8" cy="9.5" r="1"/><circle cx="12" cy="7" r="1"/><circle cx="16" cy="9.5" r="1"/></symbol>' +
    '<symbol id="i-skincare" viewBox="0 0 24 24"><path d="M12 3s6 6.2 6 10a6 6 0 0 1-12 0c0-3.8 6-10 6-10z"/><path d="M9.5 14a2.6 2.6 0 0 0 2.5 2.4"/></symbol>' +
    '<symbol id="i-wellness" viewBox="0 0 24 24"><path d="M12 21V9"/><path d="M12 12c0-3.9 3.1-7 7-7 0 3.9-3.1 7-7 7z"/><path d="M12 16c0-3.3-2.7-6-6-6 0 3.3 2.7 6 6 6z"/></symbol>' +
    '<symbol id="i-shop" viewBox="0 0 24 24"><path d="M4 9h16v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M3 9l1.6-4.3A2 2 0 0 1 6.5 3h11a2 2 0 0 1 1.9 1.7L21 9"/><path d="M9 21v-6h6v6"/></symbol>' +
    '<symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 3 5 6v6c0 4.4 3 7.9 7 9 4-1.1 7-4.6 7-9V6z"/><path d="m9 12 2 2 4-4"/></symbol>' +
    '<symbol id="i-bolt" viewBox="0 0 24 24"><path d="M13 2 4.5 13.5H11L10 22l8.5-11.5H12z"/></symbol>' +
    '<symbol id="i-sliders" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/><circle cx="9" cy="7" r="2"/><circle cx="15" cy="12" r="2"/><circle cx="8" cy="17" r="2"/></symbol>' +
    '<symbol id="i-patch" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="m8.5 12 2.4 2.4 4.6-4.8"/></symbol>' +
    '<symbol id="i-image" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="3"/><circle cx="8.5" cy="9.5" r="1.6"/><path d="m4 17 4.5-4.5L13 17l3-3 4 4"/></symbol>' +
    '<symbol id="i-play" viewBox="0 0 24 24"><path d="M8 5.5v13l11-6.5z"/></symbol>' +
    '<symbol id="i-sparkle" viewBox="0 0 24 24"><path d="M12 3v5M12 16v5M3 12h5M16 12h5"/><path d="M12 8a4 4 0 0 0 4 4 4 4 0 0 0-4 4 4 4 0 0 0-4-4 4 4 0 0 0 4-4z"/></symbol>' +
    '<symbol id="i-heart" viewBox="0 0 24 24"><path d="M12 20s-7-4.3-7-9.2A4 4 0 0 1 12 8a4 4 0 0 1 7-2.6c0 5-7 14.6-7 14.6z"/></symbol>' +
    '<symbol id="i-users" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-5.5 6-5.5s6 2.2 6 5.5"/><path d="M16 5.5a3.2 3.2 0 0 1 0 6.4M17 14.8c2.4.5 4 2.5 4 5.2"/></symbol>' +
    '<symbol id="i-close" viewBox="0 0 24 24"><path d="m6 6 12 12M18 6 6 18"/></symbol>' +
    '<symbol id="i-home" viewBox="0 0 24 24"><path d="M4 10.5 12 4l8 6.5V19a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9.5 21v-6h5v6"/></symbol>' +
    '<symbol id="i-tag" viewBox="0 0 24 24"><path d="M3 12.5V4h8.5L21 13.5 13.5 21z"/><circle cx="7.5" cy="7.5" r="1.4"/></symbol>' +
    '<symbol id="i-megaphone" viewBox="0 0 24 24"><path d="M4 10v4a2 2 0 0 0 2 2h2l8 4V4L8 8H6a2 2 0 0 0-2 2z"/><path d="M19 9.5a3.5 3.5 0 0 1 0 5"/></symbol>' +
    '<symbol id="i-doc" viewBox="0 0 24 24"><path d="M6 3h8l5 5v13a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z"/><path d="M14 3v5h5M8.5 13h7M8.5 17h5"/></symbol>' +
    '<symbol id="i-gear" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3.2"/><path d="M12 2.5v2.6M12 18.9v2.6M4.2 7.2l2.2 1.3M17.6 15.5l2.2 1.3M4.2 16.8l2.2-1.3M17.6 8.5l2.2-1.3"/></symbol>' +
    '<symbol id="i-bell" viewBox="0 0 24 24"><path d="M18 15V10a6 6 0 1 0-12 0v5l-2 3h16z"/><path d="M10 21h4"/></symbol>' +
    '<symbol id="i-up" viewBox="0 0 24 24"><path d="M12 19V6M6 12l6-6 6 6"/></symbol>' +
    '<symbol id="i-down" viewBox="0 0 24 24"><path d="M12 5v13M6 12l6 6 6-6"/></symbol>' +
    '<symbol id="i-card" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="3"/><path d="M3 10h18M7 15h3"/></symbol>' +
    '<symbol id="i-book" viewBox="0 0 24 24"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v18H6.5A2.5 2.5 0 0 1 4 18.5z"/><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v18h4.5a2.5 2.5 0 0 0 2.5-2.5z"/></symbol>' +
    '<symbol id="i-list" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></symbol>' +
    '<symbol id="i-dollar" viewBox="0 0 24 24"><path d="M12 3v18"/><path d="M16 7.5c0-1.7-1.8-2.5-4-2.5s-4 .8-4 2.6c0 3.9 8 2.1 8 6 0 1.8-1.8 2.9-4 2.9s-4-1-4-2.7"/></symbol>' +
    '<symbol id="i-bag" viewBox="0 0 24 24"><path d="M5 8h14l-1 12H6z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></symbol>' +
    '<symbol id="i-usercircle" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="10" r="3"/><path d="M6.5 19a6 6 0 0 1 11 0"/></symbol>' +
    '<symbol id="i-wallet" viewBox="0 0 24 24"><path d="M3 7.5A2.5 2.5 0 0 1 5.5 5H18v3"/><rect x="3" y="7.5" width="18" height="12" rx="2.5"/><circle cx="17" cy="13.5" r="1.2"/></symbol>' +
    '<symbol id="i-filter" viewBox="0 0 24 24"><path d="M4 7h16M7 12h10M10 17h4"/></symbol>' +
    '<symbol id="i-apple" viewBox="0 0 24 24"><path d="M16.2 12.6c0-2.3 1.9-3.4 2-3.5-1.1-1.6-2.8-1.8-3.4-1.8-1.4-.1-2.8.9-3.5.9s-1.8-.9-3-.8c-1.5 0-2.9.9-3.7 2.3-1.6 2.7-.4 6.8 1.1 9 .8 1.1 1.6 2.3 2.8 2.2 1.1 0 1.6-.7 2.9-.7s1.7.7 2.9.7c1.2 0 2-1.1 2.7-2.2.9-1.3 1.2-2.5 1.3-2.6-.1 0-2.4-.9-2.4-3.5z"/><path d="M14.1 5.3c.6-.8 1-1.8.9-2.8-.9 0-2 .6-2.6 1.4-.6.7-1.1 1.7-.9 2.7 1 .1 2-.5 2.6-1.3z"/></symbol>' +
    '<symbol id="i-android" viewBox="0 0 24 24"><path d="M4 10.5v6a1.5 1.5 0 0 0 1.5 1.5h13a1.5 1.5 0 0 0 1.5-1.5v-6z"/><path d="M7.5 10.5C7.5 8 9.5 6 12 6s4.5 2 4.5 4.5"/><path d="m8 3.5 1.6 2.2M16 3.5l-1.6 2.2"/><circle cx="9.7" cy="8.6" r=".6" fill="currentColor"/><circle cx="14.3" cy="8.6" r=".6" fill="currentColor"/><path d="M7 18v2.5M17 18v2.5"/></symbol>' +
    '<symbol id="i-ig" viewBox="0 0 24 24"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17" cy="7" r="1" fill="currentColor" stroke="none"/></symbol>' +
    '<symbol id="i-fb" viewBox="0 0 24 24"><path d="M14.5 8.5V6.8c0-.8.4-1.3 1.4-1.3H17V3h-2.4c-2.4 0-3.6 1.4-3.6 3.6v1.9H9V11h2v10h3.5V11H17l.5-2.5z" fill="currentColor" stroke="none"/></symbol>' +
    '<symbol id="i-tt" viewBox="0 0 24 24"><path d="M15 3v9.6a3.1 3.1 0 1 1-2.6-3.05"/><path d="M15 3c.4 2.3 2 3.9 4.4 4.1"/></symbol>' +
    '</svg>';

  function injectSprite() {
    var d = document.createElement('div');
    d.style.cssText = 'position:absolute;width:0;height:0;overflow:hidden';
    d.innerHTML = SPRITE;
    document.body.insertBefore(d, document.body.firstChild);
  }

  /* ---------- helpers ---------- */
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var esc = function (s) {
    return String(s).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  };
  var icon = function (id, cls) { return '<svg class="ic ' + (cls || '') + '"><use href="#' + id + '"/></svg>'; };

  /* ---------- generated SVG artwork ---------- */
  var ART = {
    hair:     { a: '#7C3AED', b: '#E0218A', icon: 'i-scissors' },
    barber:   { a: '#4C1D95', b: '#8B5CF6', icon: 'i-barber' },
    nails:    { a: '#E0218A', b: '#F59BC6', icon: 'i-nail' },
    spa:      { a: '#5B21B6', b: '#38BDF8', icon: 'i-spa' },
    massage:  { a: '#6D28D9', b: '#C084FC', icon: 'i-massage' },
    makeup:   { a: '#BE185D', b: '#F0ABFC', icon: 'i-makeup' },
    skincare: { a: '#7C3AED', b: '#F9A8D4', icon: 'i-skincare' },
    wellness: { a: '#4C1D95', b: '#A78BFA', icon: 'i-wellness' },
    person:   { a: '#8B5CF6', b: '#F472B6', icon: 'i-usercircle' },
    def:      { a: '#6D28D9', b: '#E0218A', icon: 'i-sparkle' }
  };
  var seq = 0;
  function art(kind) {
    var c = ART[kind] || ART.def, k = 'ag' + (++seq);
    var r = function (n) { return Math.sin(seq * 9.7 + n) * 0.5 + 0.5; };
    return '<svg class="art" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid slice" aria-hidden="true">' +
      '<defs><linearGradient id="' + k + '" x1="0" y1="0" x2="1" y2="1">' +
      '<stop offset="0" stop-color="' + c.a + '"/><stop offset="1" stop-color="' + c.b + '"/></linearGradient>' +
      '<radialGradient id="' + k + 'b" cx="' + (20 + r(1) * 60) + '%" cy="' + (15 + r(2) * 40) + '%" r="70%">' +
      '<stop offset="0" stop-color="#fff" stop-opacity=".42"/><stop offset="1" stop-color="#fff" stop-opacity="0"/></radialGradient>' +
      '<pattern id="' + k + 'p" width="14" height="14" patternUnits="userSpaceOnUse">' +
      '<circle cx="2" cy="2" r="1" fill="#fff" opacity=".16"/></pattern></defs>' +
      '<rect width="400" height="300" fill="url(#' + k + ')"/>' +
      '<rect width="400" height="300" fill="url(#' + k + 'b)"/>' +
      '<rect width="400" height="300" fill="url(#' + k + 'p)"/>' +
      '<circle cx="' + (60 + r(3) * 250) + '" cy="' + (40 + r(4) * 60) + '" r="' + (60 + r(5) * 60) + '" fill="#fff" opacity=".09"/>' +
      '<circle cx="' + (30 + r(6) * 300) + '" cy="' + (210 + r(7) * 70) + '" r="' + (50 + r(8) * 70) + '" fill="#000" opacity=".07"/>' +
      '<path d="M0 ' + (210 + r(9) * 40) + ' C 110 ' + (150 + r(2) * 60) + ', 250 ' + (250 + r(3) * 30) + ', 400 ' + (180 + r(4) * 50) + ' L400 300 L0 300 Z" fill="#fff" opacity=".1"/>' +
      '<g transform="translate(200 150)" opacity=".6"><svg x="-34" y="-34" width="68" height="68" viewBox="0 0 24 24" ' +
      'fill="none" stroke="#fff" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round">' +
      '<use href="#' + c.icon + '"/></svg></g></svg>';
  }
  function paintArt(root) {
    $$('[data-art]', root || document).forEach(function (el) {
      if (el.querySelector('.art')) return;
      el.insertAdjacentHTML('afterbegin', art(el.getAttribute('data-art')));
    });
  }

  /* ---------- shared behaviours ---------- */
  function initNav() {
    var nav = $('#nav');
    if (nav) {
      addEventListener('scroll', function () {
        nav.classList.toggle('stuck', scrollY > 20);
      }, { passive: true });
    }
    var burger = $('#burger'), mnav = $('#mnav');
    if (!burger || !mnav) return;
    function setMenu(open) {
      document.body.classList.toggle('mnav-open', open);
      burger.setAttribute('aria-expanded', String(open));
      burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      if (open) { var a = mnav.querySelector('a'); if (a) a.focus({ preventScroll: true }); }
    }
    burger.addEventListener('click', function () {
      setMenu(!document.body.classList.contains('mnav-open'));
    });
    mnav.addEventListener('click', function (e) { if (e.target.closest('a')) setMenu(false); });
    addEventListener('resize', function () { if (innerWidth >= 992) setMenu(false); });
    addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && document.body.classList.contains('mnav-open')) setMenu(false);
    });
  }

  function initStickyCta() {
    var cta = $('#stickyCta');
    if (!cta) return;
    var hero = $('.hero');
    addEventListener('scroll', function () {
      var show = hero ? (scrollY > hero.offsetHeight - 100) : (scrollY > 300);
      cta.classList.toggle('show', show);
    }, { passive: true });
  }

  function initDynamicYear() {
    $$('[data-year]').forEach(function (el) {
      el.textContent = new Date().getFullYear();
    });
  }

  /* ---------- boot ---------- */
  document.addEventListener('DOMContentLoaded', function () {
    injectSprite();
    paintArt();
    initNav();
    initStickyCta();
    initDynamicYear();
  });

  window.KIMIH = {
    $: $, $$: $$, esc: esc, icon: icon, art: art, paintArt: paintArt
  };
})();
