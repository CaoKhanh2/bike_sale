@extends('dashboard.layout.content')
@section('title_ds','Thông tin khách hàng')
@section('pg-hd-1','Danh mục khách hàng')
@section('pg-hd-2','Thông tin khách hàng')
@section('main')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        {{-- Page Header --}}
            @include('dashboard.layout.page-header')
        {{-- End Page Header--}}

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Thông tin khách hàng</h4>
                    
                </div>
            </div>
            <form>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mã khách hàng</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Họ và tên</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Ngày sinh</label>
                    <div class="col-sm-12 col-md-10">
                      <input
                        class="form-control"
                        type="date"
                      />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Giới tính</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" value="" type="tel" maxlength="10">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" value="@example.com" type="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Địa chỉ</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" type="text" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tình trạng</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">Hoạt động</option>
                            <option value="2">Ngừng hoạt động</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

