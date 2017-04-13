-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 13 2017 г., 20:21
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fio` text NOT NULL,
  `role` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `view_orders` tinyint(4) NOT NULL DEFAULT '0',
  `accept_orders` tinyint(4) NOT NULL DEFAULT '0',
  `delete_orders` tinyint(4) NOT NULL DEFAULT '0',
  `add_products` tinyint(4) NOT NULL DEFAULT '0',
  `edit_products` tinyint(4) NOT NULL DEFAULT '0',
  `delete_products` tinyint(4) NOT NULL DEFAULT '0',
  `accept_reviews` tinyint(4) NOT NULL DEFAULT '0',
  `delete_reviews` tinyint(4) NOT NULL DEFAULT '0',
  `view_clients` tinyint(4) NOT NULL DEFAULT '0',
  `delete_clients` tinyint(4) NOT NULL DEFAULT '0',
  `add_news` tinyint(4) NOT NULL DEFAULT '0',
  `delete_news` tinyint(4) NOT NULL DEFAULT '0',
  `add_category` tinyint(4) NOT NULL DEFAULT '0',
  `delete_category` tinyint(4) NOT NULL DEFAULT '0',
  `view_admins` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `fio`, `role`, `email`, `phone`, `view_orders`, `accept_orders`, `delete_orders`, `add_products`, `edit_products`, `delete_products`, `accept_reviews`, `delete_reviews`, `view_clients`, `delete_clients`, `add_news`, `delete_news`, `add_category`, `delete_category`, `view_admins`) VALUES
(3, 'WDQDQWD', 'dqw3443kl36493b734b5a2fa21fb52e8e7891f595sdad213123', 'DWDQWDQWD', 'DWQDQWDQ', 'DWQDQWD@M.R', '8(222) 222-2222', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(5, 'admin', 'dqw3443kl3cf108a4e0a498347a5a75a792f23212sdad213123', 'Романов Артём Константинович', 'Всея Руси!', 'te@ma.ry', '8(999) 999-9999', 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  `brand` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `category`, `brand`) VALUES
(1, 'snowboard', 'Bataleon'),
(2, 'snowboard', 'Burton'),
(3, 'snowboard', 'Drake'),
(4, 'snowboard', 'K2'),
(5, 'snowboard', 'Lobster'),
(6, 'snowboard', 'Nitro'),
(7, 'snowboard', 'Ride'),
(8, 'snowboard', 'Technine'),
(10, 'snowboard', 'Venue'),
(11, 'mounting', 'Burton'),
(12, 'mounting', 'Drake'),
(13, 'mounting', 'Dynastar'),
(14, 'mounting', 'K2'),
(15, 'mounting', 'Nitro'),
(16, 'mounting', 'Raiden'),
(17, 'mounting', 'Ride'),
(18, 'mounting', 'Switchback'),
(19, 'mounting', 'Technine'),
(20, 'mounting', 'USD Pro'),
(21, 'boot', 'Burton'),
(22, 'boot', 'Dynastar'),
(23, 'boot', 'K2'),
(24, 'boot', 'Morrow'),
(25, 'boot', 'Nitro'),
(26, 'boot', 'Northwave'),
(27, 'boot', 'Original Sin'),
(28, 'boot', 'Ride'),
(29, 'boot', 'USD Pro'),
(30, 'qqq', 'aaa'),
(74, 'snowboard', 'USD Pro'),
(75, 'erw', 'wrwq');

-- --------------------------------------------------------

--
-- Структура таблицы `buy_products`
--

CREATE TABLE IF NOT EXISTS `buy_products` (
  `buy_id` int(11) NOT NULL AUTO_INCREMENT,
  `buy_id_order` int(11) NOT NULL,
  `buy_id_product` int(11) NOT NULL,
  `buy_count_product` int(11) NOT NULL,
  PRIMARY KEY (`buy_id`),
  KEY `buy_id` (`buy_id`),
  KEY `buy_id_order` (`buy_id_order`),
  KEY `buy_id_product` (`buy_id_product`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Дамп данных таблицы `buy_products`
--

INSERT INTO `buy_products` (`buy_id`, `buy_id_order`, `buy_id_product`, `buy_count_product`) VALUES
(45, 23, 1, 2),
(46, 23, 2, 3),
(50, 26, 1, 2),
(51, 26, 10, 3),
(52, 26, 6, 4),
(60, 31, 13, 555),
(61, 32, 7, 5),
(62, 32, 6, 5),
(63, 32, 3, 5),
(64, 33, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id_products` int(11) NOT NULL COMMENT 'Чтобы товар выводился в корзине - - берётся отсюда',
  `cart_count` int(11) NOT NULL,
  `cart_datetime` datetime NOT NULL,
  `cart_user_id` int(11) NOT NULL COMMENT 'ip пользователя, который добавил товар в корзину',
  PRIMARY KEY (`cart_id`),
  KEY `cart_id` (`cart_id`),
  KEY `cart_id_products` (`cart_id_products`),
  KEY `cart_user_id` (`cart_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=148 ;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_id_products`, `cart_count`, `cart_datetime`, `cart_user_id`) VALUES
