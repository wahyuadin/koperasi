-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2024 pada 15.05
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
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `val` enum('0','1') NOT NULL DEFAULT '0',
  `role` enum('0','1') NOT NULL DEFAULT '0',
  `acc` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_user`, `nama`, `email`, `username`, `password`, `foto`, `val`, `role`, `acc`) VALUES
(10, 'LPN-30731', 'Administrator', 'admin@admin.com', 'admin', '$2y$10$YpUJKqNCjhbpVUbgjsh28OXn1utJ8bhEbOgSlq.MHjEV/fWsh.4de', 'default.jpg', '1', '1', '1'),
(14, 'LPN-68732', 'user', 'user@gmail.com', 'user', '$2y$10$4tm33NINQEOXhYMK6sy4Q.PiBSsOkcWwSPV1ZC0a9c7h0NPm.hA1O', 'default.jpg', '1', '0', '1'),
(16, 'LPN-99733', 'yoga', 'yoga@gmail.com', 'yoga', '$2y$10$RywGCQYVwZQbZHK1k1ez9u//IycbVWXU8VwGu1/6Wl3Qr/pHJUfHy', 'default.jpg', '1', '0', '0');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tenor`
--
ALTER TABLE `tenor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
