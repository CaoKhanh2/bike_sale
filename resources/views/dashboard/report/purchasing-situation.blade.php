@extends('dashboard.layout.content')

@section('title_ds', 'Báo cáo tình hình thu mua')
@section('pg-card-title', 'Báo cáo tình hình thu mua')
@section('pg-hd-2', 'Báo cáo thống kê')
@section('pg-hd-3', 'Báo cáo tình hình thu mua')
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
                            <form action="{{ route('bieudo-tinhhinhthumua') }}" method="POST">
                                @csrf
                                <div class="row my-2">
                                    <div class="col-md-6 col-sm-12">
                                        <label  for="tunam">Từ Năm</label>
                                        <input type="number" name="tunam" class="form-control" id="tunam"
                                            value="{{ session('tunam') }}" oninput="limitLength(this, 4)" required>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label  for="dennam">Đến Năm</label>
                                        <input type="number" name="dennam" class="form-control" id="dennam"
                                            value="{{ session('dennam') }}" oninput="limitLength(this, 4)" required>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-12 col-sm-12">
                                        <label  for="quy">Các quý</label>
                                        <select name="quy" id="quy" class="form-control">
                                            <option value="0" {{ session('quy') == '0' ? 'selected' : '' }}>Tất cả
                                            </option>
                                            <option value="1" {{ session('quy') == '1' ? 'selected' : '' }}>Quý 1
                                            </option>
                                            <option value="2" {{ session('quy') == '2' ? 'selected' : '' }}>Quý 2
                                            </option>
                                            <option value="3" {{ session('quy') == '3' ? 'selected' : '' }}>Quý 3
                                            </option>
                                            <option value="4" {{ session('quy') == '4' ? 'selected' : '' }}>Quý 4
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pull-right my-3 px-1">
                                    <a class="btn btn-lg btn-primary mt-3"
                                        href="{{ url('dashboard/report/purchasing-situation') }}"> Xóa </a>
                                </div>
                                <div class="pull-right my-3">
                                    <input class="btn btn-lg btn-primary mt-3" type="submit" value="Áp dụng">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="h4 text-blue">Biểu đồ </h4>
                            @include('dashboard.report.graph.chart-2')
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="pd-20 card-box mb-40">
                            <div class="clearfix mb-20">
                                <div class="pull-left">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form class="mx-2" action="{{ route('xuatfile-excel-thongtintinhhinhthumua') }}"
                                            method="POST">
                                            @csrf
                                            <input type="text" name="tunam" id="tunam-export" hidden>
                                            <input type="text" name="dennam" id="dennam-export" hidden>
                                            <input type="text" name="quy" id="quy-export" hidden>

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
                                    <h4 class="text-blue h4">Báo cáo tình hình thu mua xe</h4>
                                </div>
                            </div>
                            @include('dashboard.report.table.table-purchasing-situation')
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
        function limitLength(element, maxLength) {
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength);
            }
        }
    </script>

    <script>
        document.getElementById('export-csv-tinhhinhthumua').addEventListener('click', function() {
            // Lấy dữ liệu từ input1
            var input1Value = document.getElementById('tunam').value;
            var input2Value = document.getElementById('dennam').value;
            var input3Value = document.getElementById('quy').value;

            // Truyền dữ liệu vào input2
            document.getElementById('tunam-export').value = input1Value;
            document.getElementById('dennam-export').value = input2Value;
            document.getElementById('quy-export').value = input3Value;
        });
    </script>


@endsection
