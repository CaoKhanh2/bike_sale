@extends('guest-acc.layout.content')

@section('guest-content')
    <div class="container my-5">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4 mt-5">
                <div class="row my-3">
                    <a href="{{ route('indexWeb') }}">
                        <div class="row my-3 d-flex justify-content-center">
                            <img src="{{ asset('Image\logo\logo.png') }}" alt="Logo"
                                class="align-text-center rounded-circle w-50">
                        </div>
                    </a>
                    <h4 class="fw-bold">Đăng nhập</h4>
                </div>
                <form method="POST" action="{{ route('thuchien-dangnhap-Guest') }}">
                    @csrf
                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="form2Example1" class="form-control" name="username" />
                        <label class="form-label" for="form2Example1">Tài khoản hoặc email</label>
                    </div>
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control" name="password" autocomplete="off" />
                        <label class="form-label" for="form2Example2">Mật khẩu</label>
                    </div>
                    @if (Session::has('cross-dangnhap-Guest'))
                        <div class="alert alert-danger">
                            {{ Session::get('cross-dangnhap-Guest') }}
                        </div>
                    @endif
                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col">
                            <!-- Simple link -->
                            <a href="{{ route('quen-matkhau-Guest') }}">Quên mật khẩu ?</a>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Đăng nhập</button>
                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Chưa có tài khoản? <a href="{{ route('thuchien-dangky-Guest') }}">Đăng ký tài khoản mới</a></p>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                @if (Session::has('success-dangky-Guest'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success-dangky-Guest') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('success-xacnhanmail-Guest'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success-xacnhanmail-Guest') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('success-datlai-matkhau-Guest'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success-datlai-matkhau-Guest') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection
