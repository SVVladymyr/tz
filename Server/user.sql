-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 27 2016 г., 13:41
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `user`
--

-- --------------------------------------------------------

--
-- Структура таблицы `reg_login_attempt`
--

CREATE TABLE `reg_login_attempt` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` int(11) UNSIGNED DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `reg_login_attempt`
--

INSERT INTO `reg_login_attempt` (`id`, `email`, `ts`, `ip`, `hash`) VALUES
(5, 'svvladymyr@yandex.ru', '2016-03-27 12:38:31', NULL, '56f7c63774e40');

-- --------------------------------------------------------

--
-- Структура таблицы `reg_users`
--

CREATE TABLE `reg_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `registered` tinyint(1) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `photo` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `token_validity` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `reg_users`
--

INSERT INTO `reg_users` (`id`, `email`, `registered`, `token`, `name`, `photo`, `password`, `token_validity`) VALUES
(15, 'svvladymyr@yandex.ru', 1, '', 'vova', NULL, '$2y$12$Dz9mWmuaxONTrmq4f48OJucR64DafnfLgR/oTS7CXKpQW6YWekju6', '2016-03-27 12:32:27');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `reg_login_attempt`
--
ALTER TABLE `reg_login_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reg_users`
--
ALTER TABLE `reg_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `reg_login_attempt`
--
ALTER TABLE `reg_login_attempt`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `reg_users`
--
ALTER TABLE `reg_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
