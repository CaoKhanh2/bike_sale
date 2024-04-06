<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>@yield('pg-hd-1')</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/dashboard') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        @yield('pg-hd-2')
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @yield('pg-hd-3')
                    </li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">
                        @yield('pg-hd-4')
                    </li> --}}
                </ol>
            </nav>
        </div>
    </div>
</div>
