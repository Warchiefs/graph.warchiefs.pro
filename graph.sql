-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 07 2017 г., 02:55
-- Версия сервера: 5.5.54-0+deb8u1
-- Версия PHP: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `graph`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
`id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_04_21_140316_create_social_accounts_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `social_accounts`
--

CREATE TABLE IF NOT EXISTS `social_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `social_accounts`
--

INSERT INTO `social_accounts` (`user_id`, `provider_user_id`, `provider`, `created_at`, `updated_at`) VALUES
(1, '1227983573965708', 'facebook', '2017-04-21 11:10:27', '2017-04-21 11:10:27'),
(2, '115754175172144376730', 'facebook', '2017-04-21 11:13:53', '2017-04-21 11:13:53'),
(2, '124704947', 'facebook', '2017-04-21 11:25:03', '2017-04-21 11:25:03'),
(3, '398096739', 'facebook', '2017-04-21 11:30:41', '2017-04-21 11:30:41'),
(5, '111594957701576961058', 'facebook', '2017-04-24 17:18:00', '2017-04-24 17:18:00'),
(6, '957093', 'facebook', '2017-04-24 17:18:11', '2017-04-24 17:18:11'),
(7, '1130000019447597', 'facebook', '2017-04-24 17:18:21', '2017-04-24 17:18:21'),
(6, '10213301743846712', 'facebook', '2017-04-25 02:02:13', '2017-04-25 02:02:13'),
(8, '1516251341720619', 'facebook', '2017-04-28 06:09:43', '2017-04-28 06:09:43'),
(8, '113956348139313803890', 'facebook', '2017-05-02 06:32:44', '2017-05-02 06:32:44'),
(8, '4606062', 'facebook', '2017-05-02 06:33:20', '2017-05-02 06:33:20'),
(9, '103922717', 'facebook', '2017-05-02 06:34:02', '2017-05-02 06:34:02');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alexandr  Muradov', 'wowalexmur@yandex.ru', NULL, '88vIwitlDxOwf9BDpiC3GOowQA2DZFvEe4saKscXj9n0Xv4a6ZrC3V7dBIeq', '2017-04-21 11:10:27', '2017-04-21 11:10:27'),
(2, 'Александр Мурадов', 'ialexmur@gmail.com', NULL, 'LG5qWUqDMfMFjs1SdbYsLcYMWtbKuuSxXYcWHR9lICRfP3Fj1dsYlgBlyrwb', '2017-04-21 11:13:53', '2017-04-21 11:13:53'),
(3, 'Pipec Online', 'pipec.online@yandex.ru', NULL, '1ElJAJoMShWcsThiAYihAax4JDsMHQ37p4ceLzeR552pMzGMgeHJGvLWSdS0', '2017-04-21 11:30:41', '2017-04-21 11:30:41'),
(4, 'Uhb', 'kingoffgnome@mail.ru', '$2y$10$6hhLPQ43QSgbCTQ/.jWA0u/QCoLJLTvGE1qtr3EDtuPxarOdFwasK', NULL, '2017-04-21 15:09:37', '2017-04-21 15:09:37'),
(5, 'George Sapronov', 'gsapronov@gmail.com', NULL, 'UVAH0ADbTsU7Icv0oz6mCEQZG4WOKMLsSvzv6N49jF2tlPgmyS8cSgi4lYB9', '2017-04-24 17:18:00', '2017-04-24 17:18:00'),
(6, 'Georgy Sapronov', 'gsapronov@icloud.com', NULL, 'kZPZIvbxs8xZWZ0YUGAZDBViPzJi7Q9piUSDuEcdudQ4yTXzkT3NanBxsF5I', '2017-04-24 17:18:11', '2017-04-24 17:18:11'),
(7, 'Георгий Сапронов', 'gsapronov@parkside.agency', NULL, '3WyNQRQdanURhqTvKyQOrf8aWyD9zMZeGrt5XCfj4o8B89xMgUAZjznN4VhY', '2017-04-24 17:18:21', '2017-04-24 17:18:21'),
(8, 'Egor Aprelsky', 'yegor.aprelsky@gmail.com', NULL, '6pPwHJ551o2Ve37vuhPhpWTsUZUVZwT6e37bkfF8IaLaSV6LXW8ZihjpxGDq', '2017-04-28 06:09:43', '2017-04-28 06:09:43'),
(9, 'Егор Апрельский', 'eaprelsky@yandex.ru', NULL, NULL, '2017-05-02 06:34:02', '2017-05-02 06:34:02');

-- --------------------------------------------------------

--
-- Структура таблицы `workspace`
--

CREATE TABLE IF NOT EXISTS `workspace` (
`id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `own` varchar(255) NOT NULL,
  `users` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `workspace`
--

INSERT INTO `workspace` (`id`, `name`, `color`, `own`, `users`, `created_at`, `updated_at`) VALUES
(1, 'Рабочее пространство №1', '#fff', '2', NULL, '2017-05-06 22:11:56', NULL),
(2, 'Пространство №2', '#fff', '1', NULL, '2017-05-06 22:18:53', NULL),
(3, 'Workspace#1', '#eee', '2', NULL, '2017-05-06 20:26:59', '2017-05-06 20:26:59'),
(4, 'Workspace#1', '#eee', '2', NULL, '2017-05-06 20:27:51', '2017-05-06 20:27:51'),
(5, 'Workspace#1', '#eee', '2', NULL, '2017-05-06 20:27:54', '2017-05-06 20:27:54'),
(6, 'Workspace#1', '#eee', '2', NULL, '2017-05-06 20:27:55', '2017-05-06 20:27:55');

-- --------------------------------------------------------

--
-- Структура таблицы `workspace_permissions`
--

CREATE TABLE IF NOT EXISTS `workspace_permissions` (
`id` int(11) NOT NULL,
  `workspace_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permissions` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `workspace_permissions`
--

INSERT INTO `workspace_permissions` (`id`, `workspace_id`, `user_id`, `permissions`) VALUES
(1, 2, 2, 0),
(2, 1, 2, 0),
(3, 1, 4, 0),
(4, 3, 4, 0),
(5, 1, 5, 0),
(6, 3, 5, 0),
(7, 1, 6, 0),
(8, 3, 6, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`(191));

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workspace`
--
ALTER TABLE `workspace`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workspace_permissions`
--
ALTER TABLE `workspace_permissions`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `workspace`
--
ALTER TABLE `workspace`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `workspace_permissions`
--
ALTER TABLE `workspace_permissions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
