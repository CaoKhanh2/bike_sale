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
    <link href="{{ url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap') }}"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_src/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_src/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_src/src/plugins/jquery-steps/jquery.steps.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_src/vendors/styles/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_src/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_src/src/plugins/switchery/switchery.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_src/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_src/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css') }}" />

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

    <!-- Link icon fontawesome -->
    <script src="https://kit.fontawesome.com/09dc0ea4f4.js" crossorigin="anonymous"></script>
</head>
