<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CleanImagesController extends Controller
{
    public function cleanImgLogo()
    {
        $img_hangxe = DB::select('SELECT logo FROM hangxe');
        $files = Storage::files('public/logo');

        foreach ($files as $file) {
            // Lấy phần tên của tệp từ đường dẫn
            $filename = basename($file);

            // Biến để kiểm tra xem tệp có tồn tại trong cột logo của bảng hangxe không
            $found = false;

            // Kiểm tra xem tệp có tồn tại trong cột logo của bảng hangxe không
            foreach ($img_hangxe as $item) {
                if ('logo/' . $filename == $item->logo) {
                    // Tệp tồn tại trong cột logo của bảng hangxe
                    $found = true;
                    echo "Tên tệp: $filename - Giá trị trong cột logo: $item->logo<br>";
                    break;
                }
            }

            // Nếu tệp không tồn tại trong cột logo của bảng hangxe thì xóa ảnh
            if (!$found) {
                File::delete(storage_path('app/public/logo/' . $filename));
            }
        }
        echo "Xóa hoàn tất!";
    }

    public function cleanImgVehicle()
    {
        $img_hangxe = DB::select('SELECT hinhanh FROM thongtinxe');
        $files = Storage::files('public/images');

        foreach ($files as $file) {
            // Lấy phần tên của tệp từ đường dẫn
            $filename = basename($file);

            // Biến để kiểm tra xem tệp có tồn tại trong cột logo của bảng hangxe không
            $found = false;

            // Kiểm tra xem tệp có tồn tại trong cột logo của bảng hangxe không
            foreach ($img_hangxe as $item) {
                foreach (explode(',', $item->hinhanh) as $path) {
                    if ('images/' . $filename == $path) {
                        // Tệp tồn tại trong cột logo của bảng hangxe
                        $found = true;
                        echo "Tên tệp: $filename - Giá trị trong cột images: $path<br>";
                        break 2;
                    }
                }
            }

            // Nếu tệp không tồn tại trong cột logo của bảng hangxe thì xóa ảnh
            if (!$found) {
                File::delete(storage_path('app/public/images/' . $filename));
            }
        }

        echo "Xóa hoàn tất!";
    }
}
