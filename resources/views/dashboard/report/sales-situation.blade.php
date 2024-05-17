@extends('dashboard.layout.content')

@section('title_ds', 'Báo cáo tình hình bán hàng')
@section('pg-card-title', 'Báo cáo tình hình bán hàng')
@section('pg-hd-2', 'Báo cáo thống kê')
@section('pg-hd-3', 'Báo cáo tình hình bán hàng')
@section('st4', 'false')

@section('main')

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            {{-- <h4 class="h4 text-blue"></h4> --}}
                            <form action="{{ route('bieudo-tinhhinhbanhang') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="">Từ ngày</label>
                                        <input class="form-control" type="date" placeholder="Chọn thời gian"
                                            type="text" name="tungay">

                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="">Đến ngày</label>
                                        <input class="form-control" type="date" placeholder="Chọn thời gian"
                                            type="text" name="denngay">

                                    </div>
                                </div>
                                <div class="pull-right my-3 px-1">
                                    <a class="btn btn-lg btn-primary mt-3" href="{{ url('dashboard/report/sales-situation') }}"> Xóa </a>
                                </div>
                                <div class="pull-right my-3">
                                    <input class="btn btn-lg btn-primary mt-3" type="submit" value="Áp dụng">
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="h4 text-blue">Từ ngày đến ngày</h4>
                            @include('dashboard.report.graph.chart-1')
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="pd-20 card-box mb-40">
                            <div class="clearfix mb-20">
                                <div class="pull-left">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form class="mx-2" action="{{ route('xuatfile-excel-thongtintinhhinhbanhang') }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-secondary" value="Xuất file CSV">
                                        </form>
                                        <form class="mx-2" method="post">
                                            @csrf
                                            <input type="submit" class="btn btn-secondary" value="Xuất file PDF">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix mb-20">
                                <div class="pull-left">
                                    <h4 class="text-blue h4">Báo cáo tình hình bán hàng</h4>
                                </div>
                            </div>
                                @include('dashboard.report.table.table-sales-stiuation')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- js -->
    {{-- <script src="{{ asset('dashboard_src/src/plugins/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('dashboard_src/vendors/scripts/apexcharts-setting.js') }}"></script>


@endsection
