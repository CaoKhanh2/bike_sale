<section style="background-color:#4a90e2">
    <div class="container">
        <nav class="navbar navbar-expand-xl border-bottom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('Image\Logo\logo.png') }}" alt="Logo" width="80" height="70"
                        class="d-inline-block align-text-center rounded-circle">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                        @if (Auth::guard('guest')->check())
                            {{-- <li class="nav-item">
                                <a class="nav-link active" aria-disabled="true" href="">
                                    <img src="{{ asset('Image\Icon\notification.png') }}" width="30" height="24"
                                        class="img-fluid mx-auto d-block">
                                    <span class="text-center mx-auto d-block">Thông báo</span>
                                </a>
                            </li> --}}
                        @endif
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
                        @if (Auth::guard('guest')->check())
                            <li class="nav-item">
                                <a class="nav-link active" aria-disabled="true" href="{{ url('/cart-index') }}">
                                    <img src="{{ asset('Image\Icon\icons8-cart-94.png') }}" width="30"
                                        height="24" class="img-fluid mx-auto d-block">
                                    <span class="text-center mx-auto d-block">Giỏ hàng</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::guard('guest')->check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('Image\Icon\user.png') }}" width="30" height="24"
                                        class="img-fluid mx-auto d-block">
                                    <span class="text-center mx-auto d-block">Tài khoản</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('thongtin-Guest') }}">Thông tin tài khoản</a></li>
                                    <li><a class="dropdown-item" href="">Thông báo</a></li>
                                    <li><a class="dropdown-item" href="">Lịch sử đơn hàng</a></li>
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
        <div class="container-fluid py-2 bg-blue">
            <div class="row justify-content-center">
                <div class="col-md-9 col-xs-9">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-3 py-3 d-flex align-items-center">
                                    <div class="fs-3 text-warning mx-3">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 py-3 text-white">Tư vấn hỗ trợ<br>
                                    <strong class="text-warning">0973951289</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-3 py-3 d-flex align-items-center">
                                    <div class="fs-3 text-warning mx-3">
                                        <i class="fa-solid fa-truck"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 py-3 text-white">Miễn phí vận chuyển<br>
                                    <strong class="text-warning">Bán kính 10Km</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-md-3 py-3 d-flex align-items-center">
                                    <div class="fs-3 text-warning mx-4">
                                        <i class="fa-regular fa-clock"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 py-3 text-white">Giờ làm việc<br>
                                    <strong class="text-warning">T2-T7 giờ hành chính</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
