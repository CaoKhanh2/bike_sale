<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('bootstrap-tool\css\bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('Image\Icon\racing.png') }}" type="image/x-icon">

    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Range Slider with Two Values -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    <!-- DropZone -->
    <link rel="stylesheet" href="{{ asset('dashboard_src\src\plugins\dropzone\src\dropzone.css') }}"/>

  

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

<script src="{{ asset('bootstrap-tool\js\bootstrap.bundle.min.js') }}"></script>

</html>
