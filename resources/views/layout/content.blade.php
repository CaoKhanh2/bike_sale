<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('Image\logo\logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('bootstrap-tool\css\bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap-tool\js\bootstrap.bundle.min.js') }}"></script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    <!-- Range Slider with Two Values -->
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" /> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script> --}}
</head>

<body>

    {{-- Header --}}
    <header>
        @include('layout.header')
    </header>
    {{-- End header --}}


    {{-- Content --}}
    <div id="container">
        @yield('main')
    </div>
    {{-- End content --}}


    {{-- Footer --}}
    <footer>
        @include('layout.footer')
    </footer>
    {{-- End footer --}}

</body>


</html>
