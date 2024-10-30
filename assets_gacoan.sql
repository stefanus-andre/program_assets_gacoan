-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 05:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assets_gacoan`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_assets`
--

CREATE TABLE `a_assets` (
  `id` int(11) NOT NULL,
  `a_opssm` varchar(255) DEFAULT NULL,
  `a_opssmdate` datetime DEFAULT NULL,
  `a_reviewtaf` varchar(255) DEFAULT NULL,
  `a_tafdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_approval`
--

CREATE TABLE `mc_approval` (
  `approval_id` int(11) NOT NULL,
  `approval_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_asset_checklist`
--

CREATE TABLE `mc_asset_checklist` (
  `asset_checklist_id` int(11) NOT NULL,
  `asset_checklist_name` varchar(255) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `control_id` int(11) NOT NULL,
  `asset_checklist_desc` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_asset_mtc`
--

CREATE TABLE `mc_asset_mtc` (
  `asset_mtc_id` int(11) NOT NULL,
  `asset_mtc_name` varchar(255) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `mtc_id` int(11) NOT NULL,
  `asset_mtc_desc` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_bom_detail`
--

CREATE TABLE `mc_bom_detail` (
  `bom_det_id` int(11) NOT NULL,
  `bom_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_bom_header`
--

CREATE TABLE `mc_bom_header` (
  `bom_id` int(11) NOT NULL,
  `bom_name` varchar(255) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `bom_desc` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_mtc`
--

CREATE TABLE `mc_mtc` (
  `mtc_conf_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mc_notif`
--

CREATE TABLE `mc_notif` (
  `notif_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_28_145528_create_user_models_table', 1),
(5, '2024_09_28_163818_create_m_user_table', 1),
(6, '2024_10_03_110231_create_permission_tables', 1),
(7, '2024_10_07_012808_create_m_condition_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_assets`
--

CREATE TABLE `m_assets` (
  `asset_id` int(11) NOT NULL,
  `asset_code` varchar(255) NOT NULL,
  `asset_model` varchar(255) NOT NULL,
  `asset_quantity` int(11) NOT NULL,
  `asset_status` varchar(100) NOT NULL,
  `asset_image` varchar(255) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_assets`
--

INSERT INTO `m_assets` (`asset_id`, `asset_code`, `asset_model`, `asset_quantity`, `asset_status`, `asset_image`, `create_date`, `modified_date`, `create_by`, `modified_by`, `priority_id`, `cat_id`, `type_id`, `uom_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `qr_code_path`) VALUES
(107, 'coba1', 'coba1', 10, 'coba1', 'coba1', '2024-10-01 08:35:10', '2024-10-01 08:35:10', 'coba1', 'coba1', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2024-10-01 08:35:10', 'coba1'),
(108, 'coba1', 'coba1', 10, 'coba1', 'coba1', '2024-10-01 08:35:10', '2024-10-01 08:35:10', 'coba1', 'coba1', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2024-10-01 08:35:10', 'coba1'),
(109, 'coba1', 'coba1', 10, 'coba1', 'coba1', '2024-10-01 08:35:10', '2024-10-01 08:35:10', 'coba1', 'coba1', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2024-10-01 08:35:10', 'coba1'),
(110, 'AST-01-10-2024-7718', 'test 1', 10, 'NOT PRIORITY', 'http://127.0.0.1:8000/storage/assets/asset_images/uNVuNGjcawn6lv95uEecx4ZSslE90p6FtsNl7fGK.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-01 02:22:33', '2024-10-01 02:22:33', NULL, 'http://127.0.0.1:8000/storage/assets/qrcodes/AST-01-10-2024-7718.png'),
(111, 'AST-03-10-2024-5487', 'test 2', 2, 'PRIORITY', 'http://127.0.0.1:8000/storage/assets/asset_images/Qz0hiPTZpejL7PlylN5QQx23wAR6MWp07nI7Lvnm.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-03 02:32:59', '2024-10-03 02:32:59', NULL, 'http://127.0.0.1:8000/storage/assets/qrcodes/AST-03-10-2024-5487.png'),
(112, 'AST-03-10-2024-7494', 'test 3', 3, 'NOT PRIORITY', 'http://127.0.0.1:8000/storage/assets/asset_images/OmbmcovwoCPa6HSFEVfN2BOI6iZtt3Kc8IrlpaQZ.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-03 02:37:29', '2024-10-03 02:37:29', NULL, 'http://127.0.0.1:8000/storage/assets/qrcodes/AST-03-10-2024-7494.png'),
(113, 'AST-03-10-2024-5037', 'test 4', 4, 'BASIC', 'http://127.0.0.1:8000/storage/assets/asset_images/Ooiw4XP7Bwsi5zW3keupVL2jEHbH2THLddx5dsf3.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-03 02:44:04', '2024-10-03 02:44:04', NULL, 'http://127.0.0.1:8000/storage/assets/qrcodes/AST-03-10-2024-5037.png'),
(114, 'AST-03-10-2024-3688', 'test 6', 6, 'NOT PRIORITY', 'http://127.0.0.1:8000/storage/assets/asset_images/n1HsPGi4sIJbwkC6UY5qESvnB2YNhuica4uSVwFO.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-03 02:51:48', '2024-10-03 02:51:48', NULL, 'http://127.0.0.1:8000/storage/assets/qrcodes/AST-03-10-2024-3688.png'),
(115, 'AST-03-10-2024-9450', 'test 7', 7, 'NOT PRIORITY', 'http://127.0.0.1:8000/storage/assets/asset_images/amTA0HOK4ABICNITzgRpTp9AFcOkBqeqHLRLJf6W.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-03 02:56:15', '2024-10-03 02:56:15', NULL, 'http://127.0.0.1:8000/storage/assets/qrcodes/AST-03-10-2024-9450.png'),
(116, 'AST-03-10-2024-7395', 'test 9', 9, 'BASIC', 'http://127.0.0.1:8000/storage/assets/asset_images/ba2gvauxoizYRcpI1yXVH3PENdevS61N8YxjgHaF.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-03 02:57:27', '2024-10-03 02:57:27', NULL, 'http://127.0.0.1:8000/storage/assets/qrcodes/AST-03-10-2024-7395.png'),
(117, 'AST-03-10-2024-7382', 'test 11', 11, 'NOT PRIORITY', 'http://127.0.0.1:8000/storage/assets/asset_images/RZhhbGXlE07Ad5LCnMIrUlcX9bjUdNP1tSMlEfjr.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-03 02:58:30', '2024-10-03 02:58:30', NULL, 'http://127.0.0.1:8000/storage/assets/qrcodes/AST-03-10-2024-7382.png'),
(118, 'AST-16-10-2024-3690', 'laptop A', 5467, 'bhjk', 'bhjn', '2024-10-16 08:23:12', NULL, 'admin', NULL, 9878, 789, 890, 980, NULL, '2024-10-16 08:23:12', '2024-10-16 08:23:12', NULL, NULL),
(119, 'AST-17-10-2024-6122', 'kmjih', 5, 'uhnjm', 'hjn', '2024-10-17 07:51:01', NULL, 'admin', NULL, 2, 1, 1, 1, NULL, '2024-10-17 07:51:01', '2024-10-17 07:51:01', NULL, NULL),
(120, 'AST-17-10-2024-9538', 'pc', 10, 'baik', 'gambar', '2024-10-17 07:55:00', NULL, 'admin', NULL, 1, 1, 1, 1, NULL, '2024-10-17 07:55:00', '2024-10-17 07:55:00', NULL, NULL),
(121, 'AST-17-10-2024-3546', 'tes', 1, 'tes', 'tes', '2024-10-17 07:58:34', NULL, 'admin', NULL, 3, 1, 1, 1, NULL, '2024-10-17 07:58:34', '2024-10-17 07:58:34', NULL, NULL),
(122, 'AST-17-10-2024-4771', 'p', 9, 'p', 'p', '2024-10-17 08:11:10', NULL, 'admin', NULL, 1, 1, 1, 1, NULL, '2024-10-17 08:11:10', '2024-10-17 08:11:10', NULL, NULL),
(123, 'AST-17-10-2024-4771', 'p', 9, 'p', 'p', '2024-10-17 08:13:39', NULL, 'admin', NULL, 1, 1, 1, 1, NULL, '2024-10-17 08:13:39', '2024-10-17 08:13:39', NULL, NULL),
(124, 'AST-17-10-2024-4771', 'p', 9, 'p', 'p', '2024-10-17 08:13:40', NULL, 'admin', NULL, 1, 1, 1, 1, NULL, '2024-10-17 08:13:40', '2024-10-17 08:13:40', NULL, NULL),
(125, 'AST-17-10-2024-4771', 'p', 9, 'p', 'p', '2024-10-17 08:13:40', NULL, 'admin', NULL, 1, 1, 1, 1, NULL, '2024-10-17 08:13:40', '2024-10-17 08:13:40', NULL, NULL),
(126, 'AST-17-10-2024-6782', 'l', 8, 'l', 'l', '2024-10-17 08:13:58', NULL, 'admin', NULL, 1, 1, 1, 1, NULL, '2024-10-17 08:13:58', '2024-10-17 08:13:58', NULL, NULL),
(127, 'AST-17-10-2024-2834', 'o', 1, 'o', 'o', '2024-10-17 08:23:13', NULL, 'admin', NULL, 2, 1, 1, 1, NULL, '2024-10-17 08:23:13', '2024-10-17 08:23:13', NULL, NULL),
(129, 'AST-17-10-2024-3692', 'm', 3, 'm', 'm', '2024-10-17 09:38:26', NULL, 'admin', NULL, 1, 1, 1, 1, NULL, '2024-10-17 09:38:26', '2024-10-17 09:38:26', NULL, NULL),
(131, 'AST-21-10-2024-1982', 'a', 1, 'a', 'assets/images/1729492621.png', '2024-10-21 06:37:01', NULL, 'admin', NULL, 3, 1, 2, 2, NULL, '2024-10-21 06:37:01', '2024-10-21 06:37:01', NULL, NULL),
(132, 'AST-21-10-2024-2868', 'k', 1, 'k', 'assets/images/1729496495.jpeg', '2024-10-21 07:41:35', NULL, 'admin', NULL, 3, 1, 2, 2, NULL, '2024-10-21 07:41:35', '2024-10-21 07:41:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_brand`
--

CREATE TABLE `m_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_brand`
--

INSERT INTO `m_brand` (`brand_id`, `brand_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'abc1', '2024-10-09 03:41:42', '2024-10-21 03:21:01', 'admin', 'admin', NULL),
(2, 'def', '2024-10-09 03:46:22', '2024-10-10 04:45:03', 'admin', 'admin', NULL),
(4, 'jkl', '2024-10-09 03:49:02', NULL, 'admin', NULL, NULL),
(5, 'mno', '2024-10-09 03:52:48', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_category`
--

CREATE TABLE `m_category` (
  `cat_id` int(11) NOT NULL,
  `cat_code` varchar(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_category`
--

INSERT INTO `m_category` (`cat_id`, `cat_code`, `cat_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'ELT', 'Elektronik', '2024-10-16 10:16:23', NULL, 'admin', NULL, NULL),
(2, 'BRG', 'Barang Barang', '2024-10-20 07:03:21', '2024-10-21 09:34:27', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_checklist`
--

CREATE TABLE `m_checklist` (
  `checklist_id` int(11) NOT NULL,
  `checklist_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_checklist`
--

INSERT INTO `m_checklist` (`checklist_id`, `checklist_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'checklist 123', '2024-10-20 07:54:20', '2024-10-21 03:21:30', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_city`
--

CREATE TABLE `m_city` (
  `city_id` int(11) NOT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `city` varchar(512) DEFAULT NULL,
  `ct` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_city`
--

INSERT INTO `m_city` (`city_id`, `provinsi`, `city`, `ct`, `create_date`, `modified_date`, `create_by`, `modified_by`) VALUES
(1, 'Jawa Barat', 'BANDUNG', 'BDG', NULL, NULL, NULL, NULL),
(2, 'Jawa Timur', 'BATU', 'BT', NULL, NULL, NULL, NULL),
(3, 'Jawa Barat', 'BEKASI', 'BKS', NULL, NULL, NULL, NULL),
(4, 'Jawa Timur', 'BLITAR', 'BLTR', NULL, NULL, NULL, NULL),
(5, 'Jawa Barat', 'BOGOR', 'BGR', NULL, NULL, NULL, NULL),
(6, 'Jawa Timur', 'BOJONEGORO', 'BJNGR', NULL, NULL, NULL, NULL),
(7, 'Jawa Barat', 'CIAMIS', 'CIMS', NULL, NULL, NULL, NULL),
(8, 'Jawa Barat', 'CIANJUR', 'CINJR', NULL, NULL, NULL, NULL),
(9, 'Jawa Barat', 'CIKARANG', 'CIKRG', NULL, NULL, NULL, NULL),
(10, 'Jawa Barat', 'CILACAP', 'CILCP', NULL, NULL, NULL, NULL),
(11, 'Jawa Barat', 'CIMAHI', 'CIMH', NULL, NULL, NULL, NULL),
(12, 'Jawa Barat', 'CIREBON', 'CIRBN', NULL, NULL, NULL, NULL),
(13, 'Jawa Barat', 'DEPOK', 'DPK', NULL, NULL, NULL, NULL),
(14, 'Jawa Timur', 'GRESIK', 'GRSK', NULL, NULL, NULL, NULL),
(15, 'Daerah Istimewa Jakarta', 'JAKARTA', 'JKT', NULL, NULL, NULL, NULL),
(16, 'Jawa Timur', 'JEMBER', 'JMBR', NULL, NULL, NULL, NULL),
(17, 'Jawa Timur', 'JOMBANG', 'JMBG', NULL, NULL, NULL, NULL),
(18, 'Jawa Barat', 'KARAWANG', 'KRWG', NULL, NULL, NULL, NULL),
(19, 'Jawa Timur', 'KEDIRI', 'KDR', NULL, NULL, NULL, NULL),
(20, 'Jawa Tengah', 'KLATEN', 'KLTN', NULL, NULL, NULL, NULL),
(21, 'Jawa Tengah', 'KUDUS', 'KDS', NULL, NULL, NULL, NULL),
(22, 'Jawa Timur', 'LAMONGAN', 'LMGN', NULL, NULL, NULL, NULL),
(23, 'Jawa Timur', 'MADIUN', 'MDN', NULL, NULL, NULL, NULL),
(24, 'Jawa Tengah', 'MAGELANG', 'MGLG', NULL, NULL, NULL, NULL),
(26, 'Jawa Timur', 'MALANG', 'MLG', NULL, NULL, NULL, NULL),
(27, 'Jawa Timur', 'MOJOKERTO', 'MJKRT', NULL, NULL, NULL, NULL),
(28, 'Jawa Tengah', 'NGAWI', 'NGWI', NULL, NULL, NULL, NULL),
(29, 'Jawa Timur', 'PAMEKASAN', 'PMKSN', NULL, NULL, NULL, NULL),
(30, 'Jawa Timur', 'PASURUAN', 'PSRN', NULL, NULL, NULL, NULL),
(31, 'Jawa Tengah', 'PEKALONGAN', 'PKLGN', NULL, NULL, NULL, NULL),
(32, 'Jawa Timur', 'PONOROGO', 'PNRGO', NULL, NULL, NULL, NULL),
(33, 'Jawa Timur', 'PROBOLINGGO', 'PROBLGO', NULL, NULL, NULL, NULL),
(34, 'Jawa Tengah', 'PURBALINGGA', 'PURBLGA', NULL, NULL, NULL, NULL),
(35, 'Jawa Tengah', 'PURWAKARTA', 'PRWKRTA', NULL, NULL, NULL, NULL),
(36, 'Jawa Tengah', 'PURWOKERTO', 'PRWKRTO', NULL, NULL, NULL, NULL),
(37, 'Jawa Tengah', 'SALATIGA', 'SLTG', NULL, NULL, NULL, NULL),
(38, 'Jawa Tengah', 'SEMARANG', 'SMRG', NULL, NULL, NULL, NULL),
(39, 'Jawa Timur', 'SIDOARJO', 'SDRJ', NULL, NULL, NULL, NULL),
(40, 'Jawa Tengah', 'SLEMAN', 'SLMAN', NULL, NULL, NULL, NULL),
(41, 'Jawa Tengah', 'SUKOHARJO', 'SKHRJO', NULL, NULL, NULL, NULL),
(42, 'Jawa Barat', 'SUMEDANG', 'SMDG', NULL, NULL, NULL, NULL),
(43, 'Jawa Timur', 'SURABAYA', 'SBY', NULL, NULL, NULL, NULL),
(44, 'Jawa tengah', 'SURAKARTA', 'SRKRTA', NULL, NULL, NULL, NULL),
(45, 'Jawa Barat', 'TANGERANG', 'TGRG', NULL, NULL, NULL, NULL),
(46, 'Jawa Barat', 'TASIKMALAYA', 'TSMLYA', NULL, NULL, NULL, NULL),
(47, 'Jawa Tengah', 'TEGAL', 'TGAL', NULL, NULL, NULL, NULL),
(48, 'Jawa Timur', 'TUBAN', 'TBN', NULL, NULL, NULL, NULL),
(49, 'Jawa Timur', 'TULUNGAGUNG', 'TLG', NULL, NULL, NULL, NULL),
(50, 'Daerah Istimewa Yogyakarta', 'YOGYAKARTA', 'YGYKRTA', NULL, NULL, NULL, NULL),
(51, 'Kalimantan Timur', 'BALIKPAPAN', 'BLKPPN', NULL, NULL, NULL, NULL),
(52, 'Kalimantan Timur', 'KUTAI TIMUR', 'KTTMR', NULL, NULL, NULL, NULL),
(53, 'Kalimantan Timur', 'PASER', 'PSRKT', NULL, NULL, NULL, NULL),
(54, 'Kalimantan Timur', 'SAMARINDA', 'SMRD', NULL, NULL, NULL, NULL),
(55, 'Kalimantan Timur', 'MAHAKAM ULU', 'MHKM', NULL, NULL, NULL, NULL),
(56, 'Kalimantan Timur', 'BERAU', 'BRUKT', NULL, NULL, NULL, NULL),
(57, 'Kalimantan Timur', 'KUTAI KARTANEGARA', 'KTKARTA', NULL, NULL, NULL, NULL),
(58, 'Kalimantan Timur', 'PENAJAM PASER UTARA', 'PPU', NULL, NULL, NULL, NULL),
(59, 'Kalimantan Timur', 'KUTAI BARAT', 'KTBRT', NULL, NULL, NULL, NULL),
(60, 'Kalimantan Timur', 'BONTANG', 'BNTG', NULL, NULL, NULL, NULL),
(61, 'Kalimantan Barat', 'BENGKAYANG', 'BGKYG', NULL, NULL, NULL, NULL),
(62, 'Kalimantan Barat', 'KAPUAS HULU', 'KPSHUL', NULL, NULL, NULL, NULL),
(63, 'Kalimantan Barat', 'KAYONG UTARA', 'KYGUTR', NULL, NULL, NULL, NULL),
(64, 'Kalimantan Barat', 'KETAPANG', 'KTPANG', NULL, NULL, NULL, NULL),
(65, 'Kalimantan Barat', 'KUBU RAYA', 'KBRAYA', NULL, NULL, NULL, NULL),
(66, 'Kalimantan Barat', 'LANDAK', 'LNDK', NULL, NULL, NULL, NULL),
(67, 'Kalimantan Barat', 'MELAWI', 'MLWI', NULL, NULL, NULL, NULL),
(68, 'Kalimantan Barat', 'MEMPAWAH', 'MPWAH', NULL, NULL, NULL, NULL),
(69, 'Kalimantan Barat', 'SAMBAS', 'SMBAS', NULL, NULL, NULL, NULL),
(70, 'Kalimantan Barat', 'SANGGAU', 'SNGU', NULL, NULL, NULL, NULL),
(71, 'Kalimantan Barat', 'SEKADAU', 'SKDU', NULL, NULL, NULL, NULL),
(72, 'Kalimantan Barat', 'SINTANG', 'SNTG', NULL, NULL, NULL, NULL),
(73, 'Kalimantan Barat', 'PONTIANAK', 'PNTNK', NULL, NULL, NULL, NULL),
(74, 'Kalimantan Barat', 'SINGKAWANG', 'SNGKWG', NULL, NULL, NULL, NULL),
(75, 'Kalimantan Selatan', 'BALANGAN', 'BLANG', NULL, NULL, NULL, NULL),
(76, 'Kalimantan Selatan', 'BANJAR', 'BNJR', NULL, NULL, NULL, NULL),
(77, 'Kalimantan Selatan', 'BARITO KUALA', 'BRTKLA', NULL, NULL, NULL, NULL),
(78, 'Kalimantan Selatan', 'HULU SUNGAI SELATAN', 'HLSS', NULL, NULL, NULL, NULL),
(79, 'Kalimantan Selatan', 'HULU SUNGAI TENGAH', 'HLST', NULL, NULL, NULL, NULL),
(80, 'Kalimantan Selatan', 'HULU SUNGAI UTARA', 'HLSU', NULL, NULL, NULL, NULL),
(81, 'Kalimantan Selatan', 'KOTABARU', 'KTBRU', NULL, NULL, NULL, NULL),
(82, 'Kalimantan Selatan', 'TABALONG', 'TBLG', NULL, NULL, NULL, NULL),
(83, 'Kalimantan Selatan', 'TANAH BUMBU', 'TNHBU', NULL, NULL, NULL, NULL),
(84, 'Kalimantan Selatan', 'TANAH LAUT', 'TNHUT', NULL, NULL, NULL, NULL),
(85, 'Kalimantan Selatan', 'TAPIN', 'TPN', NULL, NULL, NULL, NULL),
(86, 'Kalimantan Selatan', 'BANJARBARU', 'BNJRBR', NULL, NULL, NULL, NULL),
(87, 'Kalimantan Selatan', 'BANJARMASIN', 'BNJRMSN', NULL, NULL, NULL, NULL),
(88, 'Kalimantan Utara', 'BULUNGAN', 'BLUNG', NULL, NULL, NULL, NULL),
(89, 'Kalimantan Utara', 'MALINAU', 'MLNAU', NULL, NULL, NULL, NULL),
(90, 'Kalimantan Utara', 'NUNUKAN', 'NNKAN', NULL, NULL, NULL, NULL),
(91, 'Kalimantan Utara', 'TIDUNG', 'TDUNG', NULL, NULL, NULL, NULL),
(92, 'Kalimantan Utara', 'TARAKAN', 'TRKAN', NULL, NULL, NULL, NULL),
(93, 'Kalimantan Tengah', 'BARITO SELATAN', 'BRTSLTN', NULL, NULL, NULL, NULL),
(94, 'Kalimantan Tengah', 'BARITO TIMUR', 'BRTMR', NULL, NULL, NULL, NULL),
(95, 'Kalimantan Tengah', 'BARITO UTARA', 'BRTUT', NULL, NULL, NULL, NULL),
(96, 'Kalimantan Tengah', 'GUNUNG MAS', 'GNGMAS', NULL, NULL, NULL, NULL),
(97, 'Kalimantan Tengah', 'KAPUAS', 'KPS', NULL, NULL, NULL, NULL),
(98, 'Kalimantan Tengah', 'KATINGAN', 'KTNGAN', NULL, NULL, NULL, NULL),
(99, 'Kalimantan Tengah', 'KOTAWARINGIN BARAT', 'KTWRGBAR', NULL, NULL, NULL, NULL),
(100, 'Kalimantan Tengah', 'KOTAWARINGIN TIMUR', 'KTWRGTIM', NULL, NULL, NULL, NULL),
(101, 'Kalimantan Tengah', 'LAMANDAU', 'LMNDAU', NULL, NULL, NULL, NULL),
(102, 'Kalimantan Tengah', 'MURUNG RAYA', 'MRGRY', NULL, NULL, NULL, NULL),
(103, 'Kalimantan Tengah', 'PULANG PISAU', 'PLGPIS', NULL, NULL, NULL, NULL),
(104, 'Kalimantan Tengah', 'SERUYAN', 'SRYAN', NULL, NULL, NULL, NULL),
(105, 'Kalimantan Tengah', 'SUKAMARA', 'SKMRA', NULL, NULL, NULL, NULL),
(106, 'Kalimantan Tengah', 'PALANGKARAYA', 'PLGKRYA', NULL, NULL, NULL, NULL),
(107, 'Sulawesi Selatan', 'SOPPENG', 'SPPNG', NULL, NULL, NULL, NULL),
(108, 'Sulawesi Selatan', 'TAKALAR', 'TKLAR', NULL, NULL, NULL, NULL),
(109, 'Sulawesi Selatan', 'TANA TORAJA', 'TNTRJ', NULL, NULL, NULL, NULL),
(110, 'Sulawesi Selatan', 'TORAJA UTARA', 'TRJUT', NULL, NULL, NULL, NULL),
(111, 'Sulawesi Selatan', 'WAJO', 'WJO', NULL, NULL, NULL, NULL),
(112, 'Sulawesi Selatan', 'MAKASSAR', 'MKSR', NULL, NULL, NULL, NULL),
(113, 'Sulawesi Selatan', 'PALOPO', 'PLPO', NULL, NULL, NULL, NULL),
(114, 'Sulawesi Selatan', 'PAREPARE', 'PRPRE', NULL, NULL, NULL, NULL),
(115, 'Sulawesi Selatan', 'LUWU TIMUR', 'LWTIM', NULL, NULL, NULL, NULL),
(116, 'Sulawesi Selatan', 'LUWU UTARA', 'LWUT', NULL, NULL, NULL, NULL),
(117, 'Sulawesi Selatan', 'MAROS', 'MROS', NULL, NULL, NULL, NULL),
(118, 'Sulawesi Selatan', 'PANGKEP', 'PNGKEP', NULL, NULL, NULL, NULL),
(119, 'Sulawesi Selatan', 'PINRANG', 'PNRANG', NULL, NULL, NULL, NULL),
(120, 'Sulawesi Selatan', 'KEPULAUAN SELAYAR', 'KEPSLYAR', NULL, NULL, NULL, NULL),
(121, 'Sulawesi Selatan', 'SIDRAP', 'SDRAP', NULL, NULL, NULL, NULL),
(122, 'Sulawesi Selatan', 'SINJAI', 'SNJAI', NULL, NULL, NULL, NULL),
(123, 'Sulawesi Selatan', 'BARRU', 'BRU', NULL, NULL, NULL, NULL),
(124, 'Sulawesi Selatan', 'BONNE', 'BNNE', NULL, NULL, NULL, NULL),
(125, 'Sulawesi Selatan', 'BULUKUMBA', 'BLKMBA', NULL, NULL, NULL, NULL),
(126, 'Sulawesi Selatan', 'ENREKANG', 'ENRKG', NULL, NULL, NULL, NULL),
(127, 'Sulawesi Selatan', 'GOWA', 'GWA', NULL, NULL, NULL, NULL),
(128, 'Sulawesi Selatan', 'JENEPONTO', 'JNPNTO', NULL, NULL, NULL, NULL),
(129, 'Sulawesi Selatan', 'LUWU', 'LWU', NULL, NULL, NULL, NULL),
(130, 'Sulawesi Selatan', 'BANTAENG', 'BNTENG', NULL, NULL, NULL, NULL),
(131, 'Sulawesi Utara', 'BOLAANG MONGONDOW', 'BM', NULL, NULL, NULL, NULL),
(132, 'Sulawesi Utara', 'MINAHASA', 'MNHSA', NULL, NULL, NULL, NULL),
(133, 'Sulawesi Utara', 'KEPULAUAN SANGIHE', 'KEPSANG', NULL, NULL, NULL, NULL),
(134, 'Sulawesi Utara', 'KEPULAUAN TALAUD', 'KEPTAL', NULL, NULL, NULL, NULL),
(135, 'Sulawesi Utara', 'MINAHASA SELATAN', 'MNHSSEL', NULL, NULL, NULL, NULL),
(136, 'Sulawesi Utara', 'MINAHASA UTARA', 'MNHSUT', NULL, NULL, NULL, NULL),
(137, 'Sulawesi Utara', 'BOLAANG MONGONDOW UTARA', 'BMUT', NULL, NULL, NULL, NULL),
(138, 'Sulawesi Utara', 'SIAU TAGULANDANG BIARO', 'STBRO', NULL, NULL, NULL, NULL),
(139, 'Sulawesi Utara', 'MINAHASA TENGGARA', 'MHSTENG', NULL, NULL, NULL, NULL),
(140, 'Sulawesi Utara', 'BOLAANG MONGONDOW SELATAN', 'BMSEL', NULL, NULL, NULL, NULL),
(141, 'Sulawesi Utara', 'BOLAANG MONGONDOW TIMUR', 'BMTIM', NULL, NULL, NULL, NULL),
(142, 'Sulawesi Utara', 'MANADO', 'MNDO', NULL, NULL, NULL, NULL),
(143, 'Sulawesi Utara', 'BITUNG', 'BTUNG', NULL, NULL, NULL, NULL),
(144, 'Sulawesi Utara', 'TOMOHON', 'TMHON', NULL, NULL, NULL, NULL),
(145, 'Sulawesi Utara', 'KOTAMOBAGU', 'KTMBGU', NULL, NULL, NULL, NULL),
(146, 'Sulawesi Barat', 'MAJENE', 'MJNE', NULL, NULL, NULL, NULL),
(147, 'Sulawesi Barat', 'MAMASA', 'MSA', NULL, NULL, NULL, NULL),
(148, 'Sulawesi Barat', 'MAMUJU', 'MJ', NULL, NULL, NULL, NULL),
(149, 'Sulawesi Barat', 'MAMAUJU TENGAH', 'MJTENG', NULL, NULL, NULL, NULL),
(150, 'Sulawesi Barat', 'PASANGKAYU', 'PSGKY', NULL, NULL, NULL, NULL),
(151, 'Sulawesi Barat', 'POLEWALI MANDAR', 'PLWMDR', NULL, NULL, NULL, NULL),
(152, 'Sulawesi Tenggara', 'BOMBANA', 'BMBN', NULL, NULL, NULL, NULL),
(153, 'Sulawesi Tenggara', 'BUTON', 'BTON', NULL, NULL, NULL, NULL),
(154, 'Sulawesi Tenggara', 'BUTON SELATAN', 'BTONSEL', NULL, NULL, NULL, NULL),
(155, 'Sulawesi Tenggara', 'BUTON TENGAH', 'BTONTENG', NULL, NULL, NULL, NULL),
(156, 'Sulawesi Tenggara', 'BUTON UTARA', 'BTONUT', NULL, NULL, NULL, NULL),
(157, 'Sulawesi Tenggara', 'KOLAKA', 'KLKA', NULL, NULL, NULL, NULL),
(158, 'Sulawesi Tenggara', 'KOLAKA TIMUR', 'KLKTIM', NULL, NULL, NULL, NULL),
(159, 'Sulawesi Tenggara', 'KOLAKA UTARA', 'KLKUT', NULL, NULL, NULL, NULL),
(160, 'Sulawesi Tenggara', 'KONAWE', 'KNWE', NULL, NULL, NULL, NULL),
(161, 'Sulawesi Tenggara', 'KONAWE KEPULAUAN', 'KNWKEP', NULL, NULL, NULL, NULL),
(162, 'Sulawesi Tenggara', 'KONAWE SELATAN', 'KNWSEL', NULL, NULL, NULL, NULL),
(163, 'Sulawesi Tenggara', 'KONAWE UTARA', 'KNWUT', NULL, NULL, NULL, NULL),
(164, 'Sulawesi Tenggara', 'MUNA', 'MNA', NULL, NULL, NULL, NULL),
(165, 'Sulawesi Tenggara', 'MUNA BARAT', 'MNBAR', NULL, NULL, NULL, NULL),
(166, 'Sulawesi Tenggara', 'WAKATOBI', 'WKTB', NULL, NULL, NULL, NULL),
(167, 'Sulawesi Tenggara', 'BAUBAU', 'BAU', NULL, NULL, NULL, NULL),
(168, 'Sulawesi Tenggara', 'KENDARI', 'KNDRI', NULL, NULL, NULL, NULL),
(169, 'Sulawesi Tengah', 'BANGGAI', 'BNGAI', NULL, NULL, NULL, NULL),
(170, 'Sulawesi Tengah', 'BANGGAI KEPULAUAN', 'BNGAIKEP', NULL, NULL, NULL, NULL),
(171, 'Sulawesi Tengah', 'BANGGAI LAUT', 'BNGAILT', NULL, NULL, NULL, NULL),
(172, 'Sulawesi Tengah', 'BUOL', 'BOL', NULL, NULL, NULL, NULL),
(173, 'Sulawesi Tengah', 'DONGGALA', 'DNGLA', NULL, NULL, NULL, NULL),
(174, 'Sulawesi Tengah', 'MOROWALI', 'MRWLI', NULL, NULL, NULL, NULL),
(175, 'Sulawesi Tengah', 'MOROWALI UTARA', 'MRWLIUT', NULL, NULL, NULL, NULL),
(176, 'Sulawesi Tengah', 'PARIGI MOUTONG', 'PRGMTG', NULL, NULL, NULL, NULL),
(177, 'Sulawesi Tengah', 'POSO', 'PSO', NULL, NULL, NULL, NULL),
(178, 'Sulawesi Tengah', 'SIGI', 'SGI', NULL, NULL, NULL, NULL),
(179, 'Sulawesi Tengah', 'TOJO UNA UNA', 'TJUNA', NULL, NULL, NULL, NULL),
(180, 'Sulawesi Tengah', 'TOLITOLI', 'TLI', NULL, NULL, NULL, NULL),
(181, 'Sulawesi Tengah', 'PALU', 'PLU', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_condition`
--

CREATE TABLE `m_condition` (
  `condition_id` bigint(20) UNSIGNED NOT NULL,
  `condition_name` varchar(255) NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_condition`
--

INSERT INTO `m_condition` (`condition_id`, `condition_name`, `create_by`, `modified_by`, `create_date`, `modified_date`, `deleted_at`) VALUES
(1, 'cond 1A', 'admin', 'admin', '2024-10-20 01:10:44', '2024-10-20 20:38:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_control`
--

CREATE TABLE `m_control` (
  `control_id` int(11) NOT NULL,
  `control_name` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_control`
--

INSERT INTO `m_control` (`control_id`, `control_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'control 1A', '2024-10-20 08:10:54', '2024-10-21 03:36:10', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_dept`
--

CREATE TABLE `m_dept` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_dept`
--

INSERT INTO `m_dept` (`dept_id`, `dept_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'departemen IT', '2024-10-20 08:11:09', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_division`
--

CREATE TABLE `m_division` (
  `division_id` int(11) NOT NULL,
  `division_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_division`
--

INSERT INTO `m_division` (`division_id`, `division_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'divisi EAD', '2024-10-20 08:11:23', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_groupuser`
--

CREATE TABLE `m_groupuser` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_roles` varchar(255) NOT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_groupuser`
--

INSERT INTO `m_groupuser` (`group_id`, `group_name`, `group_roles`, `create_by`, `modified_by`, `create_date`, `modified_date`, `is_active`) VALUES
(1, 'OPS-A', 'Operation Grade A', 'admin', 'admin', '2024-10-20 08:15:57', '2024-10-21 03:38:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_joblevel`
--

CREATE TABLE `m_joblevel` (
  `joblevel_id` int(11) NOT NULL,
  `joblevel_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_joblevel`
--

INSERT INTO `m_joblevel` (`joblevel_id`, `joblevel_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'job level A', '2024-10-20 08:16:10', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_layout`
--

CREATE TABLE `m_layout` (
  `layout_id` int(11) NOT NULL,
  `layout_code` varchar(255) NOT NULL,
  `layout_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_layout`
--

INSERT INTO `m_layout` (`layout_id`, `layout_code`, `layout_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'A1', 'Layout Barang IT', '2024-10-20 08:19:03', '2024-10-21 03:44:54', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_location`
--

CREATE TABLE `m_location` (
  `loc_id` int(11) NOT NULL,
  `loc_code` varchar(255) NOT NULL,
  `loc_name` varchar(255) NOT NULL,
  `loc_city` varchar(255) DEFAULT NULL,
  `loc_address` varchar(255) DEFAULT NULL,
  `loc_distric` varchar(255) DEFAULT NULL,
  `loc_vilage` varchar(255) DEFAULT NULL,
  `region_id` int(11) NOT NULL,
  `loc_latitude` varchar(255) DEFAULT NULL,
  `loc_longitude` varchar(255) DEFAULT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_location`
--

INSERT INTO `m_location` (`loc_id`, `loc_code`, `loc_name`, `loc_city`, `loc_address`, `loc_distric`, `loc_vilage`, `region_id`, `loc_latitude`, `loc_longitude`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'n', 'n', 'n', 'n', 'n', 'n', 9, '9', '9', '2024-10-20 09:13:25', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_mtc`
--

CREATE TABLE `m_mtc` (
  `mtc_id` int(11) NOT NULL,
  `mtc_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_mtc`
--

INSERT INTO `m_mtc` (`mtc_id`, `mtc_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'mtc 11', '2024-10-20 09:15:31', '2024-10-21 03:45:23', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_people`
--

CREATE TABLE `m_people` (
  `people_id` int(11) NOT NULL,
  `people_nickname` varchar(255) DEFAULT NULL,
  `people_fullname` varchar(255) DEFAULT NULL,
  `people_email` varchar(255) DEFAULT NULL,
  `people_whatsapp` varchar(255) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `joblevel_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `loc_id` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_people`
--

INSERT INTO `m_people` (`people_id`, `people_nickname`, `people_fullname`, `people_email`, `people_whatsapp`, `division_id`, `dept_id`, `joblevel_id`, `region_id`, `loc_id`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'm', 'm', 'm', 'm', 9, 9, 9, 99, 9, '2024-10-20 09:56:23', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_periodic_mtc`
--

CREATE TABLE `m_periodic_mtc` (
  `periodic_mtc_id` int(11) NOT NULL,
  `periodic_mtc_name` varchar(255) DEFAULT NULL,
  `periodic_mtc_day` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_periodic_mtc`
--

INSERT INTO `m_periodic_mtc` (`periodic_mtc_id`, `periodic_mtc_name`, `periodic_mtc_day`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'Periodic AA', 12, '2024-10-20 10:05:46', '2024-10-21 03:46:51', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_priority`
--

CREATE TABLE `m_priority` (
  `priority_id` int(11) NOT NULL,
  `priority_code` varchar(255) NOT NULL,
  `priority_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_priority`
--

INSERT INTO `m_priority` (`priority_id`, `priority_code`, `priority_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'PRI', 'Priority', '2024-10-16 08:50:33', '2024-10-21 03:49:28', 'admin', 'admin', NULL),
(2, 'NPR', 'Not Priority', '2024-10-16 08:50:48', NULL, 'admin', NULL, NULL),
(3, 'BS', 'Basic', '2024-10-16 08:51:02', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_reason`
--

CREATE TABLE `m_reason` (
  `reason_id` int(11) NOT NULL,
  `reason_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_reason`
--

INSERT INTO `m_reason` (`reason_id`, `reason_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'reason ABC', '2024-10-20 10:14:15', '2024-10-21 05:04:16', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_reason_so`
--

CREATE TABLE `m_reason_so` (
  `reason_so_id` int(11) NOT NULL,
  `reason_so_name` varchar(255) DEFAULT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_reason_so`
--

INSERT INTO `m_reason_so` (`reason_so_id`, `reason_so_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'reason so', '2024-10-21 08:24:05', '2024-10-21 08:45:39', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_region`
--

CREATE TABLE `m_region` (
  `region_id` int(11) NOT NULL,
  `region_code` varchar(255) NOT NULL,
  `region_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_region`
--

INSERT INTO `m_region` (`region_id`, `region_code`, `region_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'MLG', 'Malang', '2024-10-20 10:14:30', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_repair`
--

CREATE TABLE `m_repair` (
  `repair_id` int(11) NOT NULL,
  `repair_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_repair`
--

INSERT INTO `m_repair` (`repair_id`, `repair_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'repair A', '2024-10-20 10:15:29', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_subcategory`
--

CREATE TABLE `m_subcategory` (
  `subcat_id` int(11) NOT NULL,
  `subcat_code` varchar(255) DEFAULT NULL,
  `subcat_name` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_subcategory`
--

INSERT INTO `m_subcategory` (`subcat_id`, `subcat_code`, `subcat_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'SC B', 'SC 2', '2024-10-21 10:13:47', '2024-10-21 10:14:17', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_code` varchar(255) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` varchar(255) DEFAULT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`supplier_id`, `supplier_code`, `supplier_name`, `supplier_address`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'SBC', 'Sukun Bersama Ceria', 'Jl. Raya Sukun ABC', '2024-10-20 10:18:30', '2024-10-21 03:50:36', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_type`
--

CREATE TABLE `m_type` (
  `type_id` int(11) NOT NULL,
  `type_code` varchar(255) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_type`
--

INSERT INTO `m_type` (`type_id`, `type_code`, `type_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'A', 'Barang IT', '2024-10-17 07:04:20', NULL, 'admin', NULL, NULL),
(2, 'B', 'Barang SDG Construction', '2024-10-20 09:56:37', '2024-10-21 07:56:36', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_uom`
--

CREATE TABLE `m_uom` (
  `uom_id` int(11) NOT NULL,
  `uom_name` varchar(255) NOT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_uom`
--

INSERT INTO `m_uom` (`uom_id`, `uom_name`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'Pcs', '2024-10-17 07:04:57', NULL, 'admin', NULL, NULL),
(2, 'Packs', '2024-10-20 10:19:07', '2024-10-21 03:50:58', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gacoan.com', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_warranty`
--

CREATE TABLE `m_warranty` (
  `warranty_id` int(11) NOT NULL,
  `warranty_name` varchar(255) DEFAULT NULL,
  `warranty_day` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_warranty`
--

INSERT INTO `m_warranty` (`warranty_id`, `warranty_name`, `warranty_day`, `create_date`, `modified_date`, `create_by`, `modified_by`, `is_active`) VALUES
(1, 'Warranty ABC', 23, '2024-10-20 10:19:24', '2024-10-21 03:51:17', 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('34SKp6s8n7xdqGxCdHM0PBW4Dq0WGdCecYUFluIV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicnpEWnJMeDJKNWFabzNDVWlhNU5ENHFGU1FnTXRWdngxaUpjenFnaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3JlZ2lzdCI7fX0=', 1729566696),
('u7hohl4mcCJvyILL5i9ni5oiMDJTFRlYJVyKAAyU', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidkNzeXk4cGZoYlB1bURROFZrU3hKeHZ6Skg1NWJVQ0NkaWZteFRzNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3N1YmNhdGVnb3J5cyI7fX0=', 1729505667);

-- --------------------------------------------------------

--
-- Table structure for table `table_registrasi_asset`
--

CREATE TABLE `table_registrasi_asset` (
  `id` int(10) UNSIGNED NOT NULL,
  `register_code` varchar(255) NOT NULL,
  `asset_name` varchar(150) NOT NULL,
  `serial_number` varchar(150) NOT NULL,
  `type_asset` varchar(100) NOT NULL,
  `category_asset` varchar(150) NOT NULL,
  `prioritas` varchar(150) NOT NULL,
  `merk` varchar(150) NOT NULL,
  `qty` int(10) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `register_location` varchar(200) NOT NULL,
  `layout` varchar(100) NOT NULL,
  `register_date` date NOT NULL,
  `supplier` varchar(150) NOT NULL,
  `status` varchar(100) NOT NULL,
  `purchase_number` varchar(150) NOT NULL,
  `purchase_date` date NOT NULL,
  `warranty` varchar(100) NOT NULL,
  `periodic_maintenance` varchar(100) NOT NULL,
  `user_create` varchar(255) DEFAULT NULL,
  `user_edited` varchar(255) DEFAULT NULL,
  `qr_code_path` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '21232f297a57a5a743894a0e4a801fc3', 'Zv6C5CfUMA18HkTiP9dFiLUMHBd5tVGZib5pR2QVX1Ack6uStYWEATc7to6g', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_models`
--

CREATE TABLE `user_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_assets`
--
ALTER TABLE `a_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `m_city`
--
ALTER TABLE `m_city`
  ADD PRIMARY KEY (`city_id`) USING BTREE;

--
-- Indexes for table `m_condition`
--
ALTER TABLE `m_condition`
  ADD PRIMARY KEY (`condition_id`);

--
-- Indexes for table `m_reason_so`
--
ALTER TABLE `m_reason_so`
  ADD PRIMARY KEY (`reason_so_id`);

--
-- Indexes for table `m_subcategory`
--
ALTER TABLE `m_subcategory`
  ADD PRIMARY KEY (`subcat_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_user_username_unique` (`username`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_models`
--
ALTER TABLE `user_models`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_city`
--
ALTER TABLE `m_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_models`
--
ALTER TABLE `user_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
