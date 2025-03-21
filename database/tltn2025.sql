-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 21, 2025 lúc 02:34 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tltn2025`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `User_id` int(11) NOT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhoneNumber` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RegisterTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`User_id`, `lastName`, `firstName`, `Email`, `PhoneNumber`, `RegisterTime`, `password`) VALUES
(1, 'Admin', 'SWTH', 'adminswth@gmail.com', '0347587212', '2025-03-11 07:10:12', '$2y$10$ppH4NrMLAktvf6eZTktRoeCu7XTb/Pl1lXiw8oAgXXriQMD.RX4yW'),
(33, 'Võ', 'Nam', '123@gmail.com', '0347587212', '2025-02-27 16:50:45', '$2y$10$fJDiZbZ9pq20oxGqNQ6/qOdKAqVDhUMUkXdXpPH/xS1bTjYM7ic2K'),
(37, 'Võ', 'Nam', 'hello123@gmail.com', '0356278919', '2025-03-12 02:09:55', '$2y$10$mh5HXMaq.5sJEagFLloFEew3l4quwh8NFn.PUHKOAgCrYk10IOL72');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_info`
--

INSERT INTO `contact_info` (`id`, `name`, `email`, `phone`, `message`, `submitted_at`) VALUES
(166, 'Nam Võ', 'admin@gmail.com', '0348827329', '12121', '2025-03-12 07:54:17'),
(167, 'Nam Võ', 'admin@gmail.com', '0348827329', '12121', '2025-03-12 07:54:44'),
(168, 'Nam Võ', 'admin@gmail.com', '0348759832', 'nam', '2025-03-12 07:58:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `id` int(11) NOT NULL,
  `thongtin_banh` text COLLATE utf8_unicode_ci NOT NULL,
  `thongtin_khach` text COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` enum('NULL','processing','closed','rejected') COLLATE utf8_unicode_ci DEFAULT 'processing',
  `ngay_dat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` text COLLATE utf8_unicode_ci NOT NULL,
  `id_sanpham` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tong_tien` int(10) NOT NULL,
  `phi_van_chuyen` int(10) NOT NULL,
  `tong_cong` int(10) NOT NULL,
  `ghichu` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `pttt` enum('cod','bank') COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` enum('NULL','processing','closed','rejected') COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `user_id`, `ten`, `sdt`, `dia_chi`, `id_sanpham`, `tong_tien`, `phi_van_chuyen`, `tong_cong`, `ghichu`, `pttt`, `trang_thai`, `ngay_tao`) VALUES
