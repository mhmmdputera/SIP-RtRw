-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2021 pada 19.03
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pangkat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `jenis`) VALUES
(1, 'Keamanan'),
(2, 'Lingkungan'),
(3, 'Infrastruktur'),
(4, 'Sosial'),
(5, 'tes jenis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengadu`
--

CREATE TABLE `tb_pengadu` (
  `id_pengadu` varchar(50) NOT NULL,
  `nama_pengadu` varchar(30) NOT NULL,
  `jekel` enum('LK','PR') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengadu`
--

INSERT INTO `tb_pengadu` (`id_pengadu`, `nama_pengadu`, `jekel`, `no_hp`, `alamat`) VALUES
('059549eb-1d4e-4ead-a941-024cbf8015e2', 'Daniar', 'PR', '087789987654', 'Rt 1 Rw 3'),
('33fdb65d-93a8-485f-8aed-b976e1db5395', 'Joni Tralala', 'LK', '085878526048', 'Rt 1 Rw2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `jenis` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(300) NOT NULL,
  `waktu_aduan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'Proses',
  `tanggapan` text,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_pengaduan`, `judul`, `jenis`, `keterangan`, `foto`, `waktu_aduan`, `status`, `tanggapan`, `author`) VALUES
(4, 'Sampah Menumpuk', 2, 'Ada banyak sampah menumpuk di are lapangan sepak bola', 'Jellyfish.jpg', '2021-02-03 18:28:02', 'Selesai', 'mari kita kerja bakti, ajak semua pemuda desa', '33fdb65d-93a8-485f-8aed-b976e1db5395'),
(5, 'Kejahahatan Malama', 1, 'Ada yang Jahat', 'Koala.jpg', '2021-02-03 22:44:37', 'Tanggapi', 'Ronda Malam', '33fdb65d-93a8-485f-8aed-b976e1db5395'),
(10, 'pengamen masuk desa', 4, 'tutup pintu masuk saja', 'Penguins.jpg', '2021-02-04 00:01:04', 'Selesai', 'ok', '33fdb65d-93a8-485f-8aed-b976e1db5395');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` varchar(50) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('Administrator','Petugas','Pengadu') NOT NULL DEFAULT 'Pengadu',
  `grup` enum('A','B') NOT NULL DEFAULT 'B'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`, `grup`) VALUES
('059549eb-1d4e-4ead-a941-024cbf8015e2', 'Daniar', 'dani', '123', 'Pengadu', 'B'),
('33fdb65d-93a8-485f-8aed-b976e1db5395', 'Joni Tralala', 'joni', '123', 'Pengadu', 'B'),
('5351949a-6598-11eb-96e0-60eb69a13690', 'Jumanto', 'tugas', '1', 'Petugas', 'A'),
('766b07b7-658e-11eb-96e0-60eb69a13690', 'Zainal Arifin', 'admin', '1', 'Administrator', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_telegram`
--

CREATE TABLE `tb_telegram` (
  `id_telegram` varchar(5) NOT NULL,
  `user` varchar(20) NOT NULL,
  `id_chat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_telegram`
--

INSERT INTO `tb_telegram` (`id_telegram`, `user`, `id_chat`) VALUES
('tL9', 'Akun Telegram Admin', '1399255546');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tb_pengadu`
--
ALTER TABLE `tb_pengadu`
  ADD PRIMARY KEY (`id_pengadu`);

--
-- Indeks untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `jenis` (`jenis`),
  ADD KEY `author` (`author`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `tb_telegram`
--
ALTER TABLE `tb_telegram`
  ADD PRIMARY KEY (`id_telegram`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD CONSTRAINT `tb_pengaduan_ibfk_1` FOREIGN KEY (`jenis`) REFERENCES `tb_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengaduan_ibfk_2` FOREIGN KEY (`author`) REFERENCES `tb_pengadu` (`id_pengadu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
