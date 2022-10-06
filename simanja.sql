-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Okt 2022 pada 09.15
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simanja`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengajuan`
--

CREATE TABLE `detail_pengajuan` (
  `nopengajuan` varchar(6) NOT NULL,
  `nim` varchar(13) NOT NULL,
  `tglmulai` date NOT NULL,
  `tglselesai` date NOT NULL,
  `posisi_sbg` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pengajuan`
--

INSERT INTO `detail_pengajuan` (`nopengajuan`, `nim`, `tglmulai`, `tglselesai`, `posisi_sbg`) VALUES
('220501', '2002210000105', '2022-05-18', '2022-12-18', 'Admin'),
('220502', '1902210040014', '2022-05-20', '2022-08-20', 'Admin'),
('220503', '1902210040014', '2022-05-20', '2022-08-31', 'Admin'),
('220440', '1902210040020', '2022-01-27', '2022-05-31', 'Admin'),
('220504', '1902210040020', '2021-05-25', '2021-08-25', 'Admin'),
('220902', '1902210040014', '2022-09-26', '2022-12-26', 'Marketing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `idkelas` smallint(3) NOT NULL,
  `namakelas` varchar(10) NOT NULL,
  `jurusan` varchar(23) NOT NULL,
  `thnajaran` year(4) NOT NULL,
  `warna` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`idkelas`, `namakelas`, `jurusan`, `thnajaran`, `warna`) VALUES
(1, 'iks 53', 'informatics computer', 2019, 'progress-bar bg-primary'),
(2, 'iks 54', 'informatics computer', 2020, 'progress-bar bg-navy'),
(3, 'kas 63', 'computerized accounting', 2019, 'progress-bar bg-orange'),
(4, 'kas 64', 'computerized accounting', 2020, 'progress-bar bg-warning'),
(5, 'kas 65', 'computerized accounting', 2020, 'progress-bar bg-pink'),
(6, 'bas 50', 'business administration', 2020, 'progress-bar bg-danger'),
(8, 'sks 29', 'secretary', 2020, 'progress-bar bg-success'),
(9, 'sks 30', 'secretary', 2020, 'progress-bar bg-lime'),
(10, 'oms-o', 'office management', 2019, 'progress-bar bg-olive'),
(11, 'oms 50', 'office management', 2020, 'progress-bar bg-info');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(13) NOT NULL,
  `jeniskelamin` varchar(1) NOT NULL,
  `tmplahir` varchar(30) NOT NULL,
  `tgllahir` date NOT NULL,
  `agama` varchar(8) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `sma` varchar(40) NOT NULL,
  `jurusansma` varchar(35) NOT NULL,
  `idkelas` smallint(3) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kendaraan` smallint(1) NOT NULL,
  `sim` varchar(7) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `bahasa` varchar(30) NOT NULL,
  `domisili` varchar(20) NOT NULL,
  `statusnikah` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `jeniskelamin`, `tmplahir`, `tgllahir`, `agama`, `nohp`, `sma`, `jurusansma`, `idkelas`, `alamat`, `kendaraan`, `sim`, `posisi`, `bahasa`, `domisili`, `statusnikah`) VALUES
