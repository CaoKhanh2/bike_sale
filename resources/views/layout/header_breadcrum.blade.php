<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>@yield('pg-hd-1')</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb fs-5">
                    <li class="breadcrumb-item">
                        <a class="link-underline link-underline-opacity-0" href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item activ" aria-current="page">
                        @yield('pg-hd-2')
                    </li>
                    @if ($__env->yieldContent('st3') == "true")
                        <li class="breadcrumb-item @yield('act3')" aria-current="page">
                            @yield('pg-hd-3')
                        </li>
                    @endif
                </ol>
            </nav>
        </div> 
    </div>
</div>