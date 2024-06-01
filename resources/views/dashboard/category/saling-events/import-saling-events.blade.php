<form action="{{ route('themskkhuyenmai') }}" method="POST" id="formkhuyenmai" style="display: block">
    @csrf
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Mã khuyến mãi</label>
        <div class="col-sm-12 col-md-10">
            <input class="form-control " name="makhuyemai" required />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Tên sk khuyến mãi</label>
        <div class="col-sm-12 col-md-10">
            <input class="form-control" name="tenkhuyenmai" required />
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group row">
                <label class="col-sm-12 col-md-4 col-form-label">Ngày bắt đầu</label>
                <div class="col-sm-12 col-md-8">
                    <input type="date" class="form-control" name="ngaybatdau" />
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Ngày kết thúc</label>
                <div class="col-sm-12 col-md-9">
                    <input type="date" class="form-control" name="ngayketthuc" />
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Tỉ lệ giảm</label>
        <div class="col-sm-12 col-md-10">
            <input class="form-control" type="number" min="10" max="99" name="tile" required />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Điều kiện áp dụng</label>
        <div class="col-sm-12 col-md-10">
            <div class="row">
                <div class="col-md-2 col-sm-12 mb-3">
                    <input type="checkbox" class="" id="xemay" name="xemay">
                    Xe máy
                </div>
                <div class="col-md-5 col-sm-12 mb-3">
                    <select class="custom-select hangxemay-select2 col-sm-12" id="hangxemay" name="hangxemay[]"
                        multiple="multiple" disabled>
                        @foreach ($hxm as $i)
                            <option value="{{ $i->mahx }}">{{ $i->tenhang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 col-sm-12 mb-2">
                    <select class="custom-select dongxemay-select2 col-sm-12" id="dongxemay" name="dongxemay[]"
                        multiple="multiple" disabled>
                        @foreach ($dxm as $i)
                            <option value="{{ $i->madx }}">{{ $i->tendongxe }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-12 mb-3">
                    <input type="checkbox" class="" id="xedapdien" name="xedapdien">
                    Xe đạp điện
                </div>
                <div class="col-md-5 col-sm-12 mb-3">
                    <select class="custom-select hangxedapdien-select2 col-12" id="hangxedapdien" name="hangxedap[]"
                        multiple="multiple" disabled>
                        @foreach ($hxd as $i)
                            <option value="{{ $i->mahx }}">{{ $i->tenhang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 col-sm-12">
                    <select class="custom-select dongxedapdien-select2 col-sm-12" id="dongxedapdien" name="dongxedap[]"
                        multiple="multiple" disabled>
                        @foreach ($dxdd as $i)
                            <option value="{{ $i->madx }}">{{ $i->tendongxe }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-form-label">Mô tả</label>
        <div class="col-sm-12 col-md-10">
            <textarea class="form-control" rows="3" name="mota" name="mota"></textarea>
        </div>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit" id="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.hangxemay-select2').select2({
            placeholder: "Chọn hãng xe máy",
            allowClear: true,
        });
        $('.dongxemay-select2').select2({
            placeholder: "Chọn dòng xe máy",
            allowClear: true,

        });
        $('.hangxedapdien-select2').select2({
            placeholder: "Chọn hãng xe đạp điện",
            allowClear: true,

        });
        $('.dongxedapdien-select2').select2({
            placeholder: "Chọn dòng xe đạp điện",
            allowClear: true,

        });
    });
</script>
{{-- ///////////////// --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('xemay').addEventListener('change', function() {
            document.getElementById('hangxemay').disabled = !this.checked;
            document.getElementById('dongxemay').disabled = !this.checked;
        });
        document.getElementById('xedapdien').addEventListener('change', function() {
            document.getElementById('hangxedapdien').disabled = !this.checked;
            document.getElementById('dongxedapdien').disabled = !this.checked;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#hangxemay').on('change', function() {
            var selectedHangXe = $(this).val();
            var dongXeSelect = $('#dongxemay');
            dongXeSelect.empty();
            @foreach ($dxm as $i)
                if (selectedHangXe.includes("{{ $i->mahx }}")) {
                    dongXeSelect.append(new Option("{{ $i->tendongxe }}", "{{ $i->madx }}"));
                }
            @endforeach

        
            dongXeSelect.trigger('change');
        });
        $('#hangxedapdien').on('change', function() {
            var selectedHangXe = $(this).val();
            var dongXeSelect = $('#dongxedapdien');
            dongXeSelect.empty();
            @foreach ($dxdd as $i)
                if (selectedHangXe.includes("{{ $i->mahx }}")) {
                    dongXeSelect.append(new Option("{{ $i->tendongxe }}", "{{ $i->madx }}"));
                }
            @endforeach

        
            dongXeSelect.trigger('change');
        });
    });
</script>
{{-- ///////////////// --}}
