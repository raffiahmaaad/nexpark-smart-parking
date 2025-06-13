<div class="modal fade" id="detail{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-user-circle mr-2"></i>Detail Admin : {{ $user->name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($user->avatar)
                            <img src="{{ asset($user->avatar) }}" alt="Avatar" class="img-thumbnail mb-3"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            @php
                                $colors = ['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#34495e', '#16a085', '#27ae60', '#2980b9', '#8e44ad', '#2c3e50'];
                                $randomColor = $colors[array_rand($colors)];
                            @endphp
                            <div class="img-thumbnail mb-3"
                                style="width: 150px; height: 150px; border-radius: 5px; background-color: {{ $randomColor }}; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 60px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="info-group">
                            <label class="font-weight-bold">Nama:</label>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="info-group">
                            <label class="font-weight-bold">Email:</label>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="info-group">
                            <label class="font-weight-bold">Jenis Kelamin:</label>
                            <p>{{ $user->gender }}</p>
                        </div>
                        <div class="info-group">
                            <label class="font-weight-bold">Tanggal Dibuat:</label>
                            <p>{{ $user->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>