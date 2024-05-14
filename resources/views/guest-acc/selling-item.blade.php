@extends('layout.content')
@section('title', 'Đăng ký bán xe')
@section('pg-hd-2', 'Đăng ký bán xe') @section('act2', 'text-dark')

<link rel="stylesheet" href="{{ asset('dashboard_src\src\plugins\dropzone\src\dropzone.css') }}" type="text/css" />

@section('main')
    <section style="background-color: #eee;">
        <div class="container">
            {{-- breadcrum --}}
            <div class="row justify-content-around">
                <div class="col-xl">
                    @include('layout.header-breadcrum')
                </div>
            </div>
            {{-- endbreadcrum --}}

            {{-- Content --}}
            <div class="row justify-content-center">
                <div class="col-xl">
                    @include('guest-acc.posting-item')
                </div>
            </div>

            @include('modal-webs.inform-posting-item')

        </div>
        {{-- End Content --}}
        <script src="{{ asset('dashboard_src/src/plugins/dropzone/src/dropzone.js') }}"></script>

        <script>
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone('div#mydropzone', { // The camelized version of the ID of the form element
                url: "{{ route('themdldangkythumua') }}",
                dictDefaultMessage: "Thêm ảnh cho xe của bạn",
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 10,
                maxFiles: 10,
                maxFilesize: 5,
                acceptedFiles: '.jpeg,.jpg,.png,',
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function() {
                    // Makes sure that 'this' is understood inside the functions below.
                    var myDropzone = this;
                    // for Dropzone to process the queue (instead of default form behavior):
                    document.getElementById("formthumua").addEventListener("submit", function(e) {
                        // $("form[name='formthumua']").submit(function(e) {
                        // Make sure that the form isn't actually being sent.
                        e.preventDefault();
                        e.stopPropagation();
                        // var formData = $('#formthumua').serialize();
                        myDropzone.processQueue();
                    });
                    this.on("sending", function(file, xhr, formData) {
                        $('#formthumua').find('input, select').each(function() {
                            if ($(this).is('input')) {
                                formData.append($(this).attr('name'), $(this).val());
                            } else if ($(this).is('select')) {
                                formData.append($(this).attr('name'), $(this).find(
                                    'option:selected').val());
                            }
                        });
                    });
                    // this.on("sendingmultiple", function(file, xhr, formData) {
                    //     for (var i = 0; i <= file.length; i++) {
                    //         formData.append("image[]", file[i])
                    //         // Gets triggered when the form is actually being sent.
                    //         // Hide the success button or the complete form.
                    //     }
                    // });
                    this.on("successmultiple", function(files, response) {
                        myDropzone.removeAllFiles();
                        document.getElementById("formthumua").reset();
                        window.location.href = '/selling-item';
                    });
                    this.on("errormultiple", function(files, response) {
                        console.log("Files are not being sent");

                    });

                }
            });
        </script>
    </section>
@endsection
