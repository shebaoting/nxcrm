-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-09-02 12:04:31
-- 服务器版本： 8.0.12
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `ceshicom`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Index', 'feather icon-bar-chart-2', '/', NULL, NULL),
(2, 0, 11, 'Admin', 'feather icon-settings', NULL, NULL, NULL),
(3, 2, 13, 'Users', NULL, 'auth/users', NULL, NULL),
(4, 2, 14, 'Roles', NULL, 'auth/roles', NULL, NULL),
(5, 2, 15, 'Permission', '', 'auth/permissions', NULL, NULL),
(6, 2, 16, 'Menu', NULL, 'auth/menu', NULL, NULL),
(7, 2, 17, 'Operation log', NULL, 'auth/logs', NULL, NULL),
(8, 0, 2, 'sale', 'fa-bar-chart', NULL, NULL, NULL),
(9, 8, 4, 'customers', 'fa-ship', '/customers', NULL, NULL),
(10, 8, 5, 'contacts', 'fa-user-circle', '/contacts', NULL, NULL),
(11, 8, 7, 'events', 'fa-commenting', '/events', NULL, NULL),
(12, 0, 8, 'contract', 'fa-diamond', NULL, NULL, NULL),
(13, 12, 9, 'contract', 'fa-trophy', '/contracts', NULL, NULL),
(14, 12, 10, 'receipt', 'fa-credit-card', '/receipts', NULL, NULL),
(15, 8, 3, 'leads', 'fa-flag', '/leads', NULL, NULL),
(16, 8, 6, 'opportunitys', 'fa-cc', '/opportunitys', NULL, NULL),
(17, 2, 12, 'settings', 'fa-gear', '/settings', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_operation_log`
--

CREATE TABLE `admin_operation_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, '授权管理', 'auth-management', '', '', 1, 0, NULL, NULL),
(2, '用户管理', 'users', '', '/auth/users*', 3, 1, NULL, NULL),
(3, '角色管理', 'roles', '', '/auth/roles*', 4, 1, NULL, NULL),
(4, '权限管理', 'permissions', '', '/auth/permissions*', 5, 1, NULL, NULL),
(5, '菜单管理', 'menu', '', '/auth/menu*', 6, 1, NULL, NULL),
(6, '操作日志', 'operation-log', '', '/auth/logs*', 7, 1, NULL, NULL),
(7, '销售管理', 'sale', '', '', 8, 0, NULL, NULL),
(8, '客户', 'customers', '', '/customers*', 9, 7, NULL, NULL),
(9, '联系人', 'contacts', '', '/contacts*', 10, 7, NULL, NULL),
(10, '跟进', 'events', '', '/events*', 11, 7, NULL, NULL),
(11, '合同', 'contract', '', '/contracts*', 12, 7, NULL, NULL),
(12, '收款', 'receipts', '', '/receipts*', 13, 7, NULL, NULL),
(13, '线索', 'leads', '', '/leads*', 14, 7, NULL, NULL),
(14, '商机', 'opportunitys', '', '/opportunitys*', 15, 7, NULL, NULL),
(15, '系统设置', 'settings', '', '/settings*', 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_permission_menu`
--

CREATE TABLE `admin_permission_menu` (
  `permission_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, '创始人', 'administrator', NULL, NULL),
(2, '职员', 'staff', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_menu`
--

CREATE TABLE `admin_role_menu` (
  `role_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 9, NULL, NULL),
