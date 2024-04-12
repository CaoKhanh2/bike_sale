@extends('layout.content')
@section('title', 'Đăng ký bán xe')
@section('pg-hd-2', 'Đăng ký bán xe')
<link rel="stylesheet" href="{{ asset('home_src\css\main.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
@section('main')

       {{-- breadcrum --}}
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-xl">
                    @include('layout.header_breadcrum')
                </div>
            </div>
        </div>
    {{-- endbreadcrum --}}

    {{-- Content --}}
    <div class="row justify-content-center">
        <div class="col-xl">
            @include('user.posting_item')
        </div>
    </div>
    {{-- End Content --}}
    <script src="{{ asset('dashboard_src/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('dashboard_src/src/plugins/dropzone/src/dropzone.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(".dropzone").dropzone({
            addRemoveLinks: true,
            removedfile: function(file) {
                var name = file.name;
                var _ref;
                return (_ref = file.previewElement) != null ?
                    _ref.parentNode.removeChild(file.previewElement) :
                    void 0;
            },
        });
    </script>
@endsection
