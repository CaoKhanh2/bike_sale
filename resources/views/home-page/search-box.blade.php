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
                <div class="col-12 col-lg-4 mb-2 mb-lg-0">
                    <input type="text" class="form-control" placeholder="Tìm tên, hãng, dòng xe, ..." name="tenxe">
                </div>
                <div class="col-12 col-lg-2 mb-2 mb-lg-0">
                    <select id="inputState2" class="form-select" name="loaixe">
                        <option selected hidden value="">Loại xe</option>
                        <option>Xe máy</option>
                        <option>Xe đạp điện</option>
                    </select>
                </div>
                <div class="col-12 col-lg-4 mb-2 mb-lg-0">
                    <div class="input-group">
                        <input type="button" class="form-control text-start" value="Bộ lọc" data-bs-toggle="modal" data-bs-target="#parentPopup">
                        <span></span>
                    </div>
                    <!-- Main Search Popup -->
                    <div class="modal fade" id="parentPopup" tabindex="-1" aria-labelledby="parentPopupLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="parentPopupLabel" aria-label="Close">Lọc kết quả</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col col-12 d-grid gap-2 mb-2">
                                                <h5>Danh mục xe</h5>
                                                <button type="button" class="btn btn-outline-secondary text-start form-select" data-bs-toggle="modal" data-bs-target="#childPopup">Tất cả: Xe máy, Xe đạp điện</button>
                                            </div>
                                            <form action="">
                                                <div class="col-12 mt-2 mb-2">
                                                    <h5>Giá từ:</h5>
                                                    <input type="text" id="rangeSlider1" name="rangeSlider1" />
                                                </div>
                                                <div class="col-12 mt-2 mb-2">
                                                    <h5>Sắp xếp theo</h5>
                                                    <div class="container-fluid mt-3">
                                                        <div class="row">
                                                            <div class="col-auto me-auto">
                                                                <img width="24" height="24" src="https://img.icons8.com/ios/50/clock--v3.png" alt="clock--v3"/>
                                                                <label class="form-check-label" for="sx_tinmoi1">
                                                                    <p class="align-baseline fs-6">Mới nhất</p>
                                                                </label>
                                                            </div>
                                                            <div class="col-auto">
                                                                <input class="form-check" type="radio" name="sapxeptheo1"
                                                                    id="sx_tinmoi1" value="option1">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto me-auto">
                                                                <img width="24" height="24" src="https://img.icons8.com/ios/50/price-tag--v1.png" alt="price-tag--v1"/>
                                                                <label class="form-check-label" for="sx_giathapnhat1">
                                                                    <p class="align-baseline fs-6">Giá thấp nhất</p>
                                                                </label>
                                                            </div>
                                                            <div class="col-auto">
                                                                <input class="form-check" type="radio" name="sapxeptheo1"
                                                                    id="sx_giathapnhat1" value="option2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Áp dụng</button> --}}
                                        <input type="submit" value="Áp dụng" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Category Popup -->
                    <div class="modal fade" id="childPopup" tabindex="-1" aria-labelledby="childPopupLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{-- <h5 class="modal-title" id="childPopupLabel">Child Popup</h5> --}}
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="form-check">
                                                <div class="row">
                                                    <div class="col-auto me-auto">
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            <p class="fs-6">Tất cả</p>
                                                        </label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input class="form-check" type="radio" name="exampleRadios2"
                                                            id="exampleRadios1" value="option1" data-bs-toggle="modal" data-bs-target="#parentPopup">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto me-auto">
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            <p class="fs-6">Xe máy</p>
                                                        </label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input class="form-check" type="radio" name="exampleRadios2"
                                                            id="exampleRadios2" value="option1" data-bs-toggle="modal" data-bs-target="#childPopup1">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto me-auto">
                                                        <label class="form-check-label" for="exampleRadios3">
                                                            <p class="fs-6">Xe đạp điện</p>
                                                        </label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input class="form-check" type="radio" name="exampleRadios2"
                                                            id="exampleRadios3" value="option2" data-bs-toggle="modal" data-bs-target="#childPopup2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="submit" class="btn btn-primary" >
                                        Áp dụng
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- XeMay Popup -->
                    <div class="modal fade" id="childPopup1" tabindex="-1" aria-labelledby="childPopupLabel"
                    aria-hidden="true">

                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="childPopupLabel">Lọc kết quả</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col col-12 d-grid gap-2 mb-2">
                                                <h5>Danh mục xe</h5>
                                                <button type="button" class="btn btn-outline-secondary text-start form-select" data-bs-toggle="modal" data-bs-target="#childPopup">Xe máy</button>
                                            </div>
                                            <form action="">
                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Giá từ:</h5>
                                                    <input type="text" id="rangeSlider2" name="rangeSlider2" />
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Hãng xe</h5>
                                                    <select id="inputState3" class="form-select" name="">
                                                        <option selected>Tất cả</option>
                                                        <option>...</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Năm sản xuất</h5>
                                                    <input type="text" id="rangeSlider3" name="rangeSlider3" />
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Số Km đã đi</h5>
                                                    <input type="text" id="rangeSlider4" name="rangeSlider4" />
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Loại xe</h5>
                                                    <select id="inputState4" class="form-select" name="">
                                                        <option selected>Tất cả</option>
                                                        <option>...</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Dung tích</h5>
                                                    <select id="inputState5" class="form-select" name="">
                                                        <option selected>Tất cả</option>
                                                        <option>...</option>
                                                    </select>
                                                </div>
    
                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Sắp xếp theo</h5>
                                                    <div class="container mt-3">
                                                        <div class="row">
                                                            <div class="col-auto me-auto">
                                                                <img width="24" height="24" src="https://img.icons8.com/ios/50/clock--v3.png" alt="clock--v3"/>
                                                                <label class="form-check-label" for="sx_tinmoi2">
                                                                    <p class="fs-6">Mới nhất</p>
                                                                </label>
                                                            </div>
                                                            <div class="col-auto">
                                                                <input class="form-check" type="radio" name="sapxeptheo2"
                                                                    id="sx_tinmoi2" value="option1">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto me-auto">
                                                                <img width="24" height="24" src="https://img.icons8.com/ios/50/price-tag--v1.png" alt="price-tag--v1"/>
                                                                <label class="form-check-label" for="sx_giathapnhat2">
                                                                    <p class="fs-6">Giá thấp nhất</p>
                                                                </label>
                                                            </div>
                                                            <div class="col-auto">
                                                                <input class="form-check" type="radio" name="sapxeptheo"
                                                                    id="sx_giathapnhat2" value="option2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <input type="submit" value="Áp dụng" class="btn btn-primary">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- XeDapien Popup -->
                    <div class="modal fade" id="childPopup2" tabindex="-1" aria-labelledby="childPopupLabel"
                    aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="childPopupLabel">Lọc kết quả</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col col-12 d-grid gap-2 mb-2">
                                                <h5>Danh mục xe</h5>
                                                <button type="button" class="btn btn-outline-secondary text-start form-select" data-bs-toggle="modal" data-bs-target="#childPopup">Xe đạp điện</button>
                                            </div>
                                            <form action="">
                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Giá từ:</h5>
                                                    <input type="text" id="rangeSlider5" name="rangeSlider5" />
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Hãng xe</h5>
                                                    <select id="inputState6" class="form-select" name="">
                                                        <option selected>Tất cả</option>
                                                        <option>...</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Năm sản xuất</h5>
                                                    <input type="text" id="rangeSlider6" name="rangeSlider6" />
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Phạm vi sử dụng (km)</h5>
                                                    <input type="text" id="rangeSlider7" name="rangeSlider7" />
                                                </div>

                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Loại xe</h5>
                                                    <select id="inputState7" class="form-select" name="">
                                                        <option selected>Tất cả</option>
                                                        <option>...</option>
                                                    </select>
                                                </div>
    
                                                <div class="col-12 mt-3 mb-3">
                                                    <h5>Sắp xếp theo</h5>
                                                    <div class="container mt-3">
                                                        <div class="row">
                                                            <div class="col-auto me-auto">
                                                                <img width="24" height="24" src="https://img.icons8.com/ios/50/clock--v3.png" alt="clock--v3"/>
                                                                <label class="form-check-label" for="sx_tinmoi2">
                                                                    <p class="fs-6">Mới nhất</p>
                                                                </label>
                                                            </div>
                                                            <div class="col-auto">
                                                                <input class="form-check" type="radio" name="sapxeptheo2"
                                                                    id="sx_tinmoi2" value="option1">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto me-auto">
                                                                <img width="24" height="24" src="https://img.icons8.com/ios/50/price-tag--v1.png" alt="price-tag--v1"/>
                                                                <label class="form-check-label" for="sx_giathapnhat2">
                                                                    <p class="fs-6">Giá thấp nhất</p>
                                                                </label>
                                                            </div>
                                                            <div class="col-auto">
                                                                <input class="form-check" type="radio" name="sapxeptheo"
                                                                    id="sx_giathapnhat2" value="option2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <input type="submit" value="Áp dụng" class="btn btn-primary">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
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
<script src="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js') }}"></script>

