<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Info -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('bootstrap-tool\css\bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('Image\Icon\racing.png') }}" type="image/x-icon">
</head>

{{-- Header --}}
    <header>
        @include('layout.header')
    </header>
{{-- End header --}}

   <div class="container">
   {{-- SideBar --}}
    @include('user.user_sidebar')
    {{-- End SideBar --}}

   </div>
  

{{-- footer --}}
    <footer>
        @include('layout.footer')
    </footer>
    {{-- End footer --}}

    