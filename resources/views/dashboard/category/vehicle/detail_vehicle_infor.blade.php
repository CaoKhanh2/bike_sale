@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe')
@section('pg-card-title', 'Chi tiết thông tin xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4', 'true')
@section('pg-hd-4', 'Danh mục xe máy') @section('act4', 'active')

<style>
    .table-container {
        max-height: 600px;
        overflow: auto;
    }
</style>

@section('main')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Thông tin xe</h4>
                    </div>
                </div>
                <form action="{{ url('/dashboard/category/vehicle/detail_vehicle_infor/$xm->maxemay') }}" method="POST">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Mã xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $xm->maxe }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Dòng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12">
                                <option value="{{ $xm->madx }}" selected hidden>{{ $xm->madx }}</option>
                                @foreach ($dx as $i)
                                    <option value="{{ $i->madx }}">{{ $i->madx }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Hãng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12">
                                <option value="{{ $xm->mahx }}" selected>{{ $xm->mahx }}</option>
                                @foreach ($hx as $i)
                                    <option value="{{ $i->mahx }}">{{ $i->mahx }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tên xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $xm->tenxe }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biển số xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="bsx" value="{{ $xm->biensoxe }}" maxlength="12">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ghi chú</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" rows="3" name="mt">{{ $xm->ghichu }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ảnh</label>
                        <div class="col-sm-12 col-md-10">
                            <div class="table-container">
                                <table class="table">
                                    <tbody>
                                        @if ($xm->hinhanh != '')
                                            @foreach (explode(',', $xm->hinhanh) as $path)
                                                @php $index = array_search($path, explode(',', $xm->hinhanh)) @endphp
                                                <tr>
                                                    <td>
                                                        <a href="">
                                                            <img src="{{ asset('storage/' . $path) }}" alt="Ảnh"
                                                                height="250" width="250">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('xoaanh', ['id' => $xm->maxe, 'index' => $index]) }}"
                                                            class="btn btn-primary">Xóa</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <input type="file" class="form-control-file form-control height-auto" id="images"
                                name="images[]" multiple>
                        </div>
                    </div>
                    @if (substr($xm->maxe, 0, 2) == 'XM')
                        <div class="clearfix mt-3 mb-3">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Thông số kỹ thuật xe máy</h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Khối lượng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Dung tích xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Mức tiêu thụ nhiên liệu</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Dung tích bình xăng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" />
                            </div>
                        </div>
                    @else
                        <div class="clearfix mt-3 mb-3">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Thông số kỹ thuật xe đạp điện</h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Trọng lượng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Ắc quy</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Động cơ điện</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Thời gian sử dụng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Phạm vi sử dụng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text"/>
                            </div>
                        </div>
                    @endif
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>

    @endsection
