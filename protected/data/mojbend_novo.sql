-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2012 at 11:39 PM
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
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `receiver_address` (`receiver_address`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `user_id`, `created_at`, `status`, `type`, `priority`, `sending_time`, `sending_counter`, `hash`, `error_message`, `host`, `host_name`, `protocol`, `charset`, `from_name`, `from_address`, `receiver_name`, `receiver_address`, `receivers`, `subject`, `body`) VALUES
(23, 1, 1332883377, 0, 1, 1, NULL, 0, '066326bf4d6ddc219b7d2ddeccdf2d8e', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test1@gmail.com', 'test1@gmail.com', NULL, 'Mojbend.rs Account Activation', 'Dobrodosli na Moj Bend.<br /><br />\nKliknite na link ispod:<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/1/token/2dfc9308a3ed4304a084640e12bdabb8">http://localhost/mojbend/webroot/user/activate/uid/1/token/2dfc9308a3ed4304a084640e12bdabb8</a>');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `group`
--


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
(2, 'Drummer'),
(4, 'Glavni vokal'),
(1, 'Guitarist'),
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
  `birth_date` date DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`user_id`, `first_name`, `last_name`, `gender`, `birth_date`) VALUES
(1, 'Afsda', 'Aasdf', NULL, '2012-03-15');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=130 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `name`, `path`, `size`, `type`, `extension`, `created_at`, `title`, `description`, `location`, `date`, `related_id`, `related`) VALUES
(1, 'default', 'cb/f6/aa/default', 206717, 'image/png', 'png', 1332696580, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `salt`, `status`, `created_at`, `language`, `cookie_token`, `logged_in`, `activation_hash`, `username`, `profile_picture_id`) VALUES
(1, 'test1@gmail.com', '7714673a6b90fb7d7c4cea6cb0c1dfbc', '14e3299f5effad0bbc35a6f9a3c01893', 2, 1332883377, 'sr_yu', '8ab715d914412a15b12b809f2598c6cf', 1, '2dfc9308a3ed4304a084640e12bdabb8', NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `created_at`, `ip_address`, `user_agent`) VALUES
(75, 1, 1332883402, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(76, 1, 1332883578, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11');

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
