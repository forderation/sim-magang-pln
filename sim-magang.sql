-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sim-magang
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin PLN','admin@gmail.com','$2y$10$CrQCcHl83IanUPSNdqerK.xUKWkhLJmDruYO7B1DaabLFZqaH8yDe',NULL,NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisis`
--

DROP TABLE IF EXISTS `divisis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maksimal_kelompok` int(11) NOT NULL,
  `location_magang_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `divisis_location_magang_id_foreign` (`location_magang_id`),
  CONSTRAINT `divisis_location_magang_id_foreign` FOREIGN KEY (`location_magang_id`) REFERENCES `location_magangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisis`
--

LOCK TABLES `divisis` WRITE;
/*!40000 ALTER TABLE `divisis` DISABLE KEYS */;
INSERT INTO `divisis` VALUES (2,'Divisi IT',5,1,'2020-12-20 07:04:45','2020-12-20 07:04:45'),(3,'Divisi Maintenance',4,2,'2020-12-20 07:05:19','2020-12-20 07:05:19'),(4,'Divisi Akuntan',2,1,'2020-12-20 07:35:58','2020-12-20 07:35:58');
/*!40000 ALTER TABLE `divisis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `magang_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  KEY `groups_magang_id_foreign` (`magang_id`),
  KEY `groups_user_id_foreign` (`user_id`),
  CONSTRAINT `groups_magang_id_foreign` FOREIGN KEY (`magang_id`) REFERENCES `magangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (2,2),(2,4),(2,1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_magangs`
--

DROP TABLE IF EXISTS `location_magangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location_magangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_magangs`
--

LOCK TABLES `location_magangs` WRITE;
/*!40000 ALTER TABLE `location_magangs` DISABLE KEYS */;
INSERT INTO `location_magangs` VALUES (1,'Pasuruan','Perum. Sekar Asri Blok D-23 Kota Pas',5.2342,1234.232,'2020-12-20 05:29:16','2020-12-20 05:29:16'),(2,'Malang','Cengger Ayam',4.21,54.23,'2020-12-20 07:05:02','2020-12-20 07:05:02');
/*!40000 ALTER TABLE `location_magangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magangs`
--

DROP TABLE IF EXISTS `magangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) unsigned NOT NULL,
  `divisi_id` bigint(20) unsigned NOT NULL,
  `surat_pemohon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jangka_waktu` int(11) NOT NULL,
  `status_pengajuan` enum('diterima','ditolak','proses') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `magangs_lead_id_foreign` (`lead_id`),
  KEY `magangs_divisi_id_foreign` (`divisi_id`),
  CONSTRAINT `magangs_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `magangs_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magangs`
--

LOCK TABLES `magangs` WRITE;
/*!40000 ALTER TABLE `magangs` DISABLE KEYS */;
INSERT INTO `magangs` VALUES (2,1,4,'surat permohonan-Pasuruan-20170370121079-Kharisma Muzaki.pdf','proposal-Pasuruan-20170370121079-Kharisma Muzaki.pdf',11,'diterima','2020-12-20','2020-12-31','2020-12-20 09:19:51','2020-12-20 09:19:51'),(3,1,4,'surat permohonan-Pasuruan-20170370121079-Kharisma Muzaki.pdf','proposal-Pasuruan-20170370121079-Kharisma Muzaki.pdf',11,'diterima','2020-12-22','2021-01-02','2020-12-20 09:19:51','2020-12-20 09:19:51');
/*!40000 ALTER TABLE `magangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2020_09_03_055026_create_location_magangs_table',1),(4,'2020_09_03_055301_create_admins_table',1),(5,'2020_09_03_055425_create_surat_terbits_table',1),(6,'2020_09_03_055550_create_divisis_table',1),(7,'2020_09_03_055551_create_magangs_table',1),(8,'2020_09_03_055558_create_sertifikats_table',1),(9,'2020_09_03_055725_create_pelaksanaans_table',1),(10,'2020_09_03_061955_create_pesan_magangs_table',1),(11,'2020_12_20_114804_create_groups_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelaksanaans`
--

DROP TABLE IF EXISTS `pelaksanaans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelaksanaans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `surat_pelaksanaan_id` bigint(20) unsigned NOT NULL,
  `magang_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned NOT NULL,
  `status_magang` enum('aktif','non_aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pelaksanaans_surat_pelaksanaan_id_foreign` (`surat_pelaksanaan_id`),
  KEY `pelaksanaans_magang_id_foreign` (`magang_id`),
  KEY `pelaksanaans_admin_id_foreign` (`admin_id`),
  CONSTRAINT `pelaksanaans_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pelaksanaans_magang_id_foreign` FOREIGN KEY (`magang_id`) REFERENCES `magangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pelaksanaans_surat_pelaksanaan_id_foreign` FOREIGN KEY (`surat_pelaksanaan_id`) REFERENCES `surat_terbits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelaksanaans`
