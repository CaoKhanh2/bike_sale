<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        @if (Auth::check())
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ asset('\Image\415570954_906272230687061_5629026059600303103_n1.png') }}"
                                alt="" />
                        </span>
                        <span class="user-name">
                            <span class="user-name">{{ Auth::user()->tentaikhoan }}</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <li><a class="dropdown-item" href="{{ route('thongtin-taikhoan') }}">Thông tin tài khoản</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item"type="submit">Đăng xuất</button>
                            </form>
                        </li>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
