-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 05:44 AM
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
-- Database: `simps`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1615542820),
('m130524_201442_init', 1615542826),
('m190124_110200_add_verification_token_column_to_user_table', 1615542827);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `nama_petugas` text NOT NULL,
  `level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `password`, `nama_petugas`, `level`) VALUES
(1, 'admin', '$2y$13$XaSW9bEmV2iCQl/WEk55ZuixyGLS35f5yk1v2Z4AioDxOOonnub8i', 'Sasha', '2'),
(2, 'Pizza', '$2y$13$XaSW9bEmV2iCQl/WEk55ZuixyGLS35f5yk1v2Z4AioDxOOonnub8i', 'Ravioli', '1');

-- --------------------------------------------------------

--
-- Table structure for table `shortcut`
--

CREATE TABLE `shortcut` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shortcut`
--

INSERT INTO `shortcut` (`id`, `name`, `url`, `level`) VALUES
(1, 'Dashboard', 'site/dashboard', 1),
(2, 'Pembayaran', 'site/billing', 1),
(3, 'Dashboard', 'site/dashboard', 2),
(4, 'Pembayaran', 'site/billing', 2),
(5, 'Siswa', 'student/index', 2),
(6, 'Petugas', 'petugas/index', 2),
(7, 'Kelas', 'classes/index', 2),
(8, 'Pembayaran', 'spp/index', 2),
(9, 'Laporan & Riwayat', 'site/report', 2),
(10, 'Laporan & Riwayat', 'site/report', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `skill` text NOT NULL,
  `alias` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `skill`, `alias`) VALUES
(1, 'Rekayasa Perangkat Lunak', 'RPL'),
(2, 'Teknik Jaringan Komputer', 'TKJ'),
(3, 'Pekerja Sosial', 'PS'),
(4, 'Multimedia', 'MM'),
(5, 'Animasi', 'Animasi'),
(6, 'Desain Komunikasi Visual', 'DKV');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `nominal` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id`, `nisn`, `nominal`, `created_at`) VALUES
(1, 123123123, '150000', '2021-03-21 09:21:57'),
(2, 123123123, '150000', '2021-03-19 09:23:07'),
(3, 123123123, '150000', '2021-03-18 11:56:48'),
(4, 321321321, '150000', '2021-03-18 11:57:30'),
(5, 123123123, '150000', '2021-03-18 09:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `nisn` int(11) NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `nama` text NOT NULL,
  `password` text NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_skill` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` text DEFAULT NULL,
  `id_spp` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`nisn`, `nis`, `nama`, `password`, `id_kelas`, `id_skill`, `alamat`, `no_telp`, `id_spp`, `created_at`) VALUES
(123123123, 123321123, 'Shamiko Misstress', '', 3, 1, 'Tokyo', '0823-6438-6074', NULL, '2021-03-14 15:21:36'),
(132132132, 132132132, 'Mashiro Yuri', '', 2, 2, 'Fuji', '082364386074', NULL, '2021-03-18 08:23:54'),
(321321321, 213321213, 'Yukihira Shouma', '$2y$13$/ZFQ2zWgVMbs8OXiMoe0zOFLx8NXYGrdeo.zENMFZ5koqPYvpaEqy', 1, 4, 'Akihabaraa', '0892344512', NULL, '2021-03-14 15:30:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shortcut`
--
ALTER TABLE `shortcut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`nisn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shortcut`
--
ALTER TABLE `shortcut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
