@extends('dashboard.layout.content')

@section('title_ds', 'Quản lý bán xe')
@section('pg-hd-2', 'Quản lý bán xe')

@section('main')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}

                <!-- Export Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="sell-manage">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#home">CHỜ XÁC NHẬN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#menu1">ĐANG XỬ LÝ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#menu2">ĐANG GIAO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#menu2">ĐÃ GIAO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#menu2">ĐÃ HỦY</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Export Datatable End -->
            </div>

        </div>
    </div>

@endsection
