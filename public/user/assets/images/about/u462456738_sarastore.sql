-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 07, 2024 at 04:41 PM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u462456738_sarastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `image`, `name`, `created_at`, `updated_at`) VALUES
(13, '1723002028_pdZijZ3enhITPsG92Pa3O0e4k.webp', 'sara store', '2024-08-07 03:40:28', '2024-08-07 03:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(5, 'Hair Care', '2024-06-11 11:25:20', '2024-06-11 23:13:16'),
(6, 'Body Care', '2024-06-11 11:25:34', '2024-06-11 11:25:34'),
(7, 'Skin Care', '2024-06-11 11:25:59', '2024-06-11 11:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `code`, `address`, `phone`, `note`, `created_at`, `updated_at`, `email`) VALUES
(77, 'mohamed', NULL, 'جيزة | 269 portsaid st', '01070001253', NULL, '2024-09-07 16:07:59', '2024-09-07 16:10:42', NULL);

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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_12_142037_create_clients_table', 1),
(4, '2020_01_12_142522_create_categories_table', 1),
(5, '2020_01_12_142551_create_products_table', 1),
(6, '2020_05_12_082214_create_shippers_table', 1),
(7, '2020_05_13_014534_create_stock_trasnactions_table', 1),
(8, '2020_05_14_010112_create_orders_table', 1),
(9, '2020_05_14_012655_create_order_products_table', 1),
(10, '2021_05_11_002350_create_settings_table', 2),
(11, '2021_05_11_002422_create_transactions_table', 2),
(12, '2014_10_12_100000_create_password_reset_tokens_table', 3),
(13, '2019_08_19_000000_create_failed_jobs_table', 3),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(15, '2024_01_16_124425_create_ratings_table', 3),
(16, '2024_01_16_131151_create_ratings_table', 4),
(18, '2024_01_16_212455_create_ratings_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `code` varchar(191) DEFAULT NULL,
  `shippingPrice` varchar(191) DEFAULT NULL,
  `discount` varchar(191) DEFAULT NULL,
  `discountReason` varchar(191) DEFAULT NULL,
  `shipperName` varchar(191) DEFAULT NULL,
  `shipperId` varchar(191) DEFAULT NULL,
  `shippingAddress` varchar(191) DEFAULT NULL,
  `clientName` varchar(191) DEFAULT NULL,
  `clientPhone` varchar(191) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `clientId` int(11) DEFAULT NULL,
  `date` varchar(191) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `privatenotes` text DEFAULT NULL,
  `order_notes` text DEFAULT NULL,
  `printed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `code`, `shippingPrice`, `discount`, `discountReason`, `shipperName`, `shipperId`, `shippingAddress`, `clientName`, `clientPhone`, `status`, `clientId`, `date`, `note`, `privatenotes`, `order_notes`, `printed`, `created_at`, `updated_at`) VALUES
(96, 0, '10096', '0', '0', '', 'بدون مندوب', '0', 'قاهرة | 269 portsaid st', 'test', '01070001253', 7, 77, '2024/09/07 | 4:07 PM', '', NULL, '', 0, '2024-09-07 16:07:59', '2024-09-07 16:07:59'),
(97, 0, '10097', '0', '0', '', 'بدون مندوب', '0', 'جيزة | 269 portsaid st', 'mohamed', '01070001253', 7, 77, '2024/09/07 | 4:10 PM', '', NULL, '', 0, '2024-09-07 16:10:42', '2024-09-07 16:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `price` varchar(191) DEFAULT NULL,
  `quantity` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `orderId`, `code`, `name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(103, 96, '10064', 'صبغة ريتش الهندية', '165', '1', '2024-09-07 16:07:59', '2024-09-07 16:07:59'),
(104, 97, '10058', 'Size Up Cream', '300', '1', '2024-09-07 16:10:42', '2024-09-07 16:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `userId` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `quantity` varchar(191) DEFAULT NULL,
  `buyingPrice` varchar(191) DEFAULT NULL,
  `sellingPrice` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `available_on_website` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `oldprice` int(11) DEFAULT NULL,
  `box` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `most_sell` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `category_id`, `userId`, `quantity`, `buyingPrice`, `sellingPrice`, `image`, `images`, `description`, `youtube`, `available_on_website`, `created_at`, `updated_at`, `oldprice`, `box`, `most_sell`, `brand_id`) VALUES
(58, '10058', 'Size Up Cream', 6, 7, '94', '100', '300', '1722995777_QxX1XDXWRIe4GsuFPL6ElXG9o.png', '[]', 'كريم سايز اب', NULL, 1, '2024-08-07 01:55:12', '2024-09-07 16:10:42', 370, NULL, '1', 13),
(59, '10059', 'fixation course (كورس التثبيت)', 6, 7, '92', '200', '440', '1723001973_OpwlyuDjwklG1lRPKcp9hImcC.png', '[]', 'كورس التثبيت عباره عن بودر تثبيت و ازازه من بي كيرفي لتثبيت الوزن', NULL, 1, '2024-08-07 03:39:33', '2024-09-04 06:06:17', 480, NULL, '1', 13),
(60, '10060', 'Be Curvy', 6, 7, '95', '250', '420', '1725418160_dtLZIzGmoOEGqJndPCEVz6FYy.png', '[]', 'عبوتين', NULL, 1, '2024-08-29 07:17:59', '2024-09-04 06:01:11', 550, NULL, '1', 13),
(61, '10061', 'زيت كيشور الهندي', 5, 7, '100', '50', '145', '1725423669_AXvJnhrPm6VN4UTubRFXatxqF.png', '[]', 'زيت كيشور الهندي الاصلي', NULL, 1, '2024-09-04 04:21:09', '2024-09-04 06:04:07', 180, NULL, NULL, NULL),
(62, '10062', 'بودر تبييض الأسنان الهندي', 7, 7, '100', '65', '130', '1725423748_uiONOkvYCDq9mn6wrtJI6Verw.png', '[]', 'بودر تبييض الأسنان الهندي', NULL, 1, '2024-09-04 04:22:28', '2024-09-04 06:04:26', NULL, NULL, NULL, NULL),
(63, '10063', 'كريم ديسار (فيتامين C )', 7, 7, '100', '100', '175', '1725424407_DurpaEejc5axEf4TkSalXo7nH.png', '[]', 'كريم ديسار (فيتامين C )', NULL, 1, '2024-09-04 04:33:27', '2024-09-04 06:00:35', NULL, NULL, NULL, NULL),
(64, '10064', 'صبغة ريتش الهندية', 5, 7, '99', '70', '165', '1725424713_fcmNOmBTOV4C5CDbV7KOqkGMu.png', '[\"1725424713_WUNYJhC1C3EoEj5dh0e7cPO8S.jpg\",\"1725424713_NVZucmEhfVs4Jab4GmQ776y6w.jpeg\",\"1725424713_vJJGGvoyrcYbLpNR45fuQpA0p.jpg\",\"1725424713_qzi6MZM4DIsmzOh4k7WNOrb9V.webp\"]', 'صبغة ريتش الهندية', NULL, 1, '2024-09-04 04:38:33', '2024-09-07 16:07:59', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `stars_rated` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `prod_id`, `stars_rated`, `created_at`, `updated_at`) VALUES
(81, '58', '5', '2024-08-07 02:02:28', '2024-08-07 02:02:28'),
(82, '59', '5', '2024-08-07 03:41:17', '2024-08-07 03:41:17'),
(83, '60', '5', '2024-08-29 07:19:05', '2024-08-29 07:19:05'),
(84, '63', '5', '2024-09-04 04:41:22', '2024-09-04 04:41:22'),
(85, '61', '5', '2024-09-04 05:30:19', '2024-09-04 05:30:19'),
(86, '62', '5', '2024-09-04 05:30:32', '2024-09-04 05:30:32'),
(87, '62', '5', '2024-09-04 06:12:47', '2024-09-04 06:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'messenger', 'sarastoreproducts', NULL, '2024-06-10 11:27:17'),
(2, 'whatsapp', '201152601249', NULL, '2024-06-10 11:27:17'),
(3, 'phone', '201152601249', NULL, '2024-06-10 11:27:17'),
(4, 'email', 'customersupport@sarastoreproducts.com', NULL, '2024-06-10 11:27:17'),
(5, 'instagram', NULL, NULL, '2024-06-10 11:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_trasnactions`
--

CREATE TABLE `stock_trasnactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productName` varchar(191) DEFAULT NULL,
  `productCode` varchar(191) DEFAULT NULL,
  `productQuantity` varchar(191) DEFAULT NULL,
  `productBuyingPrice` varchar(191) DEFAULT NULL,
  `productSellingPrice` varchar(191) DEFAULT NULL,
  `categoryName` varchar(191) DEFAULT NULL,
  `date` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `stock_trasnactions`
--

INSERT INTO `stock_trasnactions` (`id`, `productName`, `productCode`, `productQuantity`, `productBuyingPrice`, `productSellingPrice`, `categoryName`, `date`, `created_at`, `updated_at`) VALUES
(146, 'Size Up Cream', '10058', '100', '100', '500', 'Body Care', '2024/08/07 | 1:55 AM', '2024-08-07 01:55:12', '2024-08-07 01:55:12'),
(147, 'fixation course (كورس التثبيت)', '10059', '100', '100', '800', 'Body Care', '2024/08/07 | 3:39 AM', '2024-08-07 03:39:33', '2024-08-07 03:39:33'),
(148, 'Be Curvy', '10060', '100', '200', '600', 'Body Care', '2024/08/29 | 7:17 AM', '2024-08-29 07:17:59', '2024-08-29 07:17:59'),
(149, 'زيت كيشور الهندي', '10061', '100', '50', '1000', 'Hair Care', '2024/09/04 | 4:21 AM', '2024-09-04 04:21:09', '2024-09-04 04:21:09'),
(150, 'بودر تبييض الأسنان الهندي', '10062', '100', '100', '1000', 'Skin Care', '2024/09/04 | 4:22 AM', '2024-09-04 04:22:28', '2024-09-04 04:22:28'),
(151, 'كريم ديسار (فيتامين C )', '10063', '100', '100', '200', 'Skin Care', '2024/09/04 | 4:33 AM', '2024-09-04 04:33:27', '2024-09-04 04:33:27'),
(152, 'صبغة ريتش الهندية', '10064', '100', '50', '1000', 'Hair Care', '2024/09/04 | 4:38 AM', '2024-09-04 04:38:33', '2024-09-04 04:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `details` text NOT NULL,
  `incomming` decimal(12,2) NOT NULL DEFAULT 0.00,
  `outgoing` decimal(12,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `details`, `incomming`, `outgoing`, `balance`, `user`, `created_at`, `updated_at`) VALUES
(1, 'من اعلانات', 20000.00, 0.00, 20000.00, 7, '2024-09-04 02:29:25', '2024-09-04 02:29:25'),
(2, 'مودريتور', 0.00, 5000.00, 15000.00, 7, '2024-09-04 02:29:53', '2024-09-04 02:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `permissions` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `permissions`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Mediawy', 'Mediawy', 'Admin', NULL, '$2y$10$eXmI9UuHm1ibkVsPzWpKHeKzWn7FesGLxEHkmazWGXmsjjFhJZ9Ae', '[\"product\",\"records\",\"orders\",\"shippers\",\"clients\",\"admin\"]', 'EZCF6q8QlBDKmoyhJE98bPMAv2JzPF1WRSLZvVsrqbNvMW4bvH28hRMkd3uc', '2020-06-03 14:18:52', '2023-11-16 20:35:47'),
(63, 'Sara', 'sara', 'Admin', NULL, '$2y$12$S7XKbJTwfkIQ43E5eFMxxu/.oFRcaQD9fSDeMkfcFKe3c3VE4JESa', '[\"product\",\"records\",\"orders\",\"shippers\",\"clients\",\"admin\"]', 'AmpujKc7gCwVdUmlmpovZUqR0IA9DVC4wmXT5U2yZVsPvJZ1E96VdGAUmRWt', '2024-03-05 21:47:37', '2024-09-04 02:11:22'),
(66, 'منه', 'Menna', 'Moderator', NULL, '$2y$12$AMYx4tIRm.1dBW6NC4YVv.E/cfpRXwrQhTsl2zEMICPiAvgo43kj2', '[\"orders\"]', 'Jd5JnDkSY3ehfA3phdoypx0x55ejzeXER5xE27ewshBRbLRt2hVQiwFOKQoV', '2024-07-03 14:17:21', '2024-09-04 03:25:05'),
(67, 'سمية', 'somaia', 'Moderator', NULL, '$2y$12$BhBJUChwowl20n6IJ/LVUu9HZb2mJzDxAceT9tizzKCej7Rxryh4q', '[\"orders\"]', 'mrGPbrYOvkJfaZQWVYJ21PR7Xq5H3eCe8KUybwfZJvha9U9hB5YfL7MUkqm4', '2024-07-07 21:48:18', '2024-09-04 03:25:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_trasnactions`
--
ALTER TABLE `stock_trasnactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_trasnactions`
--
ALTER TABLE `stock_trasnactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
