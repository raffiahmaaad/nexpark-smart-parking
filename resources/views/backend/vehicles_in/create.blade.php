@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Kendaraan Masuk</h3>
                </div>
                <div class="card-body">
                    @include('backend.vehicles_in.fields')
                </div>
            </div>
        </div>

    </div>
@endsection