@extends('frontend.layouts.app')
@section('title', 'Payment Waiting - NexPark')

@section('content')
    <div class="page-background"></div>
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header py-4">
                            <h4 class="mb-0 text-white text-center font-weight-bold">Status Pembayaran</h4>
                        </div>
                        <div class="card-body p-4">
                            <div id="status-container" class="text-center">
                                @if($payment->status == 'pending')
                                    <div class="status-box pending-status">
                                        <div class="status-icon pending">
                                            <div class="spinner-ring"></div>
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <h3 class="status-title">Menunggu Konfirmasi</h3>
                                        <p class="status-desc">Pembayaran Anda sedang diproses. Mohon tunggu konfirmasi dari
                                            admin.</p>
                                    </div>
                                @elseif($payment->status == 'confirmed')
                                    <div class="status-box confirmed-status">
                                        <div class="status-icon confirmed">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <h3 class="status-title text-success">Pembayaran Dikonfirmasi</h3>
                                        <p class="status-desc">Pembayaran Anda telah berhasil dikonfirmasi.</p>
                                        <a href="{{ route('frontend.parking.receipt', $payment->vehicleIn->id) }}"
                                            class="btn btn-success mt-4">
                                            <i class="fas fa-print me-2"></i> Cetak Bukti Parkir
                                        </a>
                                    </div>
                                @else
                                    <div class="status-box rejected-status">
                                        <div class="status-icon rejected">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                        <h3 class="status-title text-danger">Pembayaran Ditolak</h3>
                                        <p class="status-desc">Maaf, pembayaran Anda ditolak.</p>
                                        @if($payment->notes)
                                            <div class="alert alert-danger mt-3">
                                                <strong>Alasan :</strong> {{ $payment->notes }}
                                            </div>
                                        @endif
                                        <a href="{{ route('frontend.payment.checkout', $payment->vehicleIn->id) }}"
                                            class="btn btn-primary mt-4">
                                            <i class="fas fa-redo me-2"></i> Coba Lagi
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="payment-details mt-5">
                                <h5 class="section-title">Detail Pembayaran</h5>
                                <div class="detail-box">
                                    <div class="detail-grid">
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-receipt"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">ID Pembayaran</span>
                                                <h6 class="detail-value">#{{ $payment->id }}</h6>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Tanggal</span>
                                                <h6 class="detail-value">{{ $payment->created_at->format('d/m/Y H:i') }}
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-car"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Kendaraan</span>
                                                <h6 class="detail-value">{{ $payment->vehicleIn->vehicle->name }}
                                                    ({{ $payment->vehicleIn->vehicle->plat_number }})</h6>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Durasi</span>
                                                <h6 class="detail-value">{{ $payment->vehicleIn->duration }} jam</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-preview mt-4">
                                    <div class="fee-content">
                                        <div class="fee-info">
                                            <h6 class="mb-1">Total Pembayaran</h6>
                                            <small>Status:
                                                <span class="status-badge
                                                                                                    {{ $payment->status == 'pending' ? 'pending' :
        ($payment->status == 'confirmed' ? 'confirmed' : 'rejected') }}">
                                                    {{ $payment->status == 'pending' ? 'Menunggu' :
        ($payment->status == 'confirmed' ? 'Dikonfirmasi' : 'Ditolak') }}
                                                </span>
                                            </small>
                                        </div>
                                        <div class="fee-amount">
                                            <h4 class="mb-0">Rp {{ number_format($payment->amount, 0, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-method mt-4">
                                    <div class="method-box">
                                        <div class="method-icon">
                                            <i
                                                class="{{ $payment->payment_method == 'transfer' ? 'fas fa-university' : 'fas fa-qrcode' }}"></i>
                                        </div>
                                        <div class="method-info">
                                            <span class="method-label">Metode Pembayaran</span>
                                            <h6 class="method-value">
                                                {{ $payment->payment_method == 'transfer' ? 'Transfer Bank' : 'QRIS' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    @include('frontend.layouts.navbar-style')
    <style>
        body {
            background-color: #000;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
            position: relative;
            z-index: 2;
        }

        .main-content {
            padding-top: 120px;
            padding-bottom: 60px;
            position: relative;
            z-index: 2;
        }

        .page-background {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset('frontend/images/bg1.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 1;
            filter: blur(5px);
        }

        .page-background::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            animation: fadeIn 0.5s ease-out;
        }

        .card-header {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border-radius: 20px 20px 0 0 !important;
            border: none;
            padding: 1.5rem;
        }

        .section-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f2f5;
            font-size: 1.25rem;
        }

        /* Status Styles */
        .status-box {
            padding: 2rem;
            text-align: center;
            animation: slideIn 0.5s ease-out;
        }

        .status-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            position: relative;
            animation: scaleIn 0.5s ease-out;
        }

        .status-icon.pending {
            background: #fff5e5;
            color: #ffa000;
        }

        .status-icon.confirmed {
            background: #e3fcef;
            color: #00d084;
        }

        .status-icon.rejected {
            background: #fee2e2;
            color: #ef4444;
        }

        .spinner-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 4px solid transparent;
            border-top-color: #ffa000;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .status-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1e293b;
        }

        .status-desc {
            color: #64748b;
            font-size: 1rem;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Detail Styles */
        .detail-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem;
            border-radius: 12px;
            transition: all 0.15s ease-in-out;
        }

        .detail-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            background: #00d084;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.125rem;
        }

        .detail-content {
            flex: 1;
        }

        .detail-label {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 0.1rem;
            display: block;
            line-height: 1.2;
        }

        .detail-value {
            color: #1e293b;
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.2;
        }

        .payment-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem;
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 0.75rem;
        }

        .payment-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            background: #00d084;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.125rem;
        }

        .payment-content {
            flex: 1;
        }

        .payment-label {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 0.1rem;
            display: block;
            line-height: 1.2;
        }

        .payment-value {
            color: #1e293b;
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.2;
        }

        /* Fee Preview */
        .fee-preview {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border-radius: 16px;
            padding: 1.5rem;
            color: white;
        }

        .fee-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fee-info h6 {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .fee-info small {
            color: rgba(255, 255, 255, 0.8);
        }

        .fee-amount h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: rgb(255, 255, 255);
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-badge.pending {
            background: rgba(255, 255, 255, 0.2);
        }

        .status-badge.confirmed {
            background: rgba(255, 255, 255, 0.2);
        }

        .status-badge.rejected {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Payment Method Box */
        .method-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .method-icon {
            width: 48px;
            height: 48px;
            background: #f0fdf4;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00d084;
            font-size: 1.25rem;
        }

        .method-info {
            flex: 1;
        }

        .method-label {
            display: block;
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.25rem;
        }

        .method-value {
            color: #1e293b;
            font-weight: 600;
            margin: 0;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 208, 132, 0.2);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .main-content {
                padding-top: 100px;
            }

            .status-icon {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentId = '{{ $payment->id }}';
            const statusContainer = document.getElementById('status-container');

            // Function to check payment status
            function checkPaymentStatus() {
                fetch('{{ route('frontend.payment.status', ['paymentId' => $payment->id]) }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.status !== '{{ $payment->status }}') {
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error checking payment status:', error);
                    });
            }

            // Check status every 3 seconds if payment is pending
            @if($payment->status == 'pending')
                const statusInterval = setInterval(checkPaymentStatus, 3000);

                // Clear interval when leaving the page
                window.addEventListener('beforeunload', function () {
                    clearInterval(statusInterval);
                });
            @endif
                });
    </script>
@endpush