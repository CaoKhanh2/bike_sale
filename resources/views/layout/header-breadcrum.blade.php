{{-- <div class="page-header">
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
                        <a class="link-underline link-underline-opacity-0"
                            href="{{ url('/') }}">@yield('pg-hd-2')</a>
                    </li>
                    @if ($__env->yieldContent('st3') == 'true')
                        <li class="breadcrumb-item @yield('act3')" aria-current="page">
                            @yield('pg-hd-3')
                        </li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
</div> --}}

<div class="page-header">
    <div class="row">
        <div class="title">
            <h4>@yield('pg-hd-1')</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <nav class="bg-body-tertiary rounded-3 p-3 mb-4" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb fs-6 mb-0">
                    <li class="breadcrumb-item">
                        <a class="@yield('act1') text-decoration-none" href="{{ route('indexWeb') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="@yield('act2') text-decoration-none" href="@yield('url2')">@yield('pg-hd-2')</a>
                    </li>
                    @if ($__env->yieldContent('st3') == 'true')
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="@yield('url3') text-decoration-none" class="@yield('act3')">
                                @yield('pg-hd-3')
                            </a>
                        </li>
                    @endif
                    @if ($__env->yieldContent('st4') == 'true')
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="@yield('url4') text-decoration-none" class="@yield('act4')">
                                @yield('pg-hd-4')
                            </a>
                        </li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
</div>

