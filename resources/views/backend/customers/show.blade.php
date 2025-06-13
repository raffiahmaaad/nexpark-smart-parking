<div class="modal fade" id="detail{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header"
                style="background: #3498db !important; color: #fff; border-top-left-radius: 9px; border-top-right-radius: 9px;">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-user-circle mr-2"></i>Detail Pelanggan : {{ $customer->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    @if($customer->avatar)
                        <img src="{{ asset($customer->avatar) }}" alt="Avatar" class="rounded-circle mb-2"
                            style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #eee;">
                    @else
                        @php
                            $colors = ['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#34495e', '#16a085', '#27ae60', '#2980b9', '#8e44ad', '#2c3e50'];
                            $randomColor = $colors[array_rand($colors)];
                        @endphp
                        <div class="rounded-circle mb-2"
                            style="width: 150px; height: 150px; background-color: {{ $randomColor }}; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 60px; border: 3px solid #eee;">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                    @endif
                    <h5 class="mt-3"><strong>{{ $customer->name }}</strong></h5>
                    <p style="color: #6c757d;">Pelanggan</p>
                </div>

                <hr class="mb-4">

                <ul class="list-unstyled mx-auto" style="width: fit-content;">
                    <li class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                            style="width: 50px; height: 50px; background-color: #e6f2ff;">
                            <i class="fas fa-envelope fa-2x" style="color: #3498db;"></i>
                        </div>
                        <div>
                            <h6 class="mb-0" style="color: #000000;">Email</h6>
                            <p class="mb-0" style="color: #6c757d;">{{ $customer->email }}</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                            style="width: 50px; height: 50px; background-color: #e6f2ff;">
                            <i class="fas fa-calendar-check fa-2x" style="color: #3498db;"></i>
                        </div>
                        <div>
                            <h6 class="mb-0" style="color: #000000;">Tanggal Bergabung</h6>
                            <p class="mb-0" style="color: #6c757d;">{{ $customer->created_at->format('d F Y') }}</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>