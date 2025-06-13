<!-- Modal Detail Pembayaran -->
<div class="modal fade" id="showModal{{ $payment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showModalLabel{{ $payment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div
                class="modal-header border-0 bg-primary text-white d-flex justify-content-between align-items-center py-4">
                <h5 class="modal-title font-weight-bold d-flex align-items-center m-0"
                    id="showModalLabel{{ $payment->id }}">
                    <i class="ik ik-credit-card mr-2 payment-icon"></i>Detail Pembayaran
                </h5>
                <button type="button" class="close text-white hover-rotate" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        {{-- Avatar atau Initial Customer --}}
                        @if($customer && $customer->avatar)
                            <div class="avatar-wrapper mb-3 hover-scale">
                                <img src="{{ asset($customer->avatar) }}" alt="Avatar"
                                    class="img-fluid rounded-circle border-0 shadow-lg"
                                    style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        @else
                            @php
                                $colors = ['#4F46E5', '#7C3AED', '#2563EB', '#9333EA', '#3B82F6', '#6366F1', '#8B5CF6', '#6D28D9', '#4F46E5', '#4338CA'];
                                $randomColor = $colors[array_rand($colors)];
                            @endphp
                            <div class="avatar-wrapper mb-3 hover-scale">
                                <div class="rounded-circle shadow-lg d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 120px; height: 120px; background-color: {{ $randomColor }}!important; font-weight: bold; font-size: 48px;">
                                    <span class="text-white">{{ strtoupper(substr($customer->name ?? 'U', 0, 1)) }}</span>
                                </div>
                            </div>
                        @endif
                        <h5 class="font-weight-bold mb-1 text-dark">{{ $customer->name ?? 'Customer Tidak Ditemukan' }}
                        </h5>
                        <p class="text-muted medium">{{ $customer->email ?? '-' }}</p>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-hover border-0 rounded-xl mb-4">
                            <div class="card-body">
                                <h6 class="card-title d-flex align-items-center text-primary mb-4">
                                    <i class="ik ik-info mr-2"></i>
                                    <span class="font-weight-bold">Informasi Pembayaran</span>
                                </h6>
                                <div class="row">
                                    <div class="col-sm-6 mb-4">
                                        <label class="text-muted small mb-2">Total Pembayaran</label>
                                        <div class="d-flex align-items-center payment-info-item">
                                            <div class="icon-circle bg-success-gradient mr-3 pulse">
                                                <i class="ik ik-dollar-sign text-white"></i>
                                            </div>
                                            <h6 class="mb-0 font-weight-medium">Rp
                                                {{ number_format($payment->amount, 0, ',', '.') }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="text-muted small mb-2">Metode Pembayaran</label>
                                        <div class="d-flex align-items-center payment-info-item">
                                            <div class="icon-circle bg-info-gradient mr-3 pulse">
                                                <i class="ik ik-credit-card text-white"></i>
                                            </div>
                                            <h6 class="mb-0 font-weight-medium">
                                                {{ $payment->payment_method ? ucfirst($payment->payment_method) : '-' }}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="text-muted small mb-2">Status</label>
                                        <div class="d-flex align-items-center payment-info-item">
                                            <div class="icon-circle bg-warning-gradient mr-3 pulse">
                                                <i class="ik ik-activity text-white"></i>
                                            </div>
                                            @if($payment->status == 'pending')
                                                <span class="badge badge-modern-warning px-3 py-2">Menunggu</span>
                                            @elseif($payment->status == 'confirmed')
                                                <span class="badge badge-modern-success px-3 py-2">Dikonfirmasi</span>
                                            @elseif($payment->status == 'rejected')
                                                <span class="badge badge-modern-danger px-3 py-2">Ditolak</span>
                                            @else
                                                <span
                                                    class="badge badge-modern-secondary px-3 py-2">{{ ucfirst($payment->status) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-4">
                                        <label class="text-muted small mb-2">Tanggal Pembayaran</label>
                                        <div class="d-flex align-items-center payment-info-item">
                                            <div class="icon-circle bg-primary-gradient mr-3 pulse">
                                                <i class="ik ik-calendar text-white"></i>
                                            </div>
                                            <h6 class="mb-0 font-weight-medium">
                                                {{ $payment->created_at ? $payment->created_at->format('d M Y H:i') : '-' }}
                                            </h6>
                                        </div>
                                    </div>
                                    @if($payment->notes)
                                        <div class="col-12">
                                            <label class="text-muted small mb-2">Catatan Admin</label>
                                            <div class="d-flex align-items-start payment-info-item">
                                                <div class="icon-circle bg-secondary-gradient mr-3 pulse">
                                                    <i class="ik ik-clipboard text-white"></i>
                                                </div>
                                                <p class="mb-0 text-gray-700">{{ $payment->notes }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-hover border-0 rounded-xl">
                            <div class="card-body">
                                <h6 class="card-title d-flex align-items-center text-primary mb-4">
                                    <i class="ik ik-image mr-2 image-icon"></i>
                                    <span class="font-weight-bold">Bukti Pembayaran</span>
                                </h6>
                                <div class="text-center">
                                    @if($payment->proof_image)
                                        <a href="{{ asset('storage/' . $payment->proof_image) }}" target="_blank"
                                            class="proof-image-wrapper hover-scale">
                                            <img src="{{ asset('storage/' . $payment->proof_image) }}"
                                                alt="Bukti Pembayaran" class="img-fluid rounded-xl shadow-sm"
                                                style="max-width: 300px; height: auto;">
                                        </a>
                                    @else
                                        <div class="empty-proof p-4 bg-light rounded-xl">
                                            <i class="ik ik-image text-gray-400 d-block mb-2" style="font-size: 2rem;"></i>
                                            <p class="text-muted mb-0">Tidak ada bukti pembayaran diunggah.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-modern-secondary hover-lift transition-all px-4"
                    data-dismiss="modal">
                    <i class="ik ik-x-circle mr-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modern Styling */
    .modal-content {
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .bg-primary {
        background-color: #007bff !important;
    }

    .rounded-xl {
        border-radius: 1rem;
    }

    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .bg-success-gradient {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }

    .bg-info-gradient {
        background: linear-gradient(135deg, #0061f2 0%, #17a2b8 100%);
    }

    .bg-warning-gradient {
        background: linear-gradient(135deg, #f6c23e 0%, #fd7e14 100%);
    }

    .bg-primary-gradient {
        background: linear-gradient(135deg, #0061f2 0%, #6900f2 100%);
    }

    .bg-secondary-gradient {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }

    .badge-modern-warning {
        background: linear-gradient(135deg, #fff3cd 0%, #ffe5d0 100%);
        color: #856404;
        font-weight: 600;
        border-radius: 0.5rem;
    }

    .badge-modern-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        font-weight: 600;
        border-radius: 0.5rem;
    }

    .badge-modern-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        font-weight: 600;
        border-radius: 0.5rem;
    }

    .badge-modern-secondary {
        background: linear-gradient(135deg, #e2e6ea 0%, #d6d8db 100%);
        color: #383d41;
        font-weight: 600;
        border-radius: 0.5rem;
    }

    .btn-modern-secondary {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
        border: none;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .hover-scale {
        transition: transform 0.3s ease;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }

    .hover-rotate:hover {
        transform: rotate(90deg);
    }

    .shadow-hover {
        transition: box-shadow 0.3s ease;
    }

    .shadow-hover:hover {
        box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.15);
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
        }
    }

    .payment-info-item {
        transition: transform 0.3s ease;
    }

    .payment-info-item:hover {
        transform: translateX(5px);
    }

    .payment-icon,
    {
    animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-5px);
        }

        60% {
            transform: translateY(-3px);
        }
    }

    .transition-all {
        transition: all 0.3s ease;
    }
</style>