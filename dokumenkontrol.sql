-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table dokumenkontrol.dc_controller
CREATE TABLE IF NOT EXISTS `dc_controller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `is_menu` smallint(1) NOT NULL,
  `is_active` smallint(1) NOT NULL,
  `urutan` int(2) DEFAULT NULL,
  `apps` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_controller: ~10 rows (approximately)
DELETE FROM `dc_controller`;
INSERT INTO `dc_controller` (`id`, `title`, `url`, `icon`, `is_menu`, `is_active`, `urutan`, `apps`) VALUES
	(1, 'Home', 'home', 'fas fa-home fa-fw', 1, 1, 1, NULL),
	(2, 'Users', 'user', 'fas fa-users-cog fa-fw', 1, 1, 7, NULL),
	(6, 'Profile', 'profile', 'fas fa-fw fa-user-circle', 0, 1, 10, NULL),
	(7, 'Divisi', 'divisi', 'fas fa-industry fa-fw', 1, 1, 5, NULL),
	(8, 'Role Access', 'role', 'fas fa-cogs fa-fw', 1, 1, 8, NULL),
	(10, 'Menu', 'controller', 'fas fa-globe fa-fw', 1, 1, 9, NULL),
	(18, 'Archive Document', 'document', 'fas fa-file-archive fa-fw', 1, 1, 3, NULL),
	(19, 'Jenis Surat', 'jenis', 'fas fa-file-alt fa-fw', 1, 1, 6, NULL),
	(20, 'Post Document', 'postdocument', 'fas fa-pencil-alt fa-fw', 1, 1, 2, NULL),
	(21, 'Share Document', 'sharedocument', 'fas fa-share-alt-square fa-fw', 1, 1, 4, NULL);

-- Dumping structure for table dokumenkontrol.dc_detail_dokumen
CREATE TABLE IF NOT EXISTS `dc_detail_dokumen` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(100) NOT NULL,
  `tanggal_revisi` datetime NOT NULL,
  `revisi` int(2) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `file_path` varchar(100) NOT NULL,
  `size` int(20) NOT NULL,
  `catatan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_detail_dokumen: ~2 rows (approximately)
DELETE FROM `dc_detail_dokumen`;
INSERT INTO `dc_detail_dokumen` (`id`, `no_surat`, `tanggal_revisi`, `revisi`, `id_user`, `status`, `nama_file`, `file_path`, `size`, `catatan`) VALUES
	(11, '054/BMI/I/23HQML', '2023-03-29 10:45:40', 0, 'e295f90a775c7241', 'aktif', '054-BMI-I-23HQML-ORIGINAL.pdf', 'file/pdf', 57482, NULL),
	(12, 'TKD-23/III/HRD/SPPDL-001', '2023-03-30 09:36:05', 0, 'e295f90a775c7241', 'aktif', 'TKD-23-III-HRD-SPPDL-001-ORIGINAL.pdf', 'file/pdf', 70033, NULL);

-- Dumping structure for table dokumenkontrol.dc_distribusi_dokumen
CREATE TABLE IF NOT EXISTS `dc_distribusi_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(100) NOT NULL,
  `kd_divisi` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_distribusi_dokumen: ~2 rows (approximately)
DELETE FROM `dc_distribusi_dokumen`;
INSERT INTO `dc_distribusi_dokumen` (`id`, `no_surat`, `kd_divisi`) VALUES
	(94, 'TKD-23/III/HRD/SPPDL-001', 'DIV02'),
	(95, 'TKD-23/III/HRD/SPPDL-001', 'DIV09');

-- Dumping structure for table dokumenkontrol.dc_divisi
CREATE TABLE IF NOT EXISTS `dc_divisi` (
  `kd_divisi` varchar(20) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL,
  `alias` varchar(5) NOT NULL,
  PRIMARY KEY (`kd_divisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_divisi: ~11 rows (approximately)
DELETE FROM `dc_divisi`;
INSERT INTO `dc_divisi` (`kd_divisi`, `nama_divisi`, `alias`) VALUES
	('DIV01', 'Warehouse', 'WH'),
	('DIV02', 'General Affair Umum', 'GA'),
	('DIV03', 'General Affair Bengkel', 'GB'),
	('DIV04', 'PPIC', 'PI'),
	('DIV05', 'Information Technology', 'IT'),
	('DIV06', 'Sales', 'SS'),
	('DIV07', 'Human Resource Department', 'HR'),
	('DIV08', 'Finance and Accounting', 'FA'),
	('DIV09', 'Marketing', 'MK'),
	('DIV15', 'Sales Online', 'SO'),
	('DIV16', 'Direksi', 'DR');

