@extends('user.layouts.app')

@section('title', 'My Wallet')

@section('content')

    <div class="wallet-balance-area pt-100 pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="wallet-balance shadow-lg">
                        <h2><i class="fas fa-wallet"></i> My Wallet</h2>
                        <p>Your current balance is: <strong>AED{{ number_format(auth()->user()->balance, 2) }}</strong></p>
                    </div>
                </div>
                <button type="button"
                                                            class="btn btn-outline-primary me-2 send-message-btn"
                                                            data-bs-toggle="modal" data-bs-target="#sendMessageModal">
                                                            Recharge Account
                                                        </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="sendMessageModalLabel">Recharge Amount</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('recharge-amount') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @include('admin.layout.errors')

                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="modalPhone">Enter Amount(AED) + (2.5% Platform Fees)</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                        name="amount" id="modalPhone" placeholder="e.g:100"
                                        value="{{ old('amount') }}" required />
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success add-btn rounded-3 me-2">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .wallet-balance {
            /* background: linear-gradient(135deg, #5D39EC, #7A57FF); */
            background: linear-gradient(267deg, rgba(221, 63, 235, 1) 0%, rgba(58, 55, 236, 1) 100%);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
            border: none;
            color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .wallet-balance:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .wallet-balance h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #fff;
            font-weight: 700;
        }

        .wallet-balance h2 i {
            margin-right: 10px;
        }

        .wallet-balance p {
            font-size: 22px;
            color: #fff;
        }

        .wallet-balance strong {
            font-size: 24px;
            color: #FFD700;
        }

        /* Additional modern touches */
        .wallet-balance {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .wallet-balance h2 {
            font-family: 'Roboto', sans-serif;
            letter-spacing: 1px;
        }

        .wallet-balance p {
            font-family: 'Open Sans', sans-serif;
        }

        .wallet-balance strong {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
