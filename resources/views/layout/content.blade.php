<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('bootstrap-tool\css\bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('Image\Icon\racing.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

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
<script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Filter Functionality
        $('#filterInput').on('keyup', function() {
            var filter = $(this).val().toUpperCase();
            $('#filterList li').each(function() {
                var text = $(this).text().toUpperCase();
                if (text.indexOf(filter) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#rangeSlider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 50000000,
            from: 0,
            to: 50000000,
            grid: true,
            // grid_num: 1000000,
            skin: "round",
            prettify_enabled: true,
            prettify_separator: ",",
            force_edges: true,
            onChange: function(data) {
                // Log changed values to console
                console.log("Min: " + data.from + ", Max: " + data.to);
            }
        });
    });
</script>

</html>
