-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 17 2022 г., 13:31
-- Версия сервера: 5.7.24
-- Версия PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mrc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `appointments`
--

CREATE TABLE `appointments` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BOOKED',
  `performer_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `appointments`
--

INSERT INTO `appointments` (`id`, `status`, `performer_id`, `created_at`, `updated_at`) VALUES
('58a16191-f843-485b-958d-c00549158b61', 'ARRIVED', 'd3880af0-13c9-11ed-907a-d45d646bc9f2', '2022-10-16 14:39:14', '2022-10-17 01:08:42'),
('59fb5975-ae82-4575-b3ca-ac26755d1523', 'BOOKED', 'd3880af0-13c9-11ed-907a-d45d646bc9f2', '2022-10-17 00:46:02', '2022-10-17 00:46:02'),
('62c52959-f52f-4505-9053-78cab483146d', 'BOOKED', 'd3880af0-13c9-11ed-907a-d45d646bc9f2', '2022-10-17 03:19:41', '2022-10-17 03:19:41'),
('c3b6f2b8-fa1e-44f0-8b6e-057a9c9323fe', 'BOOKED', 'd3880af0-13c9-11ed-907a-d45d646bc9f2', '2022-10-16 14:41:26', '2022-10-16 14:41:26');

-- --------------------------------------------------------

--
-- Структура таблицы `appointment_identifiers`
--

CREATE TABLE `appointment_identifiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `appointment_identifiers`
--

