@extends('guest-acc.layout.content')

@section('title', 'Thông tin cá nhân')
@section('pg-hd-2', 'Tài khoản')
@section('st3', 'true') @section('pg-hd-3', 'Thông tin cá nhân') @section('act3', 'text-dark')
@section('st4', 'false')

@php
    $nguoidung = Auth::guard('guest')->user();
@endphp

@section('guest-content')
    {{-- @include('guest-acc.layout.header') --}}

    {{-- Thông báo --}}
    @if (Session::has('success-thaydoi-matkhau-Guest'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-thaydoi-matkhau-Guest') }}",
            });
        </script>
    @endif
    @if (Session::has('cross-thaydoi-matkhau-Guest'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('cross-thaydoi-matkhau-Guest') }}",
            });
        </script>
    @endif

    @if (Session::has('success-thaydoi-thongtin-Guest'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-thaydoi-thongtin-Guest') }}",
            });
        </script>
    @endif

    @if (Session::has('cross-thaydoi-thongtin-Guest'))
        <script>
            Swal.fire({
                icon: "info",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('cross-thaydoi-thongtin-Guest') }}",
            });
        </script>
    @endif
    {{-- End Thông báo --}}

    <section style="background-color: #eee;">
        <div class="container py-3">
            @include('layout.header-breadcrum')
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                    alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3">{{ $nguoidung->hovaten }}</h5>
                            </div>
                            {{-- <p class="text-muted mb-1">/p> --}}
                            {{-- <p class="text-muted mb-4"></p> --}}
                            <div class="mb-2">
                                <div class="text-center">
                                    <button id="change-password-button" class="btn btn-primary">Thay đổi mật khẩu</button>
                                </div>
                                @include('guest-acc.auth.change-password')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $nguoidung->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Giới tính</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $nguoidung->gioitinh }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Căn cước công dân</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $nguoidung->cccd }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Tên tài khoản</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $nguoidung->tentk }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Số điện thoại</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $nguoidung->sodienthoai }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Địa chỉ</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $nguoidung->diachi }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 d-flex justify-content-end align-items-end">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="btn btn-primary ms-1">Sửa thông tin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Sửa đổi thông tin cá nhân</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('thuchien-thaydoi-thongtin-Guest') }}" method="POST" id="myForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="hovaten" name="hovaten"
                                        value="{{ $nguoidung->hovaten }}">
                                    @error('hovaten')
                                        @if (str_contains($message, 'required'))
                                            <small class="help-block">
                                                <p class="text-warning">{{ $message }}</p>
                                            </small>
                                        @else
                                            <small class="help-block">
                                                <p class="text-danger">{{ $message }}</p>
                                            </small>
                                        @endif
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ngaysinh" class="col-form-label">Ngày sinh</label>
                                    <input type="date" class="form-control" id="ngaysinh" name="ngaysinh"
                                        value="{{ $nguoidung->ngaysinh }}">
                                    @error('ngaysinh')
                                        <small class="help-block">
                                            <p class="text-warning">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gioitinh" class="col-form-label">Giới tính</label>
                                    <select name="gioitinh" id="gioitinh" class="form-select">
                                        <option value="" {{ $nguoidung->gioitinh == '' ? 'selected' : '' }} hidden>
                                            Lựa chọn...
                                        </option>
                                        <option value="Nam" {{ $nguoidung->gioitinh == 'Nam' ? 'selected' : '' }}>Nam
                                        </option>
                                        <option value="Nữ" {{ $nguoidung->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ
                                        </option>
                                    </select>
                                    @error('gioitinh')
                                        <small class="help-block">
                                            <p class="text-warning">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Tên tài khoản</label>
                                    <input type="text" class="form-control" id="tentaikhoan" name="tentaikhoan"
                                        value="{{ $nguoidung->tentk }}">
                                    @error('tentaikhoan')
                                        <small class="help-block">
                                            <p class="text-warning">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cccd" class="col-form-label">Căn cước công dân</label>
                                    <input type="number" class="form-control" id="cccd" name="cccd"
                                        oninput="limitLength(this, 11)" value="{{ $nguoidung->cccd }}">
                                    @error('cccd')
                                        @if (str_contains($message, 'required'))
                                            <small class="help-block">
                                                <p class="text-warning">{{ $message }}</p>
                                            </small>
                                        @else
                                            <small class="help-block">
                                                <p class="text-danger">{{ $message }}</p>
                                            </small>
                                        @endif
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sodienthoai" class="col-form-label">Số điện thoại</label>
                                    <input type="number" class="form-control" id="sodienthoai" name="sodienthoai"
                                        oninput="limitLength(this, 11)" value="{{ $nguoidung->sodienthoai }}">
                                    @error('sodienthoai')
                                        @if (str_contains($message, 'required'))
                                            <small class="help-block">
                                                <p class="text-warning">{{ $message }}</p>
                                            </small>
                                        @else
                                            <small class="help-block">
                                                <p class="text-danger">{{ $message }}</p>
                                            </small>
                                        @endif
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="diachi" class="col-form-label">Địa chỉ</label>
                                    <textarea class="form-control" id="diachi" rows="3" name="diachi">{{ $nguoidung->diachi }}</textarea>
                                    @error('diachi')
                                        @if (str_contains($message, 'required'))
                                            <small class="help-block">
                                                <p class="text-warning">{{ $message }}</p>
                                            </small>
                                        @else
                                            <small class="help-block">
                                                <p class="text-danger">{{ $message }}</p>
                                            </small>
                                        @endif
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" id="submitBtn" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function limitLength(element, maxLength) {
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength);
            }
        }

        $(document).ready(function() {
            $('#change-password-button').click(function() {
                $('#change-password-form').toggleClass('hidden');
            });
        });

        document.getElementById('submitBtn').addEventListener('click', function() {
            document.getElementById('myForm').submit();
        });
    </script>

@endsection
