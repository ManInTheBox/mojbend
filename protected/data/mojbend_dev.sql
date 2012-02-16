-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2012 at 11:29 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mojbend_dev`
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


-- --------------------------------------------------------

--
-- Table structure for table `artist_instrument`
--

CREATE TABLE IF NOT EXISTS `artist_instrument` (
  `artist_id` int(11) NOT NULL,
  `list_instrument_id` int(11) NOT NULL,
  `level` tinyint(4) DEFAULT NULL,
  KEY `artist_id` (`artist_id`,`list_instrument_id`),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `user_id`, `created_at`, `status`, `type`, `priority`, `sending_time`, `sending_counter`, `hash`, `error_message`, `host`, `host_name`, `protocol`, `charset`, `from_name`, `from_address`, `receiver_name`, `receiver_address`, `receivers`, `subject`, `body`) VALUES
(1, 1, 1327237930, 1, 1, 1, 1327237932, 1, '8589651d5715bdaeca20a561c243b63f', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'zarko.stankovic@itsmyplay.com', 'zarko.stankovic@itsmyplay.com', NULL, 'Mojbend.rs Account Activation', 'OVO JE REGISTER MEJL<br />\n<a href="http://localhost/mojbend/webroot/user/activate?uid=1&amp;token=9690790f8c49be2700118989fa02a734">http://localhost/mojbend/webroot/user/activate?uid=1&token=9690790f8c49be2700118989fa02a734</a>');

-- --------------------------------------------------------

--
-- Table structure for table `fan`
--

CREATE TABLE IF NOT EXISTS `fan` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_fan_type_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `list_fan_id` (`list_fan_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `fan`
--


-- --------------------------------------------------------

--
-- Table structure for table `fan_artist`
--

CREATE TABLE IF NOT EXISTS `fan_artist` (
  `fan_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  KEY `fan_id` (`fan_id`,`artist_id`),
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
  KEY `fan_id` (`fan_id`,`group_id`),
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
  `facebook_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`, `created_at`, `founded_date`, `official_website`, `facebook_url`, `twitter_url`, `youtube_url`) VALUES
(1, 'SdfSdfsdSsdfSsdf', '', 1327258423, '0000-00-00', '', '', '', ''),
(2, 'Sdf Sdf Www Zzzz Eee', '', 1327258449, '0000-00-00', '', '', '', ''),
(3, 'S Sfd Dddfs Df Sdf', '', 1327356785, '0000-00-00', '', '', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `list_artist_type`
--

INSERT INTO `list_artist_type` (`id`, `name`) VALUES
(1, 'Guitarist'),
(2, 'Drummer');

-- --------------------------------------------------------

--
-- Table structure for table `list_fan_type`
--

CREATE TABLE IF NOT EXISTS `list_fan_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `list_fan_type`
--


-- --------------------------------------------------------

--
-- Table structure for table `list_instrument`
--

CREATE TABLE IF NOT EXISTS `list_instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `list_instrument`
--


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
(2, '', '', NULL, '0000-00-00'),
(3, 'Asdf', 'Eeee', NULL, '0000-00-00'),
(4, 'ee', 'sdfsdf', NULL, '0000-00-00'),
(5, 'Sdfsdf', 'Wewer', NULL, '0000-00-00');

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
('m111127_203623_create_table_user_log', 1322428883);

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
  `url_alias` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `salt`, `status`, `created_at`, `language`, `cookie_token`, `logged_in`, `activation_hash`, `url_alias`) VALUES
(1, 'zarko.stankovic@itsmyplay.com', '38ea376a2f70f5276552e6feb32a56b5', 'f7abf1b61c220e0b326770348bb58691', 2, 1327237930, 'sr_yu', '3aa14f0060251d5ba8ceb812861d2062', 1, '9690790f8c49be2700118989fa02a734', 'zare'),
(2, 'test1@test.com', 'e2f8be6d4ce7bee8bde373e479a1e2d9', '2967701ac13420f8ad1f8f60a46fb015', 2, 1327241093, 'sr_yu', '35a286dbec3276d97b8aab6e53fbf973', 0, '8882d4efe73475d48338de2a50727b70', NULL),
(3, 'test2@test.com', '8c99a1c29b1f4fe79cee90d2bb90a3a5', '9ce697246cc81d3d1a12dce0d7333dc7', 2, 1327258201, 'sr_yu', '0d2eec10cbe78dbbbb07376b81291da9', 0, 'e99ab64e47c5a905e2f463e7b5ab74ea', NULL),
(4, 'test3@test.com', '7cb67347e84a0f491b329e68068c389e', 'c00edc4dd0272b51b32eb32b266db655', 1, 1327258315, 'sr_yu', NULL, 0, '6e96016117b0bcf041d4f80f9fa53854', NULL),
(5, 'test4@test.com', 'e7fa084454c15f3c2d5e2ce853437b2c', 'b6e35ecf13a7bd6c4d563da5dcec9255', 1, 1327258369, 'sr_yu', NULL, 0, '69f93c2c9e9034963e382a4b8364f94b', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `list_role_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`,`group_id`),
  KEY `list_group_role_id` (`list_role_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_group`
--


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
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `created_at`, `ip_address`, `user_agent`) VALUES
(5, 1, 1327237961, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(6, 1, 1327238272, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(7, 1, 1327245198, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(8, 1, 1327245209, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(9, 1, 1327245433, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(10, 1, 1327245841, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(11, 1, 1327245871, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(12, 1, 1327245895, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(13, 1, 1327245937, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(14, 1, 1327245949, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(15, 1, 1327246022, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(16, 1, 1327246118, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(17, 1, 1327246181, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(18, 2, 1327246463, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(19, 1, 1327248064, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(20, 1, 1327248179, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(21, 1, 1327248450, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(22, 1, 1327248472, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(23, 1, 1327248558, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(24, 1, 1327248585, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(25, 1, 1327249435, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(26, 1, 1327249930, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(27, 1, 1327250930, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(28, 1, 1327251016, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(29, 1, 1327251043, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(30, 1, 1327256406, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(31, 1, 1327256948, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(32, 1, 1327257666, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(33, 3, 1327258218, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(34, 1, 1327258398, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(35, 1, 1327352046, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7'),
(36, 1, 1327426663, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.75 Safari/535.7');

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
-- Constraints for table `artist_instrument`
--
ALTER TABLE `artist_instrument`
  ADD CONSTRAINT `artist_instrument_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_instrument_ibfk_2` FOREIGN KEY (`list_instrument_id`) REFERENCES `list_instrument` (`id`);

--
-- Constraints for table `fan`
--
ALTER TABLE `fan`
  ADD CONSTRAINT `fan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fan_ibfk_2` FOREIGN KEY (`list_fan_type_id`) REFERENCES `list_fan_type` (`id`);

--
-- Constraints for table `fan_artist`
--
ALTER TABLE `fan_artist`
  ADD CONSTRAINT `fan_artist_ibfk_1` FOREIGN KEY (`fan_id`) REFERENCES `fan` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fan_artist_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fan_group`
--
ALTER TABLE `fan_group`
  ADD CONSTRAINT `fan_group_ibfk_1` FOREIGN KEY (`fan_id`) REFERENCES `fan` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fan_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `internal_error_log`
--
ALTER TABLE `internal_error_log`
  ADD CONSTRAINT `internal_error_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `list_role`
--
ALTER TABLE `list_role`
  ADD CONSTRAINT `list_role_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `list_role` (`id`);

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_ibfk_3` FOREIGN KEY (`list_role_id`) REFERENCES `list_role` (`id`);

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `fk_user_log_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
