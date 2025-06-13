@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-check bg-blue"></i>
                        <div class="d-inline">
                            <h5>Profil Admin</h5>
                            <span>Kelola informasi profil Anda</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="text-center">
                            @if($user->avatar)
                                <img src="{{ asset($user->avatar) }}" class="rounded-circle" width="150" height="150"
                                    style="object-fit: cover; border: 3px solid #3498db;" alt="Avatar">
                            @else
                                <div class="avatar"
                                    style="width: 150px; height: 150px; margin: 0 auto; border-radius: 50%;
                                                                                                                                background-color: #3498db; color: white; display: flex;
                                                                                                                                align-items: center; justify-content: center; font-size: 64px;
                                                                                                                                border: 3px solid #2980b9;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <h4 class="card-title mt-3">{{ $user->name }}</h4>
                            <p class="card-subtitle mb-2" style="color: #3498db;">Super Administrator</p>
                        </div>
                        <hr class="my-4">
                        <div class="card-body pt-0">
                            <div class="row align-items-center mb-3">
                                <div class="col-2">
                                    <i class="ik ik-mail text-info" style="font-size: 1.5em;"></i>
                                </div>
                                <div class="col-10">
                                    <h6 class="mb-0">Email</h6>
                                    <p class="mb-0 text-muted">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-2">
                                    <i class="ik ik-user text-info" style="font-size: 1.5em;"></i>
                                </div>
                                <div class="col-10">
                                    <h6 class="mb-0">Jenis Kelamin</h6>
                                    <p class="mb-0 text-muted">{{ $user->gender ?? 'Belum diatur' }}</p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <i class="ik ik-calendar text-info" style="font-size: 1.5em;"></i>
                                </div>
                                <div class="col-10">
                                    <h6 class="mb-0">Tanggal Bergabung</h6>
                                    <p class="mb-0 text-muted">{{ $user->created_at->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-header bg-transparent">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="true">
                                    <i class="ik ik-user"></i> Detail Profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#setting" role="tab"
                                    aria-controls="pills-setting" aria-selected="false">
                                    <i class="ik ik-settings"></i> Pengaturan
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <h5 class="mb-4">Informasi Admin</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item mb-4">
                                            <h6 class="text-muted">Nama Lengkap</h6>
                                            <p class="font-weight-bold">{{ $user->name }}</p>
                                        </div>
                                        <div class="info-item mb-4">
                                            <h6 class="text-muted">Email</h6>
                                            <p class="font-weight-bold">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-4">
                                            <h6 class="text-muted">Jenis Kelamin</h6>
                                            <p class="font-weight-bold">{{ $user->gender ?? 'Belum diatur' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="pills-setting-tab">
                                <h5 class="mb-4">Edit Profil</h5>
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('backend.admins.update', $user->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="avatar" class="col-sm-3 col-form-label">Foto Profil</label>
                                        <div class="col-sm-9">
                                            <div class="input-group" style="height: 38px;">
                                                <input type="text" class="form-control" placeholder="Pilih file" readonly
                                                    id="file-label">
                                                <div class="input-group-append">
                                                    <label for="avatar" class="btn btn-outline-secondary mb-0"
                                                        style="height: 38px; line-height: 24px;">Browse</label>
                                                </div>
                                                <input type="file" id="avatar" name="avatar" style="display: none;">
                                            </div>
                                            <small class="form-text text-muted mt-2">Upload foto dengan format JPG, JPEG,
                                                atau
                                                PNG. Maksimal 2MB.</small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ik ik-save mr-1"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>
        .card {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .nav-pills .nav-link.active {
            background-color: #3498db;
        }

        .nav-pills .nav-link {
            color: #3498db;
        }

        .nav-pills .nav-link:hover {
            background-color: #f8f9fa;
        }

        .info-item h6 {
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .info-item p {
            font-size: 1rem;
            color: #2c3e50;
        }

        .input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group-append .btn {
            border-color: #ced4da;
            color: #495057;
            border-left: 0;
        }

        .input-group-append .btn:hover {
            background-color: #e9ecef;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #fff;
            cursor: default;
        }
    </style>

    <script>
        // Update file input label when file is selected
        document.getElementById('avatar').addEventListener('change', function (e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file';
            document.getElementById('file-label').value = fileName;
        });
    </script>
@endpush