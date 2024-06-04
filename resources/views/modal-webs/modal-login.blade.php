<!-- Modal -->
<!-- Modal -->

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row my-3 justify-content-center">
                <div class="row my-3 justify-content-center">
                    {{-- <a href="{{ route('indexWeb') }}">
                        <div class="row my-3 justify-content-center">
                            <img src="{{ asset('Image\logo\logo.png') }}" alt="Logo" class="align-text-center rounded-circle w-50">
                        <div class="row my-3 justify-content-center">
                            <img src="{{ asset('Image\logo\logo.png') }}" alt="Logo" class="align-text-center rounded-circle w-50">
                        </div>
                    </a> --}}
                    <h4 class="fw-bold text-center">Đăng nhập</h4>
                </div>
                @if (Session::has('cross-dangnhap-Guest'))
                    <div class="alert alert-danger">
                        {{ Session::get('cross-dangnhap-Guest') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('thuchien-dangnhap-Guest') }}">
                    @csrf
                    <!-- Email input -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="form2Example1">Tài khoản hoặc email</label>
                        <input type="text" id="form2Example1" class="form-control" name="username" />
                    </div>
                    <!-- Password input -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="form2Example2">Mật khẩu</label>
                        <input type="password" id="form2Example2" class="form-control" name="password"
                            autocomplete="off" />
                    </div>
                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col">
                            <!-- Simple link -->
                            <a href="{{ route('quen-matkhau-Guest') }}">Quên mật khẩu?</a>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <div class="d-grid gap-2 col-6 mx-auto my-4">
                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto my-4">
                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                    </div>
                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Chưa có tài khoản? <a href="{{ route('thuchien-dangky-Guest') }}">Đăng ký tài khoản mới</a>
                        </p>
                    </div>
                </form>
                @if (Session::has('success-dangky-Guest'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success-dangky-Guest') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('success-xacnhanmail-Guest'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success-xacnhanmail-Guest') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('success-datlai-matkhau-Guest'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success-datlai-matkhau-Guest') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