('1902210040014', 'l', 'Cilegon', '2001-07-08', 'Islam', '08000000000000', 'SMK YP Fatahillah 2 Cilegon', 'Teknik Komputer dan Jaringan', 1, 'Jl. Sama Kamu No. 1', 1, 'C', 'Admin', 'B. Inggris', 'Cilegon - Banten', 1),
('1902210040020', 'l', 'Cilegon', '2022-05-18', 'Islam', '089610129175', 'SMK YP Fatahillah 2 Cilegon', 'Teknik Komputer dan Jaringan', 1, 'Jl. Sama Kamu No.2', 1, 'C', 'Admin', 'B. Inggris', 'Cilegon - Banten', 1),
('2002210000001', 'l', 'tegal', '2001-05-01', '', '081000000001', '', '', 2, 'Jl. Suka Rame No. 1', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000002', 'l', 'cilegon', '2001-05-02', '', '081000000002', '', '', 2, 'Jl. Suka Rame No. 2', 2, '', '', '', 'Cilegon - Banten', 1),
('2002210000003', 'l', 'serang', '2001-05-03', '', '081000000003', '', '', 2, 'Jl. Suka Rame No. 3', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000004', 'p', 'serang', '2001-05-04', '', '081000000004', '', '', 2, 'Jl. Suka Rame No. 4', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000005', 'p', 'serang', '2001-05-05', '', '081000000005', '', '', 2, 'Jl. Suka Rame No. 5', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000006', 'l', 'cilegon', '2001-05-06', '', '081000000006', '', '', 2, 'Jl. Suka Rame No. 6', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000007', 'p', 'serang', '2001-05-07', '', '081000000007', '', '', 2, 'Jl. Suka Rame No. 7', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000008', 'l', 'cilegon', '2001-05-08', '', '081000000008', '', '', 2, 'Jl. Suka Rame No. 8', 2, '', '', '', 'Anyer - Merak', 1),
('2002210000009', 'l', 'cilegon', '2001-05-09', '', '081000000009', '', '', 1, 'Jl. Suka Rame No. 9', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000010', 'l', 'tegal', '2001-05-10', '', '081000000010', '', '', 2, 'Jl. Suka Rame No. 10', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000011', 'l', 'cilegon', '2001-05-11', '', '081000000011', '', '', 2, 'Jl. Suka Rame No. 11', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000012', 'l', 'cilegon', '2001-05-12', '', '081000000012', '', '', 2, 'Jl. Suka Rame No. 12', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000013', 'l', 'cilegon', '2001-05-13', '', '081000000013', '', '', 2, 'Jl. Suka Rame No. 13', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000014', 'l', 'serang', '2001-05-14', '', '081000000014', '', '', 2, 'Jl. Suka Rame No. 14', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000015', 'l', 'cilegon', '2001-05-15', '', '081000000015', '', '', 2, 'Jl. Suka Rame No. 15', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000016', 'l', 'serang', '2001-05-16', '', '081000000016', '', '', 2, 'Jl. Suka Rame No. 16', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000017', 'l', 'cilegon', '2001-05-17', '', '081000000017', '', '', 2, 'Jl. Suka Rame No. 17', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000018', 'l', 'cilegon', '2001-05-18', '', '081000000018', '', '', 2, 'Jl. Suka Rame No. 18', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000019', 'l', 'cilegon', '2001-05-19', '', '081000000019', '', '', 2, 'Jl. Suka Rame No. 19', 2, '', '', '', 'Cilegon - Banten', 1),
('2002210000020', 'l', 'cilegon', '2001-05-20', '', '081000000020', '', '', 2, 'Jl. Suka Rame No. 20', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000021', 'l', 'serang', '2001-05-21', '', '081000000021', '', '', 2, 'Jl. Suka Rame No. 21', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000022', 'l', 'cilegon', '2001-05-22', '', '081000000022', '', '', 2, 'Jl. Suka Rame No. 22', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000023', 'l', 'cilegon', '2001-05-23', '', '081000000023', '', '', 1, 'Jl. Suka Rame No. 23', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000024', 'l', 'cilegon', '2001-05-24', '', '081000000024', '', '', 2, 'Jl. Suka Rame No. 24', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000025', 'l', 'serang', '2001-05-25', '', '081000000025', '', '', 2, 'Jl. Suka Rame No. 25', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000026', 'p', 'cilegon', '2001-05-26', '', '081000000026', '', '', 2, 'Jl. Suka Rame No. 26', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000027', 'p', 'cilegon', '2001-05-27', '', '081000000027', '', '', 2, 'Jl. Suka Rame No. 27', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000028', 'l', 'cilegon', '2001-05-28', '', '081000000028', '', '', 1, 'Jl. Suka Rame No. 28', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000029', 'p', 'serang', '2001-05-29', '', '081000000029', '', '', 5, 'Jl. Suka Rame No. 29', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000030', 'p', 'cilegon', '2001-05-30', '', '081000000030', '', '', 5, 'Jl. Suka Rame No. 30', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000031', 'l', 'cilegon', '2001-05-31', '', '081000000031', '', '', 5, 'Jl. Suka Rame No. 31', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000032', 'p', 'tegal', '2001-06-01', '', '081000000032', '', '', 5, 'Jl. Suka Rame No. 32', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000033', 'l', 'cilegon', '2001-06-02', '', '081000000033', '', '', 3, 'Jl. Suka Rame No. 33', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000034', 'p', 'cilegon', '2001-06-03', '', '081000000034', '', '', 5, 'Jl. Suka Rame No. 34', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000035', 'p', 'cilegon', '2001-06-04', '', '081000000035', '', '', 5, 'Jl. Suka Rame No. 35', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000036', 'p', 'serang', '2001-06-05', '', '081000000036', '', '', 5, 'Jl. Suka Rame No. 36', 2, '', '', '', 'Cilegon - Banten', 1),
('2002210000037', 'p', 'cilegon', '2001-06-06', '', '081000000037', '', '', 5, 'Jl. Suka Rame No. 37', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000038', 'p', 'cilegon', '2001-06-07', '', '081000000038', '', '', 5, 'Jl. Suka Rame No. 38', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000039', 'p', 'cilegon', '2001-06-08', '', '081000000039', '', '', 5, 'Jl. Suka Rame No. 39', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000040', 'p', 'cilegon', '2001-06-09', '', '081000000040', '', '', 5, 'Jl. Suka Rame No. 40', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000041', 'l', 'cilegon', '2001-06-10', '', '081000000041', '', '', 4, 'Jl. Suka Rame No. 41', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000042', 'p', 'serang', '2001-06-11', '', '081000000042', '', '', 5, 'Jl. Suka Rame No. 42', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000043', 'p', 'tegal', '2001-06-12', '', '081000000043', '', '', 4, 'Jl. Suka Rame No. 43', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000044', 'p', 'cilegon', '2001-06-13', '', '081000000044', '', '', 5, 'Jl. Suka Rame No. 44', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000045', 'l', 'cilegon', '2001-06-14', '', '081000000045', '', '', 5, 'Jl. Suka Rame No. 45', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000046', 'p', 'cilegon', '2001-06-15', '', '081000000046', '', '', 5, 'Jl. Suka Rame No. 46', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000047', 'p', 'cilegon', '2001-06-16', '', '081000000047', '', '', 5, 'Jl. Suka Rame No. 47', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000048', 'p', 'cilegon', '2001-06-17', '', '081000000048', '', '', 5, 'Jl. Suka Rame No. 48', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000049', 'p', 'serang', '2001-06-18', '', '081000000049', '', '', 5, 'Jl. Suka Rame No. 49', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000050', 'l', 'cilegon', '2001-06-19', '', '081000000050', '', '', 5, 'Jl. Suka Rame No. 50', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000051', 'l', 'cilegon', '2001-06-20', '', '081000000051', '', '', 5, 'Jl. Suka Rame No. 51', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000052', 'p', 'serang', '2001-06-21', '', '081000000052', '', '', 5, 'Jl. Suka Rame No. 52', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000053', 'p', 'cilegon', '2001-06-22', '', '081000000053', '', '', 5, 'Jl. Suka Rame No. 53', 2, '', '', '', 'Cilegon - Banten', 1),
('2002210000054', 'p', 'serang', '2001-06-23', '', '081000000054', '', '', 5, 'Jl. Suka Rame No. 54', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000055', 'p', 'cilegon', '2001-06-24', '', '081000000055', '', '', 5, 'Jl. Suka Rame No. 55', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000056', 'p', 'cilegon', '2001-06-25', '', '081000000056', '', '', 5, 'Jl. Suka Rame No. 56', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000057', 'p', 'cilegon', '2001-06-26', '', '081000000057', '', '', 5, 'Jl. Suka Rame No. 57', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000058', 'p', 'cilegon', '2001-06-27', '', '081000000058', '', '', 5, 'Jl. Suka Rame No. 58', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000059', 'p', 'serang', '2001-06-28', '', '081000000059', '', '', 5, 'Jl. Suka Rame No. 59', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000060', 'p', 'cilegon', '2001-06-29', '', '081000000060', '', '', 5, 'Jl. Suka Rame No. 60', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000061', 'l', 'cilegon', '2001-06-30', '', '081000000061', '', '', 6, 'Jl. Suka Rame No. 61', 3, '', '', '', 'Anyer - Merak', 1),
('2002210000062', 'p', 'cilegon', '2001-07-01', '', '081000000062', '', '', 6, 'Jl. Suka Rame No. 62', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000063', 'l', 'serang', '2001-07-02', '', '081000000063', '', '', 6, 'Jl. Suka Rame No. 63', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000064', 'p', 'cilegon', '2001-07-03', '', '081000000064', '', '', 6, 'Jl. Suka Rame No. 64', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000065', 'p', 'cilegon', '2001-07-04', '', '081000000065', '', '', 6, 'Jl. Suka Rame No. 65', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000066', 'l', 'cilegon', '2001-07-05', '', '081000000066', '', '', 6, 'Jl. Suka Rame No. 66', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000067', 'p', 'cilegon', '2001-07-06', '', '081000000067', '', '', 6, 'Jl. Suka Rame No. 67', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000068', 'p', 'serang', '2001-07-07', '', '081000000068', '', '', 6, 'Jl. Suka Rame No. 68', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000069', 'p', 'cilegon', '2001-07-08', '', '081000000069', '', '', 6, 'Jl. Suka Rame No. 69', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000070', 'p', 'serang', '2001-07-09', '', '081000000070', '', '', 6, 'Jl. Suka Rame No. 70', 2, '', '', '', 'Cilegon - Banten', 1),
('2002210000071', 'p', 'cilegon', '2001-07-10', '', '081000000071', '', '', 6, 'Jl. Suka Rame No. 71', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000072', 'p', 'cilegon', '2001-07-11', '', '081000000072', '', '', 6, 'Jl. Suka Rame No. 72', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000073', 'l', 'tegal', '2001-07-12', '', '081000000073', '', '', 6, 'Jl. Suka Rame No. 73', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000074', 'p', 'cilegon', '2001-07-13', '', '081000000074', '', '', 6, 'Jl. Suka Rame No. 74', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000075', 'p', 'cilegon', '2001-07-14', '', '081000000075', '', '', 6, 'Jl. Suka Rame No. 75', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000076', 'p', 'cilegon', '2001-07-15', '', '081000000076', '', '', 6, 'Jl. Suka Rame No. 76', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000077', 'p', 'cilegon', '2001-07-16', '', '081000000077', '', '', 6, 'Jl. Suka Rame No. 77', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000078', 'p', 'serang', '2001-07-17', '', '081000000078', '', '', 6, 'Jl. Suka Rame No. 78', 2, '', '', '', 'Cilegon - Banten', 1),
('2002210000079', 'p', 'cilegon', '2001-07-18', '', '081000000079', '', '', 6, 'Jl. Suka Rame No. 79', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000080', 'p', 'cilegon', '2001-07-19', '', '081000000080', '', '', 6, 'Jl. Suka Rame No. 80', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000081', 'p', 'cilegon', '2001-07-20', '', '081000000081', '', '', 6, 'Jl. Suka Rame No. 81', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000082', 'p', 'cilegon', '2001-07-21', '', '081000000082', '', '', 6, 'Jl. Suka Rame No. 82', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000083', 'p', 'tegal', '2001-07-22', '', '081000000083', '', '', 6, 'Jl. Suka Rame No. 83', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000084', 'p', 'cilegon', '2001-07-23', '', '081000000084', '', '', 8, 'Jl. Suka Rame No. 84', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000085', 'p', 'cilegon', '2001-07-24', '', '081000000085', '', '', 9, 'Jl. Suka Rame No. 85', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000086', 'p', 'cilegon', '2001-07-25', '', '081000000086', '', '', 8, 'Jl. Suka Rame No. 86', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000087', 'p', 'cilegon', '2001-07-26', '', '081000000087', '', '', 9, 'Jl. Suka Rame No. 87', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000088', 'p', 'serang', '2001-07-27', '', '081000000088', '', '', 9, 'Jl. Suka Rame No. 88', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000089', 'p', 'cilegon', '2001-07-28', '', '081000000089', '', '', 9, 'Jl. Suka Rame No. 89', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000090', 'p', 'serang', '2001-07-29', '', '081000000090', '', '', 9, 'Jl. Suka Rame No. 90', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000091', 'p', 'cilegon', '2001-07-30', '', '081000000091', '', '', 9, 'Jl. Suka Rame No. 91', 3, '', '', '', 'Pandeglang - Banten', 1),
('2002210000092', 'p', 'serang', '2001-07-31', '', '081000000092', '', '', 9, 'Jl. Suka Rame No. 92', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000093', 'p', 'serang', '2001-08-01', '', '081000000093', '', '', 9, 'Jl. Suka Rame No. 93', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000094', 'p', 'cilegon', '2001-08-02', '', '081000000094', '', '', 9, 'Jl. Suka Rame No. 94', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000095', 'p', 'tegal', '2001-08-03', '', '081000000095', '', '', 9, 'Jl. Suka Rame No. 95', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000096', 'p', 'cilegon', '2001-08-04', '', '081000000096', '', '', 9, 'Jl. Suka Rame No. 96', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000097', 'p', 'cilegon', '2001-08-05', '', '081000000097', '', '', 9, 'Jl. Suka Rame No. 97', 3, '', '', '', 'Anyer - Merak', 1),
('2002210000098', 'p', 'serang', '2001-08-06', '', '081000000098', '', '', 9, 'Jl. Suka Rame No. 98', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000099', 'p', 'cilegon', '2001-08-07', '', '081000000099', '', '', 9, 'Jl. Suka Rame No. 99', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000100', 'p', 'cilegon', '2001-08-08', '', '081000000100', '', '', 9, 'Jl. Suka Rame No. 100', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000101', 'p', 'serang', '2001-08-09', '', '081000000101', '', '', 9, 'Jl. Suka Rame No. 101', 3, '', '', '', 'Pandeglang - Banten', 1),
('2002210000102', 'l', 'cilegon', '2001-08-10', '', '081000000102', '', '', 10, 'Jl. Suka Rame No. 102', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000103', 'l', 'serang', '2001-08-11', '', '081000000103', '', '', 10, 'Jl. Suka Rame No. 103', 2, '', '', '', 'Cilegon - Banten', 1),
('2002210000104', 'l', 'serang', '2001-08-12', '', '081000000104', '', '', 10, 'Jl. Suka Rame No. 104', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000105', 'p', 'cilegon', '2001-08-13', '', '081000000105', '', '', 10, 'Jl. Suka Rame No. 105', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000106', 'l', 'cilegon', '2001-08-14', '', '081000000106', '', '', 11, 'Jl. Suka Rame No. 106', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000107', 'p', 'tegal', '2001-08-15', '', '081000000107', '', '', 11, 'Jl. Suka Rame No. 107', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000108', 'p', 'cilegon', '2001-08-16', '', '081000000108', '', '', 11, 'Jl. Suka Rame No. 108', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000109', 'p', 'cilegon', '2001-08-17', '', '081000000109', '', '', 11, 'Jl. Suka Rame No. 109', 1, '', '', '', 'Anyer - Merak', 1),
('2002210000110', 'p', 'cilegon', '2001-08-18', '', '081000000110', '', '', 11, 'Jl. Suka Rame No. 110', 3, '', '', '', 'Cilegon - Banten', 1),
('2002210000111', 'p', 'serang', '2001-08-19', '', '081000000111', '', '', 11, 'Jl. Suka Rame No. 111', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000112', 'l', 'cilegon', '2001-08-20', '', '081000000112', '', '', 11, 'Jl. Suka Rame No. 112', 1, '', '', '', 'Pandeglang - Banten', 1),
('2002210000113', 'l', 'serang', '2001-08-21', '', '081000000113', '', '', 11, 'Jl. Suka Rame No. 113', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000114', 'p', 'cilegon', '2001-08-22', '', '081000000114', '', '', 11, 'Jl. Suka Rame No. 114', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000115', 'p', 'serang', '2001-08-23', '', '081000000115', '', '', 11, 'Jl. Suka Rame No. 115', 1, '', '', '', 'Cilegon - Banten', 1),
('2002210000116', 'l', 'cilegon', '2001-08-24', '', '081000000116', '', '', 11, 'Jl. Suka Rame No. 116', 2, '', '', '', 'Cilegon - Banten', 1),
('36', 'l', 'Cilegon', '2022-06-05', 'Islam', '089', '', '', 10, 'Link. Sumur watu, Deringo, Citangkil, Cilegon - Banten 42444', 0, '', '', '', '', 2022);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `nim` varchar(13) NOT NULL,
  `ipk1` decimal(3,2) NOT NULL,
  `ipk2` decimal(3,2) NOT NULL,
  `ipk3` decimal(3,2) NOT NULL,
  `ipk4` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`nim`, `ipk1`, `ipk2`, `ipk3`, `ipk4`) VALUES
('2002210000001', '3.25', '2.75', '3.00', '0.00'),
('2002210000002', '2.50', '2.75', '3.00', '0.00'),
('2002210000003', '2.53', '2.75', '3.00', '0.00'),
('2002210000004', '2.53', '2.75', '3.00', '0.00'),
('2002210000005', '2.53', '2.75', '3.00', '0.00'),
('2002210000006', '2.53', '2.75', '3.00', '0.00'),
('2002210000007', '2.53', '2.75', '3.00', '0.00'),
('2002210000008', '2.53', '2.75', '3.00', '0.00'),
('2002210000009', '2.53', '2.75', '3.00', '0.00'),
('2002210000010', '2.53', '2.75', '3.00', '0.00'),
('2002210000011', '2.53', '2.75', '3.00', '0.00'),
('2002210000012', '2.53', '2.75', '3.00', '0.00'),
('2002210000013', '2.53', '2.75', '3.00', '0.00'),
('2002210000014', '2.53', '2.75', '3.00', '0.00'),
('2002210000015', '2.53', '2.75', '3.00', '0.00'),
('2002210000016', '2.53', '2.75', '3.00', '0.00'),
('2002210000017', '2.53', '2.75', '3.00', '0.00'),
('2002210000018', '2.53', '2.75', '3.00', '0.00'),
('2002210000019', '2.53', '2.75', '3.00', '0.00'),
('2002210000020', '2.53', '2.75', '3.00', '0.00'),
('2002210000021', '2.53', '2.75', '3.00', '0.00'),
('2002210000022', '2.53', '2.75', '3.00', '0.00'),
('2002210000023', '2.53', '2.75', '3.00', '0.00'),
('2002210000024', '2.53', '2.75', '3.00', '0.00'),
('2002210000025', '2.53', '2.75', '3.00', '0.00'),
('2002210000026', '2.53', '2.75', '3.00', '0.00'),
('2002210000027', '2.53', '2.75', '3.00', '0.00'),
('2002210000028', '2.53', '2.75', '3.00', '0.00'),
('2002210000029', '2.53', '2.75', '3.00', '0.00'),
('2002210000030', '2.53', '2.75', '3.00', '0.00'),
('2002210000031', '2.53', '2.75', '3.00', '0.00'),
('2002210000032', '2.53', '2.75', '3.00', '0.00'),
('2002210000033', '2.53', '2.75', '3.00', '0.00'),
('2002210000034', '2.53', '2.75', '3.00', '0.00'),
('2002210000035', '2.53', '2.75', '3.00', '0.00'),
('2002210000036', '2.53', '2.75', '3.00', '0.00'),
('2002210000037', '2.53', '2.75', '3.00', '0.00'),
('2002210000038', '2.53', '2.75', '3.00', '0.00'),
('2002210000039', '2.53', '2.75', '3.00', '0.00'),
('2002210000040', '2.53', '2.75', '3.00', '0.00'),
('2002210000041', '2.53', '2.75', '3.00', '0.00'),
('2002210000042', '2.53', '2.75', '3.00', '0.00'),
('2002210000043', '2.53', '2.75', '3.00', '0.00'),
('2002210000044', '2.53', '2.75', '3.00', '0.00'),
('2002210000045', '2.53', '2.75', '3.00', '0.00'),
('2002210000046', '2.53', '2.75', '3.00', '0.00'),
('2002210000047', '2.53', '2.75', '3.00', '0.00'),
('2002210000048', '2.53', '2.75', '3.00', '0.00'),
('2002210000049', '2.53', '2.75', '3.00', '0.00'),
('2002210000050', '2.53', '2.75', '3.00', '0.00'),
('2002210000051', '2.53', '2.75', '3.00', '0.00'),
('2002210000052', '2.53', '2.75', '3.00', '0.00'),
('2002210000053', '2.53', '2.75', '3.00', '0.00'),
('2002210000054', '2.53', '2.75', '3.00', '0.00'),
('2002210000055', '2.53', '2.75', '3.00', '0.00'),
('2002210000056', '2.53', '2.75', '3.00', '0.00'),
('2002210000057', '2.53', '2.75', '3.00', '0.00'),
('2002210000058', '2.53', '2.75', '3.00', '0.00'),
('2002210000059', '2.53', '2.75', '3.00', '0.00'),
('2002210000060', '2.53', '2.75', '3.00', '0.00'),
('2002210000061', '2.53', '2.75', '3.00', '0.00'),
('2002210000062', '2.53', '2.75', '3.00', '0.00'),
('2002210000063', '2.53', '2.75', '3.00', '0.00'),
('2002210000064', '2.53', '2.75', '3.00', '0.00'),
('2002210000065', '2.53', '2.75', '3.00', '0.00'),
('2002210000066', '2.53', '2.75', '3.00', '0.00'),
('2002210000067', '2.53', '2.75', '3.00', '0.00'),
('2002210000068', '2.53', '2.75', '3.00', '0.00'),
('2002210000069', '2.53', '2.75', '3.00', '0.00'),
('2002210000070', '2.53', '2.75', '3.00', '0.00'),
('2002210000071', '2.53', '2.75', '3.00', '0.00'),
('2002210000072', '2.53', '2.75', '3.00', '0.00'),
('2002210000073', '2.53', '2.75', '3.00', '0.00'),
('2002210000074', '2.53', '2.75', '3.00', '0.00'),
('2002210000075', '2.53', '2.75', '3.00', '0.00'),
('2002210000076', '2.53', '2.75', '3.00', '0.00'),
('2002210000077', '2.53', '2.75', '3.00', '0.00'),
('2002210000078', '2.53', '2.75', '3.00', '0.00'),
('2002210000079', '2.53', '2.75', '3.00', '0.00'),
('2002210000080', '2.53', '2.75', '3.00', '0.00'),
('2002210000081', '2.53', '2.75', '3.00', '0.00'),
('2002210000082', '2.53', '2.75', '3.00', '0.00'),
('2002210000083', '2.53', '2.75', '3.00', '0.00'),
('2002210000084', '2.53', '2.75', '3.00', '0.00'),
('2002210000085', '2.53', '2.75', '3.00', '0.00'),
('2002210000086', '2.53', '2.75', '3.00', '0.00'),
('2002210000087', '2.53', '2.75', '3.00', '0.00'),
('2002210000088', '2.53', '2.75', '3.00', '0.00'),
('2002210000089', '2.53', '2.75', '3.00', '0.00'),
('2002210000090', '2.53', '2.75', '3.00', '0.00'),
('2002210000091', '2.53', '2.75', '3.00', '0.00'),
('2002210000092', '2.53', '2.75', '3.00', '0.00'),
('2002210000093', '2.53', '2.75', '3.00', '0.00'),
('2002210000094', '2.53', '2.75', '3.00', '0.00'),
('2002210000095', '2.53', '2.75', '3.00', '0.00'),
('2002210000096', '2.53', '2.75', '3.00', '0.00'),
('2002210000097', '2.53', '2.75', '3.00', '0.00'),
('2002210000098', '2.53', '2.75', '3.00', '0.00'),
('2002210000099', '2.53', '2.75', '3.00', '0.00'),
('2002210000100', '2.53', '2.75', '3.00', '0.00'),
('2002210000101', '2.53', '2.75', '3.00', '0.00'),
('2002210000102', '2.53', '2.75', '3.00', '0.00'),
('2002210000103', '2.53', '2.75', '3.00', '0.00'),
('2002210000104', '2.53', '2.75', '3.00', '0.00'),
('2002210000105', '2.53', '2.75', '3.00', '0.00'),
('2002210000106', '2.53', '2.75', '3.00', '0.00'),
('2002210000107', '2.53', '2.75', '3.00', '0.00'),
('2002210000108', '2.53', '2.75', '3.00', '0.00'),
('2002210000109', '2.53', '2.75', '3.00', '0.00'),
('2002210000110', '2.53', '2.75', '3.00', '0.00'),
('2002210000111', '2.53', '2.75', '3.00', '0.00'),
('2002210000112', '2.53', '2.75', '3.00', '0.00'),
('2002210000113', '2.53', '2.75', '3.00', '0.00'),
('2002210000114', '2.53', '2.75', '3.00', '0.00'),
('2002210000115', '2.53', '2.75', '3.00', '0.00'),
('2002210000116', '2.53', '2.75', '3.00', '0.00'),
('1902210040014', '2.75', '0.00', '0.00', '0.00'),
('1902210040020', '0.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `nopengajuan` varchar(6) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(6) NOT NULL,
  `idperusahaan` smallint(3) NOT NULL,
  `statuspengajuan` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`nopengajuan`, `tanggal`, `perihal`, `idperusahaan`, `statuspengajuan`) VALUES
('220440', '2022-04-14', 'Magang', 5, 4),
('220501', '2022-05-19', 'Magang', 10, 1),
('220502', '2022-05-20', 'Magang', 6, 4),
('220503', '2022-05-20', 'Kerja', 3, 1),
('220504', '2022-05-26', 'Magang', 2, 1),
('220902', '2022-09-20', 'Magang', 11, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `idperusahaan` smallint(3) NOT NULL,
  `namapt` varchar(50) NOT NULL,
  `alamatpt` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `bidang` varchar(30) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`idperusahaan`, `namapt`, `alamatpt`, `telepon`, `bidang`, `logo`) VALUES
(1, 'PT. MAJU SEJAHTERA', 'Jln. Santai No.3, Citangkil, Cilegon, Banten', '8452303', 'Pertambangan Batu Berlian', '4-images(2).png'),
(2, 'pt. cemerlang banten kertasindo', 'jl. kopo maja no.45, nyompok, kec. kopo, kabupaten serang, banten', '08126077561', 'pengolahan limbah kertas', ''),
(3, 'pt. tiban inten', 'jl. semendaran, rt 003/003, panggung rawi, kec. jombang, kota cilegon, banten 42412', '02547850333', 'layanan transportasi', ''),
(4, 'pt. harapan teknik shipyard', 'argawana, kec. puloampel, kabupaten serang, banten', '', 'docking kapal', ''),
(5, 'pt. alfa granitama', 'puloampel, kabupaten serang, banten 42455', '', 'pertambangan batu split', ''),
(6, 'pt. putra galuh persada', 'jl. raya merak no.21, rw.arum, kec. gerogol, kota cilegon, banten 42436', '02548494094', 'suku cadang mobil', ''),
(7, 'pt. sentra karya logistik', 'serdang, kec. kramatwatu, kabupaten serang, banten 42616', '087774244806', 'layanan logistik', ''),
(8, 'pt. krakatau posco energy', 'jl. afrika no.02, krakatau posco steel mill area, samangraya, citangkil, cilegon, banten 42443', '', 'pembangkit listrik', ''),
(9, 'horison altama pandeglang', 'kadumerak, kec. karang tj., kabupaten pandeglang, banten 42251', '0253202000', 'hotel', ''),
(10, 'pt. daekindo jaya perkasa', 'jl. lingkar selatan km 0,5, rt 005/006, kedaleman, kec. cibeber, kota cilegon, banten 42422', '08126631308', 'penyedia barang dan jasa', ''),
(11, 'uwais hijab', 'taman cilegon indah jl. boulevard no.12, sukmajaya, kota cilegon, banten 42416', '081288920707', 'butik', ''),
(12, 'pt. bumantara putra', 'jl. h. leman pintu air, link. kembang sawo, rt 02/11, gerem, kec. gerogol, kota cilegon, banten 4243', '', '', ''),
(13, 'pt. internasional total service & logistics', 'menara standard chartered, jl. prof. dr. satrio no.4, rt 04/04, karet semanggi, kecamatan setiabudi,', '02125532620', 'layanan logistik', ''),
(14, 'pt. daihatsu cilegon', 'jl. raya cilegon no.17, kedaleman, kec. cibeber, kota cilegon, banten 42422', '0254380502', 'dealer mobil', ''),
(15, 'pt. primaplast indonesia (primastraw)', 'jl. pengampelan rt 06/03 nambo, kaserangan, ciruas, kaserangan,  kec. serang, banten 42182', '02548285888', 'produksi sedotan', ''),
(16, 'pt. kerta mulya sari pakan', 'jl. raya serang - jkt no.99, sentul, kec. kragilan, kabupaten serang, banten 42184', '', 'produksi pakan sapi', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` varchar(13) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hakakses` smallint(1) NOT NULL,
  `statusakun` smallint(1) NOT NULL,
  `setting` varchar(4) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `hakakses`, `statusakun`, `setting`, `foto`) VALUES
('1', 'admin', 'admin@gmail.com', 'admin', 1, 1, '2019', '6360-foto3x4RGB.jpg'),
('1902210040014', 'Ikomul Mu\'minin', 'ikomdoank@gmail.com', 'mahasiswa', 2, 1, '', '425-foto3x4RGB.jpg'),
('1902210040020', 'Jamet', 'jamet@gmail.com', '12345678', 2, 1, '', ''),
('2', 'admin2', 'admin2@gmail.com', 'admin', 1, 2, '', ''),
('2002210000001', 'aditya yos gunawan', 'user1@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000002', 'agung prayoga', 'user2@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000003', 'ahmad mahdudi', 'user3@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000004', 'andini syahputri', 'user4@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000005', 'euis novia', 'user5@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000006', 'fadhil haidar ahmad', 'user6@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000007', 'haza verrany', 'user7@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000008', 'ilham mahfudi', 'user8@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000009', 'indiana duta arna', 'user9@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000010', 'iqbal yudha putra', 'user10@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000011', 'm. daffa fahlevi', 'user11@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000012', 'maulana hafiz assalam', 'user12@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000013', 'miftahul rizky', 'user13@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000014', 'muhamad apriyansyah', 'user14@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000015', 'muhamad iqbal', 'user15@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000016', 'muhammad guntur al-rizka prata', 'user16@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000017', 'muhammad sandy', 'user17@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000018', 'rafli firmansyah', 'user18@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000019', 'renaldy', 'user19@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000020', 'ridho asshiddiqy', 'user20@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000021', 'ridho rahmatulloh', 'user21@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000022', 'robby irfansyah', 'user22@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000023', 'romi miftah sururi', 'user23@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000024', 'steven untung sembuh sinaga', 'user24@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000025', 'tegar agus rohali', 'user25@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000026', 'tia hamdiyatu solihat', 'user26@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000027', 'tiara anjani', 'user27@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000028', 'umar dwi riyanto', 'user28@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000029', 'a\'inun nurhaliza', 'user29@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000030', 'aan najiah', 'user30@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000031', 'adrian fairuuz juanda', 'user31@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000032', 'alita dewi manekawati', 'user32@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000033', 'arif rahman hakim', 'user33@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000034', 'ariya dilla hasanudin', 'user34@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000035', 'atika maimunah', 'user35@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000036', 'aulfiya putri natasya', 'user36@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000037', 'azizah', 'user37@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000038', 'tri amaliya', 'user38@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000039', 'dea nathania', 'user39@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000040', 'dhona shelanita stefany', 'user40@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000041', 'dwianto nugraha', 'user41@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000042', 'erika mutiara', 'user42@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000043', 'faijah', 'user43@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000044', 'fani rahma sari', 'user44@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000045', 'fathi nur jayani', 'user45@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000046', 'febri hermawati', 'user46@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000047', 'finola aulia rahman', 'user47@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000048', 'gitta putri aprilia', 'user48@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000049', 'lisma amelia', 'user49@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000050', 'maulana herdiansyah', 'user50@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000051', 'muhamad alfin alfiana', 'user51@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000052', 'nadilah nufus', 'user52@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000053', 'priska mawar fajira', 'user53@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000054', 'risma dwi lestari', 'user54@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000055', 'salsabila windyani', 'user55@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000056', 'tia setia nengsih', 'user56@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000057', 'umaroh septiani putri', 'user57@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000058', 'umi faridah', 'user58@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000059', 'wulan suci ramanda', 'user59@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000060', 'zakiyatul zahro', 'user60@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000061', 'ahmad galfis maulana', 'user61@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000062', 'amelia', 'user62@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000063', 'andika pratama putra', 'user63@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000064', 'annisa dwi ramadhanti kusnadi', 'user64@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000065', 'chairun meiriyani', 'user65@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000066', 'dafiq al fathdien', 'user66@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000067', 'fany anggraeny', 'user67@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000068', 'fathin nur ghaisani', 'user68@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000069', 'hujemah', 'user69@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000070', 'ismi oktaviani', 'user70@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000071', 'kartika novia wulandari', 'user71@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000072', 'khusnul khotimah', 'user72@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000073', 'muhamad arif hidayatullah', 'user73@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000074', 'naylanaya rizqina adisty', 'user74@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000075', 'neneng apriyanti', 'user75@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000076', 'puspita hariyanti', 'user76@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000077', 'puspita ulandari', 'user77@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000078', 'restiana elisa putri', 'user78@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000079', 'riska amanda', 'user79@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000080', 'sayidah nurfajri al-fath', 'user80@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000081', 'sindy yulianingsih', 'user81@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000082', 'siti salma diana', 'user82@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000083', 'vita amalia', 'user83@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000084', 'amelia riyadi putri', 'user84@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000085', 'ati nurhayati', 'user85@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000086', 'della agista pramesti', 'user86@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000087', 'devi herdianti', 'user87@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000088', 'dinda laila ramadhani', 'user88@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000089', 'duwita sari', 'user89@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000090', 'ely rohayani lestari', 'user90@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000091', 'eni rahmayanti', 'user91@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000092', 'fitriyanti', 'user92@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000093', 'ismiyati', 'user93@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000094', 'leyla ayu azkiyah', 'user94@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000095', 'lilif alifal aeni', 'user95@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000096', 'maldiva ramadhanti islamadina', 'user96@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000097', 'natalia sari', 'user97@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000098', 'rosanah annisa rahmawati', 'user98@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000099', 'salma safira azzahra', 'user99@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000100', 'siti mudalifah', 'user100@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000101', 'sri bintang rahayu', 'user101@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000102', 'ahmad sutisna', 'user102@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000103', 'bangga dewa pratama', 'user103@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000104', 'bintang cahyo perdana', 'user104@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000105', 'mentari rahmadani', 'user105@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000106', 'andrian fahmi hidayatullah', 'user106@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000107', 'arini', 'user107@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000108', 'adelia septi dewi', 'user108@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000109', 'anggi febrianiza', 'user109@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000110', 'desti hemalia', 'user110@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000111', 'dwi hana pamungkas', 'user111@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000112', 'I made aldi cahya wibowo', 'user112@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000113', 'I nengah setiawan', 'user113@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000114', 'ilah suhaelah', 'user114@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000115', 'kori\'ah', 'user115@gmail.com', 'mahasiswa', 2, 2, '', ''),
('2002210000116', 'muhammad ramadhan', 'user116@gmail.com', 'mahasiswa', 2, 2, '', '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vnilai`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vnilai` (
`nim` varchar(13)
,`nama` varchar(30)
,`namakelas` varchar(10)
,`thnajaran` year(4)
,`ipk1` decimal(3,2)
,`ipk2` decimal(3,2)
,`ipk3` decimal(3,2)
,`ipk4` decimal(3,2)
,`totalipk` decimal(6,2)
,`statusnikah` smallint(1)
,`foto` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vpengajuan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vpengajuan` (
`nopengajuan` varchar(6)
,`tanggal` date
,`perihal` varchar(6)
,`idperusahaan` smallint(3)
,`statuspengajuan` smallint(1)
,`nim` varchar(13)
,`tglmulai` date
,`tglselesai` date
,`posisi_sbg` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vpersentase`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vpersentase` (
`nim` varchar(13)
,`idkelas` smallint(3)
,`namakelas` varchar(10)
,`nopengajuan` varchar(6)
,`perihal` varchar(6)
,`tanggal` date
,`tglmulai` date
,`tglselesai` date
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vnilai`
--
DROP TABLE IF EXISTS `vnilai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vnilai`  AS SELECT `m`.`nim` AS `nim`, `u`.`nama` AS `nama`, `k`.`namakelas` AS `namakelas`, `k`.`thnajaran` AS `thnajaran`, `n`.`ipk1` AS `ipk1`, `n`.`ipk2` AS `ipk2`, `n`.`ipk3` AS `ipk3`, `n`.`ipk4` AS `ipk4`, if(`n`.`ipk2` = '',truncate((`n`.`ipk1` + `n`.`ipk2` + `n`.`ipk3` + `n`.`ipk4`) / 1,2),if(`n`.`ipk3` = '',truncate((`n`.`ipk1` + `n`.`ipk2` + `n`.`ipk3` + `n`.`ipk4`) / 2,2),if(`n`.`ipk4` = '',truncate((`n`.`ipk1` + `n`.`ipk2` + `n`.`ipk3` + `n`.`ipk4`) / 3,2),truncate((`n`.`ipk1` + `n`.`ipk2` + `n`.`ipk3` + `n`.`ipk4`) / 4,2)))) AS `totalipk`, `m`.`statusnikah` AS `statusnikah`, `u`.`foto` AS `foto` FROM (((`mahasiswa` `m` join `user` `u`) join `nilai` `n`) join `kelas` `k`) WHERE `m`.`nim` = `u`.`id` AND `m`.`nim` = `n`.`nim` AND `m`.`idkelas` = `k`.`idkelas` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vpengajuan`
--
DROP TABLE IF EXISTS `vpengajuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpengajuan`  AS SELECT `dp`.`nopengajuan` AS `nopengajuan`, `p`.`tanggal` AS `tanggal`, `p`.`perihal` AS `perihal`, `p`.`idperusahaan` AS `idperusahaan`, `p`.`statuspengajuan` AS `statuspengajuan`, `dp`.`nim` AS `nim`, `dp`.`tglmulai` AS `tglmulai`, `dp`.`tglselesai` AS `tglselesai`, `dp`.`posisi_sbg` AS `posisi_sbg` FROM (`detail_pengajuan` `dp` join `pengajuan` `p`) WHERE `dp`.`nopengajuan` = `p`.`nopengajuan` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vpersentase`
--
DROP TABLE IF EXISTS `vpersentase`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpersentase`  AS SELECT `m`.`nim` AS `nim`, `k`.`idkelas` AS `idkelas`, `k`.`namakelas` AS `namakelas`, `p`.`nopengajuan` AS `nopengajuan`, `p`.`perihal` AS `perihal`, `p`.`tanggal` AS `tanggal`, `p`.`tglmulai` AS `tglmulai`, `p`.`tglselesai` AS `tglselesai` FROM ((`mahasiswa` `m` join `kelas` `k`) join `vpengajuan` `p`) WHERE `m`.`idkelas` = `k`.`idkelas` AND `p`.`nim` = `m`.`nim` AND `p`.`statuspengajuan` <> 3 AND `p`.`perihal` = 'Magang' ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idkelas`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `idkelas` (`idkelas`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`nopengajuan`),
  ADD KEY `idperusahaan` (`idperusahaan`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`idperusahaan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idkelas` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `idperusahaan` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`idkelas`) REFERENCES `kelas` (`idkelas`);

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);

--
-- Ketidakleluasaan untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`idperusahaan`) REFERENCES `perusahaan` (`idperusahaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
