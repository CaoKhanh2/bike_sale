@extends('layout.content')
@section('title', 'Đăng ký bán xe')
@section('pg-hd-2', 'Đăng ký bán xe') @section('act2', 'text-dark')

<link rel="stylesheet" href="{{ asset('dashboard_src\src\plugins\dropzone\src\dropzone.css') }}" type="text/css" />

@section('main')

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
                @include('guest-acc.purchasing.posting-item')
            </div>
        </div>
        @include('modal-webs.inform-posting-item')

    </div>
    {{-- End Content --}}
    <script src="{{ asset('dashboard_src/src/plugins/dropzone/src/dropzone.js') }}"></script>

    <script>
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('div#mydropzone', { // The camelized version of the ID of the form element
            url: "{{ route('thuchien-dangkythumua-Guest') }}",
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
                    e.preventDefault();
                    e.stopPropagation();
                    if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                        Swal.fire({
                            icon: "warning",
                            title: "Lỗi!",
                            text: "Bạn chưa tải ảnh của xe.",
                            showConfirmButton: false,
                            timer: 3000 // Thời gian hiển thị thông báo (ms)
                        }).then((result) => {
                            // Sau khi thông báo đã biến mất, chuyển hướng người dùng
                            window.location.href = '{{ route('gui-form-thumua-Guest') }}';
                        });
                    } else {
                        // var formData = $('#formthumua').serialize();
                        myDropzone.processQueue();
                    }
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
                // this.on("successmultiple", function(files, response) {
                //     // myDropzone.removeAllFiles();
                //     // document.getElementById("formthumua").reset();
                //     window.location.href = '{{ route('gui-form-thumua-Guest') }}';
                // });
                this.on("successmultiple", function(files, response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: "Thông tin đã được gửi đi.",
                        showConfirmButton: false,
                        timer: 1500 // Thời gian hiển thị thông báo (ms)
                    }).then((result) => {
                        // Sau khi thông báo đã biến mất, chuyển hướng người dùng
                        myDropzone.removeAllFiles();
                        document.getElementById("formthumua").reset();
                        window.location.href = '{{ route('gui-form-thumua-Guest') }}';
                    });
                });
                this.on("errormultiple", function(files, response) {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi!",
                        text: "Thông tin của bạn chưa được gửi đi.",
                        showConfirmButton: false,
                        timer: 1500 // Thời gian hiển thị thông báo (ms)
                    }).then((result) => {
                        // Sau khi thông báo đã biến mất, chuyển hướng người dùng
                        window.location.href = '{{ route('gui-form-thumua-Guest') }}';
                    });
                });

            }
        });
    </script>
    <script>
        document.getElementById('loaixe').addEventListener('change', function() {
            var selectedLoaiXe = this.value;
            var hangXeSelect = document.getElementById('hangxe');
            hangXeSelect.innerHTML = '';
            if (selectedLoaiXe === 'Xe may') {
                @foreach ($hxm as $i)
                    var option = document.createElement('option');
                    option.value = "{{ $i->mahx }}";
                    option.textContent = "{{ $i->tenhang }}";
                    hangXeSelect.appendChild(option);
                @endforeach
            } else {
                @foreach ($hxdd as $i)
                    var option = document.createElement('option');
                    option.value = "{{ $i->mahx }}";
                    option.textContent = "{{ $i->tenhang }}";
                    hangXeSelect.appendChild(option);
                @endforeach
            }

        });
    </script>
@endsection
