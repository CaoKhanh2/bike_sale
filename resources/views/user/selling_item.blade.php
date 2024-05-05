@extends('layout.content')
@section('title', 'Đăng ký bán xe')
@section('pg-hd-2', 'Đăng ký bán xe')
{{-- <link rel="stylesheet" href="{{ asset('home_src\css\main.css') }}"> --}}
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<meta name="_token" content="{{ csrf_token()}}">
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

    </div>
    {{-- End Content --}}
    {{-- <script src="{{ asset('dashboard_src/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/layout-settings.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard_src/src/plugins/dropzone/src/dropzone.js') }}"></script> --}}
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.mydropzone = { // The camelized version of the ID of the form element

            url: "{{ url('/sending_bike') }}",
            paraName: "anh",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            maxFilesize: 3,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {
                var myDropzone = new Dropzone("div#mydropzone"); // Makes sure that 'this' is understood inside the functions below.

                // for Dropzone to process the queue (instead of default form behavior):
                document.getElementById("formthumua").addEventListener("submit", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });
                this.on("errormultiple", function(files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });

            }
        }
    </script>
@endsection
