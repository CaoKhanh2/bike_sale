@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin nhân viên')
@section('pg-hd-1', 'Trang chủ')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin nhân viên')
@section('pg-hd-4', 'Chi tiết thông tin nhân viên') @section('st4', 'true') @section('act4', 'active')


@section('main')
    @if (Session::has('success-capnhat-thongtinnhanvien'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-capnhat-thongtinnhanvien') }}",
            });
        </script>
    @endif
    @if (Session::has('success-datlai-matkhau'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: "{{ Session::get('success-datlai-matkhau') }}",
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
                <form method="POST" action="{{ route('capnhat-thongtinnhanvien') }}" class="form mt-2">
                    @csrf
                    <div class="pd-20 card-box mb-30">
                        <div class="pd-20">
                            <h4 class="text-blue h4">Thông tin cá nhân</h4>
                        </div>
                        <div class="pb-20">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="manv">Mã nhân viên</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="form-control" id="manv"
                                        value="{{ $nhanvien->manv }}" disabled>
                                    <input type="text" class="form-control" name="manv"
                                        value="{{ $nhanvien->manv }}" hidden>
                                    @error('manv')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="chucvu">Chức vụ</label>
                                <div class="col-sm-12 col-md-10">
                                    <select name="chucvu" id="chucvu" class="form-control">
                                        <option value="{{ $nhanvien->macv }}" selected hidden>{{ $nhanvien->tencv }}
                                        </option>
                                        @foreach ($chucvu as $i)
                                            <option value="{{ $i->macv }}">{{ $i->tencv }}</option>
                                        @endforeach
                                    </select>
                                    @error('chucvu')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="hovaten">Họ và tên</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="form-control" name="hovaten" id="hovaten"
                                        value="{{ $nhanvien->hovaten }}" required />
                                    @error('hovaten')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="gioitinh">Giới tính</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select col-12" id="gioitinh" name="gioitinh">
                                        <option value="" {{ $nhanvien->gioitinh == '' ? 'selected' : '' }} hidden>Lựa
                                            chọn...</option>
                                        <option value="Nam" {{ $nhanvien->gioitinh == 'Nam' ? 'selected' : '' }}>Nam
                                        </option>
                                        <option value="Nữ" {{ $nhanvien->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="ngaysinh">Ngày sinh</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="date" class="form-control" name="ngaysinh" id="ngaysinh"
                                        value="{{ $nhanvien->ngaysinh }}" required />
                                    @error('ngaysinh')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="sdt">Số điện thoại</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="tel" class="form-control" name="sdt" id="sdt"
                                        value="{{ $nhanvien->sodienthoai }}" required />
                                    @error('sdt')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="diachi">Địa chỉ</label>
                                <div class="col-sm-12 col-md-10">
                                    <textarea name="diachi" id="diachi" class="form-control" cols="30">{{ $nhanvien->diachi }}</textarea>
                                    @error('diachi')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="ghichu">Ghi chú</label>
                                <div class="col-sm-12 col-md-10">
                                    <textarea name="ghichu" id="ghichu" class="form-control" cols="30">{{ $nhanvien->ghichu }}</textarea>
                                    @error('ghichu')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pd-20 card-box mb-30">
                        <div class="pd-20">
                            <h4 class="text-blue h4">Thông tin tài khoản</h4>
                        </div>
                        <div class="pb-20">
                            <div class="form-group row">
                                <input type="text" name="matk" value="{{ $nhanvien->matk }}" hidden>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="tentk">Tên tài khoản</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="form-control" name="tentk" id="tentk"
                                        value="{{ $nhanvien->tentaikhoan }}"
                                        {{ Auth::user()->phanquyen == 'Quản trị viên' ? '' : 'disabled' }} required />
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
                                        value="{{ $nhanvien->email }}"
                                        {{ Auth::user()->phanquyen == 'Quản trị viên' ? '' : 'disabled' }} required />
                                    @error('email')
                                        <small class="help-block">
                                            <p class="text-danger">{{ $message }}</p>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label" for="matkhau">Mật khẩu</label>
                                <div class="col-sm-12 col-md-10">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="matkhau" name="matkhau"
                                            aria-describedby="toggle-password-visibility"
                                            value="{{ $nhanvien->password }}" {{ Auth::user()->phanquyen == 'Quản trị viên' ? '' : 'disabled' }}/>
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
                            </div> --}}
                            @if (Auth::user()->phanquyen == 'Quản trị viên')
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label" for="phanquyen">Phân quyền</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select name="phanquyen" id="phanquyen" class="form-control">
                                            <option value="{{ $nhanvien->phanquyen }}" selected hidden>
                                                {{ $nhanvien->phanquyen }}
                                            </option>
                                            @foreach ($enumValues as $i)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" id="submitButton" class="btn btn-secondary me-md-2 mx-3 my-3"> <i class="bi bi-arrow-clockwise"></i> Đặt
                                    lại mật
                                    khẩu</button>
                                <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3"> <i class="bi bi-upload"></i> Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{ route('datlai-matkhau-taikhoannhanvien') }}" method="POST" id="formToSubmit">
                    @csrf
                    <input type="text" name="matk" value="{{ $nhanvien->matk }}" hidden>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submitButton').addEventListener('click', function() {
            document.getElementById('formToSubmit').submit();
        });
    </script>

    {{-- <script>
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
    </script> --}}
    {{-- <script>
        document.getElementById('toggle-password-visibility').addEventListener('click', function() {
            const passwordInput = document.getElementById('matkhau');
            const icon = document.getElementById('toggle-password-icon');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });
    </script> --}}
@endsection
