-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2012 at 06:44 AM
-- Server version: 5.1.61
-- PHP Version: 5.3.3-1ubuntu9.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mojbend`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `user_id` int(11) NOT NULL,
  `list_artist_type_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `list_artist_type_id` (`list_artist_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`user_id`, `list_artist_type_id`, `description`, `created_at`) VALUES
(1, 3, 'Super sam basista, pravi sam zmaj.', 1332996075),
(2, 4, 'Mnogo dobro pevam.', 1332991526),
(3, 6, 'Ja sam vrlo talentovani prateći vokal.', 1332990174),
(6, 1, 'Cepam gitaru', 1332994097);

-- --------------------------------------------------------

--
-- Table structure for table `artist_group`
--

CREATE TABLE IF NOT EXISTS `artist_group` (
  `artist_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`artist_id`,`group_id`),
  KEY `group_id` (`group_id`),
  KEY `artist_id` (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `artist_group`
--

INSERT INTO `artist_group` (`artist_id`, `group_id`, `created_at`, `role`) VALUES
(1, 1, 1332990982, 2),
(1, 2, 1332991064, 0),
(1, 3, 1332991151, 0),
(1, 4, 1332991152, 0),
(1, 5, 1332991196, 0),
(2, 2, 1332991753, 2),
(2, 4, 1332991766, 2),
(3, 1, 1332989912, 0),
(3, 3, 1332991894, 2);

-- --------------------------------------------------------

--
-- Table structure for table `artist_instrument`
--

CREATE TABLE IF NOT EXISTS `artist_instrument` (
  `artist_id` int(11) NOT NULL,
  `list_instrument_id` int(11) NOT NULL,
  `level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`artist_id`,`list_instrument_id`),
  KEY `artist_id` (`artist_id`),
  KEY `list_instrument_id` (`list_instrument_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `artist_instrument`
--


-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_at` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL,
  `priority` tinyint(4) NOT NULL DEFAULT '3',
  `sending_time` int(10) unsigned DEFAULT NULL,
  `sending_counter` tinyint(4) NOT NULL DEFAULT '0',
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `error_message` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `host` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'localhost',
  `host_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'master.mojbend.rs',
  `protocol` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'smtp',
  `charset` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'UTF-8',
  `from_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Mojbend.rs',
  `from_address` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noreply@mojbend.rs',
  `receiver_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `receiver_address` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `receivers` text COLLATE utf8_unicode_ci,
  `subject` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `receiver_address` (`receiver_address`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `user_id`, `created_at`, `status`, `type`, `priority`, `sending_time`, `sending_counter`, `hash`, `error_message`, `host`, `host_name`, `protocol`, `charset`, `from_name`, `from_address`, `receiver_name`, `receiver_address`, `receivers`, `subject`, `body`) VALUES
(27, 1, 1332987444, 0, 1, 1, NULL, 0, '99c55d65fff396a8cddb3e1f01a74fc1', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test1@gmail.com', 'test1@gmail.com', NULL, 'Mojbend.rs Account Activation', 'Dobrodosli na Moj Bend.<br /><br />\nKliknite na link ispod:<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/1/token/7d52e385f2c6c54b23cf4276e8ca6825">http://localhost/mojbend/webroot/user/activate/uid/1/token/7d52e385f2c6c54b23cf4276e8ca6825</a>'),
(28, 2, 1332988494, 0, 1, 1, NULL, 0, '060fa6cf2d3a1f5916b299278a3f66ea', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test2@gmail.com', 'test2@gmail.com', NULL, 'Mojbend.rs Account Activation', 'Dobrodosli na Moj Bend.<br /><br />\nKliknite na link ispod:<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/2/token/5be21947039cff55efa0e979a0623813">http://localhost/mojbend/webroot/user/activate/uid/2/token/5be21947039cff55efa0e979a0623813</a>'),
(29, 3, 1332989598, 0, 1, 1, NULL, 0, 'eb544e9e11562561595da9d9228af7f7', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test3@gmail.com', 'test3@gmail.com', NULL, 'Mojbend.rs Account Activation', 'Dobrodosli na Moj Bend.<br /><br />\nKliknite na link ispod:<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/3/token/d7dc1623bd5ccf1984ccceb3790c1569">http://localhost/mojbend/webroot/user/activate/uid/3/token/d7dc1623bd5ccf1984ccceb3790c1569</a>'),
(30, 4, 1332991234, 0, 1, 1, NULL, 0, '93bcb65972e1c60999c238eaa6b7ea55', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'Tes', 'test4@gmail.com', NULL, 'Mojbend.rs Account Activation', 'Dobrodosli na Moj Bend.<br /><br />\nKliknite na link ispod:<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/4/token/456dda1084d682b548bbe83c1d47457a">http://localhost/mojbend/webroot/user/activate/uid/4/token/456dda1084d682b548bbe83c1d47457a</a>'),
(31, 6, 1332994018, 0, 1, 1, NULL, 0, 'f85512eb6745661e434e270b406fdc76', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test5@gmail.com', 'test5@gmail.com', NULL, 'Mojbend.rs Account Activation', 'Dobrodosli na Moj Bend.<br /><br />\nKliknite na link ispod:<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/6/token/9c3dc7cd70fe91b04297220279bcdcfb">http://localhost/mojbend/webroot/user/activate/uid/6/token/9c3dc7cd70fe91b04297220279bcdcfb</a>'),
(32, 7, 1332994271, 0, 1, 1, NULL, 0, '172892c0196a7e2e5b13ce460d5a70ed', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'Voja Vojić', 'test6@gmail.com', NULL, 'Mojbend.rs Account Activation', 'Dobrodosli na Moj Bend.<br /><br />\nKliknite na link ispod:<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/7/token/52f2e610813fbb909e81fbbe85848201">http://localhost/mojbend/webroot/user/activate/uid/7/token/52f2e610813fbb909e81fbbe85848201</a>'),
(34, 17, 1332996033, 0, 1, 1, NULL, 0, '2868d47300a26893d85e7080b50f4738', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test9@gmail.com', 'test9@gmail.com', NULL, 'Mojbend.rs Account Activation', 'Dobrodosli na Moj Bend.<br /><br />\nKliknite na link ispod:<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/17/token/c4af02ef83f24e9317659ae25f5329f8">http://localhost/mojbend/webroot/user/activate/uid/17/token/c4af02ef83f24e9317659ae25f5329f8</a>');

-- --------------------------------------------------------

--
-- Table structure for table `fan_artist`
--

CREATE TABLE IF NOT EXISTS `fan_artist` (
  `fan_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fan_id`,`artist_id`),
  KEY `fan_id` (`fan_id`),
  KEY `artist_id` (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fan_artist`
--

INSERT INTO `fan_artist` (`fan_id`, `artist_id`, `created_at`) VALUES
(1, 1, 1332991853),
(1, 2, 1332992015),
(1, 3, 1332992003),
(4, 1, 1332991274),
(4, 3, 1332991269),
(6, 6, 1332994100);

-- --------------------------------------------------------

--
-- Table structure for table `fan_group`
--

CREATE TABLE IF NOT EXISTS `fan_group` (
  `fan_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fan_id`,`group_id`),
  KEY `fan_id` (`fan_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fan_group`
--

INSERT INTO `fan_group` (`fan_id`, `group_id`, `created_at`) VALUES
(1, 1, 1332990967),
(1, 4, 1332991161),
(1, 5, 1332991829),
(2, 2, 1332991757),
(2, 3, 1332991783),
(2, 4, 1332991767),
(3, 3, 1332991892),
(4, 1, 1332991380),
(4, 4, 1332991431);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` int(10) unsigned NOT NULL,
  `founded_date` date DEFAULT '0000-00-00',
  `official_website` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_picture_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `profile_picture_id` (`profile_picture_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`, `created_at`, `founded_date`, `official_website`, `location`, `facebook_url`, `twitter_url`, `youtube_url`, `profile_picture_id`) VALUES
(1, 'Najbolji Bend', 'Mi smo najbolji bend na planeti.\r\nMnogo smo dobri.', 1332989912, '2008-01-24', 'http://www.najboljibend.com', 'Novi sad', 'http://www.facebook.com/najboljibend', '', '', 19),
(2, 'Super Bend', '', 1332991064, '0000-00-00', 'http://www.superbend.com', '', '', 'http://www.twitter.com/superbend', '', 25),
(3, 'Dobar Bend', 'Mi smo dobar bend. Mnogo smo mladi i ludi.', 1332991126, '2002-01-20', '', 'Beograd', '', '', '', 1),
(4, 'Dobar Bend Najnoviji', 'Mi smo dobar bend. Mnogo smo mladi i ludi.', 1332991152, '0000-00-00', '', '', '', '', '', 29),
(5, 'Extra Bend', 'Extra smo.', 1332991196, '0000-00-00', '', 'Beograd', '', '', '', 27);

-- --------------------------------------------------------

--
-- Table structure for table `group_member_request`
--

CREATE TABLE IF NOT EXISTS `group_member_request` (
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`sender_id`,`receiver_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_member_request`
--


-- --------------------------------------------------------

--
-- Table structure for table `internal_error_log`
--

CREATE TABLE IF NOT EXISTS `internal_error_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_at` int(10) unsigned NOT NULL,
  `code` tinyint(4) NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `line` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `internal_error_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `list_artist_type`
--

CREATE TABLE IF NOT EXISTS `list_artist_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `list_artist_type`
--

INSERT INTO `list_artist_type` (`id`, `name`) VALUES
(3, 'Bas gitarista'),
(2, 'Bubnjar'),
(1, 'Gitarista'),
(4, 'Glavni vokal'),
(5, 'Klavijaturista'),
(6, 'Prateći vokal'),
(7, 'Solo pevač');

-- --------------------------------------------------------

--
-- Table structure for table `list_instrument`
--

CREATE TABLE IF NOT EXISTS `list_instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `list_instrument`
--

INSERT INTO `list_instrument` (`id`, `name`, `description`) VALUES
(1, 'Gitara', 'Ovo je veoma dobar instrument...'),
(2, 'Violina', NULL),
(3, 'Bas gitara', NULL),
(4, 'Bubnjevi', NULL),
(5, 'Klavir', NULL),
(6, 'Trombon', NULL),
(7, 'Klavijature', NULL),
(8, 'Vokal', NULL),
(9, 'Prateći vokal', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `list_role`
--

CREATE TABLE IF NOT EXISTS `list_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `list_role`
--


-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `birth_date` date DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`user_id`, `first_name`, `last_name`, `gender`, `birth_date`) VALUES
(1, 'Pera', 'Perić', 0, '1954-03-30'),
(2, 'Mika', 'Mikić', NULL, '2012-03-14'),
(3, 'Ana', 'Ivanović', 1, '0000-00-00'),
(4, 'Laza', 'Lazić', NULL, '0000-00-00'),
(6, 'Ivan', 'Ivanović', NULL, '0000-00-00'),
(7, 'Voja', 'Vojić', 0, '0000-00-00'),
(8, '', '', 0, '0000-00-00'),
(17, '', '', NULL, '2021-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT '0000-00-00',
  `related_id` int(11) DEFAULT NULL,
  `related` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `path` (`path`(255)),
  KEY `related_id` (`related_id`),
  KEY `related` (`related`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `name`, `path`, `size`, `type`, `extension`, `created_at`, `title`, `description`, `location`, `date`, `related_id`, `related`) VALUES
(1, 'default', 'cb/f6/aa/default', 206717, 'image/png', 'png', 1332696580, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'c927be0170f938c7aa9b438e79', '6d/b1/0e/c927be0170f938c7aa9b438e79', 350767, 'image/jpeg', 'jpg', 1332990374, 'Ovo sam ja', 'Ovo je moja slika.', 'Beograd', '0000-00-00', 3, 'artist'),
(19, 'bdb858061495f47e95aac43d32', '08/8e/fa/bdb858061495f47e95aac43d32', 284424, 'image/jpeg', 'jpg', 1332990503, '', '', '', '0000-00-00', 1, 'group'),
(20, 'de9b2b133e7c3c5d612ed0a877', '44/c6/7e/de9b2b133e7c3c5d612ed0a877', 945848, 'image/jpeg', 'jpg', 1332990548, '', '', '', '0000-00-00', 1, 'group'),
(21, '20240ae0918e80fbd43e12daee', '7c/5c/58/20240ae0918e80fbd43e12daee', 367982, 'image/jpeg', 'jpg', 1332990675, '', '', '', '0000-00-00', 1, 'group'),
(22, '73a35d3c1486f0afb4c90fdd4a', '08/46/44/73a35d3c1486f0afb4c90fdd4a', 113278, 'image/jpeg', 'jpg', 1332990728, 'Metallica', '', '', '0000-00-00', 1, 'group'),
(23, '0c882722802f3bc9d2b65db7a8', '2c/31/14/0c882722802f3bc9d2b65db7a8', 119200, 'image/jpeg', 'jpg', 1332990764, '', '', '', '0000-00-00', 1, 'group'),
(24, '22acc567e613ec7c78ece3b4bf', '25/6e/61/22acc567e613ec7c78ece3b4bf', 31916, 'image/jpeg', 'jpg', 1332990958, NULL, NULL, NULL, NULL, 1, 'artist'),
(25, '1ee0bc177711a351c7c2427d43', '74/10/2c/1ee0bc177711a351c7c2427d43', 62744, 'image/jpeg', 'jpg', 1332991063, NULL, NULL, NULL, NULL, NULL, 'group'),
(26, 'ce42f01d5f549ee1fefe9d3b50', '2f/77/83/ce42f01d5f549ee1fefe9d3b50', 270187, 'image/jpeg', 'jpg', 1332991734, '', '', '', '0000-00-00', 2, 'artist'),
(27, '2e86971fc1cf500f8e6cd672ca', 'b3/59/52/2e86971fc1cf500f8e6cd672ca', 497583, 'image/jpeg', 'jpg', 1332991814, '', '', '', '0000-00-00', 5, 'group'),
(28, '7fd14597ef9fa40d58d4e07de1', '6f/d5/ba/7fd14597ef9fa40d58d4e07de1', 171109, 'image/jpeg', 'jpg', 1332991825, '', '', '', '0000-00-00', 5, 'group'),
(29, '4366e6e31bd3a78f9d724c38f3', 'fe/fe/aa/4366e6e31bd3a78f9d724c38f3', 84238, 'image/jpeg', 'jpg', 1332991959, 'Ovo je cool', '', '', '0000-00-00', 4, 'group'),
(32, 'ac937486610aa0ed9565420ec5', '8e/5a/ce/ac937486610aa0ed9565420ec5', 1177903, 'image/jpeg', 'jpg', 1332994095, NULL, NULL, NULL, NULL, 6, 'artist');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m111127_191018_create_table_user', 1322421502),
('m111127_203623_create_table_user_log', 1322428883),
('m120320_024552_insert_into_artist_type_instrument', 1332262913);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` int(10) unsigned NOT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'sr_yu',
  `cookie_token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in` tinyint(4) DEFAULT '0',
  `activation_hash` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_picture_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `username` (`username`),
  KEY `profile_picture_id` (`profile_picture_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `salt`, `status`, `created_at`, `language`, `cookie_token`, `logged_in`, `activation_hash`, `username`, `profile_picture_id`) VALUES
(1, 'test1@gmail.com', '1709aac6ec704e4a47e2fa8bd0565479', 'a18ef1cd15d959fd80036e90519ca6cd', 2, 1332987444, 'sr_yu', '0981927747a597a82d5bad520d156001', 0, '7d52e385f2c6c54b23cf4276e8ca6825', NULL, 24),
(2, 'test2@gmail.com', 'c2ee39a2a17acf8c4320d2c1b42162ef', 'de1bbfe4cc84266eeb44b864f005492c', 2, 1332988494, 'sr_yu', '9806078d0e92e269b797d7ace2e23a53', 0, '5be21947039cff55efa0e979a0623813', NULL, 26),
(3, 'test3@gmail.com', '0dbe21f4dacbf26d6435d43e15235d25', '02d6a38d04b8469d356b13f9a5dba766', 2, 1332989598, 'sr_yu', 'bad15968f430096aa593f53182507869', 0, 'd7dc1623bd5ccf1984ccceb3790c1569', NULL, 18),
(4, 'test4@gmail.com', '329d9a09433136d8d18ad40308768899', '9f7c52a5ed16ff8e2c780875bd3f1b70', 2, 1332991234, 'sr_yu', 'c11cd33ce85715de8211e24773588d68', 0, '456dda1084d682b548bbe83c1d47457a', NULL, 1),
(6, 'test5@gmail.com', '1af90ccbdf7c6b623e8b141d92409793', '7c12649ed0e2d907e9aa989c99560ef5', 2, 1332994018, 'sr_yu', '5966370b8056d5b15d4a7020eb4e29ed', 0, '9c3dc7cd70fe91b04297220279bcdcfb', NULL, 32),
(7, 'test6@gmail.com', '72fc69e55bee7d21f7b595183e463e8e', '11f55806c8476223a2fe6b0f37c6cce8', 2, 1332994271, 'sr_yu', '41c2dae4a12529d24d1c5ac8f4fabccf', 0, '52f2e610813fbb909e81fbbe85848201', NULL, 1),
(8, 'test7@gmail.com', '03fb5111d947cb8e00c9a36efc1963c9', 'cf5faaa8555d7deb5d533adcc25c6325', 1, 1332994336, 'sr_yu', NULL, 0, '40a751e99ffb8caca6cfea402c01319c', NULL, 1),
(17, 'test9@gmail.com', '0883fa7df499c020edeb67380f25b9f4', '28e76725c033cc507280f637fc7b0328', 1, 1332996033, 'sr_yu', NULL, 0, 'c4af02ef83f24e9317659ae25f5329f8', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  `ip_address` int(10) unsigned DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `ip_address` (`ip_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=110 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `created_at`, `ip_address`, `user_agent`) VALUES
(90, 1, 1332987480, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(91, 2, 1332988510, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(92, 1, 1332989465, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(93, 2, 1332989499, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(94, 3, 1332989612, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(95, 1, 1332990868, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(96, 4, 1332991263, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(97, 3, 1332991457, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(98, 1, 1332991472, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(99, 2, 1332991485, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(100, 4, 1332991687, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(101, 2, 1332991722, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(102, 1, 1332991794, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(103, 3, 1332991882, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(104, 1, 1332991911, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(105, 1, 1332992098, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(106, 4, 1332992669, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(107, 6, 1332994042, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(108, 7, 1332994293, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(109, 1, 1332996061, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `artist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_ibfk_2` FOREIGN KEY (`list_artist_type_id`) REFERENCES `list_artist_type` (`id`);

--
-- Constraints for table `artist_group`
--
ALTER TABLE `artist_group`
  ADD CONSTRAINT `artist_group_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist_instrument`
--
ALTER TABLE `artist_instrument`
  ADD CONSTRAINT `artist_instrument_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_instrument_ibfk_2` FOREIGN KEY (`list_instrument_id`) REFERENCES `list_instrument` (`id`);

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fan_artist`
--
ALTER TABLE `fan_artist`
  ADD CONSTRAINT `fan_artist_ibfk_1` FOREIGN KEY (`fan_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fan_artist_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fan_group`
--
ALTER TABLE `fan_group`
  ADD CONSTRAINT `fan_group_ibfk_1` FOREIGN KEY (`fan_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fan_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`profile_picture_id`) REFERENCES `picture` (`id`);

--
-- Constraints for table `group_member_request`
--
ALTER TABLE `group_member_request`
  ADD CONSTRAINT `group_member_request_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `artist` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_member_request_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `artist` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_member_request_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `internal_error_log`
--
ALTER TABLE `internal_error_log`
  ADD CONSTRAINT `internal_error_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`profile_picture_id`) REFERENCES `picture` (`id`);

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
