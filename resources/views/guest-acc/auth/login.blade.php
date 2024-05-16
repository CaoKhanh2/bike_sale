@extends('guest-acc.layout.content')

@section('guest-content')
    <div class="container my-5">
        <div class="row mt-5">
            <div class="col-4">
            </div>
            <div class="col-4 mt-5">
                <div class="row my-3">
                    <div class="row my-3 d-flex justify-content-center">
                        <img src="{{ asset('Image\Logo\logo.png') }}" alt="Logo"
                            class="align-text-center rounded-circle w-50">
                    </div>
                    <h4 class="fw-bold">Đăng nhập</h4>
                </div>
                <form method="POST" action="{{ route('login-Guest') }}">
                    @csrf
                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="form2Example1" class="form-control" name="username"/>
                        <label class="form-label" for="form2Example1">Tải khoản hoặc email</label>
                    </div>
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control" name="password" autocomplete="off"/>
                        <label class="form-label" for="form2Example2">Mật khẩu</label>
                    </div>
                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col">
                            <!-- Simple link -->
                            <a href="#!">Quên mật khẩu ?</a>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Đăng nhập</button>
                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Chưa có tài khoản? <a href="{{ url('/guest/register') }}">Đăng ký tài khoản mới</a></p>
                    </div>
                </form>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>
@endsection