{{-- All --}}
<script>
    $(document).ready(function() {
    $("#rangeSlider1").ionRangeSlider({
        type: "double",
        min: 0,
        max: 50000000,
        from: 0,
        to: 50000000,
        step: 120000,
        grid: false,
        grid_num: 120000,
        skin: "round",
        prettify_enabled: true,
        prettify_separator: ",",
        force_edges: true,
        onChange: function (data) {
        // Log changed values to console
        console.log("Min: " + data.from + ", Max: " + data.to);
        }
    });
    });
</script>

{{-- XeMay --}}
    {{-- GiaTien --}}
    <script>
        $(document).ready(function() {
        $("#rangeSlider2").ionRangeSlider({
            type: "double",
            min: 0,
            max: 50000000,
            from: 0,
            to: 50000000,
            step: 120000,
            grid: false,
            grid_num: 120000,
            skin: "round",
            prettify_enabled: true,
            prettify_separator: ",",
            force_edges: true,
            onChange: function (data) {
            // Log changed values to console
            console.log("Min: " + data.from + ", Max: " + data.to);
            }
        });
        });
    </script>

    {{-- NamSX --}}
    <script>
        $(document).ready(function() {
        $("#rangeSlider3").ionRangeSlider({
            type: "double",
            min: 2010,
            max: 2024,
            from: 2010,
            to: 2024,
            grid: false,
            grid_num: 1,
            skin: "round",
            prettify_enabled: true,
            prettify_separator: "",
            force_edges: true,
            onChange: function (data) {
            // Log changed values to console
            console.log("Min: " + data.from + ", Max: " + data.to);
            }
        });
        });
    </script>

    {{-- SoKM --}}
    <script>
        $(document).ready(function() {
        $("#rangeSlider4").ionRangeSlider({
            type: "double",
            min: 0,
            max: 500000,
            from: 0,
            to: 500000,
            grid: false,
            grid_num: 100,
            skin: "round",
            prettify_enabled: true,
            prettify_separator: ",",
            force_edges: true,
            onChange: function (data) {
            // Log changed values to console
            console.log("Min: " + data.from + ", Max: " + data.to);
            }
        });
        });
    </script>

