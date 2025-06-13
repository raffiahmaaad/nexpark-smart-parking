@extends('frontend.layouts.app')
@section('title', 'Booking Parkir - NexPark')
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

        /* Form Controls */
        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 2px solid #f0f2f5;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #00d084;
            box-shadow: 0 0 0 0.2rem rgba(0, 208, 132, 0.15);
            background: #fff;
        }

        /* Custom Select Styling */
        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2300d084' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        select.form-control:hover {
            border-color: #00d084;
            background-color: #fff;
        }

        select.form-control:focus {
            border-color: #00d084;
            box-shadow: 0 0 0 0.2rem rgba(0, 208, 132, 0.15);
            background-color: #fff;
        }

        /* Dropdown Options Styling */
        select.form-control option {
            padding: 1rem;
            font-size: 1rem;
            background: #fff;
            color: #1e293b;
        }

        select.form-control option:hover,
        select.form-control option:focus,
        select.form-control option:checked {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            color: #fff;
        }

        .form-label {
            color: #64748b;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* Parking Map */
        .parking-map {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2rem;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-out;
        }

        .slots-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
            padding: 1rem;
            background: rgba(248, 250, 252, 0.5);
            border-radius: 12px;
        }

        .slot-item {
            position: relative;
            perspective: 1000px;
        }

        .slot-radio {
            display: none;
        }

        .slot-label {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 48px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #1e293b;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .slot-label:hover:not(.booked):not(.occupied) {
            border-color: #00d084;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 208, 132, 0.1);
        }

        .slot-radio:checked+.slot-label {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 208, 132, 0.2);
        }

        .slot-label.booked {
            background: #facc15;
            border-color: #facc15;
            color: white;
            cursor: not-allowed;
            opacity: 0.8;
        }

        .slot-label.occupied {
            background: #f90000;
            border-color: #ff6e6e;
            color: white;
            cursor: not-allowed;
            opacity: 0.8;
        }

        /* Area Title */
        .area-title {
            color: #1e293b;
            font-weight: 600;
            margin-top: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f2f5;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .area-title i {
            color: #00d084;
        }

        /* Fee Preview */
        .fee-preview {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border-radius: 20px;
            padding: 25px;
            color: white;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 208, 132, 0.15);
            transition: all 0.3s ease;
        }

        .fee-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fee-info h6 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 8px;
            color: white;
        }

        .fee-info small {
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
            font-weight: 400;
        }

        .fee-amount h4 {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin: 0;
            letter-spacing: 0.5px;
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
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 208, 132, 0.15);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 208, 132, 0.25);
        }

        .btn-primary i {
            font-size: 18px;
        }

        /* Legend */
        .parking-legend {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            color: #64748b;
            transition: all 0.3s ease;
        }

        .legend-item:hover {
            transform: translateY(-1px);
        }

        .legend-color {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .available {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
        }

        .selected {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border: none;
        }

        .booked {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
        }

        .occupied {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            border: none;
        }

        /* Area Info */
        .area-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1.25rem;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .area-info:first-child {
            margin-top: 0;
        }

        .area-info:hover {
            background: #f1f5f9;
        }

        .area-status {
            font-size: 0.875rem;
            color: #64748b;
        }

        .area-status span {
            font-weight: 600;
            color: #00d084;
        }

        .slots-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
            padding: 1rem;
            background: rgba(248, 250, 252, 0.5);
            border-radius: 12px;
        }

        .parking-area-section {
            margin-bottom: 2.5rem;
        }

        .parking-area-section:last-child {
            margin-bottom: 0;
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

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.5s ease-out;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .slots-grid {
                grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
                gap: 0.75rem;
            }

            .main-content {
                padding-top: 100px;
            }

            .parking-legend {
                gap: 0.75rem;
            }

            .legend-color {
                width: 20px;
                height: 20px;
            }

            .fee-preview {
                padding: 20px;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            .fee-info h6 {
                font-size: 20px;
                margin-bottom: 6px;
            }

            .fee-info small {
                font-size: 14px;
            }

            .fee-amount h4 {
                font-size: 24px;
            }

            .btn-primary {
                padding: 12px 25px;
                font-size: 15px;
            }
        }

        /* Detail Box Styling */
        .detail-box {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .detail-grid {
            display: grid;
            gap: 25px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .detail-icon {
            width: 42px;
            height: 42px;
            background: #00d084;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            box-shadow: 0 4px 12px rgba(0, 208, 132, 0.15);
        }

        .detail-icon i {
            font-size: 20px;
            color: white;
        }

        .detail-content {
            flex: 1;
        }

        .detail-label {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 2px;
            font-weight: 500;
        }

        .detail-value {
            color: #1e293b;
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        /* Update registration box to match detail styling */
        .registration-box {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .registration-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            background: #00d084;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            box-shadow: 0 4px 12px rgba(0, 208, 132, 0.15);
        }

        .registration-icon i {
            font-size: 20px;
            color: white;
        }

        .registration-content {
            flex: 1;
        }

        .registration-label {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 2px;
            font-weight: 500;
        }

        .registration-number {
            color: #1e293b;
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        @media (max-width: 768px) {

            .registration-icon,
            .detail-icon {
                width: 48px;
                height: 48px;
                min-width: 48px;
            }

            .registration-icon i,
            .detail-icon i {
                font-size: 20px;
            }

            .registration-number,
            .detail-value {
                font-size: 16px;
            }

            .registration-label,
            .detail-label {
                font-size: 14px;
            }

            .registration-box,
            .detail-box {
                padding: 20px;
            }
        }

        .form-section {
            margin-bottom: 20px;
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e293b;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .section-title i {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #00d084;
            color: white;
            border-radius: 8px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #1e293b;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #00d084;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(0, 208, 132, 0.1);
        }

        .form-control:hover {
            border-color: #00d084;
        }

        .parking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .area-section {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .area-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .area-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
        }

        .area-title i {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #00d084;
            color: white;
            border-radius: 8px;
            font-size: 16px;
        }

        .area-status {
            font-size: 0.875rem;
            color: #64748b;
        }

        .area-status span {
            color: #00d084;
            font-weight: 600;
        }

        .slot-radio {
            display: none;
        }

        .slot-label {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 48px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #1e293b;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .slot-label:hover:not(.booked):not(.occupied) {
            border-color: #00d084;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 208, 132, 0.1);
        }

        .slot-radio:checked+.slot-label {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 208, 132, 0.2);
        }

        .slot-label.booked {
            background: #facc15;
            border-color: #faa615;
            color: white;
            cursor: not-allowed;
            opacity: 0.8;
        }

        .slot-label.occupied {
            background: #f90000;
            border-color: #ff6e6e;
            color: white;
            cursor: not-allowed;
            opacity: 0.8;
        }

        .btn-submit {
            background: linear-gradient(135deg, #00d084 0%, #00b8d4 100%);
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            width: 100%;
            transition: all 0.15s ease-in-out;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 208, 132, 0.2);
        }

        /* Icon Styling */
        .info-icon {
            width: 42px;
            height: 42px;
            background: #00d084;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            box-shadow: 0 4px 12px rgba(0, 208, 132, 0.15);
        }

        .info-icon i {
            font-size: 20px;
            color: white;
        }

        .info-box {
            display: flex;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 2px;
            font-weight: 500;
        }

        .info-value {
            color: #1e293b;
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        /* Animation for icons */
        .info-icon {
            transition: all 0.3s ease;
        }

        .info-box:hover .info-icon {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 208, 132, 0.2);
        }
    </style>
@endpush

@section('content')
    <div class="page-background"></div>
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header py-4">
                            <h4 class="mb-0 text-white text-center font-weight-bold">Form Booking Parkir</h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('frontend.parking.book') }}" method="POST">
                                @csrf
                                <!-- Registration Number -->
                                <div class="mb-4">
                                    <div class="registration-box d-flex align-items-center">
                                        <div class="registration-icon">
                                            <i class="fas fa-ticket-alt"></i>
                                        </div>
                                        <div class="registration-content">
                                            <div class="registration-label">Nomor Registrasi</div>
                                            <div class="registration-number">{{ $registration_number }}</div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="registration_number" value="{{ $registration_number }}">
                                </div>

                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-car"></i>
                                        Informasi Kendaraan
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Kendaraan</label>
                                            <input type="text"
                                                class="form-control @error('vehicle_name') is-invalid @enderror"
                                                name="vehicle_name" value="{{ old('vehicle_name') }}" required>
                                            @error('vehicle_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nomor Polisi</label>
                                            <input type="text"
                                                class="form-control @error('plat_number') is-invalid @enderror"
                                                name="plat_number" value="{{ old('plat_number') }}" required>
                                            @error('plat_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Kategori Kendaraan</label>
                                            <select class="form-control @error('category_id') is-invalid @enderror"
                                                name="category_id" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Durasi (Jam)</label>
                                            <input type="number"
                                                class="form-control @error('duration') is-invalid @enderror" name="duration"
                                                value="{{ old('duration') }}" required min="1">
                                            @error('duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Pilih Slot Parkir
                                    </h5>
                                    <div class="parking-legend">
                                        <div class="legend-item">
                                            <div class="legend-color available"></div>
                                            <span>Tersedia</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-color selected"></div>
                                            <span>Dipilih</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-color booked"
                                                style="background: #facc15; border: 1.5px solid #facc15;"></div>
                                            <span>Dipesan</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-color occupied"
                                                style="background: #f90000; border: 1.5px solid #f90000;"></div>
                                            <span>Terisi</span>
                                        </div>
                                    </div>

                                    <div class="parking-map">
                                        @foreach($parkingAreas as $area)
                                            <div class="parking-area-section">
                                                <div class="area-info">
                                                    <h6 class="area-title mb-0">
                                                        <i class="fas fa-parking"></i>
                                                        Parkir Area {{ $area }}
                                                    </h6>
                                                    <div class="area-status">
                                                        Tersedia: <span>{{ $availableSlots[$area] }}</span> dari
                                                        <span>20</span>
                                                    </div>
                                                </div>
                                                <div class="slots-grid">
                                                    @for($i = 1; $i <= 20; $i++)
                                                        @php
                                                            $slotNumber = $area . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                                                            $isBooked = in_array($slotNumber, $bookedSlots);
                                                            $isOccupied = in_array($slotNumber, $occupiedSlots);

                                                            $slot = App\Models\ParkingSlot::where('area_name', $area)
                                                                ->where('slot_number', $slotNumber)
                                                                ->first();
                                                        @endphp
                                                        @if($slot)
                                                            <div class="slot-item">
                                                                <input type="radio" name="parking_slot_id" id="{{ $slotNumber }}"
                                                                    value="{{ $slot->id }}" class="slot-radio" {{ old('parking_slot_id') == $slot->id ? 'checked' : '' }} {{ $slot->status !== 'available' ? 'disabled' : '' }} required>
                                                                <label for="{{ $slotNumber }}"
                                                                    class="slot-label {{ $slot->status !== 'available' ? $slot->status : '' }}">
                                                                    {{ $slotNumber }}
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="slot-item">
                                                                <input type="radio" name="parking_slot_id" id="{{ $slotNumber }}"
                                                                    disabled class="slot-radio">
                                                                <label for="{{ $slotNumber }}" class="slot-label occupied">
                                                                    {{ $slotNumber }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('parking_slot_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Lokasi Parkir
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <div class="info-icon">
                                                    <i class="fas fa-map"></i>
                                                </div>
                                                <div class="info-content">
                                                    <div class="info-label">Area</div>
                                                    <div class="info-value" id="selectedArea">-</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="info-box">
                                                <div class="info-icon">
                                                    <i class="fas fa-parking"></i>
                                                </div>
                                                <div class="info-content">
                                                    <div class="info-label">Nomor Slot</div>
                                                    <div class="info-value" id="selectedSlot">-</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fee Preview -->
                                <div class="fee-preview">
                                    <div class="fee-content">
                                        <div class="fee-info">
                                            <h6 class="mb-1">Total Pembayaran</h6>
                                            <small>Biaya parkir × Durasi</small>
                                        </div>
                                        <div class="fee-amount">
                                            <h4 class="mb-0">Rp {{ number_format($baseFee, 0, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                </div>



                                <button type="submit" class="btn btn-primary w-100 mt-4">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Konfirmasi Booking
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.querySelector('select[name="category_id"]');
            const durationInput = document.querySelector('input[name="duration"]');
            const feeDisplay = document.querySelector('.fee-amount h4');
            const feePreview = document.querySelector('.fee-preview');
            const selectedAreaDisplay = document.getElementById('selectedArea');
            const selectedSlotDisplay = document.getElementById('selectedSlot');

            // Store category fees
            const categoryFees = {
                @foreach($categories as $category)
                    {{ $category->id }}: {{ $category->fee_per_hour }},
                @endforeach
                                                                };

        function calculateTotal() {
            const categoryId = categorySelect.value;
            const duration = parseInt(durationInput.value) || 0;

            if (categoryId && duration > 0) {
                const feePerHour = categoryFees[categoryId] || 0;
                const total = feePerHour * duration;
                feeDisplay.textContent = `Rp ${total.toLocaleString('id-ID')}`;
                feePreview.style.display = 'block';
            } else {
                feePreview.style.display = 'none';
            }
        }

        // Update parking location info when slot is selected
        const slotRadios = document.querySelectorAll('input[name="parking_slot_id"]');
        slotRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.checked) {
                    const slotLabel = document.querySelector(`label[for="${this.id}"]`);
                    const slotNumber = slotLabel.textContent.trim();
                    const area = slotNumber.split('-')[0];

                    selectedAreaDisplay.textContent = `${area}`;
                    selectedSlotDisplay.textContent = slotNumber;
                }
            });
        });

        // Calculate on change
        categorySelect.addEventListener('change', calculateTotal);
        durationInput.addEventListener('input', calculateTotal);

        // Initial check
        calculateTotal();
                                                            });
    </script>
@endpush