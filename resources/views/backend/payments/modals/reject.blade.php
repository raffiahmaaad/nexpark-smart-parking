<!-- Modal Tolak Pembayaran -->
<div class="modal fade" id="rejectModal{{ $payment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="rejectModalLabel{{ $payment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div
                class="modal-header border-0 bg-danger text-white d-flex justify-content-between align-items-center py-4">
                <h5 class="modal-title font-weight-bold d-flex align-items-center m-0"
                    id="rejectModalLabel{{ $payment->id }}">
                    <i class="ik ik-x-circle mr-2 reject-icon"></i>Tolak Pembayaran
                </h5>
                <button type="button" class="close text-white hover-rotate" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="reject-payment-form" method="POST" data-payment-id="{{ $payment->id }}"
                id="rejectForm{{ $payment->id }}" action="{{ route('backend.payments.reject', $payment->id) }}">
                @csrf
                <div class="modal-body p-4">
                    <!-- Error Alert -->
                    <div class="alert alert-modern-danger alert-dismissible fade show error-message" role="alert"
                        style="display: none;">
                        <i class="ik ik-alert-circle mr-2"></i>
                        <span class="error-text">Error message here</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="text-center mb-4">
                        <div class="icon-circle bg-danger-gradient mx-auto mb-4 pulse">
                            <i class="ik ik-x text-white"></i>
                        </div>
                        <h5 class="font-weight-bold text-dark mb-2">Tolak Pembayaran</h5>
                        <p class="text-muted mb-0">Apakah Anda yakin ingin menolak pembayaran ini?</p>
                    </div>

                    <div class="card shadow-hover border-0 rounded-xl mb-4">
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <label for="rejection_reason{{ $payment->id }}" class="text-muted small mb-2">
                                    Alasan Penolakan <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control focus-danger rounded-lg"
                                    id="rejection_reason{{ $payment->id }}" name="rejection_reason" rows="3"
                                    placeholder="Masukkan alasan penolakan pembayaran" minlength="10"
                                    required></textarea>
                                <small class="form-text text-muted">Minimal 10 karakter</small>
                                <div class="invalid-feedback">
                                    Mohon masukkan alasan penolakan yang valid (minimal 10 karakter)
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-hover border-0 rounded-xl">
                        <div class="card-body">
                            <h6 class="card-title d-flex align-items-center text-danger mb-4">
                                <i class="ik ik-info mr-2"></i>
                                <span class="font-weight-bold">Detail Pembayaran</span>
                            </h6>

                            <div class="mb-4">
                                <label class="text-muted small mb-2">Total Pembayaran</label>
                                <div class="d-flex align-items-center payment-info-item">
                                    <div class="icon-circle bg-danger-gradient mr-3 pulse">
                                        <i class="ik ik-dollar-sign text-white"></i>
                                    </div>
                                    <h6 class="mb-0 font-weight-medium">Rp
                                        {{ number_format($payment->amount, 0, ',', '.') }}
                                    </h6>
                                </div>
                            </div>

                            <div>
                                <label class="text-muted small mb-2">Metode Pembayaran</label>
                                <div class="d-flex align-items-center payment-info-item">
                                    <div class="icon-circle bg-danger-gradient mr-3 pulse">
                                        <i class="ik ik-credit-card text-white"></i>
                                    </div>
                                    <h6 class="mb-0 font-weight-medium">
                                        @if(strtolower($payment->payment_method) == 'qris')
                                            QRIS
                                        @else
                                            Transfer Bank
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-modern-light hover-lift transition-all px-4"
                        data-dismiss="modal">
                        <i class="ik ik-x mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-modern-danger hover-lift transition-all px-4 submit-btn">
                        <span class="submit-text">
                            <i class="ik ik-x-circle mr-2"></i>Tolak
                        </span>
                        <span class="loading-text" style="display: none;">
                            <i class="ik ik-loader spin mr-1"></i>
                            Memproses...
                        </span>
                    </button>
                </div>
            </form>
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

    .bg-danger {
        background-color: #FF3B3B !important;
    }

    .bg-gradient-mint {
        background: linear-gradient(135deg, #00D67F 0%, #00F593 100%);
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
        font-size: 1.25rem;
    }

    .bg-danger-gradient {
        background: linear-gradient(135deg, #FF3B3B 0%, #FF6B6B 100%);
    }

    .alert-modern-danger {
        background: linear-gradient(135deg, #FFF5F5 0%, #FFE5E5 100%);
        color: #FF3B3B;
        border: none;
        border-radius: 1rem;
    }

    .form-control {
        border-radius: 1rem;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #FF3B3B;
        box-shadow: 0 0 0 0.2rem rgba(255, 59, 59, 0.25);
    }

    .btn-modern-danger {
        background: linear-gradient(135deg, #FF3B3B 0%, #FF6B6B 100%);
        color: #fff;
        border: none;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-modern-danger:hover {
        background: linear-gradient(135deg, #FF2525 0%, #FF5555 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 59, 59, 0.3);
    }

    .btn-modern-light {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
        border: none;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-modern-light:hover {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 0 0 0 rgba(255, 59, 59, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 59, 59, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 59, 59, 0);
        }
    }

    .payment-info-item {
        transition: transform 0.3s ease;
    }

    .payment-info-item:hover {
        transform: translateX(5px);
    }

    .reject-icon,
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

    /* Loading spinner animation */
    .spin {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    /* Responsive Design */
    @media (max-width: 767.98px) {
        .modal-dialog {
            margin: 0.5rem;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .modal-body {
            padding: 1.25rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.reject-payment-form');

        forms.forEach(form => {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const paymentId = this.dataset.paymentId;
                const submitBtn = this.querySelector('.submit-btn');
                const submitText = submitBtn.querySelector('.submit-text');
                const loadingText = submitBtn.querySelector('.loading-text');
                const errorAlert = this.querySelector('.alert-modern-danger');
                const errorText = errorAlert.querySelector('.error-text');
                const textarea = this.querySelector('textarea[name="rejection_reason"]');
                const modal = document.getElementById(`rejectModal${paymentId}`);

                // Reset previous error states
                errorAlert.style.display = 'none';
                textarea.classList.remove('is-invalid');

                // Validate textarea
                if (!textarea.value || textarea.value.length < 10) {
                    textarea.classList.add('is-invalid');
                    return;
                }

                try {
                    // Show loading state
                    submitBtn.disabled = true;
                    submitText.style.display = 'none';
                    loadingText.style.display = 'inline-block';

                    // Submit form using form's action URL
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            '_token': document.querySelector('meta[name="csrf-token"]').content,
                            'rejection_reason': textarea.value
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Terjadi kesalahan saat menolak pembayaran');
                    }

                    if (!data.success) {
                        throw new Error(data.message || 'Terjadi kesalahan saat menolak pembayaran');
                    }

                    // Hide modal
                    $(modal).modal('hide');

                    // Show success message
                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: true,
                        confirmButtonText: 'OK'
                    });

                    // Reload page
                    window.location.reload();

                } catch (error) {
                    console.error('Error:', error);

                    // Show error message
                    errorText.textContent = error.message;
                    errorAlert.style.display = 'block';

                    // Reset button state
                    submitBtn.disabled = false;
                    submitText.style.display = 'inline-block';
                    loadingText.style.display = 'none';

                    // Scroll to error message
                    errorAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });

            // Reset form when modal is hidden
            const modal = document.getElementById(`rejectModal${form.dataset.paymentId}`);
            $(modal).on('hidden.bs.modal', function () {
                form.reset();
                const textarea = form.querySelector('textarea[name="rejection_reason"]');
                textarea.classList.remove('is-invalid');
                const errorAlert = form.querySelector('.alert-modern-danger');
                errorAlert.style.display = 'none';
                const submitBtn = form.querySelector('.submit-btn');
                const submitText = submitBtn.querySelector('.submit-text');
                const loadingText = submitBtn.querySelector('.loading-text');
                submitBtn.disabled = false;
                submitText.style.display = 'inline-block';
                loadingText.style.display = 'none';
            });
        });
    });
</script>