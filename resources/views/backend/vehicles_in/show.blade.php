<!-- Modal -->
<div class="modal fade" id="show{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="showModalLabel{{ $key }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white py-3">
                <h5 class="modal-title" id="showModalLabel{{ $key }}">
                    <i class="ik ik-info mr-2"></i>{{ $vehicleIn->vehicle->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <span class="text-success h1 mb-0 mr-3"><i class="ik ik-hash"></i></span>
                                <div>
                                    <p class="text-muted text-uppercase mb-1 small">NOMOR REGISTRASI</p>
                                    <h4 class="font-weight-bold mb-0 text-dark">
                                        {{ $vehicleIn->vehicle->registration_number }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <i class="ik ik-map-pin text-success h1 mb-0 mr-3"></i>
                                <div>
                                    <p class="text-muted text-uppercase mb-1 small">AREA PARKIR</p>
                                    <h4 class="font-weight-bold mb-0 text-dark">{{ $vehicleIn->parking_area ?? '-' }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row border-top">
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Nama Pelanggan</p>
                        <p class="mb-0 font-weight-semibold text-dark">{{ $vehicleIn->vehicle->customer->name ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Email</p>
                        <p class="mb-0 font-weight-semibold text-dark">{{ $vehicleIn->vehicle->customer->email ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Nama Kendaraan</p>
                        <p class="mb-0 font-weight-semibold text-dark">{{ $vehicleIn->vehicle->name }}</p>
                    </div>
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Nomor Polisi</p>
                        <p class="mb-0 font-weight-semibold text-dark">{{ $vehicleIn->vehicle->plat_number ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Kategori</p>
                        <p class="mb-0 font-weight-semibold text-dark">{{ $vehicleIn->vehicle->category->name }}</p>
                    </div>
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Durasi</p>
                        <p class="mb-0 font-weight-semibold text-dark">{{ $vehicleIn->duration }} jam</p>
                    </div>
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Status</p>
                        <p class="mb-0">
                            <span
                                class="badge {{ $vehicleIn->status == 1 ? 'badge-success-light' : 'badge-warning-light' }} py-2 px-3 rounded-pill">
                                {{ $vehicleIn->status == 1 ? 'Ongoing' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Biaya per Jam</p>
                        <p class="mb-0 font-weight-semibold text-dark">Rp
                            {{ number_format($vehicleIn->vehicle->category->fee_per_hour ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="col-md-6 detail-item">
                        <p class="text-muted mb-1 small">Tanggal Masuk</p>
                        <p class="mb-0 font-weight-semibold text-dark">
                            {{ $vehicleIn->created_at ? $vehicleIn->created_at->format('d F Y, H:i') : '-' }}
                        </p>
                    </div>
                    <div class="col-12 text-center">
                        <p class="text-muted mb-1 small">Total Biaya</p>
                        <h2 class="text-success display-4 font-weight-bold">
                            Rp
                            {{ number_format($vehicleIn->vehicle->category->fee_per_hour * $vehicleIn->duration, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light justify-content-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="ik ik-x mr-1"></i>Tutup
                </button>
                <a href="{{ route('backend.vehiclesIn.edit', $vehicleIn->id) }}" class="btn btn-success">
                    <i class="ik ik-edit-2 mr-1"></i>Edit
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .modal-header {
        background-color: #00c16e;
        padding: 1.5rem 2.5rem;
    }

    .modal-title {
        font-size: 1.6rem;
        font-weight: 800;
    }

    .close {
        font-size: 2.2rem;
        opacity: 0.9;
        text-shadow: none;
    }

    .close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 3rem 2rem;
    }

    .detail-item {
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    /* Apply border to all detail items except the last one */
    .detail-item:not(:last-of-type) {
        border-bottom: 1px solid #eee;
    }

    /* Ensure no border for the total biaya section itself if it were to accidentally get one */
    .col-12.text-center {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .card {
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
    }

    .card-body {
        padding: 2rem;
    }

    .card-body .d-flex .text-success.h1 {
        font-size: 3.5rem !important;
    }

    .text-success {
        color: #00c16e !important;
    }

    .text-dark {
        color: #212529 !important;
    }

    .font-weight-semibold {
        font-weight: 600;
    }

    .btn {
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
    }

    .btn-success {
        background-color: #00c16e;
        border-color: #00c16e;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #00a85d;
        border-color: #00a85d;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        transition: all 0.3s ease;
        margin-right: 0.75rem;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
        transform: translateY(-2px);
    }

    p.text-muted.small {
        font-size: 0.8rem;
        letter-spacing: 0.7px;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
        color: #6a737b !important;
    }

    p.mb-0.font-weight-semibold {
        font-size: 1.1rem;
        line-height: 1.5;
    }

    .badge-success-light {
        background-color: rgba(0, 193, 110, 0.18);
        color: #00c16e;
        font-weight: 700;
        padding: 0.4rem 0.9rem;
    }

    .badge-warning-light {
        background-color: rgba(255, 193, 7, 0.18);
        color: #ffc107;
        font-weight: 700;
        padding: 0.4rem 0.9rem;
    }

    .display-4 {
        font-size: 4rem;
        letter-spacing: -1px;
        margin-top: 1rem;
    }

    .modal-footer {
        padding: 1.5rem 2.5rem;
        border-top: 1px solid #eee;
    }
</style>