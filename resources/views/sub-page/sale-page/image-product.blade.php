<style>
    .image-list {
        max-height: 400px;
        overflow-y: auto;
    }

    .image-list img {
        max-width: 100%;
        height: auto;
        cursor: pointer;
    }

    .carousel-item img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        display: block;
        margin: auto;
        max-width: 100%;
        max-height: 450px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        align-self: center;
    }

    .image-list .list-group-item {
        border-radius: 10px;
    }

    .image-list .list-group-item :active {
        border: 20px solid green;
    }

    #imagePopup {
        padding: 0;
    }

    #imagePopup .modal-body img {
        object-fit: contain;
        width: 100%;
        height: 100%;
        display: block;
        margin: auto;
        max-width: 100%;
        max-height: 650px;
    }
</style>
<div class="container">
    <div class="row g-0 text-center">
        @foreach ($ct_thongtin_xemay as $i)
            <div class="col-sm-4 col-md-8">
                <div class="row">
                    <div class="col-2">
                        <!-- Image List -->
                        <div class="image-list">
                            <ul class="list-group">
                                @php
                                    $count = 0; // Khởi tạo biến count ở đây
                                @endphp
                                @foreach (explode(',', $i->hinhanh) as $path)
                                    @php
                                        $index = array_search($path, explode(',', $i->hinhanh));
                                    @endphp
                                    <li class="list-group-item border-0">
                                        <img src="{{ asset('storage/' . $path) }}" alt="Image {{ $index + 1 }}"
                                            data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $count++ }}"
                                            class="object-fit-contain border rounded" alt="..." height="80"
                                            width="80" />
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-10">
                        <!-- Carousel -->
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach (explode(',', $i->hinhanh) as $index => $path)
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach (explode(',', $i->hinhanh) as $index => $path)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $path) }}" class="img-fluid" alt="..."
                                            onclick="showPopup(this)">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev bg-primary" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next bg-primary" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @foreach ($ct_thongtin_xedapdien as $i)
            <div class="col-sm-4 col-md-8">
                <div class="row">
                    <div class="col-2">
                        <!-- Image List -->
                        <div class="image-list">
                            <ul class="list-group">
                                @php
                                    $count = 0; // Khởi tạo biến count ở đây
                                @endphp
                                @foreach (explode(',', $i->hinhanh) as $path)
                                    @php
                                        $index = array_search($path, explode(',', $i->hinhanh));
                                    @endphp
                                    <li class="list-group-item border-0">
                                        <img src="{{ asset('storage/' . $path) }}" alt="Image {{ $index + 1 }}"
                                            data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $count++ }}"
                                            class="object-fit-contain border rounded" alt="..." height="80"
                                            width="80" />
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-10">
                        <!-- Carousel -->
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach (explode(',', $i->hinhanh) as $index => $path)
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach (explode(',', $i->hinhanh) as $index => $path)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $path) }}" class="img-fluid" alt="..."
                                            onclick="showPopup(this)">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev bg-primary" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next bg-primary" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <div class="col-6 col-md-4"></div> --}}
    </div>
</div>



<script>
    // JavaScript để hiển thị popup khi click vào hình ảnh
    function showPopup(img) {
        var modalImage = document.getElementById('popupImage');
        var src = img.getAttribute('src');
        modalImage.setAttribute('src', src);

        var modal = new bootstrap.Modal(document.getElementById('imagePopup'));
        modal.show();
    }
</script>
