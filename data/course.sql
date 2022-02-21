-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 18 2022 г., 13:12
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `course`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `idCity` int(11) NOT NULL,
  `nameCity` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`idCity`, `nameCity`, `country`) VALUES
(1, 'Красноярск', 'Россия'),
(2, 'Томск', 'Россия'),
(3, 'Калининград', 'Россия'),
(4, 'Санкт-Петербург', 'Россия'),
(5, 'Москва', 'Россия');

-- --------------------------------------------------------

--
-- Структура таблицы `deliveries`
--

CREATE TABLE `deliveries` (
  `idMarket` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idProvider` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `deliveries`
--

INSERT INTO `deliveries` (`idMarket`, `idProduct`, `idProvider`, `amount`, `cost`) VALUES
(1, 1, 2, 10, 1319990),
(1, 2, 2, 10, 1319990),
(1, 3, 2, 10, 1011990),
(1, 4, 1, 10, 20000),
(1, 5, 1, 10, 21500),
(1, 6, 1, 10, 15800),
(2, 1, 2, 10, 1319990),
(2, 2, 2, 10, 1319990),
(2, 3, 2, 10, 1319990),
(2, 4, 1, 10, 1319990),
(2, 5, 1, 10, 1319990),
(2, 6, 1, 10, 1319990),
(2, 7, 3, 10, 1319990),
(2, 8, 3, 10, 1319990),
(2, 11, 3, 10, 1319990),
(2, 12, 4, 10, 1319990),
(2, 13, 4, 10, 1319990),
(2, 14, 4, 10, 1319990),
(2, 15, 5, 10, 1319990),
(2, 16, 5, 10, 1319990),
(2, 17, 5, 10, 1319990),
(3, 1, 2, 10, 1319990),
(3, 2, 2, 10, 1319990),
(3, 3, 2, 10, 1319990),
(3, 4, 1, 10, 1319990),
(3, 5, 1, 10, 1319990),
(3, 6, 1, 10, 1319990),
(3, 7, 3, 10, 1319990),
(3, 8, 3, 10, 1319990),
(3, 11, 3, 10, 1319990),
(3, 12, 4, 10, 1319990),
(3, 13, 4, 10, 1319990),
(3, 14, 4, 10, 1319990),
(3, 15, 5, 10, 1319990),
(3, 16, 5, 10, 1319990),
(3, 17, 5, 10, 1319990),
(4, 1, 2, 10, 1319990),
(4, 2, 2, 10, 1319990),
(4, 3, 2, 10, 1319990),
(4, 4, 1, 10, 1319990),
(4, 5, 1, 10, 1319990),
(4, 6, 1, 10, 1319990),
(4, 7, 3, 10, 1319990),
(4, 8, 3, 10, 1319990),
(4, 11, 3, 10, 1319990),
(5, 7, 3, 10, 1319990),
(5, 8, 3, 10, 1319990),
(5, 11, 3, 10, 1319990);

-- --------------------------------------------------------

--
-- Структура таблицы `existence`
--

CREATE TABLE `existence` (
  `idMarket` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `existence`
--

INSERT INTO `existence` (`idMarket`, `idProduct`, `amount`, `cost`) VALUES
(1, 1, 10, 1319990),
(1, 2, 10, 1319990),
(1, 3, 10, 1011990),
(1, 4, 10, 20000),
(1, 5, 10, 21500),
(1, 6, 10, 15800),
(2, 1, 10, 1319990),
(2, 2, 10, 1319990),
(2, 3, 10, 1319990),
(2, 4, 10, 1319990),
(2, 5, 10, 1319990),
(2, 6, 10, 1319990),
(2, 7, 10, 1319990),
(2, 8, 10, 1319990),
(2, 11, 10, 1319990),
(2, 12, 10, 1319990),
(2, 13, 10, 1319990),
(2, 14, 10, 1319990),
(2, 15, 10, 1319990),
(2, 16, 10, 1319990),
(2, 17, 10, 1319990),
(3, 1, 10, 1319990),
(3, 2, 10, 1319990),
(3, 3, 10, 1319990),
(3, 4, 10, 1319990),
(3, 5, 10, 1319990),
(3, 6, 10, 1319990),
(3, 7, 10, 1319990),
(3, 8, 10, 1319990),
(3, 11, 10, 1319990),
(3, 12, 10, 1319990),
(3, 13, 10, 1319990),
(3, 14, 10, 1319990),
(3, 15, 10, 1319990),
(3, 16, 10, 1319990),
(3, 17, 10, 1319990),
(4, 1, 10, 1319990),
(4, 2, 10, 1319990),
(4, 3, 10, 1319990),
(4, 4, 10, 1319990),
(4, 5, 10, 1319990),
(4, 6, 10, 1319990),
(4, 7, 10, 1319990),
(4, 8, 10, 1319990),
(4, 11, 10, 1319990),
(5, 7, 10, 1319990),
(5, 8, 10, 1319990),
(5, 11, 10, 1319990);

-- --------------------------------------------------------

--
-- Структура таблицы `markets`
--

CREATE TABLE `markets` (
  `idMarket` int(11) NOT NULL,
  `nameMarket` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `idCity` int(11) DEFAULT NULL,
  `address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `markets`
--

INSERT INTO `markets` (`idMarket`, `nameMarket`, `phone`, `idCity`, `address`) VALUES
(1, 'Спортцех', 98765432198, 1, 'Красноярский рабочий, 53'),
(2, 'Спортмастер', 87654321987, 3, 'Sports Street, 37'),
(3, 'Декатлон', 76543219876, 4, 'Market Street, 93'),
(4, 'Триал спорт', 65432198765, 2, 'Ленина, 18'),
(5, 'Асикс', 54321987654, 5, 'Famous Street, 43');

-- --------------------------------------------------------

--
-- Структура таблицы `people`
--

CREATE TABLE `people` (
  `idPeople` int(11) NOT NULL,
  `namePeople` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` blob DEFAULT NULL,
  `idCity` int(11) NOT NULL,
  `address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idPost` int(11) NOT NULL,
  `idMarket` int(11) NOT NULL,
  `idSection` int(11) NOT NULL,
  `dateEmployment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `people`
--

INSERT INTO `people` (`idPeople`, `namePeople`, `phone`, `email`, `photo`, `idCity`, `address`, `idPost`, `idMarket`, `idSection`, `dateEmployment`) VALUES
(1, 'Кабицин Георгий Филиппович', 79619902297, 'georgiy21@hotmail.com', NULL, 2, 'Вокзальная ул., д. 17, Томск', 1, 4, 1, '2022-01-27'),
(4, 'Авилов Александр Кириллович', 79126447620, 'aleksandr.avilov@hotmail.com', NULL, 1, 'Полярная ул., 29, Красноярск', 1, 1, 1, '2022-01-27'),
(5, 'Негин Егор Давидович', 79782236785, 'egor.negin@gmail.com', NULL, 3, 'ул. Багратиона, 123, Калининград', 1, 2, 1, '2022-01-27'),
(6, 'Эристов Даниил Емельянович', 79439275132, 'daniil15041995@outlook.com', NULL, 4, 'наб. канала Грибоедова, 46, Санкт-Петербург', 1, 3, 1, '2022-01-27'),
(7, 'Юракин Гавриил Дмитриевич', 79701053355, 'gavriil5102@hotmail.com', NULL, 5, 'Ленинский пр-т., 21, Москва', 1, 5, 1, '2022-01-27');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `idPost` int(11) NOT NULL,
  `namePost` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`idPost`, `namePost`, `salary`) VALUES
(1, 'Директор', 60000),
(2, 'Продавец', 30000),
(3, 'Продавец-консультант', 40000),
(4, 'Уборщик', 25000),
(5, 'Амбассадор', 40000),
(6, 'Покупатель', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `idSection` int(11) NOT NULL,
  `nameproduct` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`idProduct`, `idSection`, `nameproduct`, `description`) VALUES
(1, 2, 'S-Works Turbo Levo', NULL),
(2, 2, 'S-Works Epic', NULL),
(3, 2, 'S-Works Epic Hardtail', NULL),
(4, 3, 'Lib Tech Cold Brew', NULL),
(5, 3, 'Arbor Annex', NULL),
(6, 3, 'Burton Ft Leader Board Spt', NULL),
(7, 4, 'DYNABLAST 2', NULL),
(8, 4, 'MAGIC SPEED', NULL),
(11, 4, 'C-PROJECT (METASPEED SKY)', NULL),
(12, 5, 'Aqua Sphere Kayenne Small Polarized', NULL),
(13, 5, 'Arena Cobra Swipe Mirror', NULL),
(14, 5, 'ZOGGS Predator Flex Polarized', NULL),
(15, 6, 'Ракетка для большого тенниса Larsen 300A', NULL),
(16, 6, 'Мячи теннисные BABOLAT Gold All Court 4b', NULL),
(17, 6, 'Ракетка для тенниса KRAFLA TRAIN ALU-CARBON 27', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `providers`
--

CREATE TABLE `providers` (
  `idProvider` int(11) NOT NULL,
  `nameProvider` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idCity` int(11) DEFAULT NULL,
  `address` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `providers`
--

INSERT INTO `providers` (`idProvider`, `nameProvider`, `idCity`, `address`, `phone`) VALUES
(1, 'Орион', 2, 'Энтузиастов, 12', 89456123789),
(2, 'Stels', 3, 'New Street, 243', 25632546565),
(3, 'Real Madrid', 5, 'Beach Streer, 83', 59422789156),
(4, 'Science in Sport', 4, 'Science Street, 47', 25467291854),
(5, 'Спортмастер', 1, 'Мира, 13', 89475615891);

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE `sections` (
  `idSection` int(11) NOT NULL,
  `nameSection` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`idSection`, `nameSection`) VALUES
(1, 'Магазин'),
(2, 'Велосипеды'),
(3, 'Сноуборды и горные лыжи'),
(4, 'Бег'),
(5, 'Плавание'),
(6, 'Теннис');

-- --------------------------------------------------------

--
-- Структура таблицы `structure`
--

CREATE TABLE `structure` (
  `idMarket` int(11) NOT NULL,
  `idSection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `structure`
--

INSERT INTO `structure` (`idMarket`, `idSection`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(5, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`idCity`);

--
-- Индексы таблицы `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`idMarket`,`idProduct`,`idProvider`),
  ADD KEY `idProduct` (`idProduct`),
  ADD KEY `idProvider` (`idProvider`);

--
-- Индексы таблицы `existence`
--
ALTER TABLE `existence`
  ADD PRIMARY KEY (`idMarket`,`idProduct`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Индексы таблицы `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`idMarket`),
  ADD KEY `idCity` (`idCity`);

--
-- Индексы таблицы `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`idPeople`),
  ADD KEY `idCity` (`idCity`),
  ADD KEY `idPost` (`idPost`),
  ADD KEY `idMarket` (`idMarket`),
  ADD KEY `idSection` (`idSection`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idPost`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `idSection` (`idSection`);

--
-- Индексы таблицы `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`idProvider`),
  ADD KEY `idCity` (`idCity`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`idSection`);

--
-- Индексы таблицы `structure`
--
ALTER TABLE `structure`
  ADD PRIMARY KEY (`idMarket`,`idSection`),
  ADD KEY `idSection` (`idSection`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `idCity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `markets`
--
ALTER TABLE `markets`
  MODIFY `idMarket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `people`
--
ALTER TABLE `people`
  MODIFY `idPeople` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `idSection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`idMarket`) REFERENCES `markets` (`idMarket`),
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`),
  ADD CONSTRAINT `deliveries_ibfk_3` FOREIGN KEY (`idProvider`) REFERENCES `providers` (`idProvider`);

--
-- Ограничения внешнего ключа таблицы `existence`
--
ALTER TABLE `existence`
  ADD CONSTRAINT `existence_ibfk_1` FOREIGN KEY (`idMarket`) REFERENCES `markets` (`idMarket`),
  ADD CONSTRAINT `existence_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Ограничения внешнего ключа таблицы `markets`
--
ALTER TABLE `markets`
  ADD CONSTRAINT `markets_ibfk_1` FOREIGN KEY (`idCity`) REFERENCES `cities` (`idCity`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `people_ibfk_1` FOREIGN KEY (`idCity`) REFERENCES `cities` (`idCity`),
  ADD CONSTRAINT `people_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `posts` (`idPost`),
  ADD CONSTRAINT `people_ibfk_3` FOREIGN KEY (`idMarket`) REFERENCES `markets` (`idMarket`),
  ADD CONSTRAINT `people_ibfk_4` FOREIGN KEY (`idSection`) REFERENCES `sections` (`idSection`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`idSection`) REFERENCES `sections` (`idSection`);

--
-- Ограничения внешнего ключа таблицы `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_ibfk_1` FOREIGN KEY (`idCity`) REFERENCES `cities` (`idCity`);

--
-- Ограничения внешнего ключа таблицы `structure`
--
ALTER TABLE `structure`
  ADD CONSTRAINT `structure_ibfk_1` FOREIGN KEY (`idMarket`) REFERENCES `markets` (`idMarket`),
  ADD CONSTRAINT `structure_ibfk_2` FOREIGN KEY (`idSection`) REFERENCES `sections` (`idSection`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
