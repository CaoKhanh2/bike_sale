<link rel="stylesheet" href="{{ asset('dashboard_src\src\plugins\dropzone\src\dropzone.css') }}">

<div class="container bg-light mt-4">
    <div class="row">
        <div class="col-6 px-5">
            <div class="row">
                <label for="my-awesome-dropzone" class="mt-4">
                    <h3>Hình ảnh của xe</h3>
                </label>
                <div class="mb-2">
                    <a href="#"><i class="bi bi-exclamation-circle-fill"></i> Chính sách của chúng tôi</a>
                </div>
                <form id="upload-form" class="dropzone" action="{{ route('dangkythumua') }}">
                    <input type="text" name="tenhang" id="hangxe"
                        class="form-control form-control-lg border border-3 border-primary" placeholder="Hãng xe"
                        hidden>
                    <button type="submit" hidden></button>
                </form>
                <div>
                    <p>Lưu ý khi tải ảnh lên:</p>
                    <p>-Đảm bảo rằng sản phẩm được hiển thị đầy đủ trong ảnh, bao gồm cả các chi tiết quan
                        trọng.
                        <br>-Đảm bảo ảnh bạn đăng lên là chất lượng cao và rõ ràng
                    </P>
                </div>
            </div>
        </div>
        <div class="col-6 px-4">
            <div class="row">
                <form id="form2" class="mt-5">
                    <div class="mt-5 mb-3">
                        <input type="hidden" class="userid" name="userid" id="mand" value="">
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
                        <input type="text" name="" id="diachi"
                            class="form-control form-control-lg border border-3 border-primary" placeholder="Địa chỉ">
                    </div>
                    <button type="button" onclick="submitForm2()" class="btn btn-primary">Submit data and
                        files!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm2() {
        // Lấy giá trị của trường nhập từ form2
        var hangxeValue = document.getElementById("Hangxe").value;
        var xuatxuValue = document.getElementById("Xuatxu").value;
        var giabanValue = document.getElementById("Giaban").value;
        var namdangkyValue = document.getElementById("Namdangky").value;
        // var diachiValue = document.getElementById("Diachi").value;

        // Thêm giá trị vào dropzone (upload-form)
        var dropzoneForm = document.getElementById("upload-form");

        var hangxeInput = document.createElement("input");
        hangxeInput.setAttribute("type", "hidden");
        hangxeInput.setAttribute("name", "hangxe");
        hangxeInput.setAttribute("value", hangxeValue);
        
        var xuatxuInput = document.createElement("input");
        xuatxuInput.setAttribute("type", "hidden");
        xuatxuInput.setAttribute("name", "xuatxu");
        xuatxuInput.setAttribute("value", xuatxuValue);

        var giabanInput = document.createElement("input");
        giabanInput.setAttribute("type", "hidden");
        giabanInput.setAttribute("name", "giaban");
        giabanInput.setAttribute("value", giabanValue);

        var namdangkyInput = document.createElement("input");
        namdangkyInput.setAttribute("type", "hidden");
        namdangkyInput.setAttribute("name", "namdangky");
        namdangkyInput.setAttribute("value", namdangkyValue);

        // var diachiInput = document.createElement("input");
        // diachiInput.setAttribute("type", "hidden");
        // diachiInput.setAttribute("name", "diachi");
        // diachiInput.setAttribute("value", diachiValue);


        dropzoneForm.append(hangxeInput,namdangkyInput, xuatxuInput, giabanInput);

        // Kích hoạt sự kiện submit của dropzone (upload-form)
        var submitButton = dropzoneForm.querySelector("button[type='submit']");
        submitButton.click();
    }
</script>







{{-- <div class="container bg-light">
    <form method="POST" action="{{ route('dangkythumua') }}" enctype="multipart/form-data">
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
                    <div>
                        <div class="dropzone">
                            <div class="fallback">
                                <input type="file" name="file" />
                            </div>
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
            <div class="col-7 mt-3">
                <div class="row">
                    <div class="mb-3">
                        <input type="hidden" class="userid" name="userid" id="mand" value="">
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
</div> --}}


<script src="{{ asset('dashboard_src/src/plugins/dropzone/src/dropzone.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(".dropzone").dropzone({
        addRemoveLinks: true,
        removedfile: function(file) {
            var name = file.name;
            var _ref;
            return (_ref = file.previewElement) != null ?
                _ref.parentNode.removeChild(file.previewElement) :
                void 0;
        },
    });
</script>
