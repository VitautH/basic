-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 30 2017 г., 22:44
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `casino`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `meta_keywords` varchar(225) NOT NULL,
  `meta_description` varchar(225) NOT NULL,
  `brief` text,
  `text` text,
  `date` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `meta_keywords`, `meta_description`, `brief`, `text`, `date`, `category_id`) VALUES
(1, 'Мобильная платформа. ReactNative', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultricies, velit a mollis convallis, dui ligula porttitor augue, eu semper nibh lacus non arcu.Vestibulum interdum dapibus felis nec aliquet. ', '1', NULL, NULL),
(2, 'Lorem imsum', 'fgdhdfgh', 'fdghfdgh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultricies, velit a mollis convallis, dui ligula porttitor augue, eu semper nibh lacus non arcu.', 'fghsfg', '2017-03-03 00:00:00', NULL),
(3, 'Инфраструктура Twitter: масштаб ', '', '', 'Twitter пришёл из эпохи, когда в дата-центрах было принято устанавливать оборудование от специализированных производителей.', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `casino`
--

CREATE TABLE IF NOT EXISTS `casino` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address_street` varchar(225) DEFAULT NULL,
  `phone` varchar(225) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `casino`
--

INSERT INTO `casino` (`id`, `title`, `description`, `meta_keywords`, `meta_description`, `city_id`, `address_street`, `phone`) VALUES
(1, 'New', '', '', '', NULL, 'ул. Советская', '80335890033'),
(2, 'Core', '', '', '', 3, '', ''),
(3, 'Plaza Gold', NULL, 'plaza, casino, gold', 'Lorem ipsum amet', 2, 'г. Минск, ул. Советская, 14 А', '80256357721');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `title` text,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL,
  `name` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Минск'),
(2, 'Москва'),
(3, 'Санкт-Петербург');

-- --------------------------------------------------------

--
-- Структура таблицы `img_casino`
--

CREATE TABLE IF NOT EXISTS `img_casino` (
  `id` int(10) NOT NULL,
  `casino_id` int(10) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `img_casino`
--

INSERT INTO `img_casino` (`id`, `casino_id`, `img_url`) VALUES
(1, 3, '07c71d7142c7db155245db8966716c4b.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `img_content`
--

CREATE TABLE IF NOT EXISTS `img_content` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `img_product`
--

CREATE TABLE IF NOT EXISTS `img_product` (
  `id` int(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `main_image` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `img_product`
--

INSERT INTO `img_product` (`id`, `product_id`, `img_url`, `main_image`) VALUES
(19, 56, 'd9d932af5ab3b5059d034b84d6345e9a.png', 0),
(20, 56, '7c6837dacc46a282cf55914fe3ca32fb.png', 0),
(26, 57, 'caf9e2ae60cde8effdac21bea942d9d0.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1489587435),
('m140209_132017_init', 1489587443),
('m140403_174025_create_account_table', 1489587444),
('m140504_113157_update_tables', 1489587444),
('m140504_130429_create_token_table', 1489587445),
('m140830_171933_fix_ip_field', 1489587445),
('m140830_172703_change_account_table_name', 1489587445),
('m141222_110026_update_ip_field', 1489587445),
('m141222_135246_alter_username_length', 1489587445),
('m150614_103145_update_social_account_table', 1489587445),
('m150623_212711_fix_username_notnull', 1489587445),
('m151218_234654_add_timezone_to_profile', 1489587445),
('m160929_103127_add_last_login_at_to_user_table', 1489587445);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `meta_keywords` varchar(225) NOT NULL,
  `meta_description` varchar(225) NOT NULL,
  `cost` decimal(5,2) DEFAULT NULL,
  `description` text,
  `cashback` decimal(5,2) DEFAULT '0.00',
  `casino_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `meta_keywords`, `meta_description`, `cost`, `description`, `cashback`, `casino_id`) VALUES
(47, 'ASP Net', '', '', '55.78', NULL, '0.00', 1),
(48, 'ASP Net', '', '', '55.78', NULL, '0.00', 1),
(49, 'ASP Net', '', '', '55.78', NULL, '0.00', 1),
(50, 'Run TimeType Information', '', '', '50.66', NULL, '5.00', 1),
(52, 'Run TimeType Information', '', '', '10.50', NULL, '0.00', 1),
(53, 'Run TimeType Information', '', '', '10.50', NULL, '0.00', 1),
(54, 'Run TimeType Information', '', '', '50.66', NULL, '0.00', 1),
(55, 'Run TimeType Information', '', '', '50.66', NULL, '0.00', 1),
(56, 'Clouser New', '', '', '100.01', NULL, NULL, 1),
(57, 'Новый продукт2', '', '', '50.66', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products_services`
--

CREATE TABLE IF NOT EXISTS `products_services` (
  `id` int(11) NOT NULL,
  `id_service` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, 'oyg_nFl3GpiO6jDt19yDSFcWTbWs6ZlU', 1489653206, 0),
(2, 'q-JJ-C2QJpFELTMRIsBd_2FbPwWKbbyM', 1489653280, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `name`, `firstname`, `lastname`, `role_id`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(1, 'vitaut', 'ip-94@ya.ru', '', '', '', '', 1, '$2y$10$u7Z6MG5HwenHT9aAqg8N8ugbCCv6cbVQO5up3cGIzbkFukkZejh1O', 'Lz6pP08anJExk94hby7SD2ZqbJh4W96X', 1489653630, NULL, NULL, '127.0.0.1', 1489653206, 1489653206, 1, 1490903016),
(2, 'vitauth', 'ip-94@yandex.ru', '', '', '', '', 1, '$2y$10$DMLyjii5uFPOObNsv.pMx.M.wgkiO.nxi71kIb8XqH.dP6fd7R3xK', 'wQwZxqrCkeuigITdNiVK-wyXBc8y7EIQ', NULL, NULL, NULL, '127.0.0.1', 1489653280, 1489653280, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_payment`
--

CREATE TABLE IF NOT EXISTS `user_payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_category_fk` (`category_id`);

--
-- Индексы таблицы `casino`
--
ALTER TABLE `casino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `casino_city_fk` (`city_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `img_casino`
--
ALTER TABLE `img_casino`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `img_content`
--
ALTER TABLE `img_content`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `img_product`
--
ALTER TABLE `img_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_casino_fk` (`casino_id`);

--
-- Индексы таблицы `products_services`
--
ALTER TABLE `products_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_services_service_fk` (`id_service`),
  ADD KEY `products_services_product_fk` (`id_product`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Индексы таблицы `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Индексы таблицы `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_payment_fk` (`user_id`),
  ADD KEY `user_payment_product_fk` (`product_id`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `casino`
--
ALTER TABLE `casino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `img_casino`
--
ALTER TABLE `img_casino`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `img_content`
--
ALTER TABLE `img_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `img_product`
--
ALTER TABLE `img_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT для таблицы `products_services`
--
ALTER TABLE `products_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `img_casino`
--
ALTER TABLE `img_casino`
  ADD CONSTRAINT `fp_casino_id` FOREIGN KEY (`id`) REFERENCES `casino` (`id`);

--
-- Ограничения внешнего ключа таблицы `img_content`
--
ALTER TABLE `img_content`
  ADD CONSTRAINT `fp_article_id` FOREIGN KEY (`id`) REFERENCES `articles` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_prod_casino` FOREIGN KEY (`casino_id`) REFERENCES `casino` (`id`);

--
-- Ограничения внешнего ключа таблицы `products_services`
--
ALTER TABLE `products_services`
  ADD CONSTRAINT `fk_prod_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_prod_service` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`);

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_payment`
--
ALTER TABLE `user_payment`
  ADD CONSTRAINT `fk_payment_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_payment_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
