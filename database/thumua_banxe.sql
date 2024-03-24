-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 24, 2024 lúc 10:14 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thumua_banxe`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `macv` varchar(5) NOT NULL,
  `tencv` varchar(20) NOT NULL,
  `mota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctgiohang`
--

CREATE TABLE `ctgiohang` (
  `mactgh` varchar(15) NOT NULL,
  `giohang_id` varchar(10) NOT NULL,
  `ttxemay_id` varchar(15) DEFAULT NULL,
  `ttxedapdien_id` varchar(15) DEFAULT NULL,
  `khuyenmai_id` varchar(5) DEFAULT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctkhohang`
--

CREATE TABLE `ctkhohang` (
  `id` varchar(10) NOT NULL,
  `khohang_id` varchar(5) NOT NULL,
  `ttxemay_id` varchar(15) DEFAULT NULL,
  `ttxedapdien_id` varchar(15) DEFAULT NULL,
  `tinhtrangxe` varchar(25) NOT NULL,
  `gianhapkho` decimal(12,2) DEFAULT NULL,
  `ngaynhapkho` date NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `magh` varchar(10) NOT NULL,
  `khachhang_id` varchar(10) NOT NULL,
  `vanchuyen_id` varchar(10) NOT NULL,
  `thanhtoan_id` varchar(15) NOT NULL,
  `ngaytao` datetime NOT NULL,
  `tonggiatien` decimal(12,2) NOT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hangxe`
--

CREATE TABLE `hangxe` (
  `mahx` varchar(5) NOT NULL,
  `tenhang` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `xuatxu` varchar(20) DEFAULT NULL,
  `trangthai` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `mahoadon` varchar(25) NOT NULL,
  `nhanvien_id` varchar(10) NOT NULL,
  `khachhang_id` varchar(10) NOT NULL,
  `ttxemay_id` varchar(15) DEFAULT NULL,
  `ttxedapdien_id` varchar(15) DEFAULT NULL,
  `ngaytaohoadon` datetime NOT NULL,
  `dongia` decimal(10,2) NOT NULL,
  `thuegt` decimal(10,2) DEFAULT NULL,
  `tonggiatrihoadon` decimal(12,2) NOT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `makh` varchar(10) NOT NULL,
  `hovaten` varchar(50) NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` enum('Nam','Nữ','Other') NOT NULL,
  `sodienthoai` varchar(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `diachi` varchar(100) DEFAULT NULL,
  `tentk` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `tinhtrang` bit(2) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khohang`
--

CREATE TABLE `khohang` (
  `makho` varchar(5) NOT NULL,
  `tenkhohang` varchar(25) NOT NULL,
  `diachi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `makhuyenmai` varchar(5) NOT NULL,
  `tenkhuyenmai` varchar(35) NOT NULL,
  `thoigiankhuyenmai` varchar(50) NOT NULL,
  `dieukienapdung` varchar(255) DEFAULT NULL,
  `motakhuyenmai` varchar(255) DEFAULT NULL,
  `thoigianbatdau` datetime NOT NULL,
  `thoigianketthuc` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaixe`
--

CREATE TABLE `loaixe` (
  `malx` varchar(15) NOT NULL,
  `tenloaixe` varchar(50) NOT NULL,
  `mota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_03_17_144947_create_chucvu_table', 1),
(2, '2024_03_09_020641_create_nhanvien_table', 2),
(3, '2014_10_12_000000_create_users_table', 3),
(4, '2014_10_12_100000_create_password_resets_table', 3),
(5, '2019_08_19_000000_create_failed_jobs_table', 3),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(7, '2024_03_09_022702_create_khachhang_table', 3),
(8, '2024_03_09_023742_create_loaixe_table', 3),
(9, '2024_03_09_110407_create_hangxe_table', 3),
(10, '2024_03_19_145358_create_thongtinxemay_table', 4),
(11, '2024_03_19_145412_create_thongtinxedapdien_table', 5),
(12, '2024_03_19_152836_create_vanchuyen_table', 5),
(13, '2024_03_23_154134_create_khohang_table', 5),
(14, '2024_03_23_154346_create_khuyenmai_table', 5),
(15, '2024_03_23_154406_create_thanhtoan_table', 6),
(16, '2024_03_23_160915_create_ruiro_table', 6),
(17, '2024_03_23_161353_create_giohang_table', 6),
(18, '2024_03_24_034813_create_ctgiohang_table', 6),
(19, '2024_03_24_035809_create_hoadon_table', 6),
(20, '2024_03_24_040537_create_phieunhap_table', 6),
(21, '2024_03_24_041555_create_phieuxuat_table', 6),
(22, '2024_03_24_042422_create_xedangkyban_table', 6),
(23, '2024_03_24_043153_create_ctkhohang_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manv` varchar(10) NOT NULL,
  `chucvu_id` varchar(5) NOT NULL,
  `hovaten` varchar(50) NOT NULL,
  `ngaysinh` date NOT NULL,
  `gioitinh` enum('Nam','Nữ','Other') NOT NULL,
  `sodienthoai` char(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `maphieunhap` varchar(20) NOT NULL,
  `khohang_id` varchar(10) NOT NULL,
  `ttxemay_id` varchar(15) DEFAULT NULL,
  `ttxedapdien_id` varchar(15) DEFAULT NULL,
  `nhanvien_id` varchar(10) NOT NULL,
  `ngaynhap` datetime NOT NULL,
  `dvt` varchar(10) DEFAULT NULL,
  `soluong` int(11) NOT NULL,
  `thanhtien` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieuxuat`
--

CREATE TABLE `phieuxuat` (
  `maphieuxuat` varchar(20) NOT NULL,
  `khohang_id` varchar(10) NOT NULL,
  `nhanvien_id` varchar(10) NOT NULL,
  `ngayxuat` date NOT NULL,
  `dvt` varchar(10) DEFAULT NULL,
  `soluong` int(11) NOT NULL,
  `thanhtien` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ruiro`
--

CREATE TABLE `ruiro` (
  `id` varchar(10) NOT NULL,
  `nhanvien_id` varchar(10) NOT NULL,
  `ttxemay_id` varchar(15) DEFAULT NULL,
  `ttxedapdien_id` varchar(15) DEFAULT NULL,
  `khachhang_id` varchar(20) NOT NULL,
  `ngaynhan` datetime NOT NULL,
  `ngaygiaiquyet` datetime DEFAULT NULL,
  `thongtinruiro` varchar(100) DEFAULT NULL,
  `trangthaigiaiquyet` bit(2) NOT NULL,
  `phanhoinguoidung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `mathanhtoan` varchar(255) NOT NULL,
  `phuongthucthanhtoan` varchar(20) NOT NULL,
  `trangthai` bit(2) NOT NULL,
  `ngaythanhtoan` datetime NOT NULL,
  `sotaikhoan` varchar(15) NOT NULL,
  `tennguoigui` varchar(50) NOT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinxedapdien`
--

CREATE TABLE `thongtinxedapdien` (
  `maxedapdien` varchar(15) NOT NULL,
  `loaixe_id` varchar(15) NOT NULL,
  `hangxe_id` varchar(5) NOT NULL,
  `dongxe` varchar(15) DEFAULT NULL,
  `trongluong` double(3,2) DEFAULT NULL,
  `loaipin` varchar(15) DEFAULT NULL,
  `phamvisudung` double(3,2) DEFAULT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `giaban` decimal(10,2) NOT NULL,
  `tinhtrang` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinxemay`
--

CREATE TABLE `thongtinxemay` (
  `maxemay` varchar(15) NOT NULL,
  `loaixe_id` varchar(15) NOT NULL,
  `hangxe_id` varchar(5) NOT NULL,
  `dongxe` varchar(15) DEFAULT NULL,
  `dungtichxe` varchar(5) DEFAULT NULL,
  `sokmdadi` double(6,2) DEFAULT NULL,
  `namdk` int(11) DEFAULT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `giaban` decimal(10,2) NOT NULL,
  `tinhtrang` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `matk` varchar(12) NOT NULL,
  `nhanvien_id` varchar(10) NOT NULL,
  `tentk` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phanquyen` enum('Quản trị viên','Nhân viên','Quản lý') NOT NULL,
  `trangthai` bit(2) NOT NULL,
  `ngaytao` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vanchuyen`
--

CREATE TABLE `vanchuyen` (
  `mavanchuyen` varchar(10) NOT NULL,
  `khachhang_id` varchar(10) NOT NULL,
  `trangthaivanchuyen` enum('Đã giao','Đang giao','Chưa được giao') NOT NULL,
  `ngaygui` date NOT NULL,
  `ngaynhan` date NOT NULL,
  `diachigiaohang` varchar(100) NOT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xedangkyban`
--

CREATE TABLE `xedangkyban` (
  `madkbanxe` varchar(30) NOT NULL,
  `ttxemay_id` varchar(15) DEFAULT NULL,
  `ttxedapdien_id` varchar(15) DEFAULT NULL,
  `khachhang_id` varchar(10) NOT NULL,
  `namdk` date NOT NULL,
  `dungtichxe` varchar(10) NOT NULL,
  `xuatxu` varchar(25) NOT NULL,
  `sokmdadi` double(6,2) NOT NULL,
  `giaban` decimal(10,2) NOT NULL,
  `motachitiet` text DEFAULT NULL,
  `trangthai` bit(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`macv`);

--
-- Chỉ mục cho bảng `ctgiohang`
--
ALTER TABLE `ctgiohang`
  ADD PRIMARY KEY (`mactgh`),
  ADD KEY `ctgiohang_giohang_id_foreign` (`giohang_id`),
  ADD KEY `ctgiohang_ttxemay_id_foreign` (`ttxemay_id`),
  ADD KEY `ctgiohang_ttxedapdien_id_foreign` (`ttxedapdien_id`),
  ADD KEY `ctgiohang_khuyenmai_id_foreign` (`khuyenmai_id`);

--
-- Chỉ mục cho bảng `ctkhohang`
--
ALTER TABLE `ctkhohang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ctkhohang_khohang_id_foreign` (`khohang_id`),
  ADD KEY `ctkhohang_ttxemay_id_foreign` (`ttxemay_id`),
  ADD KEY `ctkhohang_ttxedapdien_id_foreign` (`ttxedapdien_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`magh`),
  ADD KEY `giohang_khachhang_id_foreign` (`khachhang_id`),
  ADD KEY `giohang_vanchuyen_id_foreign` (`vanchuyen_id`),
  ADD KEY `giohang_thanhtoan_id_foreign` (`thanhtoan_id`);

--
-- Chỉ mục cho bảng `hangxe`
--
ALTER TABLE `hangxe`
  ADD PRIMARY KEY (`mahx`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahoadon`),
  ADD KEY `hoadon_nhanvien_id_foreign` (`nhanvien_id`),
  ADD KEY `hoadon_khachhang_id_foreign` (`khachhang_id`),
  ADD KEY `hoadon_ttxemay_id_foreign` (`ttxemay_id`),
  ADD KEY `hoadon_ttxedapdien_id_foreign` (`ttxedapdien_id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makh`);

--
-- Chỉ mục cho bảng `khohang`
--
ALTER TABLE `khohang`
  ADD PRIMARY KEY (`makho`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`makhuyenmai`);

--
-- Chỉ mục cho bảng `loaixe`
--
ALTER TABLE `loaixe`
  ADD PRIMARY KEY (`malx`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`),
  ADD KEY `nhanvien_chucvu_id_foreign` (`chucvu_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`maphieunhap`),
  ADD KEY `phieunhap_khohang_id_foreign` (`khohang_id`),
  ADD KEY `phieunhap_ttxemay_id_foreign` (`ttxemay_id`),
  ADD KEY `phieunhap_ttxedapdien_id_foreign` (`ttxedapdien_id`),
  ADD KEY `phieunhap_nhanvien_id_foreign` (`nhanvien_id`);

--
-- Chỉ mục cho bảng `phieuxuat`
--
ALTER TABLE `phieuxuat`
  ADD PRIMARY KEY (`maphieuxuat`),
  ADD KEY `phieuxuat_khohang_id_foreign` (`khohang_id`),
  ADD KEY `phieuxuat_nhanvien_id_foreign` (`nhanvien_id`);

--
-- Chỉ mục cho bảng `ruiro`
--
ALTER TABLE `ruiro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruiro_nhanvien_id_foreign` (`nhanvien_id`),
  ADD KEY `ruiro_khachhang_id_foreign` (`khachhang_id`),
  ADD KEY `ruiro_ttxemay_id_foreign` (`ttxemay_id`),
  ADD KEY `ruiro_ttxedapdien_id_foreign` (`ttxedapdien_id`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`mathanhtoan`);

--
-- Chỉ mục cho bảng `thongtinxedapdien`
--
ALTER TABLE `thongtinxedapdien`
  ADD PRIMARY KEY (`maxedapdien`),
  ADD KEY `thongtinxedapdien_loaixe_id_foreign` (`loaixe_id`),
  ADD KEY `thongtinxedapdien_hangxe_id_foreign` (`hangxe_id`);

--
-- Chỉ mục cho bảng `thongtinxemay`
--
ALTER TABLE `thongtinxemay`
  ADD PRIMARY KEY (`maxemay`),
  ADD KEY `thongtinxemay_loaixe_id_foreign` (`loaixe_id`),
  ADD KEY `thongtinxemay_hangxe_id_foreign` (`hangxe_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`matk`),
  ADD KEY `users_nhanvien_id_foreign` (`nhanvien_id`);

--
-- Chỉ mục cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD PRIMARY KEY (`mavanchuyen`),
  ADD KEY `vanchuyen_khachhang_id_foreign` (`khachhang_id`);

--
-- Chỉ mục cho bảng `xedangkyban`
--
ALTER TABLE `xedangkyban`
  ADD PRIMARY KEY (`madkbanxe`),
  ADD KEY `xedangkyban_khachhang_id_foreign` (`khachhang_id`),
  ADD KEY `xedangkyban_ttxemay_id_foreign` (`ttxemay_id`),
  ADD KEY `xedangkyban_ttxedapdien_id_foreign` (`ttxedapdien_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ctgiohang`
--
ALTER TABLE `ctgiohang`
  ADD CONSTRAINT `ctgiohang_giohang_id_foreign` FOREIGN KEY (`giohang_id`) REFERENCES `giohang` (`magh`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctgiohang_khuyenmai_id_foreign` FOREIGN KEY (`khuyenmai_id`) REFERENCES `khuyenmai` (`makhuyenmai`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctgiohang_ttxedapdien_id_foreign` FOREIGN KEY (`ttxedapdien_id`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctgiohang_ttxemay_id_foreign` FOREIGN KEY (`ttxemay_id`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ctkhohang`
--
ALTER TABLE `ctkhohang`
  ADD CONSTRAINT `ctkhohang_khohang_id_foreign` FOREIGN KEY (`khohang_id`) REFERENCES `khohang` (`makho`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctkhohang_ttxedapdien_id_foreign` FOREIGN KEY (`ttxedapdien_id`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctkhohang_ttxemay_id_foreign` FOREIGN KEY (`ttxemay_id`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_khachhang_id_foreign` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `giohang_thanhtoan_id_foreign` FOREIGN KEY (`thanhtoan_id`) REFERENCES `thanhtoan` (`mathanhtoan`) ON DELETE CASCADE,
  ADD CONSTRAINT `giohang_vanchuyen_id_foreign` FOREIGN KEY (`vanchuyen_id`) REFERENCES `vanchuyen` (`mavanchuyen`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_khachhang_id_foreign` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoadon_nhanvien_id_foreign` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoadon_ttxedapdien_id_foreign` FOREIGN KEY (`ttxedapdien_id`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoadon_ttxemay_id_foreign` FOREIGN KEY (`ttxemay_id`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_chucvu_id_foreign` FOREIGN KEY (`chucvu_id`) REFERENCES `chucvu` (`macv`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_khohang_id_foreign` FOREIGN KEY (`khohang_id`) REFERENCES `khohang` (`makho`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieunhap_nhanvien_id_foreign` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieunhap_ttxedapdien_id_foreign` FOREIGN KEY (`ttxedapdien_id`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieunhap_ttxemay_id_foreign` FOREIGN KEY (`ttxemay_id`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phieuxuat`
--
ALTER TABLE `phieuxuat`
  ADD CONSTRAINT `phieuxuat_khohang_id_foreign` FOREIGN KEY (`khohang_id`) REFERENCES `khohang` (`makho`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieuxuat_nhanvien_id_foreign` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ruiro`
--
ALTER TABLE `ruiro`
  ADD CONSTRAINT `ruiro_khachhang_id_foreign` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `ruiro_nhanvien_id_foreign` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE,
  ADD CONSTRAINT `ruiro_ttxedapdien_id_foreign` FOREIGN KEY (`ttxedapdien_id`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `ruiro_ttxemay_id_foreign` FOREIGN KEY (`ttxemay_id`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thongtinxedapdien`
--
ALTER TABLE `thongtinxedapdien`
  ADD CONSTRAINT `thongtinxedapdien_hangxe_id_foreign` FOREIGN KEY (`hangxe_id`) REFERENCES `hangxe` (`mahx`) ON DELETE CASCADE,
  ADD CONSTRAINT `thongtinxedapdien_loaixe_id_foreign` FOREIGN KEY (`loaixe_id`) REFERENCES `loaixe` (`malx`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thongtinxemay`
--
ALTER TABLE `thongtinxemay`
  ADD CONSTRAINT `thongtinxemay_hangxe_id_foreign` FOREIGN KEY (`hangxe_id`) REFERENCES `hangxe` (`mahx`) ON DELETE CASCADE,
  ADD CONSTRAINT `thongtinxemay_loaixe_id_foreign` FOREIGN KEY (`loaixe_id`) REFERENCES `loaixe` (`malx`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_nhanvien_id_foreign` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD CONSTRAINT `vanchuyen_khachhang_id_foreign` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `xedangkyban`
--
ALTER TABLE `xedangkyban`
  ADD CONSTRAINT `xedangkyban_khachhang_id_foreign` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `xedangkyban_ttxedapdien_id_foreign` FOREIGN KEY (`ttxedapdien_id`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `xedangkyban_ttxemay_id_foreign` FOREIGN KEY (`ttxemay_id`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
