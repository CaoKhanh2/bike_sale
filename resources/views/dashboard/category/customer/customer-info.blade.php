@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin khách hàng')
@section('pg-card-title', 'Thông tin khách hàng')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin khách hàng') @section('act3', 'active')
@section('st4', 'false')

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
                                @if (Auth::User()->phanquyen == 'Quản trị viên')
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#form-add" role="tab"
                                            aria-selected="false">Thêm dữ liệu</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="table" role="tabpanel">
                                    <div class="pt-20 table-responsive">
                                        <table class="table hover multiple-select-row nowrap dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th class="table-plus datatable-nosort">Mã khách hàng</th>
                                                    <th>Họ và tên</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Giới tính</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Email</th>
                                                    <th>Tên tài khoản</th>
                                                    <th>Tình trạng</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($nguoidung as $i)
                                                    <tr>
                                                        <td class="table-plus">{{ 'MKH-'.$i->mand }}</td>
                                                        <td>{{ $i->hovaten }}</td>
                                                        <td>
                                                            {{ date('d/m/Y', strtotime($i->ngaysinh)) }}
                                                        </td>
                                                        <td>{{ $i->gioitinh }}</td>
                                                        <td>{{ $i->sodienthoai }}</td>
                                                        <td>{{ $i->email }}</td>
                                                        <td>{{ $i->tentk }}</td>
                                                        <td>
                                                            @php
                                                                $rs = strval($i->tinhtrang);
                                                                if ($rs == '1') {
                                                                    echo '<img src="' .
                                                                        asset('Image/Icon/check.png') .
                                                                        '" alt="" srcset="" width="25" height=215">';
                                                                } else {
                                                                    echo '<img src="' .
                                                                        asset('Image/Icon/remove.png') .
                                                                        '" alt="" srcset="" width="25" height="25">';
                                                                }
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            <a type="button" class="btn btn-primary"
                                                                href="{{ route('ctthongtinkhachhang', ['id' => $i->mand]) }}">
                                                                <i class="bi bi-eye"></i> Xem
                                                            </a>
                                                            <a type="button" class="btn btn-danger"
                                                                href="{{ route('xoathongtinkhachhang', ['id' => $i->mand]) }}">
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
                                        <form method="POST" action="{{ route('themthongtinkhachhang') }}"
                                            class="form mt-2">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="hoten">Họ và tên</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" name="hoten" id="hoten" is-invalid/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="gioitinh">Giới tính</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="custom-select col-12" id="gioitinh" name="gt">
                                                        <option selected hidden>Choose...</option>
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="cccd">Căn cước công đân</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" type="number" name="cccd" id="cccd"
                                                        maxlength="11" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="ngsinh">Ngày sinh</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" type="date" name="ngsinh"
                                                        id="ngsinh" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="sdt">Số điện thoại</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" type="number" name="sdt"
                                                        id="sdt" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="email">Email</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" type="email" name="email"
                                                        id="email" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="tentk">Tên tài khoản</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" type="text" name="tentk"
                                                        id="tentk" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="password">Mật khẩu</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" type="password" name="password"
                                                        id="password" required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="diachi">Địa chỉ</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" name="dc" id="diachi" required/>
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="submit"
                                                    class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                                            </div>
                                        </form>
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
