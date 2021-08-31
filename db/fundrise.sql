-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Agu 2021 pada 15.28
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fundrise`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `campaign`
--

CREATE TABLE `campaign` (
  `id_campaign` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `masjid` varchar(255) NOT NULL,
  `deadline` varchar(255) NOT NULL,
  `donasi_terkumpul` int(11) NOT NULL,
  `donasi_total` int(11) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `implementasi` int(1) NOT NULL,
  `gambar1` varchar(255) NOT NULL,
  `gambar2` varchar(255) NOT NULL,
  `gambar3` varchar(255) NOT NULL,
  `gambar4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `donatur`
--

CREATE TABLE `donatur` (
  `id_donatur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_campaign` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `pembayaran` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `tanggal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `newsletter`
--

CREATE TABLE `newsletter` (
  `id_newsletter` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `email`) VALUES
(9, 'yafi0721@gmail.com'),
(10, 'nandagoreh@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pj` varchar(255) NOT NULL,
  `nip_pj` varchar(100) NOT NULL,
  `foto_ktp` varchar(255) NOT NULL,
  `foto_masjid1` varchar(255) NOT NULL,
  `foto_masjid2` varchar(255) NOT NULL,
  `foto_masjid3` varchar(255) NOT NULL,
  `alamat_pj` text NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `durasi` varchar(255) NOT NULL,
  `proposal` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyaluran`
--

CREATE TABLE `penyaluran` (
  `id_penyaluran` int(11) NOT NULL,
  `id_campaign` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `waktu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang`
--

CREATE TABLE `tentang` (
  `id_tentang` int(11) NOT NULL,
  `teks` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tentang`
--

INSERT INTO `tentang` (`id_tentang`, `teks`, `gambar`) VALUES
(1, '<p><p>aaaaa</p><p>aaaaaaaaaaa</p><p>aaaaaaaaaaaaa</p><p>aaaaaaaaaa</p></p>', '2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `email`, `nama`, `password`, `telephone`, `alamat`, `role_id`) VALUES
(4, 'admin', 'admin', '$2y$10$kDZnMjpWNyUBf49IcgWeS.V2NeQFl8xg8TXNVuplTBd1oQNq7Shhe', '1111111111', '', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id_campaign`);

--
-- Indeks untuk tabel `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id_donatur`);

--
-- Indeks untuk tabel `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id_newsletter`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `penyaluran`
--
ALTER TABLE `penyaluran`
  ADD PRIMARY KEY (`id_penyaluran`);

--
-- Indeks untuk tabel `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id_tentang`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id_campaign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id_newsletter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `penyaluran`
--
ALTER TABLE `penyaluran`
  MODIFY `id_penyaluran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id_tentang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
