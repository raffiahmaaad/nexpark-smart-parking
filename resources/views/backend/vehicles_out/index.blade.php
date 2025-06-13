@extends('backend.layouts.app')
@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-10">
                <div class="page-header-title">
                    <i class="ik ik-inbox bg-blue"></i>
                    <div class="d-inline">
                        <h5>List Daftar Kendaraan Keluar</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('backend.vehicles_out.table')
                </div>
            </div>
        </div>
    </div>

@endsection