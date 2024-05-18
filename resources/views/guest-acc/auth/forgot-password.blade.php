@extends('guest-acc.layout.content')

@section('guest-content')
    <div class="container my-5">
        <div class="row justify-content-center align-items-center">
            <div class="card text-center" style="width: 450px;">
                <div class="card-header h5 text-white bg-primary">Đặt lại mật khẩu</div>
                <div class="card-body px-5">
                    <p class="card-text py-2">
                        Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một email kèm theo hướng dẫn để đặt lại mật
                        khẩu của bạn.
                    </p>
                    <form action="{{ route('quen-matkhau-Guest') }}" method="POST">
                        @csrf
                        <div data-mdb-input-init class="form-outline">
                            <input type="email" name="email" id="emailInput" class="form-control my-3" required />
                            <label class="form-label" for="emailInput">Địa chỉ email</label>
                        </div>
                        @if (Session::has('cross-quen-matkhau-Guest'))
                            <span class="form-text">
                                <div class="row align-items-start justify-content-start my-3">
                                    <div class="col-10">
                                        <img src="{{ asset('Image/Icon/exclamation-triangle-red.svg') }}"
                                            class="d-inline my-2" id="icon-svg" width="20" height="20" />
                                        <p id="" class="d-inline mx-2">
                                            {{ Session::get('cross-quen-matkhau-Guest') }}</p>
                                    </div>
                                </div>
                            </span>
                        @endif
                        @if (Session::has('success-quen-matkhau-Guest'))
                            <span class="form-text">
                                <div class="row align-items-start justify-content-start">
                                        <p id="" class="d-inline text-success mx-2">{{ Session::get('success-quen-matkhau-Guest') }}</p>
                                </div>
                            </span>
                        @endif
                        <input href="#" type="submit" value="Đặt lại mật khẩu" class="btn btn-primary w-100">
                    </form>
                    <div class="d-flex justify-content-between mt-4">
                        <a class="" href="{{ route('dangnhap-Guest') }}">Đăng nhập</a>
                        <a class="" href="{{ route('dangky-Guest') }}">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
