@extends('dashboard.layout.content')

@section('title_ds', 'Kho hàng')
@section('pg-card-title', 'Thêm kho hàng')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Kho hàng') @section('act3', 'active')
@section('st4', 'false')


@section('main')
    @if (Session::has('success-them-khohang'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-them-khohang') }}",
            });
        </script>
    @endif
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}
            <div class="pd-20 card-box mb-3">
                <div class="pd-20">
                    <h4 class="text-blue h4">Thêm kho hàng</h4>
                </div>
                <div class="pb-20">
                    <form method="POST" action="{{ route('thuchien-them-khohang') }}" class="form mt-2">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="makho">Mã kho</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="makho" id="makho" value="{{ old('makho') }}"
                                    required />
                                @error('makho')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="tenkho">Tên kho</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tenkho" id="tenkho" value="{{ old('tenkho') }}"
                                    required />
                                @error('tenkho')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="diachi">Địa chỉ</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="diachi" id="diachi" required>{{ old('diachi') }}</textarea>
                                @error('diachi')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    @endsection
