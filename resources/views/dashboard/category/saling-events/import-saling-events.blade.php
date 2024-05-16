
<form action="" method="POST" id="formkhuyenmai">
    @csrf
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Mã khuyến mãi</label>
        <div class="col-sm-12 col-md-10">
            <input class="form-control" name="makhuyemai" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Tên khuyến mãi</label>
        <div class="col-sm-12 col-md-10">
            <input class="form-control" name="tenkhuyenmai" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Ngày bắt đầu</label>
        <div class="col-sm-12 col-md-10">
            <input type="date" class="form-control" name="ngaybatdau" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Ngày kết thúc</label>
        <div class="col-sm-12 col-md-10">
            <input type="date" class="form-control" name="ngayketthuc" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Điều kiện áp dụng</label>
        <div class="col-sm-12 col-md-10">
            <input class="form-control"  name="dieukienapdung" maxlength="12">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Mô tả</label>
        <div class="col-sm-12 col-md-10">
            <textarea class="form-control" rows="3" name="mota" name="mota"></textarea>
        </div>
    </div>
    {{-- <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ảnh</label>
                        <div class="col-sm-12 col-md-10">
                            <div class="table-container">
                                <table class="table">
                                    <tbody>
                                        @if ($dtm->hinhanh != '')
                                            @foreach (explode(',', $dtm->hinhanh) as $path)
                                                @php $index = array_search($path, explode(',', $dtm->hinhanh)) @endphp
                                                <tr>
                                                    <td>
                                                        <a href="">
                                                            <img src="{{ asset('storage/' . $path) }}" alt="Ảnh"
                                                                height="250" width="250">
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3" formaction="{{route('themskkhuyenmai')}}">Thêm</button>
        <button type="submit" class="btn btn-danger me-md-2 mx-3 my-3" name="huythem" formaction="#">Không duyệt</button>
    </div>
</form>
