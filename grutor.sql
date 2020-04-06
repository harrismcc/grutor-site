-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2020 at 09:41 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  `time` datetime(6) DEFAULT CURRENT_TIMESTAMP(6),
  `in_progress` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `name`, `link`, `complete`, `time`, `in_progress`) VALUES
(1, 'test', 'http://test.com', 1, '0000-00-00 00:00:00.000000', 0),
(2, 'John', 'http://test.com', 1, '2020-03-18 00:00:00.000000', 1),
(3, 'Harris McCullers', 'http://www.test.com/', 1, '2020-03-10 16:28:51.616142', 0),
(4, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:46:07.939592', 0),
(5, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:46:08.411779', 0),
(6, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:46:14.172755', 0),
(7, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:46:14.664841', 0),
(8, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:46:19.870615', 0),
(9, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:47:20.745224', 0),
(10, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:47:21.310232', 0),
(11, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:47:26.480514', 0),
(12, 'as', 'http://www.notamagnet.com', 1, '2020-03-10 17:47:28.958473', 0),
(13, 'harrismcc', 'aaaaa', 1, '2020-03-10 17:59:49.417944', 1),
(14, 'Ian', 'http://googlehangout.ngng', 1, '2020-03-10 19:59:13.894834', 1),
(15, 'Jasper', 'link.com', 0, '2020-03-10 23:19:05.983738', 1),
(16, 'Harris', 'http://www.notamagnet.com', 0, '2020-03-11 10:29:23.227852', 1),
(17, 'Test', 'http://www.test.com/', 0, '2020-03-11 10:38:21.049188', 0),
(18, 'Blaine Mosley', 'Eu vero quod labore ', 0, '2020-03-11 11:54:46.962609', 0),
(19, 'Anjolie Salinas', 'Consequat Distincti', 0, '2020-03-11 11:55:33.034798', 0),
(20, 'Quail Estrada', 'Odio cumque dolore i', 0, '2020-03-11 13:18:48.142408', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
