-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2016 at 03:59 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mummel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `color` varchar(6) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'A0A0A0' COMMENT 'Thread colour'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `color`) VALUES
(1, 'TestCategory', 'FF0000'),
(2, 'TestCategory2', '00FF00'),
(3, 'TestCategory3', '0000FF');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'Poster',
  `thread_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `text` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `thread_id`, `parent_id`, `text`) VALUES
(1, 1, 1, 0, 'Test comment number 1'),
(2, 1, 1, 1, 'This should be a child comment of comment number 1.'),
(3, 1, 3, 0, 'Test comment.'),
(4, 1, 1, 2, 'Child-child-comment.'),
(5, 1, 1, 2, 'Child-child-comment 2.'),
(6, 1, 1, 0, 'Comment 6 or somthing.'),
(7, 1, 1, 5, 'Mmmmmmm.'),
(8, 1, 1, 4, 'CAN I DO THIS?'),
(9, 1, 1, 7, 'Bananas comment.'),
(70, 1, 1, 0, 'asd'),
(69, 1, 4, 0, 'asdasd'),
(68, 1, 1, 0, 'Test'),
(67, 1, 1, 0, 'qweqwe'),
(66, 1, 3, 0, 'QWE'),
(65, 1, 3, 0, 'qweqwe'),
(64, 1, 2, 0, 'qweqwezx'),
(63, 1, 1, 0, 'qweqweasd'),
(62, 1, 1, 0, 'qwe'),
(61, 1, 2, 0, 'asd'),
(60, 1, 2, 0, 'qweqwe'),
(59, 1, 3, 0, 'Test Comment 2\r\n'),
(58, 1, 2, 0, 'Test comment\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `time` varchar(30) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'Poster',
  `url` text COLLATE utf8_swedish_ci,
  `title` text COLLATE utf8_swedish_ci NOT NULL,
  `text` text COLLATE utf8_swedish_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `category_id`, `user_id`, `url`, `title`, `text`) VALUES
(1, 1, 1, NULL, 'Test thread', 'This is a test thread with 2 comments.'),
(2, 2, 1, NULL, 'Test thread without comments.', 'This is a test thread without comments.'),
(3, 1, 1, NULL, 'This is the third test thread.', 'This thread has 1 comment.'),
(4, 3, 1, '', 'qwe', 'qwe');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`) VALUES
(1, 'test@test.test', '$2y$10$DcSMQdbrcSt9ki9RilzGIeXutIyu3AtfMWnbJoLG3oSTX.fS8HvT2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
