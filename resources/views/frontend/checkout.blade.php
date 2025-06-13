@extends('frontend.layouts.app')
@section('title', 'Checkout - NexPark')

@section('content')
    <div class="page-background"></div>
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header py-4">
                            <h4 class="mb-0 text-white text-center font-weight-bold">Checkout Parkir</h4>
                        </div>
                        <div class="card-body p-4">
                            <!-- Order Summary -->
                            <div class="order-summary mb-4">
                                <h5 class="section-title">Detail Pesanan</h5>
                                <div class="detail-box">
                                    <div class="detail-grid">
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-car"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Kendaraan</span>
                                                <h6 class="detail-value">{{ $vehicleIn->vehicle->name }}</h6>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-id-card"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Nomor Polisi</span>
                                                <h6 class="detail-value">{{ $vehicleIn->vehicle->plat_number }}</h6>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Durasi</span>
                                                <h6 class="detail-value">{{ $vehicleIn->duration }} Jam</h6>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Area Parkir</span>
                                                <h6 class="detail-value">
                                                    Area {{ $vehicleIn->slot ? $vehicleIn->slot->area_name : '-' }}
                                                    <span
                                                        class="selected-area">({{ $vehicleIn->slot ? $vehicleIn->slot->slot_number : '-' }})
                                                    </span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="fee-preview mt-4">
                                    <div class="fee-content">
                                        <div class="fee-info">
                                            <h6 class="mb-1">Total Pembayaran</h6>
                                            <small class="text-muted">Biaya parkir × Durasi</small>
                                        </div>
                                        <div class="fee-amount">
                                            <h4 class="mb-0">Rp {{ number_format($amount, 0, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <form action="{{ route('frontend.payment.process', $vehicleIn->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="payment-method mb-4">
                                    <h5 class="section-title">Metode Pembayaran</h5>
                                    <div class="payment-options">
                                        <div class="payment-option">
                                            <input type="radio" class="payment-radio" name="payment_method" id="transfer"
                                                value="transfer" checked>
                                            <label class="payment-label" for="transfer">
                                                <div class="payment-icon">
                                                    <i class="fas fa-university"></i>
                                                </div>
                                                <div class="payment-text">
                                                    <span class="payment-title">Transfer Bank</span>
                                                    <span class="payment-desc">Transfer melalui bank pilihan Anda
                                                    </span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="payment-option">
                                            <input type="radio" class="payment-radio" name="payment_method" id="qris"
                                                value="qris">
                                            <label class="payment-label" for="qris">
                                                <div class="payment-icon">
                                                    <i class="fas fa-qrcode"></i>
                                                </div>
                                                <div class="payment-text">
                                                    <span class="payment-title">QRIS</span>
                                                    <span class="payment-desc">Scan & bayar dengan QRIS</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Instructions -->
                                <div class="payment-instructions mb-4">
                                    <div class="instruction-box">
                                        <div id="transferInstructions">
                                            <h6 class="instruction-title">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Instruksi Pembayaran
                                            </h6>
                                            <h6 class="instruction-title-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Transfer Bank hanya bisa dilakukan pada nominal diatas Rp. 10.000
                                            </h6>
                                            <div class="bank-details">
                                                <div class="bank-item">
                                                    <i class="fas fa-university bank-icon"></i>
                                                    <div class="bank-info">
                                                        <span class="bank-label">Bank</span>
                                                        <strong class="bank-value">BCA</strong>
                                                    </div>
                                                </div>
                                                <div class="bank-item">
                                                    <i class="fas fa-credit-card bank-icon"></i>
                                                    <div class="bank-info">
                                                        <span class="bank-label">Nomor Rekening</span>
                                                        <strong class="bank-value">7645182600</strong>
                                                    </div>
                                                </div>
                                                <div class="bank-item">
                                                    <i class="fas fa-user bank-icon"></i>
                                                    <div class="bank-info">
                                                        <span class="bank-label">Atas Nama</span>
                                                        <strong class="bank-value">Raffi Ahmad</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="qrisInstructions" style="display: none;">
                                            <h6 class="instruction-title">
                                                <i class="fas fa-qrcode me-2"></i>
                                                Scan QRIS
                                            </h6>
                                            <div class="qris-container">
                                                <img src="{{ asset('images/qris-code.png') }}" alt="QRIS Code"
                                                    class="qris-image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Proof -->
                                <div class="upload-proof mb-4">
                                    <h5 class="section-title">Upload Bukti Pembayaran</h5>
                                    <div class="upload-box">
                                        <div class="upload-area">
                                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                            <div class="upload-text">
                                                <span class="upload-title">Pilih File</span>
                                                <span class="upload-desc">Format: JPG, PNG, PDF (Max. 2MB)</span>
                                            </div>
                                            <input type="file" class="upload-input" id="proofImage" name="proof_image"
                                                required>
                                        </div>
                                        @error('proof_image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-4">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Konfirmasi Pembayaran
                                </button>
                            </form>
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

        .detail-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem;
            border-radius: 12px;
            transition: all 0.3s ease;
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
            color: rgba(255, 255, 255);
        }

        .fee-amount h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: rgb(255, 255, 255);
        }

        .payment-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
            perspective: 1000px;
        }

        .payment-option {
            position: relative;
            transform-style: preserve-3d;
            backface-visibility: hidden;
        }

        .payment-radio {
            display: none;
        }

        .payment-label {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            height: 100%;
            min-height: 85px;
            position: relative;
            overflow: hidden;
            will-change: transform, border-color, box-shadow;
        }

        .payment-label::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #f0fdf4;
            opacity: 0;
            transition: opacity 0.15s ease-in-out;
            z-index: 0;
            will-change: opacity;
        }

        .payment-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            background: #00d084;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            position: relative;
            z-index: 1;
            transition: transform 0.15s ease-in-out;
            will-change: transform;
        }

        .payment-text {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .payment-title {
            display: block;
            font-weight: 600;
            color: #1e293b;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            transition: color 0.15s ease-in-out;
            will-change: color;
        }

        .payment-desc {
            display: block;
            font-size: 0.875rem;
            color: #64748b;
            line-height: 1.2;
            transition: color 0.15s ease-in-out;
        }

        .payment-radio:checked+.payment-label {
            border: 2px solid #00d084;
            transform: translateZ(0);
        }

        .payment-radio:checked+.payment-label::before {
            opacity: 1;
        }

        .payment-radio:checked+.payment-label .payment-icon {
            transform: scale(1.05) translateZ(0);
        }

        .payment-radio:checked+.payment-label .payment-title {
            color: #00d084;
        }

        .payment-radio:not(:checked)+.payment-label:hover {
            border-color: #00d084;
            transform: translateY(-1px) translateZ(0);
            box-shadow: 0 4px 6px -1px rgba(0, 208, 132, 0.1), 0 2px 4px -1px rgba(0, 208, 132, 0.06);
        }

        .instruction-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .instruction-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .instruction-title-info {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .bank-details {
            display: grid;
            gap: 0.75rem;
            margin-top: 0.75rem;
        }

        .bank-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem;
            background: white;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .bank-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            background: #00d084;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .bank-info {
            flex: 1;
        }

        .bank-label {
            display: block;
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.1rem;
            line-height: 1.2;
        }

        .bank-value {
            display: block;
            font-size: 0.9375rem;
            color: #1e293b;
            font-weight: 600;
            line-height: 1.2;
        }

        .qris-container {
            display: flex;
            justify-content: center;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            margin-top: 1rem;
        }

        .qris-image {
            max-width: 200px;
            height: auto;
        }

        .upload-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
        }

        .upload-area {
            position: relative;
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: #00d084;
            background: #f0fdf4;
        }

        .upload-icon {
            font-size: 2.5rem;
            color: #00d084;
            margin-bottom: 1rem;
        }

        .upload-text {
            margin-bottom: 1rem;
        }

        .upload-title {
            display: block;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .upload-desc {
            display: block;
            font-size: 0.875rem;
            color: #64748b;
        }

        .upload-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 208, 132, 0.2);
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .payment-options {
                grid-template-columns: 1fr;
            }

            .main-content {
                padding-top: 100px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const transferRadio = document.getElementById('transfer');
            const qrisRadio = document.getElementById('qris');
            const transferInstructions = document.getElementById('transferInstructions');
            const qrisInstructions = document.getElementById('qrisInstructions');

            function toggleInstructions() {
                if (transferRadio.checked) {
                    transferInstructions.style.display = 'block';
                    qrisInstructions.style.display = 'none';
                } else {
                    transferInstructions.style.display = 'none';
                    qrisInstructions.style.display = 'block';
                }
            }

            transferRadio.addEventListener('change', toggleInstructions);
            qrisRadio.addEventListener('change', toggleInstructions);

            // File upload preview
            const uploadInput = document.getElementById('proofImage');
            const uploadArea = document.querySelector('.upload-area');
            const uploadTitle = document.querySelector('.upload-title');

            uploadInput.addEventListener('change', function (e) {
                if (e.target.files && e.target.files[0]) {
                    const fileName = e.target.files[0].name;
                    uploadTitle.textContent = fileName;
                    uploadArea.style.borderStyle = 'solid';
                }
            });
        });
    </script>
@endpush