(140, 1, 2, '2016-05-12 21:07:10', 1),
(141, 10, 3, '2016-05-12 21:07:18', 1),
(143, 6, 4, '2016-05-12 21:07:29', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `date`, `image`) VALUES
(5, 'Скидка 30% на новую зимнюю коллекцию 2015/2016!', 'C 4 апреля по 20 октября 2016 в магазине "Board Komplekt" предъявителю дисконтной карты скидка 30% на сноуборды, обувь и аксессуары сезона 2015/2016!', '2016-04-03', 'news-img2.png'),
(6, 'Скидка 45% на зимнюю коллекцию 2014/15!', 'C 4 апреля по 20 октября в магазине "Board Komplekt" предъявителю дисконтной карты скидка 45% на на сноуборды, обувь и аксессуары сезона 2014/2015!', '2016-04-03', 'news-img1.png'),
(7, 'Скидки спорстменам, инструкторам и спортшколам!', '"Board Komplekt" предоставляет спортсменам любого уровня, инструкторам, а также детским спортивным школами, специальные цены на профильный и вспомогательный инвентарь, запасные и расходные части, одежду и аксессуары нового сезона.', '2016-01-11', 'news-img3.png'),
(9, 'Ликвидация зимних коллекций прошлых лет', 'С 4 декабря 2015г. в магазине "Board Komplekt" начинается операция "Ликвидация". \nСкидки на зимние коллекции прошлых лет* от 20 до 75%!\nТакого еще не было! Спешите, количество товаров ограничено!\n<br/>*– коллекции начиная с 2013/2014 и более ранние. \n<br/>*– акция не распространяется на профессиональные модели сноубордов Bataleon и Burton.\nСкидка по дисконтной карте не предоставляется.', '2015-12-04', 'news-img4.png'),
(10, 'Лучший подарок!', 'В предпраздничные дни мы все озабочены подарками для наших друзей и близких, да еще и такими, которые запомнились бы на целый год и подарили бы массу положительных эмоций.\r\n<br/>Подарочный сертификат - это идеальный подарок: на любой вкус, на любой размер, на любой возраст, на любой бюджет, на любой вес. \r\n<br/> <br/> \r\nПредоставьте самым дорогим для вас людям право выбрать себе подарок по душе, а то  что подарок будет спортивным гарантирует массу эмоций и впечатлений на целый год!\r\n<br/> <br/> \r\nВ наших магазинах есть сертификаты различных номиналов: \r\n<br/> 1000 рублей\r\n<br/> 3000 рублей\r\n<br/> 5000 рублей\r\n<br/> VIP сертификат – на сумму от  10 000 рублей.\r\n<br/> <br/> \r\nСертификат упакован в яркий конверт и будет  отлично смотреться, как подарок близким, так и в качестве бизнес-подарка коллегам.', '2015-10-23', 'news-img5.png'),
(22, 'Новость', 'Года', '2017-04-05', 'news-img-97.jpg'),
(34, 'news', 'без картинки', '2017-04-06', '');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_buyer` int(11) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `order_total_price` int(11) NOT NULL,
  `order_delivery` varchar(255) NOT NULL,
  `order_type_pay` varchar(100) NOT NULL,
  `order_note` text NOT NULL,
  `order_confirmed` varchar(50) NOT NULL DEFAULT 'no',
  `order_pay` varchar(40) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `id_buyer` (`id_buyer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `id_buyer`, `order_datetime`, `order_total_price`, `order_delivery`, `order_type_pay`, `order_note`, `order_confirmed`, `order_pay`) VALUES
