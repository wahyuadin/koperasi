-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jan 2024 pada 16.36
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master`
--

CREATE TABLE `master` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `pengeluaran` varchar(255) NOT NULL DEFAULT '0',
  `pemasukan` varchar(255) NOT NULL DEFAULT '0',
  `ket` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master`
--

INSERT INTO `master` (`id`, `id_user`, `id_transaksi`, `nama`, `pengeluaran`, `pemasukan`, `ket`, `timestamp`) VALUES
(1, 'LPN-68732', 'TRS-91734', 'user', '0', '60000', 'tes', '2024-01-17 09:01:34'),
(2, 'LPN-68732', 'TRS-41734', 'user', '10000', '0', 'p', '2024-01-17 09:01:51'),
(4, 'LPN-68732', 'TRS-36734', 'user', '723', '0', 'jhwdf\r\n', '2024-01-17 10:19:38'),
(7, 'LPN-68732', 'TRS-19734', 'user', '223', '0', '2', '2024-01-17 14:45:51'),
(8, 'LPN-68732', 'TRS-81734', 'user', '0', '1000', '2 - Kredit 1 bulan, bunga 5 %', '2024-01-17 16:22:08'),
(9, 'LPN-68732', 'TRS-45734', 'user', '0', '1000', '5 - Kredit 12 bulan, bunga 20 %', '2024-01-17 16:29:16'),
(10, 'LPN-68732', 'TRS-15734', 'user', '0', '2323', '3 - Kredit 3 bulan, bunga 10 %', '2024-01-17 16:35:49'),
(11, 'LPN-68732', 'TRS-87734', 'user', '0', '2837', '4 - Kredit 6 bulan, bunga 15 %', '2024-01-17 16:56:18'),
(12, 'LPN-68732', 'TRS-42734', 'user', '0', '1000', '3 - Kredit 3 bulan, bunga 10 %', '2024-01-17 16:59:22'),
(13, 'LPN-68732', 'TRS-83734', 'user', '0', '23', '3 - Kredit 3 bulan, bunga 10 %', '2024-01-17 17:00:57'),
(14, 'LPN-68732', 'TRS-11734', 'user', '0', '2323', '4 - Kredit 6 bulan, bunga 15 %', '2024-01-17 17:02:11'),
(15, 'LPN-68732', 'TRS-75734', 'user', '0', '2000', '4 - Kredit 6 bulan, bunga 15 %', '2024-01-17 17:04:19'),
(16, 'LPN-68732', 'TRS-66734', 'user', '0', '3242', '3 - Kredit 3 bulan, bunga 10 %', '2024-01-17 17:05:49'),
(17, 'LPN-68732', 'TRS-48734', 'user', '0', '999', '5 - Kredit 12 bulan, bunga 20 %', '2024-01-17 17:07:21'),
(18, 'LPN-68732', 'TRS-82734', 'user', '0', '4324', '3 - Kredit 3 bulan, bunga 10 %', '2024-01-17 17:10:26'),
(19, 'LPN-68732', 'TRS-97734', 'user', '0', '7000', '3 - Kredit 3 bulan, bunga 10 %', '2024-01-17 17:13:06'),
(20, 'LPN-68732', 'TRS-99734', 'user', '0', '7000', '5 - Kredit 12 bulan, bunga 20 %', '2024-01-17 17:18:25'),
(21, 'LPN-68732', 'TRS-99734', 'user', '0', '7000', '5 - Kredit 12 bulan, bunga 20 %', '2024-01-17 17:32:30'),
(22, 'LPN-68732', 'TRS-99734', 'user', '0', '7000', '5 - Kredit 12 bulan, bunga 20 %', '2024-01-17 17:32:46'),
(23, 'LPN-68732', 'TRS-60734', 'user', '0', '1000', '6 - Kredit 12 bulan, bunga 20 %', '2024-01-18 09:21:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_transaksi` varchar(100) NOT NULL DEFAULT 'pemasukan',
  `nominal` varchar(30) NOT NULL,
  `ket` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `id_user`, `id_transaksi`, `nama`, `nama_transaksi`, `nominal`, `ket`, `timestamp`) VALUES
