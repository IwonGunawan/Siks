-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 05:11 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siks`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_ajar`
--

CREATE TABLE `bidang_ajar` (
  `id` int(10) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidang_ajar`
--

INSERT INTO `bidang_ajar` (`id`, `judul`, `deleted`) VALUES
(1, 'Aqidah', '0'),
(2, 'Hadist', '0'),
(3, 'Nahwu', '0'),
(4, 'Siroh', '0'),
(5, 'Fikih', '0'),
(6, 'Akhlak', '0'),
(7, 'Muhadatsah', '0'),
(8, 'Mufrodat', '0'),
(9, 'Khot', '0'),
(10, 'IPA', '0'),
(11, 'MTK', '0'),
(12, 'Bhs. Inggris', '0'),
(13, 'Bhs.Indonesia', '0'),
(14, 'Tahfidz', '0'),
(15, 'Tahsin', '0');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `nip` varchar(225) NOT NULL,
  `jk` char(1) NOT NULL DEFAULT '0' COMMENT 'M=pria, F=wanita',
  `tempat_lahir` varchar(225) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `email` varchar(225) NOT NULL,
  `nohp` varchar(225) NOT NULL,
  `pendidikan_terakhir` varchar(225) NOT NULL,
  `bidang_ajar` varchar(225) NOT NULL,
  `dibuat_tgl` datetime DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  `diubah_tgl` datetime DEFAULT NULL,
  `diubah_oleh` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `uuid`, `nama`, `nip`, `jk`, `tempat_lahir`, `tgl_lahir`, `alamat`, `email`, `nohp`, `pendidikan_terakhir`, `bidang_ajar`, `dibuat_tgl`, `dibuat_oleh`, `diubah_tgl`, `diubah_oleh`, `deleted`) VALUES
(1, 'c13a66e1-e0e8-11ea-8996-d19c9a2f1bfb', 'Fitra Rahman', '918273645', 'F', 'Bogor', '1987-08-01', 'Jl. Sholeh Iskandar', 'rahman@gmail.com', '085712345678', 'S1', '[\"1\",\"7\",\"12\"]', '2020-08-18 07:20:58', 1, NULL, NULL, '0'),
(2, 'fb86ac74-e0e8-11ea-8996-d19c9a2f1bfb', 'Sobirin, S.pd', '182948756', 'M', 'Bogor', '1998-08-18', 'Jl. Bangbarung', 'sobirin', '085712345678', 'S1', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', '2020-08-18 07:22:36', 1, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `santri_id` int(11) NOT NULL,
  `kelas` varchar(225) NOT NULL,
  `peristiwa` text NOT NULL,
  `kronologi` text NOT NULL,
  `motif_melanggar` text NOT NULL,
  `solusi` text NOT NULL,
  `dibuat_tgl` datetime DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  `diubah_tgl` datetime DEFAULT NULL,
  `diubah_oleh` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `no_induk` varchar(225) NOT NULL,
  `nisn` varchar(225) NOT NULL,
  `jk` char(1) NOT NULL COMMENT 'M=pria, F=wanita',
  `tempat_lahir` varchar(225) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL COMMENT 'status dalam keluarga',
  `anak_ke` int(2) NOT NULL,
  `alamat` text NOT NULL,
  `asal_sekolah` varchar(225) NOT NULL,
  `diterima_dikelas` varchar(225) NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `ayah` varchar(225) NOT NULL,
  `ayah_pekerjaan` varchar(225) NOT NULL,
  `ibu` varchar(225) NOT NULL,
  `ibu_pekerjaan` varchar(225) NOT NULL,
  `wali` varchar(225) NOT NULL,
  `wali_pekerjaan` varchar(225) NOT NULL,
  `dibuat_tgl` datetime DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  `diubah_tgl` datetime DEFAULT NULL,
  `diubah_oleh` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`id`, `uuid`, `nama`, `no_induk`, `nisn`, `jk`, `tempat_lahir`, `tgl_lahir`, `agama`, `status`, `anak_ke`, `alamat`, `asal_sekolah`, `diterima_dikelas`, `tgl_terima`, `ayah`, `ayah_pekerjaan`, `ibu`, `ibu_pekerjaan`, `wali`, `wali_pekerjaan`, `dibuat_tgl`, `dibuat_oleh`, `diubah_tgl`, `diubah_oleh`, `deleted`) VALUES
(1, 'e4d99f85-e0e6-11ea-8996-d19c9a2f1bfb', 'Abdullah Syafi\'i', '112233445566', '23454321', 'M', 'Bogor', '1994-08-18', 'Islam', 'Anak Kandung', 3, 'Jl. Raya Bogor - Jakarta no 109', 'SMA Pandu', 'X', '2020-08-10', 'Mamat', 'Petani', 'Aminah', 'Ibu Rumah Tangga', 'Budiman', 'Karyawan Swasta', '2020-08-18 07:07:39', 1, NULL, NULL, '0'),
(2, '8355b5a8-e0e8-11ea-8996-d19c9a2f1bfb', 'Muhammad Rahman', '9988776655', '9998881112', 'M', 'Bogor', '2001-07-11', 'Islam', 'Anak Kandung', 2, 'Jalan Raya Parung', 'SMK bina nusantara', 'X', '2020-08-10', 'Ja\'i', 'Guru', 'Soimah', 'Ibu Rumah Tangga', 'Syakur', 'Pedagang', '2020-08-18 07:19:14', 1, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tahfidz`
--

CREATE TABLE `tahfidz` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `santri_id` int(11) NOT NULL,
  `kelas` varchar(225) NOT NULL,
  `tipe_setoran` char(1) NOT NULL COMMENT '0=hafalan | 1=murojaah',
  `juz` varchar(225) NOT NULL,
  `surat` varchar(225) NOT NULL,
  `ayat_awal` varchar(225) NOT NULL,
  `ayat_akhir` varchar(225) NOT NULL,
  `catatan` text NOT NULL,
  `dibuat_tgl` datetime DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  `diubah_tgl` datetime DEFAULT NULL,
  `diubah_oleh` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_uuid` char(36) NOT NULL,
  `users_name` varchar(225) NOT NULL,
  `users_email` varchar(225) NOT NULL,
  `users_password` varchar(225) NOT NULL,
  `users_level` char(1) NOT NULL COMMENT '0=admin, 1=guru',
  `users_status` char(1) NOT NULL COMMENT '0=active, 1=non active',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(225) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(225) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_uuid`, `users_name`, `users_email`, `users_password`, `users_level`, `users_status`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted`) VALUES
(1, '152d48e7-a68f-3620-94fb-e78e639f1bad', 'Yayi Suaidah', 'admin@gmail.com', '$2y$10$zoOglWgt8hMkUM2T8evfleqSygHjLIU.OWi3Nti9haiCOD.8MrL4W', '0', '0', '2018-07-25 06:38:19', 'yayi', NULL, '0', '0'),
(2, '152d48e7-a68f-3620-94fb-e78e639fb002', 'Siti Fatimah', 'ustadzah1@gmail.com', '$2y$10$zoOglWgt8hMkUM2T8evfleqSygHjLIU.OWi3Nti9haiCOD.8MrL4W', '1', '0', '2018-07-25 06:38:19', 'yayi', NULL, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_ajar`
--
ALTER TABLE `bidang_ajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `santri_id` (`santri_id`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tahfidz`
--
ALTER TABLE `tahfidz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `santri_id` (`santri_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `usersId` (`users_id`),
  ADD KEY `users_id` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_ajar`
--
ALTER TABLE `bidang_ajar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `santri`
--
ALTER TABLE `santri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tahfidz`
--
ALTER TABLE `tahfidz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