(23, 1, '2016-05-08 00:20:30', 161070, 'Курьером', 'как', 'Доставить в 18.00. Спасибо!', 'yes', 'accepted'),
(26, 1, '2016-05-12 21:35:09', 194885, 'Курьером', 'как', 'Доставьте 21.12.2015 около 18.00. Спасибо!', 'yes', ''),
(31, 7, '2017-04-13 03:02:42', 23773425, 'По почте', '', 'asdfg', 'yes', ''),
(32, 7, '2017-04-13 16:03:46', 457900, 'Самовывоз', '', 'Сам приеду', 'no', ''),
(33, 7, '2017-04-13 16:13:43', 49380, 'По почте', '', 'qqq', 'yes', 'accepted');

-- --------------------------------------------------------

--
-- Структура таблицы `reg_user`
--

CREATE TABLE IF NOT EXISTS `reg_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `patronymic` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `reg_user`
--

INSERT INTO `reg_user` (`user_id`, `login`, `password`, `surname`, `name`, `patronymic`, `email`, `phone`, `address`, `datetime`, `ip`) VALUES
(1, 'admin', '9nm2rv8qa803b39c1116ef6d4a74039da2828af72yo6z', 'Романов', 'Артём', 'Константинович', 'romanov@gmail.com', '89605201771', 'г.Калуга, ул.Никитина, д.19', '2016-04-15 22:12:38', '127.0.0.1'),
(7, 'ivanovv', '9nm2rv8qfdf4e46de0708e655e0bc7bc536d702d2yo6z', 'Иванов', 'Иван', 'Иванович', 'Ivanov@yandex.ru', '87779998077', 'г. Москва, ул. Московская, дом 1, кв. 2', '2017-03-28 00:47:41', '127.0.0.1'),
(8, 'kekkek', '9nm2rv8qe9240e9440751d24c8ce78a0b3920b712yo6z', 'kekek', 'ewqeqwe', 'wqeqe', 'eqweqw@mail.ru', '44444444444', 'ewqe', '2017-04-13 15:25:41', '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `table_products`
--

CREATE TABLE IF NOT EXISTS `table_products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `seo_words` text NOT NULL,
  `seo_description` text NOT NULL,
  `mini_description` varchar(280) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `mini_features` varchar(280) NOT NULL,
  `features` text NOT NULL,
  `datetime` datetime NOT NULL,
  `new` tinyint(4) NOT NULL DEFAULT '0',
  `leader` tinyint(4) NOT NULL DEFAULT '0',
  `sale` tinyint(4) NOT NULL DEFAULT '0',
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `brand_id` int(11) NOT NULL,
  PRIMARY KEY (`products_id`),
  KEY `products_id` (`products_id`),
  KEY `products_id_2` (`products_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `table_products`
--

INSERT INTO `table_products` (`products_id`, `title`, `price`, `seo_words`, `seo_description`, `mini_description`, `image`, `description`, `mini_features`, `features`, `datetime`, `new`, `leader`, `sale`, `visible`, `brand_id`) VALUES
(1, 'Nitro Cinema                                                 ', 31200, '', '', 'Сон становится реальностью: эта доска вобрала в себя основу топовых досок Nitro, но при этом однозначно порадует вас ценой! Фирменный прогиб Gullwing и высокоскоростная прочная база подарят вам максимальный комфорт и удовольствие от катания как по трассам, так и вне их.', 'img1.jpg', 'Сон становится реальностью: эта доска вобрала в себя основу топовых досок Nitro, но при этом однозначно порадует вас ценой! Фирменный прогиб Gullwing и высокоскоростная прочная база подарят вам максимальный комфорт и удовольствие от катания как по трассам, так и вне их.', 'Бренд: Nitro                    \n<p>Серия: Gullwing Camber</p> \n<p>Артикул: 835843</p> \n<p>Год: 2014/2015</p> \n<p>Форма: Directional Twin</p> \nСтиль катания: All mountain', '<b>Скользящая поверхность Hi-Def FH Base</b></br>\nКомбинация спеченного полиэтилена Hi-Def Sintered и экструдированного полиэтилена Redline – скоростная скользящая поверхность, отличающаяся высочайшей чистотой и прозрачностью. Невероятная прочность, стойкость к появлению царапин и легкость обслуживания.</br></br>\n\n<b>Ламинат Bi-lite</b></br>\nПроверенная временем конструкция с ламинирующими слоями из биаксиальной стеклоткани обеспечивает высокую эластичность, отзывчивость на прогиб - сильный щелчок, прекрасную передачу усилий на кант и низкий вес.</br></br>\n\n<b>Боковой вырез Radial</b></br>\nПривычный однорадиусный боковой вырез для лёгкого входа в поворот и стабильности.', '2016-03-14 21:50:20', 0, 0, 0, 1, 6),
(2, 'Lobster Parkbaord', 32890, '', '', 'От ритмичных парковых линий до фанового катания с друзьями на горе. ParkBoard имеет средний уровень жесткости, а значит перед вами универсальное оружие для самых разнообразных спотов и трасс. ', 'img2.jpg', '', 'Бренд: Lobster\r\n<p>Серия: Camber</p>  \r\n<p>Артикул: 10.16.HPARK</p>  \r\n<p>Год: 2015/2016</p>\r\n<p>Ростовка(см): 154</p>\r\n<p>Форма: Twin</p>  \r\nСтиль катания: Park/Freestyle', '', '2016-03-14 21:57:39', 0, 0, 0, 1, 5),
(3, 'Ride Highlife UL', 49380, '', '', 'Highlife UL является воплощением лучших разработок компании Ride на сегодняшний день. Комбинация технологий Silencer 5 Tuned Core™ и UL Core создает идеальный сердечник для любителей фрирайда и скоростных спусков.', 'img3.jpg', '', 'Бренд: Ride                    \n<p>Серия: Gullwing Camber</p> \n<p>Артикул: 1240000/1</p> \n<p>Год: 2014/2015</p> \n<p>Форма: Directional</p> \nСтиль катания: \n<p>Freeride/Powder</p>', '', '2016-03-27 23:59:41', 0, 0, 0, 1, 7),
(4, 'Nitro Machine', 27534, '', '', 'Модель Machine – это будущее, которое мы можем использовать уже сегодня. В них всё самое новое и интересное. Сочетание базы FTI EVO2 AIR Carbon и асимметричного хайбэка Asym Carbon придаёт правильную эргономичную поддержку стопы. Верхний стрэп Perfect HOLD и нижний стрэп B.E.S.T.', 'img4.jpg', '', 'Бренд: Nitro  \n<p>Артикул: 836300</p>  \n<p>Год: 2014/2015</p> \n<p>Размеры: M, L</p>\n<p>Цвета: Black</p>  ', '', '2016-03-28 20:03:32', 0, 0, 0, 1, 15),
(5, 'Bataleon Global Warmer', 38220, '', '', 'Global Warmer - это не попытка Bataleon привлечь внимание общественности к проблеме глобального потепления. В нем даже используется усиление карбоном, который вреден для природы, но зато в разы усиливает "щелчок" доски!', 'img5.jpg', '', 'Бренд: Bataleon                      \n<p>Артикул: 10.16.GW.</p> \n<p>Год: 2015/2016</p> \n<p>Форма: Twin</p> \nСтиль катания: \n<p>Freestyle/Freeride</p>', '', '2016-04-04 02:20:15', 0, 0, 0, 1, 1),
(6, 'Nitro Pusher', 10160, '', '', 'Эти неубиваемые крепления не похожи ни на какие другие на рынке. Pusher функционален благодаря двойной воздушной подушке, хайбэку Asym Hummer и стрэпам Revert для дополнительного комфорта и контроля. Pusher - крепления с самой стабильной платформой, но также легкие.', 'img6.jpg', '', 'Бренд: Nitro                     \n<p>Артикул: 836274</p> \n<p>Год: 2013/2014</p> \n<p>Размеры: M, L</p> \nЦвета: \n<p>Neon Green, Red</p></p>', '', '2016-04-04 02:32:34', 0, 0, 0, 1, 15),
(7, 'K2 T1 DB', 32040, '', '', 'Командный фаворит для прорайдеров К2. T1 DB максимально технологичен и имеет невероятную поддержку. Не важно, какие испытания ждут Вас в горах, ведь эти ботинки с легкостью их преодолеют и докажут, что фрирайдный ботинок это не только жесткость, но и комфорт.', 'img7.jpg', '', 'Бренд: K2                     \n<p>Артикул: 1142050</p> \n<p>Год: 2014/2015</p> \n<p>Размеры: 8.5 - 11.5 US</p> \nЦвета: \n<p>Black</p>', '', '2016-04-04 02:39:31', 0, 0, 0, 1, 23),
(8, 'Nitro Pantera Wide', 45890, '', '', 'Эта модель лежит в основе коллекции высокотехнологичных досок для катания в стиле All Mountain. Она разрабатывалась специально для того, чтобы максимально быстро перемещаться в наисложнейших условиях. Её сердечник Powerlite Core имеет направленную форму с зауженным хвостом.', 'img8.jpg', '', 'Бренд: Nitro                     <p>Серия: Standart Camber</p>  <p>Артикул: 8300083</p>  <p>Год: 2015/2016</p>  <p>Форма: Directional Tapered</p>  Стиль катания: Freeride / Powder', '', '2016-04-08 01:38:27', 0, 0, 0, 1, 6),
(9, 'Ride HighLife UL', 45110, '', '', 'Highlife UL является воплощением лучших разработок компании Ride на сегодняшний день. Комбинация технологий Silencer 5 Core™ и UL Core создает идеальный сердечник для любителей фрирайда и скоростных спусков. В этой модели представлена особая направленная форма весового прогиба.', 'img9.jpg', '', 'Бренд: Ride                      <p>Артикул: 1250000/1</p>  <p>Год: 2015/2016</p>  <p>Форма: Directional</p>  Стиль катания: Freeride / Powder', '', '2016-04-08 01:55:20', 0, 0, 0, 1, 7),
(10, 'Nitro Select TLS', 30615, '', '', 'Select – это сочетание технологий и комфорта для катания в любых горах. Система TLS 5 обеспечивает непревзойденную поддержку ноге, и вы всегда сможете подрегулировать затяжку ботинка отдельно в верхней и в нижней зоне благодаря легкой доступности системы шнуровки.', 'img10.jpg', '', 'Бренд: Nitro                    \n<p>Артикул: 848330</p> \n<p>Год: 2015/2016</p> \n<p>Размеры: 8.5 US</p> \nЦвета: \n<p>Black</p>', '', '2016-04-08 02:02:36', 0, 0, 0, 1, 25),
(11, 'Bataleon The Jam', 44395, '', '', 'Это наиболее агрессивная из всех моделей в All Mountain коллекции. Она для тех парней, что не любят дожидаться, пока доедет их семейство, друзья или девушки – их надо спустить быстро, и сразу готовиться к следующему спуску. ', 'img11.jpg', '', 'Бренд: Bataleon                      \n<p>Артикул: 10.16.JAM.</p> \n<p>Год: 2015/2016</p> \n<p>Форма: Twin</p> \nСтиль катания: \n<p>Freestyle/Freeride</p>', '', '2016-04-08 02:15:05', 0, 0, 0, 1, 1),
(12, 'Nitro PRO ONE OFF SVEN THORGREN', 43615, '', '', 'Промодель Свена Торгрена. Большую часть катания этот молодой Шведский райдер проводит в воздухе, поэтому предпочтением в его новой промодели была максимальная отзывчивость доски. Сказано. Сделано. Внутри ультралегкий и очень прочный сердечник Powerlite Core, ламинат Tri-Lite.', 'img12.jpg', '', 'Бренд: Nitro                    \n<p>Серия: Lowrider Camber</p> \n<p>Артикул: 830073</p> \n<p>Год: 2015/2016</p> \n<p>Форма: Twin</p> \nСтиль катания: All mountain', '', '2016-04-17 22:56:26', 0, 0, 0, 1, 6),
(13, 'Ride Machete GT', 42835, '', '', 'Одна из самых диких досок в мире! Оружие, которое делает тебя фаворитом на любом склоне и на любом трамплине. С Machete GT - ты можешь легко забыть слово "невозможно" и превратить любую гору в площадку для игр… Игр - по твоим правилам...', 'img13.jpg', '', 'Бренд: Ride                      <p>Артикул: 1250002</p>  <p>Год: 2015/2016</p>  <p>Форма: 	Twin</p>  Стиль катания: Freestyle / Freeride', '', '2016-04-28 15:17:12', 0, 0, 0, 1, 7),
(14, 'Bataleon Boss', 42055, '', '', 'Встречайте главную новинку линейки Bataleon нового сезона. Это доска собрала в себе лучшее от стритовой геометрии и мощнейшего щелчка парковых досок до управляемости снарядов из жанра All Mountain.', 'img14.jpg', '', 'Бренд: Bataleon                      <p>Артикул: 10.16.BOSS</p>  <p>Год: 2015/2016</p>  <p>Форма: Twin</p>  Стиль катания: 	Freestyle / Freeride', '', '2016-05-05 00:54:20', 0, 0, 0, 1, 1),
(15, 'товар', 21112, '', '', 'цыфвцйвйц', '4-1577.jpg', '<p>ывфывфыв</p>\r\n', 'вцйвйц', '<p>цуцйуйуйц</p>\r\n', '2017-03-13 12:28:21', 0, 0, 0, 1, 4),
(16, 'lol', 2312, '', '', 'цуйцу', '', '<p>цйуйуйцу</p>\r\n', 'цуйцу', '<p>цуйцй</p>\r\n', '2017-03-13 22:39:24', 0, 0, 0, 1, 4),
(18, 'kek', 3242, '', '', 'rewrw', '4-1811.jpg', '<p>wer</p>\r\n', 'werw', '<p>ewr</p>\r\n', '2017-03-23 23:28:45', 0, 0, 0, 1, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `table_reviews`
--

CREATE TABLE IF NOT EXISTS `table_reviews` (
  `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `good_reviews` text NOT NULL,
  `bad_reviews` text NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `approved` tinyint(4) NOT NULL,
  PRIMARY KEY (`reviews_id`),
  KEY `reviews_id` (`reviews_id`),
  KEY `products_id` (`products_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `table_reviews`
--

INSERT INTO `table_reviews` (`reviews_id`, `products_id`, `user_id`, `good_reviews`, `bad_reviews`, `comment`, `date`, `approved`) VALUES
(1, 1, 1, 'Сноуборд супер ', 'Недостатков не найдено', 'До Москвы курьером шёл 14 дней.', '2016-04-13 13:06:11', 1),
(15, 12, 7, 'Отличная Доска!', 'Цена (', 'Рекомендую для профессионалов! =)', '2017-03-28 00:50:06', 1),
(16, 7, 1, '111', '1', '1', '2017-04-12 07:19:18', 0);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `buy_products`
--
ALTER TABLE `buy_products`
  ADD CONSTRAINT `buy_products_ibfk_1` FOREIGN KEY (`buy_id_order`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buy_products_ibfk_2` FOREIGN KEY (`buy_id_product`) REFERENCES `table_products` (`products_id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_id_products`) REFERENCES `table_products` (`products_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cart_user_id`) REFERENCES `reg_user` (`user_id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_buyer`) REFERENCES `reg_user` (`user_id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `table_products`
--
ALTER TABLE `table_products`
  ADD CONSTRAINT `table_products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `table_reviews`
--
ALTER TABLE `table_reviews`
  ADD CONSTRAINT `table_reviews_ibfk_1` FOREIGN KEY (`products_id`) REFERENCES `table_products` (`products_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `table_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `reg_user` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