(1, 'LPN-68732', 'TRS-91734', 'user', 'pemasukan', '60000', 'tes', '2024-01-17 09:01:34'),
(3, 'LPN-68732', 'TRS-81734', 'user', 'pengeluaran', '1000', '2 - Kredit 1 bulan, ', '2024-01-17 16:22:08'),
(4, 'LPN-68732', 'TRS-45734', 'user', 'pengeluaran', '1000', '5 - Kredit 12 bulan,', '2024-01-17 16:29:16'),
(5, 'LPN-68732', 'TRS-15734', 'user', 'pengeluaran', '2323', '3 - Kredit 3 bulan, ', '2024-01-17 16:35:49'),
(6, 'LPN-68732', 'TRS-87734', 'user', 'pengeluaran', '2837', '4 - Kredit 6 bulan, ', '2024-01-17 16:56:18'),
(7, 'LPN-68732', 'TRS-42734', 'user', 'pengeluaran', '1000', '3 - Kredit 3 bulan, ', '2024-01-17 16:59:22'),
(8, 'LPN-68732', 'TRS-83734', 'user', 'pengeluaran', '23', '3 - Kredit 3 bulan, ', '2024-01-17 17:00:57'),
(9, 'LPN-68732', 'TRS-11734', 'user', 'pengeluaran', '2323', '4 - Kredit 6 bulan, ', '2024-01-17 17:02:11'),
(10, 'LPN-68732', 'TRS-75734', 'user', 'pengeluaran', '2000', '4 - Kredit 6 bulan, ', '2024-01-17 17:04:19'),
(11, 'LPN-68732', 'TRS-66734', 'user', 'pengeluaran', '3242', '3 - Kredit 3 bulan, ', '2024-01-17 17:05:49'),
(12, 'LPN-68732', 'TRS-48734', 'user', 'pengeluaran', '999', '5 - Kredit 12 bulan,', '2024-01-17 17:07:21'),
(13, 'LPN-68732', 'TRS-82734', 'user', 'pengeluaran', '4324', '3 - Kredit 3 bulan, ', '2024-01-17 17:10:26'),
(14, 'LPN-68732', 'TRS-97734', 'user', 'pengeluaran', '7000', '3 - Kredit 3 bulan, ', '2024-01-17 17:13:06'),
(15, 'LPN-68732', 'TRS-99734', 'user', 'pengeluaran', '7000', '5 - Kredit 12 bulan,', '2024-01-17 17:18:25'),
(16, 'LPN-68732', 'TRS-99734', 'user', 'pengeluaran', '7000', '5 - Kredit 12 bulan,', '2024-01-17 17:32:30'),
(17, 'LPN-68732', 'TRS-99734', 'user', 'pengeluaran', '7000', '5 - Kredit 12 bulan,', '2024-01-17 17:32:46'),
(18, 'LPN-68732', 'TRS-60734', 'user', 'pengeluaran', '1000', '6 - Kredit 12 bulan,', '2024-01-18 09:21:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_transaksi` varchar(100) NOT NULL DEFAULT 'pengeluaran',
  `nominal` varchar(30) NOT NULL,
  `ket` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `id_user`, `id_transaksi`, `nama`, `nama_transaksi`, `nominal`, `ket`, `timestamp`) VALUES
