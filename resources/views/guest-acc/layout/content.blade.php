<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Info -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('Image\logo\logo.png') }}" type="image/x-icon">

    <style>
        #cart-count {
            position: relative;
            top: -62px; /* Điều chỉnh giá trị top để định vị đúng */
            right: -22px; /* Điều chỉnh giá trị right để định vị đúng */
            display: inline-block; /* Đảm bảo phần tử được hiển thị inline */
        }
    </style>
    <!-- Boostrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap-tool\css\bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    @include('guest-acc.layout.header')

    {{-- Main --}}
    <div id="container">
        @yield('guest-content')
    </div>
    {{-- End Main --}}

</body>
    <script src="{{ asset('bootstrap-tool\js\bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
</html>
