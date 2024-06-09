@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin dòng xe')
@section('pg-card-title', 'Thông tin dòng xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4', 'true')
@section('pg-hd-4', 'Thông tin dòng xe') @section('act4', 'active')

@section('main')

    @if (Session::has('success-add-dongxe'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-add-dongxe') }}",
            });
        </script>
    @endif

    @if (Session::has('success-update-dongxe'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-update-dongxe') }}",
            });
        </script>
    @endif 

    @if (Session::has('success-xoa-dongxe'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-xoa-dongxe') }}",
            });
        </script>
    @endif

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}

                <!-- Export Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pb-20">
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
                            <div class="table-responsive tab-content">
                                <div class="tab-pane fade show active" id="table" role="tabpanel">
                                    <div class="pd-20">
                                        <table class="table hover multiple-select-row nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Mã dòng xe</th>
                                                    <th>Hãng xe</th>
                                                    <th>Tên dòng xe</th>
                                                    <th>Loại xe</th>
                                                    <th>Mô tả</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dongxe as $i)
                                                    <tr>
                                                        <td>{{ $i->madx }}</td>
                                                        <td>{{ $i->tenhang }}</td>
                                                        <td>{{ $i->tendongxe }}</td>
                                                        <td>{{ $i->loaixe }}</td>
                                                        <td>{{ $i->mota }}</td>
                                                        <td>
                                                            <a type="button" class="btn btn-primary"
                                                                href="{{ route('capnhatdongxe', ['id' => $i->madx]) }}">
                                                                <i class="bi bi-pencil-fill"></i> Sửa
                                                            </a>
                                                            <a type="button" class="btn btn-danger"
                                                                href="{{ route('xoadongxe', ['id' => $i->madx]) }}">
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
                                        <form action="{{ route('themdongxe') }}" class="form mt-2" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="madx">Mã dòng
                                                    xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" name="mdx" id="madx"
                                                        value="{{ $madongxe }}" readonly />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="loaixe">Loại
                                                    xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="custom-select col-12" id="loaixe" name="lx"
                                                        required>
                                                        <option selected hidden value="">Lựa chọn</option>
                                                        <option value="Xe máy">Xe máy</option>
                                                        <option value="Xe đạp điện">Xe đạp điện</option>
                                                    </select>
                                                </div>
                                                @error('lx')
                                                    <small class="help-block">
                                                        <p class="text-danger">{{ $message }}</p>
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="hangxe">Hãng
                                                    xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="custom-select col-12" id="hangxe" name="hx"
                                                        required>
                                                        <option selected hidden value="">Lựa chọn</option>
                                                        @foreach ($hangxe as $i)
                                                            <option value="{{ $i->mahx }}">{{ $i->tenhang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('hx')
                                                    <small class="help-block">
                                                        <p class="text-danger">{{ $message }}</p>
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="tdx">Tên dòng
                                                    xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" name="tdx" id="tdx" required />
                                                </div>
                                                @error('tdx')
                                                    <small class="help-block">
                                                        <p class="text-danger">{{ $message }}</p>
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label" for="mota">Mô
                                                    tả</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <textarea class="form-control" rows="3" name="mt" id="mota"></textarea>
                                                </div>
                                                @error('mt')
                                                    <small class="help-block">
                                                        <p class="text-danger">{{ $message }}</p>
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="submit"
                                                    class="btn btn-primary me-md-2 mx-3 my-3"><i class="bi bi-plus-lg"></i> Thêm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Export Datatable End -->
            </div>

        </div>
    </div>

@endsection
