<nav class="navbar navbar-expand-xl bg-body-tertiary ">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('Image\Icon\racing.png') }}" alt="Logo" width="60" height="48"
                class="d-inline-block align-text-center">
            XeToT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <img src="{{ asset('Image\Icon\home.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <img src="{{ asset('Image\Icon\motorbike.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        Mua xe máy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-disabled="true" href="">
                        <img src="{{ asset('Image\Icon\electric-scooter.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        Mua xe đạp điện
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-disabled="true" href="">
                        <img src="{{ asset('Image\Icon\notification.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        Thông báo
                    </a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                    <a class="nav-link active" aria-disabled="true" href="">
                        <img src="{{ asset('Image\Icon\trade.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        Đăng ký bán xe
                    </a>
            </li>
            <li class="nav-item">
                    <a class="nav-link active" aria-disabled="true" href="">
                        <img src="{{ asset('Image\Icon\user.png') }}" width="30" height="24"
                            class="img-fluid mx-auto d-block">
                        Tài khoản
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
