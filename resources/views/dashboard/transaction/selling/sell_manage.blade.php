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
                                <a class="nav-link active" data-toggle="pill" href="#confirmation">CHỜ XÁC NHẬN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#processing">ĐANG XỬ LÝ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#delivery">ĐANG GIAO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#delivered">ĐÃ GIAO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#canceled">ĐÃ HỦY</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="confirmation" class="container tab-pane active"><br>
                                {{-- <table class="table hover data-table-export"> --}}
                                <table style="width:100%">
                                    <thead>
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
                            <div id="processing" class="container tab-pane fade"><br>
                                <table style="width:100%">
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
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="delivery" class="container tab-pane fade"><br>
                                <table style="width:100%">
                                    <thead>
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
                                            <td>suziki</td>
                                            <td>Hải Phòng</td>
                                            <td>Sirius</td>
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="delivered" class="container tab-pane fade"><br>
                                <table style="width:100%">
                                    <thead>
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
                                            <td>Hà Nội</td>
                                            <td>Sirius</td>
                                            <td>$162,700</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="canceled" class="container tab-pane fade"><br>
                                <table style="width:100%">
                                    <thead>
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
                                            <td>$5000</td>
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
