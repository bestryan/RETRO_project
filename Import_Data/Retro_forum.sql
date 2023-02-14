-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 14, 2023 at 02:08 AM
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
-- Database: `Retro_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `post_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_text` text,
  `post_create_time` datetime DEFAULT NULL,
  `post_owner` varchar(30) DEFAULT NULL,
  `post_email` varchar(30) DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`post_id`, `topic_id`, `post_text`, `post_create_time`, `post_owner`, `post_email`, `type_id`) VALUES
(1, 1, 'I\'m just curious how all of you stumbled upon vinyl collective.\r\nI ended up finding them through an eBay auction...i bought the fear before art damage picture disc and then read in a newsletter thing about the edit box set coming and got so excited cause i was curious about when/if it would be released. then the great shipping price and section of records kept me coming back.', '2022-04-19 19:29:35', 'Jack', 'jack@tafe.com.au', 1),
(2, 2, 'Yo, Vinyl Collective, I am trying to move some stuff as I am soon to be moving myself physically to a new address.\r\n\r\nAlmost EVERYTHING is (Mint or NM-) but if your worried, feel free to reach out about the item(s) in question.\r\nI can provide photos and all that jazz for any item.\r\n \r\nCompared to \"list\" price on Discoggs (which is already marked down)\r\n- Take $5 off orders under $50\r\n- Take $10 off  orders under $100\r\n- Take $20 off orders over $100\r\n- Take $50 off orders over $200\r\n \r\nWilling to do additional discounts for big orders (multi-item).\r\nAll shipping will be a $5 flat fee via media mail.\r\n \r\nFeel free to reply here or DM for more info.\r\nPayments will be accepted \"friends and family\'s\" via paypal or venmo.', '2022-04-19 19:32:49', 'Liam', 'liam@tafe.com.au', 2),
(3, 3, 'I couldn\'t find the old thread but the season has been great so far.\r\nHornets are 3-0 and should be undefeated going into their game against the Lakers next week. One of those two will be in the finals.\r\nA.I. just got moved to Detroit for Billups and McDeyees but I don\'t see it benefiting either team.', '2022-04-19 19:34:17', 'Ryan Xiao', 'ryan@tafe.com.au', 3),
(4, 3, 'I\'m hoping its all about the Lakers this year. Very much looking forward to the Christmas day game between the Celtics and the Lake Show.', '2022-04-19 22:41:26', 'Shane', 'shane@tafe.com.au', 3),
(5, 1, 'I first found the site by pre-ordering pmfs - mercy on vinyl. i then signed up for an rss feed of the news posts to get the heads up on any additional releases. once i saw that ptw - versions and minus the bear - planet of ice were in the works i started to pay more attention to the site. then i found the message board and the rest is history. i love this place, so glad i found it.', '2022-04-19 22:43:19', 'Fed', 'fed@tafe.com.au', 1),
(6, 1, 'Russian Circles has a new record coming out you know:)', '2022-04-19 22:43:57', 'Oak', 'oak@tafe.com.au', 1),
(7, 2, 'I can pick up all.. Any more discount?', '2022-04-19 22:45:16', 'Nat', 'nat@tafe.com.au', 2),
(8, 4, 'My list,  in order of personal enjoyment:\r\n \r\n1. Porter Robinson - Nurture\r\n2. LOW - Hey What\r\n3. Kings of Convenience - Peace Or Love\r\n4. John Mayer - Sob Rock\r\n5. Tyler, The Creator - Call Me If You Get Lost\r\n6. Kanye West - Donda\r\n7. Silk Sonic - An Evening with Silk Sonic\r\n8. Mr. Jukes & Barney Artist – The Locket\r\n9. Andy McKee - Symbol\r\n10. Ryan Adams - Big Colors\r\n11. CHVRCHES - Screen Violence\r\n12. Kacey Musgraves - Star Crossed\r\n13. Third Eye Blind - Our Bande Apart\r\n14. Sarah Chernoff - Transitions\r\n15. Leon Bridges - Gold Diggers Sound\r\n16. K.D.A.P. - Influences', '2022-04-19 22:47:06', 'Satoshi', 'satoshi@tafe.com.au', 3),
(9, 4, 'My list thus far feels lackluster relative to how I felt about previous years top albums, but I’ve really enjoyed these still.\r\n \r\nLPs\r\nWowod - Yarost\' | Proschchenie\r\nDust Moth - Rising/Sailing\r\nGodspeed You! Black Emperor - At State’s End\r\nChevelle - NAITIAS\r\nSecret Gardens - Tundra\r\n \r\nEPs\r\nPsychonaut/Saver - Emerald\r\nPet Fox - More Than Anything \r\nSocial Contract - Buzzard’s Wake\r\nHeaven’s Cloak - EP1\r\nPictures of Wildlife - Terrene', '2022-04-19 22:47:48', 'Mrewest', 'mrewest@tafe.com.au', 3),
(10, 5, 'So I\'m finally getting rid of my condo and buying a house. 5 bedrooms, a living room, family room, and finished basement at my disposal.  \r\n\r\nProblem is, I\'ve only got 1 record player. So where the hell should I put it?\r\n\r\nDo any one you have more than 1 and, if so, where do you put them?', '2022-04-20 14:28:01', 'Hallo', 'hallo@tafe.com.au', 3),
(11, 6, 'Maybe this will fail but the idea is to have a thread that will be bumped everytime that a Fat Preorder. I\'ve missed a few in recent memory that kinda hurt. If everything works to plan, we will either notice the thread bumped or you can click the \"follow\" button and get an email sent to you each time someone posts.\r\n \r\nNot meant to replace threads for individual records. Take your \"I can\'t wait for this record\", \"Fat Mike has really lost it\", or \"my record came today\" posts elsewhere. Just \"like\" people\'s posts to show appreciation for posting the preorders.\r\n \r\nNow let\'s hopefully kick this off with a Swingin Utters preorder this week...', '2022-04-20 14:38:22', 'Bowski', 'bowski@tafe.com.au', 1),
(12, 5, 'Living room or bedroom?..', '2022-04-22 14:55:47', 'Stephanie', 'stephanie@tafe.com.au', 3),
(13, 1, 'I agree', '2022-05-09 10:54:23', 'Bella', 'bella@tafe.com', 1),
(14, 7, 'I have a watch to sell', '2022-05-09 10:55:29', 'Ryan', 'ryan@tafe.com', 2),
(15, 1, 'How much does it cost? Can you ship to Japan?', '2022-05-19 17:11:15', 'Nats', 'naaaachip@yahoo.co.jp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `topic_id` int(11) NOT NULL,
  `topic_title` varchar(150) DEFAULT NULL,
  `topic_create_time` datetime DEFAULT NULL,
  `topic_owner` varchar(30) DEFAULT NULL,
  `topic_email` varchar(30) DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`topic_id`, `topic_title`, `topic_create_time`, `topic_owner`, `topic_email`, `type_id`) VALUES
(1, 'How did you find Vinyl Collective?', '2022-04-19 19:29:35', 'Jack', 'jack@tafe.com.au', 1),
(2, 'Desperation Sale', '2022-04-19 19:32:49', 'Liam', 'liam@tafe.com.au', 2),
(3, 'NBA Discussion', '2022-04-19 19:34:17', 'Ryan', 'ryan@tafe.com.au', 3),
(4, 'Best Albums of 2021', '2022-04-19 22:47:06', 'Satoshi', 'satoshi@tafe.com.au', 3),
(5, 'More than 1 Record Player?', '2022-04-20 14:28:01', 'Hallo', 'hallo@tafe.com.au', 3),
(6, 'The Official Fat Wreck Preorder Thread', '2022-04-20 14:38:22', 'Bowski', 'bowski@tafe.com.au', 1),
(7, 'Apple Watch to sell', '2022-05-09 10:55:29', 'Ryan', 'ryan@tafe.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum_types`
--

CREATE TABLE `forum_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) DEFAULT NULL,
  `type_description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_types`
--

INSERT INTO `forum_types` (`type_id`, `type_name`, `type_description`) VALUES
(1, 'Vinyl Collective Message Board', 'Everything and anything pertaining to records.'),
(2, 'Sale/Trade/Wants', 'Use this board to sell, trade and post your wanted stuff'),
(3, 'Everything Else Message Board', 'Use this board to discuss everything else.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `forum_types`
--
ALTER TABLE `forum_types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forum_types`
--
ALTER TABLE `forum_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
