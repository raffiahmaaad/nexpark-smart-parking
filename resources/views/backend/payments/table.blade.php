@push('styles')
    <style>
        .table {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
            color: #495057;
            font-size: 0.9rem;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: all 0.2s ease;
        }

        .table-user-thumb {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .table-actions a {
            padding: 6px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .table-actions a:hover {
            background: #e9ecef;
            color: #495057;
        }

        .table-actions .ik {
            font-size: 1.1rem;
        }

        /* Specific icon colors based on user request */
        #data_table .table-actions a .ik.ik-eye {
            color: #3498db !important;
            /* Blue color for view icon */
        }

        #data_table .table-actions a .ik.ik-check-circle {
            color: #00c16e !important;
            /* Green color for confirm icon */
        }

        #data_table .table-actions a .ik.ik-x-circle {
            color: #dc3545 !important;
            /* Red color for reject icon */
        }

        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
            min-width: 100px;
            text-align: center;
            display: inline-block;
        }

        .badge-pending {
            background: #FFD700;
            color: #856404;
            border: none;
            box-shadow: 0 2px 4px rgba(255, 215, 0, 0.2);
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        /* DataTables Custom Styling */
        div.dataTables_wrapper div.dataTables_length {
            margin-bottom: 0;
        }

        div.dataTables_wrapper div.dataTables_length label {
            font-weight: normal;
            text-align: left;
            white-space: nowrap;
            color: #666;
            margin-bottom: 0;
            font-size: 14px;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: auto;
            display: inline-block;
            padding: 2px 20px 2px 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 0;
            text-align: right;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            text-align: left;
            white-space: nowrap;
            color: #666;
            margin-bottom: 0;
            font-size: 14px;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: 0.5em;
            display: inline-block;
            width: auto;
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #fff;
            font-size: 14px;
        }
    </style>
@endpush

<div class="table-responsive">
    <table id="data_table" class="table">
        <thead>
            <tr>
                <th style="width: 50px; text-align: center;">ID</th>
                <th style="width: 180px;">Informasi Pelanggan</th>
                <th style="width: 100px;">Plat Nomor</th>
                <th>Nomor Registrasi</th>
                <th style="width: 120px;">Area & Slot Parkir</th>
                <th>Durasi Parkir</th>
                <th>Total Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th class="text-center">Status</th>
                <th style="width: 50px; text-align: center;" class="nosort">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $key => $payment)
                @php
                    $customer = optional($payment->vehicleIn)->vehicle->customer ?? null;
                    $vehicleIn = $payment->vehicleIn ?? null;
                    $vehicle = $vehicleIn->vehicle ?? null;
                    $parkingSlot = $vehicleIn->slot ?? null;
                @endphp
                <tr data-payment-id="{{ $payment->id }}">
                    <td style="text-align: center;">{{ $key + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($customer && $customer->avatar)
                                <img src="{{ asset($customer->avatar) }}" class="table-user-thumb" alt="{{ $customer->name }}">
                            @else
                                @php
                                    $colors = ['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#34495e', '#16a085', '#27ae60', '#2980b9', '#8e44ad', '#2c3e50'];
                                    $randomColor = $colors[array_rand($colors)];
                                @endphp
                                <div class="table-user-thumb d-flex align-items-center justify-content-center"
                                    style="background-color: {{ $randomColor }}; color: white; font-weight: bold;">
                                    {{ strtoupper(substr($customer->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                            <div class="ml-2">
                                <div class="font-weight-medium">{{ $customer->name ?? 'N/A' }}</div>
                                <div class="text-muted small">{{ $customer->email ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $vehicle->plat_number ?? 'N/A' }}</td>
                    <td>{{ $vehicle->registration_number ?? 'N/A' }}</td>
                    <td>({{ $parkingSlot->area_name ?? 'N/A' }}) - ({{ $parkingSlot->slot_number ?? 'N/A' }})</td>
                    <td>{{ $vehicleIn->duration ?? 'N/A' }}</td>
                    <td>
                        <div class="font-weight-medium">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                    </td>
                    <td>
                        @php
                            $method = $payment->payment_method ?? 'transfer'; // Default to 'transfer' if null
                            $displayMethod = 'N/A';
                            if ($method === 'transfer') {
                                $displayMethod = 'Transfer Bank';
                            } elseif ($method === 'qris') {
                                $displayMethod = 'QRIS';
                            } else {
                                $displayMethod = $method; // Display original if neither
                            }
                        @endphp
                        {{ $displayMethod }}
                    </td>
                    <td class="text-center">
                        @if($payment->status == 'pending')
                            <span class="badge" style="background: #FFC107; color: #fff;">Menunggu</span>
                        @elseif($payment->status == 'confirmed')
                            <span class="badge badge-success d-inline-block">Dikonfirmasi</span>
                        @elseif($payment->status == 'rejected')
                            <span class="badge badge-danger d-inline-block">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions justify-content-center">
                            <a href="#" data-toggle="modal" data-target="#showModal{{ $payment->id }}" data-toggle="tooltip"
                                title="Lihat Detail">
                                <i class="ik ik-eye" style="color: #3498db !important;"></i>
                            </a>
                            @if($payment->status == 'pending')
                                <a href="#" data-toggle="modal" data-target="#confirmModal{{ $payment->id }}"
                                    data-toggle="tooltip" title="Konfirmasi">
                                    <i class="ik ik-check-circle" style="color: #00c16e !important;"></i>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#rejectModal{{ $payment->id }}"
                                    data-toggle="tooltip" title="Tolak">
                                    <i class="ik ik-x-circle" style="color: #dc3545 !important;"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">
                        <div class="empty-state">
                            <i class="ik ik-credit-card"></i>
                            <p>Tidak ada data pembayaran yang tersedia</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Add smooth fade effect on hover
            $('.table tbody tr').hover(
                function () {
                    $(this).css('transform', 'translateY(-2px)');
                    $(this).css('transition', 'transform 0.2s ease');
                },
                function () {
                    $(this).css('transform', 'translateY(0)');
                }
            );
        });
    </script>
@endpush