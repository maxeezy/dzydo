-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.1.91
-- Время создания: Июн 23 2020 г., 19:35
-- Версия сервера: 5.7.26-29
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `a0440803_dzydo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, '7'),
(3, '8'),
(4, '9'),
(5, '10'),
(6, '11'),
(7, '12'),
(8, '13');

-- --------------------------------------------------------

--
-- Структура таблицы `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `club`
--

INSERT INTO `club` (`id`, `name`) VALUES
(1, 'Без клуба'),
(2, 'america top team'),
(3, 'kek');

-- --------------------------------------------------------

--
-- Структура таблицы `fights`
--

CREATE TABLE `fights` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `fight_after_id` int(11) DEFAULT NULL,
  `fighter_1_id` int(11) DEFAULT NULL,
  `fighter_2_id` int(11) DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  `type_win_id` int(11) DEFAULT NULL,
  `tatami_name` int(11) DEFAULT NULL,
  `score_fighter_1` int(11) DEFAULT NULL,
  `score_fighter_2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `fights`
--

INSERT INTO `fights` (`id`, `tournament_id`, `stage_id`, `fight_after_id`, `fighter_1_id`, `fighter_2_id`, `winner`, `type_win_id`, `tatami_name`, `score_fighter_1`, `score_fighter_2`) VALUES
(57, 4, 3, 60, 11, 13, 11, 1, NULL, 6, 1),
(58, 4, 3, 60, 12, 7, 12, 2, NULL, 1, 0),
(59, 4, 4, NULL, 13, 7, 7, 4, NULL, 3, 3),
(60, 4, 5, NULL, 11, 12, 11, 1, NULL, 12, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `result`
--

INSERT INTO `result` (`id`, `name`) VALUES
(1, 'Предстоит'),
(2, '1/8'),
(3, '1/4'),
(4, '1/2'),
(5, 'low-final'),
(6, 'final');

-- --------------------------------------------------------

--
-- Структура таблицы `sex`
--

CREATE TABLE `sex` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `sex`
--

INSERT INTO `sex` (`id`, `name`) VALUES
(0, 'Нет данных'),
(1, 'Мужской'),
(2, 'Женский');

-- --------------------------------------------------------

--
-- Структура таблицы `stage`
--

CREATE TABLE `stage` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `stage`
--

INSERT INTO `stage` (`id`, `name`) VALUES
(1, '1/8'),
(2, '1/4'),
(3, '1/2'),
(4, 'low-final'),
(5, 'final');

-- --------------------------------------------------------

--
-- Структура таблицы `tournament`
--

CREATE TABLE `tournament` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sex_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `weight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` date NOT NULL,
  `gold` int(11) DEFAULT NULL,
  `silver` int(11) DEFAULT NULL,
  `bronze` int(11) DEFAULT NULL,
  `toss` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tournament`
--

INSERT INTO `tournament` (`id`, `name`, `sex_id`, `category_id`, `weight`, `data`, `gold`, `silver`, `bronze`, `toss`) VALUES
(4, 'Чемпионат киборгов', 1, 4, '35-38', '2020-06-10', 11, 12, 7, 'DONE'),
(5, 'Смертельная битва', 1, 5, '40-43', '2020-06-22', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tournament_participant`
--

CREATE TABLE `tournament_participant` (
  `tournament_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tournament_participant`
--

INSERT INTO `tournament_participant` (`tournament_id`, `user_id`, `result_id`) VALUES
(4, 7, 5),
(4, 11, 6),
(4, 12, 6),
(4, 13, 5),
(5, 15, 1),
(5, 16, 1),
(5, 17, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `patronymic` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_of_birth` date DEFAULT NULL,
  `sex_id` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `club_id` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `country`, `city`, `email`, `data_of_birth`, `sex_id`, `weight`, `club_id`, `role`, `password`) VALUES
