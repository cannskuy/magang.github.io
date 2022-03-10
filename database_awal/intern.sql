-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2021 at 08:27 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `bensin`
--

CREATE TABLE `bensin` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `plat` varchar(128) NOT NULL,
  `masuk` int(128) NOT NULL,
  `harga` int(128) NOT NULL,
  `saldo` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bensin`
--

INSERT INTO `bensin` (`id`, `tanggal`, `plat`, `masuk`, `harga`, `saldo`) VALUES
(11, '2021-08-12 10:11:00', '-', 1000000, 0, 1000000),
(12, '2021-08-12 10:12:00', 'BG 1349 RZ', 0, 500000, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `nama_driver` varchar(128) NOT NULL,
  `plat` varchar(128) NOT NULL,
  `wa` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `nama_driver`, `plat`, `wa`) VALUES
(1, 'Febri', 'BG 1349 RZ', '6281377537868'),
(2, 'Dodi', 'BG 1420 EZ', '6281215344182'),
(3, 'Herlan', 'BG 1350 RZ', '6285279428158'),
(4, 'Rinaldi', 'BG 1351 RZ', '81367663221'),
(5, 'Nanak', 'BG 1423 IL', '6281237207171'),
(6, 'Eko', 'BG 1352 RZ', '6281273276925');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `form_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `NPP` int(128) NOT NULL,
  `unit_kerja` varchar(128) NOT NULL,
  `tujuan` varchar(256) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form_pinjam`
--

CREATE TABLE `form_pinjam` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `NPP` int(128) NOT NULL,
  `unit_kerja` varchar(128) NOT NULL,
  `tujuan` varchar(256) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `no_polisi` varchar(128) NOT NULL,
  `driver` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_pinjam`
--

INSERT INTO `form_pinjam` (`id`, `form_id`, `name`, `NPP`, `unit_kerja`, `tujuan`, `start`, `end`, `no_polisi`, `driver`) VALUES
(22, 18, 'Sabili Baharudin Lopa', 2019390011, 'SDM', 'Pinjam', '2021-08-10 16:00:00', '2021-08-10 16:01:00', 'BG 1349 RZ', 'Febri');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `NPP` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `noHP_user` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`NPP`, `name`, `email`, `noHP_user`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2019390001, 'Admin', 'sabili.lopa@my.sampoernauniversity.ac.id', '6281280017205', 'default.jpg', '$2y$10$UW81mxnDKJ9BI6ClBZnfDubFSJ9JGk5t3A4vcbFigK/sc3DQud97K', 1, 1, 1620272621),
(2019390011, 'Sabili Baharudin Lopa', 'sabiliblopa@gmail.com', '6281367181629', 'default.jpg', '$2y$10$TTYF0cxNxodbx8kS3i8LrO.gZNmoyreQa/Tu2x6ouK.lOOPFCVsxu', 2, 1, 1620101473);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(6, 1, 4),
(7, 2, 4),
(8, 1, 5),
(9, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Bensin'),
(4, 'Form'),
(5, 'Added');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `NPP` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`NPP`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Pendaftaran User Baru', 'admin', 'fas fa-fw fa-pencil-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(4, 4, 'Form Peminjaman Mobil', 'form', 'fab fa-fw fa-wpforms', 1),
(5, 5, 'Daftar Pinjaman', 'added', 'fas fa-fw fa-clipboard-list', 1),
(6, 5, 'Daftar Laporan', 'added/laporan', 'fas fa-fw fa-list', 1),
(9, 3, 'Form BBM', 'bensin', 'fas fa-fw fa-gas-pump', 1),
(10, 3, 'Daftar Laporan BBM', 'bensin/addbensin', 'fas fa-fw fa-list-ul', 1),
(11, 3, 'Deposit', 'bensin/deposit', 'fas fa-fw fa-money-check', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bensin`
--
ALTER TABLE `bensin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `form_pinjam`
--
ALTER TABLE `form_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NPP`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`NPP`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bensin`
--
ALTER TABLE `bensin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `form_pinjam`
--
ALTER TABLE `form_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
