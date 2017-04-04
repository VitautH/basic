-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 04 2017 г., 12:27
-- Версия сервера: 5.6.22-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `casino`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `meta_keywords` varchar(225) NOT NULL,
  `meta_description` varchar(225) NOT NULL,
  `brief` text,
  `text` text,
  `date` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_category_fk` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `meta_keywords`, `meta_description`, `brief`, `text`, `date`, `category_id`) VALUES
(1, 'Мобильная платформа. ReactNative', 'Go, c++', '', 'Кому нужен Go?\r\n\r\nЯ только сегодня понял, что почти никто толком-то и не понимает, зачем вообще Go нужен. Если коротко, то Go нужен для того, чтобы проектировать robust software. Я не знаю, как правильно перевести это слово на русский, но это скорее всего что-то вроде «надежный». ', 'Так вот, Go сделали, потому что гуглу нужен был инструмент для написания надежного кода. На самом деле не сколько гуглу, сколько Робу Пайку, который последние две декады, как минумум, одержим идеей сделать сишку с каналами и зелеными потоками. Так получилось, что Роб Пайк попал в нормальную компашку с другими штрихами из Bell Labs, крутейшим Russ Cox, Фицпатриком и т.д. Этим ребятам несложно было убедить гугл, что им нужен новый язык и вобщем-то, бабосики они на него выбили.\r\n\r\nТак, это было небольшое лирическое отступление, давайте вернемся к теме. Да, зачем же все-таки гуглу был нужен новый язык? Ну, тут все понятно, давайте послушаем слова самого Роба Пайка:\r\nФишка в том, что наши программисты гуглеры, а не ученые. Это обычно молодые, только выпустившиеся пацаны, которые возможно выучили Java, возможно даже C/C++ и может быть Python. Они не в состоянии понимать пробздетый язык, но мы все равно хотим, чтобы они делали хороший софт. Таким образом, мы даем им легкопонимаемый язык, к которому они быстро привыкнут.', NULL, NULL),
(2, 'Lorem imsum', 'fgdhdfgh', 'fdghfdgh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultricies, velit a mollis convallis, dui ligula porttitor augue, eu semper nibh lacus non arcu.', 'fghsfg', '2017-03-03 00:00:00', NULL),
(3, 'Кому и зачем все-таки нужен Go?', 'Go, C#, C++', 'С технической стороны, ниша у Go довольно скромная: сеть, утилиты, бэкенды. Если у вас сложные сети или много нод, которые надо как-то навороченным образом оркестрировать, то Go это хороший выбор (судя по опыту CloudFlare). ', 'Twitter пришёл из эпохи, когда в дата-центрах было принято устанавливать оборудование от специализированных производителей.', '1', NULL, NULL),
(4, 'Паттерны проектировния vs архитектурные паттерны', '', '', 'Добрый день.\r\nНедавно у меня состоялась оживлённая дискуссия на тему есть ли разница между понятиями: паттерн проектирования и архитектурный паттерн.\r\nСуть состояла в том, со слов оппонентов, что — MVC\\MVP — архитектурный паттерн, но Singleton\\Factory — паттерн проектирования.', 'Хотелось бы разобраться: \r\n1. Есть ли разница между понятиями: архитектурный паттерн и паттерн проектирования?\r\n2. Если разница между ними есть, в чём она заключается?\r\n3. Примеры либо же список тех сущностей того что относится к паттернам проектирования и архитектурным паттернам.', '2017-03-31 13:16:21', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `casino`
--

CREATE TABLE IF NOT EXISTS `casino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `address_street` varchar(225) DEFAULT NULL,
  `phone` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `casino_city_fk` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `casino`
--

INSERT INTO `casino` (`id`, `title`, `description`, `meta_keywords`, `meta_description`, `city_id`, `address_street`, `phone`) VALUES
(1, 'New', 'Lorem ipsum amet dolor', 'lorem', 'amet emt', 3, 'ул. Советская', '80335890033'),
(2, 'Core', '', '', '', 3, '', ''),
(3, 'Plaza Gold', '', 'plaza, casino, gold', 'Lorem ipsum amet', 2, 'г. Минск, ул. Советская, 14 А', '80256357721'),
(4, 'Diamond', '', '', '', 1, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `casino_id` int(10) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `main_image` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `img_casino`
--

INSERT INTO `img_casino` (`id`, `casino_id`, `img_url`, `main_image`) VALUES
(2, 3, 'ab9c5cc7b0a5f40ab59604bb64b69208.jpg', 1),
(3, 2, '13a62007faae34985236c9cc945c884d.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `img_content`
--

CREATE TABLE IF NOT EXISTS `img_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `img_product`
--

CREATE TABLE IF NOT EXISTS `img_product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `main_image` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `img_product`
--

INSERT INTO `img_product` (`id`, `product_id`, `img_url`, `main_image`) VALUES
(26, 57, 'caf9e2ae60cde8effdac21bea942d9d0.jpg', 1),
(28, 49, '6bc3f1bfa6e28915d88ff130246a931c.jpg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) DEFAULT NULL,
  `meta_keywords` varchar(225) NOT NULL,
  `meta_description` varchar(225) NOT NULL,
  `cost` decimal(5,2) DEFAULT NULL,
  `description` text,
  `cashback` decimal(5,2) DEFAULT '0.00',
  `casino_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_casino_fk` (`casino_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `meta_keywords`, `meta_description`, `cost`, `description`, `cashback`, `casino_id`) VALUES
(48, 'ASP Net', '', '', '55.78', NULL, '0.00', 1),
(49, 'Net', 'ddd,f', 'asdfgh', '70.00', NULL, '10.00', 3),
(50, 'Run TimeType Information', '', '', '50.66', NULL, '5.00', 1),
(52, 'Run TimeType Information', '', '', '10.50', NULL, '0.00', 1),
(53, 'Run TimeType Information', '', '', '10.50', NULL, '0.00', 1),
(54, 'Run TimeType Information', '', '', '50.66', NULL, '0.00', 1),
(55, 'Run TimeType Information', '', '', '50.66', NULL, '0.00', 1),
(56, 'Clouser New', '', '', '100.01', NULL, NULL, 1),
(57, 'Новый продукт2', '', '', '50.66', NULL, NULL, 1),
(58, 'Обеденное меню', 'Аааааа', 'Интересно', '500.00', 'Вкусно поесть', '1.00', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `products_services`
--

CREATE TABLE IF NOT EXISTS `products_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_service` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_services_service_fk` (`id_service`),
  KEY `products_services_product_fk` (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `last_login_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `name`, `firstname`, `lastname`, `role_id`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(1, 'vitaut', 'ip-94@ya.ru', '', '', '', '', 1, '$2y$10$u7Z6MG5HwenHT9aAqg8N8ugbCCv6cbVQO5up3cGIzbkFukkZejh1O', 'Lz6pP08anJExk94hby7SD2ZqbJh4W96X', 1489653630, NULL, NULL, '127.0.0.1', 1489653206, 1489653206, 1, 1491218948),
(2, 'vitauth', 'ip-94@yandex.ru', '', '', '', '', 1, '$2y$10$DMLyjii5uFPOObNsv.pMx.M.wgkiO.nxi71kIb8XqH.dP6fd7R3xK', 'wQwZxqrCkeuigITdNiVK-wyXBc8y7EIQ', NULL, NULL, NULL, '127.0.0.1', 1489653280, 1489653280, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_payment`
--

CREATE TABLE IF NOT EXISTS `user_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_payment_fk` (`user_id`),
  KEY `user_payment_product_fk` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'admin');

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
