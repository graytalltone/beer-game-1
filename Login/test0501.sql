-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2019 at 09:20 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beer game`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `oid` int(11) NOT NULL,
  `uid` int(20) NOT NULL,
  `ord` int(4) NOT NULL,
  `purc` int(4) NOT NULL,
  `need` int(4) NOT NULL,
  `sales` int(4) NOT NULL,
  `stock` int(4) NOT NULL,
  `cost` int(11) NOT NULL,
  `week` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `uid`, `ord`, `purc`, `need`, `sales`, `stock`, `cost`, `week`) VALUES
(10, 3, 0, 0, 0, 0, 0, 0, 0),
(11, 3, 0, 0, 0, 0, 0, 0, 0),
(12, 3, 0, 0, 0, 0, 0, 0, 0),
(13, 3, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `tid` int(11) NOT NULL,
  `teamName` varchar(20) NOT NULL,
  `teamOwner` varchar(20) NOT NULL,
  `rank` int(2) NOT NULL,
  `Tcost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`tid`, `teamName`, `teamOwner`, `rank`, `Tcost`) VALUES
(18, 'a1212', '00000000', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teamstatus`
--

CREATE TABLE `teamstatus` (
  `id` int(10) NOT NULL,
  `loginID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `teamName` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `prio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teamstatus`
--

INSERT INTO `teamstatus` (`id`, `loginID`, `teamName`, `role`, `prio`) VALUES
(1, '00000000', 'a1212', 'whole', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` bigint(20) NOT NULL,
  `loginID` varchar(20) NOT NULL,
  `pwd` text NOT NULL,
  `pms` int(1) NOT NULL,
  `rid` int(1) NOT NULL,
  `tid` int(2) NOT NULL,
  `Ucost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `loginID`, `pwd`, `pms`, `rid`, `tid`, `Ucost`) VALUES
(1, '00000000', '1234', 1, 0, 0, 0),
(2, 'test', '123', 0, 0, 0, 0),
(3, 'aaa', '0', 0, 0, 0, 0),
(5, 'ccc', '111', 0, 0, 0, 0),
(6, 'ccc', '222', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `teamstatus`
--
ALTER TABLE `teamstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `teamstatus`
--
ALTER TABLE `teamstatus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
