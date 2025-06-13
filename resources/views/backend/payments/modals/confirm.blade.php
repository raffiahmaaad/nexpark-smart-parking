<!-- Modal Konfirmasi Pembayaran -->
<div class="modal fade" id="confirmModal{{ $payment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="confirmModalLabel{{ $payment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 bg-gradient-success text-white py-3">
                <h5 class="modal-title font-weight-bold d-flex align-items-center"
                    id="confirmModalLabel{{ $payment->id }}">
                    <i class="ik ik-check-circle mr-2"></i>Konfirmasi Pembayaran
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="confirm-payment-form" action="{{ route('backend.payments.confirm', $payment->id) }}"
                method="POST" data-payment-id="{{ $payment->id }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="confirmation-icon-circle mx-auto mb-3">
                            <i class="ik ik-check"></i>
                        </div>
                        <h4 class="mb-3 font-weight-bold text-dark">Konfirmasi Pembayaran</h4>
                        <p class="text-muted mb-4">Apakah Anda yakin ingin mengkonfirmasi pembayaran ini?</p>
                    </div>

                    <div class="payment-info-card">
                        <div class="payment-info-item">
                            <div class="info-icon">
                                <i class="ik ik-credit-card text-success"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">Total Pembayaran</span>
                                <span class="info-value">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="payment-info-item">
                            <div class="info-icon">
                                <i class="ik ik-dollar-sign text-success"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">Metode Pembayaran</span>
                                <span
                                    class="info-value">{{ $payment->payment_method === 'qris' ? 'QRIS' : 'Transfer Bank' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="ik ik-x-circle mr-1"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="ik ik-check-circle mr-1"></i>
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .bg-gradient-success {
        background: linear-gradient(45deg, #00c16e, #00d68f);
    }

    .confirmation-icon-circle {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, rgba(0, 193, 110, 0.1), rgba(0, 214, 143, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .confirmation-icon-circle i {
        font-size: 40px;
        color: #00c16e;
    }

    .payment-info-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
    }

    .payment-info-item {
        display: flex;
        align-items: center;
        padding: 12px 0;
    }

    .payment-info-item:not(:last-child) {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: rgba(0, 193, 110, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .info-icon i {
        font-size: 20px;
    }

    .info-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.875rem;
        color: #6c757d;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 600;
        color: #2d3436;
    }

    .btn {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn i {
        font-size: 1.1rem;
    }

    .btn-success {
        background: linear-gradient(45deg, #00c16e, #00d68f);
        border: none;
        box-shadow: 0 4px 15px rgba(0, 193, 110, 0.2);
    }

    .btn-success:hover {
        background: linear-gradient(45deg, #00a85d, #00bf7d);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(0, 193, 110, 0.25);
    }

    .btn-light-secondary {
        background: #e9ecef;
        color: #495057;
        border: none;
    }

    .btn-light-secondary:hover {
        background: #dee2e6;
        color: #212529;
    }

    .modal-header .close {
        padding: 0.5rem;
        margin: -0.5rem -0.5rem -0.5rem auto;
        opacity: 0.8;
        transition: all 0.2s ease;
    }

    .modal-header .close:hover {
        opacity: 1;
        transform: rotate(90deg);
    }

    /* Animation */
    .modal.fade .modal-dialog {
        transform: scale(0.95);
        transition: transform 0.2s ease-out;
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }

    .confirmation-icon-circle {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 193, 110, 0.4);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(0, 193, 110, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(0, 193, 110, 0);
        }
    }
</style>