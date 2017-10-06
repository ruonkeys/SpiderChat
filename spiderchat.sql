-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 08:05 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spiderchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockedusers`
--

CREATE TABLE IF NOT EXISTS `blockedusers` (
`id` int(11) NOT NULL,
  `blocker` varchar(16) NOT NULL,
  `blockee` varchar(16) NOT NULL,
  `blockdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
`id` int(11) NOT NULL,
  `account_owner` varchar(100) NOT NULL,
  `buddy` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `account_owner`, `buddy`, `date_time`, `message`) VALUES
(1, 'Rahul', 'john', '2017-02-03 20:04:19', 'hello john'),
(2, 'john', 'Rahul', '2017-02-03 20:04:35', 'hii rahul'),
(3, 'john', 'Rahul', '2017-02-03 20:06:17', 'what are you doing rahul'),
(4, 'Rahul', 'john', '2017-02-03 20:07:28', 'nothing interesting'),
(5, 'john', 'Rahul', '2017-02-03 20:07:41', 'why so'),
(6, 'Rahul', 'Mary', '2017-02-03 20:11:40', 'hii mary'),
(7, 'Mary', 'Rahul', '2017-02-03 20:12:54', 'hello rahul'),
(8, 'Rahul', 'john', '2017-02-03 22:34:37', 'hello john'),
(9, 'john', 'Rahul', '2017-02-03 22:35:14', 'hii'),
(10, 'Rahul', 'john', '2017-02-03 22:48:55', 'testing'),
(11, 'john', 'Rahul', '2017-02-03 22:49:57', 'hgjhghj'),
(12, 'john', 'Rahul', '2017-02-03 22:51:36', 'abcs'),
(13, 'john', 'Mary', '2017-02-04 11:47:01', 'hello mary'),
(14, 'john', 'Mary', '2017-02-04 11:47:10', 'hii'),
(15, 'Mary', 'john', '2017-02-04 11:50:22', 'hii john'),
(16, 'john', 'Mary', '2017-02-04 11:51:48', 'hey whatsup'),
(17, 'Mary', 'john', '2017-02-08 11:42:07', 'right now i am testing auto check of database\n'),
(18, 'john', 'Mary', '2017-02-08 12:19:34', 'i am working over same'),
(19, 'Mary', 'john', '2017-02-09 12:49:07', 'testing messaging feature');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
`id` int(11) NOT NULL,
  `user1` varchar(16) NOT NULL,
  `user2` varchar(16) NOT NULL,
  `datemade` datetime NOT NULL,
  `accepted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user1`, `user2`, `datemade`, `accepted`) VALUES
(1, 'Mary', 'john', '2017-01-25 13:11:30', '1'),
(2, 'Rahul', 'Mary', '2017-01-25 13:13:53', '1'),
(3, 'Rahul', 'john', '2017-01-25 13:14:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `initiator` varchar(16) NOT NULL,
  `app` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `did_read` enum('0','1') NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `username`, `initiator`, `app`, `note`, `did_read`, `date_time`) VALUES
