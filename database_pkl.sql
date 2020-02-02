-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2020 at 03:30 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coba_pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `id` int(10) UNSIGNED NOT NULL,
  `bagian` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_jurusan` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id`, `bagian`, `is_jurusan`) VALUES
(1, 'Sistem Informasi', 1),
(2, 'Teknologi Informasi', 1),
(3, 'Informatika', 1),
(4, 'Bagian 4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bukti_perjalanan`
--

CREATE TABLE `bukti_perjalanan` (
  `id` int(11) NOT NULL,
  `id_spd` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `uploaded_at` date NOT NULL,
  `id_user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bukti_perjalanan`
--

INSERT INTO `bukti_perjalanan` (`id`, `id_spd`, `nama`, `uploaded_at`, `id_user`) VALUES
(2, 4, '2011-5508-1-PB.pdf', '2020-01-28', '196909281993021001'),
(5, 4, 'Invoice-34431.pdf', '2020-01-29', '196906151997021002'),
(6, 4, 'Invoice-34431.pdf', '2020-01-29', '196906151997021002'),
(7, 4, 'Cetak Slip Alamat.pdf', '2020-01-29', '196906151997021002'),
(8, 4, '2hu5lp.jpg', '2020-01-29', '196906151997021002'),
(9, 4, '2hu5lp.jpg', '2020-01-29', '196906151997021002'),
(10, 4, '2hu5lp.jpg', '2020-01-29', '196906151997021002'),
(11, 4, '2hu5lp.jpg', '2020-01-29', '196906151997021002'),
(12, 4, '2hu5lp.jpg', '2020-01-29', '196906151997021002'),
(13, 1, '2hu5lp.jpg', '2020-01-29', '196906151997021002'),
(14, 5, 'Tokped.pdf', '2020-01-30', '196811131994121001'),
(15, 13, 'Cetak Slip Alamat.pdf', '2020-01-30', '760015717'),
(16, 14, 'logojpnncom.png', '2020-02-01', '197004221995121000');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idstatus_fk` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id`, `kode_barang`, `nama_barang`, `idstatus_fk`) VALUES
(1, '3030205014', 'Crimping Tools', NULL),
(2, '3040104003', 'Rak-Rak Penyimpan', NULL),
(3, '3050101003', 'Mesin Ketik Manual Langewangon', NULL),
(4, '3050101004', 'Mesin Ketik Listrik', NULL),
(5, '3050102007', 'Mesin Penghitung Uang', NULL),
(6, '3050104001', 'Lemari Besi/Metal', NULL),
(7, '3050104005', 'Filing Cabinet Besi', NULL),
(8, '3050104007', 'Brangkas', NULL),
(9, '3050104015', 'Locker', NULL),
(10, '3050104020', 'Lemari Display', NULL),
(11, '3050105007', 'CCTV', NULL),
(12, '3050105010', 'White Board', NULL),
(13, '3050105015', 'Alat Penghancur Kertas', NULL),
(14, '3050105017', 'Mesin Absensi', NULL),
(15, '3050105038', 'Laser Pointer', NULL),
(16, '3050105048', 'LCD Projector/Infocus', NULL),
(17, '3050105058', 'Focussing Screen', NULL),
(18, '3050105081', 'Papan Pengumuman', NULL),
(19, '3050201002', 'Meja Kerja Kayu', NULL),
(20, '3050201003', 'Kursi Besi/Metal', NULL),
(21, '3050201005', 'Sice', NULL),
(22, '3050201008', 'Meja Rapat', NULL),
(23, '3050201009', 'Meja Komputer', NULL),
(24, '3050204001', 'Lemari Es', NULL),
(25, '3050204002', 'A.C. Sentral', NULL),
(26, '3050204004', 'A.C. Split', NULL),
(27, '3050205015', 'Tandon Air', NULL),
(28, '3050206002', 'Televisi', NULL),
(29, '3050206005', 'Amplifier', NULL),
(30, '3050206007', 'Loudspeaker', NULL),
(31, '3050206008', 'Sound System', NULL),
(32, '3050206012', 'Wireless', NULL),
(33, '3050206034', 'Tangga Alumunium', NULL),
(34, '3050206036', 'Dispenser', NULL),
(35, '3050206037', 'Mimbar/Podium', NULL),
(36, '3050206071', 'Kabel', NULL),
(37, '3060101036', 'Microphone/Wireless Mic', NULL),
(38, '3060101048', 'Uninterruptible Power Supply  (UPS)', NULL),
(39, '3060101083', 'Video Presenter', NULL),
(40, '3060102132', 'Video Conference', NULL),
(41, '3060105037', 'Teropong', NULL),
(42, '3060201001', 'Telephone(PABX)', NULL),
(43, '3060201010', 'Facsimile', NULL),
(44, '3060201999', 'Alat Komunikasi telephone Lainnya', NULL),
(45, '3060207005', 'Finger Printer time and Attandence  Access Control System ', NULL),
(46, '3060336999', 'Peralatan Antena Pemancar dan Penerima LF lainnya', NULL),
(47, '3080141194', 'Personal Computer', NULL),
(48, '3080402013', 'Elektronic Robot', NULL),
(49, '3090402031', 'Kamera Digital', NULL),
(50, '3090403004', 'GPS', NULL),
(51, '3090403079', 'Omni Single strand (Cooper) Duplex 20gauge Firing Wire', NULL),
(52, '3090409098', 'Stavol', NULL),
(53, '3100101002', 'Mini Komputer', NULL),
(54, '3100101007', 'PC Workstation', NULL),
(55, '3100102001', 'P.C Unit', NULL),
(56, '3100102002', 'Laptop', NULL),
(57, '3100102003', 'Notebook', NULL),
(58, '3100103002', 'Monitor', NULL),
(59, '3100103003', 'Printer (Peralatan Personal Komputer)', NULL),
(60, '3100103004', 'Scanner (Peralatan Personal Komputer)', NULL),
(61, '3100103017', 'External/Portable Hardisk', NULL),
(62, '3100104001', 'Server', NULL),
(63, '3100104002', 'Router', NULL),
(64, '3100104003', 'Hub', NULL),
(65, '3100104014', 'Rak Server', NULL),
(66, '3100104016', 'Switch Rak', NULL),
(67, '3100104021', 'Kabel UTP', NULL),
(68, '3100104024', 'Switch', NULL),
(69, '3100104026', 'Access Point', NULL),
(70, '3110201005', 'Converter', NULL),
(71, '3170119004', 'Jet Pump', NULL),
(72, '3170120007', 'Storage Pile', NULL),
(73, '3190102001', 'Alat Tenis Meja', NULL),
(74, '6020101002', 'Alat Musik Modern/Band', NULL),
(75, '8010101001', 'Software Komputer', NULL),
(76, '3050204006', 'Kipas Angin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_ruang`
--

CREATE TABLE `data_ruang` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_ruang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ruang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_ruang`
--

INSERT INTO `data_ruang` (`id`, `kode_ruang`, `nama_ruang`, `kuota`) VALUES
(1, '024A1014', 'UMUM & PERLENGKAPAN', 0),
(2, '024A2010', 'LABORATORIUM GIS', 0),
(3, '024A1008', 'UMUM & PERLENGKAPAN 1', 0),
(4, '024A1009', 'KEUANGAN DAN KEPEGAWAIAN', 0),
(5, '024A1007', 'AKADEMIK DAN KEMAHASISWAAN', 0),
(6, '024A2006', 'LABORATORIUM BASIS DATA', 40),
(7, '024A1005', 'LABORATORIUM RPL', 40),
(8, '024A2005', 'LABORATORIUM SELF ACCESS CENTER', 40),
(9, '024A1017', 'RUANG BACA', 0),
(10, 'R.XXXX', 'RUANGAN BELUM ADA', 0),
(11, '024A1002', 'RUANG SEKRETARIS', 0),
(12, '024A1010', 'RUANG KASIE. TATA USAHA', 0),
(13, '024A1011', 'LABORATORIUM PEMROGRAMAN', 20),
(14, '024A12007', 'BEM PSSI', 0),
(15, '024A1016', 'RUANG DOSEN', 0),
(16, '024A1013', 'LANTAI 1', 0),
(17, '024A2009', 'LANTAI 2', 0),
(18, '024A2008', 'GUDANG', 0),
(19, '024A2001', 'KULIAH 1B', 50),
(20, '024A2003', 'KULIAH 3', 40),
(21, '024A2004', 'KULIAH 4', 40),
(22, '024A1015', 'KULIAH 5', 50),
(23, '024A1001', 'DEKAN', 0),
(24, '024A2011', 'KULIAH 1A', 50),
(25, '024A1012', 'SERVER', 0),
(26, '024A2002', 'KULIAH 2', 40),
(27, '024A1004', 'RUANG RAPAT/SIDANG', 20);

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang`
--

CREATE TABLE `detail_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_categori` int(10) UNSIGNED NOT NULL,
  `spesifikasi_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_satuan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_data_barang`
--

CREATE TABLE `detail_data_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `idbarang_fk` int(10) UNSIGNED DEFAULT NULL,
  `merk_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nup` int(11) NOT NULL,
  `idruang_fk` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_data_barang`
--

INSERT INTO `detail_data_barang` (`id`, `tanggal`, `idbarang_fk`, `merk_barang`, `nup`, `idruang_fk`) VALUES
(1, '2011-12-22', 1, 'Single, AMP Single', 1, 1),
(2, '2012-12-13', 2, 'Media Stand HP Designjet 110/500 series 24', 1, 2),
(3, '2011-07-26', 3, 'Royal R775-18', 1, 1),
(4, '2017-03-01', 4, 'Mesin Ketik Brother GX6750', 1, 4),
(5, '2014-11-03', 5, 'Newmark NM - 03C', 1, 4),
(6, '2009-12-17', 6, 'Brother', 1, 1),
(7, '2010-03-18', 6, 'Brother B-204', 2, 5),
(8, '2010-03-18', 6, 'Brother B-204', 3, 5),
(9, '2010-03-18', 6, 'Brother B-204', 4, 1),
(10, '2010-03-18', 6, 'Brother B-204', 5, 4),
(11, '2011-07-26', 6, 'Brother B-204', 6, 5),
(12, '2011-07-26', 6, 'Brother B-204', 7, 4),
(13, '2011-12-01', 6, 'DATASCRIP C13LG-7', 8, 6),
(14, '2011-12-01', 6, 'DATASCRIP C13LG-7', 9, 6),
(15, '2011-12-01', 6, 'DATASCRIP LTC 22', 10, 1),
(16, '2011-12-01', 6, 'DATASCRIP C13LG-7', 11, 7),
(17, '2011-12-28', 6, 'Brother B204', 12, 1),
(18, '2012-12-13', 6, 'Cupboard datascrip CBRG/LF05', 13, 2),
(19, '2012-12-13', 6, 'Cupboard datascrip CBRG/LF05', 14, 2),
(20, '2012-12-13', 6, 'Cupboard datascrip CBRG/ET C22', 15, 2),
(21, '2014-12-04', 6, 'Lemari Arsip Brother B-20', 16, 5),
(22, '2014-12-04', 6, 'Lemari Arsip Brother B-20', 17, 4),
(23, '2014-12-04', 6, 'Brother cardek', 18, 5),
(24, '2014-12-04', 6, 'Brother Cardek', 19, 1),
(25, '2016-12-19', 6, 'Brother B-204', 20, 4),
(26, '2016-12-19', 6, 'Brother B-304', 21, 8),
(27, '2016-12-19', 6, 'Brother B-304', 22, 9),
(28, '2016-12-19', 6, 'Brother B-304', 23, 9),
(29, '2017-11-21', 6, 'lemari Sliding door Brother B-304', 24, 8),
(30, '2017-11-21', 6, 'lemari Arsip Brother B-203', 25, 1),
(31, '2017-11-28', 6, 'Brother B-203', 26, 10),
(32, '2017-11-28', 6, 'Brother B-203', 27, 10),
(33, '2009-12-17', 7, 'Brother B-104', 1, 1),
(34, '2009-12-17', 7, 'Brother B-104', 2, 1),
(35, '2009-12-17', 7, 'Brother B-104', 3, 1),
(36, '2009-12-17', 7, 'Brother B-104', 4, 4),
(37, '2009-12-17', 7, 'Brother B-104', 5, 4),
(38, '2009-12-17', 7, 'Brother B-104', 6, 11),
(39, '2009-12-17', 7, 'Brother B-104', 7, 11),
(40, '2010-03-18', 7, 'Brother B-104', 8, 11),
(41, '2010-03-18', 7, 'Brother B-104', 9, 12),
(42, '2011-07-26', 7, 'Brother B-104', 10, 1),
(43, '2011-07-26', 7, 'Brother B-104', 11, 27),
(44, '2011-12-01', 7, 'DATASCRIP FCD4-7', 12, 1),
(45, '2011-12-01', 7, 'DATASCRIP FCD4-7', 13, 6),
(46, '2011-12-28', 7, 'Brother B104', 14, 13),
(47, '2014-12-04', 7, 'Filing Cabinet B-104', 15, 4),
(48, '2014-12-04', 7, 'Filing Cabinet B-104', 16, 4),
(49, '2014-12-04', 7, 'Filing Cabinet B-104', 17, 14),
(50, '2017-11-21', 7, 'Filing Cabinet Brother B-104', 18, 10),
(51, '2017-11-21', 7, 'Filing Cabinet Brother B-104', 19, 10),
(52, '2017-11-21', 7, 'Filing Cabinet Brother B-104', 20, 10),
(53, '2019-04-05', 7, 'Filing Cabinet Brother B-103', 21, 27),
(54, '2019-04-05', 7, 'Filing Cabinet Brother B-103', 22, 27),
(55, '2019-04-05', 7, 'Filing Cabinet Brother B-103', 23, 27),
(56, '2011-07-26', 8, 'Dragon DR-A1', 1, 4),
(57, '2011-12-01', 9, 'DATASCRIP LC3-7', 1, 6),
(58, '2011-12-01', 9, 'DATASCRIP LC3-7', 2, 6),
(59, '2011-12-01', 9, 'DATASCRIP LC3-7', 3, 6),
(60, '2011-12-01', 9, 'DATASCRIP LC3-7', 4, 6),
(61, '2011-12-01', 9, 'DATASCRIP LC3-7', 5, 15),
(62, '2011-12-01', 9, 'DATASCRIP LC3-7', 6, 15),
(63, '2011-12-01', 9, 'DATASCRIP LC3-7', 7, 7),
(64, '2012-12-13', 9, 'Alba LC-506', 8, 2),
(65, '2012-12-13', 9, 'Alba LC-506', 9, 2),
(66, '2011-07-26', 10, 'BROTHER B-304', 1, 1),
(67, '2011-07-26', 10, 'BROTHER B-304', 2, 9),
(68, '2011-07-26', 10, 'BROTHER B-304', 3, 9),
(69, '2017-10-05', 11, 'Paket CCTV ANALOG 1 MP 720P, 1 DVR BCH', 1, 16),
(70, '2018-11-29', 11, 'CCTV 9 Kamera', 2, 17),
(71, '2009-12-17', 12, '120X240', 1, 18),
(72, '2010-03-18', 12, '120X240', 2, 26),
(73, '2010-03-18', 12, '120X240', 3, 5),
(74, '2010-03-18', 12, '90X120', 4, 5),
(75, '2010-03-18', 12, '90X120', 5, 12),
(76, '2010-03-18', 12, '90X120', 6, 7),
(77, '2012-12-18', 12, 'GM Economi DF', 7, 19),
(78, '2012-12-18', 12, 'GM Economi DF', 8, 18),
(79, '2013-02-15', 12, 'Nusantara', 9, 22),
(80, '2013-02-15', 12, 'Nusantara', 10, 18),
(81, '2013-02-15', 12, 'Nusantara', 11, 20),
(82, '2013-02-15', 12, 'Nusantara', 12, 21),
(83, '2012-12-13', 13, 'Secure Maxi 24SC', 1, 1),
(84, '2012-12-13', 13, 'Secure Maxi 24SC', 2, 1),
(85, '2017-12-28', 14, 'FINGERSPOT REVO DUO 128BNC', 1, 10),
(86, '2017-12-28', 14, 'FINGERSPOT REVO DUO 128BNC', 2, 10),
(87, '2017-12-28', 14, 'FINGERSPOT REVO DUO 128BNC', 3, 10),
(88, '2017-12-28', 14, 'FINGERSPOT REVO DUO 128BNC', 4, 10),
(89, '2017-12-28', 14, 'FINGERSPOT REVO DUO 128BNC', 5, 10),
(90, '2017-12-28', 14, 'FINGERSPOT REVO DUO 128BNC', 6, 10),
(91, '2017-12-28', 14, 'FINGERSPOT REVO DUO 128BNC', 7, 10),
(92, '2017-10-16', 15, 'Logitech Wireless Presenter R400', 1, 1),
(93, '2017-10-16', 15, 'Logitech Wireless Presenter R400', 2, 1),
(94, '2016-11-24', 16, 'SONY VPL EX 230', 19, 13),
(95, '2016-11-24', 16, 'SONY VPL EX 230', 20, 2),
(96, '2016-11-24', 16, 'SONY VPL EX 230', 21, 22),
(97, '2016-11-24', 16, 'SONY VPL EX 230', 22, 8),
(98, '2016-11-24', 16, 'SONY VPL EX 230', 23, 26),
(99, '2010-11-25', 16, 'BENQ MP575', 24, 18),
(100, '2010-12-01', 16, 'BENQ MP575', 25, 18),
(101, '2010-12-16', 16, 'BENQ MP515', 26, 18),
(102, '2010-12-16', 16, 'BENQ MP670', 27, 18),
(103, '2011-06-06', 16, 'BENQ MX810 ST', 28, 1),
(104, '2011-07-26', 16, 'BENQ MP660', 29, 18),
(105, '2011-07-26', 16, 'BENQ MP660', 30, 18),
(106, '2011-12-01', 16, 'BENQ 2800 Ans', 31, 1),
(107, '2011-12-01', 16, 'DELL 161011D', 32, 1),
(108, '2011-12-01', 16, 'DELL 161011D', 33, 6),
(109, '2011-12-01', 16, 'DELL 161011D', 34, 20),
(110, '2012-12-18', 16, 'BENQ 2800 Ansi', 35, 18),
(111, '2012-12-18', 16, 'BENQ 2800 Ansi', 36, 15),
(112, '2012-12-18', 16, 'BENQ 2800 Ansi', 37, 1),
(113, '2012-12-18', 16, 'BENQ 2800 Ansi', 38, 1),
(114, '2012-12-18', 16, 'BENQ 2800 Ansi', 39, 1),
(115, '2012-12-18', 16, 'BENQ 2800 Ansi', 40, 1),
(116, '2012-12-18', 16, 'BENQ 2800 Ansi', 41, 21),
(117, '2017-10-16', 16, 'Infocus Projector(IN226)', 42, 8),
(118, '2017-10-16', 16, 'Infocus Projector(IN226)', 43, 1),
(119, '2017-10-16', 16, 'Infocus Projector(IN226)', 44, 8),
(120, '2017-10-16', 16, 'Infocus Projector(IN226)', 45, 8),
(121, '2017-10-16', 16, 'Infocus Projector(IN226)', 46, 8),
(122, '2017-10-16', 16, 'Infocus Projector(IN226)', 47, 8),
(123, '2017-11-14', 17, 'Screen Prokector G-lite Tripot 70\" Size 180x180', 1, 18),
(124, '2017-11-14', 17, 'Screen Prokector G-lite Tripot 70\" Size 180x180', 2, 18),
(125, '2017-11-24', 17, 'Screen Prokector G-lite Tripot 84\" Size 213x213', 3, 18),
(126, '2017-11-14', 17, 'Screen Prokector G-lite Tripot 84\" Size 213x213', 4, 18),
(127, '2011-12-28', 18, 'GM Announcement Board', 1, 16),
(128, '2011-12-28', 18, 'GM Announcement Board', 2, 15),
(129, '2016-07-28', 19, 'Meja Active MTO 120', 33, 15),
(130, '2016-07-28', 19, 'Meja Active MTO 120', 34, 15),
(131, '2016-07-28', 19, 'Meja Active MTO 120', 35, 15),
(132, '2016-07-28', 19, 'Meja Active MTO 120', 36, 15),
(133, '2016-07-28', 19, 'Meja Active MTO 120', 37, 15),
(134, '2009-12-17', 19, 'Profil', 38, 12),
(135, '2009-12-17', 19, 'Kayu Jati', 39, 5),
(136, '2009-12-17', 19, 'Kayu Jati', 40, 5),
(137, '2009-12-17', 19, 'Kayu Jati', 41, 5),
(138, '2009-12-17', 19, 'Kayu Jati', 42, 5),
(139, '2009-12-17', 19, 'Kayu Jati', 43, 5),
(140, '2009-12-17', 19, 'Kayu Jati', 44, 5),
(141, '2009-12-17', 19, 'Kayu Jati', 45, 1),
(142, '2009-12-17', 19, 'Kayu Jati', 46, 3),
(143, '2009-12-17', 19, 'Kayu Jati', 47, 3),
(144, '2009-12-17', 19, 'Kayu Jati', 48, 4),
(145, '2009-12-17', 19, 'Kayu Jati', 49, 4),
(146, '2009-12-17', 19, 'Kayu Jati', 50, 4),
(147, '2009-12-17', 19, 'Kayu Jati', 51, 4),
(148, '2009-12-17', 19, 'Kayu Jati', 52, 4),
(149, '2009-12-17', 19, 'Kayu Jati', 53, 4),
(150, '2009-12-17', 19, 'Kayu Jati', 54, 11),
(151, '2010-03-18', 19, 'Kayu Jati Texwood', 55, 3),
(152, '2010-03-18', 19, 'Kayu Jati Texwood', 56, 15),
(153, '2010-03-18', 19, 'Kayu Jati Texwood', 57, 15),
(154, '2010-03-18', 19, 'Kayu Jati Texwood', 58, 15),
(155, '2010-03-18', 19, 'Kayu Jati Texwood', 59, 15),
(156, '2010-03-18', 19, 'Kayu Jati Texwood', 60, 2),
(157, '2010-03-18', 19, 'Profil 180x90x75', 61, 23),
(158, '2010-03-18', 19, 'Credenza', 62, 23),
(159, '2010-03-18', 19, 'Profil', 63, 11),
(160, '2010-03-18', 19, 'Profil', 64, 11),
(161, '2010-03-18', 19, 'Profil', 65, 11),
(162, '2011-07-25', 19, 'Espana 1275', 66, 13),
(163, '2011-07-25', 19, 'Espana 1275', 67, 13),
(164, '2013-02-15', 19, 'Fatoni', 68, 20),
(165, '2013-02-15', 19, 'Fatoni', 69, 21),
(166, '2017-11-21', 19, 'Meja Kerja Active Galant MTO 120', 70, 15),
(167, '2017-11-21', 19, 'Meja Kerja Active Galant MTO 120', 71, 15),
(168, '2017-11-21', 19, 'Meja Kerja Active Galant MTO 120', 72, 15),
(169, '2009-12-17', 20, 'Stainless Chrome', 1, 5),
(170, '2009-12-17', 20, 'Stainless Chrome', 2, 5),
(171, '2009-12-17', 20, 'Stainless Chrome', 3, 5),
(172, '2009-12-17', 20, 'Stainless Chrome', 4, 5),
(173, '2009-12-17', 20, 'Stainless Chrome', 5, 5),
(174, '2009-12-17', 20, 'Stainless Chrome', 6, 5),
(175, '2009-12-17', 20, 'Stainless Chrome', 7, 5),
(176, '2009-12-17', 20, 'Stainless Chrome', 8, 11),
(177, '2009-12-17', 20, 'Stainless Chrome', 9, 11),
(178, '2009-12-17', 20, 'Stainless Chrome', 10, 11),
(179, '2009-12-17', 20, 'Ushinto 9035', 11, 18),
(180, '2009-12-17', 20, 'Isebel 147', 12, 4),
(181, '2009-12-17', 20, 'Isebel 147', 13, 15),
(182, '2009-12-17', 20, 'Isebel ', 14, 15),
(183, '2009-12-17', 20, 'Isebel ', 15, 15),
(184, '2009-12-17', 20, 'Isebel ', 16, 15),
(185, '2009-12-17', 20, 'Isebel ', 17, 5),
(186, '2009-12-17', 20, 'Chitose yamato NN ', 18, 5),
(187, '2009-12-17', 20, 'Chitose yamato NN ', 19, 5),
(188, '2009-12-17', 20, 'Chitose yamato NN ', 20, 5),
(189, '2009-12-17', 20, 'Chitose yamato NN ', 21, 4),
(190, '2009-12-17', 20, 'Chitose yamato NN ', 22, 15),
(191, '2009-12-17', 20, 'Chitose yamato NN ', 23, 5),
(192, '2009-12-17', 20, 'Chitose yamato NN ', 24, 4),
(193, '2009-12-17', 20, 'Chitose yamato NN ', 25, 1),
(194, '2009-12-17', 20, 'Chitose yamato NN ', 26, 4),
(195, '2009-12-17', 20, 'Chitose yamato NN ', 27, 11),
(196, '2009-12-17', 20, 'Chitose yamato NN ', 28, 11),
(197, '2009-12-17', 20, 'Chitose yamato NN ', 29, 11),
(198, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 30, 20),
(199, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 31, 20),
(200, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 32, 20),
(201, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 33, 20),
(202, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 34, 20),
(203, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 35, 20),
(204, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 36, 20),
(205, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 37, 20),
(206, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 38, 20),
(207, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 39, 20),
(208, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 40, 20),
(209, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 41, 20),
(210, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 42, 20),
(211, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 43, 20),
(212, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 44, 20),
(213, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 45, 20),
(214, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 46, 20),
(215, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 47, 20),
(216, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 48, 20),
(217, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 49, 20),
(218, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 50, 26),
(219, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 51, 26),
(220, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 52, 26),
(221, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 53, 26),
(222, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 54, 26),
(223, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 55, 26),
(224, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 56, 26),
(225, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 57, 26),
(226, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 58, 26),
(227, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 59, 26),
(228, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 60, 26),
(229, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 61, 26),
(230, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 62, 26),
(231, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 63, 26),
(232, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 64, 26),
(233, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 65, 26),
(234, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 66, 26),
(235, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 67, 26),
(236, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 68, 26),
(237, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 69, 26),
(238, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 70, 26),
(239, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 71, 26),
(240, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 72, 26),
(241, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 73, 26),
(242, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 74, 26),
(243, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 75, 26),
(244, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 76, 26),
(245, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 77, 26),
(246, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 78, 26),
(247, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 79, 26),
(248, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 80, 26),
(249, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 81, 26),
(250, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 82, 26),
(251, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 83, 26),
(252, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 84, 26),
(253, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 85, 26),
(254, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 86, 26),
(255, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 87, 26),
(256, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 88, 26),
(257, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 89, 26),
(258, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 90, 26),
(259, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 91, 26),
(260, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 92, 26),
(261, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 93, 26),
(262, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 94, 26),
(263, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 95, 26),
(264, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 96, 26),
(265, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 97, 26),
(266, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 98, 26),
(267, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 99, 26),
(268, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 100, 26),
(269, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 101, 26),
(270, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 102, 26),
(271, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 103, 26),
(272, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 104, 26),
(273, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 105, 26),
(274, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 106, 18),
(275, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 107, 20),
(276, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 108, 20),
(277, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 109, 20),
(278, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 110, 20),
(279, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 111, 20),
(280, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 112, 21),
(281, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 113, 18),
(282, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 114, 24),
(283, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 115, 24),
(284, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 116, 24),
(285, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 117, 24),
(286, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 118, 24),
(287, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 119, 24),
(288, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 120, 24),
(289, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 121, 24),
(290, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 122, 24),
(291, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 123, 24),
(292, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 124, 24),
(293, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 125, 24),
(294, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 126, 24),
(295, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 127, 24),
(296, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 128, 24),
(297, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 129, 24),
(298, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 130, 24),
(299, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 131, 24),
(300, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 132, 24),
(301, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 133, 24),
(302, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 134, 24),
(303, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 135, 24),
(304, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 136, 24),
(305, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 137, 24),
(306, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 138, 8),
(307, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 139, 8),
(308, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 140, 8),
(309, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 141, 8),
(310, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 142, 8),
(311, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 143, 8),
(312, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 144, 8),
(313, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 145, 8),
(314, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 146, 8),
(315, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 147, 8),
(316, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 148, 8),
(317, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 149, 8),
(318, '2010-03-18', 20, 'Chitose yamato MDN Chrome ', 150, 8),
(319, '2010-03-18', 20, 'ISEBEL 485 OSCAR HITAM ', 151, 8),
(320, '2010-03-18', 20, 'ISEBEL 485 OSCAR HITAM ', 152, 8),
(321, '2010-03-18', 20, 'ISEBEL 485 OSCAR HITAM ', 153, 8),
(322, '2010-03-18', 20, 'ISEBEL 485 OSCAR HITAM ', 154, 8),
(323, '2010-03-18', 20, 'ISEBEL 485 OSCAR HITAM ', 155, 8),
(324, '2010-03-18', 20, 'OSCAR FHANTASI VH ', 156, 23),
(325, '2010-03-18', 20, 'USHINTO 608T OSCAR HITAM ', 157, 23),
(326, '2010-03-18', 20, 'USHINTO 608T OSCAR HITAM ', 158, 23),
(327, '2010-03-18', 20, 'USHINTO OSCAR ', 159, 8),
(328, '2010-03-18', 20, 'USHINTO OSCAR ', 160, 8),
(329, '2010-03-18', 20, 'USHINTO OSCAR ', 161, 8),
(330, '2010-03-18', 20, 'Chitose yamato INN ', 162, 8),
(331, '2010-03-18', 20, 'Chitose yamato INN ', 163, 8),
(332, '2010-03-18', 20, 'Chitose yamato INN ', 164, 8),
(333, '2010-03-18', 20, 'Chitose yamato INN ', 165, 8),
(334, '2010-03-18', 20, 'Chitose yamato INN ', 166, 8),
(335, '2010-03-18', 20, 'Chitose yamato INN ', 167, 8),
(336, '2010-11-25', 20, 'FUTURA FTR509 ', 168, 8),
(337, '2010-11-25', 20, 'FUTURA FTR509 ', 169, 8),
(338, '2010-11-25', 20, 'FUTURA FTR509', 170, 8),
(339, '2010-11-25', 20, 'FUTURA FTR509', 171, 8),
(340, '2010-11-25', 20, 'FUTURA FTR509', 172, 8),
(341, '2010-11-25', 20, 'FUTURA FTR509', 173, 8),
(342, '2010-11-25', 20, 'ISEBEL 485 OSCAR HITAM ', 174, 8),
(343, '2010-12-01', 20, 'FUTURA FTR509 ', 175, 8),
(344, '2010-12-01', 20, 'FUTURA FTR509', 176, 8),
(345, '2010-12-01', 20, 'FUTURA FTR509', 177, 8),
(346, '2010-12-01', 20, 'FUTURA FTR509 ', 178, 8),
(347, '2010-12-01', 20, 'FUTURA FTR509 ', 179, 8),
(348, '2010-12-01', 20, 'FUTURA FTR509 ', 180, 8),
(349, '2010-12-01', 20, 'FUTURA FTR509 ', 181, 8),
(350, '2010-12-16', 20, 'Chitose yamato AA ', 182, 8),
(351, '2010-12-16', 20, 'Chitose yamato AA ', 183, 8),
(352, '2011-07-25', 20, 'Chitose yamato AA ', 184, 8),
(353, '2011-07-25', 20, 'Chitose yamato AA ', 185, 8),
(354, '2011-07-25', 20, 'Chitose yamato AA ', 186, 8),
(355, '2011-07-25', 20, 'Chitose yamato AA ', 187, 8),
(356, '2011-07-25', 20, 'Chitose yamato AA', 188, 8),
(357, '2011-07-25', 20, 'Chitose yamato AA', 189, 8),
(358, '2011-07-25', 20, 'Chitose yamato AA', 190, 8),
(359, '2011-07-25', 20, 'Chitose yamato AA', 191, 8),
(360, '2011-07-25', 20, 'Chitose yamato AA ', 192, 8),
(361, '2011-07-25', 20, 'Chitose yamato AA', 193, 8),
(362, '2011-07-25', 20, 'Chitose yamato AA', 194, 8),
(363, '2011-07-25', 20, 'Chitose yamato AA ', 195, 8),
(364, '2011-07-25', 20, 'Chitose yamato AA ', 196, 8),
(365, '2011-07-25', 20, 'Chitose yamato AA ', 197, 18),
(366, '2011-07-25', 20, 'Chitose yamato AA ', 198, 18),
(367, '2011-07-25', 20, 'Chitose yamato AA ', 199, 18),
(368, '2011-07-25', 20, 'Chitose cosmos MNR', 200, 24),
(369, '2011-07-25', 20, 'Chitose cosmos MNR', 201, 24),
(370, '2011-07-25', 20, 'Chitose cosmos MNR', 202, 24),
(371, '2011-07-25', 20, 'Chitose cosmos MNR', 203, 24),
(372, '2011-07-25', 20, 'Chitose cosmos MNR', 204, 24),
(373, '2011-07-25', 20, 'Chitose cosmos MNR', 205, 24),
(374, '2011-07-25', 20, 'Chitose cosmos MNR', 206, 24),
(375, '2011-07-25', 20, 'Chitose cosmos MNR', 207, 24),
(376, '2011-07-25', 20, 'Chitose cosmos MNR', 208, 24),
(377, '2011-07-25', 20, 'Chitose cosmos MNR', 209, 24),
(378, '2011-07-25', 20, 'Chitose cosmos MNR', 210, 24),
(379, '2011-07-25', 20, 'Chitose cosmos MNR', 211, 24),
(380, '2011-07-25', 20, 'Chitose cosmos MNR', 212, 24),
(381, '2011-07-25', 20, 'Chitose cosmos MNR', 213, 24),
(382, '2011-07-25', 20, 'Chitose cosmos MNR', 214, 24),
(383, '2011-07-25', 20, 'Chitose cosmos MNR', 215, 24),
(384, '2011-07-25', 20, 'Chitose cosmos MNR', 216, 6),
(385, '2011-07-25', 20, 'Chitose cosmos MNR', 217, 6),
(386, '2011-07-25', 20, 'Chitose cosmos MNR', 218, 6),
(387, '2011-07-25', 20, 'Chitose cosmos MNR', 219, 6),
(388, '2011-07-25', 20, 'Chitose cosmos MNR', 220, 6),
(389, '2011-07-25', 20, 'Chitose cosmos MNR', 221, 6),
(390, '2011-07-25', 20, 'Chitose cosmos MNR', 222, 6),
(391, '2011-07-25', 20, 'Chitose cosmos MNR', 223, 6),
(392, '2011-07-25', 20, 'Chitose cosmos MNR', 224, 6),
(393, '2011-07-25', 20, 'Chitose cosmos MNR', 225, 6),
(394, '2011-07-25', 20, 'Chitose cosmos MNR', 226, 6),
(395, '2011-07-25', 20, 'Chitose cosmos MNR', 227, 6),
(396, '2011-07-25', 20, 'Chitose cosmos MNR', 228, 6),
(397, '2011-07-25', 20, 'Chitose cosmos MNR', 229, 6),
(398, '2011-07-25', 20, 'Chitose cosmos MNR', 230, 6),
(399, '2011-07-25', 20, 'Chitose cosmos MNR', 231, 6),
(400, '2011-07-25', 20, 'Chitose cosmos MNR', 232, 6),
(401, '2011-07-25', 20, 'Chitose cosmos MNR', 233, 6),
(402, '2011-07-25', 20, 'Chitose cosmos MNR', 234, 6),
(403, '2011-07-25', 20, 'Chitose cosmos MNR', 235, 6),
(404, '2011-07-25', 20, 'Chitose cosmos MNR', 236, 6),
(405, '2011-07-25', 20, 'Chitose cosmos MNR', 237, 6),
(406, '2011-07-25', 20, 'Chitose cosmos MNR', 238, 6),
(407, '2011-07-25', 20, 'Chitose cosmos MNR', 239, 6),
(408, '2011-07-25', 20, 'Chitose cosmos MNR', 240, 6),
(409, '2011-07-25', 20, 'Chitose cosmos MNR', 241, 6),
(410, '2011-07-25', 20, 'Chitose cosmos MNR', 242, 6),
(411, '2011-07-25', 20, 'Chitose cosmos MNR', 243, 5),
(412, '2011-07-25', 20, 'Chitose cosmos MNR', 244, 13),
(413, '2011-07-25', 20, 'Chitose cosmos MNR', 245, 13),
(414, '2011-07-25', 20, 'Chitose cosmos MNR', 246, 13),
(415, '2011-07-25', 20, 'Chitose cosmos MNR', 247, 13),
(416, '2011-07-25', 20, 'Chitose cosmos MNR', 248, 13),
(417, '2011-07-25', 20, 'Chitose cosmos MNR', 249, 13),
(418, '2011-07-25', 20, 'Chitose cosmos MNR', 250, 13),
(419, '2011-07-25', 20, 'Chitose cosmos MNR', 251, 13),
(420, '2011-07-25', 20, 'Chitose cosmos MNR', 252, 13),
(421, '2011-07-25', 20, 'Chitose cosmos MNR', 253, 13),
(422, '2011-07-25', 20, 'Chitose cosmos MNR', 254, 13),
(423, '2011-07-25', 20, 'Chitose cosmos MNR', 255, 13),
(424, '2011-07-25', 20, 'Chitose cosmos MNR', 256, 13),
(425, '2011-07-25', 20, 'Chitose cosmos MNR', 257, 13),
(426, '2011-07-25', 20, 'Chitose cosmos MNR', 258, 13),
(427, '2011-07-25', 20, 'Chitose cosmos MNR', 259, 13),
(428, '2011-07-25', 20, 'ISEBEL MR 357TLPM', 260, 13),
(429, '2011-07-25', 20, 'ISEBEL MR 357TLPM', 261, 13),
(430, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 262, 13),
(431, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 263, 13),
(432, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 264, 13),
(433, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 265, 13),
(434, '2011-07-25', 20, 'CISEBEL 311 TLLPP', 266, 13),
(435, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 67, 13),
(436, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 268, 13),
(437, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 269, 11),
(438, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 270, 11),
(439, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 270, 11),
(440, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 271, 11),
(441, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 272, 11),
(442, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 273, 20),
(443, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 274, 20),
(444, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 275, 20),
(445, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 276, 20),
(446, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 277, 20),
(447, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 278, 20),
(448, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 278, 20),
(449, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 279, 20),
(450, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 280, 20),
(451, '2011-07-25', 20, 'ISEBEL 311 TLLPP', 281, 20),
(452, '2011-12-01', 20, 'Tiger T99 Hitam', 282, 20),
(453, '2011-12-01', 20, 'Tiger T99 Hitam', 283, 20),
(454, '2011-12-01', 20, 'Tiger T99 Hitam', 284, 20),
(455, '2011-12-01', 20, 'Tiger T99 Hitam', 285, 20),
(456, '2011-12-01', 20, 'Tiger T99 Hitam', 286, 20),
(457, '2011-12-01', 20, 'Tiger T99 Hitam', 287, 20),
(458, '2011-12-01', 20, 'Tiger T99 Hitam', 288, 20),
(459, '2011-12-01', 20, 'Tiger T99 Hitam', 289, 20),
(460, '2011-12-01', 20, 'Tiger T99 Hitam', 290, 20),
(461, '2011-12-01', 20, 'Tiger T99 Hitam', 291, 20),
(462, '2011-12-01', 20, 'Tiger T99 Hitam', 292, 20),
(463, '2011-12-01', 20, 'Tiger T99 Hitam', 293, 20),
(464, '2011-12-01', 20, 'Tiger T99 Hitam', 294, 20),
(465, '2011-12-01', 20, 'Tiger T99 Hitam', 295, 20),
(466, '2011-12-01', 20, 'Tiger T99 Hitam', 296, 20),
(467, '2011-12-01', 20, 'Tiger T99 Hitam', 297, 20),
(468, '2011-12-01', 20, 'Tiger T99 Hitam', 298, 20),
(469, '2011-12-01', 20, 'Tiger T99 Hitam', 299, 20),
(470, '2011-12-01', 20, 'Tiger T99 Hitam', 300, 20),
(471, '2011-12-01', 20, 'Tiger T99 Hitam', 301, 20),
(472, '2011-12-01', 20, 'Tiger T99 Hitam', 302, 20),
(473, '2011-12-01', 20, 'Tiger T99 Hitam', 303, 20),
(474, '2011-12-01', 20, 'Tiger T99 Hitam', 304, 21),
(475, '2011-12-01', 20, 'Tiger T99 Hitam', 305, 22),
(476, '2011-12-01', 20, 'Tiger T99 Hitam', 306, 22),
(477, '2011-12-01', 20, 'Tiger T99 Hitam', 307, 22),
(478, '2011-12-01', 20, 'Tiger T99 Hitam', 308, 22),
(479, '2011-12-01', 20, 'Tiger T99 Hitam', 309, 22),
(480, '2011-12-01', 20, 'Tiger T99 Hitam', 310, 22),
(481, '2011-12-01', 20, 'Tiger T99 Hitam', 311, 22),
(482, '2011-12-01', 20, 'Tiger T99 Hitam', 312, 22),
(483, '2011-12-01', 20, 'Tiger T99 Hitam', 313, 22),
(484, '2011-12-01', 20, 'Tiger T99 Hitam', 314, 22),
(485, '2011-12-01', 20, 'Tiger T99 Hitam', 315, 22),
(486, '2011-12-01', 20, 'Tiger T99 Hitam', 316, 22),
(487, '2011-12-01', 20, 'Tiger T99 Hitam', 317, 22),
(488, '2011-12-01', 20, 'Tiger T99 Hitam', 318, 22),
(489, '2011-12-01', 20, 'Tiger T99 Hitam', 319, 22),
(490, '2011-12-01', 20, 'Tiger T99 Hitam', 320, 22),
(491, '2011-12-01', 20, 'Tiger T99 Hitam', 321, 22),
(492, '2011-12-01', 20, 'Tiger T99 Hitam', 322, 22),
(493, '2011-12-01', 20, 'Tiger T99 Hitam', 323, 22),
(494, '2011-12-01', 20, 'Tiger T99 Hitam', 324, 22),
(495, '2011-12-01', 20, 'Tiger T99 Hitam', 325, 22),
(496, '2011-12-01', 20, 'Tiger T99 Hitam', 326, 22),
(497, '2011-12-01', 20, 'Tiger T99 Hitam', 327, 22),
(498, '2011-12-01', 20, 'Tiger T99 Hitam', 328, 22),
(499, '2011-12-01', 20, 'Tiger T99 Hitam', 329, 22),
(500, '2011-12-01', 20, 'Tiger T99 Hitam', 329, 22),
(501, '2011-12-01', 20, 'Tiger T99 Hitam', 330, 22),
(502, '2011-12-01', 20, 'Tiger T99 Hitam', 331, 22),
(503, '2011-12-01', 20, 'Tiger T99 Hitam', 332, 22),
(504, '2011-12-01', 20, 'Tiger T99 Hitam', 333, 22),
(505, '2011-12-01', 20, 'Tiger T99 Hitam', 334, 22),
(506, '2011-12-01', 20, 'Tiger T99 Hitam', 335, 22),
(507, '2011-12-01', 20, 'Tiger T99 Hitam', 336, 22),
(508, '2011-12-01', 20, 'Tiger T99 Hitam', 337, 22),
(509, '2011-12-01', 20, 'Tiger T99 Hitam', 338, 22),
(510, '2011-12-01', 20, 'Tiger T99 Hitam', 339, 1),
(511, '2011-12-01', 20, 'Tiger T99 Hitam', 340, 12),
(512, '2011-12-01', 20, 'Tiger T99 Hitam', 341, 12),
(513, '2011-12-01', 20, 'Tiger T99 Hitam', 342, 12),
(514, '2011-12-01', 20, 'Tiger T99 Hitam', 343, 3),
(515, '2011-12-01', 20, 'Tiger T99 Hitam', 344, 3),
(516, '2011-12-01', 20, 'Tiger T99 Hitam', 345, 3),
(517, '2011-12-01', 20, 'Tiger T99 Hitam', 363, 3),
(518, '2011-12-01', 20, 'Tiger T99 Hitam', 347, 3),
(519, '2011-12-01', 20, 'Tiger T99 Hitam', 348, 3),
(520, '2011-12-01', 20, 'Tiger T99 Hitam', 349, 3),
(521, '2011-12-01', 20, 'Tiger T99 Hitam', 350, 24),
(522, '2011-12-01', 20, 'Tiger T99 Hitam', 351, 24),
(523, '2011-12-01', 20, 'Tiger T99 Hitam', 352, 24),
(524, '2011-12-01', 20, 'Tiger T99 Hitam', 353, 1),
(525, '2011-12-01', 20, 'Tiger T99 Hitam', 354, 1),
(526, '2011-12-01', 20, 'Tiger T99 Hitam', 355, 1),
(527, '2011-12-01', 20, 'Tiger T99 Hitam', 356, 1),
(528, '2011-12-01', 20, 'Tiger T99 Hitam', 357, 1),
(529, '2011-12-01', 20, 'Tiger T99 Hitam', 358, 1),
(530, '2011-12-01', 20, 'Tiger T99 Hitam', 360, 15),
(531, '2011-12-01', 20, 'Tiger T99 Hitam', 361, 15),
(532, '2011-12-01', 20, 'Tiger T99 Hitam', 362, 15),
(533, '2011-12-01', 20, 'Tiger T906', 363, 15),
(534, '2011-12-01', 20, 'Tiger T99 Hitam', 364, 15),
(535, '2011-12-01', 20, 'Tiger T99 Hitam', 365, 18),
(536, '2011-12-01', 20, 'Tiger T99 Hitam', 366, 18),
(537, '2011-12-01', 20, 'Tiger T99 Hitam', 367, 18),
(538, '2011-12-01', 20, 'Tiger T99 Hitam', 368, 18),
(539, '2011-12-01', 20, 'Tiger T99 Hitam', 369, 18),
(540, '2011-12-01', 20, 'Tiger T99 Hitam', 370, 18),
(541, '2011-12-01', 20, 'Tiger T99 Hitam', 371, 18),
(542, '2011-12-01', 20, 'Tiger T99 Hitam', 372, 18),
(543, '2011-12-01', 20, 'Tiger T99 Hitam', 373, 18),
(544, '2011-12-01', 20, 'Tiger T99 Hitam', 374, 18),
(545, '2011-12-01', 20, 'Tiger T99 Hitam', 375, 18),
(546, '2011-12-01', 20, 'Tiger T99 Hitam', 376, 18),
(547, '2011-12-01', 20, 'Tiger T99 Hitam', 377, 18),
(548, '2011-12-01', 20, 'Tiger T99 Hitam', 378, 18),
(549, '2011-12-01', 20, 'Tiger T99 Hitam', 379, 18),
(550, '2011-12-01', 20, 'Tiger T99 Hitam', 380, 18),
(551, '2011-12-01', 20, 'Tiger T99 Hitam', 381, 18),
(552, '2011-12-01', 20, 'Tiger T99 Hitam', 382, 18),
(553, '2011-12-01', 20, 'Tiger T99 Hitam', 383, 18),
(554, '2011-12-01', 20, 'Tiger T99 Hitam', 384, 18),
(555, '2011-12-01', 20, 'Tiger T99 Hitam', 385, 18),
(556, '2011-12-01', 20, 'Tiger T99 Hitam', 386, 18),
(557, '2011-12-01', 20, 'Tiger T99 Hitam', 387, 18),
(558, '2011-12-28', 20, 'Chitose', 388, 18),
(559, '2011-12-28', 20, 'Chitose', 389, 18),
(560, '2011-12-28', 20, 'Chitose', 400, 18),
(561, '2011-12-28', 20, 'Chitose', 401, 18),
(562, '2011-12-28', 20, 'Chitose', 402, 18),
(563, '2011-12-28', 20, 'Chitose', 403, 18),
(564, '2011-12-28', 20, 'Chitose', 404, 18),
(565, '2011-12-28', 20, 'Chitose', 405, 18),
(566, '2011-12-28', 20, 'Chitose', 406, 18),
(567, '2011-12-28', 20, 'Chitose', 407, 18),
(568, '2011-12-18', 20, 'Chitose MPR', 408, 18),
(569, '2011-12-18', 20, 'Chitose MPR', 409, 7),
(570, '2011-12-18', 20, 'Chitose MPR', 410, 7),
(571, '2011-12-18', 20, 'Chitose MPR', 411, 7),
(572, '2011-12-18', 20, 'Chitose MPR', 412, 7),
(573, '2011-12-18', 20, 'Chitose MPR', 413, 7),
(574, '2011-12-18', 20, 'Chitose MPR', 414, 7),
(575, '2011-12-18', 20, 'Chitose MPR', 415, 7),
(576, '2011-12-18', 20, 'Chitose MPR', 416, 7),
(577, '2011-12-18', 20, 'Chitose MPR', 417, 7),
(578, '2011-12-18', 20, 'Chitose MPR', 418, 7),
(579, '2011-12-18', 20, 'Chitose MPR', 419, 7),
(580, '2011-12-18', 20, 'Chitose MPR', 420, 7),
(581, '2011-12-18', 20, 'Chitose MPR', 421, 7),
(582, '2011-12-18', 20, 'Chitose MPR', 422, 7),
(583, '2011-12-18', 20, 'Chitose MPR', 423, 7),
(584, '2011-12-18', 20, 'Chitose MPR', 424, 7),
(585, '2011-12-18', 20, 'Chitose MPR', 425, 7),
(586, '2011-12-18', 20, 'Chitose MPR', 426, 7),
(587, '2011-12-18', 20, 'Chitose MPR', 427, 7),
(588, '2011-12-18', 20, 'Chitose MPR', 428, 7),
(589, '2011-12-18', 20, 'Chitose MPR', 429, 7),
(590, '2011-12-18', 20, 'Chitose MPR', 430, 7),
(591, '2011-12-18', 20, 'Chitose MPR', 431, 2),
(592, '2011-12-18', 20, 'Chitose MPR', 432, 2),
(593, '2011-12-18', 20, 'Chitose MPR', 433, 2),
(594, '2011-12-18', 20, 'Chitose MPR', 434, 2),
(595, '2011-12-18', 20, 'Chitose MPR', 435, 2),
(596, '2011-12-18', 20, 'Chitose MPR', 436, 2),
(597, '2011-12-18', 20, 'Chitose MPR', 437, 2),
(598, '2011-12-18', 20, 'Chitose MPR', 438, 2),
(599, '2011-12-18', 20, 'Chitose MPR', 439, 2),
(600, '2011-12-18', 20, 'Chitose MPR', 440, 2),
(601, '2011-12-18', 20, 'Chitose MPR', 441, 2),
(602, '2011-12-18', 20, 'Chitose MPR', 442, 2),
(603, '2011-12-18', 20, 'Chitose MPR', 443, 2),
(604, '2011-12-18', 20, 'Chitose MPR', 444, 2),
(605, '2011-12-18', 20, 'Chitose MPR', 445, 2),
(606, '2011-12-18', 20, 'Chitose MPR', 446, 2),
(607, '2011-12-18', 20, 'Chitose MPR', 447, 2),
(608, '2011-12-18', 20, 'Chitose MPR', 448, 2),
(609, '2011-12-18', 20, 'Chitose MPR', 449, 2),
(610, '2011-12-18', 20, 'Chitose MPR', 450, 2),
(611, '2011-12-18', 20, 'Chitose MPR', 451, 22),
(612, '2011-12-18', 20, 'Chitose MPR', 452, 22),
(613, '2011-12-18', 20, 'Chitose MPR', 453, 22),
(614, '2011-12-18', 20, 'Chitose MPR', 454, 22),
(615, '2011-12-18', 20, 'Chitose MPR', 455, 22),
(616, '2011-12-18', 20, 'Chitose MPR', 456, 22),
(617, '2011-12-18', 20, 'Chitose MPR', 457, 22),
(618, '2011-12-18', 20, 'Chitose MPR', 458, 22),
(619, '2011-12-18', 20, 'Chitose MPR', 459, 22),
(620, '2011-12-18', 20, 'Chitose MPR', 460, 22),
(621, '2011-12-18', 20, 'Chitose MPR', 461, 22),
(622, '2011-12-18', 20, 'Chitose MPR', 462, 22),
(623, '2011-12-18', 20, 'Chitose MPR', 463, 22),
(624, '2011-12-18', 20, 'Chitose MPR', 464, 22),
(625, '2011-12-18', 20, 'Chitose MPR', 465, 22),
(626, '2011-12-18', 20, 'Chitose MPR', 466, 22),
(627, '2011-12-18', 20, 'Chitose MPR', 467, 22),
(628, '2011-12-18', 20, 'Chitose MPR', 468, 22),
(629, '2011-12-18', 20, 'Chitose MPR', 469, 22),
(630, '2011-12-18', 20, 'Chitose MPR', 470, 22),
(631, '2011-12-18', 20, 'Chitose MPR', 471, 22),
(632, '2011-12-18', 20, 'Chitose MPR', 472, 22),
(633, '2011-12-18', 20, 'Chitose MPR', 473, 22),
(634, '2011-12-18', 20, 'Chitose MPR', 474, 22),
(635, '2011-12-18', 20, 'Chitose MPR', 475, 22),
(636, '2011-12-18', 20, 'Chitose MPR', 476, 22),
(637, '2011-12-18', 20, 'Chitose MPR', 477, 22),
(638, '2011-12-18', 20, 'Chitose MPR', 478, 22),
(639, '2011-12-18', 20, 'Chitose MPR', 479, 22),
(640, '2011-12-18', 20, 'Chitose MPR', 480, 22),
(641, '2011-12-18', 20, 'Chitose MPR', 481, 22),
(642, '2011-12-18', 20, 'Chitose MPR', 482, 22),
(643, '2011-12-18', 20, 'Chitose MPR', 483, 22),
(644, '2011-12-18', 20, 'Chitose MPR', 484, 22),
(645, '2011-12-18', 20, 'Chitose MPR', 485, 22),
(646, '2011-12-18', 20, 'Chitose MPR', 486, 22),
(647, '2011-12-18', 20, 'Chitose MPR', 487, 22),
(648, '2011-12-18', 20, 'Chitose MPR', 488, 22),
(649, '2011-12-18', 20, 'Chitose MPR', 489, 22),
(650, '2011-12-18', 20, 'Chitose MPR', 490, 22),
(651, '2011-12-18', 20, 'Chitose MPR', 491, 22),
(652, '2011-12-18', 20, 'Chitose MPR', 492, 22),
(653, '2011-12-18', 20, 'Chitose MPR', 493, 22),
(654, '2011-12-18', 20, 'Chitose MPR', 494, 22),
(655, '2011-12-18', 20, 'Chitose MPR', 495, 22),
(656, '2011-12-18', 20, 'Chitose MPR', 496, 22),
(657, '2011-12-18', 20, 'Chitose MPR', 497, 22),
(658, '2011-12-18', 20, 'Chitose MPR', 498, 22),
(659, '2011-12-18', 20, 'Chitose MPR', 499, 22),
(660, '2011-12-18', 20, 'Chitose MPR', 500, 21),
(661, '2011-12-18', 20, 'Chitose MPR', 501, 21),
(662, '2011-12-18', 20, 'Chitose MPR', 502, 21),
(663, '2011-12-18', 20, 'Chitose MPR', 503, 21),
(664, '2011-12-18', 20, 'Chitose MPR', 504, 21),
(665, '2011-12-18', 20, 'Chitose MPR', 505, 21),
(666, '2011-12-18', 20, 'Chitose MPR', 506, 21),
(667, '2011-12-18', 20, 'Chitose MPR', 507, 21),
(668, '2011-12-18', 20, 'Chairman VC 1055', 508, 21),
(669, '2011-12-18', 20, 'Chairman VC 1055', 509, 21),
(670, '2011-12-13', 20, 'Kursi High Point ECO-01', 510, 21),
(671, '2011-12-13', 20, 'Kursi High Point ECO-01', 511, 21),
(672, '2011-12-13', 20, 'Kursi High Point ECO-01', 512, 21),
(673, '2011-12-13', 20, 'Kursi High Point ECO-01', 513, 21),
(674, '2011-12-13', 20, 'Kursi High Point ECO-01', 514, 21),
(675, '2011-12-13', 20, 'Kursi High Point ECO-01', 515, 21),
(676, '2011-12-13', 20, 'Kursi High Point ECO-01', 516, 21),
(677, '2011-12-13', 20, 'Kursi High Point ECO-01', 517, 21),
(678, '2011-12-13', 20, 'Kursi High Point ECO-01', 518, 21),
(679, '2011-12-13', 20, 'Kursi High Point ECO-01', 519, 21),
(680, '2011-12-13', 20, 'Kursi High Point ECO-01', 520, 24),
(681, '2011-12-13', 20, 'Kursi High Point ECO-01', 521, 24),
(682, '2011-12-13', 20, 'Kursi High Point ECO-01', 522, 24),
(683, '2011-12-13', 20, 'Kursi High Point ECO-01', 523, 24),
(684, '2011-12-13', 20, 'Kursi High Point ECO-01', 524, 24),
(685, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 525, 22),
(686, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 526, 22),
(687, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 527, 22),
(688, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 528, 22),
(689, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 529, 22),
(690, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 530, 22),
(691, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 531, 22),
(692, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 532, 22),
(693, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 533, 22),
(694, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 534, 22),
(695, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 535, 22),
(696, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 536, 22),
(697, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 537, 22),
(698, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 538, 22),
(699, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 539, 22),
(700, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 540, 22),
(701, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 541, 22),
(702, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 542, 22),
(703, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 543, 22),
(704, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 544, 22),
(705, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 545, 22),
(706, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 546, 22),
(707, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 547, 22),
(708, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 548, 22),
(709, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 549, 22),
(710, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 550, 22),
(711, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 551, 22),
(712, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 552, 19),
(713, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 553, 19),
(714, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 554, 19),
(715, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 555, 19),
(716, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 556, 19),
(717, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 557, 19),
(718, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 558, 19),
(719, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 559, 19),
(720, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 560, 19),
(721, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 561, 19),
(722, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 562, 19),
(723, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 563, 19),
(724, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 564, 19),
(725, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 565, 19),
(726, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 566, 19),
(727, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 567, 19),
(728, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 568, 19),
(729, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 569, 19),
(730, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 570, 19),
(731, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 571, 19),
(732, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 572, 19),
(733, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 573, 19),
(734, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 574, 19),
(735, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 575, 19),
(736, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 576, 19),
(737, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 577, 19),
(738, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 576, 19),
(739, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 577, 19),
(740, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 578, 19),
(741, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 578, 19),
(742, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 579, 19),
(743, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 580, 19),
(744, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 581, 19),
(745, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 582, 19),
(746, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 583, 19),
(747, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 584, 19),
(748, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 585, 19),
(749, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 586, 19),
(750, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 587, 19),
(751, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 588, 19),
(752, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 589, 19),
(753, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 590, 19),
(754, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 591, 19),
(755, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 592, 19),
(756, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 593, 19),
(757, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 594, 19),
(758, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 595, 19),
(759, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 596, 19),
(760, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 597, 19),
(761, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 598, 19),
(762, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 599, 19),
(763, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 600, 19),
(764, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 601, 19),
(765, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 602, 19),
(766, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 603, 19),
(767, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 604, 19),
(768, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 605, 19),
(769, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 606, 19),
(770, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 607, 19),
(771, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 608, 19),
(772, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 609, 19),
(773, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 610, 19),
(774, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 611, 19),
(775, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 612, 19),
(776, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 613, 19),
(777, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 614, 19),
(778, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 615, 19),
(779, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 616, 19),
(780, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 617, 19),
(781, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 618, 19),
(782, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 619, 19),
(783, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 620, 19),
(784, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 621, 19),
(785, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 622, 19),
(786, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 623, 19),
(787, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 624, 19),
(788, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 625, 19),
(789, '2013-11-07', 20, 'Chitose Type Cosmos MNR', 626, 19),
(790, '2016-12-19', 20, 'Chitose YAMATO HAA', 627, 9),
(791, '2016-12-19', 20, 'Chitose YAMATO HAA', 628, 9),
(792, '2016-12-19', 20, 'Chitose YAMATO HAA', 629, 9),
(793, '2016-12-19', 20, 'Chitose YAMATO HAA', 630, 9),
(794, '2016-12-19', 20, 'Chitose YAMATO HAA', 631, 9),
(795, '2016-12-19', 20, 'Chitose YAMATO HAA', 632, 9),
(796, '2016-12-19', 20, 'Chitose YAMATO HAA', 634, 9),
(797, '2016-12-19', 20, 'Chitose YAMATO HAA', 635, 9),
(798, '2016-12-19', 20, 'Chitose YAMATO HAA', 636, 9),
(799, '2016-12-19', 20, 'Chitose YAMATO HAA', 637, 9),
(800, '2016-12-19', 20, 'Chitose YAMATO HAA', 638, 9),
(801, '2016-12-19', 20, 'Chitose YAMATO HAA', 639, 9),
(802, '2016-12-19', 20, 'Chitose YAMATO HAA', 640, 9),
(803, '2016-12-19', 20, 'Chitose YAMATO HAA', 641, 9),
(804, '2016-12-19', 20, 'Chitose YAMATO HAA', 642, 9),
(805, '2016-12-19', 20, 'Chitose YAMATO HAA', 643, 9),
(806, '2016-12-19', 20, 'Chitose YAMATO HAA', 644, 9),
(807, '2016-12-19', 20, 'Chitose YAMATO HAA', 645, 9),
(808, '2016-12-19', 20, 'Chitose YAMATO HAA', 646, 9),
(809, '2016-12-19', 20, 'Chitose YAMATO HAA', 647, 9),
(810, '2016-12-19', 20, 'Chitose YAMATO HAA', 648, 9),
(811, '2016-12-19', 20, 'Chitose YAMATO HAA', 649, 9),
(812, '2016-12-19', 20, 'Chitose YAMATO HAA', 627, 27),
(813, '2016-12-19', 20, 'Chitose YAMATO HAA', 628, 27),
(814, '2016-12-19', 20, 'Chitose YAMATO HAA', 629, 27),
(815, '2016-12-19', 20, 'Chitose YAMATO HAA', 630, 27),
(816, '2016-12-19', 20, 'Chitose YAMATO HAA', 631, 27),
(817, '2016-12-19', 20, 'Chitose YAMATO HAA', 632, 27),
(818, '2016-12-19', 20, 'Chitose YAMATO HAA', 633, 27),
(819, '2016-12-19', 20, 'Chitose YAMATO HAA', 634, 27),
(820, '2016-12-19', 20, 'Chitose YAMATO HAA', 635, 27),
(821, '2016-12-19', 20, 'Chitose YAMATO HAA', 636, 27),
(822, '2016-12-19', 20, 'Chitose YAMATO HAA', 637, 27),
(823, '2016-12-19', 20, 'Chitose YAMATO HAA', 638, 27),
(824, '2016-12-19', 20, 'Chitose YAMATO HAA', 639, 27),
(825, '2016-12-19', 20, 'Chitose YAMATO HAA', 640, 27),
(826, '2016-12-19', 20, 'Chitose YAMATO HAA', 641, 27),
(827, '2016-12-19', 20, 'Chitose YAMATO HAA', 642, 27),
(828, '2016-12-19', 20, 'Chitose YAMATO HAA', 643, 27),
(829, '2016-12-19', 20, 'Chitose YAMATO HAA', 644, 27),
(830, '2016-12-19', 20, 'Chitose YAMATO HAA', 645, 27),
(831, '2016-12-19', 20, 'Chitose YAMATO HAA', 646, 27),
(832, '2016-12-19', 20, 'Chitose YAMATO HAA', 647, 27),
(833, '2016-12-19', 20, 'Chitose YAMATO HAA', 648, 27),
(834, '2016-12-19', 20, 'Chitose YAMATO HAA', 649, 27),
(835, '2016-12-19', 20, 'Chitose YAMATO HAA', 650, 27),
(836, '2016-12-19', 20, 'Chitose YAMATO HAA', 651, 27),
(837, '2016-12-19', 20, 'Chitose YAMATO HAA', 652, 27),
(838, '2016-12-19', 20, 'Chitose YAMATO HAA', 653, 27),
(839, '2016-12-19', 20, 'Chitose YAMATO HAA', 654, 27),
(840, '2016-12-19', 20, 'Chitose YAMATO HAA', 655, 27),
(841, '2016-12-19', 20, 'Chitose YAMATO HAA', 656, 27),
(842, '2016-12-19', 20, 'Chitose YAMATO HAA', 657, 27),
(843, '2016-12-19', 20, 'Chitose YAMATO HAA', 658, 27),
(844, '2016-12-19', 20, 'Chitose YAMATO HAA', 659, 27),
(845, '2016-12-19', 20, 'Chitose YAMATO HAA', 660, 27),
(846, '2016-12-19', 20, 'Chitose YAMATO HAA', 661, 27),
(847, '2016-12-19', 20, 'Chitose YAMATO HAA', 662, 27),
(848, '2016-12-19', 20, 'Chitose YAMATO HAA', 663, 27),
(849, '2016-12-19', 20, 'Chitose YAMATO HAA', 664, 6),
(850, '2016-12-19', 20, 'Chitose YAMATO HAA', 665, 6),
(851, '2016-12-19', 20, 'Chitose YAMATO HAA', 666, 6),
(852, '2016-12-19', 20, 'Chitose YAMATO HAA', 667, 6),
(853, '2016-12-19', 20, 'Chitose YAMATO HAA', 668, 2),
(854, '2016-12-19', 20, 'Chitose YAMATO HAA', 669, 2),
(855, '2016-12-19', 20, 'Chitose YAMATO HAA', 670, 2),
(856, '2016-12-19', 20, 'Chitose YAMATO HAA', 671, 2),
(857, '2016-12-19', 20, 'Chitose YAMATO HAA', 672, 2),
(858, '2016-12-19', 20, 'Chitose YAMATO HAA', 673, 7),
(859, '2016-12-19', 20, 'Chitose YAMATO HAA', 674, 7),
(860, '2016-12-19', 20, 'Chitose YAMATO HAA', 675, 7),
(861, '2016-12-19', 20, 'Chitose YAMATO HAA', 676, 15),
(862, '2016-12-19', 20, 'Chitose YAMATO HAA', 677, 15),
(863, '2016-12-19', 20, 'Chitose YAMATO HAA', 678, 15),
(864, '2016-12-19', 20, 'Chitose YAMATO HAA', 679, 15),
(865, '2016-12-19', 20, 'Chitose YAMATO HAA', 680, 15),
(866, '2016-12-19', 20, 'Chitose YAMATO HAA', 681, 15),
(867, '2016-12-19', 20, 'Chitose YAMATO HAA', 682, 15),
(868, '2016-12-19', 20, 'Chitose YAMATO HAA', 683, 15),
(869, '2016-12-19', 20, 'Chitose YAMATO HAA', 684, 15),
(870, '2016-12-19', 20, 'Chitose YAMATO HAA', 685, 15),
(871, '2016-12-19', 20, 'Chitose YAMATO HAA', 686, 15),
(872, '2016-12-19', 20, 'Chitose YAMATO HAA', 687, 15),
(873, '2016-12-19', 20, 'Chitose YAMATO HAA', 689, 15),
(874, '2016-12-19', 20, 'Chitose YAMATO HAA', 690, 15),
(875, '2016-12-19', 20, 'Chitose YAMATO HAA', 691, 15),
(876, '2016-12-19', 20, 'Chitose YAMATO HAA', 692, 15),
(877, '2016-12-19', 20, 'Chitose YAMATO HAA', 693, 15),
(878, '2016-12-19', 20, 'Chitose YAMATO HAA', 694, 15),
(879, '2016-12-19', 20, 'Chitose YAMATO HAA', 695, 15),
(880, '2016-12-19', 20, 'Chitose YAMATO HAA', 696, 15),
(881, '2016-12-19', 20, 'Chitose YAMATO HAA', 697, 15),
(882, '2016-12-19', 20, 'Chitose YAMATO HAA', 698, 15),
(883, '2016-12-19', 20, 'Chitose YAMATO HAA', 699, 15),
(884, '2016-12-19', 20, 'Chitose YAMATO HAA', 700, 15),
(885, '2016-12-19', 20, 'Chitose YAMATO HAA', 701, 15),
(886, '2016-12-19', 20, 'Chitose YAMATO HAA', 702, 9),
(887, '2016-12-19', 20, 'Chitose YAMATO HAA', 703, 9),
(888, '2016-12-19', 20, 'Chitose YAMATO HAA', 704, 9),
(889, '2016-12-19', 20, 'Chitose YAMATO HAA', 705, 15),
(890, '2016-12-19', 20, 'Chitose YAMATO HAA', 706, 15),
(891, '2016-12-19', 20, 'Chitose YAMATO HAA', 707, 15),
(892, '2016-12-19', 20, 'Chitose YAMATO HAA', 708, 15),
(893, '2016-12-19', 20, 'Chitose YAMATO HAA', 709, 15),
(894, '2016-12-19', 20, 'Chitose YAMATO HAA', 710, 15),
(895, '2016-12-19', 20, 'Chitose YAMATO HAA', 711, 15),
(896, '2016-12-19', 20, 'Chitose YAMATO HAA', 712, 15),
(897, '2016-12-19', 20, 'Chitose YAMATO HAA', 713, 15),
(898, '2016-12-19', 20, 'Chitose YAMATO HAA', 714, 15),
(899, '2016-12-19', 20, 'Chitose YAMATO HAA', 715, 15),
(900, '2016-12-19', 20, 'Chitose YAMATO HAA', 716, 15),
(901, '2016-12-19', 20, 'Chitose YAMATO HAA', 717, 15),
(902, '2016-12-19', 20, 'Chitose YAMATO HAA', 718, 15),
(903, '2016-12-19', 20, 'Chitose YAMATO HAA', 719, 15),
(904, '2016-12-19', 20, 'Chitose YAMATO HAA', 720, 15),
(905, '2016-12-19', 20, 'Chitose YAMATO HAA', 721, 15),
(906, '2016-12-19', 20, 'Chitose YAMATO HAA', 722, 15),
(907, '2016-12-19', 20, 'Chitose YAMATO HAA', 723, 15),
(908, '2016-12-19', 20, 'Chitose YAMATO HAA', 724, 15),
(909, '2016-12-19', 20, 'Chitose YAMATO HAA', 725, 15),
(910, '2016-12-19', 20, 'Chitose Yamato HAA', 726, 15),
(911, '2017-11-21', 20, 'Kursi Tunggu HighPoint Monterey AY405K', 727, 22),
(912, '2017-11-21', 20, 'Kursi Tunggu HighPoint Monterey AY405K', 728, 22),
(913, '2017-11-21', 20, 'Kursi Tunggu HighPoint Monterey AY405K', 729, 22),
(914, '2011-12-28', 20, 'Highpoint Monterey AY405K', 730, 22),
(915, '2011-12-28', 20, 'Highpoint Monterey AY405K', 731, 22),
(916, '2018-06-26', 20, 'Informa Council 689-2', 732, 24),
(917, '2018-06-26', 20, 'Informa Council 689-2', 732, 15),
(918, '2018-06-26', 20, 'Informa Council 689-2', 733, 15),
(919, '2018-06-26', 20, 'Informa Council 689-2', 734, 15),
(920, '2018-06-26', 20, 'Informa Council 689-2', 735, 15),
(921, '2018-06-26', 20, 'Informa Council 689-2', 736, 15),
(922, '2018-06-26', 20, 'Informa Council 689-2', 737, 15),
(923, '2018-06-26', 20, 'Informa Council 689-2', 738, 15),
(924, '2018-06-26', 20, 'Informa Council 689-2', 739, 15),
(925, '2018-06-26', 20, 'Informa Council 689-2', 740, 15),
(926, '2018-06-26', 20, 'Informa Council 689-2', 741, 15),
(927, '2018-06-26', 20, 'Informa Council 689-2', 742, 15),
(928, '2018-06-26', 20, 'Informa Council 689-2', 743, 15),
(929, '2018-06-26', 20, 'Informa Council 689-2', 744, 15),
(930, '2018-06-26', 20, 'Informa Council 689-2', 745, 15),
(931, '2018-06-26', 20, 'Informa Council 689-2', 746, 15),
(932, '2018-06-26', 20, 'Informa Council 689-2', 747, 15),
(933, '2018-06-26', 20, 'Informa Council 689-2', 748, 15),
(934, '2018-06-26', 20, 'Informa Council 689-2', 749, 15),
(935, '2018-06-26', 20, 'Informa Council 689-2', 750, 15);
INSERT INTO `detail_data_barang` (`id`, `tanggal`, `idbarang_fk`, `merk_barang`, `nup`, `idruang_fk`) VALUES
(936, '2018-06-26', 20, 'Informa Council 689-2', 751, 15),
(937, '2018-06-26', 20, 'Informa Council 689-2', 752, 15),
(938, '2018-06-26', 20, 'Informa Council 689-2', 753, 15),
(939, '2018-06-26', 20, 'Informa Council 689-2', 754, 15),
(940, '2018-06-26', 20, 'Informa Council 689-2', 755, 15),
(941, '2018-06-26', 20, 'Informa Council 689-2', 756, 15),
(942, '2018-11-29', 20, 'Highpoint Monterey AY405K', 759, 16),
(943, '2018-11-29', 20, 'Highpoint Monterey AY405K', 760, 16),
(944, '2018-11-29', 20, 'Highpoint Monterey AY405K', 761, 16),
(945, '2018-11-29', 20, 'Highpoint Monterey AY405K', 762, 16),
(946, '2018-11-29', 20, 'Highpoint Monterey AY405K', 763, 16),
(947, '2018-11-29', 20, 'Highpoint Monterey AY405K', 764, 16),
(948, '2010-03-18', 21, 'MINIMALIS', 1, 12),
(949, '2017-11-14', 21, 'Sofa 211 Minimalis+Meja', 2, 23),
(950, '2017-11-14', 21, 'Sofa 211 Minimalis+Meja', 3, 15),
(951, '2018-07-27', 21, 'Kursi Taman 2 set untuk Taman Fasilkom', 4, 16),
(952, '2018-07-27', 21, 'Kursi Taman 2 set untuk Taman Fasilkom', 5, 16),
(953, '2009-12-17', 22, 'Kayu Jati', 1, 5),
(954, '2011-07-25', 22, 'MR 240', 2, 27),
(955, '2011-07-25', 22, 'MR 240', 3, 9),
(956, '2011-07-25', 22, 'MR 240', 4, 25),
(957, '2011-07-25', 22, 'MR 240', 5, 27),
(958, '2013-02-15', 22, 'Tanpa Merk', 6, 24),
(959, '2013-02-15', 22, 'Tanpa Merk', 7, 22),
(960, '2013-02-15', 22, 'Tanpa Merk', 8, 7),
(961, '2013-02-15', 22, 'Tanpa Merk', 9, 15),
(962, '2013-02-15', 22, 'Tanpa Merk', 10, 15),
(963, '2013-02-15', 22, 'Tanpa Merk', 11, 26),
(964, '2013-02-15', 22, 'Tanpa Merk', 12, 19),
(965, '2013-02-15', 22, 'Tanpa Merk', 13, 5),
(966, '2013-02-15', 22, 'Tanpa Merk', 14, 6),
(967, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 1, 11),
(968, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 2, 5),
(969, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 3, 5),
(970, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 4, 1),
(971, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 5, 4),
(972, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 6, 12),
(973, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 5, 4),
(974, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 5, 4),
(975, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 5, 4),
(976, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 5, 4),
(977, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 5, 4),
(978, '2010-03-18', 23, 'AZTEC CD 1202 BEACH', 6, 12),
(979, '2010-11-25', 23, 'AZTEC CD800P', 7, 13),
(980, '2010-11-25', 23, 'AZTEC CD800P', 7, 13),
(981, '2010-11-25', 23, 'AZTEC CD800P', 8, 13),
(982, '2010-11-25', 23, 'AZTEC CD800P', 9, 13),
(983, '2010-11-25', 23, 'AZTEC CD800P', 10, 13),
(984, '2010-11-25', 23, 'AZTEC CD800P', 11, 13),
(985, '2010-11-25', 23, 'AZTEC CD800P', 12, 13),
(986, '2010-11-25', 23, 'AZTEC CD 1202 BEACH', 13, 7),
(987, '2010-12-01', 23, 'AZTEC CD800P', 14, 13),
(988, '2010-12-01', 23, 'AZTEC CD800P', 15, 13),
(989, '2010-12-01', 23, 'AZTEC CD800P', 16, 13),
(990, '2010-12-01', 23, 'AZTEC CD800P', 17, 13),
(991, '2010-12-01', 23, 'AZTEC CD800P', 18, 13),
(992, '2010-12-01', 23, 'AZTEC CD800P', 19, 13),
(993, '2010-12-01', 23, 'AZTEC CD800P', 20, 13),
(994, '2010-12-16', 23, 'AZTEC CD800P', 21, 15),
(995, '2010-12-16', 23, 'AZTEC CD800P', 22, 5),
(996, '2011-07-25', 23, 'AZTEC CD 1201 Grey', 23, 4),
(997, '2011-07-25', 23, 'AZTEC CD 1201 Grey', 24, 4),
(998, '2011-07-25', 23, 'AZTEC CD 1201 Grey', 25, 4),
(999, '2011-07-25', 23, 'AZTEC CD 1201 Grey', 26, 5),
(1000, '2011-07-25', 23, 'AZTEC CD 1201 Grey', 27, 5),
(1001, '2011-07-25', 23, 'AZTEC CD 1201 Grey', 28, 14),
(1002, '2011-07-25', 23, 'AZTEC CD 1201 Grey', 29, 5),
(1003, '2011-07-25', 23, 'AZTEC CD 1201 Grey', 30, 3),
(1004, '2011-12-01', 23, 'Orbitrend GST-1061', 31, 8),
(1005, '2011-12-01', 23, 'Orbitrend GST-1061', 32, 8),
(1006, '2011-12-01', 23, 'Orbitrend GST-1061', 33, 8),
(1007, '2011-12-01', 23, 'Orbitrend GST-1061', 34, 8),
(1008, '2011-12-01', 23, 'Orbitrend GST-1061', 35, 8),
(1009, '2011-12-01', 23, 'Orbitrend GST-1061', 36, 8),
(1010, '2011-12-01', 23, 'Orbitrend GST-1061', 37, 8),
(1011, '2011-12-01', 23, 'Orbitrend GST-1061', 38, 8),
(1012, '2011-12-01', 23, 'Orbitrend GST-1061', 39, 8),
(1013, '2011-12-01', 23, 'Orbitrend GST-1061', 40, 8),
(1014, '2011-12-01', 23, 'Orbitrend GST-1061', 41, 8),
(1015, '2011-12-01', 23, 'Orbitrend GST-1061', 42, 8),
(1016, '2011-12-01', 23, 'Orbitrend GST-1061', 43, 8),
(1017, '2011-12-01', 23, 'Orbitrend GST-1061', 44, 8),
(1018, '2011-12-01', 23, 'Orbitrend GST-1061', 45, 8),
(1019, '2011-12-01', 23, 'Orbitrend GST-1061', 46, 8),
(1020, '2011-12-01', 23, 'Orbitrend GST-1061', 47, 8),
(1021, '2011-12-01', 23, 'Orbitrend GST-1061', 48, 8),
(1022, '2011-12-01', 23, 'Orbitrend GST-1061', 49, 8),
(1023, '2011-12-01', 23, 'Orbitrend GST-1061', 50, 8),
(1024, '2011-12-01', 23, 'Orbitrend GST-1061', 51, 8),
(1025, '2011-12-01', 23, 'Orbitrend GST-1061', 52, 8),
(1026, '2011-12-01', 23, 'Orbitrend GST-1061', 53, 8),
(1027, '2011-12-01', 23, 'Orbitrend GST-1061', 54, 8),
(1028, '2011-12-01', 23, 'Orbitrend GST-1061', 55, 8),
(1029, '2011-12-01', 23, 'Orbitrend GST-1061', 56, 8),
(1030, '2011-12-01', 23, 'Orbitrend GST-1061', 57, 8),
(1031, '2011-12-01', 23, 'Orbitrend GST-1061', 58, 8),
(1032, '2011-12-01', 23, 'Orbitrend GST-1061', 59, 8),
(1033, '2011-12-01', 23, 'Orbitrend GST-1061', 60, 8),
(1034, '2011-12-01', 23, 'Orbitrend GST-1061', 61, 8),
(1035, '2011-12-01', 23, 'Orbitrend GST-1061', 62, 8),
(1036, '2011-12-01', 23, 'Orbitrend GST-1061', 63, 8),
(1037, '2011-12-01', 23, 'Orbitrend GST-1061', 64, 8),
(1038, '2011-12-01', 23, 'Orbitrend GST-1061', 65, 8),
(1039, '2011-12-01', 23, 'Orbitrend GST-1061', 66, 8),
(1040, '2011-12-01', 23, 'Orbitrend GST-1061', 67, 8),
(1041, '2011-12-01', 23, 'Orbitrend GST-1061', 68, 8),
(1042, '2011-12-01', 23, 'Orbitrend GST-1061', 69, 8),
(1043, '2011-12-01', 23, 'Orbitrend GST-1061', 70, 8),
(1044, '2011-12-01', 23, 'Orbitrend GST-1061', 71, 8),
(1045, '2011-12-01', 23, 'Orbitrend GST-1061', 72, 8),
(1046, '2011-12-01', 23, 'Orbitrend GST-1061', 73, 8),
(1047, '2011-12-01', 23, 'Orbitrend GST-1061', 74, 26),
(1048, '2011-12-01', 23, 'Orbitrend GST-1061', 75, 26),
(1049, '2011-12-01', 23, 'Orbitrend GST-1061', 76, 26),
(1050, '2011-12-01', 23, 'Orbitrend GST-1061', 77, 26),
(1051, '2011-12-01', 23, 'Orbitrend GST-1061', 78, 26),
(1052, '2011-12-01', 23, 'Orbitrend GST-1061', 79, 26),
(1053, '2011-12-01', 23, 'Orbitrend GST-1061', 80, 26),
(1054, '2011-12-01', 23, 'Orbitrend GST-1061', 81, 26),
(1055, '2011-12-01', 23, 'Orbitrend GST-1061', 82, 26),
(1056, '2011-12-01', 23, 'Orbitrend GST-1061', 83, 26),
(1057, '2011-12-01', 23, 'Orbitrend GST-1061', 84, 26),
(1058, '2011-12-01', 23, 'Orbitrend GST-1061', 85, 26),
(1059, '2011-12-01', 23, 'Orbitrend GST-1061', 86, 26),
(1060, '2011-12-01', 23, 'Orbitrend GST-1061', 87, 26),
(1061, '2011-12-01', 23, 'Orbitrend GST-1061', 88, 26),
(1062, '2011-12-01', 23, 'Orbitrend GST-1061', 89, 26),
(1063, '2011-12-01', 23, 'Orbitrend GST-1061', 90, 26),
(1064, '2011-12-01', 23, 'Orbitrend GST-1061', 91, 6),
(1065, '2011-12-01', 23, 'Orbitrend GST-1061', 92, 6),
(1066, '2011-12-01', 23, 'Orbitrend GST-1061', 93, 6),
(1067, '2011-12-01', 23, 'Orbitrend GST-1061', 94, 6),
(1068, '2011-12-01', 23, 'Orbitrend GST-1061', 95, 6),
(1069, '2011-12-01', 23, 'Orbitrend GST-1061', 96, 6),
(1070, '2011-12-01', 23, 'Orbitrend GST-1061', 97, 6),
(1071, '2011-12-01', 23, 'Orbitrend GST-1061', 98, 6),
(1072, '2011-12-01', 23, 'Orbitrend GST-1061', 99, 6),
(1073, '2011-12-01', 23, 'Orbitrend GST-1061', 100, 6),
(1074, '2011-12-01', 23, 'Orbitrend GST-1061', 101, 6),
(1075, '2011-12-01', 23, 'Orbitrend GST-1061', 102, 6),
(1076, '2011-12-01', 23, 'Orbitrend GST-1061', 103, 6),
(1077, '2011-12-01', 23, 'Orbitrend GST-1061', 104, 6),
(1078, '2011-12-01', 23, 'Orbitrend GST-1061', 105, 6),
(1079, '2011-12-01', 23, 'Orbitrend GST-1061', 106, 6),
(1080, '2011-12-01', 23, 'Orbitrend GST-1061', 107, 6),
(1081, '2011-12-01', 23, 'Orbitrend GST-1061', 108, 6),
(1082, '2011-12-01', 23, 'Orbitrend GST-1061', 109, 6),
(1083, '2011-12-01', 23, 'Orbitrend GST-1061', 110, 6),
(1084, '2011-12-01', 23, 'Orbitrend GST-1061', 111, 6),
(1085, '2011-12-01', 23, 'Orbitrend GST-1061', 112, 6),
(1086, '2011-12-01', 23, 'Orbitrend GST-1061', 113, 15),
(1087, '2011-12-01', 23, 'Orbitrend GST-1061', 114, 6),
(1088, '2011-12-01', 23, 'Orbitrend GST-1061', 115, 7),
(1089, '2011-12-01', 23, 'Orbitrend GST-1061', 116, 7),
(1090, '2011-12-01', 23, 'Orbitrend GST-1061', 117, 7),
(1091, '2011-12-01', 23, 'Orbitrend GST-1061', 118, 7),
(1092, '2011-12-01', 23, 'Orbitrend GST-1061', 119, 15),
(1093, '2011-12-01', 23, 'Orbitrend GST-1061', 120, 7),
(1094, '2011-12-01', 23, 'Orbitrend GST-1061', 121, 7),
(1095, '2011-12-01', 23, 'Orbitrend GST-1061', 122, 7),
(1096, '2011-12-01', 23, 'Orbitrend GST-1061', 123, 7),
(1097, '2011-12-01', 23, 'Orbitrend GST-1061', 124, 7),
(1098, '2011-12-01', 23, 'Orbitrend GST-1061', 125, 7),
(1099, '2011-12-01', 23, 'Orbitrend GST-1061', 126, 7),
(1100, '2011-12-01', 23, 'Orbitrend GST-1061', 127, 7),
(1101, '2011-12-01', 23, 'Orbitrend GST-1061', 128, 7),
(1102, '2011-12-01', 23, 'Orbitrend GST-1061', 129, 7),
(1103, '2011-12-01', 23, 'Orbitrend GST-1061', 130, 7),
(1104, '2011-12-01', 23, 'Orbitrend GST-1061', 131, 7),
(1105, '2011-12-01', 23, 'Orbitrend GST-1061', 132, 7),
(1106, '2011-12-01', 23, 'Orbitrend GST-1061', 133, 7),
(1107, '2011-12-01', 23, 'Orbitrend GST-1061', 134, 7),
(1108, '2011-12-01', 23, 'Orbitrend GST-1061', 135, 15),
(1109, '2011-12-01', 23, 'Orbitrend GST-1061', 136, 7),
(1110, '2012-12-13', 23, 'Student High Point CT-3C', 137, 2),
(1111, '2012-12-13', 23, 'Student High Point CT-3C', 138, 2),
(1112, '2012-12-13', 23, 'Student High Point CT-3C', 139, 2),
(1113, '2012-12-13', 23, 'Student High Point CT-3C', 140, 2),
(1114, '2012-12-13', 23, 'Student High Point CT-3C', 141, 2),
(1115, '2012-12-13', 23, 'Student High Point CT-3C', 142, 2),
(1116, '2012-12-13', 23, 'Student High Point CT-3C', 143, 2),
(1117, '2012-12-13', 23, 'Student High Point CT-3C', 145, 15),
(1118, '2012-12-13', 23, 'Student High Point CT-3C', 146, 6),
(1119, '2012-12-13', 23, 'Instruktur High Point CD-301', 147, 25),
(1120, '2012-12-13', 23, 'Instruktur High Point CD-301', 148, 2),
(1121, '2014-12-04', 23, 'Meja Komputer AZTEK', 149, 3),
(1122, '2014-12-04', 23, 'Meja Komputer AZTEK', 150, 3),
(1123, '2014-12-04', 23, 'Meja Komputer AZTEK', 151, 15),
(1124, '2011-07-26', 24, 'PANASONIC A191D', 1, 11),
(1125, '2015-05-25', 25, 'pOLITRON 3PK', 1, 19),
(1126, '2015-05-25', 25, 'pOLITRON 3PK', 2, 19),
(1127, '2016-05-11', 26, 'PANASONIKAC', 35, 6),
(1128, '2016-05-11', 26, 'PANASONIKAC', 36, 6),
(1129, '2016-05-11', 26, 'PANASONIKAC', 37, 26),
(1130, '2010-12-16', 26, 'PANASONIK 2PK', 38, 21),
(1131, '2010-12-16', 26, 'PANASONIK 2PK', 39, 25),
(1132, '2010-12-16', 26, 'CHANGHONG CS-C18Y32', 40, 22),
(1133, '2010-12-16', 26, 'CHANGHONG CS-C18Y32', 41, 25),
(1134, '2010-12-16', 26, 'CHANGHONG CS-C18Y32', 42, 22),
(1135, '2010-12-16', 26, 'CHANGHONG CS-C18Y32', 43, 26),
(1136, '2011-12-01', 26, 'LG S18LG-2', 44, 13),
(1137, '2011-12-01', 26, 'LG S18LG-2', 45, 13),
(1138, '2011-12-01', 26, 'LG S18LG-2', 46, 8),
(1139, '2011-12-01', 26, 'LG S18LG-2', 47, 8),
(1140, '2011-12-01', 26, 'LG S18LG-2', 48, 8),
(1141, '2011-12-01', 26, 'LG S18LG-2', 49, 8),
(1142, '2011-12-01', 26, 'LG S18LG-2', 50, 18),
(1143, '2011-12-01', 26, 'LG S18LG-2', 51, 18),
(1144, '2011-12-01', 26, 'LG S18LG-2', 52, 18),
(1145, '2011-12-01', 26, 'LG S18LG-2', 53, 18),
(1146, '2011-12-28', 26, 'PANASONIC CS-PC 12KKP', 54, 4),
(1147, '2011-12-28', 26, 'PANASONIC CS-PC 12KKP', 55, 4),
(1148, '2011-12-28', 26, 'PANASONIC CS-PC 12KKP', 56, 27),
(1149, '2011-12-28', 26, 'PANASONIC CS-PC 12KKP', 57, 9),
(1150, '2011-12-28', 26, 'PANASONIC CS-PC 18KKP', 58, 2),
(1151, '2011-12-28', 26, 'PANASONIC CS-PC 12KKP', 59, 11),
(1152, '2013-02-15', 26, 'PANASONIC', 60, 20),
(1153, '2013-02-15', 26, 'PANASONIC', 61, 20),
(1154, '2013-02-15', 26, 'CHANGHONG', 62, 26),
(1155, '2013-02-15', 26, 'CHANGHONG', 63, 26),
(1156, '2013-02-15', 26, 'PANASONIC', 64, 21),
(1157, '2014-12-04', 26, 'CHANGHONG 2PK', 65, 5),
(1158, '2014-12-04', 26, 'CHANGHONG 2PK', 66, 5),
(1159, '2014-12-04', 26, 'CHANGHONG 2PK', 67, 23),
(1160, '2014-12-04', 26, 'CHANGHONG 1,5PK', 68, 7),
(1161, '2014-12-04', 26, 'CHANGHONG 1,5PK', 69, 7),
(1162, '2015-05-25', 26, 'PANASONIC 2PK', 70, 15),
(1163, '2015-05-25', 26, 'PANASONIC 2PK', 71, 15),
(1164, '2015-05-25', 26, 'PANASONIC R32 2PK', 72, 15),
(1165, '2017-11-24', 26, 'PANASONIK Inverter CS-s18rkp I n/CU-S18RKP out 2pk', 73, 15),
(1166, '2017-11-24', 26, 'PANASONIK CU-PN18SKP Outdoor/CS-PN18SKP/Indoee 2PK', 74, 15),
(1167, '2017-11-24', 26, 'PANASONIK CU-PN18SKP Outdoor/CS-PN18SKP/Indoee 2PK', 75, 22),
(1168, '2018-05-31', 26, 'AC PANASONIK 2PK', 76, 5),
(1169, '2018-05-31', 26, 'AC PANASONIK 2PK', 77, 5),
(1170, '2018-09-28', 26, '2 PK CS-YN18TKP', 78, 10),
(1171, '2018-09-28', 26, '2 PK CS-YN18TKP', 79, 10),
(1172, '2016-03-14', 76, 'Maspion Exhousfan', 4, 1),
(1173, '2016-03-14', 76, 'Maspion Exhousfan', 4, 3),
(1174, '2016-03-14', 76, 'Maspion Exhousfan', 5, 5),
(1175, '2016-03-14', 76, 'Maspion Exhousfan', 6, 4),
(1176, '2014-11-19', 76, 'Kipas Angin Berdiri MIYAKO', 7, 3),
(1177, '2014-11-19', 76, 'Kipas Angin Berdiri MIYAKO', 8, 18),
(1178, '2014-12-04', 76, 'Hexos Van', 9, 23),
(1179, '2010-03-18', 27, 'STANLESS 1000L', 1, 17),
(1180, '2011-07-26', 28, 'PANASONIC VIERA TH-L32C20X', 1, 16),
(1181, '2011-12-01', 28, 'LG 42LK450', 2, 27),
(1182, '2011-12-01', 28, 'LG 42LK450', 3, 23),
(1183, '2017-12-28', 28, 'SHARP LED TV 60 INCH FHD+ BRACKET', 4, 27),
(1184, '2019-04-29', 28, 'Televisi SHARP 60\"', 4, 23),
(1185, '2018-07-27', 29, 'TOA', 1, 18),
(1186, '2018-07-27', 30, 'SPEAKER TOA', 1, 18),
(1187, '2018-07-27', 30, 'SPEAKER TOA', 2, 18),
(1188, '2016-08-19', 31, 'LEXUS KM 500', 1, 18),
(1189, '2011-06-06', 32, 'AIRLIVE AIR VIDEO 2000', 1, 1),
(1190, '2011-12-22', 32, 'MIKROTIK RB800 WO834-A1', 2, 16),
(1191, '2011-12-22', 32, 'MIKROTIK RB800 WO834-A1', 3, 15),
(1192, '2011-12-22', 32, 'MIKROTIK RB800 WO834-A2', 4, 17),
(1193, '2011-12-22', 32, 'MIKROTIK RB800 WO834-A2', 5, 19),
(1194, '2011-12-28', 33, 'CALTEX DOUBLE TINGGI', 1, 18),
(1195, '2014-03-26', 33, 'TANPA MERK', 2, 18),
(1196, '2018-11-29', 34, 'MODENA', 1, 11),
(1197, '2018-11-29', 34, 'MODENA', 2, 27),
(1198, '2018-11-29', 34, 'MODENA', 3, 15),
(1199, '2018-11-29', 34, 'MODENA', 4, 1),
(1200, '2018-11-29', 34, 'MODENA', 5, 3),
(1201, '2018-11-29', 35, 'PODIUM KAYU', 1, 24),
(1202, '2018-08-30', 36, 'KABEL DAK SERVER', 1, 10),
(1203, '2018-08-30', 36, 'KABEL DAK SERVER', 2, 10),
(1204, '2018-08-30', 36, 'KABEL DAK SERVER', 3, 10),
(1205, '2018-08-30', 36, 'KABEL DAK SERVER', 4, 10),
(1206, '2018-08-30', 36, 'KABEL DAK SERVER', 5, 10),
(1207, '2018-08-30', 36, 'KABEL DAK SERVER', 6, 10),
(1208, '2018-08-30', 36, 'KABEL DAK SERVER', 7, 10),
(1209, '2018-08-30', 36, 'KABEL DAK SERVER', 8, 10),
(1210, '2018-08-30', 36, 'KABEL DAK SERVER', 9, 10),
(1211, '2018-08-30', 36, 'KABEL DAK SERVER', 10, 10),
(1212, '2018-08-30', 36, 'KABEL DAK SERVER', 11, 10),
(1213, '2018-08-30', 36, 'KABEL DAK SERVER', 12, 10),
(1214, '2018-08-30', 36, 'KABEL DAK SERVER', 13, 10),
(1215, '2018-08-30', 36, 'KABEL DAK SERVER', 14, 10),
(1216, '2018-08-30', 36, 'KABEL DAK SERVER', 15, 10),
(1217, '2018-08-30', 36, 'KABEL DAK SERVER', 16, 10),
(1218, '2018-08-30', 36, 'KABEL DAK SERVER', 17, 10),
(1219, '2018-08-30', 36, 'KABEL DAK SERVER', 18, 10),
(1220, '2018-08-30', 36, 'KABEL DAK SERVER', 19, 10),
(1221, '2018-08-30', 36, 'KABEL DAK SERVER', 20, 10),
(1222, '2018-08-30', 36, 'KABEL DAK SERVER', 21, 10),
(1223, '2018-08-30', 36, 'KABEL DAK SERVER', 22, 10),
(1224, '2018-08-30', 36, 'KABEL DAK SERVER', 23, 10),
(1225, '2018-08-30', 36, 'KABEL DAK SERVER', 24, 10),
(1226, '2018-08-30', 36, 'KABEL DAK SERVER', 25, 10),
(1227, '2016-07-26', 37, 'Mic Wireless Shure', 2, 10),
(1228, '2017-12-16', 37, 'TOA ZW-3200', 3, 10),
(1229, '2017-12-16', 37, 'TOA Wireless Michrophone ZW-G810CU + 2 Mic', 4, 10),
(1230, '2017-12-16', 37, 'TOA Wireless Michrophone ZW-G810CU + 2 Mic', 5, 10),
(1231, '2017-12-16', 37, 'TOA Wireless Michrophone ZW-G810CU + 2 Mic', 6, 10),
(1232, '2017-11-24', 37, 'Mic Wireless Shure ULX 4 BETA 58', 7, 10),
(1233, '2018-04-30', 37, 'Mic Wireless Sound cress 801', 8, 10),
(1234, '2018-04-30', 37, 'Mic Wireless Sound cress 801', 9, 10),
(1235, '2010-11-25', 38, 'APC SUA3000I', 1, 13),
(1236, '2010-12-01', 38, 'APC SUA3000I', 2, 13),
(1237, '2011-06-06', 38, 'APC SUA1500I', 3, 13),
(1238, '2011-07-26', 38, 'KENIKA', 4, 13),
(1239, '2011-12-01', 38, 'DELL UPS RACK 3750W/5000VA', 5, 25),
(1240, '2011-12-01', 38, 'DELL UPS RACK 3750W/5000VA', 6, 25),
(1241, '2011-12-01', 38, 'UPS Rack 3750W/5000VA', 7, 25),
(1242, '2011-12-01', 38, 'UPS Rack 3750W/5000VA', 8, 25),
(1243, '2011-12-01', 38, 'UPS Rack 3750W/5000VA', 9, 25),
(1244, '2011-12-01', 38, 'UPS Rack 3750W/5000VA', 10, 25),
(1245, '2012-12-13', 38, 'Dell 4200W/6000VA', 11, 2),
(1246, '2012-12-13', 38, 'Dell 4200W/6000VA', 12, 6),
(1247, '2012-12-13', 38, 'Dell 500W/750Va Watt', 13, 4),
(1248, '2012-12-13', 38, 'Dell 500W/750Va Watt', 14, 25),
(1249, '2012-12-13', 38, 'Dell 500W/750Va Watt', 15, 3),
(1250, '2012-12-13', 38, 'Dell 500W/750Va Watt', 16, 5),
(1251, '2012-12-13', 38, 'Dell 500W/750Va Watt', 17, 4),
(1252, '2018-12-26', 38, 'APC SURT15KRMXLI', 18, 10),
(1253, '2011-07-26', 39, 'PROLINK PWP301', 1, 1),
(1254, '2012-12-13', 40, 'Fancil D800', 1, 23),
(1255, '2012-12-13', 41, 'Bushnell Image View 118326', 1, 2),
(1256, '2012-12-13', 41, 'Bushnell Image View 118326', 2, 2),
(1257, '2012-12-13', 41, 'Bushnell Night Vision 260400', 3, 2),
(1258, '2012-12-13', 41, 'Bushnell Night Vision 260400', 4, 2),
(1259, '2011-07-26', 42, 'Favorite TC416 PABX-16 Unit', 1, 1),
(1260, '2010-03-18', 43, 'PANASONIC C KXFP 362 CX', 1, 11),
(1261, '2010-03-18', 44, 'COMEX', 1, 18),
(1262, '2010-03-18', 44, 'COMEX', 2, 18),
(1263, '2010-03-18', 44, 'COMEX', 3, 18),
(1264, '2010-03-18', 44, 'COMEX', 4, 27),
(1265, '2010-03-18', 44, 'COMEX', 5, 18),
(1266, '2010-03-18', 44, 'COMEX', 6, 1),
(1267, '2010-03-18', 44, 'COMEX', 7, 4),
(1268, '2010-03-18', 44, 'COMEX', 8, 4),
(1269, '2010-03-18', 44, 'COMEX', 9, 12),
(1270, '2010-03-18', 44, 'COMEX', 10, 13),
(1271, '2012-12-13', 44, 'Fanvil C58', 11, 11),
(1272, '2012-12-13', 44, 'Fanvil C58', 12, 11),
(1273, '2012-12-13', 44, 'Fanvil C58', 13, 11),
(1274, '2012-12-13', 44, 'Fanvil C58', 14, 12),
(1275, '2012-12-13', 44, 'Fanvil C58', 15, 1),
(1276, '2012-12-13', 44, 'Fanvil C58', 16, 5),
(1277, '2012-12-13', 44, 'Fanvil C58', 17, 5),
(1278, '2012-12-13', 44, 'Fanvil C58', 18, 4),
(1279, '2012-12-13', 44, 'Fanvil C58', 19, 3),
(1280, '2011-07-26', 45, 'Fingerspot Enterprise 2000C', 1, 2),
(1281, '2018-04-30', 45, 'Fingerprint New Premier Series', 2, 5),
(1282, '2012-12-13', 46, 'Trimble Tornado Antena for Mapping & GIS', 1, 2),
(1283, '2012-12-13', 46, 'Trimble Tornado Antena for Mapping & GIS', 2, 2),
(1284, '2011-07-26', 47, 'ACER M1900', 1, 5),
(1285, '2011-12-01', 47, 'DELL Optrirlex 790', 2, 9),
(1286, '2011-12-01', 47, 'DELL Optrirlex 790', 3, 26),
(1287, '2011-12-01', 47, 'DELL Optrirlex 790', 4, 26),
(1288, '2011-12-01', 47, 'DELL Optrirlex 790', 5, 26),
(1289, '2011-12-01', 47, 'DELL Optrirlex 790', 6, 5),
(1290, '2011-12-01', 47, 'DELL Optrirlex 790', 7, 26),
(1291, '2011-12-01', 47, 'DELL Optrirlex 790', 8, 25),
(1292, '2011-12-01', 47, 'DELL Optrirlex 790', 9, 26),
(1293, '2011-12-01', 47, 'DELL Optrirlex 790', 10, 5),
(1294, '2011-12-01', 47, 'DELL Optrirlex 790', 11, 26),
(1295, '2011-12-01', 47, 'DELL Optrirlex 790', 12, 15),
(1296, '2011-12-01', 47, 'DELL Optrirlex 790', 13, 23),
(1297, '2011-12-01', 47, 'DELL Optrirlex 790', 14, 26),
(1298, '2011-12-01', 47, 'DELL Optrirlex 790', 15, 26),
(1299, '2011-12-01', 47, 'DELL Optrirlex 790', 16, 26),
(1300, '2011-12-01', 47, 'DELL Optrirlex 790', 17, 5),
(1301, '2011-12-01', 47, 'DELL Optrirlex 790', 18, 26),
(1302, '2011-12-01', 47, 'DELL Optrirlex 790', 19, 26),
(1303, '2011-12-01', 47, 'DELL Optrirlex 790', 20, 26),
(1304, '2011-12-01', 47, 'DELL Optrirlex 790', 21, 26),
(1305, '2011-12-01', 47, 'DELL Optrirlex 790', 22, 26),
(1306, '2011-12-01', 47, 'DELL Optrirlex 790', 23, 26),
(1307, '2011-12-01', 47, 'DELL Optrirlex 790', 24, 26),
(1308, '2011-12-01', 47, 'DELL Optrirlex 790', 25, 26),
(1309, '2011-12-01', 47, 'DELL Optrirlex 790', 26, 26),
(1310, '2011-12-01', 47, 'DELL Optrirlex 790', 27, 26),
(1311, '2011-12-01', 47, 'DELL Optrirlex 790', 28, 26),
(1312, '2011-12-01', 47, 'DELL Optrirlex 790', 29, 26),
(1313, '2011-12-01', 47, 'DELL Optrirlex 790', 30, 26),
(1314, '2011-12-01', 47, 'DELL Optrirlex 790', 31, 26),
(1315, '2011-12-01', 47, 'DELL Optrirlex 790', 32, 26),
(1316, '2011-12-01', 47, 'DELL Optrirlex 790', 33, 26),
(1317, '2011-12-01', 47, 'DELL Optrirlex 790', 34, 26),
(1318, '2011-12-01', 47, 'DELL Optrirlex 790', 35, 26),
(1319, '2011-12-01', 47, 'DELL Optrirlex 790', 36, 26),
(1320, '2011-12-01', 47, 'DELL Optrirlex 790', 37, 26),
(1321, '2011-12-01', 47, 'DELL Optrirlex 790', 38, 26),
(1322, '2011-12-01', 47, 'DELL Optrirlex 790', 39, 26),
(1323, '2011-12-01', 47, 'DELL Optrirlex 790', 40, 26),
(1324, '2011-12-01', 47, 'DELL Optrirlex 790', 41, 26),
(1325, '2011-12-01', 47, 'DELL Optrirlex 790', 42, 26),
(1326, '2011-12-01', 47, 'DELL Optrirlex 790', 43, 26),
(1327, '2011-12-01', 47, 'DELL Optrirlex 790', 44, 26),
(1328, '2011-12-01', 47, 'DELL Optrirlex 790', 45, 26),
(1329, '2011-12-01', 47, 'DELL Optrirlex 790', 46, 26),
(1330, '2011-12-01', 47, 'DELL Optrirlex 790', 47, 26),
(1331, '2011-12-01', 47, 'DELL Optrirlex 790', 48, 26),
(1332, '2011-12-01', 47, 'DELL Optrirlex 790', 49, 26),
(1333, '2011-12-01', 47, 'DELL Optrirlex 790', 50, 26),
(1334, '2011-12-01', 47, 'DELL Optrirlex 790', 51, 26),
(1335, '2011-12-01', 47, 'DELL Optrirlex 790', 52, 26),
(1336, '2011-12-01', 47, 'DELL Optrirlex 790', 53, 26),
(1337, '2011-12-01', 47, 'DELL Optrirlex 790', 54, 26),
(1338, '2011-12-01', 47, 'DELL Optrirlex 790', 55, 26),
(1339, '2011-12-01', 47, 'DELL Optrirlex 790', 56, 26),
(1340, '2011-12-01', 47, 'DELL Optrirlex 790', 57, 26),
(1341, '2011-12-01', 47, 'DELL Optrirlex 790', 58, 26),
(1342, '2011-12-01', 47, 'DELL Optrirlex 790', 59, 26),
(1343, '2011-12-01', 47, 'DELL Optrirlex 790', 60, 26),
(1344, '2011-12-01', 47, 'DELL Optrirlex 790', 61, 11),
(1345, '2011-12-01', 47, 'DELL Optrirlex 790', 62, 6),
(1346, '2011-12-01', 47, 'DELL Optrirlex 790', 63, 6),
(1347, '2011-12-01', 47, 'DELL Optrirlex 790', 64, 6),
(1348, '2011-12-01', 47, 'DELL Optrirlex 790', 65, 6),
(1349, '2011-12-01', 47, 'DELL Optrirlex 790', 66, 6),
(1350, '2011-12-01', 47, 'DELL Optrirlex 790', 67, 6),
(1351, '2011-12-01', 47, 'DELL Optrirlex 790', 68, 6),
(1352, '2011-12-01', 47, 'DELL Optrirlex 790', 69, 6),
(1353, '2011-12-01', 47, 'DELL Optrirlex 790', 70, 6),
(1354, '2011-12-01', 47, 'DELL Optrirlex 790', 71, 6),
(1355, '2011-12-01', 47, 'DELL Optrirlex 790', 72, 6),
(1356, '2011-12-01', 47, 'DELL Optrirlex 790', 73, 6),
(1357, '2011-12-01', 47, 'DELL Optrirlex 790', 74, 6),
(1358, '2011-12-01', 47, 'DELL Optrirlex 790', 75, 6),
(1359, '2011-12-01', 47, 'DELL Optrirlex 790', 76, 6),
(1360, '2011-12-01', 47, 'DELL Optrirlex 790', 77, 6),
(1361, '2011-12-01', 47, 'DELL Optrirlex 790', 78, 6),
(1362, '2011-12-01', 47, 'DELL Optrirlex 790', 79, 7),
(1363, '2011-12-01', 47, 'DELL Optrirlex 790', 80, 7),
(1364, '2011-12-01', 47, 'DELL Optrirlex 790', 81, 7),
(1365, '2011-12-01', 47, 'DELL Optrirlex 790', 82, 7),
(1366, '2011-12-01', 47, 'DELL Optrirlex 790', 83, 7),
(1367, '2011-12-01', 47, 'DELL Optrirlex 790', 84, 7),
(1368, '2011-12-01', 47, 'DELL Optrirlex 790', 85, 7),
(1369, '2011-12-01', 47, 'DELL Optrirlex 790', 86, 7),
(1370, '2011-12-01', 47, 'DELL Optrirlex 790', 87, 7),
(1371, '2011-12-01', 47, 'DELL Optrirlex 790', 88, 7),
(1372, '2011-12-01', 47, 'DELL Optrirlex 790', 89, 7),
(1373, '2011-12-01', 47, 'DELL Optrirlex 790', 90, 7),
(1374, '2011-12-01', 47, 'DELL Optrirlex 790', 91, 7),
(1375, '2011-12-01', 47, 'DELL Optrirlex 790', 92, 7),
(1376, '2011-12-01', 47, 'DELL Optrirlex 790', 93, 7),
(1377, '2011-12-01', 47, 'DELL Optrirlex 790', 94, 7),
(1378, '2011-12-01', 47, 'DELL Optrirlex 790', 95, 7),
(1379, '2011-12-22', 47, 'ACER M1920, Built up', 96, 5),
(1380, '2011-12-22', 47, 'ACER M1920, Built up', 97, 5),
(1381, '2011-12-22', 47, 'ACER M1920, Built up', 98, 14),
(1382, '2011-12-22', 47, 'ACER M1920, Built up', 99, 3),
(1383, '2011-12-22', 47, 'ACER M1920, Built up', 100, 3),
(1384, '2011-12-22', 47, 'ACER Aspire M1900JM', 101, 1),
(1385, '2011-12-22', 47, 'ACER Aspire M1900JM', 102, 13),
(1386, '2012-12-13', 47, 'Dekstop PC Dell Optiplex 3010', 103, 4),
(1387, '2012-12-13', 47, 'Dekstop PC Dell Optiplex 3010', 104, 3),
(1388, '2012-12-13', 47, 'Dekstop PC Dell Optiplex 3010', 105, 5),
(1389, '2012-12-13', 47, 'Dekstop PC Dell Optiplex 3010', 106, 4),
(1390, '2012-12-13', 47, 'Dekstop PC Dell Optiplex 3010', 107, 3),
(1391, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 108, 4),
(1392, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 109, 4),
(1393, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 110, 2),
(1394, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 111, 2),
(1395, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 112, 2),
(1396, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 113, 2),
(1397, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 114, 2),
(1398, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 115, 2),
(1399, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 116, 2),
(1400, '2012-12-13', 47, 'Dell Optiplex 70110 Monitor 23\"', 117, 2),
(1401, '2016-11-07', 47, 'Acer Aspire M1800', 118, 13),
(1402, '2016-11-07', 47, 'Acer Aspire M1800', 120, 13),
(1403, '2016-11-07', 47, 'Acer Aspire M1800', 121, 13),
(1404, '2016-11-07', 47, 'Acer Aspire M1800', 122, 13),
(1405, '2016-11-07', 47, 'Acer Aspire M1800', 123, 13),
(1406, '2016-11-07', 47, 'Acer M3910', 124, 13),
(1407, '2016-11-07', 47, 'Acer M3910', 125, 13),
(1408, '2016-11-07', 47, 'Acer M3910', 126, 13),
(1409, '2016-11-07', 47, 'Acer M3910', 127, 13),
(1410, '2016-11-07', 47, 'Acer M3910', 128, 13),
(1411, '2016-11-07', 47, 'Acer M3910', 129, 12),
(1412, '2016-11-07', 47, 'Acer M3910', 130, 5),
(1413, '2016-11-07', 47, 'Acer M3910', 131, 1),
(1414, '2016-11-07', 47, 'Acer M3910', 132, 5),
(1415, '2016-11-07', 47, 'Acer M3910', 133, 4),
(1416, '2016-11-07', 47, 'Acer M3910', 134, 4),
(1417, '2016-11-07', 47, 'Acer M3910', 135, 4),
(1418, '2016-11-07', 47, 'Acer M3910', 136, 13),
(1419, '2016-11-07', 47, 'Acer M3910', 137, 13),
(1420, '2016-11-07', 47, 'Acer M3910', 138, 13),
(1421, '2016-11-07', 47, 'Acer M3910', 139, 13),
(1422, '2016-11-07', 47, 'Acer M3910', 140, 13),
(1423, '2016-11-07', 47, 'Acer M3910', 141, 13),
(1424, '2016-11-07', 47, 'Acer M3910', 142, 13),
(1425, '2016-11-07', 47, 'Acer M3910', 143, 13),
(1426, '2018-11-29', 47, 'Dell Power edge R730', 144, 10),
(1427, '2018-11-29', 47, 'Dell Power edge R730', 145, 10),
(1428, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 146, 8),
(1429, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 147, 8),
(1430, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 148, 8),
(1431, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 149, 8),
(1432, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 150, 8),
(1433, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 151, 8),
(1434, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 152, 8),
(1435, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 153, 8),
(1436, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 154, 8),
(1437, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 155, 8),
(1438, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 156, 8),
(1439, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 157, 8),
(1440, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 158, 8),
(1441, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 159, 8),
(1442, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 160, 8),
(1443, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 161, 8),
(1444, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 162, 8),
(1445, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 163, 8),
(1446, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 164, 8),
(1447, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 165, 8),
(1448, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 166, 8),
(1449, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 167, 8),
(1450, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 168, 8),
(1451, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 169, 8),
(1452, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 170, 8),
(1453, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 171, 8),
(1454, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 172, 8),
(1455, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 173, 8),
(1456, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 174, 8),
(1457, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 175, 8),
(1458, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 176, 8),
(1459, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 177, 8),
(1460, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 178, 8),
(1461, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 179, 8),
(1462, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 180, 8),
(1463, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 181, 8),
(1464, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 182, 8),
(1465, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 183, 8),
(1466, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 184, 8),
(1467, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 185, 8),
(1468, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 186, 8),
(1469, '2018-12-12', 47, 'Dell Inspiron 3277 AIO', 187, 8),
(1470, '2018-12-18', 47, 'Dell Inspiron 3277 AIO', 188, 8),
(1471, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 189, 10),
(1472, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 190, 10),
(1473, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 191, 10),
(1474, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 192, 10),
(1475, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 193, 10),
(1476, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 194, 10),
(1477, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 195, 10),
(1478, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 196, 10),
(1479, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 197, 10),
(1480, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 198, 10),
(1481, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 199, 10),
(1482, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 200, 10),
(1483, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 201, 10),
(1484, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 202, 10),
(1485, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 203, 10),
(1486, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 204, 10),
(1487, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 205, 10),
(1488, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 206, 10),
(1489, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 207, 10),
(1490, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 208, 10),
(1491, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 209, 10),
(1492, '2018-12-18', 47, 'Dell All in One Inspiron 24 5477', 210, 10),
(1493, '2011-06-06', 48, 'Wow Wee Rovio', 1, 13),
(1494, '2011-06-06', 48, 'Arm MR-999E', 2, 13),
(1495, '2011-12-28', 49, 'Nikon D5 100 Kit TO', 1, 1),
(1496, '2018-12-12', 49, 'Canon Digital EOS 77D With Lens18-55mm+Memory 32G', 1, 1),
(1497, '2012-12-13', 50, 'Handheld GPS System Trimble Juno', 1, 2),
(1498, '2012-12-13', 50, 'Handheld GPS System Trimble Juno', 2, 2),
(1499, '2012-12-13', 50, 'Trimble geo explorer 6000', 3, 2),
(1500, '2012-12-13', 50, 'Trimble Recon Hendheld', 4, 2),
(1501, '2012-12-13', 50, 'Trimble Recon Hendheld', 5, 2),
(1502, '2011-12-22', 51, 'Omni Mikrotik ANT APF24-20', 1, 1),
(1503, '2011-12-22', 51, 'Omni Mikrotik ANT APF24-20', 2, 19),
(1504, '2011-12-22', 51, 'Omni Mikrotik ANT APF24-20', 3, 15),
(1505, '2012-12-18', 52, 'Matsunaga', 1, 18),
(1506, '2012-12-18', 52, 'Matsunaga', 2, 18),
(1507, '2012-12-18', 52, 'Matsunaga', 3, 18),
(1508, '2012-12-18', 52, 'Matsunaga', 4, 18),
(1509, '2012-12-18', 52, 'Matsunaga', 5, 18),
(1510, '2012-12-18', 52, 'Matsunaga', 6, 18),
(1511, '2012-12-18', 52, 'Matsunaga', 7, 18),
(1512, '2012-12-18', 52, 'Matsunaga', 8, 18),
(1513, '2012-12-18', 52, 'Matsunaga', 9, 18),
(1514, '2012-12-18', 52, 'Matsunaga', 10, 18),
(1515, '2012-12-18', 52, 'Matsunaga', 11, 18),
(1516, '2012-12-18', 52, 'Matsunaga', 12, 18),
(1517, '2012-12-18', 52, 'Matsunaga', 13, 18),
(1518, '2012-12-18', 52, 'Matsunaga', 14, 18),
(1519, '2012-12-18', 52, 'Matsunaga', 15, 18),
(1520, '2012-12-18', 52, 'Matsunaga', 16, 18),
(1521, '2012-12-18', 52, 'Matsunaga', 17, 18),
(1522, '2012-12-18', 52, 'Matsunaga', 18, 18),
(1523, '2012-12-18', 52, 'Matsunaga', 19, 18),
(1524, '2012-12-18', 52, 'Matsunaga', 20, 18),
(1525, '2012-12-18', 52, 'Matsunaga', 21, 18),
(1526, '2012-12-18', 52, 'Matsunaga', 22, 18),
(1527, '2012-12-18', 52, 'Matsunaga', 23, 18),
(1528, '2012-12-18', 52, 'Matsunaga', 24, 18),
(1529, '2012-12-18', 52, 'Matsunaga', 25, 18),
(1530, '2012-12-18', 52, 'Matsunaga', 26, 18),
(1531, '2012-12-18', 52, 'Matsunaga', 27, 18),
(1532, '2012-12-18', 52, 'Matsunaga', 28, 18),
(1533, '2012-12-18', 52, 'Matsunaga', 29, 18),
(1534, '2012-12-18', 52, 'Matsunaga', 30, 18),
(1535, '2012-12-18', 52, 'Matsunaga', 31, 18),
(1536, '2012-12-18', 52, 'Matsunaga', 32, 18),
(1537, '2012-12-18', 52, 'Matsunaga', 33, 18),
(1538, '2012-12-18', 52, 'Matsunaga', 34, 18),
(1539, '2012-12-18', 52, 'Matsunaga', 35, 18),
(1540, '2012-12-18', 52, 'Matsunaga', 36, 18),
(1541, '2012-12-18', 52, 'Matsunaga', 37, 18),
(1542, '2012-12-18', 52, 'Matsunaga', 38, 18),
(1543, '2012-12-18', 52, 'Matsunaga', 39, 18),
(1544, '2012-12-18', 52, 'Matsunaga', 40, 18),
(1545, '2012-12-18', 52, 'Matsunaga', 41, 18),
(1546, '2012-12-18', 52, 'Matsunaga', 42, 18),
(1547, '2012-12-18', 52, 'Matsunaga', 43, 18),
(1548, '2012-12-18', 52, 'Matsunaga', 44, 18),
(1549, '2012-12-18', 52, 'Matsunaga', 45, 18),
(1550, '2012-12-18', 52, 'Matsunaga', 46, 18),
(1551, '2012-12-18', 52, 'Matsunaga', 47, 18),
(1552, '2012-12-18', 52, 'Matsunaga', 48, 18),
(1553, '2012-12-18', 52, 'Matsunaga', 49, 18),
(1554, '2012-12-18', 52, 'Matsunaga', 50, 18),
(1555, '2012-12-18', 52, 'Matsunaga', 51, 18),
(1556, '2012-12-18', 52, 'Matsunaga', 52, 18),
(1557, '2012-12-18', 52, 'Matsunaga', 53, 18),
(1558, '2012-12-18', 52, 'Matsunaga', 54, 18),
(1559, '2012-12-18', 52, 'Matsunaga', 55, 18),
(1560, '2012-12-18', 52, 'Matsunaga', 56, 18),
(1561, '2012-12-18', 52, 'Matsunaga', 57, 18),
(1562, '2012-12-18', 52, 'Matsunaga', 58, 18),
(1563, '2012-12-18', 52, 'Matsunaga', 59, 18),
(1564, '2012-12-18', 52, 'Matsunaga', 60, 15),
(1565, '2012-12-13', 53, 'Tablet with GPS Pathfinder ProXH receiver', 1, 2),
(1566, '2011-12-01', 54, 'Dell Precision T1600', 1, 25),
(1567, '2011-12-01', 54, 'Precision T1600', 2, 25),
(1568, '2011-12-01', 54, 'Dell Precision T15500', 3, 25),
(1569, '2012-12-13', 54, 'DELL PRECISION T3600', 4, 2),
(1570, '2012-12-13', 54, 'DELL PRECISION T3600', 5, 2),
(1571, '2012-12-13', 54, 'DELL PRECISION T3600', 6, 2),
(1572, '2012-12-13', 54, 'DELL PRECISION T3600', 7, 2),
(1573, '2017-12-18', 55, 'ACER ALL In ONE C20-720', 1, 24),
(1574, '2017-12-18', 55, 'ACER ALL In ONE C20-720', 2, 19),
(1575, '2017-12-18', 55, 'ACER ALL In ONE C20-720', 3, 26),
(1576, '2017-12-18', 55, 'ACER ALL In ONE C20-720', 4, 20),
(1577, '2017-12-18', 55, 'ACER ALL In ONE C20-720', 5, 21),
(1578, '2017-12-18', 55, 'ACER ALL In ONE C20-720', 6, 22),
(1579, '2017-12-18', 55, 'ACER ALL In ONE C20-720', 7, 8),
(1580, '2010-11-25', 56, 'Fujitsu Lifebook TH700', 1, 1),
(1581, '2011-06-06', 56, 'Toshiba Portege T210-1029 U', 2, 1),
(1582, '2011-06-06', 56, 'ASUS A42F-VX085D', 3, 13),
(1583, '2011-06-06', 56, 'Toshiba Satellite L635-1064', 4, 13),
(1584, '2011-07-26', 56, 'Toshiba Portege T210-1018R', 5, 1),
(1585, '2019-03-27', 56, 'Asus Ultra Slim 14 inch', 6, 4),
(1586, '2010-12-01', 57, 'Asus Eee PC 1005PX-Black', 1, 1),
(1587, '2010-12-01', 57, 'Asus Eee PC 1005PX-Black', 2, 1),
(1588, '2010-12-16', 57, 'Asus Eee PC 1005PX', 3, 11),
(1589, '2011-12-01', 57, 'Dell Latitude E6420', 4, 4),
(1590, '2011-12-01', 57, 'Dell Latitude E6420', 5, 6),
(1591, '2011-12-01', 57, 'Latitude E6420', 6, 2),
(1592, '2011-12-01', 57, 'Latitude E6420', 7, 15),
(1593, '2011-12-01', 57, 'Latitude E6420', 8, 15),
(1594, '2012-12-13', 57, 'DELL Latitude E6230', 9, 23),
(1595, '2012-12-13', 57, 'DELL Latitude E6230', 10, 11),
(1596, '2012-12-13', 57, 'Dell Precision M6700', 11, 1),
(1597, '2015-04-13', 57, 'Apple Mac Book Air (MD7121D/B)', 12, 27),
(1598, '2017-10-26', 57, 'ASUS Business Notebook P243OUA', 13, 12),
(1599, '2017-10-26', 57, 'ASUS Business Notebook P243OUA', 14, 4),
(1600, '2017-10-26', 57, 'ASUS Business Notebook P243OUA', 15, 15),
(1601, '2017-10-26', 57, 'ASUS Business Notebook P243OUA', 16, 1),
(1602, '2012-12-13', 58, 'DELL Ultra Sharp U2410', 1, 2),
(1603, '2012-12-13', 58, 'DELL Ultra Sharp U2410', 2, 2),
(1604, '2012-12-13', 58, 'Interactive  pen Display Wacom DTU-2231 A', 3, 2),
(1605, '2012-12-13', 58, 'Interactive  pen Display Wacom DTU-2231 A', 1, 2),
(1606, '2010-03-18', 59, 'LASERJET P1005 HP', 1, 4),
(1607, '2010-11-25', 59, 'HP LASERJET PRO P1 102', 2, 23),
(1608, '2010-11-25', 59, 'HP LASERJET PRO P1 102', 3, 5),
(1609, '2010-12-01', 59, 'CANON PIXMA MP276', 4, 18),
(1610, '2010-12-01', 59, 'CANON PIXMA MP276', 5, 14),
(1611, '2011-07-26', 59, 'HP Laser Pro P1 102', 6, 5),
(1612, '2011-07-26', 59, 'Epson L100', 7, 7),
(1613, '2011-12-01', 59, 'Canon pixma MGR 170', 8, 13),
(1614, '2011-12-01', 59, 'Canon pixma MGR 170', 9, 7),
(1615, '2011-12-01', 59, 'Lip CP3525dn', 10, 25),
(1616, '2011-12-01', 59, 'HP Laser Jet Pro MI 212', 11, 1),
(1617, '2011-12-01', 59, 'CANON PIXMA IP4870', 12, 18),
(1618, '2011-12-01', 59, 'HP LAser Jet Pro MO 212', 13, 5),
(1619, '2012-12-18', 59, 'EPSON LQ 2190', 14, 18),
(1620, '2012-12-18', 59, 'HP Laser Jet P1002', 15, 15),
(1621, '2012-12-18', 59, 'HP Laser Jet P1002', 16, 4),
(1622, '2012-12-18', 59, 'INK Jet EPSON L110', 17, 14),
(1623, '2012-12-13', 59, 'HP Laser Jet P1002', 18, 18),
(1624, '2012-12-13', 59, 'HP Laser Jet P1002', 19, 1),
(1625, '2012-12-13', 59, 'HP Laser Jet P1002', 20, 4),
(1626, '2012-12-13', 59, 'HP Laser Jet P1002', 21, 5),
(1627, '2012-12-13', 59, 'HP Laser Jet P1002', 22, 6),
(1628, '2012-12-13', 59, 'HP DESIGNjet 510 AO 42\" (AO+) CH337A', 23, 2),
(1629, '2015-12-15', 59, 'EPSON L360', 24, 1),
(1630, '2015-12-15', 59, 'EPSON L360', 25, 11),
(1631, '2015-12-15', 59, 'HP Laser Jet P1102', 26, 5),
(1632, '2015-12-15', 59, 'HP Laser Jet P1102', 27, 4),
(1633, '2015-12-15', 59, 'HP Laser Jet P1102', 28, 1),
(1634, '2017-10-16', 59, 'Printer EpsonL 360', 29, 10),
(1635, '2017-10-16', 59, 'Printer EpsonL 360', 30, 10),
(1636, '2017-10-16', 59, 'Printer EpsonL 360', 31, 10),
(1637, '2017-10-16', 59, 'Printer EpsonL 360', 32, 10),
(1638, '2017-10-16', 59, 'Printer HP Laser Jet Pro M102a (G3Q34A)', 33, 10),
(1639, '2017-10-16', 59, 'Printer HP Laser Jet Pro M102a (G3Q34A)', 34, 10),
(1640, '2017-10-16', 59, 'Printer HP Laser Jet Pro M102a (G3Q34A)', 35, 10),
(1641, '2011-12-01', 60, 'EPSON GT-2900', 1, 4),
(1642, '2011-12-01', 61, 'EPSON GT-2900', 2, 1),
(1643, '2011-12-01', 61, 'SEAGATE STAC4000100', 1, 1),
(1644, '2011-12-01', 61, 'SEAGATE STAC4000100', 2, 1),
(1645, '2011-12-01', 61, 'SEAGATE STAC4000100', 3, 1),
(1646, '2011-12-01', 61, 'SEAGATE STAC4000100', 4, 1),
(1647, '2011-12-01', 61, 'SEAGATE STAC4000100', 5, 1),
(1648, '2011-06-06', 62, 'QNAP TS 559 Pro+', 1, 25),
(1649, '2011-12-01', 62, 'DELL PowerEdge T410', 2, 25),
(1650, '2011-12-01', 62, 'DELL PowerEdge T410', 3, 25),
(1651, '2011-12-01', 62, 'DELL PowerEdge T410', 4, 25),
(1652, '2011-12-01', 62, 'DELL PowerEdge T410', 5, 25),
(1653, '2011-12-01', 62, 'DELL PowerEdge T410', 6, 25),
(1654, '2011-12-01', 62, 'SUPERMI CRO Super Server 1029P-WTR', 7, 10),
(1655, '2011-12-01', 62, 'SUPERMI CRO Super Server 1029P-WTR', 8, 10),
(1656, '2018-12-12', 62, 'ATEN 8-Port PS/2-USB VGA LCD KVM Switch with daisy', 9, 10),
(1657, '2011-12-22', 63, 'Rackmount, Nikrotik RB110', 1, 25),
(1658, '2011-12-22', 63, 'Rackmount, Nikrotik RB110', 2, 25),
(1659, '2011-12-22', 63, 'Buit, Mikrotik RB450', 3, 6),
(1660, '2011-12-22', 63, 'Buit, Mikrotik RB450', 4, 1),
(1661, '2011-12-22', 63, 'Buit, Mikrotik RB450', 5, 1),
(1662, '2011-12-22', 63, 'Buit, Mikrotik RB450', 6, 1),
(1663, '2011-12-22', 63, 'Buit, Mikrotik RB450', 7, 1),
(1664, '2011-12-22', 63, 'Buit, Mikrotik RB450', 8, 1),
(1665, '2011-12-22', 63, 'Buit, Mikrotik RB450', 9, 1),
(1666, '2011-12-22', 63, 'Buit, Mikrotik RB450', 10, 1),
(1667, '2011-12-22', 63, 'Mikrotik Core Router', 11, 10),
(1668, '2010-12-01', 64, 'D-LINK DGS-1024D', 1, 13),
(1669, '2011-12-01', 65, 'Dell PowerEdge Rack 4220', 1, 25),
(1670, '2011-12-01', 65, 'Dell PowerEdge Rack 4220', 2, 25),
(1671, '2012-12-13', 66, 'Fortuna 8u double door', 1, 2),
(1672, '2011-12-01', 67, 'DRAKA CAT6 MT Cable', 1, 8),
(1673, '2011-12-01', 67, 'DRAKA CAT6 MT Cable', 2, 8),
(1674, '2011-12-01', 67, 'DRAKA CAT6 MT Cable', 3, 13),
(1675, '2011-12-01', 67, 'DRAKA CAT6 MT Cable', 4, 6),
(1676, '2011-12-01', 67, 'DRAKA CAT6 UTP Cable', 7, 1),
(1677, '2011-12-01', 67, 'DRAKA CAT6 UTP Cable', 8, 7),
(1678, '2018-08-30', 67, 'Belden Cat 6', 9, 25),
(1679, '2016-03-14', 68, 'TP Link Switch HUB', 14, 5),
(1680, '2016-03-14', 68, 'TP Link Switch HUB', 15, 25),
(1681, '2011-12-01', 68, 'D-LINK DGS 1210-16/r', 16, 1),
(1682, '2011-12-01', 68, 'D-LINK DGS 1210-16/r', 17, 25),
(1683, '2011-12-01', 68, 'D-LINK DGS 1210-16/r', 18, 25),
(1684, '2011-12-01', 68, 'D-LINK DGS 1210-16/r', 19, 25),
(1685, '2011-12-01', 68, 'D-LINK DGS 1210-16/r', 20, 7),
(1686, '2011-12-01', 68, 'D-LINK DGS 1210-24/E', 21, 7),
(1687, '2011-12-01', 68, 'D-LINK DGS 1210-24/E', 22, 7),
(1688, '2011-12-01', 68, 'D-LINK DGS 1210-24/E', 23, 7),
(1689, '2011-12-01', 68, 'D-LINK DGS 1210-24/E', 24, 6),
(1690, '2011-12-01', 68, 'D-LINK DGS 1210-24/E', 25, 1),
(1691, '2011-12-01', 68, 'D-LINK DGS 1210-24/E', 26, 15),
(1692, '2012-12-13', 68, 'LINK TL-SG 1024', 27, 1),
(1693, '2012-12-13', 68, 'LINK TL-SG 1024', 28, 18),
(1694, '2018-02-23', 68, 'SWITCH MANAGE Cisco SLM2008T-EU', 29, 1),
(1695, '2018-02-23', 68, 'SWITCH MANAGE Cisco SLM2008T-EU', 30, 13),
(1696, '2018-08-30', 68, 'CISCO SG95D-08/-Port Gigabit Dekstop Switch', 31, 25),
(1697, '2018-08-30', 68, 'CISCO SG95D-08/-Port Gigabit Dekstop Switch', 32, 1),
(1698, '2018-11-29', 68, 'JUNIPER Switch Manage EX2200-24T-4G', 33, 10),
(1699, '2018-12-12', 68, 'TP-LINK AC1200 Dual-Band Wifi Gigabit Router', 34, 10),
(1700, '2011-12-01', 69, 'D-Link DAP-1360', 1, 24),
(1701, '2011-12-01', 69, 'Converter VGA to HDMI', 2, 19),
(1702, '2018-03-29', 70, 'Converter VGA to HDMI', 3, 26),
(1703, '2018-03-29', 70, 'Converter VGA to HDMI', 4, 20),
(1704, '2018-03-29', 70, 'Converter VGA to HDMI', 5, 21),
(1705, '2018-03-29', 70, 'Converter VGA to HDMI', 6, 22),
(1706, '2018-03-29', 70, 'Converter VGA to HDMI', 7, 8),
(1707, '2010-03-18', 71, 'LAKONI 505', 1, 17),
(1708, '2011-12-01', 72, 'Dell Power Vault MI 1200', 1, 25),
(1709, '2011-12-01', 72, 'Dell Power Vault MI 1200', 2, 25),
(1710, '2011-12-01', 72, 'Dell Power Vault MI 1200', 3, 25),
(1711, '2011-12-01', 72, 'Dell Power Vault MI 1200', 4, 25),
(1712, '2011-12-13', 72, 'WD Sentinel DX4000 WDBLGTO 1 20KBK', 5, 2),
(1713, '2011-12-13', 72, 'WD Sentinel DX4000 WDBLGTO 1 20KBK', 6, 2),
(1714, '2011-12-28', 73, 'Meja Pingpong Lokal', 1, 16),
(1715, '2018-03-29', 73, 'Tanis Meja Nittaku 2003B', 2, 16),
(1716, '2016-07-26', 74, 'Keyboard Roland E 09', 1, 18),
(1717, '2011-12-28', 74, 'Korg PA50 RU', 2, 18),
(1718, '2011-12-01', 75, 'MATLAB 7', 1, 1),
(1719, '2011-12-01', 75, 'MATLAB Parallel computing', 2, 1),
(1720, '2011-12-01', 75, 'MATLAB Opsfullzation Toolbox', 3, 1),
(1721, '2011-12-01', 74, 'MATLAB Symbolic Math Toolbox', 4, 1),
(1722, '2011-12-01', 75, 'MATLAB Partial Differential', 5, 1),
(1723, '2011-12-01', 75, 'MATLAB Global Optimization', 6, 1),
(1724, '2011-12-01', 75, 'MATLAB Statistics rootbox', 7, 1),
(1725, '2011-12-01', 75, 'MATLAB Neural Network Toolbox', 8, 1),
(1726, '2011-12-01', 75, 'MATLAB Curve Fitting Toolbox', 9, 1),
(1727, '2011-12-01', 75, 'MATLAB Image Proces Toolbox', 10, 1),
(1728, '2011-12-01', 75, 'MATLAB Vision System Toolbox', 11, 1),
(1729, '2011-12-01', 75, 'MATLAB Mapping toolbox', 12, 1),
(1730, '2011-12-01', 75, 'MATLAB Bioinformatics Toolbox', 13, 1),
(1731, '2011-12-01', 75, 'MATLAB Simbiology', 14, 1),
(1732, '2011-12-01', 75, 'MATLAB Compiler', 5, 1),
(1733, '2011-12-01', 75, 'MATLAB Spreadsheet link EX', 16, 1),
(1734, '2011-12-01', 75, 'MATLAB Builder NE', 17, 1),
(1735, '2011-12-01', 75, 'MATLAB Builder EX', 18, 1),
(1736, '2011-12-01', 75, 'MATLAB Huilder JA', 19, 1),
(1737, '2011-12-01', 75, 'MATLAB Database Toolbox', 20, 1),
(1738, '2011-12-01', 75, 'MATLAB Report Generator', 21, 1),
(1739, '2012-12-13', 75, 'Trimble Trim Pix Pro', 22, 2),
(1740, '2012-12-13', 75, 'Trimble Trim Pix pro', 23, 2),
(1741, '2012-12-13', 75, 'Software Trimble Terrasync Pro 45955-VG', 24, 2),
(1742, '2012-12-13', 75, 'GPS Correct Extention For esri ArPad 46837-VG', 25, 2),
(1743, '2012-12-13', 75, 'GPS Analyst Extention For esri ArcGis 52726-VG', 26, 2),
(1744, '2012-12-13', 75, 'GPS pathfinder Office Software 34191-VG', 27, 2),
(1745, '2012-12-13', 75, 'Dekstop GIS ESRI Advanced (Arcinfo)', 28, 1),
(1746, '2012-12-13', 75, 'GIS Analysis Extention ESRi ArcGis Schematcs', 29, 1),
(1747, '2012-12-13', 75, 'Extention Esri ArcGis Analyst Schematics', 30, 1),
(1748, '2012-12-13', 75, 'Produktivity ArcGis Data Interoperability', 31, 1),
(1749, '2012-12-13', 75, 'ArcGis Geostatistical Analyst', 32, 1),
(1750, '2012-12-13', 75, ' Extention ESRI ArcGIS Network Analyst', 33, 1),
(1751, '2012-12-13', 75, 'Extention ESRI ArcGIS Spatial Analyst', 34, 1),
(1752, '2012-12-13', 75, 'Extention ESRI ArcGIS Tracking Analyst', 35, 1),
(1753, '2012-12-13', 75, 'Mobile GIS ESRI ArcPad 10', 36, 1),
(1754, '2012-12-13', 75, 'GIS for Server ESRi ArcGis', 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_honor`
--

CREATE TABLE `detail_honor` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sk_honor` int(10) UNSIGNED DEFAULT NULL,
  `id_histori_besaran_honor` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam_barang`
--

CREATE TABLE `detail_pinjam_barang` (
  `idpinjam_barang_fk` int(10) UNSIGNED DEFAULT NULL,
  `iddetail_data_barang_fk` int(10) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `idsatuan_fk` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam_ruang`
--

CREATE TABLE `detail_pinjam_ruang` (
  `idpinjam_ruang_fk` int(10) UNSIGNED DEFAULT NULL,
  `idruang_fk` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_skripsi`
--

CREATE TABLE `detail_skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_inggris` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_sk_sempro` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_sk_skripsi` bigint(20) UNSIGNED DEFAULT NULL,
  `id_keris` int(10) UNSIGNED DEFAULT NULL,
  `id_skripsi` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_tugas`
--

CREATE TABLE `dosen_tugas` (
  `id` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `id_dosen` bigint(11) NOT NULL,
  `jabatan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen_tugas`
--

INSERT INTO `dosen_tugas` (`id`, `id_sk`, `id_dosen`, `jabatan`) VALUES
(4, 3, 196811131994121001, NULL),
(5, 4, 196906151997021002, 'Ketua'),
(6, 4, 196909281993021001, 'Anggota'),
(9, 6, 760018025, NULL),
(10, 6, 760018027, NULL),
(11, 7, 197004221995121001, NULL),
(12, 7, 197803302003121003, NULL),
(13, 8, 199011112019031018, NULL),
(14, 9, 196906151997021002, NULL),
(15, 9, 197004221995121001, NULL),
(16, 9, 760018025, NULL),
(18, 11, 196811131994121001, NULL),
(20, 13, 196909281993021001, NULL),
(22, 15, 196909281993021001, NULL),
(23, 16, 760017015, NULL),
(24, 16, 760018027, NULL),
(25, 16, 760018031, NULL),
(27, 14, 198110202014042001, NULL),
(28, 14, 198201012010121004, NULL),
(41, 29, 196906151997021002, NULL),
(42, 37, 196811131994121001, NULL),
(43, 37, 197004221995121001, NULL),
(44, 38, 196906151997021002, NULL),
(46, 39, 196906151997021002, NULL),
(58, 42, 196811131994121001, 'Ketua'),
(59, 42, 196909281993021001, 'Wakil'),
(62, 44, 196811131994121001, 'Admin'),
(63, 44, 197803302003121003, 'Cyber'),
(64, 60, 196811131994121001, NULL),
(66, 62, 199011112019031018, NULL),
(67, 61, 196909281993021001, 'Pembicara'),
(69, 63, 760018027, 'Admin'),
(75, 69, 760015717, NULL),
(76, 64, 760015717, 'Ada'),
(77, 65, 760015717, 'Anjay'),
(78, 66, 760015717, 'Waduuu'),
(79, 67, 760015717, 'Hahaha'),
(80, 68, 760015717, 'Adaaa'),
(82, 72, 197004221995121000, NULL),
(83, 73, 196906151997021000, NULL),
(84, 71, 197004221995121000, 'Ketua');

-- --------------------------------------------------------

--
-- Table structure for table `file_laporan`
--

CREATE TABLE `file_laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_laporan` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fungsional`
--

CREATE TABLE `fungsional` (
  `id` int(10) UNSIGNED NOT NULL,
  `jab_fungsional` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fungsional`
--

INSERT INTO `fungsional` (`id`, `jab_fungsional`) VALUES
(1, 'Guru Besar'),
(2, 'Lektor Kepala'),
(3, 'Lektor'),
(4, 'Asisten Ahli'),
(5, 'Tenaga Pengajar');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id` int(10) UNSIGNED NOT NULL,
  `golongan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id`, `golongan`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV');

-- --------------------------------------------------------

--
-- Table structure for table `histori_besaran_honor`
--

CREATE TABLE `histori_besaran_honor` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_nama_honor` int(10) UNSIGNED DEFAULT NULL,
  `jumlah_honor` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histori_besaran_honor`
--

INSERT INTO `histori_besaran_honor` (`id`, `id_nama_honor`, `jumlah_honor`, `created_at`, `updated_at`) VALUES
(1, 1, 400000, '2020-02-01 05:08:51', '2020-02-01 05:08:51'),
(2, 2, 300000, '2020-02-01 05:08:51', '2020-02-01 05:08:51'),
(3, 3, 300000, '2020-02-01 05:08:51', '2020-02-01 05:08:51'),
(4, 4, 200000, '2020-02-01 05:08:51', '2020-02-01 05:08:51'),
(5, 5, 50000, '2020-02-01 05:08:51', '2020-02-01 05:08:51'),
(6, 6, 100000, '2020-02-01 05:08:51', '2020-02-01 05:08:51'),
(7, 7, 100000, '2020-02-01 05:08:51', '2020-02-01 05:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `jabatan` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`) VALUES
(1, 'Dekan'),
(2, 'Wakil Dekan 1'),
(3, 'Wakil Dekan 2'),
(4, 'Dosen'),
(5, 'KTU'),
(6, 'BPP'),
(7, 'Pengadministrasi Akademik'),
(8, 'PPABP'),
(9, 'Pengadministrasi Kemahasiswaan & Alumni'),
(10, 'Penata Dokumen Keuangan'),
(11, 'Pemroses Mutasi Kepegawaian'),
(12, 'Pengadministrasi Akademik'),
(13, 'Pengelola Data Akademik'),
(14, 'Pengadministrasi Layanan Kegiatan Mahasiswa'),
(15, 'Teknisi Komputer dan Operator Web'),
(16, 'Teknisi Komputer dan Operator SIMAK BMN'),
(17, 'Pengadministrasi BMN'),
(18, 'Sekretaris Pimpinan'),
(19, 'Pengadministrasi Persuratan dan Operator SIMAK Persediaan'),
(20, 'Pengemudi'),
(21, 'Teknisi Sarana dan Prasarana Kantor'),
(22, 'Caraka dan Pramu Kantor');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kendaraan`
--

CREATE TABLE `jenis_kendaraan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kendaraan`
--

INSERT INTO `jenis_kendaraan` (`id`, `nama`) VALUES
(1, 'Kendaraan Umum'),
(2, 'Kendaraan Pribadi'),
(3, 'Kendaraan Dinas');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laporan`
--

CREATE TABLE `jenis_laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sk`
--

CREATE TABLE `jenis_sk` (
  `id` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_sk`
--

INSERT INTO `jenis_sk` (`id`, `jenis`) VALUES
(1, 'Peserta Acara'),
(2, 'Panitia Kegiatan'),
(3, 'Pemateri');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keris`
--

CREATE TABLE `keris` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keris`
--

INSERT INTO `keris` (`id`, `nama`) VALUES
(1, 'DBI'),
(2, 'ADS'),
(3, 'Network & Security'),
(4, 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jenis` int(10) UNSIGNED DEFAULT NULL,
  `id_user` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pengadaan`
--

CREATE TABLE `laporan_pengadaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verif_wadek2` tinyint(1) NOT NULL DEFAULT 0,
  `pesan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bagian` int(10) UNSIGNED DEFAULT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_10_06_035214_create_bagian_table', 1),
(4, '2019_10_06_040125_create_fungsional_table', 1),
(5, '2019_10_06_040315_create_golongan_table', 1),
(6, '2019_10_06_040515_create_jabatan_table', 1),
(7, '2019_10_06_040702_create_pangkat_table', 1),
(8, '2019_10_06_040852_create_jenis_laporan_table', 1),
(9, '2019_10_06_041007_create_laporan_table', 1),
(10, '2019_10_06_042302_create_file_laporan_table', 1),
(11, '2019_10_06_043610_add_foreign_keys_to_users_table', 1),
(12, '2019_10_24_181246_kategori_barang', 1),
(13, '2019_10_24_182153_detail_barang', 1),
(14, '2019_10_30_145744_create_keris_table', 1),
(15, '2019_10_30_154500_create_status_sk_table', 1),
(16, '2019_10_30_155123_create_sk_sempro_table', 1),
(17, '2019_10_30_160005_create_mahasiswa_table', 1),
(18, '2019_10_30_162304_create_sk_skripsi_table', 1),
(19, '2019_10_30_170525_create_tipe_surat_tugas', 1),
(20, '2019_10_30_172000_create_surat_tugas_table', 1),
(21, '2019_10_30_200907_create_nama_honor_table', 1),
(22, '2019_10_30_201142_create_histori_besaran_honor_table', 1),
(23, '2019_10_30_202149_create_status_sk_honor_table', 1),
(24, '2019_10_30_202520_create_sk_honor_table', 1),
(25, '2019_10_30_205205_create_detail_skripsi_table', 1),
(26, '2019_10_31_112838_create_status_surat_tugas_table', 1),
(27, '2019_10_31_113533_add_foreign_keys_to_surat_tugas_table', 1),
(28, '2019_11_01_060357_laporan_pengadaan', 1),
(29, '2019_11_01_064308_create_satuans_table', 1),
(30, '2019_11_06_205009_create_status_skripsi_table', 1),
(31, '2019_11_06_210030_create_skripsi_table', 1),
(32, '2019_11_06_211250_add_foreign_keys_to_detail_skripsi_table', 1),
(33, '2019_11_10_030132_status_barang', 1),
(34, '2019_11_14_113856_create_nama_template_table', 1),
(35, '2019_11_14_115049_create_template_table', 1),
(36, '2019_11_14_131023_add_foreign_keys_to_sk_sempro_table', 1),
(37, '2019_11_14_131122_add_foreign_keys_to_sk_skripsi_table', 1),
(38, '2019_11_14_132358_create_detail_honor_table', 1),
(39, '2019_11_17_143239_create_data_ruang', 1),
(40, '2019_11_17_150700_create_data_barang', 1),
(41, '2019_11_18_121652_create_detail_data_barang', 1),
(42, '2019_11_19_110448_create_pinjam_barang', 1),
(43, '2019_11_19_110545_create_pinjam_ruang', 1),
(44, '2019_11_24_182306_pengadaan', 1),
(45, '2019_12_25_112759_create_detail_pinjam_barang', 1),
(46, '2019_12_25_112835_create_detail_pinjam_ruang', 1),
(47, '2020_01_17_131011_create_pph_table', 1),
(48, '2020_01_17_131918_add_foreign_keys_pph_to_users_table', 1),
(49, '2020_01_20_131822_create_notifications_table', 1),
(50, '2020_01_31_134025_add_foreign_key_ruang_to_surat_tugas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nama_honor`
--

CREATE TABLE `nama_honor` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_honor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nama_honor`
--

INSERT INTO `nama_honor` (`id`, `nama_honor`) VALUES
(1, 'Honor Pembimbing Utama Dengan Jabatan Fungsional'),
(2, 'Honor Pembimbing Utama Tanpa Jabatan Fungsional'),
(3, 'Honor Pembimbing Pendamping Dengan Jabatan Fungsional'),
(4, 'Honor Pembimbing Pendamping Tanpa Jabatan Fungsional'),
(5, 'Honor Pembahas Sempro'),
(6, 'Honor Penguji Utama Skripsi'),
(7, 'Honor Penguji Pendamping Skripsi');

-- --------------------------------------------------------

--
-- Table structure for table `nama_template`
--

CREATE TABLE `nama_template` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nama_template`
--

INSERT INTO `nama_template` (`id`, `nama`) VALUES
(1, 'SK Sempro'),
(2, 'SK Pembimbing Skripsi'),
(3, 'SK Penguji Skripsi');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `id` int(10) UNSIGNED NOT NULL,
  `pangkat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id`, `pangkat`) VALUES
(1, 'Pembina TK.I'),
(2, 'Pembina Utama Muda'),
(3, 'Penata'),
(4, 'Pembina Utama Madya'),
(5, 'Penata TK.I'),
(6, 'Penata Muda TK.I'),
(7, 'Penata Muda'),
(8, 'Tenaga Kontrak'),
(9, 'Penata TK I'),
(10, 'Pengatur'),
(11, 'Pengatur TK.I ');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemateri`
--

CREATE TABLE `pemateri` (
  `id` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemateri`
--

INSERT INTO `pemateri` (`id`, `id_sk`, `nama`, `instansi`, `biaya`) VALUES
(1, 32, 'Nanang Hermansyah', 'Telkom', 900000),
(3, 34, 'Jeriko', 'UNEJ', 500000),
(4, 35, 'Swastiaski Rahmi', 'UNEJ', 400000),
(13, 36, 'Dhais Firmansyah', 'UNEJ', 230000),
(14, 36, 'Entertaint', 'UNEJ', 800000),
(15, 43, 'Wahib Irawan', 'Kodekoding', 1000000),
(16, 43, 'Dhais Firmansyah', 'Kodekoding', 200000),
(17, 45, 'Erik Wijayanto', 'Matata Software', NULL),
(22, 47, 'G', 'Komunitas Linux Jember', NULL),
(25, 49, 'Budi', 'Dot', NULL),
(26, 49, 'Andi', 'Dot', NULL),
(27, 50, 'PPPPP', 'PPQQ', NULL),
(28, 50, 'QQQQ', 'PPQQ', NULL),
(33, 51, 'Wiwi', 'Indo', NULL),
(34, 52, 'Boy', 'Hadirkan', NULL),
(43, 57, 'Jeriko', 'Dot', 9999999),
(44, 57, 'Erika', 'Dot', 9999999),
(45, 58, 'Jeriko', 'Dot', 88888),
(46, 58, 'Erika', 'Dot', 88888),
(47, 59, 'Jeriko', 'Dot', NULL),
(48, 59, 'Erika', 'Dot', NULL),
(49, 53, 'Jeriko', 'Dot', NULL),
(50, 75, 'Samsul Ma\'rifat', 'Dot Indonesia', NULL),
(51, 76, 'Ruri Masihan', 'Dot Indonesia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_acara`
--

CREATE TABLE `pendaftaran_acara` (
  `id` int(11) NOT NULL,
  `acara` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran_acara`
--

INSERT INTO `pendaftaran_acara` (`id`, `acara`) VALUES
(1, 'ya'),
(2, 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_satuan` int(10) UNSIGNED DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `id_laporan` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perjalanan`
--

CREATE TABLE `perjalanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perjalanan`
--

INSERT INTO `perjalanan` (`id`, `nama`) VALUES
(1, 'ya'),
(2, 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_barang`
--

CREATE TABLE `pinjam_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_berakhir` time NOT NULL,
  `kegiatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verif_baper` tinyint(1) NOT NULL DEFAULT 0,
  `verif_ktu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_ruang`
--

CREATE TABLE `pinjam_ruang` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_berakhir` time NOT NULL,
  `kegiatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `verif_baper` tinyint(1) NOT NULL DEFAULT 0,
  `verif_ktu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pph`
--

CREATE TABLE `pph` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `pph` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pph`
--

INSERT INTO `pph` (`id`, `pph`) VALUES
(1, 0.00),
(2, 5.00),
(3, 15.00);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`) VALUES
(1, 'Sistem Informasi'),
(2, 'Teknologi Informasi'),
(3, 'Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`) VALUES
(1, 'Buah'),
(2, 'Lusin'),
(3, 'Kodi'),
(4, 'Gross'),
(5, 'Rim');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE `skripsi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_status_skripsi` int(10) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_honor`
--

CREATE TABLE `sk_honor` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_status_sk_honor` smallint(5) UNSIGNED DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_sempro`
--

CREATE TABLE `sk_sempro` (
  `no_surat` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_status_sk` smallint(5) UNSIGNED DEFAULT NULL,
  `tgl_sempro1` date DEFAULT NULL,
  `tgl_sempro2` date DEFAULT NULL,
  `verif_ktu` tinyint(4) DEFAULT NULL,
  `pesan_revisi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_template` int(10) UNSIGNED DEFAULT NULL,
  `id_sk_honor` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_skripsi`
--

CREATE TABLE `sk_skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_surat_penguji` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat_pembimbing` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_status_sk` smallint(5) UNSIGNED DEFAULT NULL,
  `tgl_sk_pembimbing` date DEFAULT NULL,
  `tgl_sk_penguji` date DEFAULT NULL,
  `verif_ktu` tinyint(4) DEFAULT NULL,
  `pesan_revisi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_template_penguji` int(10) UNSIGNED DEFAULT NULL,
  `id_template_pembimbing` int(10) UNSIGNED DEFAULT NULL,
  `id_sk_honor` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spd`
--

CREATE TABLE `spd` (
  `id_spd` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `id_jenis_kendaraan` int(11) NOT NULL,
  `asal` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `uang_harian` int(11) NOT NULL,
  `id_penginapan` int(11) NOT NULL,
  `biaya_penginapan` int(11) DEFAULT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `biaya_pendaftaran_acara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spd`
--

INSERT INTO `spd` (`id_spd`, `id_sk`, `id_jenis_kendaraan`, `asal`, `tujuan`, `uang_harian`, `id_penginapan`, `biaya_penginapan`, `id_pendaftaran`, `biaya_pendaftaran_acara`) VALUES
(1, 4, 1, 'Jember', 'Jakarta', 300000, 1, 300000, 2, NULL),
(3, 3, 1, 'Jember', 'Wuhan China', 250000, 1, 200000, 2, NULL),
(4, 42, 2, 'Jember', 'Wuhan China', 150000, 2, NULL, 2, NULL),
(5, 60, 1, 'Jember', 'Bandung', 200000, 1, NULL, 1, 100000),
(6, 61, 2, 'Jember', 'Surabaya', 100000, 1, NULL, 2, NULL),
(7, 62, 2, 'Jember', 'Lumajang', 70000, 1, NULL, 2, NULL),
(8, 63, 1, 'Jember', 'Malang', 200000, 1, NULL, 2, NULL),
(9, 64, 2, 'Jember', 'Anjay', 10000, 1, NULL, 2, NULL),
(10, 65, 2, 'Wwww', 'Wwww', 100000, 1, NULL, 2, NULL),
(11, 66, 2, 'Ajur', 'Ora', 100000, 1, NULL, 1, 10000),
(12, 67, 2, 'Hahaha', 'Hehehe', 190000, 1, NULL, 1, 1000000),
(13, 68, 2, 'Werrrr', 'Weeeer', 1300000, 1, 90000, 1, 90000),
(14, 71, 2, 'Jember', 'Solo', 100000, 1, 50000, 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `status_barang`
--

CREATE TABLE `status_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_barang`
--

INSERT INTO `status_barang` (`id`, `status`) VALUES
(1, 'Tetap (tidak mungkin dipinjam)'),
(2, 'Bergerak (mungkin dipinjam)');

-- --------------------------------------------------------

--
-- Table structure for table `status_sk`
--

CREATE TABLE `status_sk` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_sk`
--

INSERT INTO `status_sk` (`id`, `status`) VALUES
(1, 'Draft'),
(2, 'Dikirim'),
(3, 'Disetujui KTU');

-- --------------------------------------------------------

--
-- Table structure for table `status_skripsi`
--

CREATE TABLE `status_skripsi` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_skripsi`
--

INSERT INTO `status_skripsi` (`id`, `status`) VALUES
(1, 'Belum Punya Pembimbing'),
(2, 'Sudah Punya Pembimbing'),
(3, 'Sudah Punya Pembahas'),
(4, 'Sudah Sempro'),
(5, 'Sudah Punya Penguji'),
(6, 'Sudah Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `status_sk_honor`
--

CREATE TABLE `status_sk_honor` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_sk_honor`
--

INSERT INTO `status_sk_honor` (`id`, `status`) VALUES
(1, 'Draft'),
(2, 'Telah Dibayarkan');

-- --------------------------------------------------------

--
-- Table structure for table `status_surat`
--

CREATE TABLE `status_surat` (
  `id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_surat`
--

INSERT INTO `status_surat` (`id`, `status`) VALUES
(1, 'Memu'),
(2, 'Memu Disetujui KTU'),
(3, 'Menunggu Verifikasi'),
(4, 'Revisi dari KTU'),
(5, 'Surat Tugas Disetujui KTU'),
(6, 'Revisi dari Staff Pimpinan'),
(7, 'Disetujui oleh Staff Pimpinan'),
(8, 'Disetujui Wakil Dekan 2'),
(9, 'Dana Dicairkan'),
(10, 'Dosen Selesai Upload SPD'),
(11, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `status_surat_tugas`
--

CREATE TABLE `status_surat_tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_surat_tugas`
--

INSERT INTO `status_surat_tugas` (`id`, `status`) VALUES
(1, 'Draft'),
(2, 'Dikirim'),
(3, 'Disetujui KTU');

-- --------------------------------------------------------

--
-- Table structure for table `surat_in_out`
--

CREATE TABLE `surat_in_out` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_in_out`
--

INSERT INTO `surat_in_out` (`id`, `nama`) VALUES
(1, 'eksternal'),
(2, 'internal');

-- --------------------------------------------------------

--
-- Table structure for table `surat_kepegawaian`
--

CREATE TABLE `surat_kepegawaian` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(30) DEFAULT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `started_at` date NOT NULL,
  `end_at` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `revisi` varchar(100) DEFAULT NULL,
  `surat_in_out` int(11) DEFAULT NULL,
  `perjalanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_kepegawaian`
--

INSERT INTO `surat_kepegawaian` (`id`, `nomor_surat`, `jenis_surat`, `keterangan`, `started_at`, `end_at`, `status`, `revisi`, `surat_in_out`, `perjalanan`) VALUES
(71, '121313', '2', 'Panitia Fasilkom Goes to Campus', '2020-01-30', '2020-01-31', 11, NULL, 1, 1),
(72, NULL, '2', 'Panitia 17 Agustus', '2020-01-30', '2020-01-31', 2, NULL, 1, 1),
(73, NULL, '2', 'Hahaha', '2020-01-31', '2020-01-31', 2, NULL, 1, 1),
(75, NULL, '3', 'Pelatihan Linux Fasilkom', '2020-01-30', '2020-01-31', 2, NULL, 2, 2),
(76, NULL, '3', 'Pelatihan Memancing', '2020-01-31', '2020-01-31', 1, NULL, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tipe_surat_tugas` int(10) UNSIGNED DEFAULT NULL,
  `id_status_surat_tugas` int(10) UNSIGNED DEFAULT NULL,
  `no_surat` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verif_ktu` tinyint(4) NOT NULL DEFAULT 0,
  `id_dosen1` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_dosen2` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_detail_skripsi` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `id_ruang` int(10) UNSIGNED DEFAULT NULL,
  `pesan_revisi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_nama_template` int(10) UNSIGNED DEFAULT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `id_nama_template`, `isi`, `created_at`, `updated_at`) VALUES
(1, 1, '<p style=\"text-align:center\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>DEKAN FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</strong></span></p>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n							<tbody>\r\n								<tr>\r\n									<td style=\"text-align:justify; vertical-align:top; width:130px\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>MENIMBANG&nbsp;&nbsp;&nbsp;&nbsp;</strong>:</span></td>\r\n									<td style=\"text-align:justify; vertical-align:top; width:30px\"><span style=\"font-family:Times New Roman,Times,serif\">a.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa dalam penyelenggaraan Pendidikan dan Pengajaran di Fakultas Ilmu Komputer Universitas Jember, diwajibkan bagi mahasiswa untuk menempuh dan menyelesaikan Skripsi sebagai persyaratan akhir untuk memperoleh Gelar Sarjana Komputer (S.Kom);</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">b.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa untuk maksud sebagaimana tersebut diatas, perlu diadakan seminar proposal dan diperlukan Tim Pembahas Seminar Proposal Skripsi Mahasiswa Fakultas Ilmu Komputer Universitas Jember;</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">c.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa sehubungan dengan maksud pada diktum a dan b di atas, dipandang perlu diterbitkan Keputusan Dekan Fakultas Ilmu Komputer Universitas Jember untuk penetapan Tim Pembahas Seminar Proposal Skripsi Mahsiswa.</span></td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n\r\n						<div style=\"text-align:justify\">&nbsp;</div>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n							<tbody>\r\n								<tr>\r\n									<td style=\"text-align:justify; vertical-align:top; width:130px\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>MENGINGAT&nbsp;&nbsp;&nbsp;&nbsp;</strong>:</span></td>\r\n									<td style=\"text-align:justify; vertical-align:top; width:30px\"><span style=\"font-family:Times New Roman,Times,serif\">1.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Undang-Undang Nomor: 20 tahun 2003 tanggal 8 Juli 2003 tentang Sistem Pendidikan Nasional;</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">2.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Undang-Undang Republik Indonesia Nomor : 12 tahun 2012 tanggal 10 Agustus 2012 tentang Pendidikan Tinggi;</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">3.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri PTIP Nomor: 151/1964 tanggal 9 Nopember 1964 tentang Pendirian Universitas Jember;</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">4.</span></td>\r\n									<td>\r\n									<div style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Mendikbud RI :</span></div>\r\n\r\n									<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n										<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 0235/P/1982 tanggal 12 Juli 1982 tentang Pendelegasian wewenang di lingkungan Depdikbud RI.</span></li>\r\n										<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 0175/O/1995&nbsp; tanggal&nbsp; 18&nbsp; Juli&nbsp; 1995&nbsp; Jo&nbsp; Nomor: 275/O/1999 tanggal&nbsp; 14 Oktober 1999&nbsp; tentang&nbsp;&nbsp; perubahan&nbsp; atas&nbsp; Keputusan&nbsp; Mendikbud Nomor: 0175/O/1995&nbsp; tentang&nbsp; Organisasi&nbsp; dan&nbsp; Tata&nbsp; Kerja&nbsp; Universitas Jember.</span></li>\r\n									</ol>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">5.</span></td>\r\n									<td>\r\n									<div style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri Pendidikan Nasional RI :</span></div>\r\n\r\n									<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n										<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 232/U/2000 tanggal 20 Desember 2000 tentang Pedoman Penyusunan Kurikulum Pendidikan Tinggi dan Penilaian Hasil Belajar Mahasiswa;</span></li>\r\n										<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 183/O/2002&nbsp; tanggal 21 Oktober 2002 tentang Statuta Universitas Jember;</span></li>\r\n									</ol>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">6.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri Riset, Teknologi, dan Pendidikan Tinggi Republik Indonesia Nomor 02/M/KPT/2016 Tanggal 25 Januari 2016 Tentang Pemberhentian dan Pengangkatan Rektor Universitas Jember Masa Jabatan 2016-2020;</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">7.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen DIKTI nomor : 140/D/T/2009 tanggal 6 Februari 2009, tentang Penyelenggaraan Program Studi Sistem Infromasi &nbsp;Universitas Jember;</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">8.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen DIKTI nomor : 6303/D/T/K-N/2011 &nbsp;Perihal Perpanjangan Ijin Program Studi Sistem Informasi Jenjang S-1 di Universitas Jember;</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">9.</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen. DIKTI Nomor : 88 Tahun 2017 bulan Desember 2017 Tentang Organisasi dan Tata Kerja Universitas Jember;</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify\">&nbsp;</td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">10.</span></td>\r\n									<td>\r\n									<div style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen. DIKTI Nomor : 88 Tahun 2017 bulan Desember 2017 Tentang Organisasi dan Tata Kerja Universitas Jember:</span></div>\r\n\r\n									<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n										<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 810/UN25/KR/2018 tanggal 16 Januari 2018 tentang SK Pengangkatan Dekan Fakultas Ilmu Komputer Universitas Jember</span></li>\r\n										<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 5035/UN25/KP/2019 tanggal 26 Maret 2019 tentang Pengangkatan Wakil Dekan Fakultas Ilmu Komputer Universitas Jember;</span></li>\r\n										<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 5013/UN.25/KR/2019, tanggal 26 Maret 2019 tentang Kalender Akademik Tahun Akademik 2019/2020 Universitas Jember.</span></li>\r\n									</ol>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n\r\n						<p style=\"text-align:center\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>MEMUTUSKAN</strong></span></p>\r\n\r\n						<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>Menetapkan :</strong></span></p>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n							<tbody>\r\n								<tr>\r\n									<td style=\"text-align:justify; vertical-align:top; width:100px\"><span style=\"font-family:Times New Roman,Times,serif\">Pertama</span></td>\r\n									<td style=\"text-align:justify; vertical-align:top; width:15px\"><span style=\"font-family:Times New Roman,Times,serif\">:</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Mengangkat dan menugaskan kepada staf pengajar yang namanya tersebut dalam Lampiran Keputusan ini sebagai Tim Pembahas Seminar Proposal Skripsi Mahasiswa Fakultas Ilmu Komputer Universitas Jember Tahun Akademik 2019/2020.</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">Kedua</span></td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">:</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Tim Pembahas Seminar Proposal Skripsi Mahasiswa Fakultas Ilmu Komputer Tahun Akademik 2019/2020 Universitas Jember berkewajiban memberikan penilaian terhadap beberapa aspek yang diuji pada Seminar Proposal Skripsi Mahasiswa sesuai dengan ketentuan yang berlaku.</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">Ketiga</span></td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">:</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Biaya Penyelenggaraan Ujian Seminar Proposal Skripsi mahasiswa ini dibebankan pada DIPA PNBP Fakultas Ilmu Komputer Universitas Jember Tahun 2019.</span></td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">Keempat</span></td>\r\n									<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">:</span></td>\r\n									<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan ini berlaku sejak tanggal ditetapkan dengan ketentuan apabila dikemudian hari ternyata terdapat kekeliruan dalam penetapan ini akan diubah dan diperbaiki sebagaimana mestinya.</span></td>\r\n								</tr>\r\n							</tbody>\r\n						</table>', NULL, NULL),
(2, 2, '<p style=\"text-align:center\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>DEKAN FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</strong></span></p>\r\n\r\n					<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n						<tbody>\r\n							<tr>\r\n								<td style=\"text-align:justify; vertical-align:top; width:130px\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>MENIMBANG&nbsp;&nbsp;&nbsp;&nbsp;</strong>:</span></td>\r\n								<td style=\"text-align:justify; vertical-align:top; width:30px\"><span style=\"font-family:Times New Roman,Times,serif\">a.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa dalam penyelenggaraan Pendidikan dan Pengajaran di Fakultas Ilmu Komputer Universitas Jember, diwajibkan bagi mahasiswa untuk menyusun karya ilmiah tertulis sebagai laporan pelaksanaan Skripsi;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">b.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa untuk maksud sebagaimana tersebut di atas, perlu Dosen Pembimbing Utama (DPU) dan Dosen Pembimbing Anggota (DPA);</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">c.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa sehubungan dengan maksud pada diktum a dan b di atas, dipandang perlu diterbitkan Keputusan Dekan Fakultas Ilmu Komputer Universitas Jember untuk penetapannya.</span></td>\r\n							</tr>\r\n						</tbody>\r\n					</table>\r\n\r\n					<div style=\"text-align:justify\">&nbsp;\r\n					<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n						<tbody>\r\n							<tr>\r\n								<td style=\"text-align:justify; vertical-align:top; width:130px\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>MENGINGAT&nbsp;&nbsp;&nbsp;&nbsp;</strong>:</span></td>\r\n								<td style=\"text-align:justify; vertical-align:top; width:30px\">1.</td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Undang-Undang Nomor: 20 tahun 2003 tanggal 8 Juli 2003 tentang Sistem Pendidikan Nasional;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">2.</td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Undang-Undang Republik Indonesia Nomor : 12 tahun 2012 tanggal 10 Agustus 2012 tentang Pendidikan Tinggi;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">3.</td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri PTIP Nomor: 151/1964 tanggal 9 Nopember 1964 tentang Pendirian Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">4.</td>\r\n								<td style=\"text-align:justify\">\r\n								<div style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Mendikbud RI:</span></div>\r\n\r\n								<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n									<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 0235/P/1982 tanggal 12 Juli 1982 tentang Pendelegasian wewenang di lingkungan Depdikbud RI.</span></li>\r\n									<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 0175/O/1995&nbsp; tanggal&nbsp; 18&nbsp; Juli&nbsp; 1995&nbsp; Jo&nbsp; Nomor: 275/O/1999 tanggal&nbsp; 14 Oktober 1999&nbsp; tentang&nbsp;&nbsp; perubahan&nbsp; atas&nbsp; Keputusan&nbsp; Mendikbud Nomor: 0175/O/1995&nbsp; tentang&nbsp; Organisasi&nbsp; dan&nbsp; Tata&nbsp; Kerja&nbsp; Universitas Jember.</span></li>\r\n								</ol>\r\n								</td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">5..</td>\r\n								<td style=\"text-align:justify\">\r\n								<div style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri Pendidikan Nasional RI :</span></div>\r\n\r\n								<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n									<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 232/U/2000 tanggal 20 Desember 2000 tentang Pedoman Penyusunan Kurikulum Pendidikan Tinggi dan Penilaian Hasil Belajar Mahasiswa;</span></li>\r\n									<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 183/O/2002&nbsp; tanggal 21 Oktober 2002 tentang Statuta Universitas Jember;</span></li>\r\n								</ol>\r\n								</td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">6.</td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri Riset, Teknologi, dan Pendidikan Tinggi Republik Indonesia Nomor 02/M/KPT/2016 Tanggal 25 Januari 2016 Tentang Pemberhentian dan Pengangkatan Rektor Universitas Jember Masa Jabatan 2016-2020;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">7.</td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen DIKTI nomor : 140/D/T/2009 tanggal 6 Februari 2009, tentang Penyelenggaraan Program Studi Sistem Infromasi &nbsp;Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">8.</td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen DIKTI nomor : 6303/D/T/K-N/2011 &nbsp;Perihal Perpanjangan Ijin Program Studi Sistem Informasi Jenjang S-1 di Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">9.</td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen. DIKTI Nomor : 88 Tahun 2017 bulan Desember 2017 Tentang Organisasi dan Tata Kerja Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td>&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\">10.</td>\r\n								<td style=\"text-align:justify\">\r\n								<div style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen. DIKTI Nomor : 88 Tahun 2017 bulan Desember 2017 Tentang Organisasi dan Tata Kerja Universitas Jember:</span></div>\r\n\r\n								<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n									<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 810/UN25/KR/2018 tanggal 16 Januari 2018 tentang SK Pengangkatan Dekan Fakultas Ilmu Komputer Universitas Jember</span></li>\r\n									<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 5035/UN25/KP/2019 tanggal 26 Maret 2019 tentang Pengangkatan Wakil Dekan Fakultas Ilmu Komputer Universitas Jember;</span></li>\r\n									<li style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 5013/UN.25/KR/2019, tanggal 26 Maret 2019 tentang Kalender Akademik Tahun Akademik 2019/2020 Universitas Jember.</span></li>\r\n								</ol>\r\n								</td>\r\n							</tr>\r\n						</tbody>\r\n					</table>\r\n					</div>\r\n\r\n					<p style=\"text-align:center\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>MEMUTUSKAN</strong></span></p>\r\n\r\n					<p style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Menetapkan :</span></p>\r\n\r\n					<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" style=\"width:100%\">\r\n						<tbody>\r\n							<tr>\r\n								<td style=\"text-align:justify; vertical-align:top; width:100px\"><span style=\"font-family:Times New Roman,Times,serif\">Pertama</span></td>\r\n								<td style=\"text-align:justify; vertical-align:top; width:15px\"><span style=\"font-family:Times New Roman,Times,serif\">:</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Mengangkat dan menugaskan kepada staf pengajar yang namanya tersebut dalam Lampiran Keputusan ini sebagai Dosen Pembimbing Skripsi Mahasiswa Fakultas Ilmu Komputer Universitas Jember Tahun Akademik 2019/2020</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">Kedua</span></td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">:</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Dosen Pembimbing Skripsi Mahasiswa Fakultas Ilmu Komputer Universitas Jember berkewajiban memberikan arahan arahan dalam penyiapan Proposal Skripsi, sampai dengan mahasiswa siap untuk melaksanakan ujian sesuai dengan ketentuan yang berlaku.</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">Ketiga</span></td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">:</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Biaya Penyelenggaraan Pembimbingan Skripsi mahasiswa ini dibebankan pada DIPA PNBP Fakultas Ilmu Komputer Universitas Jember.</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">Keempat</span></td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">:</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan ini berlaku sejak tanggal ditetapkan dengan ketentuan apabila dikemudian hari ternyata terdapat kekeliruan dalam penetapan ini akan diubah dan diperbaiki sebagaimana mestinya.</span></td>\r\n							</tr>\r\n						</tbody>\r\n					</table>', NULL, NULL),
(3, 3, '<p style=\"text-align: center;\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>DEKAN FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</strong></span></p>\r\n\r\n					<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n						<tbody>\r\n							<tr>\r\n								<td style=\"text-align:justify; vertical-align:top; width:130px\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>MENIMBANG&nbsp;&nbsp;&nbsp;&nbsp;</strong>:</span></td>\r\n								<td style=\"text-align:justify; vertical-align:top; width:30px\"><span style=\"font-family:Times New Roman,Times,serif\">a.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa dalam penyelenggaraan Pendidikan dan Pengajaran di Fakultas Ilmu Komputer Universitas Jember, diwajibkan bagi mahasiswa untuk menempuh dan menyelesaikan Skripsi sebagai persyaratan akhir untuk memperoleh Gelar Sarjana Komputer (S.Kom);</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">b.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa untuk maksud sebagaimana tersebut diatas, perlu ditetapkan Tim Penguji Skripsi Mahasiswa Fakultas Ilmu Komputer Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">c.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">bahwa sehubungan dengan maksud pada diktum a dan b di atas, dipandang perlu diterbitkan Keputusan Dekan Fakultas Ilmu Komputer Universitas Jember untuk penetapannya.</span></td>\r\n							</tr>\r\n						</tbody>\r\n					</table>\r\n\r\n					<div style=\"text-align: justify;\">&nbsp;</div>\r\n\r\n					<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n						<tbody>\r\n							<tr>\r\n								<td style=\"text-align:justify; vertical-align:top; width:130px\"><span style=\"font-family:Times New Roman,Times,serif\"><strong>MENGINGAT&nbsp;&nbsp;&nbsp;&nbsp;</strong>:</span></td>\r\n								<td style=\"text-align:justify; vertical-align:top; width:30px\"><span style=\"font-family:Times New Roman,Times,serif\">1.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Undang-Undang Nomor: 20 tahun 2003 tanggal 8 Juli 2003 tentang Sistem Pendidikan Nasional;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">2.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Undang-Undang Republik Indonesia Nomor : 12 tahun 2012 tanggal 10 Agustus 2012 tentang Pendidikan Tinggi;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">3.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri PTIP Nomor: 151/1964 tanggal 9 Nopember 1964 tentang Pendirian Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">4.</span></td>\r\n								<td>\r\n								<div style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Mendikbud RI :</span></div>\r\n\r\n								<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n									<li style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 0235/P/1982 tanggal 12 Juli 1982 tentang Pendelegasian wewenang di lingkungan Depdikbud RI.</span></li>\r\n									<li style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 0175/O/1995&nbsp; tanggal&nbsp; 18&nbsp; Juli&nbsp; 1995&nbsp; Jo&nbsp; Nomor: 275/O/1999 tanggal&nbsp; 14 Oktober 1999&nbsp; tentang&nbsp;&nbsp; perubahan&nbsp; atas&nbsp; Keputusan&nbsp; Mendikbud Nomor: 0175/O/1995&nbsp; tentang&nbsp; Organisasi&nbsp; dan&nbsp; Tata&nbsp; Kerja&nbsp; Universitas Jember.</span></li>\r\n								</ol>\r\n								</td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">5.</span></td>\r\n								<td>\r\n								<div style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri Pendidikan Nasional RI :</span></div>\r\n\r\n								<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n									<li style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 232/U/2000 tanggal 20 Desember 2000 tentang Pedoman Penyusunan Kurikulum Pendidikan Tinggi dan Penilaian Hasil Belajar Mahasiswa;</span></li>\r\n									<li style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor: 183/O/2002&nbsp; tanggal 21 Oktober 2002 tentang Statuta Universitas Jember;</span></li>\r\n								</ol>\r\n								</td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">6.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Menteri Riset, Teknologi, dan Pendidikan Tinggi Republik Indonesia Nomor 02/M/KPT/2016 Tanggal 25 Januari 2016 Tentang Pemberhentian dan Pengangkatan Rektor Universitas Jember Masa Jabatan 2016-2020;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">7.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen DIKTI nomor : 140/D/T/2009 tanggal 6 Februari 2009, tentang Penyelenggaraan Program Studi Sistem Infromasi &nbsp;Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">8.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen DIKTI nomor : 6303/D/T/K-N/2011 &nbsp;Perihal Perpanjangan Ijin Program Studi Sistem Informasi Jenjang S-1 di Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">9.</span></td>\r\n								<td style=\"text-align:justify\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen. DIKTI Nomor : 88 Tahun 2017 bulan Desember 2017 Tentang Organisasi dan Tata Kerja Universitas Jember;</span></td>\r\n							</tr>\r\n							<tr>\r\n								<td style=\"text-align:justify\">&nbsp;</td>\r\n								<td style=\"text-align:justify; vertical-align:top\"><span style=\"font-family:Times New Roman,Times,serif\">10.</span></td>\r\n								<td>\r\n								<div style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Keputusan Dirjen. DIKTI Nomor : 88 Tahun 2017 bulan Desember 2017 Tentang Organisasi dan Tata Kerja Universitas Jember:</span></div>\r\n\r\n								<ol start=\"1\" style=\"list-style-type:lower-alpha\">\r\n									<li style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 810/UN25/KR/2018 tanggal 16 Januari 2018 tentang SK Pengangkatan Dekan Fakultas Ilmu Komputer Universitas Jember</span></li>\r\n									<li style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 5035/UN25/KP/2019 tanggal 26 Maret 2019 tentang Pengangkatan Wakil Dekan Fakultas Ilmu Komputer Universitas Jember;</span></li>\r\n									<li style=\"text-align: justify;\"><span style=\"font-family:Times New Roman,Times,serif\">Nomor : 5013/UN.25/KR/2019, tanggal 26 Maret 2019 tentang Kalender Akademik Tahun Akademik 2019/2020 Universitas Jember.</span></li>\r\n								</ol>\r\n								</td>\r\n							</tr>\r\n						</tbody>\r\n					</table>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_surat_tugas`
--

CREATE TABLE `tipe_surat_tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipe_surat` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipe_surat_tugas`
--

INSERT INTO `tipe_surat_tugas` (`id`, `tipe_surat`) VALUES
(1, 'Surat Tugas Pembimbing'),
(2, 'Surat Tugas Pembahas'),
(3, 'Surat Tugas Penguji');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_pegawai` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpjs` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_dosen` tinyint(4) DEFAULT NULL,
  `id_jabatan` int(10) UNSIGNED DEFAULT NULL,
  `id_bagian` int(10) UNSIGNED DEFAULT NULL,
  `id_pangkat` int(10) UNSIGNED DEFAULT NULL,
  `id_golongan` int(10) UNSIGNED DEFAULT NULL,
  `id_fungsional` int(10) UNSIGNED DEFAULT NULL,
  `id_pph` tinyint(3) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `no_pegawai`, `nama`, `npwp`, `bpjs`, `is_dosen`, `id_jabatan`, `id_bagian`, `id_pangkat`, `id_golongan`, `id_fungsional`, `id_pph`, `remember_token`, `jurusan`) VALUES
('admin', '$2y$10$B.X35UGEeknipuZmlbMNKezfxThCgZWdg3V3cDawRxTxeCvnZrc0i', '1', 'Administrator', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
('Slamin', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '196704201992011000', 'Prof. Drs. Slamin, M.Comp.Sc., Ph.D', NULL, NULL, 1, 4, NULL, 9, 9, 1, NULL, NULL, 1),
('Saiful', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '196811131994121000', 'Prof. Dr. Saiful Bukhori, ST., M.Kom', NULL, NULL, 1, 1, NULL, 7, 7, 1, NULL, NULL, 2),
('Anang', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '196906151997021000', 'Anang Andrianto, S.T., M.T', NULL, NULL, 1, 4, NULL, 5, 5, 3, NULL, NULL, 2),
('Lis', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '196907312006042000', 'Lis Nur Aini, SE', NULL, NULL, NULL, 7, NULL, 5, 5, 8, NULL, NULL, 0),
('Antonius', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '196909281993021000', 'Drs. Antonius Cahya P, M. App,.Sc., Ph.D', NULL, NULL, 1, 2, NULL, 8, 8, 2, NULL, NULL, 2),
('Riyadi', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '196912112007011000', 'Riyadi Kurniawan', NULL, NULL, NULL, 9, NULL, 2, 2, 10, NULL, NULL, 0),
('Maududie', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '197004221995121000', 'Achmad Maududie, ST., M.Sc', NULL, NULL, 1, 4, NULL, 6, 6, 3, NULL, NULL, 1),
('Nur', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '197301312008101000', 'Nur Dwiyanto,SE', NULL, NULL, NULL, 8, NULL, 5, 5, 9, NULL, NULL, 0),
('Retno', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '197803302003121000', 'Dwiretno Istiyadi S, ST., M.Kom', NULL, NULL, 1, 4, NULL, 3, 3, 4, NULL, NULL, 1),
('Katarina', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '197904292008122000', 'Katarina Leba, S.Ag., M.Th', NULL, NULL, 1, 4, NULL, 5, 5, 3, NULL, NULL, 1),
('Elok', '$2y$10$Ysx.OhCI41fstj6hJhNnDeOTGYyRH3QvK/47xjLGB5Za7cdf/QUiq', '198012102008102000', 'Elok Zakia', NULL, NULL, NULL, 6, NULL, 1, 1, 7, NULL, NULL, 0),
('Arief', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198101232010121000', 'M. Arief Hidayat, S. Kom., M. Kom', NULL, NULL, 1, 4, NULL, 4, 4, 4, NULL, NULL, 3),
('Hosnul', '$2y$10$HT1urKfhr0zdEYIxQa.4YOPAf3g67dGZxlumCztVRFaK6tiyVn10G', '198104042005022000', 'Siti Hosnul Hotimah, S.Si', NULL, NULL, NULL, 5, NULL, 6, 6, 6, NULL, NULL, 0),
('Oktalia', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198110202014042000', 'Oktalia Juwita, S.Kom., M.MT', NULL, NULL, 1, 4, NULL, 5, 5, 3, NULL, NULL, 1),
('Yanuar', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198201012010121000', 'Yanuar Nurdiansyah, ST., M.Cs', NULL, NULL, 1, 4, NULL, 5, 5, 3, NULL, NULL, 2),
('Priza', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198301312015041000', 'Priza Pandunata, S.Kom., M.Sc', NULL, NULL, 1, 4, NULL, 4, 4, 4, NULL, NULL, 1),
('Windi', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198403052010122000', 'Windi Eka Yulia Retnani, S. Kom., MT', NULL, NULL, 1, 3, NULL, 5, 5, 3, NULL, NULL, 3),
('Nelly', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198410242009122000', 'Nelly Oktavia Adiwijaya, S.Si., MT', NULL, NULL, 1, 4, NULL, 5, 5, 3, NULL, NULL, 3),
('Nova', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198411012015042000', 'Nova El Maidah, S.Si., M.Cs', NULL, NULL, 1, 4, NULL, 4, 4, 4, NULL, NULL, 1),
('Fajrin', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198511282015041000', 'Fajrin Nurman Arifin, ST., M.Eng', NULL, NULL, 1, 4, NULL, 4, 4, 4, NULL, NULL, 1),
('Diah', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198603052014042000', 'Diah Ayu Retnani Wulandari, ST., M.Eng', NULL, NULL, 1, 4, NULL, 4, 4, 3, NULL, NULL, 2),
('Robby', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '198706192014041000', 'Fahrobby Adnan, S.Kom.,MMSI', NULL, NULL, 1, 4, NULL, 4, 4, 3, NULL, NULL, 1),
('Zarkasi', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '199011112019031000', 'Mohammad Zarkasi, S.Kom.,M.Kom', NULL, NULL, 1, 4, NULL, 4, 4, 4, NULL, NULL, 2),
('contoh2', '$2y$10$8pREMjoNI9DLM6KdrRonGuH27DKzXdwZEbmo6Ebs8VG9hVErVGG1a', '324234242', 'contoh2', NULL, NULL, NULL, 4, NULL, 2, 3, 2, NULL, NULL, 0),
('Wahyu', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760007023', 'Wahyu Setyo Laksono', NULL, NULL, NULL, 21, NULL, NULL, NULL, 21, NULL, NULL, 0),
('Imam', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760009191', 'Imam Surya Darmawan, SH', NULL, NULL, NULL, 10, NULL, NULL, NULL, 11, NULL, NULL, 0),
('Novie', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760009192', 'Novie Ertanto', NULL, NULL, NULL, 18, NULL, NULL, NULL, 18, NULL, NULL, 0),
('Maryo', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760009195', 'Maryo Setiyo Adi, ST', NULL, NULL, NULL, 15, NULL, NULL, NULL, 15, NULL, NULL, 0),
('Sholeh', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760009197', 'M. Sholeh', NULL, NULL, NULL, 22, NULL, NULL, NULL, 22, NULL, NULL, 0),
('Ayu', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760009201', 'Ayu Aisah', NULL, NULL, NULL, 13, NULL, NULL, NULL, 13, NULL, NULL, 0),
('Hobir', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760009205', 'Mohammad Hobir', NULL, NULL, NULL, 20, NULL, NULL, NULL, 20, NULL, NULL, 0),
('Siti', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760011437', 'Siti Maemona, A.Md', NULL, NULL, NULL, 11, NULL, NULL, NULL, 12, NULL, NULL, 0),
('Purwanto', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760011443', 'Purwanto', NULL, NULL, NULL, 17, NULL, NULL, NULL, 17, NULL, NULL, 0),
('Alif', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760011444', 'Alif Abdul Dhohir Lubis', NULL, NULL, NULL, 19, NULL, NULL, NULL, 19, NULL, NULL, 0),
('Riza', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760012459', 'Riza Resti Pratitis, SE', NULL, NULL, NULL, 12, NULL, NULL, NULL, 8, NULL, NULL, 0),
('Radika', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760012514', 'Radika Bhaskara, S.Kom', NULL, NULL, NULL, 16, NULL, NULL, NULL, 16, NULL, NULL, 0),
('Darwis', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760012540', 'Darwis Putra Astaman', NULL, NULL, NULL, 14, NULL, NULL, NULL, 14, NULL, NULL, 0),
('Gama', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760015717', 'Gama Wisnu Fajarianto, S.Kom.,M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 3),
('Tio', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760016851', 'Tio Dharmawan, S.Kom.,M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 2),
('Beny', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760016852', 'Beny Prasetyo, S.Kom.,M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 1),
('Diksy', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760016853', 'Diksy Media Firmansyah, S.Kom.,M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 3),
('Gayatri', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760017013', 'Gayatri Dwi Santika, S.SI.,M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 3),
('Januar', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760017015', 'Januar Adi Putra, S.kom., M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 2),
('Fitri', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760018025', 'Fitriyana Dewi, S.Kom.,M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 1),
('Qilba', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760018027', 'Qilbaini Efendi Muftikhali, S.Kom.,M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 1),
('Qurrota', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760018029', 'Qurrota Aâ€™yuni Ar Ruhimat, S.Pd.,M.Sc', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 3),
('Yudha', '$2y$12$gbJGcX0VlcMc6QOy8FLja.UZjmlKmbiHoHckv3g8dHmUqp1OD8oom', '760018031', 'Yudha Alif Auliya, S.Kom.,M.Kom', NULL, NULL, 1, 4, NULL, 10, 10, 5, NULL, NULL, 2),
('bambang123', '$2y$10$cxMDaBnCSS6pm7fRNEZLQOOSxc7byHqj0tN2XXSZuSXu4XbVR2B16', '92837918371381', 'Bambang', NULL, NULL, NULL, 6, NULL, 4, 5, 12, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bukti_perjalanan`
--
ALTER TABLE `bukti_perjalanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_barang_idstatus_fk_foreign` (`idstatus_fk`);

--
-- Indexes for table `data_ruang`
--
ALTER TABLE `data_ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_data_barang`
--
ALTER TABLE `detail_data_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_data_barang_idbarang_fk_foreign` (`idbarang_fk`),
  ADD KEY `detail_data_barang_idruang_fk_foreign` (`idruang_fk`);

--
-- Indexes for table `detail_honor`
--
ALTER TABLE `detail_honor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_honor_id_sk_honor_foreign` (`id_sk_honor`),
  ADD KEY `detail_honor_id_histori_besaran_honor_foreign` (`id_histori_besaran_honor`);

--
-- Indexes for table `detail_pinjam_barang`
--
ALTER TABLE `detail_pinjam_barang`
  ADD KEY `detail_pinjam_barang_idpinjam_barang_fk_foreign` (`idpinjam_barang_fk`),
  ADD KEY `detail_pinjam_barang_iddetail_data_barang_fk_foreign` (`iddetail_data_barang_fk`),
  ADD KEY `detail_pinjam_barang_idsatuan_fk_foreign` (`idsatuan_fk`);

--
-- Indexes for table `detail_pinjam_ruang`
--
ALTER TABLE `detail_pinjam_ruang`
  ADD KEY `detail_pinjam_ruang_idpinjam_ruang_fk_foreign` (`idpinjam_ruang_fk`),
  ADD KEY `detail_pinjam_ruang_idruang_fk_foreign` (`idruang_fk`);

--
-- Indexes for table `detail_skripsi`
--
ALTER TABLE `detail_skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_skripsi_id_sk_sempro_foreign` (`id_sk_sempro`),
  ADD KEY `detail_skripsi_id_sk_skripsi_foreign` (`id_sk_skripsi`),
  ADD KEY `detail_skripsi_id_keris_foreign` (`id_keris`),
  ADD KEY `detail_skripsi_id_skripsi_foreign` (`id_skripsi`);

--
-- Indexes for table `dosen_tugas`
--
ALTER TABLE `dosen_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_laporan`
--
ALTER TABLE `file_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_laporan_id_laporan_foreign` (`id_laporan`);

--
-- Indexes for table `fungsional`
--
ALTER TABLE `fungsional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histori_besaran_honor`
--
ALTER TABLE `histori_besaran_honor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histori_besaran_honor_id_nama_honor_foreign` (`id_nama_honor`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_laporan`
--
ALTER TABLE `jenis_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_sk`
--
ALTER TABLE `jenis_sk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keris`
--
ALTER TABLE `keris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_id_jenis_foreign` (`id_jenis`),
  ADD KEY `laporan_id_user_foreign` (`id_user`);

--
-- Indexes for table `laporan_pengadaan`
--
ALTER TABLE `laporan_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `mahasiswa_id_bagian_foreign` (`id_bagian`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nama_honor`
--
ALTER TABLE `nama_honor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nama_template`
--
ALTER TABLE `nama_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemateri`
--
ALTER TABLE `pemateri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran_acara`
--
ALTER TABLE `pendaftaran_acara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengadaan_id_satuan_foreign` (`id_satuan`),
  ADD KEY `pengadaan_id_laporan_foreign` (`id_laporan`);

--
-- Indexes for table `perjalanan`
--
ALTER TABLE `perjalanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjam_ruang`
--
ALTER TABLE `pinjam_ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pph`
--
ALTER TABLE `pph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skripsi_nim_foreign` (`nim`),
  ADD KEY `skripsi_id_status_skripsi_foreign` (`id_status_skripsi`);

--
-- Indexes for table `sk_honor`
--
ALTER TABLE `sk_honor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sk_honor_id_status_sk_honor_foreign` (`id_status_sk_honor`);

--
-- Indexes for table `sk_sempro`
--
ALTER TABLE `sk_sempro`
  ADD PRIMARY KEY (`no_surat`),
  ADD KEY `sk_sempro_id_status_sk_foreign` (`id_status_sk`),
  ADD KEY `sk_sempro_id_template_foreign` (`id_template`),
  ADD KEY `sk_sempro_id_sk_honor_foreign` (`id_sk_honor`);

--
-- Indexes for table `sk_skripsi`
--
ALTER TABLE `sk_skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sk_skripsi_id_status_sk_foreign` (`id_status_sk`),
  ADD KEY `sk_skripsi_id_template_pembimbing_foreign` (`id_template_pembimbing`),
  ADD KEY `sk_skripsi_id_template_penguji_foreign` (`id_template_penguji`),
  ADD KEY `sk_skripsi_id_sk_honor_foreign` (`id_sk_honor`);

--
-- Indexes for table `spd`
--
ALTER TABLE `spd`
  ADD PRIMARY KEY (`id_spd`);

--
-- Indexes for table `status_barang`
--
ALTER TABLE `status_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_sk`
--
ALTER TABLE `status_sk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_skripsi`
--
ALTER TABLE `status_skripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_sk_honor`
--
ALTER TABLE `status_sk_honor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_surat`
--
ALTER TABLE `status_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_surat_tugas`
--
ALTER TABLE `status_surat_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_in_out`
--
ALTER TABLE `surat_in_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_kepegawaian`
--
ALTER TABLE `surat_kepegawaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_tugas_id_tipe_surat_tugas_foreign` (`id_tipe_surat_tugas`),
  ADD KEY `surat_tugas_id_dosen1_foreign` (`id_dosen1`),
  ADD KEY `surat_tugas_id_dosen2_foreign` (`id_dosen2`),
  ADD KEY `surat_tugas_id_status_surat_tugas_foreign` (`id_status_surat_tugas`),
  ADD KEY `surat_tugas_id_detail_skripsi_foreign` (`id_detail_skripsi`),
  ADD KEY `surat_tugas_id_ruang_foreign` (`id_ruang`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_id_nama_template_foreign` (`id_nama_template`);

--
-- Indexes for table `tipe_surat_tugas`
--
ALTER TABLE `tipe_surat_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`no_pegawai`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_id_jabatan_foreign` (`id_jabatan`),
  ADD KEY `users_id_bagian_foreign` (`id_bagian`),
  ADD KEY `users_id_pangkat_foreign` (`id_pangkat`),
  ADD KEY `users_id_golongan_foreign` (`id_golongan`),
  ADD KEY `users_id_fungsional_foreign` (`id_fungsional`),
  ADD KEY `users_id_pph_foreign` (`id_pph`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bukti_perjalanan`
--
ALTER TABLE `bukti_perjalanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `data_ruang`
--
ALTER TABLE `data_ruang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `detail_barang`
--
ALTER TABLE `detail_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_data_barang`
--
ALTER TABLE `detail_data_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1755;

--
-- AUTO_INCREMENT for table `detail_honor`
--
ALTER TABLE `detail_honor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_skripsi`
--
ALTER TABLE `detail_skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen_tugas`
--
ALTER TABLE `dosen_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `file_laporan`
--
ALTER TABLE `file_laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fungsional`
--
ALTER TABLE `fungsional`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `histori_besaran_honor`
--
ALTER TABLE `histori_besaran_honor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jenis_kendaraan`
--
ALTER TABLE `jenis_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_laporan`
--
ALTER TABLE `jenis_laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_sk`
--
ALTER TABLE `jenis_sk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keris`
--
ALTER TABLE `keris`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_pengadaan`
--
ALTER TABLE `laporan_pengadaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `nama_honor`
--
ALTER TABLE `nama_honor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nama_template`
--
ALTER TABLE `nama_template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pemateri`
--
ALTER TABLE `pemateri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjam_barang`
--
ALTER TABLE `pinjam_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjam_ruang`
--
ALTER TABLE `pinjam_ruang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pph`
--
ALTER TABLE `pph`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_honor`
--
ALTER TABLE `sk_honor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_skripsi`
--
ALTER TABLE `sk_skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spd`
--
ALTER TABLE `spd`
  MODIFY `id_spd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `status_barang`
--
ALTER TABLE `status_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_sk`
--
ALTER TABLE `status_sk`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_skripsi`
--
ALTER TABLE `status_skripsi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status_sk_honor`
--
ALTER TABLE `status_sk_honor`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_surat`
--
ALTER TABLE `status_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `status_surat_tugas`
--
ALTER TABLE `status_surat_tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_kepegawaian`
--
ALTER TABLE `surat_kepegawaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipe_surat_tugas`
--
ALTER TABLE `tipe_surat_tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `data_barang_idstatus_fk_foreign` FOREIGN KEY (`idstatus_fk`) REFERENCES `status_barang` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_data_barang`
--
ALTER TABLE `detail_data_barang`
  ADD CONSTRAINT `detail_data_barang_idbarang_fk_foreign` FOREIGN KEY (`idbarang_fk`) REFERENCES `data_barang` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_data_barang_idruang_fk_foreign` FOREIGN KEY (`idruang_fk`) REFERENCES `data_ruang` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_honor`
--
ALTER TABLE `detail_honor`
  ADD CONSTRAINT `detail_honor_id_histori_besaran_honor_foreign` FOREIGN KEY (`id_histori_besaran_honor`) REFERENCES `histori_besaran_honor` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_honor_id_sk_honor_foreign` FOREIGN KEY (`id_sk_honor`) REFERENCES `sk_honor` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_pinjam_barang`
--
ALTER TABLE `detail_pinjam_barang`
  ADD CONSTRAINT `detail_pinjam_barang_iddetail_data_barang_fk_foreign` FOREIGN KEY (`iddetail_data_barang_fk`) REFERENCES `detail_data_barang` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_pinjam_barang_idpinjam_barang_fk_foreign` FOREIGN KEY (`idpinjam_barang_fk`) REFERENCES `pinjam_barang` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_pinjam_barang_idsatuan_fk_foreign` FOREIGN KEY (`idsatuan_fk`) REFERENCES `satuan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_pinjam_ruang`
--
ALTER TABLE `detail_pinjam_ruang`
  ADD CONSTRAINT `detail_pinjam_ruang_idpinjam_ruang_fk_foreign` FOREIGN KEY (`idpinjam_ruang_fk`) REFERENCES `pinjam_ruang` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_pinjam_ruang_idruang_fk_foreign` FOREIGN KEY (`idruang_fk`) REFERENCES `data_ruang` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_skripsi`
--
ALTER TABLE `detail_skripsi`
  ADD CONSTRAINT `detail_skripsi_id_keris_foreign` FOREIGN KEY (`id_keris`) REFERENCES `keris` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_skripsi_id_sk_sempro_foreign` FOREIGN KEY (`id_sk_sempro`) REFERENCES `sk_sempro` (`no_surat`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_skripsi_id_sk_skripsi_foreign` FOREIGN KEY (`id_sk_skripsi`) REFERENCES `sk_skripsi` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_skripsi_id_skripsi_foreign` FOREIGN KEY (`id_skripsi`) REFERENCES `skripsi` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `file_laporan`
--
ALTER TABLE `file_laporan`
  ADD CONSTRAINT `file_laporan_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `histori_besaran_honor`
--
ALTER TABLE `histori_besaran_honor`
  ADD CONSTRAINT `histori_besaran_honor_id_nama_honor_foreign` FOREIGN KEY (`id_nama_honor`) REFERENCES `nama_honor` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_laporan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laporan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`no_pegawai`) ON DELETE SET NULL;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_id_bagian_foreign` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD CONSTRAINT `pengadaan_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporan_pengadaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengadaan_id_satuan_foreign` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD CONSTRAINT `skripsi_id_status_skripsi_foreign` FOREIGN KEY (`id_status_skripsi`) REFERENCES `status_skripsi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `skripsi_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE SET NULL;

--
-- Constraints for table `sk_honor`
--
ALTER TABLE `sk_honor`
  ADD CONSTRAINT `sk_honor_id_status_sk_honor_foreign` FOREIGN KEY (`id_status_sk_honor`) REFERENCES `status_sk_honor` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sk_sempro`
--
ALTER TABLE `sk_sempro`
  ADD CONSTRAINT `sk_sempro_id_sk_honor_foreign` FOREIGN KEY (`id_sk_honor`) REFERENCES `sk_honor` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sk_sempro_id_status_sk_foreign` FOREIGN KEY (`id_status_sk`) REFERENCES `status_sk` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sk_sempro_id_template_foreign` FOREIGN KEY (`id_template`) REFERENCES `template` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sk_skripsi`
--
ALTER TABLE `sk_skripsi`
  ADD CONSTRAINT `sk_skripsi_id_sk_honor_foreign` FOREIGN KEY (`id_sk_honor`) REFERENCES `sk_honor` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sk_skripsi_id_status_sk_foreign` FOREIGN KEY (`id_status_sk`) REFERENCES `status_sk` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sk_skripsi_id_template_pembimbing_foreign` FOREIGN KEY (`id_template_pembimbing`) REFERENCES `template` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sk_skripsi_id_template_penguji_foreign` FOREIGN KEY (`id_template_penguji`) REFERENCES `template` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD CONSTRAINT `surat_tugas_id_detail_skripsi_foreign` FOREIGN KEY (`id_detail_skripsi`) REFERENCES `detail_skripsi` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_tugas_id_dosen1_foreign` FOREIGN KEY (`id_dosen1`) REFERENCES `users` (`no_pegawai`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_tugas_id_dosen2_foreign` FOREIGN KEY (`id_dosen2`) REFERENCES `users` (`no_pegawai`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_tugas_id_ruang_foreign` FOREIGN KEY (`id_ruang`) REFERENCES `data_ruang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_tugas_id_status_surat_tugas_foreign` FOREIGN KEY (`id_status_surat_tugas`) REFERENCES `status_surat_tugas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_tugas_id_tipe_surat_tugas_foreign` FOREIGN KEY (`id_tipe_surat_tugas`) REFERENCES `tipe_surat_tugas` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `template`
--
ALTER TABLE `template`
  ADD CONSTRAINT `template_id_nama_template_foreign` FOREIGN KEY (`id_nama_template`) REFERENCES `nama_template` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_bagian_foreign` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_id_fungsional_foreign` FOREIGN KEY (`id_fungsional`) REFERENCES `fungsional` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_id_golongan_foreign` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_id_pangkat_foreign` FOREIGN KEY (`id_pangkat`) REFERENCES `pangkat` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_id_pph_foreign` FOREIGN KEY (`id_pph`) REFERENCES `pph` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