(1, 'LPN-68732', 'TRS-41734', 'user', 'pengeluaran', '10000', 'p', '2024-01-17 09:01:51'),
(3, 'LPN-68732', 'TRS-36734', 'user', 'pengeluaran', '723', 'jhwdf\r\n', '2024-01-17 10:19:38'),
(5, 'LPN-68732', 'TRS-19734', 'user', 'pengeluaran', '223', '2', '2024-01-17 14:45:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_transaksi`
--

CREATE TABLE `riwayat_transaksi` (
  `id` int(11) NOT NULL,
  `id_user` varchar(200) NOT NULL,
  `id_transaksi` varchar(200) NOT NULL,
  `kategori` enum('pemasukan','pengeluaran') NOT NULL,
  `nominal` varchar(100) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `acc` varchar(2) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_transaksi`
--

INSERT INTO `riwayat_transaksi` (`id`, `id_user`, `id_transaksi`, `kategori`, `nominal`, `ket`, `acc`, `timestamp`) VALUES
(1, 'LPN-68732', 'TRS-91734', 'pemasukan', '60000', 'tes', '1', '2024-01-17 09:01:34'),
(2, 'LPN-68732', 'TRS-41734', 'pengeluaran', '10000', 'p', '1', '2024-01-17 09:01:51'),
(4, 'LPN-68732', 'TRS-68734', 'pengeluaran', '1', 'dfs', '1', '2024-01-17 10:16:51'),
(5, 'LPN-68732', 'TRS-36734', 'pengeluaran', '723', 'jhwdf\r\n', '1', '2024-01-17 10:19:38'),
(7, 'LPN-68732', 'TRS-67734', 'pemasukan', '999999999999999', 'ksfjd\r\n', '1', '2024-01-17 10:31:10'),
(8, 'LPN-68732', 'TRS-19734', 'pengeluaran', '223', '2', '1', '2024-01-17 14:45:51'),
(9, 'LPN-68732', 'TRS-14734', 'pemasukan', '2000', 'df\r\n', '3', '2024-01-17 15:17:03'),
(10, 'LPN-30731', 'TRS-67734', 'pemasukan', '0', 'Hapus Data By Admin', '1', '2024-01-17 15:17:54'),
(11, 'LPN-68732', 'TRS-93734', 'pengeluaran', '23', 'Edit Data - 3', '3', '2024-01-17 16:12:52'),
(12, 'LPN-68732', 'TRS-22734', 'pengeluaran', '3000', 'Kredit 12 Bunga  %', '3', '2024-01-17 16:13:17'),
(13, 'LPN-68732', 'TRS-23734', 'pengeluaran', '3000', 'Kredit 12 Bunga 20 %', '3', '2024-01-17 16:13:20'),
(14, 'LPN-68732', 'TRS-24734', 'pengeluaran', '23', 'Kredit 12 bulan, bunga 20 %', '3', '2024-01-17 16:13:22'),
(15, 'LPN-68732', 'TRS-84734', 'pengeluaran', '3000', '5 - Kredit 12 bulan, bunga 20 %', '3', '2024-01-17 16:13:24'),
(16, 'LPN-68732', 'TRS-63734', 'pengeluaran', '1000', '5 - Kredit 12 bulan, bunga 20 %', '3', '2024-01-17 16:13:27'),
(17, 'LPN-68732', 'TRS-45734', 'pengeluaran', '1000', '5 - Kredit 12 bulan, bunga 20 %', '1', '2024-01-17 16:29:16'),
(18, 'LPN-68732', 'TRS-81734', 'pengeluaran', '1000', '2 - Kredit 1 bulan, bunga 5 %', '1', '2024-01-17 16:22:08'),
(19, 'LPN-68732', 'TRS-15734', 'pengeluaran', '2323', '3 - Kredit 3 bulan, bunga 10 %', '1', '2024-01-17 16:35:49'),
(20, 'LPN-68732', 'TRS-87734', 'pengeluaran', '2837', '4 - Kredit 6 bulan, bunga 15 %', '1', '2024-01-17 16:56:18'),
(21, 'LPN-68732', 'TRS-42734', 'pengeluaran', '1000', '3 - Kredit 3 bulan, bunga 10 %', '1', '2024-01-17 16:59:22'),
(22, 'LPN-68732', 'TRS-83734', 'pengeluaran', '23', '3 - Kredit 3 bulan, bunga 10 %', '1', '2024-01-17 17:00:57'),
(23, 'LPN-68732', 'TRS-11734', 'pengeluaran', '2323', '4 - Kredit 6 bulan, bunga 15 %', '1', '2024-01-17 17:02:11'),
(24, 'LPN-68732', 'TRS-75734', 'pengeluaran', '2000', '4 - Kredit 6 bulan, bunga 15 %', '1', '2024-01-17 17:04:19'),
(25, 'LPN-68732', 'TRS-66734', 'pengeluaran', '3242', '3 - Kredit 3 bulan, bunga 10 %', '1', '2024-01-17 17:05:49'),
(26, 'LPN-68732', 'TRS-48734', 'pengeluaran', '999', '5 - Kredit 12 bulan, bunga 20 %', '1', '2024-01-17 17:07:21'),
(27, 'LPN-68732', 'TRS-82734', 'pengeluaran', '4324', '3 - Kredit 3 bulan, bunga 10 %', '1', '2024-01-17 17:10:26'),
(28, 'LPN-68732', 'TRS-97734', 'pengeluaran', '7000', '3 - Kredit 3 bulan, bunga 10 %', '1', '2024-01-17 17:13:06'),
(29, 'LPN-68732', 'TRS-99734', 'pengeluaran', '7000', '5 - Kredit 12 bulan, bunga 20 %', '1', '2024-01-17 17:18:25'),
(30, 'LPN-68732', 'TRS-60734', 'pengeluaran', '1000', '6 - Kredit 12 bulan, bunga 20 %', '1', '2024-01-18 09:21:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tenor`
--

CREATE TABLE `tenor` (
  `id` int(11) NOT NULL,
  `bulan` varchar(5) NOT NULL,
  `persen` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tenor`
--

INSERT INTO `tenor` (`id`, `bulan`, `persen`) VALUES
(2, '1', '5'),
(3, '3', '10'),
(4, '6', '15'),
(6, '12', '20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_tenor` varchar(50) NOT NULL,
  `nominal` varchar(30) NOT NULL,
  `acc` varchar(1) NOT NULL DEFAULT '0',
  `timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_user`, `id_transaksi`, `id_tenor`, `nominal`, `acc`, `timestamp`) VALUES
(1, 'LPN-68732', 'TRS-60734', '6', '283', '3', '2025-01-12 16:21:19'),
(2, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-02-11 16:21:19'),
(3, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-03-13 16:21:19'),
(4, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-04-12 16:21:19'),
(5, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-05-12 16:21:19'),
(6, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-06-11 16:21:19'),
(7, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-07-11 16:21:19'),
(8, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-08-10 16:21:19'),
(9, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-09-09 16:21:19'),
(10, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-10-09 16:21:19'),
(11, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-11-08 16:21:19'),
(12, 'LPN-68732', 'TRS-60734', '6', '283', '0', '2025-12-08 16:21:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `val` enum('0','1') NOT NULL DEFAULT '0',
  `role` enum('0','1') NOT NULL DEFAULT '0',
  `acc` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_user`, `nama`, `email`, `username`, `password`, `val`, `role`, `acc`) VALUES
(10, 'LPN-30731', 'Administrator', 'admin@admin.com', 'admin', '$2y$10$YpUJKqNCjhbpVUbgjsh28OXn1utJ8bhEbOgSlq.MHjEV/fWsh.4de', '1', '1', '1'),
(14, 'LPN-68732', 'user', 'user@gmail.com', 'user', '$2y$10$4tm33NINQEOXhYMK6sy4Q.PiBSsOkcWwSPV1ZC0a9c7h0NPm.hA1O', '1', '0', '1'),
(16, 'LPN-99733', 'yoga', 'yoga@gmail.com', 'yoga', '$2y$10$RywGCQYVwZQbZHK1k1ez9u//IycbVWXU8VwGu1/6Wl3Qr/pHJUfHy', '1', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_verif`
--

CREATE TABLE `users_verif` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `kab` varchar(100) NOT NULL,
  `kec` varchar(100) NOT NULL,
  `kel` varchar(100) NOT NULL,
  `rt_rw` varchar(20) NOT NULL,
  `file_upload` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_verif`
--

INSERT INTO `users_verif` (`id`, `id_user`, `nama`, `alamat`, `prov`, `kab`, `kec`, `kel`, `rt_rw`, `file_upload`) VALUES
(13, 'LPN-30731', 'Administrator', 'JL Ronggo Waluyo', '32', '3215', '3215031', '3215031003', '022/006', 'QR_code_trade_api.png'),
(16, 'LPN-68732', 'user', 'Karawang', '32', '3215', '3215031', '3215031002', '011/006', '31c827fb051b4cbf78d35b5acb96034f.jpg'),
(18, 'LPN-99733', 'yoga', 'Rengasdengklok', '35', '3516', '3516130', '3516130012', '022/006', '31c827fb051b4cbf78d35b5acb96034f.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tenor`
--
ALTER TABLE `tenor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users_verif`
--
ALTER TABLE `users_verif`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master`
--
ALTER TABLE `master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tenor`
--
ALTER TABLE `tenor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users_verif`
--
ALTER TABLE `users_verif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
