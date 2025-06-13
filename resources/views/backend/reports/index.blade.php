@extends('backend.layouts.app')
@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-10">
                <div class="page-header-title">
                    <i class="ik ik-inbox bg-blue"></i>
                    <div class="d-inline">
                        <h5>Laporan Parkir Kendaraan</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header row">
            <div class="col col-sm-6">
                <label for="">Pencarian Laporan Kendaran Masuk</label>
                <div class="card-search with-adv-search dropdown">
                    <form action="{{ route('backend.reports.index') }}" method="GET">
                        <input type="text" value="{{ request()->search_in }}" class="form-control" name="search_in"
                            placeholder="Search..">
                        <input type="hidden" name="report_in" value="report_in">
                        <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>

                        <button type="button" id="adv_wrap_toggler" class="adv-btn ik ik-chevron-down dropdown-toggle"
                            data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"></button>
                        <div class="adv-search-wrap dropdown-menu dropdown-menu-right " aria-labelledby="adv_wrap_toggler">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="date">Dari Tanggal</label>
                                    <input type="text" value="{{ request()->from_date }}"
                                        class="form-control datetimepicker-input" name="from_date" id="datepicker_in_from"
                                        data-toggle="datetimepicker" data-target="#datepicker_in_from">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Sampai Tanggal</label>
                                    <input type="text" value="{{ request()->to_date }}"
                                        class="form-control datetimepicker-input" name="to_date" id="datepicker_in_to"
                                        data-toggle="datetimepicker" data-target="#datepicker_in_to">
                                </div>
                            </div>

                            <div class="btn-group" style="float: right">
                                <button type="submit" class="btn btn-theme">Pencarian</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col col-sm-6">
                <label for="">Pencarian Laporan Kendaran Keluar</label>
                <div class="card-search with-adv-search dropdown">
                    <form action="{{ route('backend.reports.index') }}" method="GET">
                        <input type="text" value="{{ request()->search_out }}" class="form-control" name="search_out"
                            placeholder="Search..">
                        <input type="hidden" name="report_out" value="report_out">
                        <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>

                        <button type="button" id="adv_wrap_toggler" class="adv-btn ik ik-chevron-down dropdown-toggle"
                            data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"></button>
                        <div class="adv-search-wrap dropdown-menu dropdown-menu-right " aria-labelledby="adv_wrap_toggler">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="date">Dari Tanggal</label>
                                    <input type="text" value="{{ request()->from_date }}"
                                        class="form-control datetimepicker-input" name="from_date" id="datepicker_out_from"
                                        data-toggle="datetimepicker" data-target="#datepicker_out_from">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Sampai Tanggal</label>
                                    <input type="text" value="{{ request()->to_date }}"
                                        class="form-control datetimepicker-input" name="to_date" id="datepicker_out_to"
                                        data-toggle="datetimepicker" data-target="#datepicker_out_to">
                                </div>
                            </div>

                            <div class="btn-group" style="float: right">
                                <button type="submit" class="btn btn-theme">Pencarian</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (!empty($reports_out))
                        @include('backend.reports.table_out')
                    @elseif(!empty($reports_in))
                        @include('backend.reports.table_in')
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection