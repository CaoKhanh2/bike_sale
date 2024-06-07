<nav class="container-fluid navbar navbar-expand-xl" style="background-color:#4a90e2">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('Image\logo\logo.png') }}" alt="Logo" width="80" height="70"
                class="d-inline-block align-text-center rounded-circle">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('indexWeb') }}">
                        <img src="{{ asset('Image\Icon\home.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        <span class="text-center mx-auto d-block">Trang chủ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('hienthi-thongtinxemay-Guest') }}">
                        <img src="{{ asset('Image\Icon\motorbike.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        <span class="text-center mx-auto d-block">Mua xe máy</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-disabled="true"
                        href="{{ route('hienthi-thongtinxedapdien-Guest') }}">
                        <img src="{{ asset('Image\Icon\electric-scooter.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        <span class="text-center mx-auto d-block">Mua xe đạp điện</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-disabled="true" href="{{ route('gui-form-thumua-Guest') }}">
                        <img src="{{ asset('Image\Icon\icons8-sell-48.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        <span class="text-center mx-auto d-block">Đăng ký bán xe</span>
                    </a>
                </li>
                @if (Auth::guard('guest')->check())
                    <li class="nav-item position-relative">
                        <a class="nav-link active" aria-disabled="true" href="{{ url('/cart-index') }}">
                            <img src="{{ asset('Image\Icon\icons8-cart-94.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block"> Giỏ hàng
                                <span id="cart-count"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-success"></span>
                            </span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('guest')->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('Image\Icon\user.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Tài khoản</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('thongtin-Guest') }}">Thông tin tài khoản</a>
                            </li>
                            <li><a class="dropdown-item" href="">Thông báo</a></li>
                            <li><a class="dropdown-item" href="{{ route('khach-donhang') }}">Lịch sử đơn hàng</a></li>
                            <li>
                                <form method="POST" action="{{ route('thuchien-dangxuat-Guest') }}" class="mb-0">
                                    @csrf
                                    <input class="dropdown-item" type="submit" value="Đăng xuất">
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link active" aria-disabled="true" href="{{ route('dangnhap-Guest') }}">
                            <img src="{{ asset('Image\Icon\user.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Đăng nhập</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@if (Auth::guard('guest')->check())
<script>
    // Hàm để lấy số lượng sản phẩm từ localStorage và hiển thị
    function loadCartCount() {
        let cartCount = localStorage.getItem('cartCount');
        let cartCountElement = document.getElementById('cart-count');

        if (cartCountElement) {
            if (cartCount) {
                cartCountElement.innerText = cartCount;
            } else {
                cartCountElement.innerText = 0;
            }
        } else {

        }
    }

    // Hàm để tải số lượng sản phẩm từ server và hiển thị
    function loadCartFromServer() {
        $.ajax({
            method: "GET",
            url: '/load-cart-data',
            success: function(response) {
                console.log(response.count);
                localStorage.setItem('cartCount', response.count);
                document.getElementById('cart-count').innerText = response.count;
            }
        });
    }

    // Gọi hàm loadCartCount khi trang được tải
    window.onload = function() {
        loadCartCount();
        loadCartFromServer();
    };
</script>
@endif

