@extends('backend.layouts.app')
@section('content')
    @include('backend.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Kendaraan </h3>
                </div>
                <div class="card-body">
                    @include('backend.vehicles.fields')
                </div>
            </div>
        </div>

    </div>
@endsection