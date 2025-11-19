-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_forumkelas
CREATE DATABASE IF NOT EXISTS `db_forumkelas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_forumkelas`;

-- Dumping structure for table db_forumkelas.tb_absensi
CREATE TABLE IF NOT EXISTS `tb_absensi` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `isHadir` enum('H','S','I','T','D') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `FK` (`nama_lengkap`),
  CONSTRAINT `FK` FOREIGN KEY (`nama_lengkap`) REFERENCES `tb_siswa` (`nama_lengkap`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_forumkelas.tb_absensi: ~5 rows (approximately)
INSERT IGNORE INTO `tb_absensi` (`id_log`, `nama_lengkap`, `tanggal`, `isHadir`) VALUES
	(1, 'Adhisti Dibya Puspika', '2025-11-17', 'D'),
	(2, 'Angeliana Putricia Andrea S.', '2025-11-17', 'S'),
	(3, 'Davina Aulia Putri AA', '2025-11-17', 'I'),
	(4, 'Natalie Angelia Edeni', '2025-11-17', 'H'),
	(5, 'Sri Ramadhania Scientia S.H.', '2025-11-17', 'T');

-- Dumping structure for table db_forumkelas.tb_jadwal
CREATE TABLE IF NOT EXISTS `tb_jadwal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hari` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `mapel1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `mapel2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mapel3` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mapel4` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mapel5` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mapel6` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_forumkelas.tb_jadwal: ~1 rows (approximately)
INSERT IGNORE INTO `tb_jadwal` (`id`, `hari`, `mapel1`, `mapel2`, `mapel3`, `mapel4`, `mapel5`, `mapel6`) VALUES
	(1, 'Senin', 'PTGM', 'MULOK', NULL, NULL, NULL, NULL);

-- Dumping structure for table db_forumkelas.tb_kas
CREATE TABLE IF NOT EXISTS `tb_kas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `jumlah_tunggakan` double DEFAULT NULL,
  `jumlah_bayar` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tb_kas_tb_siswa` (`nama_lengkap`),
  CONSTRAINT `FK_tb_kas_tb_siswa` FOREIGN KEY (`nama_lengkap`) REFERENCES `tb_siswa` (`nama_lengkap`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_forumkelas.tb_kas: ~5 rows (approximately)
INSERT IGNORE INTO `tb_kas` (`id`, `nama_lengkap`, `tanggal_bayar`, `jumlah_tunggakan`, `jumlah_bayar`) VALUES
	(1, 'Sri Ramadhania Scientia S.H.', '2025-11-17', 0, 2000),
	(2, 'Adhisti Dibya Puspika', '2025-11-17', 2000, 2000),
	(3, 'Angeliana Putricia Andrea S.', '2025-11-17', 10000, 50000),
	(4, 'Davina Aulia Putri AA', '2025-11-17', 3000, 10000),
	(5, 'Natalie Angelia Edeni', '2025-11-17', 2000, 300000);

-- Dumping structure for table db_forumkelas.tb_pengeluaran
CREATE TABLE IF NOT EXISTS `tb_pengeluaran` (
  `id_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_forumkelas.tb_pengeluaran: ~1 rows (approximately)
INSERT IGNORE INTO `tb_pengeluaran` (`id_pengeluaran`, `tanggal`, `keterangan`, `jumlah`) VALUES
	(1, '2025-11-17', 'basreng @5k *4', 20000);

-- Dumping structure for table db_forumkelas.tb_pengumuman
CREATE TABLE IF NOT EXISTS `tb_pengumuman` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `pengumuman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sumber` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_forumkelas.tb_pengumuman: ~0 rows (approximately)

-- Dumping structure for table db_forumkelas.tb_siswa
CREATE TABLE IF NOT EXISTS `tb_siswa` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_absen` int NOT NULL,
  PRIMARY KEY (`id_siswa`),
  UNIQUE KEY `nama_lengkap` (`nama_lengkap`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_forumkelas.tb_siswa: ~5 rows (approximately)
INSERT IGNORE INTO `tb_siswa` (`id_siswa`, `username`, `nama_lengkap`, `password`, `no_absen`) VALUES
	(1, 'scientia', 'Sri Ramadhania Scientia S.H.', '12345678', 30),
	(2, 'angel', 'Angeliana Putricia Andrea S.', '12345678', 14),
	(3, 'natalie', 'Natalie Angelia Edeni', '12345678', 29),
	(4, 'adhisti', 'Adhisti Dibya Puspika', '12345678', 2),
	(5, 'davina', 'Davina Aulia Putri AA', '12345678', 21);

-- Dumping structure for table db_forumkelas.tb_tugas
CREATE TABLE IF NOT EXISTS `tb_tugas` (
  `id` int DEFAULT NULL,
  `mapel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tugas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `tanggal` date DEFAULT NULL,
  `batas_pengumpulan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_forumkelas.tb_tugas: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
