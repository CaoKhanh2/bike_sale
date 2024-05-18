@extends('guest-acc.layout.content')

@section('title', 'Thông tin cá nhân')
@section('pg-hd-2', 'Tài khoản')
@section('st3', 'true') @section('pg-hd-3', 'Thông tin cá nhân') @section('act3', 'text-dark')
@section('st4', 'false')

@section('guest-content')
    @include('guest-acc.layout.header')
    <section style="background-color: #eee;">
        <div class="container py-3">
            @include('layout.header-breadcrum')
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ Auth::guard('guest')->user()->hovaten }}</h5>
                            {{-- <p class="text-muted mb-1">/p> --}}
                            {{-- <p class="text-muted mb-4"></p> --}}
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Đổi
                                    mật khẩu</button>
                                {{-- <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-outline-primary ms-1">Thay ảnh đại diện</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Họ và tên</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ Auth::guard('guest')->user()->hovaten }}</p>
                            </div>
                        </div>
                        <hr> --}}
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('guest')->user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Giới tính</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('guest')->user()->gioitinh }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Căn cước công dân</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('guest')->user()->cccd }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Tên tài khoản</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('guest')->user()->tentk }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Số điện thoại</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('guest')->user()->sodienthoai }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Địa chỉ</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::guard('guest')->user()->diachi }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 d-flex justify-content-end align-items-end">
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary ms-1">Sửa thông tin</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
