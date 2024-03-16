<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('bootstrap-tool\css\bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="shortcut icon" href="{{ asset('Image\Icon\racing.png') }}" type="image/x-icon">
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
