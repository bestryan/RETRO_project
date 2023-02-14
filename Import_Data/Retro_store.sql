-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 14, 2023 at 02:09 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Retro_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE `store_categories` (
  `id` int(11) NOT NULL,
  `cat_title` varchar(50) DEFAULT NULL,
  `cat_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_categories`
--

INSERT INTO `store_categories` (`id`, `cat_title`, `cat_desc`) VALUES
(1, 'Vinyl Records', 'Order new and second hand Music Vinyl Records LPs from our online vinyl record store. We ship Australia wide. We offer a large selection of curate, high quality records at great prices.'),
(2, 'Books', 'Read about music history, artist (auto) biographies, record collecting, LP cover art and music genre reference books.'),
(3, 'Accessories', 'Buy our wide range of essential accessories that help you get the most out of your vinyl records. Visit us today and get the best offers.');

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `item_title` varchar(75) DEFAULT NULL,
  `item_price` float(8,2) DEFAULT NULL,
  `item_desc` text,
  `item_image` varchar(50) DEFAULT NULL,
  `stock_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`id`, `cat_id`, `item_title`, `item_price`, `item_desc`, `item_image`, `stock_level`) VALUES
(1, 1, 'Radiohead KID A MNESIA Exclusive', 90.00, 'It\'s a coming of age for Kid A & Amnesiac and it\'s joined by a new album, Kid Amnesiae, a memory palace of half-remembered, half-forgotten sessions & unreleased material.\" – Radiohead.\r\n\r\n21 years since the release of Radiohead\'s seminal albums, Kid A and Amnesiac, comes a combined and expanded reissue, KID A MNESIA. Here put back together as originally intended, with an additional disc of bonus material - including 2 original unreleased recordings from the era: \"If You Say The Word\" and \"Follow Me Around\".\r\n', 'Radiohead.jpg', 100),
(2, 1, 'Pearl Jam Rearviewmirror - Greatest Hits 1991-2003', 65.00, 'In 2004 Pearl Jam released \"Rearviewmirror (Greatest Hits 1991-2003)\", as the name suggests, a best-of album with 33 tracks, including hits, rare B-sides and sampler contributions.\r\n\r\nThe two parts of the album are each dedicated to different sides of the band\'s catalog: the first disc, \"Up Side\", contains harder rock songs, including classics like \"Once\", \"Alive\", \"Evenflow\" and \"Jeremy\", while the second disc, \"Down Side\", consists of slower songs and ballads. The songs are in chronological order, except for the last song on \"Down Side\", the regular concert closing track \"Yellow Ledbetter\". \r\n\r\n\"Rearviewmirror (Greatest Hits 1991-2003)\" was certified platinum by the RIAA in the United States. The album reached number 16 on the US Billboard charts. The highest chart position was in Australia at number two.\r\n', 'PearJam.jpg', 32),
(3, 1, 'Gold (Greatest Hits) - ABBA', 75.00, 'ABBA Gold: Greatest Hits is a compilation album by the Swedish pop group ABBA. It was released on 21 September 1992 through PolyGram and released in 2008 through Universal Music Australia, making it the first compilation to be released after the company had acquired Polar Music, and thus the rights to the ABBA back catalogue.\r\n\r\nWith sales of 30 million, Gold is the best-selling ABBA album, as well as the 23rd best-selling album worldwide. Since 1992, it has been re-released several times, most notably in 1999 as the first remastered reissue to mark the group\'s 25th anniversary of winning the Eurovision Song Contest, in 2008 to coincide with the release of the film Mamma Mia! and most recently in 2014 to mark the group\'s 40th anniversary of winning the Eurovision Song Contest.\r\n', 'abba.jpg', 92),
(4, 1, 'Taylor Swift 1989 Vinyl LP', 80.00, 'Taylor Swift surprises after the release of her 9th studio album \"evermore\" now again with a new recording of her second studio album \"Fearless\". The new work \"Fearless (Taylor\'s Version)\" contains six previously unreleased songs in addition to the already known tracks.\r\n\r\nThe single \"Love Story (Taylor\'s Version)\", also included, intimately reflects the inner life of the teenager at the time and exemplifies an album that uniquely reveals Taylor Swift\'s emotional journey through her youth. \"Fearless was an album of magic and curiosity, bliss and the destruction of youth. It was the story of a teenager\'s adventures, learning little lessons with each new crack in the facade of a non -existent world she was shown in the movies.\"\r\n', 'taylor_swift.jpg', 30),
(5, 2, 'Beneath The Underdog - Charles Mingus', 28.00, 'Bass player extraordinaire Charles Mingus, who died in 1979, is one of the essential composers in the history of jazz, and Beneath the Underdog, his celebrated, wild, funny, demonic, anguished, shocking and profoundly moving memoir, is the greatest autobiography ever written by a jazz musician. It tells of his God-haunted childhood in Watts during the 1920s and 1930s; his outcast adolescent years; his apprenticeship, not only with jazzmen but also with pimps, hookers, junkies, and hoodlums; and his golden years in New York City with such legendary figures as Duke Ellington, Lionel Hampton, Miles Davis, Charlie Parker, and Dizzy Gillespie. Here is Mingus in his own words, from shabby roadhouses to fabulous estates, from the psychiatric wards of Bellevue to worlds of mysticism and solitude, but for all his travels never straying too far, always returning to music.', 'BeneathTheUnderdog.jpg', 19),
(6, 2, 'Lady Sings the Blues - Billie Holiday', 25.00, '\'A masterpiece, as fresh and shocking as if it were written yesterday\' Craig Brown\r\n\"I\'ve been told that no one sings the word \'hunger\' like I do. Or the word \'love’. “Lady Sings the Blues is the inimitable autobiography of one of the greatest icons of the twentieth century. Born to a single mother in 1915 Baltimore, Billie Holiday had her first run-in with the law at aged 13. But Billie Holiday is no victim. Her memoir tells the story of her life spent in jazz, smoky Harlem clubs and packed-out concert halls, her love affairs, her wildly creative friends, her struggles with addiction and her adventures in love. Billie Holiday is a wise and aphoristic guide to the story of her unforgettable life.\r\n', 'LadySingstheBlues.jpg', 99),
(7, 2, 'Useless Magic - Florence Welch', 35.00, 'The perfect gift for fans of Florence + the Machine, with additional lyrics, poems and a new chapter of sermons. \"Songs can be incredibly prophetic, like subconscious warnings or messages to myself, but I often don\'t know what I\'m trying to say till years later. Or a prediction comes true and I couldn\'t do anything to stop it, so it seems like a kind of useless magic.\"', 'UselessMagic.jpg', 18),
(8, 3, 'Bamboo Record Cleaning Brush', 15.00, 'Bamboo handle with pink bristles \r\nExtra soft bristles, removes lint, dust and static electricity\r\n', 'BambooRecordCleaningBrush.jpg', 20),
(9, 3, 'Record Cover Stand', 18.00, 'Stable and foldable \r\noptimum adjustment via ratchet joints\r\n', 'RecordCoverStand.jpg', 70),
(10, 3, 'Goat Hair Record Cleaning Brush', 25.00, 'Place record on platter then start rotation\r\nHolding the brush horizontally to the vinyl, gently place brush over the vinyl as it spins\r\nRemember to always use the brush in circular motions along groove\r\nYou can wash the brush after use \r\n', 'GoatHairRecordCleaningBrush.jpg', 95);

-- --------------------------------------------------------

--
-- Table structure for table `store_item_color`
--

CREATE TABLE `store_item_color` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_color` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_item_color`
--

INSERT INTO `store_item_color` (`id`, `item_id`, `item_color`) VALUES
(1, 8, 'Pink'),
(2, 9, 'White'),
(3, 10, 'Teak & Cream');

-- --------------------------------------------------------

--
-- Table structure for table `store_orders`
--

CREATE TABLE `store_orders` (
  `id` int(11) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_name` varchar(100) DEFAULT NULL,
  `order_address` varchar(255) DEFAULT NULL,
  `order_city` varchar(50) DEFAULT NULL,
  `order_state` char(3) DEFAULT NULL,
  `order_zip` varchar(10) DEFAULT NULL,
  `order_tel` varchar(25) DEFAULT NULL,
  `order_email` varchar(100) DEFAULT NULL,
  `item_total` float(6,2) DEFAULT NULL,
  `shipping_total` float(6,2) DEFAULT NULL,
  `authorization` varchar(50) DEFAULT NULL,
  `status` enum('processed','pending') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_orders`
--

INSERT INTO `store_orders` (`id`, `order_date`, `order_name`, `order_address`, `order_city`, `order_state`, `order_zip`, `order_tel`, `order_email`, `item_total`, `shipping_total`, `authorization`, `status`) VALUES
(1, '2022-05-03 14:46:43', 'Ryan', '7 Keats Ave', 'Wollongong', 'NSW', '2500', '0412345678', '123@test.com', 178.00, NULL, NULL, NULL),
(2, '2022-05-09 03:22:42', '', '', '', '', '', '', '', 50.00, NULL, NULL, NULL),
(3, '2022-05-09 10:17:29', '', '', '', '', '', '', '', 195.00, NULL, NULL, NULL),
(4, '2022-05-09 10:18:03', '', '', '', '', '', '', '', 195.00, NULL, NULL, NULL),
(5, '2022-05-09 10:18:04', '', '', '', '', '', '', '', 195.00, NULL, NULL, NULL),
(6, '2022-05-09 10:18:05', '', '', '', '', '', '', '', 195.00, NULL, NULL, NULL),
(7, '2022-05-09 10:19:28', '', '', '', '', '', '', '', 195.00, NULL, NULL, NULL),
(8, '2022-05-09 10:20:34', '', '', '', '', '', '', '', 195.00, NULL, NULL, NULL),
(9, '2022-05-09 10:29:11', '', '', '', '', '', '', '', 195.00, NULL, NULL, NULL),
(10, '2022-05-09 10:29:54', '', '', '', '', '', '', '', 195.00, NULL, NULL, NULL),
(11, '2022-05-09 10:42:00', 'Bella', '123 Tafe Road', 'Sydney', 'NSW', '2000', '04111222333', 'bella@tafe.com', 100.00, NULL, NULL, NULL),
(12, '2022-05-09 10:48:53', 'Nats', '999 Tafe Street', 'Sydney', 'VIC', '3000', '0212345678', 'nats@tafe.com', 53.00, NULL, NULL, NULL),
(13, '2022-05-09 10:49:30', 'Nats', '999 Tafe Street', 'Sydney', 'VIC', '3000', '0212345678', 'nats@tafe.com', 53.00, NULL, NULL, NULL),
(14, '2022-05-09 11:00:54', 'Rafi', '123 tafe Ave', 'sydney', 'NSW', '2000', '0298765432', 'rafi@tafe.com', 130.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_orders_items`
--

CREATE TABLE `store_orders_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `sel_item_id` int(11) DEFAULT NULL,
  `sel_item_qty` smallint(6) DEFAULT NULL,
  `sel_item_color` varchar(25) DEFAULT NULL,
  `sel_item_price` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_orders_items`
--

INSERT INTO `store_orders_items` (`id`, `order_id`, `sel_item_id`, `sel_item_qty`, `sel_item_color`, `sel_item_price`) VALUES
(1, 1, 7, 2, '', 90.00),
(2, 1, 8, 2, 'Teak & Cream', 25.00),
(3, 1, 9, 2, '', 80.00),
(4, 1, 10, 1, 'White', 18.00),
(5, 2, 22, 1, '', 35.00),
(6, 2, 23, 1, 'Pink', 15.00),
(7, 3, 30, 1, '', 80.00),
(8, 3, 31, 1, '', 65.00),
(9, 3, 32, 1, '', 25.00),
(10, 3, 33, 1, 'Teak & Cream', 25.00),
(11, 11, 39, 1, '', 75.00),
(12, 11, 40, 1, 'Teak & Cream', 25.00),
(13, 12, 41, 1, 'White', 18.00),
(14, 12, 42, 1, '', 35.00),
(15, 14, 47, 2, '', 25.00),
(16, 14, 48, 1, '', 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `store_shoppertrack`
--

CREATE TABLE `store_shoppertrack` (
  `id` int(11) NOT NULL,
  `session_id` varchar(32) DEFAULT NULL,
  `sel_item_id` int(11) DEFAULT NULL,
  `sel_item_qty` smallint(6) DEFAULT NULL,
  `sel_item_color` varchar(25) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_shoppertrack`
--

INSERT INTO `store_shoppertrack` (`id`, `session_id`, `sel_item_id`, `sel_item_qty`, `sel_item_color`, `date_added`) VALUES
(1, 'o3nrfrco1tvb91pb9idb43iajd', 4, 2, '', '2022-05-19 17:12:06'),
(2, 'o3nrfrco1tvb91pb9idb43iajd', 5, 1, '', '2022-05-19 17:12:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `store_categories`
--
ALTER TABLE `store_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cat_title` (`cat_title`);

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_item_color`
--
ALTER TABLE `store_item_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_orders`
--
ALTER TABLE `store_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_orders_items`
--
ALTER TABLE `store_orders_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_shoppertrack`
--
ALTER TABLE `store_shoppertrack`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `store_categories`
--
ALTER TABLE `store_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `store_item_color`
--
ALTER TABLE `store_item_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_orders`
--
ALTER TABLE `store_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `store_orders_items`
--
ALTER TABLE `store_orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `store_shoppertrack`
--
ALTER TABLE `store_shoppertrack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
