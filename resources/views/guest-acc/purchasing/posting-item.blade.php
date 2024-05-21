<div class="container shadow">
      <form method="POST" action="{{ route('thuchien-dangkythumua-Guest')}}" id="formthumua" enctype="multipart/form-data">
        @csrf
        <div class="row p-4 justify-content-around">
            <div class="col-md-5 mt-3">
                <label>
                    <h3>Hình ảnh của xe</h3>
                </label>
                <div class="mb-2">
                    <a href="#"><i class="bi bi-exclamation-circle-fill"></i> Chính sách của chúng tôi</a>
                </div>
                <div class="form-group">
                    <div class="dropzone mb-3 border border-3 border-primary" action="{{ route('thuchien-dangkythumua-Guest')}}"  id="mydropzone">
                        <div class="fallback"> 

                        </div>
                    </div>
                    <div class="">
                        <p>Lưu ý khi tải ảnh lên:</p>
                        <p>-Đảm bảo rằng sản phẩm được hiển thị đầy đủ trong ảnh, bao gồm cả các chi tiết quan
                            trọng.
                            <br>-Đảm bảo ảnh bạn đăng lên là chất lượng cao và rõ ràng
                        </P>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="hidden" class="userid" name="userid" id="mand" value="">
                        <label for="loaixe" class="form-label">
                            <h3>Loại xe</h3>
                        </label>
                        <select class="form-select form-select-lg border border-3 border-primary" aria-label="Loại xe"
                            id="loaixe" name="loaixe">
                            <option value="Xe may">Xe máy</option>
                            <option value="Xe dap dien">Xe đạp điện</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <h3>Thông tin xe chi tiết</h3>
                    </div>
                    <div class="mb-4 form-group">
                        <input type="text" name="tenhang" id="Hangxe"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Hãng xe">
                    </div>
                    <div class="mb-4 form-group">
                        <input type="text" name="namdangky" id="Namdangky"
                            class="form-control form-control-lg border border-3 border-primary"
                            placeholder="Năm đăng ký">
                    </div>
                    <div class="mb-4 form-group">
                        <input type="text" name="xuatxu" id="Xuatxu"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Xuất xứ">
                    </div>
                    <div class="mb-4 form-group">
                        <input type="text" name="giaban" id="Giaban"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Giá bán">
                    </div>
                    <div class="mb-2">
                        <h3>Mô tả cho xe</h3>
                    </div>
                    <div class="mb-4 form-group">
                        <textarea class="form-control border border-3 border-primary" style="height: 200px" placeholder="Mô tả sản phẩm"
                            name="mota"></textarea>
                    </div>
                    <div class="mb-2">
                        <h3>Thông tin người bán</h3>
                    </div>
                    <div class="mb-4 form-group">
                        <input type="text" name="diachi" id="diachi"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Địa chỉ">
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <button type="submit"  class="btn-primary btn col-12">Đăng ký</button>
            </div>
        </div>
    </form>
</div>