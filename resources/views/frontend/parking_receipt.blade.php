@extends('frontend.layouts.app')
@section('title', 'Receipt - NexPark')
@push('styles')
    @include('frontend.layouts.navbar-style')
@endpush

@section('content')
    <div class="page-background"></div>
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header py-4">
                            <h4 class="mb-0 text-white text-center font-weight-bold">
                                <i class="fas fa-check-circle me-2"></i> Booking Parkir Berhasil
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <!-- QR Code -->
                            <div class="text-center mb-4">
                                <div class="qr-container">
                                    @php
                                        $qrData = $vehicleIn->registration_number ?? $vehicleIn->id;
                                        $qrText = strval($qrData); // Ensure we have a string
                                    @endphp
                                    <div class="qr-wrapper">
                                        {!! QrCode::size(150)->format('svg')->generate($qrText) !!}
                                        <div class="qr-overlay"></div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="qr-instruction">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Tunjukkan QR Code ini saat masuk & keluar area parkir
                                    </span>
                                </div>
                            </div>

                            <!-- Booking Details -->
                            <div class="booking-details">
                                <h5 class="section-title">Detail Booking</h5>

                                <!-- Registration Info -->
                                <div class="detail-box">
                                    <div class="detail-grid">
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-ticket-alt"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Nomor Registrasi</span>
                                                <h6 class="detail-value registration-value">
                                                    {{ $vehicleIn->vehicle->registration_number }}
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="detail-content">
                                                <span class="detail-label">Tanggal Booking</span>
                                                <h6 class="detail-value">{{ $vehicleIn->created_at->format('d M Y H:i') }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vehicle Info -->
                                <div class="info-section mt-4">
                                    <h5 class="section-title">Informasi Kendaraan</h5>
                                    <div class="detail-box">
                                        <div class="detail-grid">
                                            <div class="detail-item">
                                                <div class="detail-icon">
                                                    <i class="fas fa-car"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <span class="detail-label">Nama Kendaraan</span>
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
                                                    <i class="fas fa-tag"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <span class="detail-label">Kategori</span>
                                                    <h6 class="detail-value">{{ $vehicleIn->vehicle->category->name }}</h6>
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
                                        </div>
                                    </div>
                                </div>

                                <!-- Parking Location -->
                                <div class="info-section mt-4">
                                    <h5 class="section-title">
                                        Lokasi Parkir
                                    </h5>
                                    <div class="detail-box">
                                        <div class="detail-grid">
                                            <div class="detail-item">
                                                <div class="detail-icon">
                                                    <i class="fas fa-map"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <span class="detail-label">Area</span>
                                                    <h6 class="detail-value">
                                                        {{ $vehicleIn->slot ? $vehicleIn->slot->area_name : '-' }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="detail-item">
                                                <div class="detail-icon">
                                                    <i class="fas fa-parking"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <span class="detail-label">Nomor Slot</span>
                                                    <h6 class="detail-value">
                                                        {{ $vehicleIn->slot ? $vehicleIn->slot->slot_number : '-' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Info -->
                                <div class="info-section mt-4">
                                    <h5 class="section-title">Informasi Pembayaran</h5>
                                    <div class="fee-preview">
                                        <div class="fee-content">
                                            <div class="fee-info">
                                                <h6 class="mb-1">Total Pembayaran</h6>
                                                <small>Biaya parkir × Durasi</small>
                                            </div>
                                            <div class="fee-amount">
                                                <h4 class="mb-0">Rp {{ number_format($payment->amount, 0, ',', '.') }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Important Notes -->
                                <div class="info-section mt-4">
                                    <div class="notes-box">
                                        <h6 class="notes-title">
                                            <i class="fas fa-info-circle me-2"></i> Informasi Penting:
                                        </h6>
                                        <ul class="notes-list">
                                            <li>
                                                <i class="fas fa-check-circle me-2"></i>
                                                <span> Simpan QR Code untuk akses masuk & keluar parkir</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle me-2"></i>
                                                <span> Scan QR Code saat masuk & keluar area parkir</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle me-2"></i>
                                                <span> Datang & Keluar sesuai waktu yang telah dipesan</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-check-circle me-2"></i>
                                                <span> Parkir di slot yang telah ditentukan</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="action-buttons mt-4">
                                    <a href="{{ route('frontend.index') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-home me-2"></i> Kembali ke Beranda
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
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
                margin-bottom: 1rem;
                padding-bottom: 0.75rem;
                border-bottom: 2px solid #f0f2f5;
                font-size: 1.125rem;
            }

            .section-title i {
                color: #00d084;
                margin-right: 0.5rem;
            }

            /* QR Code Styles */
            .qr-container {
                position: relative;
                display: inline-block;
                padding: 2rem;
                background: #f8fafc;
                border-radius: 20px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                animation: fadeInUp 0.5s ease-out;
                transition: all 0.3s ease;
            }

            .qr-container:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(0, 208, 132, 0.15);
            }

            .qr-wrapper {
                position: relative;
                z-index: 2;
                padding: 1rem;
                background: white;
                border-radius: 12px;
                transition: all 0.3s ease;
            }

            .qr-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(120deg,
                        transparent 30%,
                        rgba(255, 255, 255, 0.2) 40%,
                        transparent 50%);
                opacity: 0;
                transition: opacity 0.3s ease;
                border-radius: 12px;
            }

            .qr-container:hover .qr-overlay {
                opacity: 1;
            }

            .qr-instruction {
                display: inline-block;
                padding: 0.5rem 1rem;
                background: rgba(0, 208, 132, 0.1);
                border-radius: 9999px;
                color: #00d084;
                font-size: 0.875rem;
                animation: fadeIn 0.5s ease-out 0.3s both;
                transition: all 0.3s ease;
            }

            .qr-instruction i {
                color: #00d084;
            }

            .qr-instruction:hover {
                background: rgba(0, 208, 132, 0.15);
                transform: translateY(-1px);
            }

            /* Detail Box Styles */
            .detail-box {
                background: #f8fafc;
                border-radius: 16px;
                padding: 1.25rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                animation: fadeIn 0.5s ease-out;
                margin-bottom: 1rem;
            }

            .detail-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 1rem;
            }

            .detail-item {
                display: flex;
                align-items: center;
                gap: 0.875rem;
                padding: 0.5rem;
            }

            .detail-icon {
                width: 42px;
                height: 42px;
                background: #00d084;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.125rem;
                flex-shrink: 0;
            }

            .detail-content {
                flex: 1;
                min-width: 0;
            }

            .detail-label {
                display: block;
                color: #64748b;
                font-size: 0.813rem;
                margin-bottom: 0.25rem;
                font-weight: 500;
            }

            .detail-value {
                color: #1e293b;
                font-weight: 600;
                margin: 0;
                font-size: 0.938rem;
                line-height: 1.3;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            /* Info Section */
            .info-section {
                margin-top: 1.5rem;
            }

            .info-section:first-child {
                margin-top: 0;
            }

            /* Registration Value */
            .registration-value {
                font-size: 1rem !important;
                font-weight: 600 !important;
                color: #1e293b !important;
                letter-spacing: 0.5px;
            }

            @media (max-width: 768px) {
                .detail-grid {
                    gap: 0.75rem;
                }

                .detail-item {
                    padding: 0.375rem;
                }

                .detail-icon {
                    width: 32px;
                    height: 32px;
                    font-size: 1rem;
                }

                .detail-label {
                    font-size: 0.75rem;
                }

                .detail-value {
                    font-size: 0.875rem;
                }

                .section-title {
                    font-size: 1rem;
                    margin-bottom: 0.75rem;
                    padding-bottom: 0.5rem;
                }

                .info-section {
                    margin-top: 1.25rem;
                }
            }

            /* Fee Preview */
            .fee-preview {
                background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
                border-radius: 16px;
                padding: 1.5rem;
                color: white;
                animation: fadeIn 0.5s ease-out;
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

            /* Notes Box */
            .notes-box {
                background: linear-gradient(135deg, rgba(0, 208, 132, 0.05) 0%, rgba(0, 184, 212, 0.05) 100%);
                border-radius: 16px;
                padding: 1.5rem;
                border: 1px solid rgba(0, 208, 132, 0.1);
                animation: fadeIn 0.5s ease-out;
            }

            .notes-title {
                color: #1e293b;
                font-weight: 600;
                margin-bottom: 1.5rem;
                display: flex;
                align-items: center;
                font-size: 1.1rem;
            }

            .notes-title i {
                color: #00d084;
                margin-right: 0.75rem;
                font-size: 1.25rem;
            }

            .notes-list {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .notes-list li {
                display: flex;
                align-items: center;
                color: #4b5563;
                padding: 1rem;
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.8);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
                border: 1px solid rgba(0, 208, 132, 0.1);
            }

            .notes-list li i {
                color: #00d084;
                font-size: 1.1rem;
                margin-right: 1rem;
                background: rgba(0, 208, 132, 0.1);
                padding: 0.5rem;
                border-radius: 50%;
                width: 2.5rem;
                height: 2.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .notes-list li span {
                font-size: 0.95rem;
                font-weight: 500;
            }

            .notes-list li:hover {
                transform: translateX(5px);
                background: white;
                box-shadow: 0 4px 6px rgba(0, 208, 132, 0.1);
            }

            .notes-list li:hover i {
                background: #00d084;
                color: white;
            }

            /* Action Buttons */
            .action-buttons {
                display: flex;
                gap: 1rem;
                justify-content: space-between;
                animation: fadeIn 0.5s ease-out;
            }

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

            .btn-outline-primary {
                border: 2px solid #00d084;
                color: #00d084;
                background: transparent;
            }

            .btn-outline-primary i {
                color: #00d084;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(0, 208, 132, 0.2);
            }

            /* Animations */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(5px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Print Styles */
            @media print {
                body * {
                    visibility: hidden;
                }

                .card,
                .card * {
                    visibility: visible;
                }

                .card {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }

                .btn,
                .qr-overlay {
                    display: none;
                }

                .page-background {
                    display: none;
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

                .action-buttons {
                    flex-direction: column;
                }

                .btn {
                    width: 100%;
                }

                .registration-value {
                    font-size: 1rem;
                }
            }

            /* Registration Number Styles */
            .registration-box {
                margin-top: 0.5rem;
            }

            .registration-number {
                font-size: 1.25rem;
                font-weight: 700;
                color: #2563eb;
                letter-spacing: 1px;
                font-family: 'Courier New', monospace;
                background: rgba(37, 99, 235, 0.1);
                padding: 0.5rem 1rem;
                border-radius: 8px;
                display: inline-block;
            }

            @media (max-width: 768px) {
                .registration-number {
                    font-size: 1rem;
                    padding: 0.35rem 0.75rem;
                }
            }
        </style>
    @endpush
@endsection