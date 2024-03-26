@extends('layout.content')
@section('title', 'Đăng ký bán xe')
<link rel="stylesheet" href="{{ asset('home_src\css\main.css') }}">
@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Info -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('bootstrap-tool\css\bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_src\src\plugins\dropzone\src\dropzone.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_src/vendors/styles/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('Image\Icon\racing.png') }}" type="image/x-icon">
</head>

   {{-- Content --}}
   <div class="row justify-content-md-center mt-4">
            <div class="col-xl">
                @include('user.posting_item')
            </div>
    </div>
   {{-- End Content --}}
   <script src="{{ asset('dashboard_src/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('dashboard_src/vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset('dashboard_src/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('dashboard_src/vendors/scripts/layout-settings.js')}}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/dropzone/src/dropzone.js')}}"></script>
    <script>
			Dropzone.autoDiscover = false;
			$(".dropzone").dropzone({
				addRemoveLinks: true,
				removedfile: function (file) {
					var name = file.name;
					var _ref;
					return (_ref = file.previewElement) != null
						? _ref.parentNode.removeChild(file.previewElement)
						: void 0;
				},
			});
	</script>
@endsection
