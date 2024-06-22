-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Jun 2024 pada 07.39
-- Versi server: 8.3.0
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plbn_motamasin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int NOT NULL,
  `image` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bg` varchar(35) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `image`, `bg`) VALUES
(1, 'auth.jpg', '#4e73de');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `nama_barang`, `created_at`, `updated_at`) VALUES
(1, 'Elektornik', '2024-06-12 19:56:30', '2024-06-12 19:56:30'),
(3, 'Alat Berat', '2024-06-12 19:56:52', '2024-06-12 19:56:52'),
(4, 'Perkakas Rumah', '2024-06-12 19:57:05', '2024-06-12 19:57:05'),
(5, 'Makanan', '2024-06-12 19:57:10', '2024-06-12 19:57:10'),
(6, 'Material', '2024-06-12 19:57:27', '2024-06-12 19:57:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_izin`
--

CREATE TABLE `data_izin` (
  `id_izin` int NOT NULL,
  `kode_izin` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `id_export_import` int DEFAULT NULL,
  `nama_pt` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_pj` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pengirim` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `no_plat` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penerima` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` char(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `total_harga` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_izin`
--

INSERT INTO `data_izin` (`id_izin`, `kode_izin`, `id_export_import`, `nama_pt`, `nama_pj`, `nama_pengirim`, `no_plat`, `nama_penerima`, `email`, `no_hp`, `alamat`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, '1', 3, 'Netmedia Framecode Ltd. ID', 'Sahala Z. R Butar Butar', 'Arlan', 'DH 4256 EB', 'Julio', 'arlan270899@gmail.com', '08113827421', 'Jln. W.J Lalamentik No.95, Kota Kupang, Nusa Tenggara, Timur, 85111', 10000, '2024-06-12 22:40:03', '2024-06-22 14:49:29'),
(2, '1', 4, 'PT. Pustaka Lestari', 'Herman', 'Teo', 'DH 4266 EB', 'Arlan Butar Butar', 'arlan270899@gmail.com', '08113827421', 'Jln. W.J Lalamentik No.95', 1000, '2024-06-22 14:56:21', '2024-06-22 14:56:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `export_import`
--

CREATE TABLE `export_import` (
  `id_export_import` int NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `kapasitas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_pengiriman` date DEFAULT NULL,
  `daerah_asal` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `daerah_tujuan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `export_import`
--

INSERT INTO `export_import` (`id_export_import`, `id_kategori`, `id_barang`, `kapasitas`, `tgl_pengiriman`, `daerah_asal`, `daerah_tujuan`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '244', '2024-06-11', 'soe', 'dili', '2024-06-12 20:33:07', '2024-06-22 14:35:03'),
(2, 1, 3, '323', '2024-06-05', 'Kupang', 'Dili', '2024-06-12 20:46:31', '2024-06-12 20:46:31'),
(3, 2, 3, '100', '2024-06-08', 'Kupang', 'Dili', '2024-06-12 22:14:30', '2024-06-12 22:14:30'),
(4, 1, 1, '244', '2024-06-21', 'Kupang', 'Dili', '2024-06-22 14:56:21', '2024-06-22 14:56:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Export', '2024-06-12 15:21:28', '2024-06-12 15:21:28'),
(2, 'Import', '2024-06-12 15:21:32', '2024-06-12 15:21:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `id_role` int DEFAULT NULL,
  `id_active` int DEFAULT '2',
  `en_user` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` char(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'default.svg',
  `email` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telp` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'developer', 'default.svg', 'developer@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '', 0, '2024-05-21 19:37:54', '2024-05-21 19:37:54'),
(2, 2, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '', 0, '2024-05-21 19:37:54', '2024-05-21 19:37:54');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.id_role = (
        SELECT id_role
        FROM `user_role`
        ORDER BY id_role DESC
        LIMIT 1
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int NOT NULL,
  `id_role` int DEFAULT NULL,
  `id_menu` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int NOT NULL,
  `id_role` int DEFAULT NULL,
  `id_sub_menu` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id_access_sub_menu`, `id_role`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 2, 7),
(13, 2, 8),
(14, 2, 9),
(15, 2, 10),
(16, 2, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int NOT NULL,
  `menu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`) VALUES
(1, 'User Management'),
(2, 'Menu Management'),
(3, 'Data PLBN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int NOT NULL,
  `role` varchar(35) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Developer'),
(2, 'Administrator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int NOT NULL,
  `status` varchar(35) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int NOT NULL,
  `id_menu` int DEFAULT NULL,
  `id_active` int DEFAULT '2',
  `title` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `id_active`, `title`, `url`, `icon`) VALUES
(1, 1, 1, 'Users', 'users', 'fas fa-users'),
(2, 1, 1, 'Role', 'role', 'fas fa-user-cog'),
(3, 2, 1, 'Menu', 'menu', 'fas fa-fw fa-folder'),
(4, 2, 1, 'Sub Menu', 'sub-menu', 'fas fa-fw fa-folder-open'),
(5, 2, 1, 'Menu Access', 'menu-access', 'fas fa-user-lock'),
(6, 2, 1, 'Sub Menu Access', 'sub-menu-access', 'fas fa-user-lock'),
(7, 3, 1, 'Kategori', 'kategori', 'fas fa-list'),
(8, 3, 1, 'Barang', 'barang', 'fas fa-boxes'),
(9, 3, 1, 'Export', 'export', 'fas fa-pallet'),
(10, 3, 1, 'Import', 'import', 'fas fa-truck-loading'),
(11, 3, 1, 'Izin Export Import', 'izin-export-import', 'fas fa-file-invoice');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `data_izin`
--
ALTER TABLE `data_izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `id_export_import` (`id_export_import`);

--
-- Indeks untuk tabel `export_import`
--
ALTER TABLE `export_import`
  ADD PRIMARY KEY (`id_export_import`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_izin`
--
ALTER TABLE `data_izin`
  MODIFY `id_izin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `export_import`
--
ALTER TABLE `export_import`
  MODIFY `id_export_import` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_izin`
--
ALTER TABLE `data_izin`
  ADD CONSTRAINT `data_izin_ibfk_1` FOREIGN KEY (`id_export_import`) REFERENCES `export_import` (`id_export_import`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `export_import`
--
ALTER TABLE `export_import`
  ADD CONSTRAINT `export_import_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `export_import_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`);

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`),
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
