-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2021 at 09:22 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `pelanggaran_id` int(11) NOT NULL,
  `pelanggaran_uuid` char(36) NOT NULL,
  `santri_id` int(11) NOT NULL,
  `pelanggaran_peristiwa` text NOT NULL,
  `pelanggaran_kronologi` text NOT NULL,
  `pelanggaran_motif` text NOT NULL,
  `pelanggaran_solusi` text NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`pelanggaran_id`, `pelanggaran_uuid`, `santri_id`, `pelanggaran_peristiwa`, `pelanggaran_kronologi`, `pelanggaran_motif`, `pelanggaran_solusi`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted`) VALUES
(1, 'b6cb663f-846e-11eb-9585-f3322214fcb3', 5, 'tidur dikelas2', 'setelah makan siang2', 'ngantuk2', 'kasih kopi2', '2021-03-14 09:41:01', 1, '2021-03-14 09:42:07', 1, '0'),
(2, '1d3873e1-8471-11eb-9585-f3322214fcb3', 4, 'Merokok', 'ketahuan meroko dikantin', 'ikut ikutan', 'ganti permen', '2021-03-14 09:58:11', 1, '2021-03-14 09:58:39', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `no_induk` varchar(225) NOT NULL,
  `nisn` varchar(225) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `kelas` varchar(225) NOT NULL,
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
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`id`, `uuid`, `no_induk`, `nisn`, `nama`, `kelas`, `jk`, `tempat_lahir`, `tgl_lahir`, `agama`, `status`, `anak_ke`, `alamat`, `asal_sekolah`, `diterima_dikelas`, `tgl_terima`, `ayah`, `ayah_pekerjaan`, `ibu`, `ibu_pekerjaan`, `wali`, `wali_pekerjaan`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted`) VALUES
(1, 'e4d99f85-e0e6-11ea-8996-d19c9a2f1bfb', '112233445566', '23454321', 'Abdullah Syafi\'i', 'VII', 'M', 'Bogor', '1994-08-18', 'Islam', 'Anak Kandung', 3, 'Jl. Raya Bogor - Jakarta no 109', 'SMA Pandu', 'X', '2020-08-10', 'Mamat', 'Petani', 'Aminah', 'Ibu Rumah Tangga', 'Budiman', 'Karyawan Swasta', '2020-08-18 07:07:39', 1, NULL, NULL, '0'),
(2, '8355b5a8-e0e8-11ea-8996-d19c9a2f1bfb', '9988776655', '9998881112', 'Muhammad Rahman', 'IX', 'M', 'Bogor', '2001-07-11', 'Islam', 'Anak Kandung', 2, 'Jalan Raya Parung', 'SMK bina nusantara', 'X', '2020-08-10', 'Ja\'i', 'Guru', 'Soimah', 'Ibu Rumah Tangga', 'Syakur', 'Pedagang', '2020-08-18 07:19:14', 1, '2021-03-19 09:31:55', 1, '0'),
(3, '14781aae-83ab-11eb-9585-f3322214fcb3', '11', '22', 'aa', 'VIII', 'M', 'Bogor', '1995-04-13', 'islam', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2021-03-13 10:20:37', 1, NULL, NULL, '1'),
(4, '9692a1bf-83ab-11eb-9585-f3322214fcb3', '222', '333', 'Budi Darmawan', 'VII', 'M', 'Bogor', '2021-03-13', 'islam', 'kandung', 4, 'bogor', 'SD', '7', '2021-03-13', 'aaa', 'bbb', 'teaa', 'a', 'a', 'a', '2021-03-13 10:24:15', 1, '2021-03-19 14:46:55', 1, '0'),
(5, 'e9bd45a8-83c6-11eb-9585-f3322214fcb3', '11', '22', 'Arkan', 'VIII', 'M', 'Bogor', '2021-03-13', 'islam', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2021-03-13 13:39:51', 1, '2021-03-13 21:17:15', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tahfidz`
--

CREATE TABLE `tahfidz` (
  `tahfidz_id` int(10) NOT NULL,
  `tahfidz_uuid` char(36) NOT NULL,
  `santri_id` int(10) NOT NULL,
  `tahfidz_waktu` char(1) NOT NULL COMMENT '0=pagi, 1=siang, 2=sore',
  `tahfidz_juz` tinyint(2) NOT NULL,
  `tahfidz_surat` varchar(225) NOT NULL,
  `tahfidz_ayat` varchar(225) NOT NULL,
  `tahfidz_status` char(1) NOT NULL COMMENT 'S=setoran, M=Muroja''ah, T=Tilawah Quran, TS=Tasmi, MZ=Mumtaz',
  `tahfidz_nilai` tinyint(3) NOT NULL,
  `tahfidz_catatan` text NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahfidz`
--

INSERT INTO `tahfidz` (`tahfidz_id`, `tahfidz_uuid`, `santri_id`, `tahfidz_waktu`, `tahfidz_juz`, `tahfidz_surat`, `tahfidz_ayat`, `tahfidz_status`, `tahfidz_nilai`, `tahfidz_catatan`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted`) VALUES
(1, 'c13a66e1-e0e8-11ea-8996-d19c9a2f1bfb', 1, '0', 30, 'Al-kafirun', '1', 'S', 70, 'ini adalah catatan ', '2021-03-13 09:52:28', 1, NULL, NULL, '0'),
(2, '133f04af-8404-11eb-9585-f3322214fcb3', 2, '1', 3, 'Ad-Dhuha', '2', 'T', 80, 'ini catatan2 yang banyak', '2021-03-13 20:57:40', 1, '2021-03-13 21:05:47', 1, '0'),
(3, 'e9272e84-8406-11eb-9585-f3322214fcb3', 1, '1', 1, 'Ad-Dhuha', '1', 'T', 90, 'ini adalah catatan yang banyak dan banyak dan banyak dan banyak dan banyak', '2021-03-13 21:17:57', 1, NULL, NULL, '0'),
(4, '24f14588-885b-11eb-a999-8c8590927d1f', 2, '1', 1, 'Ad-Dhuha', '1', 'S', 80, '', '2021-03-19 09:31:00', 1, NULL, NULL, '0'),
(5, '2f0bc61a-885b-11eb-a999-8c8590927d1f', 5, '0', 1, 'Ad-Dhuha', '1', 'S', 70, '', '2021-03-19 09:31:17', 1, NULL, NULL, '0'),
(6, '387924fe-885b-11eb-a999-8c8590927d1f', 5, '1', 1, 'Ad-Dhuha', '1', 'S', 80, '', '2021-03-19 09:31:33', 1, NULL, NULL, '0'),
(7, '5c47ea4c-8887-11eb-a999-8c8590927d1f', 4, '0', 1, 'Ad-Dhuha', '1', 'S', 90, '', '2021-03-19 14:47:31', 1, NULL, NULL, '0'),
(8, '9493459c-8899-11eb-a999-8c8590927d1f', 1, '2', 1, 'Ad-Dhuha', '1', 'S', 60, '', '2021-03-19 16:57:56', 1, NULL, NULL, '0');

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
  `users_level` char(1) NOT NULL COMMENT '0=admin, 1=ustadz, 2=santri',
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
(1, '152d48e7-a68f-3620-94fb-e78e639f1bad', 'Yayi Suaidah', 'admin@gmail.com', '$2y$10$TsfEBqjcc6GnMeQApuveGumCUIQw/o7ubXQ2iFVdNMrPveawXEGra', '0', '0', '2018-07-25 06:38:19', 'yayi', NULL, '0', '0'),
(2, '152d48e7-a68f-3620-94fb-e78e639fb002', 'KH. Wendy Asswan Cahyadi, S.TP., M.Pd.I\r\n', '3271032806750011', '$2y$10$TsfEBqjcc6GnMeQApuveGumCUIQw/o7ubXQ2iFVdNMrPveawXEGra', '1', '0', '2018-07-25 06:38:19', 'yayi', NULL, '0', '0'),
(3, '152d48e7-a68f-3620-94fb-e78e639fb003', 'Ahmad Azkaa Taqiyuddin', '0069456691', '$2y$10$TsfEBqjcc6GnMeQApuveGumCUIQw/o7ubXQ2iFVdNMrPveawXEGra', '2', '0', '2018-07-25 06:38:19', 'yayi', '2021-03-14 10:08:06', 'Yayi Suaidah', '0'),
(4, '0b60bb0f-8474-11eb-9585-f3322214fcb3', 'Sobirin', '11223344', '$2y$10$Zqo5Hx8IhfRCrVIbRVERO.g4s4G4kMYF1qm29ehzsoMe1ucNRjv8i', '1', '0', '2021-03-14 10:19:10', 'Yayi Suaidah', '2021-03-14 10:51:17', 'Yayi Suaidah', '1'),
(5, '7acd0b6f-8478-11eb-9585-f3322214fcb3', 'sobur', '1122', '$2y$10$CpD09nBKIhlSDU9DDGVOjuv0rGKAxgJb1gjUpjy81wM1mjtEGI0ym', '2', '0', '2021-03-14 10:50:55', 'Yayi Suaidah', '2021-03-14 10:51:13', 'Yayi Suaidah', '1'),
(6, '454584e6-84cd-11eb-9585-f3322214fcb3', 'H. Lupiyanto, S.E., M.Pd', '3271040502790029', '$2y$10$noYHwmKmLDaH7TvPlmU3Subs0InzI2mU5fKcmrbQJIxHsIxW/YtGS', '2', '0', '2021-03-14 20:57:52', 'Yayi Suaidah', '2021-03-14 21:07:24', 'Yayi Suaidah', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ustadz`
--

CREATE TABLE `ustadz` (
  `ustadz_id` int(10) NOT NULL,
  `ustadz_uuid` char(36) NOT NULL,
  `ustadz_nik` varchar(225) NOT NULL,
  `ustadz_nama` varchar(225) NOT NULL,
  `ustadz_jk` char(1) NOT NULL DEFAULT 'L' COMMENT 'L/P',
  `ustadz_alamat` varchar(225) NOT NULL,
  `bidang_ajar_id` varchar(225) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ustadz`
--

INSERT INTO `ustadz` (`ustadz_id`, `ustadz_uuid`, `ustadz_nik`, `ustadz_nama`, `ustadz_jk`, `ustadz_alamat`, `bidang_ajar_id`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted`) VALUES
(1, 'c13a66e1-e0e8-11ea-8996-d19c9a2f1b01', '3271032806750011', 'KH. Wendy Asswan Cahyadi, S.TP., M.Pd.I', 'L', 'Jl. Perintis Kemerdekaan No. 24B Kel. Kebon Kalapa Kec. Bogor Tengah Kota Bogor ', '0', '2021-03-12 00:00:00', 1, NULL, NULL, '0'),
(2, 'c13a66e1-e0e8-11ea-8996-d19c9a2f1b02', '3271040502790029', 'H. Lupiyanto, S.E., M.Pd', 'L', 'Jl. Menteng No.23A Kel. Menteng Kec. Bogor Barat Kota Bogor', '0', '2021-03-12 00:00:00', 1, NULL, NULL, '0'),
(3, 'c13a66e1-e0e8-11ea-8996-d19c9a2f1b03', '3275020607770035', 'Muhammad Asrori Muzakki', 'L', 'Jl. Cijahe Komplek Ponpes Al Ihsan Baron Rt.03/13 Cilendek Barat', '0', '2021-03-12 00:00:00', 1, NULL, NULL, '0'),
(4, '9dcc782a-83a7-11eb-9585-f3322214fcb3', '112233', 'budi ahmad susetyo', 'L', 'tes', '0', '2021-03-13 09:55:49', 1, NULL, NULL, '1'),
(5, 'ebd3adf9-83a7-11eb-9585-f3322214fcb3', '112233442', 'aa2', 'P', 'tes2', '[\"1\",\"2\",\"3\"]', '2021-03-13 10:06:48', 1, NULL, NULL, '1'),
(6, '611835f9-83a9-11eb-9585-f3322214fcb3', '112202', 'aa2', 'P', 'tesss2', '[\"7\",\"9\",\"13\"]', '2021-03-13 10:08:54', 1, NULL, NULL, '0'),
(7, 'a23f643e-83a9-11eb-9585-f3322214fcb3', '112233', 'ust baharuddin', 'L', 'tes', '[\"4\",\"5\"]', '2021-03-14 20:36:02', 1, NULL, NULL, '0');

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
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`pelanggaran_id`),
  ADD KEY `id` (`pelanggaran_id`),
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
  ADD PRIMARY KEY (`tahfidz_id`),
  ADD KEY `tahfidz_id` (`tahfidz_id`),
  ADD KEY `tahfidz_uuid` (`tahfidz_uuid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `usersId` (`users_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `ustadz`
--
ALTER TABLE `ustadz`
  ADD PRIMARY KEY (`ustadz_id`),
  ADD KEY `ustadz_id` (`ustadz_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_ajar`
--
ALTER TABLE `bidang_ajar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `pelanggaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `santri`
--
ALTER TABLE `santri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tahfidz`
--
ALTER TABLE `tahfidz`
  MODIFY `tahfidz_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ustadz`
--
ALTER TABLE `ustadz`
  MODIFY `ustadz_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
