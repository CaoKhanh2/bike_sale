@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin khách hàng')
@section('pg-card-title', 'Chi tiết thông khách hàng')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin khách hàng') @section('act3', 'active')
@section('st4', 'false')

@if (Auth::User()->phanquyen == 'Nhân viên'){

    @section('taikhoan', 'disabled');
    @section('matkhau', 'disabled');

}
    
@endif

@section('main')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}
            <div class="pd-20 card-box mb-3">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Thông tin khách hàng</h4>
                    </div>
                </div>
                <form action="{{ route('capnhatthongtinkhachhang', ['id' => $nd->mand] )}}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="mand">Mã khách hàng</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="mand" value="{{ 'MKH-'.$nd->mand }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="hovaten">Họ và tên</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="hovaten" value="{{ $nd->hovaten }}" name="hoten" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="ngaysinh">Ngày sinh</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="ngaysinh" type="date" value="{{ $nd->ngaysinh }}" name="ngsinh" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="cccd">Căn cước công dân</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="cccd" type="number" value="{{ $nd->cccd }}" name="cccd" maxlength="11" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="gioitinh">Giới tính</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" id="gioitinh" name="gt">
                                <option value="" {{ $nd->gioitinh == '' ? 'selected' : '' }} hidden>Lựa chọn...</option>
                                <option value="Nam" {{ $nd->gioitinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ $nd->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="sdt">Số điện thoại</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="sdt" value="{{ $nd->sodienthoai }}" type="tel" maxlength="11"
                                name="sdt">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="email">Email</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="email" value="{{ $nd->email }}" type="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="tentk">Tên tài khoản</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="tentk" value="{{ $nd->tentk }}" type="text" name="tentk" @yield('taikhoan')>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="password">Mật khẩu</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="password" value="{{ $nd->password }}" type="text" name="password" @yield('matkhau')>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="diachi">Địa chỉ</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="diachi" type="text" placeholder="" value="{{ $nd->diachi }}"
                                name="dc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="tinhtrang">Tình trạng</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" id="tinhtrang" name="tt">
                                <option value="" {{ $nd->tinhtrang == '' ? 'selected' : '' }}>Choose...</option>
                                <option value="1" {{ $nd->tinhtrang == '1' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="0" {{ $nd->tinhtrang == '0' ? 'selected' : '' }}>Ngừng hoạt động</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
