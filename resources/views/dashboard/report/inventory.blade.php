@extends('dashboard.layout.content')

@section('title_ds', 'Báo cáo hàng tồn kho')
@section('pg-card-title', 'Báo cáo hàng tồn kho')
@section('pg-hd-2', 'Báo cáo thống kê')
@section('pg-hd-3', 'Báo cáo hàng tồn kho')
@section('st4', 'false')

@section('main')

<style>
    .table-bordered.border-dark th,
    .table-bordered.border-dark td {
        border-width: 2px;
        border-color: #212529;
    }
</style>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                <div class="row">
                    <div class="col-12">
                        <div class="pd-20 card-box mb-30">
                            {{-- <h4 class="h4 text-blue"></h4> --}}
                            <form action="">
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="">Chọn loại xe</label>
                                        <select class="custom-select">
                                            <option selected="">Choose...</option>
                                            <option value="1">Xe máy</option>
                                            <option value="2">Xe đạp điện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="">Từ ngày</label>
                                        <input class="form-control" type="date" placeholder="Chọn thời gian"
                                            type="text">

                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="">Đến ngày</label>
                                        <input class="form-control" type="date" placeholder="Chọn thời gian"
                                            type="text">

                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="">Chọn kho</label>
                                        <select class="custom-select">
                                            <option selected="">Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="">Tên xe</label>
                                        <input class="form-control" name="" id=""
                                            placeholder="Tên hoặc mã xe" />
                                    </div>
                                </div>
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="pull-right">
                                            <input class="btn btn-lg btn-primary mt-3" type="submit" value="Áp dụng">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="pd-20 card-box mb-30">
                            <div class="pb-20">
                                <table class="table table-bordered border-dark text-center align-items-center data-table-export">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="align-middle">STT</th>
                                            <th rowspan="2" class="align-middle">Phiên bản sản phẩm</th>
                                            <th rowspan="2" class="align-middle">Mã SP</th>
                                            <th colspan="4">Tồn kho</th>
                                            <th colspan="2">Hệ thống</th>
                                        </tr>
                                        <tr>
                                            <th>Tồn kho</th>
                                            <th>Giá trị tồn kho</th>
                                            <th>Giá vốn</th>
                                            <th>Tỷ trọng (%)</th>
                                            <th>Tồn kho</th>
                                            <th>Giá trị tồn kho</th>
                                        </tr>
                                        <tr>
                                            <th>Tổng</th>
                                            <th></th>
                                            <th></th>
                                            <th>412</th>
                                            <th>264,720,000</th>
                                            <th></th>
                                            <th></th>
                                            <th>89</th>
                                            <th>88,700,000</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
