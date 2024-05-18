@extends('guest-acc.layout.content')

@section('guest-content')
    <div class="container">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-lg-8">
                <div class="row my-3 justify-content-center">
                    <div class="col">
                        <img src="{{ asset('Image\Logo\logo.png') }}" alt="Logo" class="align-text-center rounded-circle"
                            width="124" height="124">
                    </div>
                </div>
                <h4 class="fw-bold mb-5">Đăng ký tài khoản</h4>
                <form action="{{ route('thuchien-dangky-Guest') }}" method="POST" id="form-register">
                    @csrf
                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="hovaten" class="form-control" name="hovaten" />
                        <label class="form-label" for="hovaten">Họ và tên</label>
                    </div>
                    <!-- 2 column grid layout with text inputs -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <input type="date" id="ngaysinh" class="form-control" name="ngaysinh" required/>
                                <label class="form-label" for="ngaysinh">Ngày sinh</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div data-mdb-input-init class="form-outline">
                                <input type="number" id="sodienthoai" class="form-control" name="sodienthoai"
                                oninput="limitLength(this, 11)" required/>
                                <label class="form-label" for="sodienthoai">Số điện thoại</label>
                            </div>
                        </div>
                    </div>
                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="email" class="form-control" name="email" required/>
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <div class="col-auto mb-4">
                        @if (Session::has('cross-dangky-Guest'))
                            <span id="emailHelpInline" class="form-text">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="{{ asset('Image/Icon/exclamation-triangle-red.svg') }}"
                                            class="img-fluid my-2" id="icon-svg4" width="20px" height="20px" />
                                        <p id="" class="d-inline text-danger mx-2">Email đã được sử dụng.</p>
                                    </div>
                                </div>
                            </span>
                        @endif
                    </div>
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="registerPassword" class="form-control" name="password" required />
                        <label class="form-label" for="registerPassword">Mật khẩu</label>
                    </div>
                    <div class="col-auto mb-4">
                        <span id="passwordHelpInline" class="form-text" hidden>
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset('Image/Icon/exclamation-triangle.svg') }}" class="img-fluid my-2"
                                        id="icon-svg1" width="20px" height="20px" />
                                    <p id="lengthChar" class="d-inline mx-2">Giới hạn từ 8-32 ký tự.</p>
                                </div>
                                <div class="col-6">
                                    <img src="{{ asset('Image/Icon/exclamation-triangle.svg') }}" class="img-fluid my-2"
                                        id="icon-svg2" width="20px" height="20px" />
                                    <p id="symbolChar" class="d-inline mx-2">Tối thiểu 1 ký tự đặc biệt.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset('Image/Icon/exclamation-triangle.svg') }}" class="img-fluid my-2"
                                        id="icon-svg3" width="20px" height="20px" />
                                    <p id="uppercaseChar" class="d-inline mx-2">Tối thiểu 1 ký tự in hoa.</p>
                                </div>
                            </div>
                        </span>
                    </div>
                    <!-- Submit utton -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function limitLength(element, maxLength) {
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength);
            }
        }

        // Hiện thông báo về email
        var emailInput = document.getElementById('email');

        emailInput.addEventListener('focusin', function() {
            emailHelpInline.hidden = true;
        });

        // Kiểm tra mật khẩu có hợp lệ hay không
        var passwordInput = document.getElementById('registerPassword');
        var passwordHelpInline = document.getElementById('passwordHelpInline');

        var lengthChar = document.getElementById('lengthChar');
        var symbolChar = document.getElementById('symbolChar');
        var upperChar = document.getElementById('uppercaseChar');

        var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        var uppercaseCharacters = /[a-zA-Z]/;

        var icon1 = document.getElementById('icon-svg1');
        var icon2 = document.getElementById('icon-svg2');
        var icon3 = document.getElementById('icon-svg3');

        // Kiểm tra chuỗi nhập vào một input, ngay khi đang nhập
        passwordInput.addEventListener('input', function() {
            passwordHelpInline.hidden = false; // Hiển thị passwordHelpInline khi con trỏ nằm trong trường input

            // Kiểm tra độ dài của mật khẩu được nhập vào
            if ((passwordInput.value.length < 8 || passwordInput.value.length > 32)) {
                lengthChar.classList.add("text-danger");
                icon1.src = "{{ asset('Image/Icon/exclamation-triangle-red.svg') }}";
            } else {
                lengthChar.classList.remove("text-danger"); // Xóa lớp 'text-danger' nếu có
                lengthChar.classList.add("text-success");
                icon1.src = "{{ asset('Image/Icon/exclamation-triangle-green.svg') }}";
            }

            // Kiểm tra có ít nhất 1 ký tự đặc biệt
            if (specialCharacters.test(passwordInput.value) == false) {
                symbolChar.classList.add("text-danger");
                icon2.src = "{{ asset('Image/Icon/exclamation-triangle-red.svg') }}";
            } else {
                symbolChar.classList.remove("text-danger"); // Xóa lớp 'text-danger' nếu có
                symbolChar.classList.add("text-success");
                icon2.src = "{{ asset('Image/Icon/exclamation-triangle-green.svg') }}";
            }

            // Kiểm tra có ít nhất 1 ký tự viết hoa
            if (uppercaseCharacters.test(passwordInput.value) == false) {
                upperChar.classList.add("text-danger");
                icon3.src = "{{ asset('Image/Icon/exclamation-triangle-red.svg') }}";
            } else {
                upperChar.classList.remove("text-danger"); // Xóa lớp 'text-danger' nếu có
                upperChar.classList.add("text-success");
                icon3.src = "{{ asset('Image/Icon/exclamation-triangle-green.svg') }}";
            }

            // Kiểm tra toàn bộ các điều kiện trên để ẩn cảnh báo
            if ((passwordInput.value.length > 8 && passwordInput.value.length < 32) && specialCharacters.test(
                    passwordInput.value) && uppercaseCharacters.test(passwordInput.value)) {
                setTimeout(function() {
                    passwordHelpInline.hidden = true;
                }, 500);
            }
        });

        // Kiểm tra dữ liệu trước khi gửi form
        document.getElementById('form-register').addEventListener('submit', function(event) {
            var passwordInput = document.getElementById('registerPassword'); // Lấy trường mật khẩu
            var passwordHelpInline = document.getElementById('passwordHelpInline');

            var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            var uppercaseCharacters = /[a-zA-Z]/;

            var icon1 = document.getElementById('icon-svg1');
            var icon2 = document.getElementById('icon-svg2');
            var icon3 = document.getElementById('icon-svg3');

            var isValid = true; // Khởi tạo biến isValid

            if ((passwordInput.value.length < 8 || passwordInput.value.length > 32)) {
                isValid = false;
            }
            if (specialCharacters.test(passwordInput.value) == false) {

                isValid = false;
            }
            if (uppercaseCharacters.test(passwordInput.value) == false) {

                isValid = false;
            }
            if (!isValid) {
                event.preventDefault(); // Ngăn sự kiện submit
            }
        });
    </script>
@endsection