(37, 37, 'Nam', '0347587999', '65/9, Phường Cửa Đông, Quận Ba Đình, Hà Nội', '30', 288000, 40000, 328000, '', 'cod', 'closed', '2025-03-12 02:10:40'),
(40, 37, '', '', 'Nam, 0348798292, Tam Phú-Thủ Đức', '', 0, 0, 200000, '1 chiếc bánh socola, nhân hạnh nhân, ngọt 5% , giá tiền 300 trở xuống', 'cod', 'processing', '2025-03-11 16:19:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`id`, `user_id`, `img`, `name`, `price`, `so_luong`) VALUES
(15, 32, '/image/tra_dao_cam_sa.jpg', 'Trà Đào Cam Sả', 45000, 1),
(23, 32, '/image/tra_den_macchiato.png', 'Trà Đen Macchiato', 43200, 1),
(27, 32, '/image/banh_red_velvet.png', 'Bánh Red Velvet', 350000, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tin_moi`
--

CREATE TABLE `tin_moi` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tin_moi`
--

INSERT INTO `tin_moi` (`id`, `name`, `img`, `title`, `date`) VALUES
(1, 'Donut chỉ từ 8k tại Sweet Tea House', '/image/tinmoi_donut.jpg', 'Nhắc đến bánh Donut, dân sành thường thức hẳn không còn xa lạ gì với món ăn vặt rất phổ biến ở các nước phương Tây này.', '2023-08-17'),
(2, 'Croissant ngàn lớp - đa dạng cách thưởng thức', '/image/tinmoi_croissant.jpg', 'Nhắc đến bánh Donut, dân sành thường thức hẳn không còn xa lạ gì với món ăn vặt rất phổ biến ở các nước phương Tây này.', '2023-08-17'),
(3, 'Bánh Tart thơm ngậy không thể bỏ lỡ', '/image/tinmoi_banhtart.jpg', 'Nhắc đến bánh Donut, dân sành thường thức hẳn không còn xa lạ gì với món ăn vặt rất phổ biến ở các nước phương Tây này.', '2023-08-17'),
(4, 'Khám phá menu bánh quy khô thơm ngon, dinh dưỡng tại Sweet Tea House\r\n', '/image/tinmoi_banhquy.jpg', 'Nhắc đến bánh Donut, dân sành thường thức hẳn không còn xa lạ gì với món ăn vặt rất phổ biến ở các nước phương Tây này.', '2023-08-17'),
(5, 'Bánh ngọt - Các loại bánh ngọt được ưa chuộng tại Sweet Tea House\r\n', '/image/tinmoi_banhngot.jpg', 'Nhắc đến bánh Donut, dân sành thường thức hẳn không còn xa lạ gì với món ăn vặt rất phổ biến ở các nước phương Tây này.', '2023-08-17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tra_banhngot`
--

CREATE TABLE `tra_banhngot` (
  `id` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `name` varchar(222) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `img1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale` int(20) NOT NULL,
  `img` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduce` text COLLATE utf8_unicode_ci DEFAULT 'Thông tin sản phẩm đang cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tra_banhngot`
--

INSERT INTO `tra_banhngot` (`id`, `group`, `name`, `price`, `img1`, `sale`, `img`, `introduce`) VALUES
(1, 1, 'Trà hoa sen ', '50000', '/image/tra_hoa_sen1.jpg', 10, '/image/tra_hoa_sen.jpg', 'Hương thơm thanh khiết và vị dịu nhẹ.Trà hoa sen có tác dụng thanh lọc cơ thể, giảm căng thẳng và hỗ trợ giấc ngủ.'),
(15, 1, 'Trà Đào Cam Sả', '45000', '/image/tra_dao_cam_sa1.jpg', 0, '/image/tra_dao_cam_sa.jpg', 'Trà thơm vị đào, cam tươi, sả thanh mát.'),
(16, 1, 'Trà Tắc Mật Ong', '40000', '/image/tra_tac_mat_ong1.jpg', 0, '/image/tra_tac_mat_ong.jpg', 'Trà chua ngọt tự nhiên, tốt cho sức khỏe.'),
(17, 1, 'Trà Dâu Tây Macchiato', '50000', '/image/tra_dau_macchiato1.png', 0, '/image/tra_dau_macchiato.png', 'Trà dâu tươi, lớp kem sữa béo mịn.'),
(18, 1, 'Trà Sữa Oolong', '48000', '/image/tra_sua_oolong1.png', 0, '/image/tra_sua_oolong.png', 'Trà Oolong thơm nhẹ, hòa quyện với sữa béo.'),
(19, 1, 'Trà Chanh Sả Gừng', '42000', '/image/tra_chanh_sa_gung1.png', 0, '/image/tra_chanh_sa_gung.png', 'Trà thanh nhiệt, vị gừng ấm áp.'),
(20, 1, 'Trà Vải Hibiscus', '50000', '/image/tra_vai_hibiscus1.png', 15, '/image/tra_vai_hibiscus.png', 'Trà chua nhẹ từ hoa hibiscus kết hợp vải thơm ngon.'),
(21, 1, 'Trà Xanh Chanh Dây', '45000', '/image/tra_xanh_chanh_day1.png', 0, '/image/tra_xanh_chanh_day.png', 'Vị chua ngọt, mát lạnh, nhiều vitamin C.'),
(22, 1, 'Trà Sữa Matcha', '55000', '/image/tra_sua_matcha1.png', 0, '/image/tra_sua_matcha.png', 'Trà xanh Nhật Bản kết hợp sữa tươi.'),
(23, 1, 'Trà Đen Macchiato', '48000', '/image/tra_den_macchiato1.png', 10, '/image/tra_den_macchiato.png', 'Trà đen đậm vị, kem sữa béo mịn.'),
(24, 1, 'Trà Sen Vàng', '52000', '/image/tra_sen_vang1.png', 0, '/image/tra_sen_vang.png', 'Trà thanh mát, kết hợp hạt sen bùi thơm.'),
(25, 2, 'Bánh Tiramisu', '300000', '/image/banh_tiramisu1.png', 12, '/image/banh_tiramisu.png', 'Bánh mềm, vị cafe, cacao thơm ngon.'),
(26, 2, 'Bánh Mousse Chanh Dây', '250000', '/image/banh_mousse_chanh_day1.png', 0, '/image/banh_mousse_chanh_day.png', 'Bánh kem chua nhẹ, tươi mát.'),
(27, 2, 'Bánh Red Velvet', '350000', '/image/banh_red_velvet1.png', 0, '/image/banh_red_velvet.png', 'Bánh đỏ rực rỡ, vị cacao, phô mai ngậy.'),
(28, 2, 'Bánh Kem Socola', '280000', '/image/banh_kem_socola1.png', 0, '/image/banh_kem_socola.png', 'Bánh mềm xốp, phủ kem socola đậm đà.'),
(29, 2, 'Bánh Mousse Dâu Tây', '260000', '/image/banh_mousse_dau_tay1.png', 0, '/image/banh_mousse_dau_tay.png', 'Vị chua nhẹ, lớp kem mịn mượt.'),
(30, 2, 'Bánh Black Forest', '320000', '/image/banh_black_forest1.png', 10, '/image/banh_black_forest.png', 'Bánh socola kết hợp với cherry ngon miệng.'),
(31, 2, 'Bánh Kem Trà Xanh', '290000', '/image/banh_kem_tra_xanh1.png', 0, '/image/banh_kem_tra_xanh.png', 'Hương trà xanh thanh mát, lớp kem béo.'),
(32, 2, 'Bánh Cheese Cake', '280000', '/image/banh_cheese_cake1.png', 8, '/image/banh_cheese_cake.png', 'Bánh phô mai mềm mịn, chua nhẹ.'),
(33, 2, 'Bánh Kem Dừa', '270000', '/image/banh_kem_dua1.jpg', 0, '/image/banh_kem_dua.jpg', 'Bánh phủ kem dừa, thơm béo tự nhiên.'),
(34, 2, 'Bánh Tiramisu Matcha', '330000', '/image/banh_tiramisu_matcha1.jpg', 0, '/image/banh_tiramisu_matcha.jpg', 'Bánh tiramisu kết hợp vị trà xanh độc đáo.'),
(35, 3, 'Bánh Biscotti', '150000', '/image/banh_biscotti1.png', 0, '/image/banh_biscotti.png', 'Bánh giòn, ít ngọt, giàu dinh dưỡng.'),
(36, 3, 'Bánh Quy Bơ Đan Mạch', '200000', '/image/banh_quy_bo1.png', 0, '/image/banh_quy_bo.png', 'Bánh quy bơ béo ngậy, giòn rụm.'),
(37, 3, 'Bánh Pocky', '30000', '/image/banh_pocky1.png', 0, '/image/banh_pocky.png', 'Bánh que phủ socola, nhiều hương vị.'),
(38, 3, 'Bánh Madeleine', '90000', '/image/banh_madeleine.png', 0, '/image/banh_madeleine.png', 'Bánh Madeleine là loại bánh nhỏ hình vỏ sò có nguồn gốc từ Pháp, kết cấu mềm mại, xốp nhẹ.\r\nThành phần: Gồm bơ, trứng, bột mì, đường, có thể thêm chanh hoặc vani để tăng hương vị.\r\nHương vị: Thơm mùi bơ sữa, có vị ngọt nhẹ và hậu vị béo.'),
(39, 3, 'Bánh Quy Trứng Muối', '160000', '/image/banh_quy_trung_muoi.png', 0, '/image/banh_quy_trung_muoi.png', 'Bánh quy kết hợp vị trứng muối mặn ngọt.'),
(40, 3, 'Bánh Brownie Giòn', '180000', '/image/banh_brownie.png', 0, '/image/banh_brownie.png', 'Bánh giòn, vị socola đậm đà.'),
(41, 3, 'Bánh quy gừng (Gingerbread)', '120000', '/image/banh_quy_gung.png', 0, '/image/banh_quy_gung.png', 'Bánh quy gừng có màu nâu, hương vị đặc trưng của gừng, quế, mật ong hoặc mật mía. Bánh có thể mềm hoặc giòn tùy theo cách làm.Ngọt dịu, cay nhẹ từ gừng, thơm mùi quế và mật ong.'),
(42, 3, 'Bánh Quy Gạo Hàn Quốc', '100000', '/image/banh_quy_gao.png', 0, '/image/banh_quy_gao.png', 'Bánh giòn, ít béo.'),
(43, 3, 'Bánh Bông Lan Trứng Muối Sấy', '140000', '/image/banh_bong_lan_trung_muoi_say.png', 0, '/image/banh_bong_lan_trung_muoi_say.png', 'Bánh mềm giòn, vị mặn ngọt đặc trưng.'),
(44, 3, 'Bánh Quy Hạnh Nhân', '190000', '/image/banh_quy_hanh_nhan.png', 0, '/image/banh_quy_hanh_nhan.png', 'Bánh quy giòn, vị hạnh nhân thơm ngon.'),
(45, 4, 'Bánh Bông Lan Trứng Muối', '250000', '/image/banh_bong_lan_trung_muoi.png', 0, '/image/banh_bong_lan_trung_muoi.png', 'Bánh mềm mịn, vị mặn ngọt.'),
(46, 4, 'Bánh Donut Socola', '50000', '/image/banh_donut_socola.png', 0, '/image/banh_donut_socola.png', 'Bánh chiên giòn, phủ socola thơm ngon.'),
(47, 4, 'Bánh Croissant Bơ', '45000', '/image/banh_croissant_bo.png', 0, '/image/banh_croissant_bo.png', 'Bánh ngàn lớp giòn rụm, thơm bơ.'),
(48, 4, 'Bánh Su Kem', '30000', '/image/banh_su_kem.png', 0, '/image/banh_su_kem.png', 'Vỏ bánh mỏng, nhân kem mềm mịn.'),
(49, 4, 'Bánh Cupcake Vanilla', '40000', '/image/banh_cupcake_vanilla.png', 0, '/image/banh_cupcake_vanilla.png', 'Bánh nhỏ, vị vani nhẹ nhàng.'),
(50, 4, 'Bánh Sừng Bò Nhân Socola', '55000', '/image/banh_sung_bo_socola.png', 0, '/image/banh_sung_bo_socola.png', 'Lớp vỏ giòn, nhân socola đậm đà.'),
(51, 4, 'Bánh Tart Trứng', '60000', '/image/banh_tart_trung.png', 0, '/image/banh_tart_trung.png', 'Bánh giòn, nhân kem trứng béo ngậy.'),
(52, 4, 'Bánh Macaron', '180000', '/image/banh_macaron.png', 0, '/image/banh_macaron.png', 'Bánh nhỏ, giòn xốp, vị ngọt thanh.'),
(53, 4, 'Bánh Churros', '50000', '/image/banh_churros.png', 0, '/image/banh_churros.png', 'Bánh chiên giòn, ăn kèm sốt socola.'),
(54, 4, 'Bánh Muffin Việt Quất', '70000', '/image/banh_muffin_viet_quat1.png', 0, '/image/banh_muffin_viet_quat.png', 'Bánh mềm, vị ngọt nhẹ, thơm việt quất.'),
(55, 5, 'Trà Sữa Trân Châu', '45000', '/image/tra_sua_tran_chau1.png', 0, '/image/tra_sua_tran_chau.png', 'Trà sữa ngọt béo, trân châu dai ngon.'),
(56, 5, 'Nước Cam Tươi', '40000', '/image/nuoc_cam_tuoi1.png', 0, '/image/nuoc_cam_tuoi.png', 'Nước cam ép nguyên chất, giàu vitamin.'),
(57, 5, 'Cà Phê Sữa Đá', '35000', '/image/ca_phe_sua_da1.png', 0, '/image/ca_phe_sua_da.png', 'Cà phê Việt Nam đậm đà, sữa ngọt vừa.'),
(58, 5, 'Matcha Latte', '50000', '/image/matcha_latte1.png', 0, '/image/matcha_latte.png', 'Trà xanh sữa, vị thơm mát, ngọt dịu.'),
(59, 5, 'Sinh Tố Bơ', '55000', '/image/sinh_to_bo1.png', 0, '/image/sinh_to_bo.png', 'Sinh tố sánh mịn, béo thơm tự nhiên.'),
(60, 5, 'Nước Ép Dưa Hấu', '40000', '/image/matcha_latte1.png', 0, '/image/nuoc_ep_dua_hau.png', 'Nước ép tươi, giải nhiệt mùa hè.'),
(61, 5, 'Nước Ép Ổi Hồng', '45000', '/image/nuoc_ep_oi_hong1.png', 0, '/image/nuoc_ep_oi_hong.png', 'Nước ép thơm ngon, giàu vitamin C.'),
(62, 5, 'Soda Chanh Dây', '50000', '/image/soda_chanh_day1.png', 0, '/image/soda_chanh_day.png', 'Soda chua ngọt, có gas mát lạnh.'),
(63, 5, 'Cacao Nóng', '55000', '/image/cacao_nong1.png', 0, '/image/cacao_nong.png', 'Cacao nóng thơm béo, thích hợp ngày lạnh.'),
(64, 5, 'Latte Caramel', '60000', '/image/latte_caramel1.png', 0, '/image/latte_caramel.png', 'Cà phê sữa với caramel ngọt ngào.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeuthich`
--

CREATE TABLE `yeuthich` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`User_id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Chỉ mục cho bảng `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tin_moi`
--
ALTER TABLE `tin_moi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tra_banhngot`
--
ALTER TABLE `tra_banhngot`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `tin_moi`
--
ALTER TABLE `tin_moi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tra_banhngot`
--
ALTER TABLE `tra_banhngot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `yeuthich`
--
ALTER TABLE `yeuthich`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`User_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
