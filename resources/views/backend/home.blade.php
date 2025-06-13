@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Kendaraan Masuk</h6>
                                <h2>{{ $total_vehicle_in }}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-truck"></i>
                            </div>
                        </div>
                        <small class="text-small mt-10 d-block">6% lebih tinggi dari bulan kemarin</small>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0"
                            aria-valuemax="100" style="width: 62%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Kendaraan Keluar</h6>
                                <h2>{{ $total_vehicle_out }}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-truck"></i>
                            </div>
                        </div>
                        <small class="text-small mt-10 d-block">61% lebih tinggi dari bulan kemarin</small>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0"
                            aria-valuemax="100" style="width: 78%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Total Kendaraan</h6>
                                <h2>{{ $total_vehicles }}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-truck"></i>
                            </div>
                        </div>
                        <small class="text-small mt-10 d-block">Jumlah Kendaraan</small>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0"
                            aria-valuemax="100" style="width: 31%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Keuntungan</h6>
                                <h2>Rp {{ number_format($total_amount, 0, ',', '.') }}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-credit-card"></i>
                            </div>
                        </div>
                        <small class="text-small mt-10 d-block">Total Keuntungan</small>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                            aria-valuemax="100" style="width: 20%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-body">
                @include('backend.vehicles.table')
            </div>
        </div>
    </div>

@endsection