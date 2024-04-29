@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin khách hàng')
@section('pg-card-title', 'Chi tiết thông khách hàng')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin khách hàng') @section('act3', 'active')
@section('st4', 'false')

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
                        <label class="col-sm-12 col-md-2 col-form-label">Mã khách hàng</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $nd->mand }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Họ và tên</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $nd->hovaten }}" name="hoten" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ngày sinh</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="date" value="{{ $nd->ngaysinh }}" name="ngsinh" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Căn cước công dân</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="number" value="{{ $nd->cccd }}" name="cccd" maxlength="11"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Giới tính</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="gt">
                                <option value="" {{ $nd->gioitinh == '' ? 'selected' : '' }}>Choose...</option>
                                <option value="Nam" {{ $nd->gioitinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ $nd->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $nd->sodienthoai }}" type="tel" maxlength="11"
                                name="sdt">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $nd->email }}" type="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" placeholder="" value="{{ $nd->diachi }}"
                                name="dc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tình trạng</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="tt">
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
