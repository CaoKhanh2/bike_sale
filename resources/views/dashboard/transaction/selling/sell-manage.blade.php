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
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="pill" href="#confirmation">CHỜ XÁC
                                    NHẬN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="pill" href="#processing">ĐANG XỬ LÝ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="pill" href="#delivery">ĐANG GIAO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="pill" href="#delivered">ĐÃ GIAO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="pill" href="#canceled">ĐÃ HỦY</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="confirmation" class="tab-pane fade show active" role="tabpanel"><br>
                                {{-- <table class="table hover data-table-export"> --}}
                                <table class="table hover multiple-select-row nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Loại xe</th>
                                            <th>Hãng xe</th>
                                            <th>Địa chỉ</th>
                                            <th>Tên xe</th>
                                            <th>Giá bán</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Xe máy</td>
                                            <td>Yamaha</td>
                                            <td>Hải Phòng</td>
                                            <td>Sirius</td>
                                            <td>$162,700</td>
                                            <td>
                                                <a type="button" class="btn btn-primary" href="">
                                                    <i class="bi bi-check-circle"></i> Xác nhận
                                                </a>
                                                <a type="button" class="btn btn-danger" href="">
                                                    <i class="bi bi-trash3"></i> Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="processing" class="tab-pane fade"><br>
                                <table class="table hover multiple-select-row nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Loại xe</th>
                                            <th>Hãng xe</th>
                                            <th>Địa chỉ</th>
                                            <th>Tên xe</th>
                                            <th>Giá bán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Xe máy</td>
                                            <td>Yamaha</td>
                                            <td>Hải Phòng</td>
                                            <td>Sirius</td>
                                            <td>$10000,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="delivery" class="tab-pane fade"><br>
                                <table class="table hover multiple-select-row nowrap" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Loại xe</th>
                                            <th>Hãng xe</th>
                                            <th>Địa chỉ</th>
                                            <th>Tên xe</th>
                                            <th>Giá bán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Xe đạp điện</td>
                                            <td>Yamaha</td>
                                            <td>Hải Phòng</td>
                                            <td>Sirius</td>
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="delivered" class="tab-pane fade"><br>
                                <table class="table hover multiple-select-row nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Loại xe</th>
                                            <th>Hãng xe</th>
                                            <th>Địa chỉ</th>
                                            <th>Tên xe</th>
                                            <th>Giá bán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Xe máy</td>
                                            <td>Yamaha</td>
                                            <td>hà nội</td>
                                            <td>Sirius</td>
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div id="canceled" class="tab-pane fade"><br>
                                <table class="table hover multiple-select-row nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Loại xe</th>
                                            <th>Hãng xe</th>
                                            <th>Địa chỉ</th>
                                            <th>Tên xe</th>
                                            <th>Giá bán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Xe máy</td>
                                            <td>suzuki</td>
                                            <td>Hải Phòng</td>
                                            <td>Sirius</td>
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Export Datatable End -->
            </div>
        </div>
    </div>

@endsection
