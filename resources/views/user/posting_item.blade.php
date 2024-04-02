<div class="container bg-light">
    <form action="">
        <div class="clearfix">
            <div class="pull-left">
                <h1 class="text-primary text-center">Đăng ký bán xe</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <label for="my-awesome-dropzone">Hình ảnh của xe</label>
                <div class="dropzone mb-3" action="#" id="my-awesome-dropzone">
                    <div class="fallback">
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Loại xe</label>
                        <select class="form-select form-select-lg" aria-label="Loại xe" id="loaixe">
                            <option value="Xemay">Xe máy</option>
                            <option value="Xedapdien">Xe đạp điện</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <h2>Thông tin chi tiết</h2>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="Tên hãng xe" id="Hangxe" class="form-control form-control-lg"
                            placeholder="Hãng xe">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="Năm đăng ký" id="Namdangky" class="form-control form-control-lg"
                            placeholder="Năm đăng ký">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="Tên hãng xe" id="Xuatxu" class="form-control form-control-lg"
                            placeholder="Xuất xứ">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="Tên hãng xe" id="Giaban" class="form-control form-control-lg"
                            placeholder="Giá bán">
                    </div>

                    <div class="mb-2">
                        <h2>Thông tin chi tiết</h2>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="Tên hãng xe" id="Hangxe" class="form-control form-control-lg"
                            placeholder="Tiêu đề">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" style="height: 200px"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Đăng ký" class="btn-primary btn col-12">
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
