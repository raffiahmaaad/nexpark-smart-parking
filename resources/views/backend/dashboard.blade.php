@extends('backend.layouts.app')
@section('title', 'Dashboard')

<head>
    <link rel="icon" href="{{ asset('frontend/images/icon.png') }}" type="image/x-icon">
</head>
@push('css')
    <style>
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }

        .bookings-pending::before {
            background: linear-gradient(to right, #FF416C, #FF4B2B);
        }

        .bookings-confirmed::before {
            background: linear-gradient(to right, #00b09b, #96c93d);
        }

        .bookings-cancelled::before {
            background: linear-gradient(to right, #4776E6, #8E54E9);
        }

        .total-income::before {
            background: linear-gradient(to right, #0072ff, #00c6ff);
        }

        .stat-card .icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 48px;
            opacity: 0.1;
        }

        .stat-card .title {
            color: #718096;
            font-size: 0.875rem;
            margin-bottom: 8px;
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: #2D3748;
            margin-bottom: 8px;
        }

        .stat-card .trend {
            font-size: 0.875rem;
            color: #48BB78;
        }

        .stat-card .trend.up {
            color: #48BB78;
        }

        .stat-card .trend.down {
            color: #F56565;
        }

        /* Table Styling */
        .custom-table {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
        }

        .custom-table thead th {
            background: #2D3748;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 16px;
            border: none;
        }

        .custom-table tbody td {
            padding: 16px;
            border-bottom: 1px solid #E2E8F0;
            color: #4A5568;
            font-size: 0.875rem;
            vertical-align: middle;
        }

        .custom-table tbody tr:hover {
            background: #F7FAFC;
        }

        /* Status Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .badge-pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-confirmed {
            background: #DEF7EC;
            color: #03543F;
        }

        .badge-cancelled {
            background: #FDE8E8;
            color: #9B1C1C;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .action-button {
            padding: 6px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .action-button:hover {
            background: #EDF2F7;
        }

        .action-button i {
            font-size: 1.125rem;
        }

        .view-button {
            color: #4299E1;
        }

        .edit-button {
            color: #48BB78;
        }

        .delete-button {
            color: #F56565;
        }

        /* Search and Pagination */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 8px 16px;
            margin-left: 8px;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 8px;
            margin: 0 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 8px 16px;
            margin: 0 4px;
            border-radius: 8px;
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4299E1;
            color: white !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #2B6CB0;
            color: white !important;
            border: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fas fa-tachometer-alt bg-blue"></i>
                        <div class="d-inline">
                            <h5>Dashboard</h5>
                            <span>Manajemen Booking Parkir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <!-- Slot Tersedia -->
            <div class="col-lg-4 col-md-6">
                <div class="stat-card" style="background: #10b981; color: white;">
                    <i class="fas fa-check-circle icon"></i>
                    <div class="title">Slot Tersedia</div>
                    <div class="value">{{ $slotTersedia ?? 0 }}</div>
                </div>
            </div>
            <!-- Slot Dipesan -->
            <div class="col-lg-4 col-md-6">
                <div class="stat-card" style="background: #f59e42; color: white;">
                    <i class="fas fa-clock icon"></i>
                    <div class="title">Slot Dipesan</div>
                    <div class="value">{{ $slotDipesan ?? 0 }}</div>
                </div>
            </div>
            <!-- Slot Terisi -->
            <div class="col-lg-4 col-md-6">
                <div class="stat-card" style="background: #ef4444; color: white;">
                    <i class="fas fa-car icon"></i>
                    <div class="title">Slot Terisi</div>
                    <div class="value">{{ $slotTerisi ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Pending Bookings -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bookings-pending">
                    <i class="fas fa-clock icon"></i>
                    <div class="title">Booking Pending</div>
                    <div class="value">{{ $pendingBookings ?? 0 }}</div>
                    <div class="trend">
                        Menunggu Konfirmasi
                    </div>
                </div>
            </div>

            <!-- Confirmed Bookings -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bookings-confirmed">
                    <i class="fas fa-check-circle icon"></i>
                    <div class="title">Booking Terkonfirmasi</div>
                    <div class="value">{{ $confirmedBookings ?? 0 }}</div>
                    <div class="trend up">
                        Siap Digunakan
                    </div>
                </div>
            </div>

            <!-- Cancelled Bookings -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card bookings-cancelled">
                    <i class="fas fa-times-circle icon"></i>
                    <div class="title">Booking Dibatalkan</div>
                    <div class="value">{{ $cancelledBookings ?? 0 }}</div>
                    <div class="trend down">
                        Tidak Jadi Digunakan
                    </div>
                </div>
            </div>

            <!-- Total Income -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card total-income">
                    <i class="fas fa-money-bill-wave icon"></i>
                    <div class="title">Total Pendapatan</div>
                    <div class="value">Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}</div>
                    <div class="trend up">
                        Dari Semua Booking
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Table -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="custom-table">
                    <table id="booking_table" class="table">
                        <thead>
                            <tr>
                                <th>ID Booking</th>
                                <th>Pelanggan</th>
                                <th>Kendaraan</th>
                                <th>Area Parkir</th>
                                <th>Slot</th>
                                <th>Waktu Mulai</th>
                                <th>Durasi</th>
                                <th>Total Biaya</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_code }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle mr-2">
                                                {{ substr($booking->customer->name ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-weight-medium">{{ $booking->customer->name ?? 'Unknown' }}
                                                </div>
                                                <small class="text-muted">{{ $booking->customer->phone ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="font-weight-medium">{{ $booking->vehicle->name ?? '-' }}</div>
                                            <small class="text-muted">{{ $booking->vehicle->plat_number ?? '-' }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $booking->parking_area ?? '-' }}</td>
                                    <td>{{ $booking->parking_slot ?? '-' }}</td>
                                    <td>{{ $booking->start_time ? date('d M Y H:i', strtotime($booking->start_time)) : '-' }}
                                    </td>
                                    <td>{{ $booking->duration ?? 0 }} Jam</td>
                                    <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge badge-pending">Pending</span>
                                        @elseif($booking->status == 'confirmed')
                                            <span class="badge badge-confirmed">Confirmed</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="badge badge-cancelled">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-button view-button" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if($booking->status == 'pending')
                                                <button class="action-button edit-button" title="Edit Booking">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-button delete-button" title="Cancel Booking">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#booking_table').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"top"fl>rt<"bottom"ip><"clear">',
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    zeroRecords: "Tidak ada data booking yang ditemukan",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    </script>
@endpush