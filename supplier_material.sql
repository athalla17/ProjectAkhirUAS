-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2023 pada 15.18
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atala`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berkas`
--

CREATE TABLE `berkas` (
  `kodeberkas` int(11) NOT NULL,
  `npwp1` text NOT NULL,
  `npwp2` text NOT NULL,
  `ktp` text NOT NULL,
  `cv` text NOT NULL,
  `skrek` text NOT NULL,
  `akta` text NOT NULL,
  `siupm` text NOT NULL,
  `skdom` text NOT NULL,
  `skreg` text NOT NULL,
  `pajak` text NOT NULL,
  `sppajak` text NOT NULL,
  `kodepengguna` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `berkas`
--

INSERT INTO `berkas` (`kodeberkas`, `npwp1`, `npwp2`, `ktp`, `cv`, `skrek`, `akta`, `siupm`, `skdom`, `skreg`, `pajak`, `sppajak`, `kodepengguna`) VALUES
(1, 'KTP-NISAUTTHOHAROH.jpg', 'Gambar WhatsApp 2022-12-07 pukul 15.34.02.jpg', 'WhatsApp Image 2022-12-06 at 23.04.51.jpeg', 'Undangan Gopret.pdf', 'CV Neko Rossa Regeta.pdf', 'JURNAL MOOC PPPK UMAM.pdf', 'tes.pdf', 'nilai-mutlak.pdf', 'Cetak kartu_ujian-0720012521 (1).pdf', 'Catatan.pdf', 'Selamat datang selamat bergabung silahkan dilihat lihat dulu etalase etalase kami ya kak.pdf', 'SUP000008'),
(2, 'Cuplikan layar_20221030_192941.png', 'Cuplikan layar_20221030_192917.png', 'Cuplikan layar_20221030_192903.png', 'POS US A3.pdf', 'JURNAL MOOC PPPK UMAM_1.pdf', 'POS US F4.pdf', 'RPP Fungsi (Pertemuan 3-6).pdf', 'MAT028202310120LEMBAR KELENGKAPAN TUGAS UAS.pdf', 'MAT028202310120LEMBAR KELENGKAPAN TUGAS UAS_1.pdf', 'kelompok 4.pdf', 'STORYLINE-STORYBOARD-FLOWCHART.pdf', 'SUP000001'),
(3, 'Cuplikan layar 2022-11-02 110538.png', 'Cuplikan layar 2022-11-30 205853.png', 'Cuplikan layar 2022-10-30 193008.png', 'translate Agustini_2017_J._Phys.__Conf._Ser._895_012148.en.id.pdf', 'MAT0282023101108. Validitas .pdf', 'Artikel Inter_Kuantitatif_Neko Rossa Regeta.pdf', 'MAT028202310197. Teknik Penskoran.pdf', 'MAT028202310118Analisis Tes Pilihan Ganda.pdf', 'MAT0282023101129. Reliabilitas.pdf', 'Penyusunan Instrumen Tes.pdf', 'non tes self-efficacy.pdf', 'SUP000003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `kodehasil` int(11) NOT NULL,
  `na` double NOT NULL,
  `kodeproyek` char(9) NOT NULL,
  `kodepengguna` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `indikator`
--

CREATE TABLE `indikator` (
  `kodeindikator` char(9) NOT NULL,
  `indikator` varchar(54) NOT NULL,
  `nilai` int(11) NOT NULL,
  `kodekriteria` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `indikator`
--

INSERT INTO `indikator` (`kodeindikator`, `indikator`, `nilai`, `kodekriteria`) VALUES
('IDK000001', '0,5 - 1 cm ', 4, 'KRPRY0001'),
('IDK000002', '1 - 2 cm', 3, 'KRPRY0001'),
('IDK000003', '2 - 3 cm', 2, 'KRPRY0001'),
('IDK000004', '3 - 5 cm', 1, 'KRPRY0001'),
('IDK000005', '3,5 - 4 kubik', 3, 'KRPRY0002'),
('IDK000006', '4 - 7 kubik ', 2, 'KRPRY0002'),
('IDK000007', '7 - 10 kubik', 1, 'KRPRY0002'),
('IDK000008', '1-4 kg ', 3, 'KRPRY0003'),
('IDK000009', '4 - 7 kg ', 2, 'KRPRY0003'),
('IDK000010', '7 - 10 kg ', 1, 'KRPRY0003'),
('IDK000011', '30 - 40 liter', 1, 'KRPRY0004'),
('IDK000012', '20 - 30 liter ', 2, 'KRPRY0004'),
('IDK000013', '10 - 20 liter', 3, 'KRPRY0004'),
('IDK000014', '5 - 10 liter ', 4, 'KRPRY0004'),
('IDK000015', '15 - 20 kg ', 4, 'KRPRY0005'),
('IDK000016', '10 - 15 kg ', 3, 'KRPRY0005'),
('IDK000017', '5 - 10 kg ', 2, 'KRPRY0005'),
('IDK000018', '3 - 5 kg ', 1, 'KRPRY0005'),
('IDK000026', 'Pernah Menangani Proyek Berskala Besar', 4, 'KRPRY0006'),
('IDK000027', 'Pernah Menangani Proyek Berskala Sedang', 3, 'KRPRY0006'),
('IDK000028', 'Pernah Menangani Proyek Berskala Kecil', 2, 'KRPRY0006'),
('IDK000029', 'Tidak Diketahui (Supplier Baru)', 1, 'KRPRY0006');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kodekriteria` char(9) NOT NULL,
  `kriteria` varchar(27) NOT NULL,
  `kategori` enum('Cost','Benefit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kodekriteria`, `kriteria`, `kategori`) VALUES
('KRPRY0001', 'Batu Pecah', 'Benefit'),
('KRPRY0002', 'Abu Batu', 'Benefit'),
('KRPRY0003', 'Aspal', 'Benefit'),
('KRPRY0004', 'Solar', 'Cost'),
('KRPRY0005', 'Kayu Bakar', 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `kodenilai` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `kodeindikator` char(9) NOT NULL,
  `kodekriteria` char(9) NOT NULL,
  `kodeproyek` char(9) NOT NULL,
  `kodepengguna` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `kodepengguna` char(9) NOT NULL,
  `nama` varchar(63) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(45) NOT NULL,
  `provinsi` varchar(27) NOT NULL,
  `telepon` char(14) NOT NULL,
  `username` varchar(99) NOT NULL,
  `password` char(32) NOT NULL,
  `level` enum('admin','supplier') NOT NULL,
  `status` enum('0','1','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`kodepengguna`, `nama`, `alamat`, `kota`, `provinsi`, `telepon`, `username`, `password`, `level`, `status`) VALUES
('SUP000001', 'Nama Supplier 1', 'alamat lengkap supplier', 'Pekalongan', 'Jawa Tengah', '08123456789', 'nama994', 'e10adc3949ba59abbe56e057f20f883e', 'supplier', '1'),
('SUP000002', 'Nama Supplier 2', 'alamat lengkap supplier', 'Pekalongan', 'Jawa Tengah', '08123456789', 'nama622', 'e10adc3949ba59abbe56e057f20f883e', 'supplier', '1'),
('SUP000003', 'Nama Supplier 3', 'alamat lengkap supplier', 'Batang', 'Jawa Tengah', '08123456789', 'nama460', 'e10adc3949ba59abbe56e057f20f883e', 'supplier', '1'),
('SUP000004', 'Nama Supplier 4', 'alamat lengkap supplier', 'Batang', 'Jawa Tengah', '08123456789', 'nama901', 'e10adc3949ba59abbe56e057f20f883e', 'supplier', '1'),
('SUP000005', 'Nama Supplier 5', 'alamat lengkap supplier', 'Pekalongan', 'Jawa Tengah', '08123456789', 'nama368', 'e10adc3949ba59abbe56e057f20f883e', 'supplier', '1'),
('SUP000006', 'Nama Supplier 6', 'alamat lengkap supplier', 'Pekalongan', 'Jawa Tengah', '08123456789', 'nama267', 'e10adc3949ba59abbe56e057f20f883e', 'supplier', '1'),
('SUP000007', 'atha', 'bandar batang ', 'Batang', 'Jawa Tengah', '082578348931', 'atha117', 'e10adc3949ba59abbe56e057f20f883e', 'supplier', '1'),
('SUP000008', 'naufal', 'Karangasem Utara rt3/rw4 Batang', 'Batang', 'Jawa Tengah', '082568125957', 'naufal201', 'e10adc3949ba59abbe56e057f20f883e', 'supplier', '1'),
('USER00000', 'Administrator', 'Jalan Raya Sidomulyo-Bandar, Kec. Bandar, Kabupaten Batang, Jawa Tengah 51254', 'Pekalongan', 'Jawa Tengah', '(0285) 689001', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `kodeproyek` char(9) NOT NULL,
  `proyek` varchar(99) NOT NULL,
  `deskripsi` text NOT NULL,
  `biaya` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`kodeproyek`, `proyek`, `deskripsi`, `biaya`, `status`) VALUES
('P08123022', 'Perbaikan Jalan Bandar - Gerlang Kecamatan Blado', 'Perbaikan jalan bandar gerlang yang berada di kecamatan Blado yaitu di km 21 ada beberapa lubang kecil sampai besar yang harus di perbaiki. jarak perbaikan 700 meter dari kerusakan pertama sampai terakhir. yang membutuhkan material berupa Batu Pecah 3-5cm sebanyak 3 kubik , Abu Batu 4-7 kubik, Aspal 1-4 kg, Solar 5-10 liter, dan kayu bakar 10-15kg ', 75000000, '1'),
('P16115522', 'Perbaikan Jalan Bandar - Sidayu Kecamatan Bandar ', 'Perbaikan jalan bandar sidayu yang berada di kecamatan Bandar yaitu di km 4 ada beberapa lubang kecil, jarak perbaikan 220 meter dari kerusakan pertama sampai terakhir. yang membutuhkan material berupa Batu Pecah 1-2cm sebanyak .... , Abu Batu 4-7 kubik, Aspal 1-4 kg, Solar 5-10 liter, dan kayu bakar 5-10kg ', 12500000, '1'),
('P16117522', 'Perbaikan Jalan Bandar - Tulis Kecamatan Bandar ', 'Perbaikan jalan bandar tulis yang berada di kecamatan Bandar yaitu di km 17 ada beberapa lubang kecil, jarak perbaikan 500 meter dari kerusakan pertama sampai terakhir. yang membutuhkan material berupa Batu Pecah 1-2cm sebanyak .... , Abu Batu 4-7 kubik, Aspal 1-4 kg, Solar 5-10 liter, dan kayu bakar 5-10kg ', 34500000, '1'),
('P16119022', 'Perbaikan Jalan Blado - Genting Kecamatan Blado', 'Perbaikan jalan blado genting yang berada di kecamatan Blado yaitu di km 7 ada beberapa lubang kecil, jarak perbaikan 350 meter dari kerusakan pertama sampai terakhir. yang membutuhkan material berupa Batu Pecah 1-2cm sebanyak .... , Abu Batu 4-7 kubik, Aspal 1-4 kg, Solar 5-10 liter, dan kayu bakar 5-10kg ', 15000000, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `register`
--

CREATE TABLE `register` (
  `koderegister` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` enum('0','1') NOT NULL,
  `kodepengguna` char(9) NOT NULL,
  `kodeproyek` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `register`
--

INSERT INTO `register` (`koderegister`, `waktu`, `status`, `kodepengguna`, `kodeproyek`) VALUES
(1, '2022-11-29 21:10:18', '1', 'SUP000001', 'P16115522'),
(2, '2022-11-30 07:47:04', '1', 'SUP000002', 'P16115522'),
(3, '2022-11-30 08:49:45', '1', 'SUP000002', 'P16119022'),
(4, '2022-11-30 10:12:17', '1', 'SUP000005', 'P16115522'),
(5, '2022-11-30 10:12:49', '1', 'SUP000006', 'P16115522'),
(7, '2022-12-08 12:24:45', '1', 'SUP000003', 'P16117522'),
(8, '2022-12-08 12:27:10', '1', 'SUP000004', 'P16117522'),
(9, '2022-12-08 12:28:00', '1', 'SUP000005', 'P16117522'),
(10, '2022-12-14 18:59:15', '1', 'SUP000006', 'P08123022'),
(11, '2022-12-14 18:59:41', '1', 'SUP000006', 'P16117522'),
(12, '2022-12-15 12:37:15', '1', 'SUP000002', 'P08123022'),
(13, '2023-01-16 09:02:18', '1', 'SUP000001', 'P16119022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skema`
--

CREATE TABLE `skema` (
  `kodeskema` int(11) NOT NULL,
  `bobot` int(11) NOT NULL,
  `kodekriteria` char(9) NOT NULL,
  `kodeproyek` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skema`
--

INSERT INTO `skema` (`kodeskema`, `bobot`, `kodekriteria`, `kodeproyek`) VALUES
(2, 20, 'KRPRY0001', 'P16117522'),
(3, 30, 'KRPRY0003', 'P16117522'),
(5, 15, 'KRPRY0004', 'P16117522'),
(6, 20, 'KRPRY0001', 'P16115522'),
(7, 25, 'KRPRY0002', 'P16115522'),
(8, 15, 'KRPRY0004', 'P16115522'),
(9, 20, 'KRPRY0001', 'P16119022'),
(10, 25, 'KRPRY0002', 'P16119022'),
(11, 30, 'KRPRY0003', 'P16119022'),
(12, 15, 'KRPRY0004', 'P16119022'),
(13, 10, 'KRPRY0005', 'P16119022'),
(14, 20, 'KRPRY0001', 'P08123022'),
(15, 25, 'KRPRY0002', 'P08123022'),
(16, 30, 'KRPRY0003', 'P08123022'),
(17, 15, 'KRPRY0004', 'P08123022'),
(18, 10, 'KRPRY0005', 'P08123022'),
(19, 15, 'KRPRY0006', 'P08123022'),
(20, 30, 'KRPRY0003', 'P16115522'),
(21, 10, 'KRPRY0005', 'P16115522'),
(22, 25, 'KRPRY0002', 'P16117522'),
(23, 10, 'KRPRY0005', 'P16117522');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`kodeberkas`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`kodehasil`);

--
-- Indeks untuk tabel `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`kodeindikator`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kodekriteria`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`kodenilai`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kodepengguna`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`kodeproyek`);

--
-- Indeks untuk tabel `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`koderegister`);

--
-- Indeks untuk tabel `skema`
--
ALTER TABLE `skema`
  ADD PRIMARY KEY (`kodeskema`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berkas`
--
ALTER TABLE `berkas`
  MODIFY `kodeberkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `kodehasil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `kodenilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `register`
--
ALTER TABLE `register`
  MODIFY `koderegister` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `skema`
--
ALTER TABLE `skema`
  MODIFY `kodeskema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
