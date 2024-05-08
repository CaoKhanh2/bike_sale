<div class="right-sidebar">
    <div class="sidebar-title">
        <h3 class="weight-600 font-16 text-blue">
            Layout Settings
            <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
        </h3>
        <div class="close-sidebar" data-toggle="right-sidebar-close">
            <i class="icon-copy ion-close-round"></i>
        </div>
    </div>
    <div class="right-sidebar-body customscroll">
        <div class="right-sidebar-body-content">
            <h4 class="weight-600 font-18 pb-10">Header Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
            <div class="sidebar-radio-group pb-10 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-1" checked="" />
                    <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-2" />
                    <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-3" />
                    <label class="custom-control-label" for="sidebaricon-3"><i
                            class="fa fa-angle-double-right"></i></label>
                </div>
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
            <div class="sidebar-radio-group pb-30 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-1" checked="" />
                    <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-2" />
                    <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o"
                            aria-hidden="true"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-3" />
                    <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-4" checked="" />
                    <label class="custom-control-label" for="sidebariconlist-4"><i
                            class="icon-copy dw dw-next-2"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-5" />
                    <label class="custom-control-label" for="sidebariconlist-5"><i
                            class="dw dw-fast-forward-1"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-6" />
                    <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                </div>
            </div>

            <div class="reset-options pt-30 text-center">
                <button class="btn btn-danger" id="reset-settings">
                    Reset Settings
                </button>
            </div>
        </div>
    </div>
</div>

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="">
            <img src="{{ asset('Image\Logo\logo.png') }}" alt=""  width="80" height="70"
                class="rounded-circle dark-logo" />
            <img src="{{ asset('Image\Logo\logo.png') }}" alt=""  width="80" height="70"
                class="rounded-circle light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ url('/dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon"><i class="fa-solid fa-house"></i></span><span class="mtext">Trang
                            chủ</span>
                    </a>
                </li>
                @if (Auth::User()->phanquyen == 'Quản trị viên')
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-window-sidebar"></span><span class="mtext">Hệ thống</span>
                    </a>
                    <ul class="submenu">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle"><span class="micon"><i
                                        class="fa-solid fa-user-tie"></i></span><span class="mtext">Quản lý tài
                                    khoản</span></a>
                            <ul class="submenu child">
                                <li><a href="{{ url('#') }}">Tài khoản khách hàng</a>
                                </li>
                                <li><a href="{{ url('/dashboard/sys/management-acc/employee_account') }}">Tài khoản nhân viên</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/dashboard/sys/user-authorization') }}">Quản lý phân quyền người dùng</a></li>
                        <li><a href="{{ url('#') }}">Sao lưu dữ liệu</a></li>
                        <li><a href="{{ url('#') }}">Phục hồi dữ liệu</a></li>
                    </ul>
                </li>
                @endif
                {{-- @if (Auth::User()->phanquyen == 'Nhân viên' || Auth::User()->phanquyen == 'Quản lý') --}}
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon"><i class="fa-solid fa-layer-group"></i></span><span
                                class="mtext">Danh
                                mục</span>
                        </a>
                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle"><span class="micon"><i
                                            class="fa-solid fa-motorcycle"></i></span><span class="mtext">Quản lý
                                        danh mục xe</span></a>
                                <ul class="submenu child">
                                    <li><a href="{{ url('/dashboard/category/vehicle/automaker-info') }}">Thông tin
                                            hãng xe</a>
                                    </li>
                                    <li><a href="{{ url('/dashboard/category/vehicle/vehicle-line_infor') }}">Thông tin
                                            dòng xe</a></li>
                                    <li><a href="{{ url('/dashboard/category/vehicle/vehicle-infor') }}">Thông tin
                                            xe</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('dashboard/category/customer/customer-info') }}">Quản lý khách
                                    hàng</a></li>
                            <li><a href="{{ url('dashboard/category/shipping/ship-infor') }}">Quản lý vận chuyển
                                    hàng</a></li>
                            <li><a href="{{ url('dashboard/category/sales-agent/staff-infor') }}">Quản lý nhân viên
                                    bán hàng</a></li>
                        </ul>
                    </li>
                {{-- @endif --}}
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon"><i class="fa-solid fa-sack-dollar"></i></span><span class="mtext">Giao
                            dịch</span>
                    </a>
                    <ul class="submenu">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon"></span><span class="mtext">Danh sách</span>
                            </a>
                            <ul class="submenu child">
                                <li><a href="{{ url('/dashboard/transaction/purchasing-manage') }}">Đăng ký bán</a>
                                </li>
                                <li><a href="{{ url('/dashboard/transaction/selling') }}">Quản lý bán</a></li>
                            </ul>
                        </li>
                        <li><a href="form-pickers.html">Quản lý thanh toán</a></li>
                        <li><a href="image-cropper.html">Quản lý rủi ro</a></li>
                        <li><a href="image-dropzone.html">Quản lý khuyến mãi</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon"><i class="fa-solid fa-file-invoice"></i></span><span class="mtext">Báo
                            cáo thống
                            kê</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ url('/dashboard/report/sales-situation') }}">Báo cáo tình hình bán hàng</a></li>
                        <li><a href="{{ url('#') }}">Báo cáo tình hình thu mua</a></li>
                        <li><a href="{{ url('/dashboard/report/inventory') }}">Báo cáo tồn kho</a></li>
                        <li><a href="forgot-password.html">Báo cáo rủi ro</a></li>
                        <li><a href="reset-password.html">Báo cáo thực hiện khuyến mãi</a></li>
                        <li><a href="reset-password.html">Báo cáo thống kê truy cập </a></li>
                    </ul>
                </li>

                {{-- <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Extra</div>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-pdf"></span><span class="mtext">Documentation</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="introduction.html">Introduction</a></li>
                        <li><a href="getting-started.html">Getting Started</a></li>
                        <li><a href="color-settings.html">Color Settings</a></li>
                        <li>
                            <a href="third-party-plugins.html">Third Party Plugins</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="https://dropways.github.io/deskapp-free-single-page-website-template/" target="_blank"
                        class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-layout-text-window-reverse"></span>
                        <span class="mtext">Landing Page
                            <img src="dashboard_src/vendors/images/coming-soon.png" alt=""
                                width="25" /></span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
