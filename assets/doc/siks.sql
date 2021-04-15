-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2021 at 07:49 AM
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
-- Table structure for table `jp`
--

CREATE TABLE `jp` (
  `jp_id` smallint(5) NOT NULL,
  `jp_kode` varchar(10) NOT NULL,
  `jp_judul` varchar(225) NOT NULL,
  `jp_bobot` tinyint(3) NOT NULL,
  `jp_grup_id` tinyint(3) NOT NULL,
  `isActive` char(1) NOT NULL COMMENT '0=active, 1=non active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jp`
--

INSERT INTO `jp` (`jp_id`, `jp_kode`, `jp_judul`, `jp_bobot`, `jp_grup_id`, `isActive`) VALUES
(1, 'A1', 'Setiap keterlambatan masuk jam pertama setelah 5 menit bel berbunyi', 2, 1, '0'),
(2, 'A2', 'Setiap keterlambatan mengikuti upacara bendera', 2, 1, '0'),
(3, 'A3', 'Setiap terlambat masuk istirahat', 1, 1, '0'),
(4, 'A4', 'Setiap izin keluar KBM berlangsung dan tidak kembali', 3, 1, '0'),
(5, 'B1', 'Setiap tidak masuk karena izin tidak syari', 1, 2, '0'),
(6, 'B2', 'Setiap tidak masuk karena tanpa keterangan (alpa)', 3, 2, '0'),
(7, 'B3', 'Setiap tidak masuk dengan membuat keterangan bohong', 10, 2, '0'),
(8, 'B4', 'Setiap membolos jam belajar awal/akhir ', 3, 2, '0'),
(9, 'B5', 'Setiap membolos tidak mengikuti kegiatan tahfidz, tahsin, ekstrakulikuler atau pramuka.', 2, 2, '0'),
(10, 'C1', 'Setiap memakai seragam sekolah tidak sesuai aturan/jadwal yang telah ditentukan ', 5, 3, '0'),
(11, 'C2', 'Setiap memakai seragam sekolah kotor & tidak rapi', 4, 3, '0'),
(12, 'C3', 'Setiap tidak mengenakan topi dan almamater pada waktu mengikuti upacara', 2, 3, '0'),
(13, 'C4', 'Setiap memakai sandal saat upacara', 2, 3, '0'),
(14, 'C5', 'Setiap memakai peci yang tidak pada jadwalnya begitupula memakai khimar bukan pada jadwalnya', 3, 3, '0'),
(15, 'C6', 'Memakasi bros/menata khimar berlebihan (akhwat)', 4, 3, '0'),
(16, 'C7', 'Setiap tidak memakasi sabuk (ikhwan)', 1, 3, '0'),
(17, 'C8', 'Setiap memakai pakaian seragam olahraga di KBM bukan penjas', 2, 3, '0'),
(18, 'D1', 'Setiap Memakai parfum yang menyengat (akhwat)', 3, 4, '0'),
(19, 'D2', 'Setiap berhias yang menonjolkan kecantikan/tabarruj (akhwat)', 2, 4, '0'),
(20, 'D3', 'Setiap santri ikhwan yang gondrong rambut melewati mati/telinga', 3, 4, '0'),
(21, 'D4', 'Setiap santri ikhwan memakai gelang/kalung/anting/tindik', 2, 4, '0'),
(22, 'D5', 'Setiap rambut dipotong tidak rapi', 3, 4, '0'),
(23, 'D6', 'Setiap rambut yang dicat selain hitam', 3, 4, '0'),
(24, 'D7', 'Setiap mengeluarkan kata-kata tidak senonoh/kasar terhadap teman', 8, 4, '0'),
(25, 'D8', 'Setiap mengeluarkan kata-kata tidak senonoh/kasar terhadap guru', 10, 4, '0'),
(26, 'D9', 'Setiap menyakiti perasaan teman/bully', 10, 4, '0'),
(27, 'D10', 'Setiap mengancam teman/guru', 25, 4, '0'),
(28, 'D11', 'Setiap mencuri', 50, 4, '0'),
(29, 'D12', 'Setiap berbohong kepada guru /orangtua', 50, 4, '0'),
(30, 'D13', 'Setiap ketahuan+terbukti berkhalwat atau berikhtilat', 50, 4, '0'),
(31, 'D14', 'Setiap melawan kepada orangtua/guru', 50, 4, '0'),
(33, 'D16', 'Setiap tidak mengikuti kegiatan wajib dilingkungan pesantren', 20, 4, '0'),
(34, 'D17', 'Keluar pada saat jam pelajaran', 20, 4, '0'),
(35, 'D18', 'Tidak mengikuti eskul', 25, 4, '0'),
(36, 'D19', 'Tidak membayarkan SPP/amanah yang dititipkan orangtua untuk pihak yang berhak', 25, 4, '0'),
(37, 'D20', 'Makan dan minum sambil berdiri / berjalan', 10, 4, '0'),
(38, 'E1', 'Setiap mengotori, mencorat coret tembok/meja/kursi sekolah', 5, 5, '0'),
(39, 'E2', 'Setiap merusak benda milik sekolah', 15, 5, '0'),
(40, 'E3', 'Setiap bermusuhan dengan teman didalam atau diluar sekolah', 15, 5, '0'),
(41, 'E4', 'Setiap membuat kegaduhan didalam kelas pada saat KBM berlangsung', 10, 5, '0'),
(42, 'E5', 'Setiap melompati pagar sekolah untuk keluar/masuk/kabur dari pesantren', 20, 5, '0'),
(43, 'E6', 'Ke kantin/jajan saat jam pelajaran', 20, 5, '0'),
(44, 'E7', 'Membuang sampah sembarangan', 15, 5, '0'),
(45, 'E8', 'Membiarkan barang pribadi tergeletak di tempat umum', 20, 5, '0'),
(46, 'F1', 'Setiap membawa rokok kedalam lingkungan pesantren', 50, 6, '0'),
(47, 'F2', 'Setiap menghisap rokok didalam/sekitar lingkungan pesantren', 50, 6, '0'),
(48, 'G1', 'Setiap membawa buku, majalah, kaset, CD dan foto yang mengandung porno', 80, 7, '0'),
(49, 'G2', 'Setiap memperjual belikan buku, majalah, kaset, CD, dan foto yang mengandung porno', 80, 7, '0'),
(50, 'G3', 'Setiap melihat foto / video yang mengandung adegan dewasa', 80, 7, '0'),
(51, 'G4', 'Membawa senjata tajam/api tanpa izin', 80, 8, '0'),
(52, 'G5', 'Memperjualbelikan sejata tajam/api', 80, 8, '0'),
(53, 'G6', 'Menggunakan senjata tajam/api untuk melukai orang', 80, 8, '0'),
(54, 'I1', 'Mabuk disekolah', 100, 9, '0'),
(55, 'I2', 'Membawa narkoba/minuman keras ke lingkungan pesantren', 100, 9, '0'),
(56, 'I3', 'Menggunakan narkoba, minuman keras didalam atau diluar lingkungan pesantren', 100, 9, '0'),
(57, 'J1', 'Berkelahi/tawuran dengan siswa sekolah lain', 50, 10, '0'),
(58, 'J2', 'Berkelahi antar santri ponpes al ihsan baron bogor dan berdampak luas', 50, 10, '0'),
(59, 'J3', 'Berkelahi antar santri ponpes al ihsan baron bogor dan tidak berdampak luas', 50, 10, '0'),
(60, 'J4', 'Setiap menjadi provokator perkelahian', 50, 10, '0'),
(61, 'K1', 'Setiap mengancam dan mengintimidasi kepala sekolah dan guru', 80, 11, '0'),
(62, 'K2', 'Menganiaya, mengeroyok ustadz / ustadzah', 80, 11, '0'),
(63, 'K3', 'Setiap menjadi provokator untuk melawan  ustadz / ustadzah', 80, 11, '0');

-- --------------------------------------------------------

--
-- Table structure for table `jp_grup`
--

CREATE TABLE `jp_grup` (
  `jp_grup_id` tinyint(3) NOT NULL,
  `jp_grup_judul` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jp_grup`
--

INSERT INTO `jp_grup` (`jp_grup_id`, `jp_grup_judul`) VALUES
(1, 'KETERLAMBATAN'),
(2, 'KEHADIRAN'),
(3, 'PAKAIAN'),
(4, 'KEPRIBADIAN'),
(5, 'KETERTIBAN'),
(6, 'MEROKOK'),
(7, 'PORNOGRAFI'),
(8, 'SENJATA TAJAM'),
(9, 'NARKOBA DAN MINUMAN KERAS'),
(10, 'BERKELAHI'),
(11, 'INTIMIDASI/ANCAMAN DENGAN KEKERASAN');

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
(1, 'c9aa229e-8c74-11eb-a999-8c8590927d1f', 5, '12', 'ketika pagi senin pas upacara', 'lupa alasan nya', 'di ingatkan dan diberikan hukuman ringan', '2021-03-24 14:44:39', 1, '2021-03-24 14:51:53', 1, '0'),
(2, 'ebd509b0-8c74-11eb-a999-8c8590927d1f', 4, '46', 'ketika pagi setelah upacara', 'bosen', 'dilaporkan kepada orang tua', '2021-03-24 14:45:36', 1, NULL, NULL, '0'),
(3, '3556cd1c-8d6f-11eb-a999-8c8590927d1f', 1, '5', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', '2021-03-25 20:37:14', 1, NULL, NULL, '0'),
(4, '3e381350-8d6f-11eb-a999-8c8590927d1f', 1, '1', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', '2021-03-25 20:37:28', 1, NULL, NULL, '0'),
(5, '59673bec-8d6f-11eb-a999-8c8590927d1f', 1, '11', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', '2021-03-25 20:38:14', 1, NULL, NULL, '0'),
(6, '7d9e5e46-8d6f-11eb-a999-8c8590927d1f', 2, '16', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', '2021-03-25 20:39:15', 1, NULL, NULL, '0'),
(7, '059021ee-8d71-11eb-a999-8c8590927d1f', 2, '8', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', '2021-03-25 20:50:12', 1, NULL, NULL, '0'),
(8, '0d9a0f26-8d71-11eb-a999-8c8590927d1f', 5, '13', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', 'lorem ipsum lorem ipsum lorem ipsum', '2021-03-25 20:50:26', 1, NULL, NULL, '0');

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
(1, 'e4d99f85-e0e6-11ea-8996-d19c9a2f1bfb', '112233445566', '0069456691', 'Abdullah Syafii', 'VII', 'M', 'Bogor', '1994-08-18', 'Islam', 'Anak Kandung', 3, 'Jl. Raya Bogor - Jakarta no 109', 'SMA Pandu', 'X', '2020-08-10', 'Mamat', 'Petani', 'Aminah', 'Ibu Rumah Tangga', 'Budiman', 'Karyawan Swasta', '2020-08-18 07:07:39', 1, '2021-03-25 21:22:40', 1, '0'),
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
(4, '0b60bb0f-8474-11eb-9585-f3322214fcb3', 'Muhammad Rahman', '9998881112', '$2y$10$TsfEBqjcc6GnMeQApuveGumCUIQw/o7ubXQ2iFVdNMrPveawXEGra', '2', '0', '2021-03-14 10:19:10', 'Yayi Suaidah', '2021-03-14 10:51:17', 'Yayi Suaidah', '0'),
(5, '7acd0b6f-8478-11eb-9585-f3322214fcb3', 'sobur', '1122', '$2y$10$CpD09nBKIhlSDU9DDGVOjuv0rGKAxgJb1gjUpjy81wM1mjtEGI0ym', '1', '0', '2021-03-14 10:50:55', 'Yayi Suaidah', '2021-03-14 10:51:13', 'Yayi Suaidah', '1'),
(6, '454584e6-84cd-11eb-9585-f3322214fcb3', 'H. Lupiyanto, S.E., M.Pd', '3271040502790029', '$2y$10$noYHwmKmLDaH7TvPlmU3Subs0InzI2mU5fKcmrbQJIxHsIxW/YtGS', '1', '0', '2021-03-14 20:57:52', 'Yayi Suaidah', '2021-03-14 21:07:24', 'Yayi Suaidah', '0');

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
-- Indexes for table `jp`
--
ALTER TABLE `jp`
  ADD PRIMARY KEY (`jp_id`),
  ADD UNIQUE KEY `jp_id` (`jp_id`),
  ADD KEY `jp_id_2` (`jp_id`);

--
-- Indexes for table `jp_grup`
--
ALTER TABLE `jp_grup`
  ADD PRIMARY KEY (`jp_grup_id`),
  ADD UNIQUE KEY `jp_grup_id` (`jp_grup_id`),
  ADD KEY `jp_grup_id_2` (`jp_grup_id`);

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
-- AUTO_INCREMENT for table `jp`
--
ALTER TABLE `jp`
  MODIFY `jp_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `jp_grup`
--
ALTER TABLE `jp_grup`
  MODIFY `jp_grup_id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `pelanggaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