INSERT INTO `appointment_identifiers` (`id`, `appointment_id`, `identifier_id`, `created_at`, `updated_at`) VALUES
(1, '58a16191-f843-485b-958d-c00549158b61', '8453c7e7-9303-422b-8b19-b8e9fdd8b750', NULL, NULL),
(2, 'c3b6f2b8-fa1e-44f0-8b6e-057a9c9323fe', '88f61c39-7612-40d4-a289-9d625176192f', NULL, NULL),
(3, '59fb5975-ae82-4575-b3ca-ac26755d1523', '0a318186-5246-4b36-8949-b1f19e2b5fe9', NULL, NULL),
(4, '62c52959-f52f-4505-9053-78cab483146d', '9ecf0c62-c26d-4440-8679-7f5ea3efbf47', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `appointment_participants`
--

CREATE TABLE `appointment_participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `participant_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `appointment_participants`
--

INSERT INTO `appointment_participants` (`id`, `appointment_id`, `participant_id`, `created_at`, `updated_at`) VALUES
(1, '58a16191-f843-485b-958d-c00549158b61', 'e84abf7e-13dc-11ed-a75f-d45d646bc9f2', NULL, NULL),
(2, '58a16191-f843-485b-958d-c00549158b61', '1bde98b0-13dd-11ed-9c13-d45d646bc9f2', NULL, NULL),
(3, 'c3b6f2b8-fa1e-44f0-8b6e-057a9c9323fe', 'e84abf7e-13dc-11ed-a75f-d45d646bc9f2', NULL, NULL),
(4, 'c3b6f2b8-fa1e-44f0-8b6e-057a9c9323fe', '1bde98b0-13dd-11ed-9c13-d45d646bc9f2', NULL, NULL),
(5, '59fb5975-ae82-4575-b3ca-ac26755d1523', 'e84abf7e-13dc-11ed-a75f-d45d646bc9s2', NULL, NULL),
(6, '59fb5975-ae82-4575-b3ca-ac26755d1523', '1bde98b0-13dd-11ed-9c13-d45d646bc1f2', NULL, NULL),
(7, '62c52959-f52f-4505-9053-78cab483146d', 'e84abf7e-13dc-11ed-a75f-d45d646bc9f2', NULL, NULL),
(8, '62c52959-f52f-4505-9053-78cab483146d', '1bde98b0-13dd-11ed-9c13-d45d646bc9f2', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `identifiers`
--

CREATE TABLE `identifiers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `assigner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `identifiers`
--

INSERT INTO `identifiers` (`id`, `use`, `type`, `system`, `value`, `start_date`, `end_date`, `assigner`, `created_at`, `updated_at`) VALUES
('0a318186-5246-4b36-8949-b1f19e2b5fe9', 'secondary', 'RI', 'http://company.uz', '81122', '2022-05-17 19:00:00', NULL, 'Company LLC', '2022-10-17 00:46:01', '2022-10-17 00:46:01'),
('8453c7e7-9303-422b-8b19-b8e9fdd8b750', 'secondary', 'RI', 'http://some-company.uz', '84152', '2022-05-17 19:00:00', NULL, 'SomeCompany LLC', '2022-10-16 14:39:14', '2022-10-16 14:39:14'),
('88f61c39-7612-40d4-a289-9d625176192f', 'secondary', 'RI', 'http://some-company.uz', '84122', '2022-05-17 19:00:00', NULL, 'SomeCompany LLC', '2022-10-16 14:41:26', '2022-10-16 14:41:26'),
('9ecf0c62-c26d-4440-8679-7f5ea3efbf47', 'secondary', 'RI', 'http://some-company.uz', '841222', '2022-05-17 19:00:00', NULL, 'SomeCompany LLC', '2022-10-17 03:19:41', '2022-10-17 03:19:41');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2019_08_19_000000_create_failed_jobs_table', 1),
(13, '2022_10_16_112756_create_participants_table', 1),
(14, '2022_10_16_112756_create_performers_table', 1),
(15, '2022_10_16_113018_create_identifiers_table', 1),
(16, '2022_10_16_114202_create_appointments_table', 1),
(17, '2022_10_16_164315_appointment_identifiers_table', 1),
(18, '2022_10_16_164410_appointment_participants_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `participants`
--

CREATE TABLE `participants` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `participants`
--

INSERT INTO `participants` (`id`, `reference`, `prefix`, `created_at`, `updated_at`) VALUES
('1bde98b0-13dd-11ed-9c13-d45d646bc1f2', 'Patient/1bde98b0-13dd-11ed-9c13-d45d646bc1f2', 'Patient', '2022-10-17 00:46:02', '2022-10-17 00:46:02'),
('1bde98b0-13dd-11ed-9c13-d45d646bc9f2', 'Patient/1bde98b0-13dd-11ed-9c13-d45d646bc9f2', 'Patient', '2022-10-16 14:39:14', '2022-10-16 14:39:14'),
('e84abf7e-13dc-11ed-a75f-d45d646bc9f2', 'Practitioner/e84abf7e-13dc-11ed-a75f-d45d646bc9f2', 'Practitioner', '2022-10-16 14:39:14', '2022-10-16 14:39:14'),
('e84abf7e-13dc-11ed-a75f-d45d646bc9s2', 'Practitioner/e84abf7e-13dc-11ed-a75f-d45d646bc9s2', 'Practitioner', '2022-10-17 00:46:01', '2022-10-17 00:46:01');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `performers`
--

CREATE TABLE `performers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `performers`
--

INSERT INTO `performers` (`id`, `reference`, `prefix`, `created_at`, `updated_at`) VALUES
('d3880af0-13c9-11ed-907a-d45d646bc9f2', 'Organization/d3880af0-13c9-11ed-907a-d45d646bc9f2', 'Organization', '2022-10-16 14:39:14', '2022-10-16 14:39:14');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `appointment_identifiers`
--
ALTER TABLE `appointment_identifiers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `appointment_participants`
--
ALTER TABLE `appointment_participants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `identifiers`
--
ALTER TABLE `identifiers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifiers_value_unique` (`value`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `performers`
--
ALTER TABLE `performers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appointment_identifiers`
--
ALTER TABLE `appointment_identifiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `appointment_participants`
--
ALTER TABLE `appointment_participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
