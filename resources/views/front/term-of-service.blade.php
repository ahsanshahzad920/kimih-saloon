@extends('user.layouts.app')

@section('title', 'Terms of Service | Kimih')

@section('styles')
<style>
    .legal-hero-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311075 100%);
        color: #ffffff;
        padding: 60px 0 50px;
        position: relative;
        overflow: hidden;
    }
    .legal-hero-section h1 { color: #ffffff; }
    .legal-hero-section::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: radial-gradient(circle at 80% 20%, rgba(244, 208, 239, 0.15) 0%, transparent 50%);
        pointer-events: none;
    }
    .legal-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 600;
        color: #e2e8f0;
        margin-bottom: 16px;
    }
    .legal-meta-bar {
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 0.88rem;
        color: #94a3b8;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    .legal-container {
        padding: 50px 0 80px;
        background: #f8fafc;
    }
    .legal-section-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 40px;
        max-width: 860px;
        margin: 0 auto;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .legal-section-card h1,
    .legal-section-card h2,
    .legal-section-card h3 {
        color: var(--ink, #0f172a);
        margin-top: 28px;
        margin-bottom: 12px;
    }
    .legal-section-card h1:first-child,
    .legal-section-card h2:first-child,
    .legal-section-card h3:first-child {
        margin-top: 0;
    }
    .legal-section-card p,
    .legal-section-card li {
        font-size: 0.96rem;
        line-height: 1.75;
        color: #475569;
    }
    .legal-section-card ul, .legal-section-card ol {
        padding-left: 20px;
    }
</style>
@endsection

@section('content')

{{-- Hero Section --}}
<div class="legal-hero-section">
    <div class="container position-relative z-1">
        <span class="legal-badge-pill">
            <i class="fa-solid fa-file-contract"></i> Kimih Legal
        </span>
        <h1 class="display-5 fw-bold mb-3">Terms of Service</h1>
        <p class="lead text-light opacity-90 mb-0" style="max-width: 680px;">
            The terms and conditions governing your use of the Kimih website, apps, and booking services.
        </p>
        <div class="legal-meta-bar">
            <span><i class="fa-regular fa-calendar me-1"></i> Last updated: {{ now()->format('F j, Y') }}</span>
        </div>
    </div>
</div>

{{-- Main Document Container --}}
<div class="legal-container">
    <div class="container">
        <div class="legal-section-card">
            {!! settings()->term_of_service ?? '<p>Our Terms of Service will be published here shortly.</p>' !!}
        </div>
    </div>
</div>

@endsection