(7, 'Арнольд', 'Шварц', 'Шварц', 'Америка', 'Миннеаполис', 'arnold6@mail.ru', '2011-02-05', 1, 36, 2, 'user', '123456'),
(10, 'admin', 'admin', 'admin', NULL, NULL, 'admin@mail.ru', NULL, 0, NULL, 1, 'admin', '123456'),
(11, 'Джеки', 'Чан', 'Очакович', 'Китай', 'Шанхай', 'chan@mail.ru', '2011-06-06', 1, 36, 1, 'user', '123456'),
(12, 'Жанклод', 'Вандам', 'Вандамов', 'Америка', 'Чикаго', 'klod@mail.ru', '2011-05-09', 1, 37, 2, 'user', '123456'),
(13, 'Сильвестр', 'Сталлоне', 'Аркадьевич', 'Америка', 'Бостон', 'silver@mail.ru', '2011-02-13', 1, 36, 2, 'user', '123456'),
(14, 'Соня', 'Блэйд', 'Джоновна', 'Америка', 'Чикаго', 'sonya@mail.ru', '2009-05-26', 2, 35, 2, 'user', '123456'),
(15, 'Джони', 'Кейдж', 'Васильевич', 'Америка', 'Миннеаполис', 'keydg@mail.ru', '2010-04-10', 1, 40, 1, 'user', '123456'),
(16, 'Скорпион', 'Низдзя', 'Желтывич', 'Канада', 'Торонто', 'scorp@mail.ru', '2010-09-28', 1, 41, 3, 'user', '123456'),
(17, 'zalypkin', 'Жмышенко', 'Валера', 'Астрахань', 'Россия', 'lypa@za.ly', '2010-01-01', 1, 40, 2, 'user', 'VvUEJNy6Y7PMXZv'),
(18, 'Олег', NULL, NULL, NULL, NULL, 'mamontova-es@mail.ru', NULL, 0, NULL, 1, 'user', '12345567'),
(19, 'Олег', NULL, NULL, NULL, NULL, 'mamontova-ess@mail.ru', NULL, 0, NULL, 1, 'user', '12345678'),
(20, 'Олег', 'Олешко', 'олегович', 'Татарстан', 'Казань', 'olegol12@mail.ru', '2008-06-18', 1, 30, 3, 'user', 'olegator');

-- --------------------------------------------------------

--
-- Структура таблицы `win`
--

CREATE TABLE `win` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `win`
--

INSERT INTO `win` (`id`, `name`) VALUES
(1, 'Победа по очкам'),
(2, 'Ипон'),
(3, 'Дисквалификация противника'),
(4, 'Победа решением судьи');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fights`
--
ALTER TABLE `fights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `fighter_1_id` (`fighter_1_id`),
  ADD KEY `fighter_2_id` (`fighter_2_id`),
  ADD KEY `winner` (`winner`),
  ADD KEY `fighter_2_id_2` (`fighter_2_id`),
  ADD KEY `type_win_id` (`type_win_id`),
  ADD KEY `stage_id` (`stage_id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `gold` (`gold`),
  ADD KEY `silver` (`silver`),
  ADD KEY `bronze` (`bronze`),
  ADD KEY `sex_id` (`sex_id`);

--
-- Индексы таблицы `tournament_participant`
--
ALTER TABLE `tournament_participant`
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `result_id` (`result_id`),
  ADD KEY `tournament_id_2` (`tournament_id`,`user_id`,`result_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`),
  ADD KEY `sex_id` (`sex_id`);

--
-- Индексы таблицы `win`
--
ALTER TABLE `win`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `fights`
--
ALTER TABLE `fights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `stage`
--
ALTER TABLE `stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `win`
--
ALTER TABLE `win`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `fights`
--
ALTER TABLE `fights`
  ADD CONSTRAINT `fights_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`),
  ADD CONSTRAINT `fights_ibfk_2` FOREIGN KEY (`fighter_1_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fights_ibfk_3` FOREIGN KEY (`fighter_2_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fights_ibfk_4` FOREIGN KEY (`winner`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fights_ibfk_5` FOREIGN KEY (`type_win_id`) REFERENCES `win` (`id`),
  ADD CONSTRAINT `fights_ibfk_6` FOREIGN KEY (`stage_id`) REFERENCES `stage` (`id`);

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `tournament_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `tournament_ibfk_2` FOREIGN KEY (`sex_id`) REFERENCES `sex` (`id`);

--
-- Ограничения внешнего ключа таблицы `tournament_participant`
--
ALTER TABLE `tournament_participant`
  ADD CONSTRAINT `tournament_participant_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`),
  ADD CONSTRAINT `tournament_participant_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `tournament_participant_ibfk_3` FOREIGN KEY (`result_id`) REFERENCES `result` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