--

LOCK TABLES `pelaksanaans` WRITE;
/*!40000 ALTER TABLE `pelaksanaans` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelaksanaans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesan_magangs`
--

DROP TABLE IF EXISTS `pesan_magangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesan_magangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_user` tinyint(1) NOT NULL DEFAULT 0,
  `magang_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pesan_magangs_magang_id_foreign` (`magang_id`),
  KEY `pesan_magangs_admin_id_foreign` (`admin_id`),
  CONSTRAINT `pesan_magangs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pesan_magangs_magang_id_foreign` FOREIGN KEY (`magang_id`) REFERENCES `magangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesan_magangs`
--

LOCK TABLES `pesan_magangs` WRITE;
/*!40000 ALTER TABLE `pesan_magangs` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesan_magangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sertifikats`
--

DROP TABLE IF EXISTS `sertifikats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sertifikats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `surat_sertifikat_id` bigint(20) unsigned NOT NULL,
  `magang_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sertifikats_surat_sertifikat_id_foreign` (`surat_sertifikat_id`),
  KEY `sertifikats_magang_id_foreign` (`magang_id`),
  KEY `sertifikats_admin_id_foreign` (`admin_id`),
  CONSTRAINT `sertifikats_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sertifikats_magang_id_foreign` FOREIGN KEY (`magang_id`) REFERENCES `magangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sertifikats_surat_sertifikat_id_foreign` FOREIGN KEY (`surat_sertifikat_id`) REFERENCES `surat_terbits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sertifikats`
--

LOCK TABLES `sertifikats` WRITE;
/*!40000 ALTER TABLE `sertifikats` DISABLE KEYS */;
/*!40000 ALTER TABLE `sertifikats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surat_terbits`
--

DROP TABLE IF EXISTS `surat_terbits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat_terbits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `lokasi_simpan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `surat_terbits_nomor_surat_unique` (`nomor_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surat_terbits`
--

LOCK TABLES `surat_terbits` WRITE;
/*!40000 ALTER TABLE `surat_terbits` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_terbits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_induk` bigint(20) NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Diba Anastasyia',20170370121079,'Informatika','UMM',1,'muzaki@gmail.com','$2y$10$I.wsQ/TatQwNJxPbblwD4ext1UAIcIOIURoPTxC/eFYAmWrw92zOy','bhystP1sVCcPzr4oUDQ0NoWTMyPmfwIAb5Is3knYX9UsAoWODG5johvCPTcu','2020-12-20 07:10:56','2020-12-20 07:10:56'),(2,'Zakiyah Minahouri',2017103127637,'IT','UMM',1,'muza@gmail.com','$2y$10$mS2bGVbWjMYmZmuW7CU.CuLey0Ky0t4C7I3DSqlGHH357tSzOck7i',NULL,'2020-12-20 08:41:42','2020-12-30 11:22:20'),(3,'enawa',16725367125,'Mesin','UB',0,'enawa@gmail.com','$2y$10$9itvpAmdbFDc2.CqxcEAievBKzbZ1whiqjfSzKMxwAsSz6eI8IsPy',NULL,'2020-12-20 08:42:17','2020-12-20 08:42:17'),(4,'someelse',127836167,'acconting','STIKI',0,'someelse@gmail.com','$2y$10$k20Fm.Odw8CwetSyYMuMWeP2/zm790t6SPhGyvg342tSzJdau53oO',NULL,'2020-12-20 08:43:13','2020-12-20 08:43:13');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-04 16:36:30
