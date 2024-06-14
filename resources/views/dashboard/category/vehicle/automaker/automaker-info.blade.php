@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin hãng xe')
@section('pg-card-title', 'Thông tin hãng xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4', 'true')
@section('pg-hd-4', 'Thông tin hãng xe') @section('act4', 'active')

@section('main')

    @if (Session::has('success-update-hangxe'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-update-hangxe') }}",
            });
        </script>
    @endif

    @if (Session::has('success-add-hangxe'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-add-hangxe') }}",
            });
        </script>
    @endif 

    @if (Session::has('success-xoa-hangxe'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-xoa-hangxe') }}",
            });
        </script>
    @endif

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}

                <div class="card-box mb-30">

                    <div class="col-12 pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>

                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="tab" href="#table" role="tab"
                                    aria-selected="true">Thông tin bảng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#form-add" role="tab"
                                    aria-selected="false">Thêm dữ liệu</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="table" role="tabpanel">
                                <div class="table-responsive pt-20">
                                    <table class="table hover multiple-select-row nowrap">
                                        <thead>
                                            <tr>
                                                <th>Mã hãng xe</th>
                                                <th>Tên hãng</th>
                                                <th>Logo</th>
                                                <th>Xuất xứ</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hangxe as $i)
                                                <tr>
                                                    <td>{{ $i->mahx }}</td>
                                                    <td>{{ $i->tenhang }}</td>
                                                    <td>
                                                        @foreach (explode(',', $i->logo) as $path)
                                                            <img src="{{ asset('storage/' . $path) }}" alt="Ảnh"
                                                                width="50" height="50">
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $i->xuatxu }}</td>
                                                    <td><a type="button" class="btn btn-primary"
                                                            href="{{ route('capnhathangxe', ['id' => $i->mahx]) }}">
                                                            <i class="bi bi-pencil-fill"></i> Sửa
                                                        </a>
                                                        <a type="button" class="btn btn-danger"
                                                            href="{{ route('xoahangxe', ['id' => $i->mahx]) }}">
                                                            <i class="bi bi-trash3"></i> Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="form-add" role="tabpanel">
                                <div class="pd-20">
                                    <form action="{{ route('themhangxe') }}" class="form mt-2" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label" for="mahx">Mã hãng
                                                xe</label>
                                            <div class="col-sm-12 col-md-10">
                                                <input class="form-control" name="mahx" id="mahx" value="{{ $mahx }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label" for="tenhang">Tên hãng
                                                xe</label>
                                            <div class="col-sm-12 col-md-10">
                                                <input class="form-control" name="tenhang" id="tenhang" required/>
                                            </div>
                                            @error('tenhang')
                                                <small class="help-block">
                                                    <p class="text-danger">{{ $message }}</p>
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label" for="logos">Ảnh logo</label>
                                            <div class="col-sm-12 col-md-10">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="logos"
                                                        name="logos">
                                                    {{-- <label class="custom-file-label">Chọn ảnh</label> --}}
                                                </div>
                                            </div>
                                            @error('logo')
                                                <small class="help-block">
                                                    <p class="text-danger">{{ $message }}</p>
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label" for="xs">Xuất xứ</label>
                                            <div class="col-sm-12 col-md-10">
                                                <input class="form-control" name="xs" id="xs" required/>
                                            </div>
                                            @error('xs')
                                                <small class="help-block">
                                                    <p class="text-danger">{{ $message }}</p>
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3"><i class="bi bi-plus-lg"></i> Thêm</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <script>
        // Kiểm tra dữ liệu trước khi gửi form
        // document.getElementById('form-add').addEventListener('submit', function(event) {
        //     var mahxInput = document.getElementById('mahx');
        //     var tenhangInput = document.getElementById('tenhang');
        //     var xsInput = document.getElementById('xs');
        //     var isValid = true;

        //     !mahxInput.value.trim() ? (mahxInput.classList.add('is-invalid'), isValid = false) : mahxInput.classList
        //         .remove('is-invalid');
        //     !tenhangInput.value.trim() ? (tenhangInput.classList.add('is-invalid'), isValid = false) : tenhangInput
        //         .classList.remove('is-invalid');
        //     !xsInput.value.trim() ? (xsInput.classList.add('is-invalid'), isValid = false) : xsInput.classList
        //         .remove('is-invalid');

        //     if (!isValid) {
        //         event.preventDefault();
        //     }
        // });
    </script>

@endsection
