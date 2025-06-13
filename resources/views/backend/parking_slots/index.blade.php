@extends('backend.layouts.app')
@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="fas fa-parking bg-blue"></i>
                    <div class="d-inline">
                        <h5>Manajemen Slot Parkir</h5>
                        <span>Kelola dan monitor slot parkir</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Area Stats -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="stats-card available">
                                <div class="stats-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stats-info">
                                    <h3>{{ $availableCount }}</h3>
                                    <p>Slot Tersedia</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card booked">
                                <div class="stats-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stats-info">
                                    <h3>{{ $bookedCount }}</h3>
                                    <p>Slot Dipesan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card occupied">
                                <div class="stats-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <div class="stats-info">
                                    <h3>{{ $occupiedCount }}</h3>
                                    <p>Slot Terisi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Parking Map -->
                    <div class="parking-map-container">
                        <h5 class="section-title">Peta Parkir - NexPark</h5>
                        <div class="parking-grid">
                            @foreach($slots as $slot)
                                <div class="parking-slot {{ $slot->status }}">
                                    <div class="slot-number">{{ $slot->slot_number }}</div>
                                    <div class="slot-status">
                                        @if($slot->status == 'available')
                                            <span class="badge badge-success">Tersedia</span>
                                        @elseif($slot->status == 'booked')
                                            <span class="badge badge-warning">Dipesan</span>
                                        @elseif($slot->status == 'occupied')
                                            <span class="badge badge-danger">Terisi</span>
                                        @endif
                                    </div>
                                    @if($slot->vehicle_in)
                                        <div class="slot-info">
                                            <small>{{ $slot->vehicle_in->vehicle->plat_number }}</small>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Stats Cards */
        .stats-card {
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .stats-card.available {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
        }

        .stats-card.booked {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
            color: white;
        }

        .stats-card.occupied {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            color: white;
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stats-info h3 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 600;
        }

        .stats-info p {
            margin: 0;
            opacity: 0.9;
        }

        /* Parking Map */
        .parking-map-container {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .section-title {
            color: #1F2937;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #E5E7EB;
        }

        .parking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }

        .parking-slot {
            background: #F9FAFB;
            border: 2px solid #E5E7EB;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .parking-slot.available {
            border-color: #10B981;
            background: #ECFDF5;
        }

        .parking-slot.booked {
            border-color: #F59E0B;
            background: #FFFBEB;
        }

        .parking-slot.occupied {
            border-color: #EF4444;
            background: #FEF2F2;
        }

        .slot-number {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .slot-status {
            margin-bottom: 0.5rem;
        }

        .slot-info {
            font-size: 0.875rem;
            color: #6B7280;
        }

        .badge {
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .badge-success {
            background: #10B981;
            color: white;
        }

        .badge-warning {
            background: #F59E0B;
            color: white;
        }

        .badge-danger {
            background: #EF4444;
            color: white;
        }

        @media (max-width: 768px) {
            .parking-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .stats-card {
                margin-bottom: 1rem;
            }
        }
    </style>
@endsection