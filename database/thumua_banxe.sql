-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 13, 2024 lúc 05:06 PM
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

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`macv`, `tencv`, `mota`) VALUES
('CV-01', 'Nhân viên bán hàng', NULL),
('CV-02', 'Quản lý', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctgiohang`
--

CREATE TABLE `ctgiohang` (
  `mactgh` varchar(15) NOT NULL,
  `magh` varchar(10) NOT NULL,
  `maxemay` varchar(15) DEFAULT NULL,
  `maxedapdien` varchar(15) DEFAULT NULL,
  `makhuyemai` varchar(5) DEFAULT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctkhohang`
--

CREATE TABLE `ctkhohang` (
  `id` varchar(10) NOT NULL,
  `makho` varchar(5) NOT NULL,
  `maxemay` varchar(15) DEFAULT NULL,
  `maxedapdien` varchar(15) DEFAULT NULL,
  `tinhtrangxe` varchar(25) NOT NULL,
  `gianhapkho` decimal(12,2) DEFAULT NULL,
  `ngaynhapkho` date NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongxe`
--

CREATE TABLE `dongxe` (
  `madx` varchar(10) NOT NULL,
  `mahx` varchar(5) NOT NULL,
  `loaixe` varchar(15) NOT NULL,
  `tendongxe` varchar(50) NOT NULL,
  `mota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dongxe`
--

INSERT INTO `dongxe` (`madx`, `mahx`, `loaixe`, `tendongxe`, `mota`) VALUES
('DX01', 'HX01', 'Xe máy', 'Honda Vision', ''),
('DX02', 'HX01', 'Xe máy', 'Honda Lead', ''),
('DX03', 'HX01', 'Xe máy', 'Honda Air Blade', ''),
('DX04', 'HX01', 'Xe máy', 'Honda Wade', ''),
('DX05', 'HX01', 'Xe máy', 'Honda Winner', ''),
('DX06', 'HX02', 'Xe máy', 'Yamaha Grande', ''),
('DX07', 'HX02', 'Xe máy', 'Yamaha Janus', ''),
('DX08', 'HX02', 'Xe máy', 'Yamaha Exciter', ''),
('DX09', 'HX03', 'Xe máy', 'Suzuki Raider', ''),
('DX10', 'HX06', 'Xe đạp điện', 'Dibao Ninja', NULL);

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
  `makh` varchar(10) NOT NULL,
  `mavanchuyen` varchar(10) NOT NULL,
  `mathanhtoan` varchar(15) NOT NULL,
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
  `trangthai` bit(2) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hangxe`
--

INSERT INTO `hangxe` (`mahx`, `tenhang`, `logo`, `xuatxu`, `trangthai`) VALUES
('HX01', 'Honda', 'logo/1tn9ItyGxFkqfopG9xgLYpBvJajxhc2T5Z0uKPvA.png', 'Nhật Bản', b'01'),
('HX02', 'Yamaha', 'logo/41tPs6nxGdpgGmip6lcOKXKPiPmQU6hwVhEXuMZt.png', 'Nhật Bản', b'01'),
('HX03', 'Suzuki', 'logo/dVfOI7O8B2gIt7Xn6KRCDGLb2bat4C5cN0IXiLMI.png', 'Nhật Bản', b'01'),
('HX04', 'Sym', 'logo/AhzP3gLYlGsHV9oVrqdWWWVvYwghD6D7BBGvTpvP.png', 'Đài Loan', b'01'),
('HX05', 'Dibao', 'logo/27GeenWeyTUOM0D5wheneR2kIjweWNRetGiwP9bM.png', 'Đài Loan', b'01'),
('HX06', 'Asama', 'logo/OqqpDaoiNbyS1CD0IrcFESENN9uLQLIPkSJaVukl.png', 'Đài Loan', b'01'),
('HX07', 'vidu', 'logo/jzDtZEe1zg1UNjFDYMHbaDDreaCpofZaTRsEj8fr.png', 'Đài Loan', b'01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `mahoadon` varchar(25) NOT NULL,
  `manv` varchar(10) NOT NULL,
  `makh` varchar(10) NOT NULL,
  `maxemay` varchar(15) DEFAULT NULL,
  `maxedapdien` varchar(15) DEFAULT NULL,
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
  `tinhtrang` bit(2) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`makh`, `hovaten`, `ngaysinh`, `gioitinh`, `sodienthoai`, `email`, `diachi`, `tentk`, `password`, `tinhtrang`) VALUES
('MKH-0001', 'Cố Trung Kiên', '2002-10-30', 'Nam', '0973951289', 'kien87637@st.vimaru.edu.vn', '160 Kamille Land Apt. 534', NULL, NULL, b'01'),
('MKH-0851', 'Miss Loren Morar', '1990-08-11', 'Nam', '09798637053', 'morar.keely@example.com', '5512 Sedrick Knolls Suite 471', NULL, NULL, b'01'),
('MKH-1017', 'Ms. Aimee Deckow', '2015-08-17', 'Nữ', '04756442184', 'tgoyette@example.net', '13884 Batz Lake Apt. 156', NULL, NULL, b'00'),
('MKH-2697', 'Bessie Nolan', '1991-05-14', 'Other', '03148225197', 'damore.russel@example.net', '70206 Lon Summit Suite 781', NULL, NULL, b'01'),
('MKH-3212', 'Prof. Ayana Reynolds III', '2008-10-29', 'Nam', '02439967588', 'hoeger.gerard@example.com', '96283 O\'Keefe Village Apt. 513', NULL, NULL, b'00'),
('MKH-3300', 'Roslyn Herman', '1971-01-23', 'Nữ', '01495490975', 'kristoffer.metz@example.com', '75074 Harber Hills Suite 257', NULL, NULL, b'00'),
('MKH-3559', 'Lelah Pagac', '2017-09-05', 'Nam', '00934376296', 'prudence.romaguera@example.org', '58097 Elmore Hills Apt. 254', NULL, NULL, b'00'),
('MKH-3940', 'Dr. Hilma Hartmann I', '1974-12-15', 'Other', '09245910270', 'xcorkery@example.com', '8161 Nienow View Apt. 776', NULL, NULL, b'00'),
('MKH-4061', 'Pasquale Nitzsche', '1991-11-01', 'Nữ', '09825419758', 'yundt.markus@example.com', '571 Camille Mountain', NULL, NULL, b'00'),
('MKH-4346', 'Russel Gerlach', '1979-04-16', 'Nam', '08333945179', 'peyton.botsford@example.net', '589 Cullen Parkways', NULL, NULL, b'01'),
('MKH-4558', 'Felipa Vandervort', '2001-05-15', 'Nam', '02150877487', 'drunolfsdottir@example.org', '3628 Sawayn Groves Apt. 374', NULL, NULL, b'01'),
('MKH-4636', 'Deborah Doyle', '2019-01-27', 'Nam', '06235669474', 'gregg69@example.net', '117 Bartell Forest', NULL, NULL, b'01'),
('MKH-4793', 'Ramon Stanton', '2002-01-19', 'Nữ', '08456526795', 'utremblay@example.com', '89965 Alda Forges Apt. 269', NULL, NULL, b'01'),
('MKH-7191', 'Edwardo Lemke', '1996-10-26', 'Nữ', '09384580685', 'zack.strosin@example.com', '31086 Jonatan Road', NULL, NULL, b'00'),
('MKH-8547', 'Mr. Ibrahim Wehner PhD', '1988-07-31', 'Other', '00247832170', 'laury00@example.com', '65730 Olson Forks Suite 542', NULL, NULL, b'01'),
('MKH-9902', 'Prof. Rozella Koepp V', '1987-04-13', 'Nam', '09221946329', 'konopelski.keegan@example.net', '160 Kamille Land Apt. 534', NULL, NULL, b'01'),
('MKH-9958', 'Mr. Zakary Rolfson', '2005-04-28', 'Nam', '04370866960', 'haylie.streich@example.org', '780 Thompson Estate Suite 899', NULL, NULL, b'00');

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
  `macv` varchar(5) NOT NULL,
  `hovaten` varchar(50) NOT NULL,
  `ngaysinh` date NOT NULL,
  `gioitinh` enum('Nam','Nữ','Other') NOT NULL,
  `sodienthoai` char(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `macv`, `hovaten`, `ngaysinh`, `gioitinh`, `sodienthoai`, `email`, `diachi`, `ghichu`) VALUES
('MNV-280', 'CV-01', 'Cleora Bergstrom I', '1971-02-20', 'Other', '08751728679', 'rbode@example.com', '578 Thiel Turnpike Apt. 365', 'Blanditiis impedit totam rerum eaque.'),
('MNV-398', 'CV-01', 'Brook Halvorson MD', '1999-10-29', 'Other', '00149987204', 'watsica.rodolfo@example.org', '9234 Schaden Ways', 'Quo praesentium enim earum consequuntur ut.'),
('MNV-473', 'CV-02', 'Prof. Ryder West', '1997-04-15', 'Nữ', '07486853582', 'odickens@example.net', '86284 Ella Park Apt. 515', 'Natus ipsam porro sed sed.'),
('MNV-522', 'CV-01', 'Rebeca Lemke', '2000-10-13', 'Other', '02032439299', 'osinski.muhammad@example.net', '64511 Connelly Mission Suite 975', 'Non adipisci nam eveniet sunt nobis.'),
('MNV-612', 'CV-01', 'Daron Bergnaum MD', '1983-12-25', 'Nữ', '07090800279', 'jay28@example.net', '57262 Bosco Flat', 'Dolores deserunt labore delectus consequuntur assumenda.'),
('MNV-617', 'CV-01', 'Adrianna Mante', '1995-05-03', 'Nữ', '05657535773', 'nwiza@example.org', '2782 Wintheiser Forges Apt. 154', 'Illo corporis assumenda odio optio.'),
('MNV-651', 'CV-01', 'Lionel Walter', '1994-02-08', 'Other', '02669449833', 'knolan@example.net', '701 Kreiger Park Apt. 261', 'Optio aut distinctio tempore qui.'),
('MNV-758', 'CV-01', 'Palma Hammes DVM', '2000-10-28', 'Nam', '01902217640', 'veda.bradtke@example.org', '1151 Paolo Ville Apt. 196', 'Commodi porro sint pariatur.'),
('MNV-839', 'CV-01', 'Lulu Reinger', '1998-06-04', 'Other', '07504618610', 'handerson@example.net', '223 Davis Pass Apt. 593', 'Fugit earum nesciunt iure.'),
('MNV-977', 'CV-02', 'Hector Gutmann', '2001-12-30', 'Other', '04389397436', 'nicolas.ricardo@example.org', '381 Hammes Manor Apt. 992', 'Sequi quas dolores eos.');

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
  `makho` varchar(10) NOT NULL,
  `maxemay` varchar(15) DEFAULT NULL,
  `maxedapdien` varchar(15) DEFAULT NULL,
  `manv` varchar(10) NOT NULL,
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
  `makho` varchar(10) NOT NULL,
  `manv` varchar(10) NOT NULL,
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
  `manv` varchar(10) NOT NULL,
  `maxemay` varchar(15) DEFAULT NULL,
  `maxedapdien` varchar(15) DEFAULT NULL,
  `makh` varchar(20) NOT NULL,
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
  `madx` varchar(10) DEFAULT NULL,
  `mahx` varchar(5) DEFAULT NULL,
  `tenxe` varchar(15) DEFAULT NULL,
  `trongluong` double(4,2) DEFAULT NULL,
  `acquy` varchar(25) NOT NULL,
  `dongcodien` varchar(10) NOT NULL,
  `sacdien` varchar(15) NOT NULL,
  `phamvisudung` varchar(35) DEFAULT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  `giaban` decimal(10,2) NOT NULL,
  `tinhtrang` bit(2) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtinxedapdien`
--

INSERT INTO `thongtinxedapdien` (`maxedapdien`, `madx`, `mahx`, `tenxe`, `trongluong`, `acquy`, `dongcodien`, `sacdien`, `phamvisudung`, `hinhanh`, `giaban`, `tinhtrang`) VALUES
('XE-0003', 'DX10', 'HX05', 'Dibao Ninja', 25.00, '4 acquy 12A', '500w', '8-10h', '45 - 50km/ 1 lần sạc đầy pin', 'images/hQDUy8L7gVRokOOUaiYhICA3X6NASDF9CjaPEUQm.jpg,images/SFA2OyizYzTRUporhQ2s9oUrpMWS6AN7G0ibmXNC.jpg', 8800000.00, b'01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinxemay`
--

CREATE TABLE `thongtinxemay` (
  `maxemay` varchar(15) NOT NULL,
  `madx` varchar(10) DEFAULT NULL,
  `mahx` varchar(5) DEFAULT NULL,
  `tenxe` varchar(35) DEFAULT NULL,
  `dungtichxe` varchar(15) DEFAULT NULL,
  `sokmdadi` double(6,2) DEFAULT NULL,
  `namdk` int(11) DEFAULT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `giaban` decimal(10,2) NOT NULL,
  `tinhtrang` bit(2) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtinxemay`
--

INSERT INTO `thongtinxemay` (`maxemay`, `madx`, `mahx`, `tenxe`, `dungtichxe`, `sokmdadi`, `namdk`, `hinhanh`, `giaban`, `tinhtrang`) VALUES
('XE-0001', 'DX01', 'HX01', 'Honda Vision 110cc', '109,5 cm3', 200.00, 2023, 'images/YhUKYdIJ2BS6aWorlYF6vcU0Dh8e9Cab7kmx6imr.jpg,images/TDhZlorRXWfFPBT0hMAtip7adNPfx3S74YinDcr3.jpg,images/9TQXhzX3xGStguwDYzFnRoMF7o0zqOflMpDhIYkm.jpg,images/zKQc1YhkW3w2qE5CLKpl8yPGS7JK8QbfmGQHo3lQ.jpg', 21000000.00, b'01'),
('XE-0002', 'DX05', 'HX01', 'Honda Winner X 2023', '149,1 cm3', 210.00, 2023, 'images/Fk2OIboxOb0CXn7Mb0tqFeaEmWIei6LvE6XeNWzX.webp,images/AWCgNvitDVWeSvHKzvqJrOhsVLpneMT4OSk1lIQA.webp,images/wbV3biGXwRCbpmRvuOgE1uFpsQjYEiVcmU5m59Fe.webp,images/iRvqqYIShsC5JPENqnRAGBvgvwYuoza1PniWKCav.webp', 30000000.00, b'01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `matk` varchar(12) NOT NULL,
  `manv` varchar(10) NOT NULL,
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
  `makh` varchar(10) NOT NULL,
  `trangthaivanchuyen` enum('Đã giao','Đang giao','Chưa được giao') NOT NULL,
  `ngaygui` date NOT NULL,
  `ngaynhan` date NOT NULL,
  `diachigiaohang` varchar(100) NOT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vanchuyen`
--

INSERT INTO `vanchuyen` (`mavanchuyen`, `makh`, `trangthaivanchuyen`, `ngaygui`, `ngaynhan`, `diachigiaohang`, `ghichu`) VALUES
('DVC-03679', 'MKH-4558', 'Đã giao', '2024-03-11', '2024-03-22', '7782 Hayes Circles\nErlingtown, WA 00436', 'Nostrum in et sed cumque odio.'),
('DVC-06799', 'MKH-3300', 'Đã giao', '2024-03-30', '2024-03-22', '52200 Demarco Cliffs\nBrycenberg, NM 37692', 'Debitis amet eveniet sed deserunt ullam rerum.'),
('DVC-07177', 'MKH-4793', 'Chưa được giao', '2024-03-25', '2024-03-12', '33299 Billy Club\nNew Kody, NC 70318-5228', 'Quam recusandae necessitatibus doloremque quia.'),
('DVC-09643', 'MKH-1017', 'Chưa được giao', '2024-03-27', '2024-04-01', '8463 Teagan Motorway Apt. 894\nNorth Joanne, FL 68177', 'Vero sit est dolores quas natus.'),
('DVC-10090', 'MKH-2697', 'Đang giao', '2024-04-03', '2024-04-10', '3696 Brown Brook\nRowanborough, OK 44550-8705', 'Dolorem sequi cumque qui quidem minima quo similique et.'),
('DVC-12384', 'MKH-1017', 'Đang giao', '2024-03-16', '2024-04-13', '2709 Leland Fields\nWest Kimberly, AZ 26661-4787', 'Voluptate dicta in architecto amet et dolorum.'),
('DVC-21026', 'MKH-4793', 'Đang giao', '2024-03-12', '2024-04-17', '920 Mayert Vista\nPort Pansyside, OR 45290', 'Sit sunt ullam nobis vel voluptates est.'),
('DVC-21053', 'MKH-3212', 'Đã giao', '2024-03-26', '2024-04-16', '95541 Dietrich Drive\nMarilyneside, AZ 49167-9467', 'Molestiae neque at vel quibusdam.'),
('DVC-26437', 'MKH-4346', 'Đã giao', '2024-04-01', '2024-04-03', '733 Rippin Parkway Apt. 682\nKautzerburgh, NM 14968-9931', 'Nesciunt est voluptatem assumenda cumque.'),
('DVC-26986', 'MKH-3300', 'Đang giao', '2024-03-12', '2024-03-14', '3478 Mortimer Greens\nTrantowton, TN 28929', 'Veniam id impedit placeat sint similique consequatur.'),
('DVC-28891', 'MKH-9902', 'Chưa được giao', '2024-04-01', '2024-03-26', '98789 Margot Parkways Apt. 127\nGibsonshire, MA 25690', 'Nemo dolor qui explicabo sapiente omnis.'),
('DVC-31891', 'MKH-9958', 'Đang giao', '2024-03-24', '2024-04-18', '4170 Johnston Port Apt. 437\nWisozkfurt, TX 40989', 'Voluptatem similique illum a accusantium.'),
('DVC-34016', 'MKH-9902', 'Đang giao', '2024-04-06', '2024-04-08', '701 Earnestine Brook Apt. 063\nNorth Isai, CA 91846', 'Minus saepe aliquam corporis et.'),
('DVC-37210', 'MKH-9958', 'Đang giao', '2024-03-19', '2024-03-26', '102 Harris Lodge Suite 959\nPort Annabelle, VA 27239', 'Quis maiores consectetur et in.'),
('DVC-42418', 'MKH-0851', 'Đã giao', '2024-03-25', '2024-03-15', '3591 Romaguera Crescent\nSilasberg, WA 46849-3983', 'Ullam vel vel maxime rem.'),
('DVC-42578', 'MKH-1017', 'Chưa được giao', '2024-04-02', '2024-03-28', '3703 Bayer Hollow Apt. 166\nLindfort, MO 53704', 'Ut quia sequi eius sed et consequatur ducimus.'),
('DVC-64850', 'MKH-8547', 'Chưa được giao', '2024-03-20', '2024-04-02', '703 Wuckert River\nNew Elinore, RI 58385-3996', 'Dolores corrupti qui quibusdam aliquam facere.'),
('DVC-68007', 'MKH-1017', 'Đã giao', '2024-03-16', '2024-03-25', '71582 Evalyn Villages\nSouth Kattieberg, VT 79928', 'Nulla impedit qui nostrum tenetur voluptatem.'),
('DVC-75523', 'MKH-3212', 'Đang giao', '2024-03-09', '2024-03-22', '33753 Blanda Fields Apt. 958\nWest Raquelshire, WI 58894', 'Explicabo aut velit et sunt in fuga.'),
('DVC-76884', 'MKH-4636', 'Đang giao', '2024-04-01', '2024-04-15', '7903 Tatum Oval Suite 611\nFritzland, OR 78946-7837', 'Enim est est enim eaque quo quidem voluptas.'),
('DVC-93563', 'MKH-1017', 'Chưa được giao', '2024-03-20', '2024-04-18', '73253 Crooks Land\nWest Ramiro, WA 62498', 'Repellendus ipsam qui excepturi fuga.');

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
  `xuatxu` varchar(25) NOT NULL,
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
  ADD KEY `ctgiohang_giohang_id_foreign` (`magh`),
  ADD KEY `ctgiohang_ttxemay_id_foreign` (`maxemay`),
  ADD KEY `ctgiohang_ttxedapdien_id_foreign` (`maxedapdien`),
  ADD KEY `ctgiohang_khuyenmai_id_foreign` (`makhuyemai`);

--
-- Chỉ mục cho bảng `ctkhohang`
--
ALTER TABLE `ctkhohang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ctkhohang_khohang_id_foreign` (`makho`),
  ADD KEY `ctkhohang_ttxemay_id_foreign` (`maxemay`),
  ADD KEY `ctkhohang_ttxedapdien_id_foreign` (`maxedapdien`);

--
-- Chỉ mục cho bảng `dongxe`
--
ALTER TABLE `dongxe`
  ADD PRIMARY KEY (`madx`),
  ADD KEY `dongxe_ibfk_1` (`mahx`);

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
  ADD KEY `giohang_khachhang_id_foreign` (`makh`),
  ADD KEY `giohang_vanchuyen_id_foreign` (`mavanchuyen`),
  ADD KEY `giohang_thanhtoan_id_foreign` (`mathanhtoan`);

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
  ADD KEY `hoadon_nhanvien_id_foreign` (`manv`),
  ADD KEY `hoadon_khachhang_id_foreign` (`makh`),
  ADD KEY `hoadon_ttxemay_id_foreign` (`maxemay`),
  ADD KEY `hoadon_ttxedapdien_id_foreign` (`maxedapdien`);

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
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manv`),
  ADD KEY `macv` (`macv`);

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
  ADD KEY `phieunhap_ttxemay_id_foreign` (`maxemay`),
  ADD KEY `phieunhap_ttxedapdien_id_foreign` (`maxedapdien`),
  ADD KEY `phieunhap_nhanvien_id_foreign` (`manv`),
  ADD KEY `makho` (`makho`);

--
-- Chỉ mục cho bảng `phieuxuat`
--
ALTER TABLE `phieuxuat`
  ADD PRIMARY KEY (`maphieuxuat`),
  ADD KEY `phieuxuat_khohang_id_foreign` (`makho`),
  ADD KEY `phieuxuat_nhanvien_id_foreign` (`manv`);

--
-- Chỉ mục cho bảng `ruiro`
--
ALTER TABLE `ruiro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruiro_nhanvien_id_foreign` (`manv`),
  ADD KEY `ruiro_khachhang_id_foreign` (`makh`),
  ADD KEY `ruiro_ttxemay_id_foreign` (`maxemay`),
  ADD KEY `ruiro_ttxedapdien_id_foreign` (`maxedapdien`);

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
  ADD KEY `thongtinxedapdien_hangxe_id_foreign` (`mahx`),
  ADD KEY `loaixe_id` (`madx`);

--
-- Chỉ mục cho bảng `thongtinxemay`
--
ALTER TABLE `thongtinxemay`
  ADD PRIMARY KEY (`maxemay`),
  ADD KEY `thongtinxemay_hangxe_id_foreign` (`mahx`),
  ADD KEY `loaixe_id` (`madx`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`matk`),
  ADD KEY `users_nhanvien_id_foreign` (`manv`);

--
-- Chỉ mục cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD PRIMARY KEY (`mavanchuyen`),
  ADD KEY `vanchuyen_khachhang_id_foreign` (`makh`);

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
  ADD CONSTRAINT `ctgiohang_giohang_id_foreign` FOREIGN KEY (`magh`) REFERENCES `giohang` (`magh`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctgiohang_khuyenmai_id_foreign` FOREIGN KEY (`makhuyemai`) REFERENCES `khuyenmai` (`makhuyenmai`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctgiohang_ttxedapdien_id_foreign` FOREIGN KEY (`maxedapdien`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctgiohang_ttxemay_id_foreign` FOREIGN KEY (`maxemay`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ctkhohang`
--
ALTER TABLE `ctkhohang`
  ADD CONSTRAINT `ctkhohang_khohang_id_foreign` FOREIGN KEY (`makho`) REFERENCES `khohang` (`makho`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctkhohang_ttxedapdien_id_foreign` FOREIGN KEY (`maxedapdien`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `ctkhohang_ttxemay_id_foreign` FOREIGN KEY (`maxemay`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `dongxe`
--
ALTER TABLE `dongxe`
  ADD CONSTRAINT `dongxe_ibfk_1` FOREIGN KEY (`mahx`) REFERENCES `hangxe` (`mahx`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_khachhang_id_foreign` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `giohang_thanhtoan_id_foreign` FOREIGN KEY (`mathanhtoan`) REFERENCES `thanhtoan` (`mathanhtoan`) ON DELETE CASCADE,
  ADD CONSTRAINT `giohang_vanchuyen_id_foreign` FOREIGN KEY (`mavanchuyen`) REFERENCES `vanchuyen` (`mavanchuyen`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_khachhang_id_foreign` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoadon_nhanvien_id_foreign` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoadon_ttxedapdien_id_foreign` FOREIGN KEY (`maxedapdien`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `hoadon_ttxemay_id_foreign` FOREIGN KEY (`maxemay`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`macv`) REFERENCES `chucvu` (`macv`);

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`makho`) REFERENCES `khohang` (`makho`),
  ADD CONSTRAINT `phieunhap_khohang_id_foreign` FOREIGN KEY (`makho`) REFERENCES `khohang` (`makho`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieunhap_nhanvien_id_foreign` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieunhap_ttxedapdien_id_foreign` FOREIGN KEY (`maxedapdien`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieunhap_ttxemay_id_foreign` FOREIGN KEY (`maxemay`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phieuxuat`
--
ALTER TABLE `phieuxuat`
  ADD CONSTRAINT `phieuxuat_khohang_id_foreign` FOREIGN KEY (`makho`) REFERENCES `khohang` (`makho`) ON DELETE CASCADE,
  ADD CONSTRAINT `phieuxuat_nhanvien_id_foreign` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ruiro`
--
ALTER TABLE `ruiro`
  ADD CONSTRAINT `ruiro_khachhang_id_foreign` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `ruiro_nhanvien_id_foreign` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE,
  ADD CONSTRAINT `ruiro_ttxedapdien_id_foreign` FOREIGN KEY (`maxedapdien`) REFERENCES `thongtinxedapdien` (`maxedapdien`) ON DELETE CASCADE,
  ADD CONSTRAINT `ruiro_ttxemay_id_foreign` FOREIGN KEY (`maxemay`) REFERENCES `thongtinxemay` (`maxemay`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `thongtinxedapdien`
--
ALTER TABLE `thongtinxedapdien`
  ADD CONSTRAINT `thongtinxedapdien_hangxe_id_foreign` FOREIGN KEY (`mahx`) REFERENCES `hangxe` (`mahx`) ON DELETE CASCADE,
  ADD CONSTRAINT `thongtinxedapdien_ibfk_1` FOREIGN KEY (`madx`) REFERENCES `dongxe` (`madx`);

--
-- Các ràng buộc cho bảng `thongtinxemay`
--
ALTER TABLE `thongtinxemay`
  ADD CONSTRAINT `thongtinxemay_hangxe_id_foreign` FOREIGN KEY (`mahx`) REFERENCES `hangxe` (`mahx`) ON DELETE CASCADE,
  ADD CONSTRAINT `thongtinxemay_ibfk_1` FOREIGN KEY (`madx`) REFERENCES `dongxe` (`madx`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_nhanvien_id_foreign` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD CONSTRAINT `vanchuyen_khachhang_id_foreign` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE;

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
