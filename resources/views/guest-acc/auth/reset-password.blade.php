@extends('guest-acc.layout.content')

@section('guest-content')
    <div class="container my-5">
        <div class="row mt-5">
            <div class="col-4">
            </div>
            <div class="col-4 mt-5">
                <div class="row my-3">
                    <a href="{{ route('indexWeb') }}">
                        <div class="row my-3 d-flex justify-content-center">
                            <img src="{{ asset('Image\logo\logo.png') }}" alt="Logo"
                                class="align-text-center rounded-circle w-50">
                        </div>
                    </a>
                    <h4 class="fw-bold">Đặt lại mật khẩu</h4>
                </div>
                <form method="POST">
                    @csrf
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form2Example1" class="form-control" name="password" />
                        <label class="form-label" for="form2Example1">Mật khẩu</label>
                    </div>
                    @error('password')
                        <small class="help-block"><p class="text-danger">{{ $message }}</p></small>
                    @enderror
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control" name="confirm-password" autocomplete="off" />
                        <label class="form-label" for="form2Example2">Nhập lại mật khẩu</label>
                    </div>
                    @error('confirm-password')
                        <small class="help-block"><p class="text-danger">{{ $message }}</p></small>
                    @enderror
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Đặt lại mật khẩu của bạn</button>
                </form>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>
@endsection
