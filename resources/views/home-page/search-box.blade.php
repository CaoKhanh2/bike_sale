<style>
    /* Viền mặc định cho radio button */
    .form-check[type="radio"] {
        width: 1.2em;
        height: 1.2em;
    }
    .modal-body {
        /* max-height: 450px; 
        overflow-y: auto;  */
    }
</style>
<div class="card bg-light display-center" id="search-box">
    <div class="card-body box-search border-0">
        <form action="{{ route('timkiem') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-7 mb-2 mb-lg-0">
                    <input type="text" class="form-control" placeholder="Tìm tên, hãng, dòng xe, ..." name="tenxe">
                </div>
                <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                    <select id="inputState2" class="form-select" name="loaixe">
                        <option selected hidden value="">Loại xe</option>
                        <option>Xe máy</option>
                        <option>Xe đạp điện</option>
                    </select>
                </div>
                <div class="d-grid col-12 col-lg-2 mx-auto my-auto">
                    {{-- <a name="" id="" class="btn btn-primary btn-block" href="#"
                        role="button">Tìm</a> --}}
                        <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>

    </div>

</div>
{{-- <script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js') }}"></script> --}}




