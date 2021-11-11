-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Nov 2021 pada 00.35
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `judul_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `judul_kategori`) VALUES
(1, 'AC dan Pendingin'),
(4, 'Penerangan'),
(8, 'Genset'),
(13, 'Aneh banget'),
(17, 'Plumbing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` text NOT NULL,
  `volume` int(11) NOT NULL COMMENT 'bobot',
  `satuan` varchar(20) NOT NULL COMMENT 'ml/l/kg/g',
  `gambar` varchar(215) NOT NULL,
  `kategori_produk` int(2) NOT NULL COMMENT 'beve, food, belanja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_in`
--

CREATE TABLE `produk_in` (
  `id_produk_in` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah_in` int(11) NOT NULL,
  `tanggal_in` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_out`
--

CREATE TABLE `produk_out` (
  `id_produk_out` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produk_id` varchar(128) NOT NULL,
  `jumlah_out` int(11) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `tanggal` varchar(56) NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `status_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_out`
--

INSERT INTO `produk_out` (`id_produk_out`, `user_id`, `produk_id`, `jumlah_out`, `keterangan`, `tanggal`, `status`, `status_by`) VALUES
(33, 4, 'Obeng Kembang', 2, 'Untuk Project', '06-11-2021 09:43:42', 0, 0),
(39, 4, 'Freon R22', 2, 'Untuk  Ruang Lab ', '06-11-2021 09:45:32', 0, 0),
(40, 4, 'Cob', 1, 'ass', '06-11-2021 09:48:28', 0, 0),
(42, 4, 'HWUOQH', 2, '1XXA', '06-11-2021 09:51:07', 0, 0),
(46, 4, 'COB', 1, 'XJs', '06-11-2021 09:55:16', 0, 0),
(47, 4, 'ttt', 1, 'uuuu', '06-11-2021 11:10:17', 0, 0),
(48, 4, 'UUY', 1, 'OOO', '06-11-2021 11:10:36', 0, 0),
(49, 4, 'ppt', 1, 'ppt', '06-11-2021 11:25:52', 0, 0),
(50, 15, 'haduh', 99, 'haduuuuh', '06-11-2021 13:53:18', 0, 0),
(51, 15, 'hayaaa', 98, 'hayaaaaaah', '06-11-2021 13:53:18', 0, 0),
(52, 15, 'coba1', 80, 'cobaa ke 1', '06-11-2021 13:55:41', 0, 0),
(53, 15, 'coba2', 82, 'cobaa ke 2', '06-11-2021 13:55:41', 0, 0),
(54, 15, 'coba3', 83, 'cobaa ke 3', '06-11-2021 13:55:41', 0, 0),
(55, 4, 'cob1', 1, 'cobaa yaak', '12-11-2021 06:19:20', 0, 0),
(56, 4, 'cob2', 22, 'inik coba', '12-11-2021 06:19:20', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `id_sub_kategori` int(11) NOT NULL,
  `judul_sub` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_kategori`
--

INSERT INTO `sub_kategori` (`id_sub_kategori`, `judul_sub`, `kategori_id`) VALUES
(1, 'AC Sentral', 1),
(2, 'Pompa Cooling Tower', 1),
(3, 'Diesel Hydrant', 2),
(4, 'Jockey Pump', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `image1` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `image`, `image1`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'Aji Ramadhani S', 'aji@gmail.com', 'guest.png', '', '$2y$10$Cgaqx2gyJ1iSYjE7sDr7pO0toVLmwu9EqlaPA.J7TdDYpfZPNLQKy', 1, 1, 1588136719),
(4, 'Administrator', 'admin@gmail.com', 'guest.png', '', '$2y$10$P8lF7n7enqmPcGuT4ea0POqPtIlk.L8FFtBb4KB8ehyMx6O5hNH.K', 1, 1, 1588139240),
(9, 'Ulfiana', 'ulfiana@gmail.com', 'guest.png', '', '$2y$10$eCgYOaZjHRtbVpTS8BF2AOJbjQvlFsBYshh095g915rnXB5jUKjyW', 7, 1, 1589039330),
(14, 'Samsul', 'samsul@gmail.com', 'guest.png', '', '$2y$10$hegUET/71Ofn/L4T6s08MOss4oqUDOYMIZApJI1Tq7XHiauMRon1O', 7, 1, 1593909283),
(15, 'Ilham', 'ilham@gmail.com', 'guest.png', '', '$2y$10$AbS07N6przZktB0QmDM6i.Os4XzI/hUH1ws7AbmyHObEBj/AhZ/Sq', 7, 1, 1636180673);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL COMMENT 'FK dari tabel user_menu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(8, 1, 3),
(10, 1, 10),
(11, 1, 9),
(12, 3, 9),
(13, 3, 2),
(14, 1, 11),
(15, 1, 12),
(22, 1, 14),
(24, 1, 15),
(25, 1, 16),
(26, 1, 18),
(27, 3, 14),
(28, 3, 18),
(29, 1, 17),
(32, 1, 2),
(33, 7, 14),
(34, 7, 2),
(35, 7, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(14, 'Teknisi'),
(17, 'Tambahan'),
(18, 'Produk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'SuperAdmin'),
(2, 'Administrator'),
(7, 'Teknisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(5, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(6, 3, 'SubMenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(9, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(11, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(12, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(13, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(18, 1, 'User', 'admin/user', 'fas fa-fw fa-user-plus', 1),
(33, 17, 'Tambah Sub Kategori', 'tambahan/subkategori', 'fas fa-fw fa-plus-square', 1),
(34, 18, 'Katalog Produk', 'produk', 'fas fa-fw fa-sitemap', 1),
(35, 15, 'Laporan Belanja', 'laporan/belanja', 'fas fa-fw fa-newspaper', 1),
(36, 17, 'Kategori', 'tambahan', 'fas fa-fw fa-plus-square', 1),
(37, 14, 'Request Barang', 'teknisi/request', 'fas fa-fw fa-cart-plus', 1),
(38, 14, 'Usulkan Produk', 'teknisi/usulan', 'fas fa-fw fa-lightbulb', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(3, 'setiantoajiramadhani@gmail.com', '/0hRXbNGeEo8Bc6mo736UX9vwznc19i2LnAY1mAai4I=', 1589095962),
(4, 'setiantoajiramadhani@gmail.com', 'OQVdxeyD7klxjWdydTxAMk776oO5QhORa6IRYRTq0U4=', 1589096030),
(5, 'setiantoajiramadhani@gmail.com', 'AocSH98ZCiiWnpePD+26WCiKIrhBfz9vdnrBbVXo8J4=', 1589096043),
(6, 'setiantoajiramadhani@gmail.com', '6S8xBw3PGNhf+HWDUgkCne9540EqYP11t72ujaFQKSk=', 1589105963),
(7, 'setiantoajiramadhani@gmail.com', 'p+zNwK+dxdgLXg0Jp/TWQw+AqMkXvcsLGzTmnoBuWIk=', 1589105990),
(8, 'ajiramadhani56@gmail.com', 'bI44CNu7509gRf+OSxj9ZV8NajhVdGogMvvUm7TWbpg=', 1593908981),
(9, 'ajiramadhani56@gmail.com', 'cWaPiJt8L+bSfi26cxXfVg4+M+2OJwZRJFVaf67HiO4=', 1593909074),
(10, 'ajiramadhani56@gmail.com', '8IJggAX0EUNYmgV8Gz1JWtrDRq+V+beQ6nOM1XR6Bks=', 1593909163),
(11, 'ajiramadhani56@gmail.com', 'q6hdAVB5zEiRDDRFfaBTOdvnre6wpqTjiSJooZ59L+4=', 1593909283),
(12, 'ajiramadhani56@gmail.com', 'rWMv9tevsRA4WrECAGxkVe5YVozzBqoc+i+6nfePZek=', 1602386346),
(13, 'ajiramadhani56@gmail.com', 'VR5ikJ1sqSRn5fwweUE/wbG9aZvkDW0wmxP8cv2lpUc=', 1602386390),
(14, 'ajiramadhani56@gmail.com', 'c4zh0QQ4x9rlkP/+64bw/HvXbJTp5z4rE7aJoQHPf2Q=', 1602386399),
(15, 'ajiramadhani56@gmail.com', 'i6zOaBLXMD1Xhich2WeaV+iuBfgGRN8+HUfwSwQ+v4E=', 1602386475),
(16, 'aji@gmail.com', 'oXUjkGKMIqT2sog1BzvJkeIy2t8w5igaABdp5sbyPgc=', 1633166486),
(17, 'aji@gmail.com', 'nFlprISPznFR7zZTkH/dLJlwoejj2MBXgLMvtMb15+o=', 1633166495),
(18, 'aji@gmail.com', '8z/kbu+V4PttXO2ySnuA6GgXSLo9wjir38LjZ+ao9Ts=', 1633166501),
(19, 'aji@gmail.com', 'OZMnmM3jOjImjkEifIn4bgQ0CZOrtQZYLDbrHKZeZLg=', 1636180673);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `produk_in`
--
ALTER TABLE `produk_in`
  ADD PRIMARY KEY (`id_produk_in`);

--
-- Indeks untuk tabel `produk_out`
--
ALTER TABLE `produk_out`
  ADD PRIMARY KEY (`id_produk_out`);

--
-- Indeks untuk tabel `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`id_sub_kategori`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk_out`
--
ALTER TABLE `produk_out`
  MODIFY `id_produk_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `id_sub_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
