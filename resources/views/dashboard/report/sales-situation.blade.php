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
                            <form action="">
                                <div class="row">
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
                            </form>

                            <div class="pull-right my-3">
                                <input class="btn btn-lg btn-primary mt-3" type="submit" value="Áp dụng">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="h4 text-blue">Báo cáo sản phẩm bán chạy</h4>
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
                                        <button type="button" class="btn btn-secondary">Xuất file CSV</button>
                                        <button type="button" class="btn btn-secondary">Xuất file PDF</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix mb-20">
                                <div class="pull-left">
                                    <h4 class="text-blue h4">Bordered table</h4>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                        <th scope="col">Tag</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td><span class="badge badge-primary">Primary</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td><span class="badge badge-secondary">Secondary</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                        <td><span class="badge badge-success">Success</span></td>
                                    </tr>
                                </tbody>
                            </table>
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
