<div class="container">
    <form action="{{ route('timkiem') }}" method="POST">
        @csrf
        <div class="row justify-content-start">
            <div class="col-12 col-md-6 mb-2">
                <input type="text" name="tenxe" class="form-control" placeholder="Tìm tên, hãng, dòng xe, ..."
                    aria-label="">
            </div>
            <div class="col-12 col-md-6">
                <div class="row g-3">
                    <div class="col-12 col-sm mb-2">
                        <select class="form-select" id="loaixe" name="loaixe" aria-label="Default select example">
                            <option value="" hidden selected>Loại xe</option>
                            <option>Xe máy</option>
                            <option>Xe đạp điện</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm mb-2">
                        <select class="form-select" id="hangxe" name="hangxe" aria-label="Default select example">
                            <option value="" selected hidden>Hãng xe</option>
                            <!-- Add your options here -->
                        </select>
                    </div>
                    <div class="col-12 col-sm">
                        <button class="btn btn-primary btn-block w-100">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    document.getElementById('loaixe').addEventListener('change', function() {
        var selected = this.value;
        var hangXeSelect = document.getElementById('hangxe');
        hangXeSelect.innerHTML = '<option value="" selected hidden>Hãng xe</option>';
        @foreach ($dongxe as $i)
            if ("{{ $i->loaixe }}" === selected) {
                var option = document.createElement('option');
                option.value = "{{ $i->mahx }}";
                option.textContent = "{{ $i->tenhang }}";
                hangXeSelect.appendChild(option);
            }
        @endforeach
    });
</script>
