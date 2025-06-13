<?php
// Tambahkan style untuk tabel dan badges (copy dari vehicles_in)
?>
<style>
    .table {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        margin-bottom: 1rem;
    }

    .table thead th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 2px solid #e9ecef;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
        color: #2d3436;
        font-size: 0.875rem;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .parking-area {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: rgba(46, 204, 113, 0.1);
        color: #2ecc71;
        border-radius: 6px;
        font-weight: 500;
    }

    .parking-slot {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 0.7rem;
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
        border-radius: 6px;
        font-weight: 500;
        font-family: 'Courier New', monospace;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.75rem;
    }

    .badge-success {
        background-color: rgba(46, 204, 113, 0.1);
        color: #2ecc71;
    }

    .badge-warning {
        background-color: rgba(241, 196, 15, 0.1);
        color: #f1c40f;
    }

    .badge-danger {
        background-color: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
    }

    .badge-out {
        background-color: rgba(241, 196, 15, 0.1);
        color: #f1c40f;
    }

    .table-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }

    .table-actions a {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .table-actions a:hover {
        background-color: #f8f9fa;
    }

    .registration-number {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #2563eb;
        background: rgba(37, 99, 235, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        letter-spacing: 0.5px;
    }

    .vehicle-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .vehicle-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
        border-radius: 6px;
    }
</style>

<div class="table-responsive">
    <table id="data_table" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Registrasi</th>
                <th>Nama Kendaraan</th>
                <th>Area Parkir</th>
                <th>Slot Parkir</th>
                <th>Status</th>
                <th>Waktu Keluar</th>
                <th>Petugas</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiclesOut as $key => $vehicleOut)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <span
                            class="registration-number">{{ $vehicleOut->vehicleIn->vehicle->registration_number ?? 'N/A' }}</span>
                    </td>
                    <td>
                        <div class="vehicle-info">
                            <span class="vehicle-icon">
                                <i class="ik ik-truck"></i>
                            </span>
                            <span>{{ $vehicleOut->vehicleIn->vehicle->name ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td>
                        @if(isset($vehicleOut->vehicleIn) && $vehicleOut->vehicleIn && $vehicleOut->vehicleIn->slot)
                            <span class="parking-area">
                                <i class="ik ik-map-pin mr-2"></i>
                                {{ $vehicleOut->vehicleIn->slot->area_name }}
                            </span>
                        @else
                            <span class="badge badge-warning">
                                <i class="ik ik-alert-circle mr-1"></i>
                                Belum Ditentukan
                            </span>
                        @endif
                    </td>
                    <td>
                        @if(isset($vehicleOut->vehicleIn) && $vehicleOut->vehicleIn && $vehicleOut->vehicleIn->slot)
                            <span class="parking-slot">
                                <i class="ik ik-hash mr-2"></i>
                                {{ $vehicleOut->vehicleIn->slot->slot_number }}
                            </span>
                        @else
                            <span class="badge badge-warning">
                                <i class="ik ik-alert-circle mr-1"></i>
                                Belum Ditentukan
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-danger"><i class="ik ik-log-out mr-1"></i>Keluar Parkir</span>
                    </td>
                    <td>
                        <span class="badge badge-light">
                            <i class="ik ik-calendar mr-1"></i>
                            {{ $vehicleOut->created_at ? $vehicleOut->created_at->format('d M Y H:i') : '-' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-light">
                            <i class="ik ik-user mr-1"></i>
                            {{ $vehicleOut->user->name ?? '-' }}
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('backend.vehiclesOut.edit', $vehicleOut->id) }}"><i
                                    class="ik ik-edit-2"></i></a>
                            <a href="#" class="text-danger" title="Hapus Data" data-toggle="modal"
                                data-target="#deleteModal{{ $key }}">
                                <i class="ik ik-trash-2"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                {{-- Modal Hapus Custom --}}
                @include('backend.vehicles_out.delete', ['vehicleOut' => $vehicleOut, 'key' => $key])
            @endforeach
        </tbody>
    </table>
</div>