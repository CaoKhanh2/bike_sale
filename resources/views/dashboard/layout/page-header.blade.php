<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>@yield('pg-card-title')</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/dashboard') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item @yield('act2')" aria-current="page">
                        @yield('pg-hd-2')
                    </li>
                    <li class="breadcrumb-item @yield('act3')" aria-current="page">
                        @yield('pg-hd-3')
                    </li>
                    @if ($__env->yieldContent('st4') == "true")
                        <li class="breadcrumb-item @yield('act4')" aria-current="page">
                            @yield('pg-hd-4')
                        </li>
                    @endif
                    @if ($__env->yieldContent('st5') == "true")
                        <li class="breadcrumb-item @yield('act5')" aria-current="page">
                            @yield('pg-hd-5')
                        </li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
</div>
