-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2025 at 03:52 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pakar_ung`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id_aturan` int NOT NULL,
  `kode_jurusan` varchar(50) NOT NULL,
  `kode_fakta` varchar(50) NOT NULL,
  `bobot` decimal(3,2) NOT NULL DEFAULT '1.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id_aturan`, `kode_jurusan`, `kode_fakta`, `bobot`) VALUES
(1, 'J001', 'F01', '1.00'),
(2, 'J001', 'F09', '0.80'),
(3, 'J002', 'F01', '1.00'),
(4, 'J002', 'F09', '0.80'),
(5, 'J003', 'F01', '1.00'),
(6, 'J003', 'F10', '0.80'),
(7, 'J003', 'F20', '0.80'),
(8, 'J004', 'F01', '1.00'),
(9, 'J005', 'F01', '1.00'),
(10, 'J006', 'F09', '0.80'),
(11, 'J007', 'F01', '1.00'),
(12, 'J008', 'F01', '1.00'),
(13, 'J008', 'F02', '0.80'),
(14, 'J009', 'F01', '1.00'),
(15, 'J009', 'F03', '0.80'),
(16, 'J009', 'F18', '0.80'),
(17, 'J010', 'F01', '1.00'),
(18, 'J010', 'F04', '0.80'),
(19, 'J010', 'F12', '0.80'),
(20, 'J011', 'F01', '1.00'),
(21, 'J011', 'F05', '0.80'),
(22, 'J012', 'F01', '1.00'),
(23, 'J013', 'F03', '0.80'),
(24, 'J013', 'F18', '0.80'),
(25, 'J014', 'F04', '0.80'),
(26, 'J014', 'F12', '0.80'),
(27, 'J015', 'F05', '0.80'),
(28, 'J016', 'F02', '0.80'),
(29, 'J017', 'F02', '0.80'),
(30, 'J018', 'F01', '1.00'),
(31, 'J019', 'F03', '0.80'),
(32, 'J019', 'F18', '0.80'),
(33, 'J020', 'F04', '0.80'),
(34, 'J020', 'F12', '0.80'),
(35, 'J021', 'F01', '1.00'),
(36, 'J021', 'F14', '0.80'),
(37, 'J021', 'F09', '0.80'),
(38, 'J022', 'F01', '1.00'),
(39, 'J024', 'F09', '0.80'),
(40, 'J025', 'F17', '0.80'),
(41, 'J026', 'F01', '1.00'),
(42, 'J026', 'F13', '0.80'),
(43, 'J027', 'F01', '1.00'),
(44, 'J027', 'F13', '0.80'),
(45, 'J028', 'F01', '1.00'),
(46, 'J028', 'F07', '0.80'),
(47, 'J029', 'F01', '1.00'),
(48, 'J029', 'F07', '0.80'),
(49, 'J030', 'F06', '0.80'),
(50, 'J030', 'F02', '0.80'),
(51, 'J031', 'F03', '0.80'),
(52, 'J031', 'F18', '0.80'),
(53, 'J031', 'F15', '0.80'),
(54, 'J032', 'F03', '0.80'),
(55, 'J032', 'F18', '0.80'),
(56, 'J033', 'F03', '0.80'),
(57, 'J033', 'F18', '0.80'),
(58, 'J033', 'F07', '0.80'),
(59, 'J033', 'F15', '0.80'),
(60, 'J034', 'F01', '1.00'),
(61, 'J034', 'F06', '0.80'),
(62, 'J034', 'F02', '0.80'),
(63, 'J035', 'F01', '1.00'),
(64, 'J035', 'F15', '0.80'),
(65, 'J036', 'F03', '0.80'),
(66, 'J036', 'F18', '0.80'),
(67, 'J037', 'F15', '0.80'),
(68, 'J038', 'F01', '1.00'),
(69, 'J038', 'F03', '0.80'),
(70, 'J038', 'F18', '0.80'),
(71, 'J039', 'F03', '0.80'),
(72, 'J039', 'F18', '0.80'),
(73, 'J039', 'F06', '0.80'),
(74, 'J039', 'F02', '0.80'),
(75, 'J040', 'F10', '0.80'),
(76, 'J040', 'F20', '0.80'),
(77, 'J041', 'F04', '0.80'),
(78, 'J041', 'F12', '0.80'),
(79, 'J042', 'F04', '0.80'),
(80, 'J042', 'F12', '0.80'),
(81, 'J043', 'F05', '0.80'),
(82, 'J044', 'F01', '1.00'),
(83, 'J044', 'F08', '0.80'),
(84, 'J044', 'F11', '0.80'),
(85, 'J044', 'F04', '0.80'),
(86, 'J045', 'F01', '1.00'),
(87, 'J045', 'F08', '0.80'),
(88, 'J046', 'F11', '0.80'),
(89, 'J046', 'F04', '0.80'),
(90, 'J047', 'F09', '0.80'),
(91, 'J047', 'F11', '0.80'),
(92, 'J047', 'F04', '0.80'),
(93, 'J048', 'F05', '0.80'),
(94, 'J048', 'F11', '0.80'),
(95, 'J048', 'F04', '0.80'),
(96, 'J049', 'F05', '0.80'),
(97, 'J049', 'F11', '0.80'),
(98, 'J049', 'F04', '0.80'),
(99, 'J050', 'F01', '1.00'),
(100, 'J050', 'F10', '0.80'),
(101, 'J050', 'F20', '0.80'),
(102, 'J051', 'F02', '0.80'),
(103, 'J051', 'F10', '0.80'),
(104, 'J051', 'F20', '0.80'),
(105, 'J052', 'F10', '0.80'),
(106, 'J052', 'F20', '0.80'),
(107, 'J053', 'F15', '0.80'),
(108, 'J053', 'F10', '0.80'),
(109, 'J053', 'F20', '0.80'),
(110, 'J054', 'F14', '0.80'),
(111, 'J054', 'F09', '0.80'),
(112, 'J055', 'F16', '0.80'),
(113, 'J055', 'F04', '0.80'),
(114, 'J056', 'F10', '0.80'),
(115, 'J056', 'F20', '0.80'),
(116, 'J056', 'F16', '0.80'),
(117, 'J056', 'F04', '0.80'),
(118, 'J057', 'F16', '0.80'),
(119, 'J057', 'F04', '0.80'),
(120, 'J058', 'F16', '0.80'),
(121, 'J058', 'F04', '0.80'),
(122, 'J060', 'F11', '0.80'),
(123, 'J060', 'F04', '0.80'),
(124, 'J061', 'F06', '0.80'),
(125, 'J061', 'F02', '0.80'),
(126, 'J062', 'F07', '0.80'),
(127, 'J062', 'F15', '0.80'),
(128, 'J063', 'F03', '0.80'),
(129, 'J063', 'F18', '0.80'),
(130, 'J064', 'F10', '0.80'),
(131, 'J064', 'F20', '0.80'),
(132, 'J064', 'F16', '0.80'),
(133, 'J064', 'F04', '0.80'),
(134, 'J065', 'F19', '0.80'),
(135, 'J065', 'F13', '0.80'),
(136, 'J022', 'F21', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `fakta`
--

CREATE TABLE `fakta` (
  `id_fakta` int NOT NULL,
  `kode_fakta` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `jenis_input` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fakta`
--

INSERT INTO `fakta` (`id_fakta`, `kode_fakta`, `deskripsi`, `jenis_input`) VALUES
(1, 'F01', 'Suka mengajar, membimbing, dan berbagi ilmu', 'checkbox'),
(2, 'F02', 'Suka berhitung, logika matematika, dan angka', 'checkbox'),
(3, 'F03', 'Tertarik pada ilmu fisika, mekanika, atau bumi', 'checkbox'),
(4, 'F04', 'Tertarik pada makhluk hidup, biologi, dan lingkungan', 'checkbox'),
(5, 'F05', 'Suka melakukan eksperimen kimia atau laboratorium', 'checkbox'),
(6, 'F06', 'Tertarik pada komputer, coding, atau teknologi digital', 'checkbox'),
(7, 'F07', 'Memiliki minat pada seni (tari, musik, rupa, drama)', 'checkbox'),
(8, 'F08', 'Suka berolahraga dan aktivitas fisik', 'checkbox'),
(9, 'F09', 'Peduli sosial, suka berinteraksi dengan masyarakat', 'checkbox'),
(10, 'F10', 'Tertarik pada ekonomi, bisnis, dan keuangan', 'checkbox'),
(11, 'F11', 'Tertarik pada bidang kesehatan dan medis', 'checkbox'),
(12, 'F12', 'Suka kegiatan pertanian, tanaman, atau hewan ternak', 'checkbox'),
(13, 'F13', 'Suka mempelajari bahasa dan sastra (Indonesia/Asing)', 'checkbox'),
(14, 'F14', 'Tertarik pada hukum, aturan, dan debat', 'checkbox'),
(15, 'F15', 'Suka merancang bangunan atau teknik sipil', 'checkbox'),
(16, 'F16', 'Tertarik pada kelautan dan perikanan', 'checkbox'),
(17, 'F17', 'Suka administrasi dan tata kelola pemerintahan', 'checkbox'),
(18, 'F18', 'Suka hal-hal berbau teknik mesin atau elektro', 'checkbox'),
(19, 'F19', 'Tertarik pada pariwisata dan perhotelan', 'checkbox'),
(20, 'F20', 'Memiliki jiwa kepemimpinan dan manajemen', 'checkbox'),
(21, 'F21', 'suka sejarah', 'umum');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `jenjang` varchar(5) NOT NULL,
  `fakultas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `kode_jurusan`, `nama_jurusan`, `jenjang`, `fakultas`) VALUES
(1, 'J001', 'Bimbingan dan Konseling', 'S1', 'Fakultas Ilmu Pendidikan (FIP)'),
(2, 'J002', 'Pendidikan Masyarakat', 'S1', 'Fakultas Ilmu Pendidikan (FIP)'),
(3, 'J003', 'Manajemen Pendidikan', 'S1', 'Fakultas Ilmu Pendidikan (FIP)'),
(4, 'J004', 'PAUD', 'S1', 'Fakultas Ilmu Pendidikan (FIP)'),
(5, 'J005', 'PGSD', 'S1', 'Fakultas Ilmu Pendidikan (FIP)'),
(6, 'J006', 'Psikologi', 'S1', 'Fakultas Ilmu Pendidikan (FIP)'),
(7, 'J007', 'Pendidikan Khusus', 'S1', 'Fakultas Ilmu Pendidikan (FIP)'),
(8, 'J008', 'Pendidikan Matematika', 'S1', 'Fakultas MIPA (FMIPA)'),
(9, 'J009', 'Pendidikan Fisika', 'S1', 'Fakultas MIPA (FMIPA)'),
(10, 'J010', 'Pendidikan Biologi', 'S1', 'Fakultas MIPA (FMIPA)'),
(11, 'J011', 'Pendidikan Kimia', 'S1', 'Fakultas MIPA (FMIPA)'),
(12, 'J012', 'Pendidikan Geografi', 'S1', 'Fakultas MIPA (FMIPA)'),
(13, 'J013', 'Fisika', 'S1', 'Fakultas MIPA (FMIPA)'),
(14, 'J014', 'Biologi', 'S1', 'Fakultas MIPA (FMIPA)'),
(15, 'J015', 'Kimia', 'S1', 'Fakultas MIPA (FMIPA)'),
(16, 'J016', 'Matematika', 'S1', 'Fakultas MIPA (FMIPA)'),
(17, 'J017', 'Statistika', 'S1', 'Fakultas MIPA (FMIPA)'),
(18, 'J018', 'Pendidikan IPA', 'S1', 'Fakultas MIPA (FMIPA)'),
(19, 'J019', 'Teknik Geologi', 'S1', 'Fakultas MIPA (FMIPA)'),
(20, 'J020', 'Ilmu Lingkungan', 'S1', 'Fakultas MIPA (FMIPA)'),
(21, 'J021', 'Pendidikan Pancasila dan Kewarganegaraan', 'S1', 'Fakultas Ilmu Sosial (FIS)'),
(22, 'J022', 'Pendidikan Sejarah', 'S1', 'Fakultas Ilmu Sosial (FIS)'),
(23, 'J023', 'Sosiologi', 'S1', 'Fakultas Ilmu Sosial (FIS)'),
(24, 'J024', 'Ilmu Komunikasi', 'S1', 'Fakultas Ilmu Sosial (FIS)'),
(25, 'J025', 'Administrasi Publik', 'S1', 'Fakultas Ilmu Sosial (FIS)'),
(26, 'J026', 'Pendidikan Bahasa dan Sastra Indonesia', 'S1', 'Fakultas Sastra dan Budaya (FSB)'),
(27, 'J027', 'Pendidikan Bahasa Inggris', 'S1', 'Fakultas Sastra dan Budaya (FSB)'),
(28, 'J028', 'Pendidikan Sendratari / Sendratasik', 'S1', 'Fakultas Sastra dan Budaya (FSB)'),
(29, 'J029', 'Pendidikan Seni Rupa', 'S1', 'Fakultas Teknik (FT)'),
(30, 'J030', 'Sistem Informasi', 'S1', 'Fakultas Teknik (FT)'),
(31, 'J031', 'Teknik Sipil', 'S1', 'Fakultas Teknik (FT)'),
(32, 'J032', 'Teknik Elektro', 'S1', 'Fakultas Teknik (FT)'),
(33, 'J033', 'Teknik Arsitektur', 'S1', 'Fakultas Teknik (FT)'),
(34, 'J034', 'Pendidikan Teknologi Informasi', 'S1', 'Fakultas Teknik (FT)'),
(35, 'J035', 'Pendidikan Vokasional Konstruksi Bangunan', 'S1', 'Fakultas Teknik (FT)'),
(36, 'J036', 'Teknik Industri', 'S1', 'Fakultas Teknik (FT)'),
(37, 'J037', 'Perencanaan Wilayah Kota (PWK)', 'S1', 'Fakultas Teknik (FT)'),
(38, 'J038', 'Pendidikan Teknik Mesin', 'S1', 'Fakultas Teknik (FT)'),
(39, 'J039', 'Teknik Komputer', 'S1', 'Fakultas Teknik (FT)'),
(40, 'J040', 'Agribisnis', 'S1', 'Fakultas Pertanian (FAPERTA)'),
(41, 'J041', 'Agroteknologi', 'S1', 'Fakultas Pertanian (FAPERTA)'),
(42, 'J042', 'Peternakan', 'S1', 'Fakultas Pertanian (FAPERTA)'),
(43, 'J043', 'Ilmu Teknologi Pangan', 'S1', 'Fakultas Pertanian (FAPERTA)'),
(44, 'J044', 'Penjaskes (Pendidikan Jasmani dan Kesehatan)', 'S1', 'Fakultas Olahraga dan Kesehatan (FOK)'),
(45, 'J045', 'Pendidikan Kepelatihan Olahraga', 'S1', 'Fakultas Olahraga dan Kesehatan (FOK)'),
(46, 'J046', 'Keperawatan', 'S1', 'Fakultas Olahraga dan Kesehatan (FOK)'),
(47, 'J047', 'Kesehatan Masyarakat', 'S1', 'Fakultas Olahraga dan Kesehatan (FOK)'),
(48, 'J048', 'Farmasi', 'S1', 'Fakultas Olahraga dan Kesehatan (FOK)'),
(49, 'J049', 'D3 Farmasi', 'D3', 'Fakultas Olahraga dan Kesehatan (FOK)'),
(50, 'J050', 'Pendidikan Ekonomi', 'S1', 'Fakultas Ekonomi dan Bisnis (FEB)'),
(51, 'J051', 'Akuntansi', 'S1', 'Fakultas Ekonomi dan Bisnis (FEB)'),
(52, 'J052', 'Manajemen', 'S1', 'Fakultas Ekonomi dan Bisnis (FEB)'),
(53, 'J053', 'Ekonomi Pembangunan', 'S1', 'Fakultas Ekonomi dan Bisnis (FEB)'),
(54, 'J054', 'Ilmu Hukum', 'S1', 'Fakultas Hukum (FH)'),
(55, 'J055', 'Budidaya Perairan', 'S1', 'Fakultas Kelautan dan Perikanan (FKTP)'),
(56, 'J056', 'Manajemen Sumber Daya Perairan', 'S1', 'Fakultas Kelautan dan Perikanan (FKTP)'),
(57, 'J057', 'Teknologi Hasil Perikanan', 'S1', 'Fakultas Kelautan dan Perikanan (FKTP)'),
(58, 'J058', 'Ilmu Kelautan', 'S1', 'Fakultas Kelautan dan Perikanan (FKTP)'),
(59, 'J059', 'Teknologi Penangkapan Ikan', 'S1', 'Fakultas Kelautan dan Perikanan (FKTP)'),
(60, 'J060', 'Kedokteran', 'S1', 'Fakultas Kedokteran (FK)'),
(61, 'J061', 'D4 Teknologi Rekayasa Perangkat Lunak', 'D4', 'Program Vokasi'),
(62, 'J062', 'D4 Arsitektur Bangunan Gedung', 'D4', 'Program Vokasi'),
(63, 'J063', 'D4 Teknologi Rekayasa Energi Terbarukan', 'D4', 'Program Vokasi'),
(64, 'J064', 'D4 Agribisnis Perikanan', 'D4', 'Program Vokasi'),
(65, 'J065', 'D3 Pariwisata', 'D3', 'Program Vokasi');

-- --------------------------------------------------------

--
-- Table structure for table `pakar`
--

CREATE TABLE `pakar` (
  `id_pakar` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pakar`
--

INSERT INTO `pakar` (`id_pakar`, `username`, `password`) VALUES
(1, 'pakarung', '$2y$12$PtozTAKmKRYLLXZehiHzbuQc0LySY2NF03y1V25aJ45RDeIsivRka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id_aturan`),
  ADD KEY `kode_jurusan` (`kode_jurusan`),
  ADD KEY `kode_fakta` (`kode_fakta`);

--
-- Indexes for table `fakta`
--
ALTER TABLE `fakta`
  ADD PRIMARY KEY (`id_fakta`),
  ADD UNIQUE KEY `kode_fakta` (`kode_fakta`),
  ADD UNIQUE KEY `kode_fakta_2` (`kode_fakta`),
  ADD UNIQUE KEY `kode_fakta_3` (`kode_fakta`),
  ADD UNIQUE KEY `kode_fakta_4` (`kode_fakta`),
  ADD UNIQUE KEY `kode_fakta_5` (`kode_fakta`),
  ADD UNIQUE KEY `kode_fakta_6` (`kode_fakta`),
  ADD UNIQUE KEY `kode_fakta_7` (`kode_fakta`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD UNIQUE KEY `kode_jurusan` (`kode_jurusan`);

--
-- Indexes for table `pakar`
--
ALTER TABLE `pakar`
  ADD PRIMARY KEY (`id_pakar`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id_aturan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `fakta`
--
ALTER TABLE `fakta`
  MODIFY `id_fakta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `pakar`
--
ALTER TABLE `pakar`
  MODIFY `id_pakar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`kode_jurusan`) REFERENCES `jurusan` (`kode_jurusan`) ON DELETE CASCADE,
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`kode_fakta`) REFERENCES `fakta` (`kode_fakta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
