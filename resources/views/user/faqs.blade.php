@extends('user.layouts.app')

@section('title', 'Frequently Asked Questions (FAQ) | Kimih')

@section('styles')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<style>
    /* FAQ Hero Header */
    .faq-hero-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311075 100%);
        color: #ffffff;
        padding: 60px 0 55px;
        position: relative;
        overflow: hidden;
    }
    .faq-hero-section h1 {
        color: #ffffff;
    }
    .faq-hero-section::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: radial-gradient(circle at 80% 20%, rgba(244, 208, 239, 0.15) 0%, transparent 50%);
        pointer-events: none;
    }
    .faq-badge-pill {
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
    .faq-search-box {
        max-width: 620px;
        margin-top: 24px;
        position: relative;
    }
    .faq-search-input {
        width: 100%;
        padding: 16px 20px 16px 48px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        background: rgba(255, 255, 255, 0.95);
        font-size: 0.98rem;
        color: #111827;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        outline: none;
        transition: all 0.2s;
    }
    .faq-search-input:focus {
        background: #ffffff;
        border-color: #4b1fa8;
    }
    .faq-search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        font-size: 1.1rem;
    }

    /* FAQ Main Section & Cards */
    .faq-main-wrapper {
        background: #f8fafc;
        padding: 50px 0 80px;
    }
    .faq-item-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        overflow: hidden;
        transition: all 0.25s ease;
    }
    .faq-item-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    }
    .faq-question-btn {
        width: 100%;
        padding: 20px 24px;
        background: transparent;
        border: none;
        text-align: left;
        font-size: 1.02rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        cursor: pointer;
        outline: none;
    }
    .faq-question-btn .toggle-ic {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #4b1fa8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .faq-question-btn[aria-expanded="true"] .toggle-ic {
        transform: rotate(45deg);
        background: #4b1fa8;
        color: #ffffff;
    }
    .faq-answer-collapse {
        padding: 0 24px 20px 24px;
        font-size: 0.94rem;
        line-height: 1.7;
        color: #475569;
    }

    /* Kimih Bot Floating Chat Widget */
    #chat-circle {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: #4b1fa8;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        color: #ffffff !important;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(75, 31, 168, 0.4);
        z-index: 99999;
        transition: transform 0.2s;
    }
    #chat-circle:hover {
        transform: scale(1.08);
    }
    .chat-box {
        display: none;
        background: #ffffff;
        position: fixed;
        right: 24px;
        bottom: 90px;
        width: 380px;
        max-width: 90vw;
        height: 520px;
        max-height: 85vh;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        z-index: 99999;
        flex-direction: column;
        border: 1px solid #e2e8f0;
    }
    .chat-box-header {
        background: linear-gradient(135deg, #0f172a 0%, #311075 100%);
        padding: 16px 20px;
        color: #ffffff !important;
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .chat-box-body {
        flex: 1;
        background: #f8fafc;
        overflow-y: auto;
        padding: 16px;
    }
    .chat-message-bubble {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 12px 16px;
        border-radius: 14px;
        font-size: 0.9rem;
        color: #0f172a;
        margin-bottom: 10px;
        max-width: 85%;
        box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }
    .chat-tags-wrapper {
        padding: 10px 16px;
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        max-height: 100px;
        overflow-y: auto;
    }
    .bot-tag-btn {
        background: rgba(75, 31, 168, 0.08);
        border: 1px solid rgba(75, 31, 168, 0.2);
        color: #4b1fa8;
        padding: 4px 10px;
        font-size: 0.78rem;
        font-weight: 600;
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .bot-tag-btn:hover {
        background: #4b1fa8;
        color: #ffffff;
    }
    .chat-form-footer {
        padding: 10px 16px;
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .chat-form-footer input {
        flex: 1;
        border: 1px solid #d1d5db;
        border-radius: 20px;
        padding: 8px 14px;
        font-size: 0.88rem;
        outline: none;
    }
    .chat-form-footer button {
        background: #4b1fa8;
        color: #ffffff;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
</style>
@endsection

@section('content')

{{-- Hero Section --}}
<div class="faq-hero-section">
    <div class="container text-center position-relative z-1">
        <span class="faq-badge-pill">
            <i class="fa-solid fa-circle-question"></i> Kimih Help & Knowledge Base
        </span>
        <h1 class="display-5 fw-bold mb-3">Frequently Asked Questions</h1>
        <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 680px;">
            Find instant answers to common questions about booking appointments, venue payments, cancellation policies, and managing services.
        </p>

        {{-- Live Search Input --}}
        <div class="faq-search-box mx-auto">
            <i class="fa-solid fa-magnifying-glass faq-search-icon"></i>
            <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="Search questions or topics (e.g. cancellation, payment, booking)..." onkeyup="filterFaqs()">
        </div>
    </div>
</div>

{{-- Main FAQ Content Section --}}
<div class="faq-main-wrapper">
    <div class="container">
        
        {{-- Results Counter --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="fw-bold text-dark fs-5">
                <i class="fa-solid fa-layer-group text-purple me-2" style="color:#4b1fa8;"></i> All Questions ({{ $faqs->count() }})
            </div>
            <div class="text-muted small">
                Showing all topics
            </div>
        </div>

        {{-- FAQ Accordion Cards Grid (2 Columns) --}}
        <div class="row g-3" id="faqAccordionGrid">
            @php
                $chunks = $faqs->chunk(ceil(max($faqs->count(), 1) / 2));
            @endphp

            @foreach ($chunks as $chunkIndex => $chunk)
                <div class="col-lg-6 col-12">
                    @foreach ($chunk as $faqIndex => $faq)
                        @php $faqId = 'faqCollapse_' . $chunkIndex . '_' . $loop->index; @endphp
                        <div class="faq-item-card faq-node">
                            <button class="faq-question-btn" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $faqId }}" aria-expanded="false">
                                <span class="faq-q-text"><i class="fa-regular fa-comments text-muted me-2"></i>{{ $faq->question ?? '' }}</span>
                                <span class="toggle-ic"><i class="fa-solid fa-plus"></i></span>
                            </button>
                            <div id="{{ $faqId }}" class="collapse">
                                <div class="faq-answer-collapse border-top pt-3">
                                    {!! $faq->answer ?? '' !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- Still Have Questions CTA Banner --}}
        <div class="mt-5 bg-white p-5 rounded-4 border text-center shadow-sm">
            <div class="mb-3">
                <i class="fa-solid fa-headset text-purple fa-3x" style="color: #4b1fa8;"></i>
            </div>
            <h3 class="h4 fw-bold text-dark mb-2">Still have questions?</h3>
            <p class="text-muted mx-auto mb-4" style="max-width: 540px;">
                Can't find the answer you're looking for? Please reach out to our friendly support team or chat with our automated assistant.
            </p>
            <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
                <a href="/contact-us" class="btn-k btn-hero btn-sm py-2 px-4">
                    <i class="fa-solid fa-envelope me-1"></i> Contact Support
                </a>
                <button type="button" class="btn-k btn-outline-k btn-sm py-2 px-4" onclick="toggleKimihChat();">
                    <i class="fa-solid fa-comments me-1"></i> Open Kimih Bot
                </button>
            </div>

        </div>

    </div>
</div>

{{-- Kimih Bot Floating Chat Widget --}}
<div id="chat-circle" onclick="toggleKimihChat();" title="Kimih Assistant">
    <i class="material-icons">chat</i>
</div>

<div class="chat-box" id="kimihChatBox">
    <div class="chat-box-header">
        <span><i class="fa-solid fa-robot me-2"></i> Kimih Assistant</span>
        <span style="cursor:pointer;" onclick="toggleKimihChat();"><i class="material-icons">close</i></span>
    </div>
    <div class="chat-box-body">
        <div class="chat-logs" id="chatLogs">
            <div class="chat-message-bubble">
                <strong>Kimih Bot:</strong> Hello! How can I assist you with your booking today?
            </div>
        </div>
    </div>
    <div class="chat-tags-wrapper">
        @foreach ($botFaqs as $data)
            <span class="bot-tag-btn" onclick="sendBotQuestion('{{ addslashes($data ?? '') }}');">{{ $data ?? '' }}</span>
        @endforeach
    </div>
    <div class="chat-form-footer">
        <input type="text" id="chatInput" placeholder="Ask a question..." onkeydown="if(event.key==='Enter') sendChatMessage();">
        <button type="button" onclick="sendChatMessage();"><i class="material-icons">send</i></button>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function filterFaqs() {
        const query = document.getElementById('faqSearchInput').value.toLowerCase().trim();
        document.querySelectorAll('.faq-node').forEach(card => {
            const qText = card.querySelector('.faq-q-text')?.innerText.toLowerCase() || '';
            const ansText = card.querySelector('.faq-answer-collapse')?.innerText.toLowerCase() || '';
            if (qText.includes(query) || ansText.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function toggleKimihChat() {
        const box = document.getElementById('kimihChatBox');
        if (box.style.display === 'flex') {
            box.style.display = 'none';
        } else {
            box.style.display = 'flex';
        }
    }

    function sendBotQuestion(questionText) {
        if (!questionText) return;
        const logs = document.getElementById('chatLogs');
        logs.innerHTML += `<div class="chat-message-bubble bg-light text-dark ms-auto" style="border-color:#cbd5e1;"><strong>You:</strong> ${questionText}</div>`;
        
        setTimeout(() => {
            logs.innerHTML += `<div class="chat-message-bubble"><strong>Kimih Bot:</strong> Thank you for asking. Our system is connecting your inquiry for "${questionText}" with a support representative.</div>`;
            logs.scrollTop = logs.scrollHeight;
        }, 500);

        logs.scrollTop = logs.scrollHeight;
    }

    function sendChatMessage() {
        const input = document.getElementById('chatInput');
        const val = input.value.trim();
        if (!val) return;
        sendBotQuestion(val);
        input.value = '';
    }
</script>
@endsection
