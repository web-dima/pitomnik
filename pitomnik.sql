-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 24 2022 г., 20:53
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pitomnik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `animals`
--

CREATE TABLE `animals` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `type` enum('собака','кошка') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nursery_id` int NOT NULL,
  `sex` enum('мужской','женский') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `age` int NOT NULL,
  `img` varchar(250) NOT NULL,
  `status` enum('в питомнике','зарезервировано','отдан') NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `animals`
--

INSERT INTO `animals` (`id`, `name`, `breed`, `type`, `nursery_id`, `sex`, `age`, `img`, `status`, `date`) VALUES
(4, 'гимби', 'дворняга', 'кошка', 3, 'женский', 2, 'cat1.jpg', 'отдан', '2022-04-24'),
(5, 'сэм', 'лабрадор', 'собака', 3, 'мужской', 1, 'sem.jpg', 'в питомнике', NULL),
(6, 'дик', 'овчарка', 'собака', 5, 'мужской', 4, 'dick.jpg', 'зарезервировано', NULL),
(7, 'бус', 'дворняга', 'собака', 4, 'мужской', 3, 'dog.jpg', 'в питомнике', NULL),
(8, 'рита', 'дворняга', 'кошка', 6, 'женский', 11, 'puma.jpg', 'отдан', '2022-04-24'),
(9, 'барсик', 'дворняга', 'кошка', 3, 'мужской', 5, 'barsik.jpg', 'в питомнике', NULL),
(10, 'кузя', 'дворняга', 'кошка', 6, 'мужской', 3, '18155884.jpg', 'в питомнике', NULL),
(11, 'акро', 'дворняга', 'собака', 3, 'мужской', 19, '86608093.jpg', 'в питомнике', NULL),
(12, 'шин пун хае', 'хомбо', 'собака', 6, 'женский', 1, '1641251591_7-funart-pro-p-sobaki-porodi-kitaiskaya-khokhlataya-zhivo-8.jpg', 'в питомнике', NULL),
(13, 'барон', 'бенгал', 'кошка', 5, 'мужской', 1, 'vvv.jpg', 'в питомнике', NULL),
(14, 'бароб', 'дворняга', 'собака', 3, 'мужской', 7, 'photo_2022-04-24_21-46-18.jpg', 'в питомнике', NULL),
(15, 'йа-йа', 'питбуль', 'собака', 4, 'мужской', 54, 'ffff.jpg', 'в питомнике', NULL),
(16, 'чухала', 'дворняга', 'кошка', 6, 'женский', 5, 'chux.jpg', 'в питомнике', NULL),
(17, 'мара', 'дворняга', 'кошка', 6, 'женский', 7, 'mar.jpg', 'в питомнике', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `nursery`
--

CREATE TABLE `nursery` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `time_work` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nursery`
--

INSERT INTO `nursery` (`id`, `name`, `address`, `phone`, `time_work`, `img`) VALUES
(3, 'областной питомник', 'ул.Пионерская д.6', '89090736788', 'с 8:00 до 20:00', 'pitomnik-pioner.jpg'),
(4, 'питомник им. Бейвеля', 'ул Бейвеля д.27', '89237584141', 'с 12:00 до 16:00', 'pitomnik-beivel.jpg'),
(5, 'питмоник в труп...трубном', 'посёлок Трубный, ул. Садовая д.11', '88005553535', 'с 10:00 до 15:00', 'pitomnik-trup.jpg'),
(6, 'каширинская база', 'ул. Братьев Кашириных д.150', '89175843173', 'с 13:00 до 22:00', 'pitomnik-kasha.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `nursery-animal`
--

CREATE TABLE `nursery-animal` (
  `id` int NOT NULL,
  `nursery_id` int NOT NULL,
  `animal_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `animal_id` int NOT NULL,
  `date` date NOT NULL,
  `status` enum('в обработке','одобрено','завершен','отказано') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `animal_id`, `date`, `status`) VALUES
(8, 4, 6, '2022-04-24', 'в обработке');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('user','admin') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(3, 'ddd', 'hombo@gmail.com', '$2y$10$hwpeFtaYYh1bIItoy8YlH.wk5aBTF7wHVdCkuibftYBMPDbs0T2xq', 'user'),
(4, 'nevajno', 'dps0@inbox.ru', '$2y$10$uIe5aBuSDHkFyYS1OLTg9.iSNZ6/seaw.8FPmvEYh9opBppKrO8Fu', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nursery_id` (`nursery_id`);

--
-- Индексы таблицы `nursery`
--
ALTER TABLE `nursery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nursery-animal`
--
ALTER TABLE `nursery-animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `nursery_id` (`nursery_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`user_id`),
  ADD KEY `animals_id` (`animal_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `nursery`
--
ALTER TABLE `nursery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `nursery-animal`
--
ALTER TABLE `nursery-animal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`nursery_id`) REFERENCES `nursery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `nursery-animal`
--
ALTER TABLE `nursery-animal`
  ADD CONSTRAINT `nursery-animal_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `nursery-animal_ibfk_2` FOREIGN KEY (`nursery_id`) REFERENCES `nursery` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
