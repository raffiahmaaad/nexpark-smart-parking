@extends('backend.layouts.app')
@section('content')
    @include('backend.flash')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-inbox bg-blue"></i>
                    <div class="d-inline">
                        <h5>Data Pelanggan</h5>
                        <span>Tabel yang berisikan tentang Data Pelanggan</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="./home"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Tabel</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tabel Data Pelanggan </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h3>Daftar List Pelanggan</h3>
                </div> --}}
                <div class="card-body">
                    @include('backend.customers.table')
                </div>
            </div>
        </div>
    </div>

@endsection