(2, 9, NULL, NULL),
(1, 10, NULL, NULL),
(2, 10, NULL, NULL),
(1, 8, NULL, NULL),
(2, 8, NULL, NULL),
(1, 2, NULL, NULL),
(1, 3, NULL, NULL),
(1, 4, NULL, NULL),
(1, 6, NULL, NULL),
(1, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_permissions`
--

CREATE TABLE `admin_role_permissions` (
  `role_id` bigint(20) NOT NULL,
  `permission_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_permissions`
--

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(2, 8, NULL, NULL),
(2, 9, NULL, NULL),
(2, 10, NULL, NULL),
(2, 11, NULL, NULL),
(2, 12, NULL, NULL),
(2, 13, NULL, NULL),
(2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_users`
--

CREATE TABLE `admin_role_users` (
  `role_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$E98cUgucbSyEQbTARwj/mecinjzih3zTLLO3SgZ5T1U/qQ9AJe2Em', 'admin', 'images/9a9f560f0cafa5fa2b9356acdc5a40a2.jpg', 'eIhLhW3Qvm2nuuRDhsaI1MaWa6S8zoKic4UD2MBy6t2spy5uLwua0MaPakOV', NULL, NULL),
(2, 'niutiezhu', '$2y$10$E98cUgucbSyEQbTARwj/mecinjzih3zTLLO3SgZ5T1U/qQ9AJe2Em', 'niutiezhu', 'images/9a9f560f0cafa5fa2b9356acdc5a40a2.jpg', 'eIhLhW3Qvm2nuuRDhsaI1MaWa6S8zoKic4UD2MBy6t2spy5uLwua0MaPakOV', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `files` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `customer_id` int(11) NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `opportunity_id` int(11) DEFAULT NULL,
  `electronic` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wechat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `contracts`
--

CREATE TABLE `contracts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `total` int(11) DEFAULT NULL,
  `salesexpenses` int(11) DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `signdate` date NOT NULL,
  `expiretime` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `state` int(11) NOT NULL DEFAULT '0',
  `admin_users_id` int(11) DEFAULT NULL,
  `email` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'http://',
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2016_01_04_173148_create_admin_tables', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_17_063418_create_customers_table', 1),
(5, '2020_07_17_073246_create_contacts_table', 1),
(6, '2020_07_17_080145_add_customer_id_into_contacts', 1),
(7, '2020_07_17_082057_add_wechat_into_contacts', 1),
(8, '2020_07_26_113513_add_admin_users_id_into_customers', 1),
(9, '2020_07_30_031757_create_events_table', 1),
(10, '2020_08_01_110318_create_contracts_table', 1),
(11, '2020_08_02_115518_add_order_into_contracts', 1),
(12, '2020_08_03_124345_add_total_remark_salesexpenses_into_contracts', 1),
(13, '2020_08_03_132717_create_receipts_table', 1),
(14, '2020_08_04_100507_create_attachments_table', 1),
(15, '2020_08_06_050554_add_contract_id_into_events', 1),
(16, '2020_08_07_122139_add_state_into_customers', 1),
(17, '2020_08_08_170717_create_opportunitys_table', 1),
(18, '2020_08_08_171550_add_customer_id_into_opportunitys', 1),
(19, '2020_08_08_225435_add_opportunity_id_into_events', 1),
(20, '2020_08_08_225509_add_opportunity_id_into_attachments', 1),
(21, '2020_08_11_110308_add_state_into_opportunitys', 1),
(22, '2020_08_12_124732_create_settings_table', 1),
(23, '2020_08_12_175518_add_id_into_settings', 1),
(24, '2020_08_14_215301_update_receive_into_receipts', 1),
(25, '2020_08_17_140414_update_address_into_customers', 1),
(26, '2020_09_01_221538_seed_menu_data', 2),
(27, '2020_09_01_224120_seed_admin_user_data', 3),
(28, '2020_09_01_224840_seed_admin_menu_data', 4),
(29, '2020_09_01_231117_seed_admin_roles_data', 5),
(30, '2020_09_01_231553_seed_admin_role_menu_data', 6),
(31, '2020_09_01_232347_seed_admin_role_permissions_data', 7),
(32, '2020_09_01_232632_seed_admin_role_users_data', 8),
(33, '2020_09_02_115124_seed_settings_data', 9);

-- --------------------------------------------------------

--
-- 表的结构 `opportunitys`
--

CREATE TABLE `opportunitys` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expectincome` int(11) NOT NULL DEFAULT '0',
  `expectendtime` date NOT NULL,
  `dealchance` int(11) NOT NULL DEFAULT '0',
  `tempo` int(11) NOT NULL DEFAULT '1',
  `state` int(11) NOT NULL DEFAULT '1',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `receipts`
--

CREATE TABLE `receipts` (
  `id` int(10) UNSIGNED NOT NULL,
  `receive` decimal(9,2) NOT NULL,
  `paymethod` int(11) NOT NULL,
  `billtype` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

CREATE TABLE `settings` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `settings`
--

INSERT INTO `settings` (`key`, `value`, `id`) VALUES
('crmname', 'NXCRM', 1),
('crmurl', 'http://crm.com', 2),
('color', 'green', 3),
('logo', 'images/cd72985037b83d82150b76d50b12cf53.png', 4),
('body_class', '111', 5);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转储表的索引
--

--
-- 表的索引 `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_operation_log_user_id_index` (`user_id`);

--
-- 表的索引 `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permissions_slug_unique` (`slug`);

--
-- 表的索引 `admin_permission_menu`
--
ALTER TABLE `admin_permission_menu`
  ADD UNIQUE KEY `admin_permission_menu_permission_id_menu_id_unique` (`permission_id`,`menu_id`);

--
-- 表的索引 `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_roles_slug_unique` (`slug`);

--
-- 表的索引 `admin_role_menu`
--
ALTER TABLE `admin_role_menu`
  ADD UNIQUE KEY `admin_role_menu_role_id_menu_id_unique` (`role_id`,`menu_id`);

--
-- 表的索引 `admin_role_permissions`
--
ALTER TABLE `admin_role_permissions`
  ADD UNIQUE KEY `admin_role_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`);

--
-- 表的索引 `admin_role_users`
--
ALTER TABLE `admin_role_users`
  ADD UNIQUE KEY `admin_role_users_role_id_user_id_unique` (`role_id`,`user_id`);

--
-- 表的索引 `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`);

--
-- 表的索引 `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `opportunitys`
--
ALTER TABLE `opportunitys`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 使用表AUTO_INCREMENT `opportunitys`
--
ALTER TABLE `opportunitys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