-- Dumping structure for table dokumenkontrol.dc_dokumen
CREATE TABLE IF NOT EXISTS `dc_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(100) NOT NULL,
  `kd_divisi` varchar(20) NOT NULL,
  `type` varchar(55) NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `jenis_surat` varchar(20) NOT NULL,
  `asal_surat` varchar(50) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `lampiran` varchar(150) NOT NULL,
  `kepada` varchar(150) NOT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `nama_file` varchar(150) NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `size` int(20) DEFAULT NULL,
  `id_user` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL COMMENT 'aktif, expired, revisi',
  `qrcode` varchar(200) DEFAULT NULL,
  `revisi` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_dokumen: ~2 rows (approximately)
DELETE FROM `dc_dokumen`;
INSERT INTO `dc_dokumen` (`id`, `no_surat`, `kd_divisi`, `type`, `judul`, `jenis_surat`, `asal_surat`, `tanggal_surat`, `perihal`, `lampiran`, `kepada`, `keterangan`, `nama_file`, `file_path`, `size`, `id_user`, `created_at`, `updated_at`, `updated_by`, `status`, `qrcode`, `revisi`) VALUES
	(15, '054/BMI/I/23HQML', 'DIV01', 'Surat Keluar', NULL, 'LN', 'Ardi WH', '2023-03-29', 'Laporan Penerimaan Barang', 'Surat Jalan', 'Admin Stock', 'Laporan Serah terima barang dengan No BL. 010/BL/XII/22I', '054-BMI-I-23HQML-ORIGINAL.pdf', 'file/pdf', 57482, 'e295f90a775c7241', '2023-03-29 10:45:40', '2023-03-29 12:51:17', 'e295f90a775c7241', NULL, NULL, 0),
	(16, 'TKD-23/III/HRD/SPPDL-001', 'DIV05', 'Surat Keluar', NULL, 'IM', 'Emi HRD', '2023-03-30', 'Surat Perintah Perjalanan Dinas Luar Kota', '-', 'Susanto', 'Surat tugas luar kota ke Surabaya', 'TKD-23-III-HRD-SPPDL-001-ORIGINAL.pdf', 'file/pdf', 70033, 'e295f90a775c7241', '2023-03-30 09:36:05', NULL, NULL, NULL, NULL, 0);

-- Dumping structure for table dokumenkontrol.dc_header_surat
CREATE TABLE IF NOT EXISTS `dc_header_surat` (
  `id` varchar(20) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `logo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_header_surat: ~4 rows (approximately)
DELETE FROM `dc_header_surat`;
INSERT INTO `dc_header_surat` (`id`, `nama_perusahaan`, `logo`) VALUES
	('FI', 'PT. FIRMAN INDONESIA', 'firman-indonesia.png'),
	('TG', 'TECKINDO’78 GROUP', 'teckindo-group.png'),
	('TPGJ', 'PT. TECKINDO PRIMA GEMILANG JAYA', 'teckindo-prima-gemilang-jaya.png'),
	('TPI', 'PT. TECKINDO PRIMA INOVASI', 'teckindo-prima-inovasi.png');

