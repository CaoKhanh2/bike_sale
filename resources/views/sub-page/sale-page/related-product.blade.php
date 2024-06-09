<style>
    .related-content .carousel-item img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        display: block;
        margin: auto;
        max-width: 100%;
        max-height: 142px;
        transition: transform 0.3s ease;
        /* Hiệu ứng phóng to */
        transform-origin: center center;
        /* Đảm bảo phóng to từ trung tâm */
    }

    .related-content .carousel-item img:hover {
        transform: scale(1.1);
        /* Phóng to ảnh khi di chuột vào */
    }

    /* .carousel-item .hstack {
        display: flex;
        justify-content: center;
    } */

    .carousel-control-prev,
    .carousel-control-next {
        background-color: rgba(0, 0, 0, 0.5);
        /* Màu xám */
        border: none;
        /* Loại bỏ viền */
        padding: 10px;
        /* Tăng kích thước nút */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        color: white;
    }
</style>

@php
    $url = url()->current();
    $arr = explode('/', $url);
    $res = $arr[4];
@endphp

<div class="container">
    <div class="row g-0">
        <div class="related-content">
            <div class="row">
                <div class="related-title mt-3 mb-3">
                    <h3>Các xe khác</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">

                    @if ($res == 'motorbike')
                        <div class="carousel-inner">
                            @php
                                $chunks = array_chunk($thongtin_xemay_array, 4); // Split into groups of 8
                            @endphp
                            @foreach ($chunks as $key => $chunk)
                                <div class="carousel-item{{ $key == 0 ? ' active' : '' }}">
                                    <div class="d-flex flex-column flex-md-row justify-content-center">
                                        @foreach ($chunk as $i)
                                            <div class="p-2">
                                                <div class="card" style="width: 18rem; height:17rem">
                                                    <a href="{{ route('hienthi-chitietthongtinxemay-Guest', ['maxe' => $i->maxe]) }}"
                                                        class="text-decoration-none">
                                                        @foreach (explode(',', $i->hinhanh) as $path)
                                                            @if ($loop->first)
                                                                <img src="{{ asset('storage/' . $path) }}"
                                                                    class="card-img-top" alt="...">
                                                            @endif
                                                        @endforeach
                                                    </a>
                                                    <div class="card-body">
                                                        <a href="" class="text-decoration-none text-dark">
                                                            <h5 class="card-title">{{ $i->tenxe }}</h5>
                                                        </a>
                                                        @if ($i->giagoc == $i->giaban)
                                                            <div class="col-12">
                                                                <h4>
                                                                    <span>
                                                                        <div class="row">
                                                                            <strong class="h6 text-secondary"></strong>
                                                                        </div>
                                                                        <div class="row">
                                                                            <strong>
                                                                                <span>{{ number_format($i->giagoc, 0, ',', '.') . ' đ' }}</span>
                                                                            </strong>
                                                                        </div>
                                                                    </span>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="col-12">
                                                                <h4>
                                                                    <span>
                                                                        <div class="row">
                                                                            <strong class="h6 text-secondary">
                                                                                <span><s><em>{{ number_format($i->giagoc, 0, ',', '.') . ' đ' }}</em></s></span>
                                                                            </strong>
                                                                        </div>
                                                                        <div class="row">
                                                                            <strong class="d-inline text-danger">
                                                                                {{ number_format($i->giaban, 0, ',', '.') . ' đ' }}
                                                                            </strong>
                                                                        </div>
                                                                    </span>
                                                                </h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif($res == 'electric-bicycles')
                        <div class="carousel-inner">
                            @php
                                $chunks = array_chunk($thongtin_xedapdien_array, 4); // Split into groups of 8
                            @endphp
                            @foreach ($chunks as $key => $chunk)
                                <div class="carousel-item{{ $key == 0 ? ' active' : '' }}">
                                    <div class="d-flex flex-column flex-md-row justify-content-center">
                                        @foreach ($chunk as $i)
                                            <div class="p-2">
                                                <div class="card" style="width: 18rem; height:17rem">
                                                    <a href="{{ route('hienthi-chitietthongtinxemay-Guest', ['maxe' => $i->maxe]) }}"
                                                        class="text-decoration-none">
                                                        @foreach (explode(',', $i->hinhanh) as $path)
                                                            @if ($loop->first)
                                                                <img src="{{ asset('storage/' . $path) }}"
                                                                    class="card-img-top" alt="...">
                                                            @endif
                                                        @endforeach
                                                        <div class="card-body text-decoration-none text-dark">
                                                            <h5 class="card-title">{{ $i->tenxe }}</h5>
                                                            @if ($i->giagoc == $i->giaban)
                                                                <div class="col-12">
                                                                    <h4>
                                                                        <span>
                                                                            <div class="row">
                                                                                <strong
                                                                                    class="h6 text-secondary"></strong>
                                                                            </div>
                                                                            <div class="row">
                                                                                <strong>
                                                                                    <span>{{ number_format($i->giagoc, 0, ',', '.') . ' đ' }}</span>
                                                                                </strong>
                                                                            </div>
                                                                        </span>
                                                                    </h4>
                                                                </div>
                                                            @else
                                                                <div class="col-12">
                                                                    <h4>
                                                                        <span>
                                                                            <div class="row">
                                                                                <strong class="h6 text-secondary">
                                                                                    <span><s><em>{{ number_format($i->giagoc, 0, ',', '.') . ' đ' }}</em></s></span>
                                                                                </strong>
                                                                            </div>
                                                                            <div class="row">
                                                                                <strong class="d-inline text-danger">
                                                                                    {{ number_format($i->giaban, 0, ',', '.') . ' đ' }}
                                                                                </strong>
                                                                            </div>
                                                                        </span>
                                                                    </h4>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <button class="carousel-control-prev" type="button"
                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                        data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
