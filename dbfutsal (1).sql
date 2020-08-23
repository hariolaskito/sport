-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Mar 2017 pada 12.23
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfutsal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `article_category_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `isactive` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `article_category`
--

CREATE TABLE `article_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `article_category`
--

INSERT INTO `article_category` (`id`, `name`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Berita Futsal', '', 1, '2017-02-08 06:52:35', '2017-02-08 06:52:35'),
(2, 'Umum', '', 1, '2017-02-08 06:57:33', '2017-02-08 06:57:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `notrans` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pitch_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id`, `notrans`, `pitch_id`, `user_id`, `name`, `phone`, `created_at`, `updated_at`) VALUES
(15, 'GM/FTS/0001/2017', 2, 4, 'yazidahmad', '11111111', '2017-02-13 08:11:42', '2017-02-13 08:11:42'),
(16, 'GM/FTS/0002/2017', 3, 4, 'yazid ahmad', '22222222', '2017-02-13 08:13:44', '2017-02-13 08:13:44'),
(17, 'GM/FTS/0003/2017', 3, 4, 'ahamdyazid', '081934', '2017-02-13 08:17:44', '2017-02-13 08:17:44'),
(18, 'GM/FTS/0004/2017', 2, 4, 'ahmad', '081930883', '2017-02-13 21:27:35', '2017-02-13 21:27:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time_number` smallint(6) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `booking_detail`
--

INSERT INTO `booking_detail` (`id`, `booking_id`, `date`, `time_number`, `price`, `coupon_id`) VALUES
(98, 15, '2017-02-13', 3, '150000.00', 0),
(99, 15, '2017-02-13', 4, '150000.00', 0),
(100, 15, '2017-02-13', 5, '150000.00', 0),
(101, 15, '2017-02-13', 6, '150000.00', 0),
(102, 15, '2017-02-13', 7, '150000.00', 0),
(103, 16, '2017-02-13', 9, '120000.00', 0),
(104, 16, '2017-02-13', 10, '120000.00', 0),
(105, 16, '2017-02-13', 11, '120000.00', 0),
(106, 16, '2017-02-13', 12, '120000.00', 0),
(107, 16, '2017-02-13', 13, '120000.00', 0),
(108, 17, '2017-02-13', 3, '120000.00', 0),
(109, 17, '2017-02-13', 4, '120000.00', 0),
(110, 18, '2017-02-14', 3, '150000.00', 0),
(111, 18, '2017-02-14', 4, '150000.00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash`
--

CREATE TABLE `cash` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `cash`
--

INSERT INTO `cash` (`id`, `date`, `description`, `amount`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2017-01-31', 'pemabayaran listrik', '500000.00', 1, '2017-02-02 05:01:27', '2017-02-02 05:01:27'),
(2, '2017-01-31', 'pembayran air', '500000.00', 1, '2017-02-02 05:02:00', '2017-02-02 05:02:00'),
(3, '2017-01-31', 'perbaikan lapangan', '450000.00', 1, '2017-02-02 05:02:27', '2017-02-02 05:02:27'),
(4, '2017-01-31', 'penggajian karyawan', '4000000.00', 1, '2017-02-02 05:02:59', '2017-02-02 05:02:59'),
(5, '2017-02-02', 'pemabayaran listrik', '500000.00', 1, '2017-02-02 05:05:05', '2017-02-02 05:05:05'),
(6, '2017-02-02', 'pemabayaran air', '200000.00', 1, '2017-02-02 05:05:26', '2017-02-02 05:13:23'),
(7, '2017-02-12', 'asem', '400000.00', 1, '2017-02-12 06:58:19', '2017-02-12 06:58:19'),
(8, '2017-02-12', 'rokok', '-195000.00', 1, '2017-02-12 07:06:37', '2017-02-12 07:06:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coupon`
--

CREATE TABLE `coupon` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `booking_detail_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `coupon`
--

INSERT INTO `coupon` (`id`, `user_id`, `booking_detail_id`) VALUES
(14, 4, 107),
(15, 4, 111);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_table_user', 1),
(2, '2014_10_12_100000_create_table_password_reset', 1),
(3, '2017_01_05_153001_entrust_setup_tables', 1),
(4, '2017_01_06_160610_create_table_article_category', 1),
(5, '2017_01_06_160913_create_table_article', 1),
(6, '2017_01_06_161126_create_table_setting', 1),
(7, '2017_01_09_134209_create_table_pitch', 1),
(8, '2017_01_09_134747_create_table_pitch_price', 1),
(9, '2017_01_11_234505_create_table_cash', 1),
(10, '2017_01_15_052351_create_table_booking', 1),
(11, '2017_01_15_052852_create_table_booking_detail', 1),
(12, '2017_01_15_052860_create_table_coupon', 1),
(13, '2017_01_23_074120_create_table_payment', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset`
--

CREATE TABLE `password_reset` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('cash','transfer','coupon') COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `account_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `coupon_id` int(11) DEFAULT NULL,
  `confirmer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id`, `booking_id`, `user_id`, `type`, `amount`, `account_name`, `date`, `status`, `coupon_id`, `confirmer_id`, `created_at`, `updated_at`) VALUES
(20, 15, 4, 'transfer', '375000.00', 'hiro ', '2017-02-13', 1, 0, 4, '2017-02-13 08:12:15', '2017-02-13 08:14:34'),
(21, 16, 4, 'transfer', '300000.00', 'yazid', '2017-02-13', 1, 0, 4, '2017-02-13 08:14:15', '2017-02-13 08:14:29'),
(22, 15, 4, 'cash', '375000.00', 'yazid', '2017-02-13', 1, 0, 4, '2017-02-13 08:15:18', '2017-02-13 08:15:18'),
(23, 16, 4, 'cash', '300000.00', 'hiro', '2017-02-13', 1, 0, 4, '2017-02-13 08:16:16', '2017-02-13 08:16:16'),
(24, 17, 4, 'coupon', '120000.00', 'AHMAD', '2017-02-13', 1, 14, 4, '2017-02-13 08:17:58', '2017-02-13 08:17:58'),
(25, 17, 4, 'transfer', '120000.00', 'ahmad', '2017-02-13', 0, 0, NULL, '2017-02-13 08:18:10', '2017-02-13 08:18:10'),
(26, 18, 4, 'transfer', '150000.00', 'hiro', '2017-02-14', 1, 0, 1, '2017-02-13 21:28:33', '2017-02-13 21:29:28'),
(27, 18, 1, 'cash', '150000.00', 'hiro', '2017-02-14', 1, 0, 1, '2017-02-13 21:30:07', '2017-02-13 21:30:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission`
--

CREATE TABLE `permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `permission`
--

INSERT INTO `permission` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'user-create', 'Tambah User', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16'),
(2, 'user-edit', 'Edit User', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16'),
(3, 'user-delete', 'Hapus User', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16'),
(4, 'category-create', 'Tambah Kategori Artikel', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16'),
(5, 'category-edit', 'Edit Kategori Artikel', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16'),
(6, 'category-delete', 'Hapus Kategori Artikel', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16'),
(7, 'article-create', 'Tambah Artikel', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16'),
(8, 'article-edit', 'Edit Artikel', NULL, '2017-02-02 04:51:17', '2017-02-02 04:51:17'),
(9, 'article-delete', 'Hapus Artikel', NULL, '2017-02-02 04:51:17', '2017-02-02 04:51:17'),
(10, 'setting-edit', 'Edit Setting', NULL, '2017-02-02 04:51:17', '2017-02-02 04:51:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pitch`
--

CREATE TABLE `pitch` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `isactive` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pitch`
--

INSERT INTO `pitch` (`id`, `name`, `description`, `image`, `isactive`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Lapangan 1', '1', '', '1', 1, '2017-02-02 04:51:18', '2017-02-02 04:51:18'),
(2, 'Lapangan 2', '2', '', '1', 1, '2017-02-02 04:51:18', '2017-02-02 04:51:18'),
(3, 'Lapangan 3', '3', '', '1', 1, '2017-02-02 04:51:19', '2017-02-13 02:53:29'),
(4, 'Lapangan 4', '4', '', '1', 1, '2017-02-02 04:51:20', '2017-02-02 04:51:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pitch_price`
--

CREATE TABLE `pitch_price` (
  `pitch_id` int(10) UNSIGNED NOT NULL,
  `time_number` smallint(6) NOT NULL,
  `price` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pitch_price`
--

INSERT INTO `pitch_price` (`pitch_id`, `time_number`, `price`) VALUES
(1, 0, '100000.00'),
(1, 1, '100000.00'),
(1, 2, '100000.00'),
(1, 3, '100000.00'),
(1, 4, '100000.00'),
(1, 5, '100000.00'),
(1, 6, '100000.00'),
(1, 7, '100000.00'),
(1, 8, '100000.00'),
(1, 9, '100000.00'),
(1, 10, '100000.00'),
(1, 11, '100000.00'),
(1, 12, '100000.00'),
(1, 13, '100000.00'),
(1, 14, '100000.00'),
(1, 15, '100000.00'),
(1, 16, '100000.00'),
(1, 17, '100000.00'),
(1, 18, '100000.00'),
(1, 19, '100000.00'),
(1, 20, '100000.00'),
(1, 21, '100000.00'),
(1, 22, '100000.00'),
(1, 23, '100000.00'),
(2, 0, '150000.00'),
(2, 1, '150000.00'),
(2, 2, '150000.00'),
(2, 3, '150000.00'),
(2, 4, '150000.00'),
(2, 5, '150000.00'),
(2, 6, '150000.00'),
(2, 7, '150000.00'),
(2, 8, '150000.00'),
(2, 9, '150000.00'),
(2, 10, '150000.00'),
(2, 11, '150000.00'),
(2, 12, '150000.00'),
(2, 13, '150000.00'),
(2, 14, '150000.00'),
(2, 15, '150000.00'),
(2, 16, '150000.00'),
(2, 17, '150000.00'),
(2, 18, '150000.00'),
(2, 19, '150000.00'),
(2, 20, '150000.00'),
(2, 21, '150000.00'),
(2, 22, '150000.00'),
(2, 23, '150000.00'),
(3, 0, '120000.00'),
(3, 1, '120000.00'),
(3, 2, '120000.00'),
(3, 3, '120000.00'),
(3, 4, '120000.00'),
(3, 5, '120000.00'),
(3, 6, '120000.00'),
(3, 7, '120000.00'),
(3, 8, '120000.00'),
(3, 9, '120000.00'),
(3, 10, '120000.00'),
(3, 11, '120000.00'),
(3, 12, '120000.00'),
(3, 13, '120000.00'),
(3, 14, '120000.00'),
(3, 15, '120000.00'),
(3, 16, '120000.00'),
(3, 17, '120000.00'),
(3, 18, '120000.00'),
(3, 19, '120000.00'),
(3, 20, '120000.00'),
(3, 21, '120000.00'),
(3, 22, '120000.00'),
(3, 23, '120000.00'),
(4, 0, '80000.00'),
(4, 1, '80000.00'),
(4, 2, '80000.00'),
(4, 3, '80000.00'),
(4, 4, '80000.00'),
(4, 5, '80000.00'),
(4, 6, '80000.00'),
(4, 7, '80000.00'),
(4, 8, '80000.00'),
(4, 9, '80000.00'),
(4, 10, '80000.00'),
(4, 11, '80000.00'),
(4, 12, '80000.00'),
(4, 13, '80000.00'),
(4, 14, '80000.00'),
(4, 15, '80000.00'),
(4, 16, '80000.00'),
(4, 17, '80000.00'),
(4, 18, '80000.00'),
(4, 19, '80000.00'),
(4, 20, '80000.00'),
(4, 21, '80000.00'),
(4, 22, '80000.00'),
(4, 23, '80000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', NULL, '2017-02-02 04:51:15', '2017-02-02 04:51:15'),
(2, 'operator', 'Operator', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16'),
(3, 'member', 'Member', NULL, '2017-02-02 04:51:16', '2017-02-02 04:51:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`code`, `value`) VALUES
('COMP_ADDRESS', 'Jln. sugiono'),
('COMP_CITY', 'sidoarjo'),
('COMP_EMAIL', 'alenafutsal@gmail.com           '),
('COMP_HP', '081-254-256-789'),
('COMP_IMG', '20170212134752_1.jpg'),
('COMP_NAME', 'Alena Futsal'),
('COMP_PHONE', '021-654321'),
('COMP_STATE', 'Jawa Timur'),
('COMP_ZIPCODE', '61353'),
('FTS_HOUR_BONUS', '10'),
('FTS_MINDP', '50'),
('PAGE_ABOUT', '<p>kami penyedia lapangan futsal yang terpercya yang berdiri sejak 2011</p>\r\n'),
('SOC_FACEBOOK', 'https://facebook.com'),
('SOC_INSTAGRAM', 'https://instagram.com'),
('SOC_TWITTER', 'https://twitter.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isactive` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `isdefault` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('admin','operator','member') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `phone`, `email`, `password`, `isactive`, `isdefault`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 'superadmin', '085732304321', 'superadmin@gmail.com', '$2y$10$MVyEGAAQQvI8vQo3o5Hx3O5xa9D3SSKee30Ar0TRMK/YEf6IDUfcm', '1', '1', 'admin', 'naRAC15EbjgFjqXtke2bkk6EPm4uScPi8UbJvSpfhsqwgeHLddncKq5NfELI', '2017-02-02 04:51:17', '2017-02-02 06:14:15'),
(2, 'Zlatan Ibrahimmovic', 'zlatan', '085732301234', 'zlatan@gmail.com', '$2y$10$a3K60514DdfblJs7xpx5/OBPoYLaEZQDt9qWyevkAzLp4vBGVMJqK', '1', '0', 'admin', NULL, '2017-02-02 04:51:18', '2017-02-02 06:13:38'),
(3, 'ahmad yazid', 'yazid', '', 'yazid@gmail.com', '$2y$10$6g4MRtRtgwnCG2zegEdQpOpECuBWw1geXBf5M8sqonY/Omt62K8qu', '1', '0', 'member', NULL, '2017-02-02 04:55:01', '2017-02-02 04:55:01'),
(4, 'AHMAD', 'Ahmad', '', 'ahmad@gmail.com', '$2y$10$EMULnBo6/QBxNHEZNlNg5eOhdcTLmUQLJErK.SfWSfmWjQpG07NWy', '1', '0', 'member', NULL, '2017-02-13 02:17:13', '2017-02-13 02:17:13'),
(5, 'ahmad', 'hiro', '', 'hiro1@gmail.com', '$2y$10$QJqmQILSt0Fgd11M3cn5eeVIhQeABjVpriXfW87kRHZ6ME46D7H4S', '1', '0', 'member', NULL, '2017-02-13 21:26:23', '2017-02-13 21:26:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_pitch_id_foreign` (`pitch_id`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_detail_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_booking_detail_id_foreign` (`booking_detail_id`),
  ADD KEY `coupon_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD KEY `password_reset_email_index` (`email`),
  ADD KEY `password_reset_token_index` (`token`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `pitch`
--
ALTER TABLE `pitch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pitch_price`
--
ALTER TABLE `pitch_price`
  ADD PRIMARY KEY (`pitch_id`,`time_number`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD UNIQUE KEY `setting_code_unique` (`code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pitch`
--
ALTER TABLE `pitch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_pitch_id_foreign` FOREIGN KEY (`pitch_id`) REFERENCES `pitch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD CONSTRAINT `booking_detail_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_booking_detail_id_foreign` FOREIGN KEY (`booking_detail_id`) REFERENCES `booking_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pitch_price`
--
ALTER TABLE `pitch_price`
  ADD CONSTRAINT `pitch_price_pitch_id_foreign` FOREIGN KEY (`pitch_id`) REFERENCES `pitch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
