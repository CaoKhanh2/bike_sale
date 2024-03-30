@extends('dashboard.layout.content')

@section('title_ds', 'Danh sách xe đăng ký bán')
@section('pg-hd-2', 'Danh sách xe đăng ký bán')

@section('main')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}

                <!-- Export Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-10">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="tab" href="#home2" role="tab"
                                    aria-selected="true">Chờ xác nhận</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#profile2" role="tab"
                                    aria-selected="false">Đang xử lý</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#contact2" role="tab"
                                    aria-selected="false">Đã mua</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel">
                                <div class="pd-20">

                                    <table class="table hover multiple-select-row data-table-export nowrap">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Ngày bán</th>
                                                <th>Mô tả</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="table-plus">Gloria F. Mead</td>
                                                <td>25</td>
                                                <td>Sagittarius</td>
                                                <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                                <td>
                                                    {{-- <a href="{{ url('/car_catalog/detail_inforcar') }}" type="button"
                                                            class="btn btn-primary">Sửa</a>
                                                        <a href="" type="button" class="btn btn-primary">Xóa</a> --}}

                                                    <a type="button" class="btn btn-primary"
                                                        href="{{ url('/car_catalog/detail_inforcar') }}">
                                                        <i class="bi bi-pencil-fill"></i> Sửa
                                                    </a>
                                                    <a type="button" class="btn btn-danger" href="">
                                                        <i class="bi bi-trash3"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile2" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover multiple-select-row data-table-export nowrap">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Ngày bán</th>
                                                <th>Mô tả</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="table-plus">Gloria F. Mead</td>
                                                <td>25</td>
                                                <td>Sagittarius</td>
                                                <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                                <td>


                                                    <a type="button" class="btn btn-primary"
                                                        href="{{ url('/car_catalog/detail_inforcar') }}">
                                                        <i class="bi bi-pencil-fill"></i> Sửa
                                                    </a>
                                                    <a type="button" class="btn btn-danger" href="">
                                                        <i class="bi bi-trash3"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact2" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover multiple-select-row data-table-export nowrap">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Ngày bán</th>
                                                <th>Mô tả</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="table-plus">Gloria F. Mead</td>
                                                <td>25</td>
                                                <td>Sagittarius</td>
                                                <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                                <td>29-03-2018</td>
                                                <td>$162,700</td>
                                                <td>


                                                    <a type="button" class="btn btn-primary"
                                                        href="{{ url('/car_catalog/detail_inforcar') }}">
                                                        <i class="bi bi-pencil-fill"></i> Sửa
                                                    </a>
                                                    <a type="button" class="btn btn-danger" href="">
                                                        <i class="bi bi-trash3"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Export Datatable End -->
            </div>

        </div>
    </div>
@endsection
