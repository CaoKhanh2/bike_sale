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
                                        <label for="example-datetime-local-input" class="" for="tungay">Từ ngày</label>
                                        <input class="form-control" type="date" placeholder="Chọn thời gian"
                                            type="text" name="tungay" id="tungay" value="{{ session('tungay') }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="" for="denngay">Đến ngày</label>
                                        <input class="form-control" type="date" placeholder="Chọn thời gian"
                                            type="text" name="denngay" id="denngay" value="{{ session('denngay') }}">
                                    </div>
                                </div>
                                <div class="pull-right my-3 px-1">
                                    <a class="btn btn-lg btn-danger mt-3" href="{{ url('dashboard/report/sales-situation') }}"> <i class="bi bi-x-square"></i>  Xóa </a>
                                </div>
                                <div class="pull-right my-3">
                                    {{-- <input class="btn btn-lg btn-primary mt-3" type="submit" value="Áp dụng"> --}}
                                    <button class="btn btn-lg btn-primary mt-3" type="submit"> <i class="bi bi-check2-square"></i> Áp dụng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="h4 text-blue">Biểu đồ doanh thu bán hàng</h4>
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
                                        <form class="mx-2" id="export-csv-tinhhinhbanhang" action="{{ route('xuatfile-excel-thongtintinhhinhbanhang') }}" method="POST">
                                            @csrf
                                            <input type="text" name="tungay" id="tungay-export" hidden>
                                            <input type="text" name="denngay" id="denngay-export" hidden>
                                            <button type="submit" id="export-csv-tinhhinhthumua" class="btn btn-secondary">
                                                <i class="bi bi-filetype-csv"></i> Xuất file CSV
                                            </button>
                                        </form>
                                        {{-- <form class="mx-2" method="post">
                                            @csrf
                                            <input type="submit" class="btn btn-secondary" value="Xuất file PDF">
                                        </form> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix mb-20">
                                <div class="pull-left">
                                    <h4 class="text-blue h4">Báo cáo tình hình bán hàng</h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @include('dashboard.report.table.table-sales-stiuation')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- js -->
    {{-- <script src="{{ asset('dashboard_src/src/plugins/apexcharts/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard_src/vendors/scripts/apexcharts-setting.js') }}"></script> --}}
    <script>
        document.getElementById('export-csv-tinhhinhbanhang').addEventListener('click', function() {
            // Lấy dữ liệu từ input1
            var input1Value = document.getElementById('tungay').value;
            var input2Value = document.getElementById('dennay').value;

            // Truyền dữ liệu vào input2
            document.getElementById('tungay-export').value = input1Value;
            document.getElementById('denngay-export').value = input2Value;

        });
    </script>

@endsection
