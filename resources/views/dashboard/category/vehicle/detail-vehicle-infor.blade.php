@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe')
@section('pg-card-title', 'Chi tiết thông tin xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4', 'true')
@section('pg-hd-4', 'Chi tiết thông tin xe') @section('act4', 'active')

<style>
    .table-container {
        max-height: 600px;
        overflow: auto;
    }
</style>

@section('main')

    @if (Session::has('success-thaydoi-thongtinxe'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-thaydoi-thongtinxe') }}",
            });
        </script>
    @endif
    @if (Session::has('success-xoaanh-thongtinxe'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: "{{ Session::get('success-xoaanh-thongtinxe') }}",
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    toast: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
            });
        </script>
    @endif

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

                <form action="{{ route('capnhat-thongtinxe', ['maxe' => $xe->maxe]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="maxe">Mã xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="maxe" value="{{ $xe->maxe }}" disabled />
                            <input class="form-control" name="maxe" value="{{ $xe->maxe }}" hidden />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="dongxe">Dòng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="dongxe" id="dongxe">
                                <option value="{{ $xe->madx }}" selected hidden>{{ $xe->tendongxe }}</option>
                                @foreach ($dx as $i)
                                    <option value="{{ $i->madx }}">{{ $i->tendongxe }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="tenxe">Tên xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" id="tenxe" name="tenxe" value="{{ $xe->tenxe }}" />
                            @error('tenxe')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="bsx">Biển số xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="bsx" id="bsx" value="{{ $xe->biensoxe }}"
                                maxlength="12">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="thoigiansudung">Thời gian đã sử dụng</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="thoigiansudung" id="thoigiansudung"
                                value="{{ $xe->thoigiandasudung }}">
                            @error('thoigiansudung')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="tinhtrangxe">Tình trạng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" id="tinhtrangxe" name="tinhtrangxe">{{ $xe->tinhtrangxe }}</textarea>
                            @error('tinhtrangxe')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="sokmdadi">Số km đã đi</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" class="form-control" name="sokmdadi" id="sokmdadi"
                                value="{{ $xe->sokmdadi }}">
                            @error('sokmdadi')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="ghichu">Ghi chú</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" rows="3" id="ghichu" name="ghichu">{{ $xe->ghichu }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ảnh</label>
                        <div class="col-sm-12 col-md-10">
                            <div class="table-container">
                                <table class="table">
                                    <tbody>
                                        @if ($xe->hinhanh != '')
                                            @foreach (explode(',', $xe->hinhanh) as $path)
                                                @php $index = array_search($path, explode(',', $xe->hinhanh)) @endphp
                                                <tr>
                                                    <td>
                                                        <a href="">
                                                            <img src="{{ asset('storage/' . $path) }}" alt="Ảnh"
                                                                height="250" width="250">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('xoaanh', ['id' => $xe->maxe, 'index' => $index]) }}"
                                                            class="btn btn-danger"> <i class="bi bi-trash3"></i> Xóa ảnh</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <input type="file" class="form-control-file " id="images" name="images[]" multiple>
                            @error('images')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>

                    </div>
                    @if (substr($xe->maxe, 0, 2) == 'XM')
                        <div class="clearfix mt-3 mb-3">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Thông số kỹ thuật xe máy</h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="khoiluong">Khối lượng</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="number" class="form-control" id="khoiluong" name="khoiluong"
                                    value="{{ $xe->khoiluong }}" />
                            </div>
                            @error('khoiluong')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="dungtichxe">Dung tích xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="text" class="form-control" name="dungtichxe" id="dungtichxe"
                                    value="{{ $xe->dungtichxe }}" />
                            </div>
                            @error('dungtichxe')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="muctieuthunhienlieu">Mức tiêu thụ nhiên
                                liệu</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="text" class="form-control" id="muctieuthunhienlieu"
                                    name="muctieuthunhienlieu" value="{{ $xe->muctieuthunhienlieu }}" />
                            </div>
                            @error('muctieuthunhienlieu')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="dungtichbinhxang">Dung tích bình
                                xăng</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="text" class="form-control" id="dungtichbinhxang" name="dungtichbinhxang"
                                    value="{{ $xe->dungtichbinhxang }}" />
                            </div>
                            @error('dungtichbinhxang')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                    @else
                        <div class="clearfix mt-3 mb-3">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Thông số kỹ thuật xe đạp điện</h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="trongluong">Trọng lượng (kg)</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="trongluong" id="trongluong" value="{{ $xe->trongluong }}"/>
                            </div>
                            @error('trongluong')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="acquy">Loại ắc quy</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" id="acquy" name="acquy" value="{{ $xe->trongluong }}"/>
                            </div>
                            @error('acquy')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="dongcodien">Động cơ điện</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="dongcodien" id="dongcodien" value="{{ $xe->dongcodien }}"/>
                            </div>
                            @error('dongcodien')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="thoigiansacdien">Thời gian sạc điện</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="thoigiansacdien" id="thoigiansacdien" value="{{ $xe->thoigiansacdien }}"/>
                            </div>
                            @error('thoigiansacdien')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="phamvisudung">Phạm vi sử dụng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" id="phamvisudung" name="phamvisudung" value="{{ $xe->phamvisudung }}"/>
                            </div>
                            @error('phamvisudung')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                    @endif
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3"><i class="bi bi-upload"></i> Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>

    @endsection
