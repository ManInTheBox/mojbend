-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2012 at 11:57 PM
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
(1, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque venenatis sagittis enim. Maecenas ligula erat, egestas congue, varius nec, sagittis nec, purus. In neque. Curabitur at metus tincidunt dui tristique molestie. Donec porta molestie tortor. Fusce euismod consectetuer sapien. Fusce ac velit.'),
(2, 3, 'sdfasfd');

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
(1, 5, 1332688865, 0),
(2, 6, 1332709136, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `user_id`, `created_at`, `status`, `type`, `priority`, `sending_time`, `sending_counter`, `hash`, `error_message`, `host`, `host_name`, `protocol`, `charset`, `from_name`, `from_address`, `receiver_name`, `receiver_address`, `receivers`, `subject`, `body`) VALUES
(15, 1, 1332685663, 0, 1, 1, NULL, 0, '2ff8c457156f0e1417a4989b5ebb74e6', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test1@gmail.com', 'test1@gmail.com', NULL, 'Mojbend.rs Account Activation', 'OVO JE REGISTER MEJL<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/1/token/57de05eab6c5ed5e3f26bfb1aed70275">http://localhost/mojbend/webroot/user/activate/uid/1/token/57de05eab6c5ed5e3f26bfb1aed70275</a>'),
(16, 2, 1332709023, 0, 1, 1, NULL, 0, '494119e9d2b961b00d365f51b6b901b6', NULL, 'localhost', 'master.mojbend.rs', 'smtp', 'UTF-8', 'Mojbend.rs', 'noreply@mojbend.rs', 'test2@gmail.com', 'test2@gmail.com', NULL, 'Mojbend.rs Account Activation', 'OVO JE REGISTER MEJL<br />\n<a href="http://localhost/mojbend/webroot/user/activate/uid/2/token/082f209fa616edc450fee4b20c3b9eb6">http://localhost/mojbend/webroot/user/activate/uid/2/token/082f209fa616edc450fee4b20c3b9eb6</a>');

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
(1, 1, 1332707368),
(2, 2, 1332709127);

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
(1, 5, 1332702075);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`, `created_at`, `founded_date`, `official_website`, `location`, `facebook_url`, `twitter_url`, `youtube_url`, `profile_picture_id`) VALUES
(5, 'Soundgarden', 'These slides can contain anything a webpage can!HTML, Javascript, images, flash or whatever!They''re completely easy to edit and add to as well, no need to bother editing or even going anywhere near some confusing Javascript files, simply add a <div></div> tag with your slider content to the "slides" contain - it takes just seconds to do!\r\n\r\nThese slides work using the absolutely wonderful lightweight jQuery plugin jFlow, originally written by Kean Loong and modified by both Mauro Belgiovine and spyka Webmaster. The script has been licensed under the open source MIT license, so feel free to play around and modify it as much or as little as you wish', 1332688865, '2008-01-16', '', '', '', '', '', 69),
(6, 'Xdffds Fdss Df Sdfsafd Afdfsd F Asdfsd', '', 1332709136, '2008-01-16', '', '', '', '', '', 1);

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
(1, 'Asdf', 'Asdf', NULL, '2012-03-07'),
(2, 'Xxxxxx', 'Xcv', NULL, '2012-03-12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=82 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `name`, `path`, `size`, `type`, `extension`, `created_at`, `title`, `description`, `location`, `date`, `related_id`, `related`) VALUES
(1, 'f113fb0d2b031c5b7630d4e226', 'c6/93/26/f113fb0d2b031c5b7630d4e226', 309076, 'image/jpeg', 'jpg', 1332696580, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'f069b85f042f2c56cc99c9add4', '1d/e2/b0/f069b85f042f2c56cc99c9add4', 1177903, 'image/jpeg', 'jpg', 1332698076, '', '', '', '0000-00-00', 5, 'group'),
(76, 'f924c0d0e6a2594cc01ef2d3ff', '03/63/2a/f924c0d0e6a2594cc01ef2d3ff', 236734, 'image/png', 'png', 1332701890, '', '', '', '0000-00-00', 5, 'group'),
(77, 'f9e702d08efc360247ef594b1c', '03/3a/37/f9e702d08efc360247ef594b1c', 236734, 'image/png', 'png', 1332706826, '', '', '', '0000-00-00', 1, 'artist'),
(80, 'c2a815611100673c7f2f4c0b3c', 'fb/1f/cf/c2a815611100673c7f2f4c0b3c', 335004, 'image/jpeg', 'jpg', 1332707022, '', '', '', '0000-00-00', 1, 'artist'),
(81, 'fd819da7f684784f6c6e86b307', 'b5/6e/e9/fd819da7f684784f6c6e86b307', 84238, 'image/jpeg', 'jpg', 1332707031, '', '', '', '0000-00-00', 1, 'artist');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `salt`, `status`, `created_at`, `language`, `cookie_token`, `logged_in`, `activation_hash`, `username`, `profile_picture_id`) VALUES
(1, 'test1@gmail.com', 'ffb83478af93747dd2c152d563f1458c', '177428a289c95d4e7c6834f97d702fb6', 2, 1332685663, 'sr_yu', '43714679665a8a30f75bb97c706065fc', 0, '57de05eab6c5ed5e3f26bfb1aed70275', NULL, 81),
(2, 'test2@gmail.com', '7e2dc933fdd7ae2d6e78cdee3744e257', 'c8c00d4759586c6d29b79f48bc6418e5', 2, 1332709023, 'sr_yu', '995ffeb68a6ba79474b898531cc7fad2', 1, '082f209fa616edc450fee4b20c3b9eb6', NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `created_at`, `ip_address`, `user_agent`) VALUES
(40, 1, 1332685685, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(41, 1, 1332691076, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(42, 1, 1332691237, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(43, 1, 1332692046, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(44, 1, 1332697048, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(45, 1, 1332708131, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11'),
(46, 2, 1332709037, 2130706433, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11');

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
