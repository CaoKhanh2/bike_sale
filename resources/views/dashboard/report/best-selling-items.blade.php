@extends('dashboard.layout.content')

@section('title_ds', 'Báo cáo mặt hàng bán chạy')
@section('pg-hd-1', 'Danh mục xe')
@section('pg-hd-2', 'Thông tin xe')

@section('main')

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/dashboard') }}">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Báo cáo thống kê
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h4 class="h4 text-blue">Báo cáo sản phẩm bán chạy</h4>
                            <div id="chart8"></div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            {{-- <h4 class="h4 text-blue"></h4> --}}
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="">Từ ngày</label>
                                        <input class="form-control datetimepicker" placeholder="Chọn thời gian"
                                            type="text">

                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="example-datetime-local-input" class="">Đến ngày</label>
                                        <input class="form-control datetimepicker" placeholder="Chọn thời gian"
                                            type="text">

                                    </div>
                                </div>
                                <div class="row mt-3">
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
                            </form>

                            <div class="pull-right">

                                <input class="btn btn-lg btn-primary mt-3" type="submit" value="Áp dụng">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box mb-30">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Data Table with Export Buttons</h4>
                            </div>
                            <div class="pb-20">
                                <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <table
                                        class="table hover multiple-select-row data-table-export nowrap dataTable no-footer dtr-inline"
                                        id="DataTables_Table_2" role="grid">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Hình ảnh</th>
                                                <th>Mã xe</th>
                                                <th>Tên xe</th>
                                                <th>Số lượng</th>
                                                <th>Tiền hàng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>30</td>
                                                <td>Gemini</td>
                                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>20</td>
                                                <td>Gemini</td>
                                                <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>30</td>
                                                <td>Sagittarius</td>
                                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>25</td>
                                                <td>Gemini</td>
                                                <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>20</td>
                                                <td>Sagittarius</td>
                                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>18</td>
                                                <td>Gemini</td>
                                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>30</td>
                                                <td>Sagittarius</td>
                                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>30</td>
                                                <td>Sagittarius</td>
                                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>30</td>
                                                <td>Gemini</td>
                                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle</td>
                                                <td>30</td>
                                                <td>Gemini</td>
                                                <td>1280 Prospect Valley Road Long Beach, CA 90802</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
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
    </div>


    <!-- js -->
    <script src="{{ asset('dashboard_src/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/apexcharts-setting.js') }}"></script>


@endsection
