-- phpMyAdmin SQL Dump
-- version 3.3.7deb8
-- http://www.phpmyadmin.net
--
-- Host: mydbb2.surf-town.net
-- Generation Time: Sep 28, 2014 at 04:02 PM
-- Server version: 5.1.63
-- PHP Version: 5.3.3-7+squeeze21

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `msoft_dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `para`
--

CREATE TABLE IF NOT EXISTS `para` (
  `ParaID` int(11) NOT NULL AUTO_INCREMENT,
  `ParaCalUrl` varchar(250) NOT NULL,
  `ParaLastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ParaShowNbrDays` int(11) NOT NULL,
  `ParaName` varchar(255) NOT NULL,
  PRIMARY KEY (`ParaID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `para`
--


-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `PersonID` int(12) NOT NULL AUTO_INCREMENT,
  `PersonParaID` int(11) NOT NULL,
  `PersonName` varchar(100) NOT NULL,
  PRIMARY KEY (`PersonID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `persons`
--


-- --------------------------------------------------------

--
-- Table structure for table `tripdetails`
--

CREATE TABLE IF NOT EXISTS `tripdetails` (
  `DetailID` int(11) NOT NULL AUTO_INCREMENT,
  `DetailParaID` int(11) NOT NULL,
  `DetailTripUid` varchar(250) NOT NULL,
  `DetailPersDrvId` int(11) NOT NULL,
  `DetailDrvType` int(5) NOT NULL,
  `DetailPersPassId1` int(11) NOT NULL,
  `DetailPassType1` int(5) NOT NULL,
  `DetailPersPassId2` int(11) NOT NULL,
  `DetailPassType2` int(5) NOT NULL,
  `DetailPersPassId3` int(11) NOT NULL,
  `DetailPassType3` int(5) NOT NULL,
  `DetailPersPassId4` int(11) NOT NULL,
  `DetailPassType4` int(5) NOT NULL,
  `DetailNbrPass` int(2) NOT NULL,
  `DetailComment` varchar(250) NOT NULL,
  PRIMARY KEY (`DetailID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tripdetails`
--


-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `TripID` int(11) NOT NULL AUTO_INCREMENT,
  `TripParaID` int(11) NOT NULL,
  `TripStart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TripEnd` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TripLocation` varchar(250) NOT NULL,
  `TripSummary` varchar(250) NOT NULL,
  `TripDescription` varchar(500) NOT NULL,
  `TripUid` varchar(250) NOT NULL,
  `TripContains` int(11) NOT NULL,
  PRIMARY KEY (`TripID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=938 ;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`TripID`, `TripParaID`, `TripStart`, `TripEnd`, `TripLocation`, `TripSummary`, `TripDescription`, `TripUid`, `TripContains`) VALUES
(937, 21, '2014-10-02 19:00:00', '2014-10-02 21:30:00', 'Metallåtervinning Arena', 'A-lagsmatch vs Björklöven', '', '20141002T190000-7037560@laget.se', 1),
(936, 21, '2014-09-30 19:00:00', '2014-09-30 21:30:00', 'Metallåtervinning Arena', 'A-lagsmatch vs Asplöven', '', '20140930T190000-7037540@laget.se', 0),
(905, 24, '2014-09-29 09:45:00', '2014-09-29 17:00:00', 'Gränby ishallar', 'Hockeycamp', 'Samlingstid\\n2014-09-29 09:00\\nÖvrig info\\nAlmtuna har en endagarscamp där 3 ispass, lunch och instruktörer från vårt A-lag, J20, J18, U16 och hockeygymnasium ingår. Dock ska eget mellanmål medtagas. Kostnad 200 kr, sätts in på lagkassan. Ta aven med fyskläder för utomhusbruk.\\nIstider:\\n09.45-10.45 Isträning B-hallen\\n12.30-13.30 Isträning A-hallen\\n13.45-14.15 Lunch\\n16.00-17.00 Isträning B-hallen\\n\\n', '20140929T094500-7126935@laget.se', 0),
(935, 21, '2014-10-02 18:30:00', '2014-10-02 19:30:00', 'Bhallen', 'Träning - Almtuna IS Team 03', '\\nÖvrig info\\n-03/-04 Uppsala Young', '20141002T183000-7137376@laget.se', 0),
(934, 21, '2014-09-29 08:15:00', '2014-09-29 15:45:00', 'Gränby Ishallar (A)', 'Hockeycamp', 'Samlingstid\\n2014-09-29 07:45\\nÖvrig info\\nMedtag mellanmål. Lunch serveras i VIP', '20140929T081500-7106560@laget.se', 0),
(933, 21, '2014-09-28 15:00:00', '2014-09-28 16:00:00', '', 'Match: Almtuna - Huddinge', '\\n\\nLäs mer om matchen\\nhttp://www.laget.se/ALMTUNAISTEAM03/Division/Game/173524/4037509', '20140928T150000-7158309@laget.se', 0),
(931, 21, '2014-09-28 10:15:00', '2014-09-28 11:15:00', 'A-hallen', 'Träning - Almtuna IS Team 03', '', '20140928T101500-7137372@laget.se', 0),
(932, 21, '2014-09-28 10:30:00', '2014-09-28 16:15:00', 'AHALLEN', 'Match: Almtuna - Huddinge', 'Samlingstid\\n2014-09-28 10:00\\nÖvrig info\\nTräning 10:30 , Gemensam Lunch Chop -Chop (betalas själv) ,  Matcher 13:30 och 15:00\\n\\nLäs mer om matchen\\nhttp://www.laget.se/ALMTUNAISTEAM03/Division/Game/173524/4037508', '20140928T103000-7158308@laget.se', 0),
(906, 24, '2014-09-30 16:30:00', '2014-09-30 17:30:00', 'UTK-Hallen', 'Träning - Almtuna IS Team 01', '\\nÖvrig info\\nUP-träning. \\nSe till att vara ombytt och klar utsatt tid. Medtag vattenflaska.', '20140930T163000-7142392@laget.se', 0),
(900, 23, '2014-09-28 15:00:00', '2014-09-28 16:00:00', '', 'Match: Almtuna - Huddinge', '\\n\\nLäs mer om matchen\\nhttp://www.laget.se/ALMTUNAISTEAM03/Division/Game/173524/4037509', '20140928T150000-7158309@laget.se', 0),
(901, 23, '2014-09-29 08:15:00', '2014-09-29 15:45:00', 'Gränby Ishallar (A)', 'Hockeycamp', 'Samlingstid\\n2014-09-29 07:45\\nÖvrig info\\nMedtag mellanmål. Lunch serveras i VIP', '20140929T081500-7106560@laget.se', 0),
(902, 23, '2014-10-02 18:30:00', '2014-10-02 19:30:00', 'Bhallen', 'Träning - Almtuna IS Team 03', '\\nÖvrig info\\n-03/-04 Uppsala Young', '20141002T183000-7137376@laget.se', 0),
(908, 24, '2014-09-30 19:00:00', '2014-09-30 21:30:00', 'Metallåtervinning Arena', 'A-lagsmatch vs Asplöven', '', '20140930T190000-7037540@laget.se', 0),
(909, 24, '2014-10-02 19:00:00', '2014-10-02 21:30:00', 'Metallåtervinning Arena', 'A-lagsmatch vs Björklöven', '', '20141002T190000-7037560@laget.se', 2),
(903, 23, '2014-09-30 19:00:00', '2014-09-30 21:30:00', 'Metallåtervinning Arena', 'A-lagsmatch vs Asplöven', '', '20140930T190000-7037540@laget.se', 0),
(904, 23, '2014-10-02 19:00:00', '2014-10-02 21:30:00', 'Metallåtervinning Arena', 'A-lagsmatch vs Björklöven', '', '20141002T190000-7037560@laget.se', 1),
(907, 24, '2014-10-02 19:45:00', '2014-10-02 20:45:00', 'B-hallen', 'Träning - Almtuna IS Team 01', '', '20141002T194500-7140507@laget.se', 0),
(899, 23, '2014-09-28 10:30:00', '2014-09-28 16:15:00', 'AHALLEN', 'Match: Almtuna - Huddinge', 'Samlingstid\\n2014-09-28 10:00\\nÖvrig info\\nTräning 10:30 , Gemensam Lunch Chop -Chop (betalas själv) ,  Matcher 13:30 och 15:00\\n\\nLäs mer om matchen\\nhttp://www.laget.se/ALMTUNAISTEAM03/Division/Game/173524/4037508', '20140928T103000-7158308@laget.se', 0),
(898, 23, '2014-09-28 10:15:00', '2014-09-28 11:15:00', 'A-hallen', 'Träning - Almtuna IS Team 03', '', '20140928T101500-7137372@laget.se', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attemps',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `user_paraid` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

