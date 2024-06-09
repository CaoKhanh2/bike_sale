@extends('dashboard.layout.content')

@section('title_ds', 'Báo cáo tồn kho')
@section('pg-card-title', 'Báo cáo tồn kho')
@section('pg-hd-2', 'Báo cáo thống kê')
@section('pg-hd-3', 'Báo cáo tồn kho')
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
                            <form action="{{ route('bang-baocaotonkho') }}" method="POST">
                                @csrf
                                <div class="row my-2">
                                    <div class="col-md-12 col-sm-12">
                                        <label  for="khohang">Kho hàng</label>
                                        <select name="khohang" id="khohang" class="form-control">
                                            {{-- <option value="" selected hidden>Lựa chọn</option> --}}
                                            @if (Session::has('khohang'))
                                                <option value="{{ Session::get('khohang') }}" selected hidden>{{ Session::get('tenkhohang') }}</option>
                                                <option value="">Tất cả</option>
                                                @foreach ($makho as $i)
                                                    <option value="{{ $i->makho }}">{{ $i->tenkhohang }}</option>
                                                @endforeach
                                            @else
                                                <option value="" selected>Tất cả</option>
                                                @foreach ($makho as $i)
                                                    <option value="{{ $i->makho }}">{{ $i->tenkhohang }}</option>
                                                @endforeach
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="thoigian">Tháng/Năm</label>
                                        <input type="month" name="thoigian" id="thoigian" class="form-control" value="{{ session('thoigian') }}">
                                    </div>
                                </div>

                                <div class="pull-right my-3 px-1">
                                    <a class="btn btn-lg btn-danger mt-3" href="{{ url('dashboard/report/inventory') }}"> <i class="bi bi-x-square"></i>  Xóa </a>
                                </div>
                                <div class="pull-right my-3">
                                    {{-- <input class="btn btn-lg btn-primary mt-3" type="submit" value="Áp dụng"> --}}
                                    <button class="btn btn-lg btn-primary mt-3" type="submit"> <i class="bi bi-check2-square"></i> Áp dụng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="col-md-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="h4 text-blue">Biểu đồ doanh thu bán hàng</h4>
                            @include('dashboard.report.graph.chart-1')
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="pd-20 card-box mb-40">
                            <div class="clearfix mb-20">
                                <div class="pull-left">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form class="mx-2" id="export-csv-tonkho" action="{{ route('xuatfile-excel-baocaotonkho') }}" method="POST">
                                            @csrf
                                            <input type="text" name="khohang" id="khohang-export" hidden>
                                            <input type="text" name="thoigian" id="thoigian-export" hidden>
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
                                    <h4 class="text-blue h4">Báo cáo tồn kho</h4>
                                </div>
                            </div>
                                @include('dashboard.report.table.table-inventory')
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
        document.getElementById('export-csv-tonkho').addEventListener('click', function() {
            // Lấy dữ liệu từ input1
            var input1Value = document.getElementById('khohang').value;
            var input2Value = document.getElementById('thoigian').value;

            // Truyền dữ liệu vào input2
            document.getElementById('khohang-export').value = input1Value;
            document.getElementById('thoigian-export').value = input2Value;

        });
    </script>

@endsection
