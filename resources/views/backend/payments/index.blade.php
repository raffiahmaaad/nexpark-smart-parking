@extends('backend.layouts.app')

@push('styles')
    <style>
        /* Table Styles */
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


        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Avatar Styles */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #00A67D;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
        }

        /* Status Badge */
        .badge {
            padding: 0.5em 1em;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 4px;
            display: inline-block;
        }

        .badge-pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-success {
            background: #DEF7EC;
            color: #03543F;
        }

        .badge-danger {
            background: #FDE8E8;
            color: #9B1C1C;
        }

        /* Action Buttons */
        .table-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .table-actions a {
            color: #718096;
            font-size: 1.25rem;
            transition: color 0.2s;
            text-decoration: none;
        }

        .table-actions a:hover {
            text-decoration: none;
        }

        .table-actions .ik-eye:hover {
            color: #4299E1;
        }

        .table-actions .ik-check-circle:hover {
            color: #48BB78;
        }

        .table-actions .ik-x-circle:hover {
            color: #F56565;
        }

        /* Payment Info */
        .payment-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .payment-amount {
            font-weight: 600;
            color: #2D3748;
            font-size: 0.875rem;
        }

        .payment-method {
            color: #718096;
            font-size: 0.75rem;
        }

        /* Customer Info */
        .customer-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .customer-details {
            display: flex;
            flex-direction: column;
        }

        .customer-name {
            font-weight: 600;
            color: #2D3748;
            margin-bottom: 0.25rem;
        }

        .customer-email {
            color: #718096;
            font-size: 0.875rem;
        }

        /* Search & Length Control */
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #4299E1;
            box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.2);
            outline: none;
        }

        /* Pagination */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem;
            margin: 0 2px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            background: #fff;
            color: #4A5568 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #EBF4FF !important;
            border-color: #90CDF4 !important;
            color: #2B6CB0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #EDF2F7 !important;
            border-color: #CBD5E0 !important;
            color: #2D3748 !important;
        }

        /* Alert Styles */
        #alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 1.25rem 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1.25rem 1.5rem;
        }
    </style>
@endpush

@section('content')
    @include('backend.flash')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-credit-card bg-blue"></i>
                    <div class="d-inline">
                        <h5>Data Pembayaran</h5>
                        <span>Tabel yang berisikan tentang Data Pembayaran Parkir</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="./home"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Tabel</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tabel Data Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="ik ik-credit-card text-primary mr-2"></i>
                        Daftar Pembayaran Parkir
                    </h5>
                </div>
                <div class="card-body">
                    @include('backend.payments.table')
                </div>
            </div>
        </div>
    </div>

    <!-- Include all modals here -->
    @foreach($payments as $payment)
        @php
            $customer = optional($payment->vehicleIn)->vehicle->customer ?? null;
        @endphp
        @include('backend.payments.modals.show', ['payment' => $payment, 'customer' => $customer])
        @include('backend.payments.modals.confirm', ['payment' => $payment])
        @include('backend.payments.modals.reject', ['payment' => $payment])
    @endforeach
@endsection

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
