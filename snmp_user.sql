-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2016 at 09:12 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `snmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `snmp_user`
--

CREATE TABLE IF NOT EXISTS `snmp_user` (
  `user_no` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(40) NOT NULL,
  `user_pass` varchar(40) NOT NULL,
  `user_flag` int(11) NOT NULL DEFAULT '1',
  `name` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `age` int(3) NOT NULL,
  `position` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`user_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `snmp_user`
--

INSERT INTO `snmp_user` (`user_no`, `user_name`, `user_pass`, `user_flag`, `name`, `lastname`, `sex`, `age`, `position`, `email`) VALUES
(1, 'email@example.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'saliva', 'silvia', 'Male', 30, 'Manager', 'email@example.com'),
(2, 'operation@example.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, '', '', '', 0, '', ''),
(3, 'admin@email.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '', '', '', 0, '', ''),
(4, 'user@email.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, '', '', '', 0, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
