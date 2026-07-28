@extends('admin.layout.app')
@section('title', 'Send Notification')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Send Notification to Your Customers</h4>
                        <p class="text-muted mb-0 small">
                            This sends a push notification to customers who've booked with you and have
                            notifications enabled — great for announcing a discount or offer.
                        </p>
                    </div><!-- end card header -->

                    <div class="card-body">
                        @if ($recipientCount > 0)
                            <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                                <i class="fa fa-users me-2"></i>
                                This will reach <strong class="mx-1">{{ $recipientCount }}</strong>
                                {{ Str::plural('customer', $recipientCount) }} who {{ $recipientCount === 1 ? 'has' : 'have' }} notifications enabled.
                            </div>
                        @else
                            <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                                <i class="fa fa-exclamation-triangle me-2"></i>
                                None of your customers have notifications enabled yet, so a broadcast
                                won't reach anyone right now.
                            </div>
                        @endif

                        <form id="broadcast-form" action="{{ route('broadcast-notification.send') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                    name="title" id="title" autocomplete="off" maxlength="255" required />
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="message">Message</label>
                                <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}"
                                    id="message" name="message" rows="4" maxlength="1000" required></textarea>
                                <div class="form-text text-end">
                                    <span id="message-count">0</span>/1000
                                </div>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" id="broadcast-submit" class="default-btn py-2 px-4"
                                {{ $recipientCount === 0 ? 'disabled' : '' }}>
                                <i class="fa fa-paper-plane me-1"></i>
                                Send
                            </button>
                        </form>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        (function () {
            var $message = $('#message');
            var $count = $('#message-count');
            var updateCount = function () { $count.text($message.val().length); };
            updateCount();
            $message.on('input', updateCount);

            $('#broadcast-form').on('submit', function (e) {
                var recipientCount = {{ (int) $recipientCount }};
                var $submit = $('#broadcast-submit');

                if ($submit.data('confirmed')) return; // already confirmed, let it submit

                e.preventDefault();
                var form = this;

                if (typeof Swal === 'undefined') {
                    if (!confirm('Send this notification to ' + recipientCount + ' customer(s)? This can\'t be undone.')) return;
                    $submit.data('confirmed', true).prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Sending...');
                    form.submit();
                    return;
                }

                Swal.fire({
                    title: 'Send notification?',
                    text: 'This will go out to ' + recipientCount + ' customer(s) right away and can\'t be undone.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Send now',
                    cancelButtonText: 'Cancel'
                }).then(function (result) {
                    if (!result.isConfirmed) return;
                    $submit.data('confirmed', true).prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Sending...');
                    form.submit();
                });
            });
        })();
    </script>
@endsection

