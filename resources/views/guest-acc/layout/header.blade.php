<section style="background-color:#4a90e2">

    <nav class="container-fluid navbar navbar-expand-xl border-bottom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('Image\Logo\logo.png') }}" alt="Logo" width="80" height="70"
                    class="d-inline-block align-text-center rounded-circle">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                            <img src="{{ asset('Image\Icon\home.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Trang chủ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/sub-index/xemay') }}">
                            <img src="{{ asset('Image\Icon\motorbike.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Mua xe máy</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-disabled="true" href="/sub-index/xedapdien">
                            <img src="{{ asset('Image\Icon\electric-scooter.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Mua xe đạp điện</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-disabled="true" href="">
                            <img src="{{ asset('Image\Icon\notification.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Thông báo</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-disabled="true" href="{{ url('/selling-item') }}">
                            <img src="{{ asset('Image\Icon\icons8-sell-48.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Đăng ký bán xe</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-disabled="true" href="{{ url('/cart-index') }}">
                            <img src="{{ asset('Image\Icon\icons8-cart-94.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Giỏ hàng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-disabled="true" href="{{ url('/guest/login') }}">
                            <img src="{{ asset('Image\Icon\user.png') }}" width="30" height="24"
                                class="img-fluid mx-auto d-block">
                            <span class="text-center mx-auto d-block">Tài khoản</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
