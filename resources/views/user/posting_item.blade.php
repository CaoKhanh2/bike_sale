<div class="container bg-light">
    <form method="POST" action="{{ route('dangkythumua') }}">
        @csrf
        <div class="row justify-content-around">
            <div class="col-4 mt-3">
                <label for="my-awesome-dropzone">
                    <h3>Hình ảnh của xe</h3>
                </label>
                <div class="mb-2">
                    <a href="#"><i class="bi bi-exclamation-circle-fill"></i> Chính sách của chúng tôi</a>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Hình ảnh</label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="images" name="anh[]" multiple>
                            <label class="custom-file-label">Chọn ảnh</label>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p>Lưu ý khi tải ảnh lên:</p>
                    <p>-Đảm bảo rằng sản phẩm được hiển thị đầy đủ trong ảnh, bao gồm cả các chi tiết quan trọng.
                        <br>-Đảm bảo ảnh bạn đăng lên là chất lượng cao và rõ ràng
                    </P>
                </div>
            </div>
            <div class="col-7 mt-3">
                <div class="row">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">
                            <h3>Loại xe</h3>
                        </label>
                        <select class="form-select form-select-lg border border-3 border-primary" aria-label="Loại xe"
                            id="loaixe" name="loaixe">
                            <option value="Xemay">Xe máy</option>
                            <option value="Xedapdien">Xe đạp điện</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <h3>Thông tin xe chi tiết</h3>
                    </div>
                    <div class="mb-4">
                        <input type="text" name="tenhang" id="Hangxe"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Hãng xe">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="namdangky" id="Namdangky"
                            class="form-control form-control-lg border border-3 border-primary"
                            placeholder="Năm đăng ký">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="xuatxu" id="Xuatxu"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Xuất xứ">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="giaban" id="Giaban"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Giá bán">
                    </div>

                    <div class="mb-2">
                        <h3>Tiêu đề & Nội dung</h3>
                    </div>
                    <div class="mb-4">
                        <input type="text" name="Tên hãng xe" id="Hangxe"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Tiêu đề">
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control border border-3 border-primary" style="height: 200px" placeholder="Mô tả sản phẩm"
                            name="mota"></textarea>
                    </div>
                    <div class="mb-2">
                        <h3>Thông tin người bán</h3>
                    </div>
                    <div class="mb-4">
                        <input type="text" name="Địa chỉ" id="Hangxe"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Địa chỉ">
                    </div>

                </div>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn-primary btn col-12">Đăng ký</button>
            </div>
        </div>
    </form>
</div>
