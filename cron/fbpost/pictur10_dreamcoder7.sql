-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2014 at 06:23 PM
-- Server version: 5.5.36-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pictur10_dreamcoder7`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_page`
--

CREATE TABLE IF NOT EXISTS `user_page` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fbId` bigint(20) NOT NULL,
  `pageId` bigint(20) NOT NULL,
  `pageName` varchar(100) NOT NULL,
  `sent` tinyint(1) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_page`
--

INSERT INTO `user_page` (`id`, `fbId`, `pageId`, `pageName`, `sent`, `token`) VALUES
(6, 620806918, 98033814349, 'Picturoo.com', 1, 'CAAEhIOmWxCsBAG8lJECrSA3C7gsbxvta9PqbdCq1ltyctjMFXqV1JaN0u5l9Io3PUC3PBksJIZAAOZAKWJ4qNML9MpnekXUvfSeSoosSvKlYVeAyhQV0jMET6tCKj7i7u3tn8rIPP2rUPWDwzplAegX906X40mrhREf6R7OSSxgsZB5hCrn');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
