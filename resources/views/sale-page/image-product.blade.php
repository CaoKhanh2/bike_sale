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
        max-height: 500px;
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
</style>
<div class="container">
    <div class="row g-0 text-center">
        <div class="col-sm-6 col-md-8">
            <div class="row">
                <div class="col-2">
                    <!-- Image List -->
                    <div class="image-list">
                        <ul class="list-group">
                            <li class="list-group-item border-0">
                                <img src="{{ asset('Image\Xe\XeDien\LX 150i JVC\xe-may-dien-vespa-lx-150i-jvc-ghi.png') }}"
                                    alt="Image 1" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                    class="object-fit-contain border rounded" alt="..." height="80"
                                    width="80" />
                            </li>
                            <li class="list-group-item border-0">
                                <img src="{{ asset('Image\Xe\XeDien\LX 150i JVC\xe-may-dien-vespa-lx-150i-jvc-ghi.png') }}"
                                    alt="Image 2" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                    class="object-fit-contain border rounded" alt="..." height="80"
                                    width="80" />
                            </li>
                            <li class="list-group-item border-0">
                                <img src="{{ asset('Image\Xe\XeDien\LX 150i JVC\xe-may-dien-vespa-lx-150i-jvc-ghi.png') }}"
                                    alt="Image 3" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                    class="object-fit-contain border rounded" alt="..." height="80"
                                    width="80" />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-10">
                    <!-- Carousel -->
                    <div id="carouselExampleIndicators" class="carousel slide w-75" data-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('Image\Xe\XeDien\mini MiBike X7\Xe-dien-mini-Mibike-X7-7287-2.jpg') }}"
                                    class="img-fluid" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('Image\Xe\XeDien\mini MiBike X7\Xe-dien-mini-Mibike-X7-7461.jpg') }}"
                                    class="img-fluid" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('Image\Xe\XeDien\mini MiBike X7\Xe-dien-mini-Mibike-X7-7352.jpg') }}"
                                    class="img-fluid" alt="...">
                            </div>
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
        <div class="col-6 col-md-4"></div>
    </div>
</div>

