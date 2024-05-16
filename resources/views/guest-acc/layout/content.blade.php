<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Info -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('Image\Logo\logo.png') }}" type="image/x-icon">

    <!-- Boostrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap-tool\css\bootstrap.min.css') }}">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    {{-- Header --}}
    <header>
        @include('guest-acc.layout.header')
    </header>
    {{-- End Header --}}

    {{-- Main --}}
    <div id="container">
        @yield('guest-content')
    </div>
    {{-- End Main --}}

</body>

<script src="{{ asset('bootstrap-tool\js\bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

</html>
