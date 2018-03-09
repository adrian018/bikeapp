-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2017 at 03:54 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bike`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `timeline_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `likes` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `timeline_id`, `comment`, `likes`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eleifend arcu ac tortor imperdiet porttitor. Curabitur euismod ex eros, in imperdiet velit egestas ut. ', NULL, '2017-12-19 13:41:15', '2017-12-19 13:41:15'),
(2, 1, 1, 'Sed id urna vel sem vestibulum porta vel semper felis. Aenean blandit sem tellus, quis sodales lorem dignissim eu. Nunc eu enim tellus. Vivamus turpis lacus, lacinia eget lacus vitae, posuere luctus ante. ', NULL, '2017-12-19 13:41:15', '2017-12-19 13:41:15'),
(3, 1, 1, 'Proin eu massa eu urna volutpat hendrerit. Aenean lacinia arcu sapien, ut lacinia nisl laoreet ac', NULL, '2017-12-20 08:12:28', '2017-12-20 08:12:28'),
(4, 3, 1, 'tsdtsd', NULL, '2017-12-21 09:11:23', '2017-12-21 09:11:23'),
(5, 3, 1, 'asdfsadfasdf', NULL, '2017-12-21 09:23:01', '2017-12-21 09:23:01'),
(6, 3, 5, 'Test 123', NULL, '2017-12-21 11:35:52', '2017-12-21 11:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_29_082731_create_timelines_table', 1),
(4, '2017_12_19_142238_comments', 2),
(6, '2017_12_22_131309_users_meta_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timelines`
--

CREATE TABLE `timelines` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `track` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `likes` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '{"like":0,"dislike":"0"}',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timelines`
--

INSERT INTO `timelines` (`id`, `user_id`, `track_id`, `info`, `track`, `likes`, `created_at`, `updated_at`) VALUES
(1, 1, 1987, 'a:6:{i:0;s:9:\"bike2work\";i:1;s:5:\"13.17\";i:2;s:4:\"23.4\";i:3;s:2:\"33\";i:4;s:4:\"7.21\";i:5;s:5:\"Share\";}', 'g_hnGqvg~C|@nHhDvOyQzL{FhFgHzDeFtGkDZc@aBqA]gLR{RU{Ab@}Cs@s\\o@yEjE{Cvb@qDdHut@fZeK|CHlCgZzgAkB`DeJtJ_GbAs@bAe@tEDvEzBre@cAvHv@|A', '{\"like\":66,\"dislike\":16}', '2017-11-29 11:15:30', '2017-12-22 12:49:21'),
(3, 1, 10059, 'a:6:{i:0;s:9:\"bike2work\";i:1;s:5:\"10.84\";i:2;s:4:\"23.4\";i:3;s:2:\"38\";i:4;s:4:\"6.78\";i:5;s:5:\"Share\";}', 'g~gnG}ng~C|DlOQtAqTtMcN|Ka@jAoCjCoIxBaCbBuBj@wBjCiBFeF|AsDjBq@hA}Dv@ah@`SqB{@yAA{ApCaIvDkq@rW_DBWvEg[zhAyBjDgJzIeFp@u@fAa@nD@xFbCne@SvDw@tC~@pA', '{\"like\":8,\"dislike\":14}', '2017-11-29 12:21:51', '2017-12-22 12:13:24'),
(4, 1, 47204, 'a:6:{i:0;s:9:\"bike2work\";i:1;s:5:\"15.71\";i:2;s:5:\"23.29\";i:3;s:2:\"25\";i:4;s:4:\"6.65\";i:5;s:5:\"Share\";}', 'mvonGsf~}C{@}A`AmDH}EqCeg@d@aKtG{@vJ_J`BaCrZehAMyCn@kB~Aa@hAd@|HeEnCk@rh@gSxC{AzAaDxCbAbd@kQ`GmC~@mA`ATpK}DzAcCfAX`MkGnCFrBgA`H{FTiAtBkBdQsL|HgERq@c@_C}BiKcAaAKoB', '{\"like\":3,\"dislike\":8}', '2017-11-29 12:21:53', '2017-12-22 12:13:42'),
(5, 2, 40418, 'a:6:{i:0;s:9:\"bike2work\";i:1;s:6:\"155.23\";i:2;s:1:\"0\";i:3;s:1:\"1\";i:4;s:4:\"1.29\";i:5;s:5:\"Share\";}', 'g_enGax{}CGvApJeK|Hkx@\\wVkBiLmAyUO_n@~h@qs@', '{\"like\":7,\"dislike\":0}', '2017-11-29 12:25:34', '2017-12-22 12:15:09'),
(6, 1, 42817, 'a:5:{i:0;s:9:\"bike2work\";i:1;s:5:\"14.63\";i:2;s:4:\"21.2\";i:3;s:2:\"26\";i:4;s:4:\"6.44\";}', 'uuonGsf~}C[FcAgChA{BTqBeCoe@OuH`@uEtGeAjJwItCyExHyXnA}G|Lwa@KyEd@{BhA[vB^fFkC|P{Fta@oPxBmDbDv@tk@eUv@uAt@RhJoD`Ac@hAsBpAThLqFvADxCgAjCiBZeArCsCpHeF@_@xKsGgAcNl@}@KcDdAcB', '{\"like\":0,\"dislike\":0}', '2017-11-29 13:43:50', '2017-11-29 13:43:50'),
(7, 1, 44185, 'a:5:{i:0;s:9:\"bike2work\";i:1;s:5:\"16.18\";i:2;s:5:\"22.97\";i:3;s:2:\"24\";i:4;s:4:\"6.51\";}', 'cvonGgg~}C^b@cAa@s@_BnA{CNkCkCmj@f@yIlGy@~MkNpYgfAXqCS{Ad@wAhAa@lBZfJiEtg@eRfH}Cn@yBt@i@hAPp@r@|Ae@|i@mTv@iAbAL~KmErAoBt@XvMoGh@TvCWrIwJvFuE`B]pI}GlKuFwCqN{AuCIgB', '{\"like\":3,\"dislike\":0}', '2017-12-19 08:33:23', '2017-12-22 12:15:48'),
(8, 1, 45273, 'a:5:{i:0;s:9:\"bike2work\";i:1;s:5:\"15.61\";i:2;s:5:\"23.26\";i:3;s:2:\"25\";i:4;s:4:\"6.61\";}', 'uuonGcg~}CSPy@iB~@mCR{DeAuOiA_`@h@kB~F_AtJiJ|CuFzX}bAl@oH|@[|@PpF{AtDuBnCk@d]{NbBWrIyDr@mBfAy@vBx@nO_Fl\\aNt@yAx@@dJaDtCuCtALrL}Fj@`@~C]n@qArBcAdF_GC[xDcDhYuPqDaPiAqACaB', '{\"like\":5,\"dislike\":3}', '2017-12-19 09:07:53', '2017-12-22 12:44:35'),
(9, 1, 50166, 'a:5:{i:0;s:9:\"bike2work\";i:1;s:5:\"16.36\";i:2;s:5:\"23.94\";i:3;s:2:\"25\";i:4;s:4:\"6.72\";}', 'evonG_g~}C_AwAbA_DJeCsC}j@d@aIP_@dGm@tJoJvBwDjXibAp@kDQgBX{BrAe@~Af@hJsEvMyD~a@uPfBkD|Cz@dl@gU|@sAz@TbLaEz@qB~AHlMeGd@J`EuAjDqCvBiDn@FNy@rB_B|ZkRwCwNsAyBEiC', '{\"like\":3,\"dislike\":0}', '2017-12-19 09:08:39', '2017-12-22 12:34:59'),
(10, 1, 44523, 'a:5:{i:0;s:9:\"bike2work\";i:1;s:5:\"17.01\";i:2;s:5:\"25.02\";i:3;s:2:\"23\";i:4;s:4:\"6.55\";}', 'mvonGog~}C_@Ig@_B`AoBVaCkC{j@f@uJhGq@zJsJjByCdCmGnUc}@XoBYoB`@uAfAg@xA`@dBk@xH}DtFyAje@aRjAg@bBgDjD|@nk@gUn@gAnBEjKiEfAiB~ANlL}F|@VpCSz@{AbBeAjJcKbZ_RDiAcDeNgA}@CwA', '{\"like\":17,\"dislike\":0}', '2017-12-19 10:23:07', '2017-12-22 12:34:06'),
(11, 1, 44911, 'a:5:{i:0;s:9:\"bike2work\";i:1;s:5:\"16.35\";i:2;s:5:\"22.36\";i:3;s:2:\"24\";i:4;s:4:\"6.09\";}', '{uonG_g~}CsAiBxAuDDcCkC_j@b@gIj@c@tEe@bCyBlHmH|C{H^GDcBrU}{@NcAc@sBp@wBnA[jBNzJwEt@?v_@aOdMkFxAwC|ADx@r@rCy@`g@mSnAqAlAFbKqExAmBhCIhK}Et@\\hD]xCeExEuDjAsBn\\kTaDePmAwAFsA', '{\"like\":16,\"dislike\":0}', '2017-12-19 10:23:09', '2017-12-22 12:32:52'),
(12, 1, 45579, 'a:5:{i:0;s:9:\"bike2work\";i:1;s:5:\"14.12\";i:2;s:5:\"20.81\";i:3;s:2:\"30\";i:4;s:4:\"7.11\";}', 's~gnGgsg~CUpA|DfObAfAI|@kQdK}HzGoDrBcHpHW|@iDZS}AqAs@}a@Cy@t@mA_Am^cAUh@XZMzDkDPEm@_Ae@oA~@sD|GwCbJsA`IzE`IIvA{{@t]gBYeAb@_@|@HzDs@tDiYdcAwM`NiGv@e@hLdCnf@YrEeAtBx@pBXC', '{\"like\":0,\"dislike\":0}', '2017-12-19 10:23:10', '2017-12-19 10:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test1234', 'test@test.com', '$2y$10$Y5k99NO.LeJjkAXKCPWktuBcYxDldztmFvJEXlwr0fmXBVIRLP1.m', '1511703379.jpg', 'bcM5NAtueCXVSqyoPifpkwAFHzsIbbZgfllnPWEbSGyeKpmEJJC7mYVnEJWS', '2017-10-21 05:53:36', '2017-11-26 09:36:19'),
(2, 'test22', 'test2@test.com', '$2y$10$YFeTysXh/YGRDYosO2H5deQPaltLrbM/HwB6/e3v9jgJbxJx2M8Iu', 'default.jpg', 'IFFUQ761tZXI1iz3UtknwgXDlWMueJ9kdLBbvXnnRk0wrWBJlke6HBu4YisR', '2017-11-22 06:05:32', '2017-11-27 04:33:11'),
(3, 'test', 'test3@test.com', '$2y$10$.cIjVlPwa0gG7paFx92R3O8.I9aUuzB85RWogQSoyYXR1rHRSzZf2', 'default.jpg', NULL, '2017-11-26 10:00:00', '2017-11-26 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_meta`
--

CREATE TABLE `users_meta` (
  `umeta_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `meta_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `meta_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_meta`
--

INSERT INTO `users_meta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'like', '8'),
(2, 1, 'like', '8'),
(3, 1, 'like', '8'),
(4, 1, 'like', '8'),
(5, 1, 'like', '8'),
(6, 1, 'like', '8'),
(7, 1, 'like', '8'),
(8, 1, 'like', '1'),
(9, 1, 'like', '1'),
(10, 1, 'like', '1'),
(11, 1, 'like', '1'),
(12, 1, 'like', '1'),
(13, 1, 'like', '1'),
(14, 1, 'like', '1'),
(15, 1, 'like', '1'),
(16, 1, 'like', '1'),
(17, 1, 'like', '1'),
(18, 1, 'like', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_meta`
--
ALTER TABLE `users_meta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `users_meta_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timelines`
--
ALTER TABLE `timelines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_meta`
--
ALTER TABLE `users_meta`
  MODIFY `umeta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_meta`
--
ALTER TABLE `users_meta`
  ADD CONSTRAINT `users_meta_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
