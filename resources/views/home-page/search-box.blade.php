<style>

/* Viền mặc định cho radio button */
.form-check-input[type="radio"] {
  border: 2.5px solid #ced4da; /* Màu viền mặc định */
  border-width: 2px
}


</style>
<div class="card bg-light display-center" id="search-box">
    <div class="card-body box-search border-0">
        <form action="" method="">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Tìm tên, hãng, dòng xe, ..." aria-label="">
                </div>
                <div class="col">
                    {{-- <input type="text" class="form-control" placeholder="Tỉnh/Thành phố" aria-label="Last name"> --}}
                    <select id="inputState" class="form-select">
                        <option selected>Tỉnh, thành phố</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col">
                    {{-- <input type="text" class="form-control" placeholder="Loại xe" aria-label="Last name"> --}}
                    <select id="inputState" class="form-select">
                        <option selected>Loại xe</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="col">
                    {{-- <input type="text" class="form-control" placeholder="Bộ lọc" aria-label="Last name"> --}}
                    <!-- Button to Open Popup -->
                    {{-- <input type="text" class="form-control" data-toggle="modal" data-target="#filterModal" placeholder="Bộ lọc">
                        
                    </input> --}}

                    <div class="input-group">
                        <input type="button" class="form-control" value="Bộ lọc" aria-label="Filter" data-toggle="modal" data-target="#filterModal">
                        <span class="input-group-text" type="button" data-toggle="modal" data-target="#filterModal"><i class="bi bi-funnel-fill"></i></span>
                      </div>

                    <!-- Filterable Popup -->
                    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog"
                        aria-labelledby="filterModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="filterModalLabel">Lọc kết quả</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <h5 class="modal-title mt-2 mb-2">Danh mục</h5>
                                        <!-- Filter Input -->
                                        <select class="form-select">
                                            <option selected>Tất cả: Xe máy, Xe đạp điện</option>
                                            <option value="1">Xe đạp điện</option>
                                            <option value="2">Xe máy</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <h5 class="modal-title mt-4 mb-2">Giá từ</h5>
                                        <div>
                                            <input type="text" id="rangeSlider" name="rangeSlider" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h5 class="modal-title mt-4 mb-2">Sắp xếp theo</h5>
                                        <fieldset>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-6">
                                                    <i class="bi bi-clock"></i><span>
                                                        <label class="form-check-label" for="radioSort1">Tin mới nhất</label>    
                                                    </span>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end">
                                                    <input class="form-check-input" type="radio" name="radioSort" id="radioSort1" value="" aria-label="...">
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-6">
                                                    <i class="bi bi-tag"></i><span>
                                                        <label class="form-check-label" for="radioSort2">Giá thấp nhất</label>
                                                    </span>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end">
                                                    <input class="form-check-input" type="radio" name="radioSort" id="radioSort2" value="" aria-label="...">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="row">
                                        <h5 class="modal-title mt-4 mb-2">Bạn muốn</h5>
                                        <fieldset>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-6">
                                                    <i class="bi bi-receipt"></i><span>
                                                        <label class="form-check-label" for="radioAction1">Bán</label>    
                                                    </span>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end">
                                                    <input class="form-check-input" type="radio" name="radioAction" id="radioAction1" value="" aria-label="...">
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col-6">
                                                    <i class="bi bi-cart-plus"></i><span>
                                                        <label class="form-check-label" for="radioAction2">Mua</label>
                                                    </span>
                                                </div>
                                                <div class="col-6 d-flex justify-content-end">
                                                    <input class="form-check-input" type="radio" name="radioAction" id="radioAction2" value="" aria-label="...">
                                                </div>
                                            </div>
                                        </fieldset>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Apply Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 col-2 mx-auto">
                    <a name="" id="" class="btn btn-primary btn-block" href="#"
                        role="button">Tìm</a>
                </div>
            </div>
        </form>
        
    </div>
    
</div>


