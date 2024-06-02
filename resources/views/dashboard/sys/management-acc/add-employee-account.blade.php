@extends('dashboard.layout.content')

@section('title_ds', 'Tài khoản nhân viên')
@section('pg-card-title', 'Tài khoản nhân viên')
@section('pg-hd-2', 'Hệ thống')
@section('pg-hd-3', 'Quản lý tài khoản')
@section('pg-hd-4', 'Tài khoản nhân viên') @section('st4', 'true')
@section('pg-hd-5', 'Thêm tài khoản nhân viên') @section('st5', 'true') @section('act5', 'active')

@section('main')
    @if (Session::has('success-tao-taikhoan-nhanvien'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-tao-taikhoan-nhanvien') }}",
            });
        </script>
    @endif
    @if (Session::has('cross-them-taikhoannhanvien'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: "{{ Session::get('cross-them-taikhoannhanvien') }}",
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    toast: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            });
        </script>
    @endif
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                <div class="pd-20 card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pb-20">
                        <form method="POST" action="{{ route('thuchien-them-taikhoannhanvien') }}" class="form mt-2">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="manv">Mã nhân viên</label>
                                <div class="col-sm-12 col-md-10">
                                    <select name="manv" id="manv" class="form-control manhanvien">
                                        <option value="" hidden selected></option>
                                        @foreach ($manv as $i)
                                            <option value="{{ $i->manv }}"
                                                {{ old('manv') == $i->manv ? 'selected' : '' }}>
                                                {{ $i->manv }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('manv')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="tentk">Tên tài khoản</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="form-control" name="tentk" id="tentk"
                                        value="{{ old('tentk') }}" required />
                                    @error('tentk')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="email">Email</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}" required />
                                    @error('email')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="matkhau">Mật khẩu</label>
                                <div class="col-sm-12 col-md-10">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="matkhau" name="matkhau"
                                            aria-describedby="toggle-password-visibility"
                                            placeholder="Mật khẩu sẽ được tạo mặc định là 'SĐT'@" />
                                        <span class="input-group-text" id="toggle-password-visibility">
                                            <i class="bi bi-eye" id="toggle-password-icon"></i>
                                        </span>
                                    </div>
                                    @error('matkhau')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="phanquyen">Phân quyền</label>
                                <div class="col-sm-12 col-md-10">
                                    <select name="phanquyen" id="phanquyen" class="form-control">
                                        @foreach ($enumValues as $i)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endforeach
                                    </select>
                                    @error('')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                                <a href=""></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function initializeSelect2() {
            $('select.manhanvien').select2({
                placeholder: "Tìm mã nhân viên",
                allowClear: true
            });
        }

        // Initialize Select2 when the document is ready
        $(document).ready(function() {
            initializeSelect2();
        });
    </script>
    <script>
        document.getElementById('toggle-password-visibility').addEventListener('click', function() {
            const passwordInput = document.getElementById('matkhau');
            const icon = document.getElementById('toggle-password-icon');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });
    </script>
@endsection
