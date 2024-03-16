<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>@yield('title_ds')</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard_src/vendors/images/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('dashboard_src/vendors/images/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('dashboard_src/vendors/images/favicon-16x16.png') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_src/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href=" {{ asset('dashboard_src/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_src/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href=" {{ asset('dashboard_src/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_src/vendors/styles/style.css') }}" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src=" {{ url('https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85') }} "></script>
    <script async
        src=" {{ url('https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258') }} "
        crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "{{ url('https://www.googletagmanager.com/gtm.js?id=') }}" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->

</head>

<body>

    {{-- Header --}}
    @include('dashboard.layout.header')
    {{-- End Header --}}

    {{-- SideBar --}}
    @include('dashboard.layout.sidebar')
    {{-- End SideBar --}}

    {{-- Main --}}
    <div id="content">
        @yield('main')
    </div>
    {{-- End Main --}}


    {{-- Footer --}}
    @include('dashboard.layout.footer')
    {{-- End Footer --}}

    <!-- js -->
    <script src="{{ asset('dashboard_src/vendors/scripts/core.js') }} "></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/dashboard.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('dashboard_src/vendors/scripts/datatable-setting.js') }}"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

</body>

</html>
