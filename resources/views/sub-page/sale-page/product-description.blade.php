<div class="row g-0">
    <div class="col-12 col-md-8 ms-md-4">
        <div class="row">
            <div class="product-title">
                <h3>Mô tả chi tiết - Khuyến mãi</h3>
            </div>
            <div class="description mt-3">
                <div class="row">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="p-2"><i class="bi bi-quote fs-4"></i></div>
                        <div class="p-2">
                            @foreach ($ct_thongtin_xemay as $i)
                                <p>{{ $i->motakhuyenmai }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="d-flex gap-3 align-items-center">
                        <div class="p-2"><i class="bi bi-geo-alt-fill fs-4"></i></div>
                        <div class="p-2">
                            @foreach ($ct_thongtin_xemay as $item)
                                <p class="d-inline fw-bolder">Khu vực: {{ $i->mota }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 mt-3 mt-md-0"></div>
</div>