{{-- XeDapDien --}}
    {{-- GiaTien --}}
    <script>
        $(document).ready(function() {
        $("#rangeSlider5").ionRangeSlider({
            type: "double",
            min: 0,
            max: 25000000,
            from: 0,
            to: 25000000,
            step: 120000,
            grid: false,
            grid_num: 120000,
            skin: "round",
            prettify_enabled: true,
            prettify_separator: ",",
            force_edges: true,
            onChange: function (data) {
            // Log changed values to console
            console.log("Min: " + data.from + ", Max: " + data.to);
            }
        });
        });
    </script>

        {{-- NamSX --}}
        <script>
            $(document).ready(function() {
            $("#rangeSlider6").ionRangeSlider({
                type: "double",
                min: 2010,
                max: 2024,
                from: 2010,
                to: 2024,
                grid: false,
                grid_num: 1,
                skin: "round",
                prettify_enabled: true,
                prettify_separator: "",
                force_edges: true,
                onChange: function (data) {
                // Log changed values to console
                console.log("Min: " + data.from + ", Max: " + data.to);
                }
            });
            });
        </script>


    {{-- SoKM --}}
    <script>
        $(document).ready(function() {
        $("#rangeSlider7").ionRangeSlider({
            type: "double",
            min: 0,
            max: 250,
            from: 0,
            to: 250,
            grid: false,
            grid_num: 10,
            step:5,
            skin: "round",
            prettify_enabled: true,
            prettify_separator: "",
            force_edges: true,
            onChange: function (data) {
            // Log changed values to console
            console.log("Min: " + data.from + ", Max: " + data.to);
            }
        });
        });
    </script>


