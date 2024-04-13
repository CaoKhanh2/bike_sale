@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin nhân viên')
@section('pg-hd-1', 'Trang chủ')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin nhân viên')

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
                    <div class="pb-20">
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#table" role="tab"
                                        aria-selected="true">Thông tin bảng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#form-add" role="tab"
                                        aria-selected="false">Thêm dữ liệu</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="table" role="tabpanel">
                                    <div class="pt-20">
                                        <table class="table hover multiple-select-row data-table-export nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="table-plus datatable-nosort">Mã nhân viên</th>
                                                    <th>Chức vụ</th>
                                                    <th>Họ và tên</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Giới tính</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Email</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($nhanvien as $i)
                                                    <tr>
                                                        <td class="table-plus">{{ $i->manv }}</td>
                                                        <td>{{ $i->tencv }}</td>
                                                        <td>{{ $i->hovaten }}</td>
                                                        <td>
                                                            @php
                                                                $formattedDate = date('d/m/Y', strtotime($i->ngaysinh));
                                                                echo $formattedDate;
                                                            @endphp
                                                        </td>
                                                        <td>{{ $i->gioitinh }}</td>
                                                        <td>{{ $i->sodienthoai }}</td>
                                                        <td>{{ $i->email }}</td>
                                                        <td>{{ $i->diachi }}</td>
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
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-add" role="tabpanel">
                                    <div class="pd-20">
                                        <form action="" class="form mt-2">

                                        </form>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                                    </div>
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
