-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 10 2025 г., 22:45
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `booke`
--

-- --------------------------------------------------------

--
-- Структура таблицы `exchange_request`
--

CREATE TABLE `exchange_request` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `exchange_request`
--

INSERT INTO `exchange_request` (`id`, `from_user_id`, `to_user_id`, `book_title`, `book_author`, `message`, `status`, `created_at`) VALUES
(1, 2, 1, '1', '2', '3', 'pending', '2025-10-10 18:23:21'),
(2, 3, 1, '11', '11', '11', 'pending', '2025-10-10 18:37:05'),
(3, 2, 3, '11', '11', '11', 'accepted', '2025-10-10 18:37:36'),
(4, 3, 3, 'ыф', 'выф', '', 'accepted', '2025-10-10 18:45:49');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`) VALUES
(1, '111', '$2y$13$Pjct1KJS4lnkutOhh25Ef.SF8I5QIsA8agNWTGq3urEEDKF3yjtJ2'),
(2, '22', '$2y$13$pcA0q4h8L76Y9rbwVBUNUuYq7PdQ.Tzbt0emzNdLChW.4PYDrXquC'),
(3, '11', '$2y$13$VDO9GPpX7wUS97.nFLPJIeoVO/khnOvExHRHtmR/FJnoZh0V6HTaO'),
(4, '232', '$2y$13$oUKMrWY7dguOIhsJwXNaI.vJMO7YYNEbmu7fIOMO0RhxrxsJV1.zO');

-- --------------------------------------------------------

--
-- Структура таблицы `user_book`
--

CREATE TABLE `user_book` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('available','exchanged') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_book`
--

INSERT INTO `user_book` (`id`, `user_id`, `title`, `author`, `description`, `status`, `created_at`) VALUES
(1, 3, 'ыф', 'выф', 'выф', 'available', '2025-10-10 18:35:22'),
(2, 3, 'ыф', 'выф', 'выф', 'available', '2025-10-10 18:36:08'),
(3, 3, '11', '11', '11', 'available', '2025-10-10 18:36:47');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `exchange_request`
--
ALTER TABLE `exchange_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индексы таблицы `user_book`
--
ALTER TABLE `user_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `exchange_request`
--
ALTER TABLE `exchange_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user_book`
--
ALTER TABLE `user_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `exchange_request`
--
ALTER TABLE `exchange_request`
  ADD CONSTRAINT `exchange_request_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `exchange_request_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_book`
--
ALTER TABLE `user_book`
  ADD CONSTRAINT `user_book_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