-- Dumping structure for table dokumenkontrol.dc_jenis_surat
CREATE TABLE IF NOT EXISTS `dc_jenis_surat` (
  `kd_jenis` varchar(20) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `url_menu` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_jenis_surat: ~8 rows (approximately)
DELETE FROM `dc_jenis_surat`;
INSERT INTO `dc_jenis_surat` (`kd_jenis`, `jenis`, `url_menu`) VALUES
	('BAE', 'Berita Acara External', 'berita-acara-external'),
	('BAI', 'Berita Acara Internal', 'berita-acara-internal'),
	('BAM', 'Berita Acara Manual', 'berita-acara-manual'),
	('DR', 'Dokumen Confidential', 'dokumen-confidential'),
	('IM', 'Internal Memo', 'internal-memo'),
	('LN', 'Lain lain', 'lain-lain'),
	('PR', 'Promo', 'promo'),
	('SK', 'Surat Ketetapan', 'surat-ketetapan');

-- Dumping structure for table dokumenkontrol.dc_lampiran
CREATE TABLE IF NOT EXISTS `dc_lampiran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(100) NOT NULL,
  `nama_lampiran` varchar(200) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_lampiran: ~0 rows (approximately)
DELETE FROM `dc_lampiran`;

-- Dumping structure for table dokumenkontrol.dc_post_dokumen
CREATE TABLE IF NOT EXISTS `dc_post_dokumen` (
  `no_surat` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `header` varchar(100) NOT NULL,
  `perihal` varchar(150) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `salam` varchar(150) NOT NULL,
  `isi_surat` text NOT NULL,
  `revisi` int(2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `arsip` int(2) NOT NULL COMMENT '0 = belum diarsipkan, 1 = sudah diarsipkan',
  `create_at` datetime NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_post_dokumen: ~0 rows (approximately)
DELETE FROM `dc_post_dokumen`;

-- Dumping structure for table dokumenkontrol.dc_role
CREATE TABLE IF NOT EXISTS `dc_role` (
  `id` varchar(10) NOT NULL,
  `role` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table dokumenkontrol.dc_role: ~3 rows (approximately)
DELETE FROM `dc_role`;
INSERT INTO `dc_role` (`id`, `role`) VALUES
	('ADM', 'administrator'),
	('DR', 'direktur'),
	('USR', 'user');

-- Dumping structure for table dokumenkontrol.dc_user
CREATE TABLE IF NOT EXISTS `dc_user` (
  `id_user` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `alias` varchar(10) DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL,
  `tgl_register` datetime NOT NULL,
  `profile` varchar(30) NOT NULL,
  `jwt` varchar(200) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  `create_by` varchar(100) NOT NULL,
  `kd_divisi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dokumenkontrol.dc_user: ~4 rows (approximately)
DELETE FROM `dc_user`;
INSERT INTO `dc_user` (`id_user`, `username`, `nama_user`, `alias`, `role`, `password`, `tgl_register`, `profile`, `jwt`, `is_active`, `last_activity`, `create_by`, `kd_divisi`) VALUES
	('27ee769b06cae129', 'indra', 'Indra Kurniawan', 'IND', 'DR', '464b60f36fd2c847e559f5365fa1f2caab67167f', '2023-03-30 13:11:17', 'default.jpg', NULL, 1, NULL, 'e295f90a775c7241', 'DIV16'),
	('d12c4e9cdee9df14', 'rury', 'Rury Marketing', 'RR', 'USR', '464b60f36fd2c847e559f5365fa1f2caab67167f', '2023-03-30 13:09:01', 'default.jpg', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InJ1cnkiLCJyb2xlIjoiVVNSIiwiaWRfbG9naW4iOiJmMDQ4ZmQ2NWNjZDQ3NTBhZWM2ZTk2NWEyZjk0NzU0YiJ9.khnfV8Ee4HhW--ctdUSkCeKjQLRGMynAvnsKxVI3ORo', 1, NULL, '27ee769b06cae129', 'DIV09'),
	('e295f90a775c7241', 'susanto', 'Susanto', 'SAN', 'ADM', '464b60f36fd2c847e559f5365fa1f2caab67167f', '2023-03-30 13:11:21', 'default.jpg', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InN1c2FudG8iLCJyb2xlIjoiQURNIiwiaWRfbG9naW4iOiJmMDFmYzFlNjQ2OTg1ZWMxZTNmYjgxN2U4MDM2NzQ3ZSJ9.lqejFsP3k42qZEzW2ejk-uRjMkVZd6suhi5aLB3a6Bk', 1, NULL, '', 'DIV05'),
	('f1c868b74b59f2a4', 'wahyu', 'Wahyu GA', 'WHY', 'USR', '464b60f36fd2c847e559f5365fa1f2caab67167f', '2023-03-30 13:04:47', 'default.jpg', NULL, 1, NULL, '27ee769b06cae129', 'DIV02');

-- Dumping structure for table dokumenkontrol.dc_user_acces
CREATE TABLE IF NOT EXISTS `dc_user_acces` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(10) NOT NULL DEFAULT '',
  `controller` int(3) NOT NULL,
  `create_data` tinyint(4) DEFAULT NULL,
  `update_data` tinyint(4) DEFAULT NULL,
  `delete_data` tinyint(4) DEFAULT NULL,
  `print_data` tinyint(4) DEFAULT NULL,
  `import_data` tinyint(4) DEFAULT NULL,
  `apps` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_role` (`role`),
  KEY `id_menu` (`controller`)
) ENGINE=InnoDB AUTO_INCREMENT=2066 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table dokumenkontrol.dc_user_acces: ~20 rows (approximately)
DELETE FROM `dc_user_acces`;
INSERT INTO `dc_user_acces` (`id`, `role`, `controller`, `create_data`, `update_data`, `delete_data`, `print_data`, `import_data`, `apps`) VALUES
	(2046, 'ADM', 21, NULL, NULL, NULL, NULL, NULL, NULL),
	(2047, 'ADM', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2048, 'ADM', 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(2049, 'ADM', 18, NULL, NULL, NULL, NULL, NULL, NULL),
	(2050, 'ADM', 7, NULL, NULL, NULL, NULL, NULL, NULL),
	(2051, 'ADM', 19, NULL, NULL, NULL, NULL, NULL, NULL),
	(2052, 'ADM', 2, NULL, NULL, NULL, NULL, NULL, NULL),
	(2053, 'ADM', 8, NULL, NULL, NULL, NULL, NULL, NULL),
	(2054, 'ADM', 10, NULL, NULL, NULL, NULL, NULL, NULL),
	(2055, 'ADM', 6, NULL, NULL, NULL, NULL, NULL, NULL),
	(2056, 'DR', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2057, 'DR', 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(2058, 'DR', 18, NULL, NULL, NULL, NULL, NULL, NULL),
	(2059, 'DR', 7, NULL, NULL, NULL, NULL, NULL, NULL),
	(2060, 'DR', 19, NULL, NULL, NULL, NULL, NULL, NULL),
	(2061, 'DR', 2, NULL, NULL, NULL, NULL, NULL, NULL),
	(2062, 'USR', 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(2063, 'USR', 20, NULL, NULL, NULL, NULL, NULL, NULL),
	(2064, 'USR', 18, NULL, NULL, NULL, NULL, NULL, NULL),
	(2065, 'USR', 21, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
