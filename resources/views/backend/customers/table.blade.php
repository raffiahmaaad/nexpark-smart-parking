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
            justify-content: center;
        }

        .table-actions a {
            padding: 6px;
            border-radius: 6px;
            color: #6c757d;
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

        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-info {
            background: #e3f2fd;
            color: #1976d2;
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

        .customer-info {
            display: flex;
            align-items: center;
        }

        .customer-details {
            margin-left: 10px;
        }

        .customer-name {
            font-weight: 500;
            margin-bottom: 2px;
        }

        .customer-phone {
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
@endpush

<div class="table-responsive">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">
            <i class="ik ik-users text-primary mr-2"></i>
            Daftar Pelanggan
        </h5>
        <div>
            <a href="{{ route('backend.customers.create') }}" class="btn btn-primary btn-sm">
                <i class="ik ik-plus-circle"></i>
                Tambah Pelanggan
            </a>
        </div>
    </div>

    <table id="data_table" class="table">
        <thead>
            <tr>
                <th style="width: 50px; text-align: center;">ID</th>
                <th>Informasi Pelanggan</th>
                <th>Email</th>
                <th>Tanggal Bergabung</th>
                <th style="width: 120px;" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $key => $customer)
                <tr>
                    <td style="text-align: center;">{{ $key + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($customer->avatar)
                                <img src="{{ asset($customer->avatar) }}" class="table-user-thumb" alt="{{ $customer->name }}">
                            @else
                                <div class="table-user-thumb d-flex align-items-center justify-content-center"
                                    style="background-color: {{ ['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#34495e'][array_rand(['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#34495e'])] }}; color: white; font-weight: bold; width: 40px; height: 40px;">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="ml-3">
                                <h6 class="mb-0" style="font-size: 0.95rem;">{{ $customer->name }}</h6>
                                @if($customer->phone)
                                    <small class="text-muted" style="font-size: 0.8rem;">
                                        <i class="ik ik-phone mr-1"></i>{{ $customer->phone }}
                                    </small>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $customer->email }}</td>

                    <td>{{ $customer->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="table-actions justify-content-center">
                            <a href="#" data-toggle="modal" data-target="#detail{{ $key }}" title="Lihat Detail">
                                <i class="ik ik-eye"></i>
                            </a>
                            <a href="{{ route('backend.customers.edit', $customer->id) }}" data-toggle="tooltip"
                                title="Edit">
                                <i class="ik ik-edit-2"></i>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#delete{{ $key }}" title="Hapus">
                                <i class="ik ik-trash-2"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @include('backend.customers.show')
                @include('backend.customers.delete')
            @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="ik ik-user-x"></i>
                            <p>Tidak ada data pelanggan yang tersedia</p>
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