-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2012 at 09:00 PM
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
  PRIMARY KEY (`user_id`),
  KEY `list_artist_type_id` (`list_artist_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`user_id`, `list_artist_type_id`, `description`) VALUES
(11, NULL, NULL);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `user_id`, `created_at`, `status`, `type`, `priority`, `sending_time`, `sending_counter`, `hash`, `error_message`, `host`, `host_name`, `protocol`, `charset`, `from_name`, `from_address`, `receiver_name`, `receiver_address`, `receivers`, `subject`, `body`) VALUES
(1, 1, 1332172970, 0, 1, 1, NULL, 0, 'e1832902a7226f40028f25bfbaca2b5e', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test1@test.com', 'test1@test.com', NULL, 'Mojbend.rs Account Activation', 'OVO JE REGISTER MEJL<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/1/token/3b048c0c52d2c32e7df9a935fcbcbc33">http://localhost/mojbend/webroot/user/activate/uid/1/token/3b048c0c52d2c32e7df9a935fcbcbc33</a>'),
(2, 2, 1332194477, 0, 1, 1, NULL, 0, '61bfa4310a9dfa53e82ed7c8528b0a67', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'Te', 'test2@test.com', NULL, 'Mojbend.rs Account Activation', 'OVO JE REGISTER MEJL<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/2/token/883eb129e5f92e30a2e6b5517b2f876c">http://localhost/mojbend/webroot/user/activate/uid/2/token/883eb129e5f92e30a2e6b5517b2f876c</a>'),
(3, 11, 1332263926, 0, 1, 1, NULL, 0, '74e644e7b07105d26cdeb8997e8775ed', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test11@test.com', 'test11@test.com', NULL, 'Mojbend.rs Account Activation', 'OVO JE REGISTER MEJL<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/11/token/e98d78e500bc68001ca763db6cca9be8">http://localhost/mojbend/webroot/user/activate/uid/11/token/e98d78e500bc68001ca763db6cca9be8</a>');

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


-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` int(10) unsigned NOT NULL,
  `founded_date` date DEFAULT NULL,
  `official_website` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_picture_id` (`profile_picture_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`, `created_at`, `founded_date`, `official_website`, `location`, `facebook_url`, `twitter_url`, `youtube_url`, `profile_picture_id`) VALUES
(1, 'Test', 'mi smo neki tamo bend.\r\nmi smo neki tamo bend.\r\nmi smo neki tamo bend.\r\nmi smo neki tamo bend.mi smo neki tamo bend.\r\nmi smo neki tamo bend.\r\nmi smo neki tamo bend.\r\nmi smo neki tamo bend.\r\nvmi smo neki tamo bend.vmi smo neki tamo bend.mi smo neki tamo bend.', 1332263134, '2012-03-08', 'http://www.asdfadf.com', NULL, '', '', 'http://youtube.com', 1),
(2, 'Asdfasdf', '', 1332196850, '0000-00-00', 'http://asdf.com', NULL, '', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `group_member_request`
--

CREATE TABLE IF NOT EXISTS `group_member_request` (
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`sender_id`,`receiver_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_member_request`
--

INSERT INTO `group_member_request` (`sender_id`, `receiver_id`, `group_id`, `created_at`, `status`) VALUES
(1, 1, 1, 1332193328, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_picture`
--

CREATE TABLE IF NOT EXISTS `group_picture` (
  `group_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  KEY `group_id` (`group_id`,`picture_id`),
  KEY `picture_id` (`picture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_picture`
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `list_artist_type`
--

INSERT INTO `list_artist_type` (`id`, `name`) VALUES
(1, 'Guitarist'),
(2, 'Drummer'),
(3, 'Bas gitarista'),
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `list_instrument`
--

INSERT INTO `list_instrument` (`id`, `name`, `description`) VALUES
(1, 'Guitar', 'This is very good instrument...'),
(2, 'Violin', NULL),
(3, 'Bass guitar', NULL),
(4, 'Drums', NULL),
(5, 'Piano', NULL),
(6, 'Trombone', NULL),
(7, 'Keyboard', NULL),
(8, 'Vocals', NULL),
(9, 'Back vocals', NULL);

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
  `birth_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`user_id`, `first_name`, `last_name`, `gender`, `birth_date`) VALUES
(1, '', '', NULL, '0000-00-00'),
(2, 'Te', '', NULL, '0000-00-00'),
(3, '', '', NULL, '0000-00-00'),
(4, '', '', NULL, '0000-00-00'),
(5, '', '', NULL, '0000-00-00'),
(6, '', '', NULL, '0000-00-00'),
(7, '', '', NULL, '0000-00-00'),
(8, '', '', NULL, '0000-00-00'),
(9, '', '', NULL, '0000-00-00'),
(10, '', '', NULL, '0000-00-00'),
(11, '', '', NULL, '0000-00-00');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `name`, `path`, `size`, `type`, `extension`, `created_at`) VALUES
(1, 'c4d83772f12d29c7e96360cef8', '37/ee/4d/c4d83772f12d29c7e96360cef8.jpg', 497583, 'image/jpeg', 'jpg', 1332185696),
(2, 'cc41a5b8c4ada11b2906bf8f41', '79/db/2c/cc41a5b8c4ada11b2906bf8f41.png', 1773, 'image/png', 'png', 1332186036);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `salt`, `status`, `created_at`, `language`, `cookie_token`, `logged_in`, `activation_hash`, `username`) VALUES
(1, 'test1@test.com', 'd1d0d410a091e9fa24fdb46d065cad5b', '3053644ce50fa79be0bdf65eaa7bdabe', 2, 1332172970, 'sr_yu', 'd205602ba62cbdd8c9bc588b4f8c73a7', 0, '3b048c0c52d2c32e7df9a935fcbcbc33', NULL),
(2, 'test2@test.com', '0ceba3d9b2b74a77750e9c9bd2c18afc', 'c55390960191fb893b61c663747fa4a7', 1, 1332194477, 'sr_yu', NULL, 0, '883eb129e5f92e30a2e6b5517b2f876c', NULL),
(3, 'test3@test.com', '93b1ff9a48eb18d1f21fd98c06c0eb2a', '20de51ba1d4c11fc0d1617bef026dae9', 2, 1332263569, 'sr_yu', '4a2e4880a5fb9780ebf352168290bf7d', 0, 'c447098717273b0cd30370bf32a89051', NULL),
(4, 'test4@test.com', '2a0603d86358a6bcff536843c20ac33b', 'fb9647909b2e604dd328e72ff39f2095', 2, 1332263650, 'sr_yu', '9a5503ccd2de5ce50f625bc11d2f1124', 0, 'd183db92ee0eb1ff305aa91c4532e30a', NULL),
(5, 'test5@test.com', '08ca5476a2d8bf173d4216aeb82e7d86', '71eda733afccaea7df81546bff89ea0a', 1, 1332263765, 'sr_yu', NULL, 0, '95257672386df18cd644a575749040ef', NULL),
(6, 'test6@test.com', 'e64a8c02648f94df951cbc9edeb251b0', '513e5fc2f1279741fbb0b41125c7e9ff', 1, 1332263812, 'sr_yu', NULL, 0, 'd5e06ce61a049992f12a262978ae1c52', NULL),
(7, 'test7@test.com', 'a9889978eccb088f388093f56a8c5c39', 'a67aec11e09df9c8b34116b7bd08d87f', 1, 1332263852, 'sr_yu', NULL, 0, '411ae897d194ef8ce0212e2d341dc151', NULL),
(8, 'test8@test.com', '1ed0c9f970c8d750f16aa50d5316153c', 'cb514d8b0f3ebb0692f41428743f6e8f', 1, 1332263878, 'sr_yu', NULL, 0, '8805df8270566497029f62c6057b71e8', NULL),
(9, 'test9@test.com', 'cebd18e579156e5c5e9ac51f1bc99012', '859bf541fe6ac0f5cd50f1dd4249d280', 1, 1332263892, 'sr_yu', NULL, 0, '333d3d32fe047bedeb888d924c462b16', NULL),
(10, 'test10@test.com', '2bab932458fb52c81024343a62e77abf', '04c73f397d67e65af31e00129899bdd9', 1, 1332263903, 'sr_yu', NULL, 0, '9f21a020e5c0fd525eefd315c72a63f7', NULL),
(11, 'test11@test.com', 'bffb94e0832d04d53401834697977fa3', '305f4cedfb3d47bfa95819a5ec8fff20', 2, 1332263926, 'sr_yu', '7923a075308811efa5c9fd64506f17ce', 1, 'e98d78e500bc68001ca763db6cca9be8', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `created_at`, `ip_address`, `user_agent`) VALUES
(1, 1, 1332173013, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(2, 1, 1332182757, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(3, 1, 1332186132, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(4, 1, 1332187526, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(5, 1, 1332188348, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(6, 1, 1332194466, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(7, 1, 1332262687, 3232235828, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.77 Safari/535.7'),
(8, 1, 1332262936, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(9, 1, 1332263243, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(10, 3, 1332263609, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(11, 4, 1332263674, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(12, 4, 1332263728, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11'),
(13, 11, 1332263961, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.79 Safari/535.11');

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
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`profile_picture_id`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_picture`
--
ALTER TABLE `group_picture`
  ADD CONSTRAINT `group_picture_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_picture_ibfk_2` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
