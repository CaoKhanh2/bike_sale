@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin tài khoản')
@section('pg-hd-1', 'Trang chủ')
@section('pg-hd-2', 'Cá nhân')
@section('pg-hd-3', 'Thông tin tài khoản') @section('act3', 'active')

@section('main')
    @if (Session::has('success-capnhat-thongtintaikhoan'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-capnhat-thongtintaikhoan') }}",
            });
        </script>
    @endif
    @if (Session::has('success-thaydoi-matkhau'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-thaydoi-matkhau') }}",
            });
        </script>
    @endif
    @if (Session::has('cross-thaydoi-matkhau'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('cross-thaydoi-matkhau') }}",
            });
        </script>
    @endif
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                @include('dashboard.layout.page-header')

                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo">
                                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                                        class="fa fa-pencil"></i></a>
                                <img src="vendors/images/photo1.jpg" alt="" class="avatar-photo" />
                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body pd-5">
                                                <div class="img-container">
                                                    <img id="image" src="vendors/images/photo2.jpg" alt="Picture" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" value="Update" class="btn btn-primary" />
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-center h5 mb-0">{{ $taikhoan->hovaten }}</h5>
                            <p class="text-center text-muted font-14">
                                {{ $taikhoan->ghichu }}
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#timeline"
                                                role="tab">Thông tin</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Thay đổi mật
                                                khẩu</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#setting"
                                                role="tab">Settings</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- Timeline Tab start -->
                                        <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="profile">
                                                    <form method="POST" action="">
                                                        @csrf
                                                        @method('PATCH')
                                                        <h4 class="text-blue h5 mb-20">
                                                            Thay đổi thông tin tài khoản
                                                        </h4>
                                                        <div class="form-group">
                                                            <label for="hovaten">Họ và tên</label>
                                                            <input class="form-control form-control-lg" id="hovaten"
                                                                name="hovaten" type="text"
                                                                value="{{ $taikhoan->hovaten }}" required />
                                                            @error('hovaten')
                                                                <small class="help-block">
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tentk">Tài khoản đăng nhập</label>
                                                            <input class="form-control form-control-lg" id="tentk"
                                                                name="tentk" type="text"
                                                                value="{{ $taikhoan->tentaikhoan }}" required />
                                                            @error('tentk')
                                                                <small class="help-block">
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input class="form-control form-control-lg" type="email"
                                                                name="email" value="{{ $taikhoan->email }}" id="email"
                                                                required />
                                                            @error('email')
                                                                <small class="help-block">
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ngaysinh">Ngày sinh</label>
                                                            <input class="form-control form-control-lg date-picker"
                                                                type="date" name="ngaysinh" id="ngaysinh"
                                                                value="{{ $taikhoan->ngaysinh }}" required />
                                                            @error('ngaysinh')
                                                                <small class="help-block">
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Giới tính</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio" id="gioitinh1" name="gioitinh"
                                                                        class="custom-control-input"
                                                                        {{ $taikhoan->gioitinh == 'Nam' ? 'checked' : '' }}
                                                                        value="Nam" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="gioitinh1">Nam</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="gioitinh2" name="gioitinh"
                                                                        class="custom-control-input"
                                                                        {{ $taikhoan->gioitinh == 'Nữ' ? 'checked' : '' }}
                                                                        value="Nữ" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="gioitinh2">Nữ</label>
                                                                </div>
                                                            </div>
                                                            @error('gioitinh')
                                                                <small class="help-block">
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sodienthoai">Số điện thoại</label>
                                                            <input class="form-control form-control-lg" type="number"
                                                                name="sodienthoai" id="sodienthoai"
                                                                value="{{ $taikhoan->sodienthoai }}"
                                                                oninput="limitLength(this, 11)" required />
                                                            @error('sodienthoai')
                                                                <small class="help-block">
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="diachi">Địa chỉ</label>
                                                            <textarea class="form-control" id="diachi" name="diachi">{{ $taikhoan->diachi }}</textarea>
                                                            @error('diachi')
                                                                <small class="help-block">
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="submit" class="btn btn-primary"
                                                                value="Cập nhật thông tin" />
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Timeline Tab End -->
                                        <!-- Change Pass start -->
                                        <div class="tab-pane fade" id="tasks" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
                                                    <form method="POST" action="{{ route('thuchien-thaydoi-matkhau') }}"
                                                        id="password-form">
                                                        @csrf
                                                        <div class="form-row mb-4">
                                                            <div class="col-12 col-md-12">
                                                                <label for="current-password">Mật khẩu hiện tại:</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="password" class="form-control"
                                                                        id="current-password" name="current-password"
                                                                        aria-describedby="toggle-current-password-visibility"
                                                                        autocomplete="current-password" required>
                                                                    <span class="input-group-text"
                                                                        id="toggle-current-password-visibility">
                                                                        <i class="bi bi-eye"
                                                                            id="toggle-current-password-icon"></i>
                                                                    </span>
                                                                </div>
                                                                @error('current-password')
                                                                    <small class="help-block">
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    </small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="col-12 col-md-12">
                                                                <label for="new-password">Mật khẩu mới:</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="password" class="form-control"
                                                                        id="new-password" name="new-password"
                                                                        aria-describedby="toggle-new-password-visibility"
                                                                        autocomplete="new-password" required>
                                                                    <span class="input-group-text"
                                                                        id="toggle-new-password-visibility">
                                                                        <i class="bi bi-eye"
                                                                            id="toggle-new-password-icon"></i>
                                                                    </span>
                                                                </div>
                                                                @error('new-password')
                                                                    <small class="help-block">
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    </small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="col-12 col-md-12">
                                                                <label for="confirm-password">Nhập lại mật khẩu
                                                                    mới:</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="password" class="form-control"
                                                                        id="confirm-password" name="confirm-password"
                                                                        aria-describedby="toggle-confirm-password-visibility"
                                                                        autocomplete="new-password" required>
                                                                    <span class="input-group-text"
                                                                        id="toggle-confirm-password-visibility">
                                                                        <i class="bi bi-eye"
                                                                            id="toggle-confirm-password-icon"></i>
                                                                    </span>
                                                                </div>
                                                                @error('confirm-password')
                                                                    <small class="help-block">
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    </small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                            <button type="submit" class="btn btn-success">Thay
                                                                đổi</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Change Pass End -->
                                        <!-- Setting Tab start -->
                                        <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                            <div class="profile-setting">
                                            </div>
                                        </div>
                                        <!-- Setting Tab End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggle-current-password-visibility').addEventListener('click', function() {
            const passwordInput = document.getElementById('current-password');
            const icon = document.getElementById('toggle-current-password-icon');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });

        document.getElementById('toggle-new-password-visibility').addEventListener('click', function() {
            const passwordInput = document.getElementById('new-password');
            const icon = document.getElementById('toggle-new-password-icon');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });

        document.getElementById('toggle-confirm-password-visibility').addEventListener('click', function() {
            const passwordInput = document.getElementById('confirm-password');
            const icon = document.getElementById('toggle-confirm-password-icon');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });
    </script>
    <script>
        function limitLength(element, maxLength) {
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength);
            }
        }
    </script>
@endsection