(1, 'Rahul', 'Mary', 'Status Post', 'Mary posted on: <br /><a href="user.php?u=Mary#status_1">Mary&#39;s Profile</a>', '0', '2017-01-29 18:49:01'),
(2, 'john', 'Mary', 'Status Post', 'Mary posted on: <br /><a href="user.php?u=Mary#status_1">Mary&#39;s Profile</a>', '0', '2017-01-29 18:49:01'),
(3, 'Mary', 'Rahul', 'Status Reply', 'Rahul commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-01-29 18:50:26'),
(4, 'Mary', 'john', 'Status Reply', 'john commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-01-29 18:54:08'),
(5, 'Rahul', 'john', 'Status Reply', 'john commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-01-29 18:54:08'),
(6, 'Mary', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_4">Mary&#39;s Profile</a>', '0', '2017-01-29 18:58:13'),
(7, 'john', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_4">Mary&#39;s Profile</a>', '0', '2017-01-29 18:58:13'),
(8, 'john', 'Rahul', 'Status Reply', 'Rahul commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-01-30 11:59:40'),
(9, 'Mary', 'Rahul', 'Status Reply', 'Rahul commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-01-30 11:59:40'),
(10, 'Rahul', 'Mary', 'Status Reply', 'Mary commented here:<br /><a href="user.php?u=Mary#status_4">Click here to view the conversation</a>', '0', '2017-01-30 12:04:11'),
(11, 'john', 'Mary', 'Status Reply', 'Mary commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-01-30 12:05:08'),
(12, 'Rahul', 'Mary', 'Status Reply', 'Mary commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-01-30 12:05:08'),
(13, 'john', 'Rahul', 'Status Reply', 'Rahul commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-02-02 17:53:24'),
(14, 'Mary', 'Rahul', 'Status Reply', 'Rahul commented here:<br /><a href="user.php?u=Mary#status_1">Click here to view the conversation</a>', '0', '2017-02-02 17:53:24'),
(15, 'Mary', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_9">Mary&#39;s Profile</a>', '0', '2017-02-02 17:58:23'),
(16, 'john', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_9">Mary&#39;s Profile</a>', '0', '2017-02-02 17:58:23'),
(17, 'Mary', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_10">Mary&#39;s Profile</a>', '0', '2017-02-02 17:58:48'),
(18, 'john', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_10">Mary&#39;s Profile</a>', '0', '2017-02-02 17:58:48'),
(19, 'Mary', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_11">Mary&#39;s Profile</a>', '0', '2017-02-02 17:59:43'),
(20, 'john', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_11">Mary&#39;s Profile</a>', '0', '2017-02-02 17:59:44'),
(21, 'Mary', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Rahul#status_9">Rahul&#39;s Profile</a>', '0', '2017-02-04 11:44:57'),
(22, 'john', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Rahul#status_9">Rahul&#39;s Profile</a>', '0', '2017-02-04 11:44:57'),
(23, 'Rahul', 'john', 'Status Reply', 'john commented here:<br /><a href="user.php?u=Rahul#status_9">Click here to view the conversation</a>', '0', '2017-02-04 11:45:31'),
(24, 'Mary', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_11">Mary&#39;s Profile</a>', '0', '2017-04-02 15:13:25'),
(25, 'john', 'Rahul', 'Status Post', 'Rahul posted on: <br /><a href="user.php?u=Mary#status_11">Mary&#39;s Profile</a>', '0', '2017-04-02 15:13:25'),
(26, 'Rahul', 'Mary', 'Status Reply', 'Mary commented here:<br /><a href="user.php?u=Mary#status_11">Click here to view the conversation</a>', '0', '2017-04-02 15:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
`id` int(11) NOT NULL,
  `user` varchar(16) NOT NULL,
  `gallery` varchar(16) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `uploaddate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user`, `gallery`, `filename`, `description`, `uploaddate`) VALUES
(1, 'Rahul', 'Myself', 'SatJan2811094920175386.jpg', NULL, '2017-01-28 15:39:50'),
(2, 'Rahul', 'Random', 'SatJan2811165520178479.jpg', NULL, '2017-01-28 15:46:56'),
(3, 'Rahul', 'Friends', 'SatFeb47135420171128.jpg', NULL, '2017-02-04 11:43:55'),
(4, 'test', 'Random', 'ThuMar308284520176434.jpg', NULL, '2017-03-30 11:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `osid` int(11) NOT NULL,
  `account_name` varchar(16) NOT NULL,
  `author` varchar(16) NOT NULL,
  `type` enum('a','b','c') NOT NULL,
  `data` text NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `osid`, `account_name`, `author`, `type`, `data`, `postdate`) VALUES
(1, 1, 'Mary', 'Mary', 'a', 'hello everybody', '2017-01-29 18:49:01'),
(2, 1, 'Mary', 'Rahul', 'b', 'hii..! mary', '2017-01-29 18:50:26'),
(3, 1, 'Mary', 'john', 'b', 'hello guys\n', '2017-01-29 18:54:08'),
(5, 1, 'Mary', 'Rahul', 'b', 'what you are doing today?\n', '2017-01-30 11:59:39'),
(8, 1, 'Mary', 'Rahul', 'b', 'hey guys whatsup', '2017-02-02 17:53:24'),
(9, 9, 'Rahul', 'Rahul', 'a', 'hello everyone', '2017-02-04 11:44:57'),
(10, 9, 'Rahul', 'john', 'b', 'hello', '2017-02-04 11:45:31'),
(11, 11, 'Mary', 'Rahul', 'c', 'hello mary\n', '2017-04-02 15:13:25'),
(12, 11, 'Mary', 'Mary', 'b', 'hii', '2017-04-02 15:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `useroptions`
--

CREATE TABLE IF NOT EXISTS `useroptions` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `background` varchar(255) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `temp_pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useroptions`
--

INSERT INTO `useroptions` (`id`, `username`, `background`, `question`, `answer`, `temp_pass`) VALUES
(1, 'john', 'original', NULL, NULL, NULL),
(2, 'Mary', 'original', NULL, NULL, NULL),
(3, 'Rahul', 'original', NULL, NULL, NULL),
(4, 'Elly', 'original', NULL, NULL, NULL),
(5, 'ColterStevens', 'original', NULL, NULL, NULL),
(6, 'test', 'original', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `userlevel` enum('a','b','c','d') NOT NULL DEFAULT 'a',
  `avatar` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `signup` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `notescheck` datetime NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `website`, `country`, `userlevel`, `avatar`, `ip`, `signup`, `lastlogin`, `notescheck`, `activated`) VALUES
(1, 'john', 'john@gmail.com', 'john123', 'm', NULL, 'America', 'a', NULL, '1', '2017-01-25 13:09:05', '2017-02-09 13:02:28', '2017-02-04 11:45:18', '1'),
(2, 'Mary', 'mary@gmail.com', 'mary123', 'f', NULL, 'Australia', 'a', NULL, '1', '2017-01-25 13:10:57', '2017-04-02 16:04:47', '2017-04-02 15:14:24', '1'),
(3, 'Rahul', 'rahul97164@gmail.com', 'rahul123', 'm', NULL, 'India', 'a', '426829150.jpg', '1', '2017-01-25 13:13:22', '2017-04-02 15:13:25', '2017-03-30 13:16:42', '1'),
(4, 'Elly', 'elly@gmail.com', 'elly123', 'f', NULL, 'Australia', 'a', NULL, '1', '2017-01-30 12:02:04', '2017-01-30 12:02:32', '2017-01-30 12:02:04', '1'),
(5, 'ColterStevens', 'stevens@gmail.com', 'sourcecode', 'm', NULL, 'America', 'a', NULL, '1', '2017-03-30 11:56:30', '2017-03-30 11:56:30', '2017-03-30 11:56:30', '0'),
(6, 'test', 'test@gmail.com', 'test', 'm', NULL, 'Australia', 'a', NULL, '1', '2017-03-30 11:57:44', '2017-03-30 13:10:42', '2017-03-30 11:58:13', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockedusers`
--
ALTER TABLE `blockedusers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useroptions`
--
ALTER TABLE `useroptions`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blockedusers`
--
ALTER TABLE `blockedusers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
