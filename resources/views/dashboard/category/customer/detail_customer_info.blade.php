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
                <form action="/dashboard/category/customer/detail_customer_info/{{ $kh->makh }}" method="POST" class="mt-4">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Mã khách hàng</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $kh->makh }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Họ và tên</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $kh->hovaten }}" name="hoten" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ngày sinh</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="date" value="{{ $kh->ngaysinh }}" name="ngsinh" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Giới tính</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="gt">
                                <option value="" {{ $kh->gioitinh == '' ? 'selected' : '' }}>Choose...</option>
                                <option value="Nam" {{ $kh->gioitinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ $kh->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $kh->sodienthoai }}" type="tel" maxlength="10"
                                name="sdt">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $kh->email }}" type="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" placeholder="" value="{{ $kh->diachi }}"
                                name="dc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tình trạng</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="tt">
                                <option value="" {{ $kh->tinhtrang == '' ? 'selected' : '' }}>Choose...</option>
                                <option value="1" {{ $kh->tinhtrang == '1' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="0" {{ $kh->tinhtrang == '0' ? 'selected' : '' }}>Ngừng hoạt động</option>
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
