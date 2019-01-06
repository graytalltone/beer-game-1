-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 01 月 06 日 08:27
-- 伺服器版本: 10.1.35-MariaDB
-- PHP 版本： 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `beer_game`
--

-- --------------------------------------------------------

--
-- 資料表結構 `consumer`
--

CREATE TABLE `consumer` (
  `week` int(11) NOT NULL,
  `quanitity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `consumer`
--

INSERT INTO `consumer` (`week`, `quanitity`) VALUES
(1, 10),
(2, 15),
(1, 10),
(2, 15),
(3, 15),
(4, 18),
(5, 15),
(6, 15),
(7, 6),
(8, 33),
(9, 12),
(10, 15);

-- --------------------------------------------------------

--
-- 資料表結構 `ord`
--

CREATE TABLE `ord` (
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
-- 資料表的匯出資料 `ord`
--

INSERT INTO `ord` (`oid`, `uid`, `ord`, `purc`, `need`, `sales`, `stock`, `cost`, `week`) VALUES
(1, 1, 5, 4, 4, 4, 4, 4, 1),
(2, 1, 5, 4, 4, 4, 4, 4, 2),
(3, 2, 5, 4, 4, 4, 4, 4, 1),
(4, 2, 5, 4, 4, 4, 4, 4, 2),
(5, 3, 5, 4, 4, 100, 4, 4, 1),
(6, 3, 5, 4, 4, 4, 4, 4, 2),
(7, 4, 5, 4, 4, 4, 4, 4, 2),
(8, 4, 5, 4, 4, 4, 4, 4, 1),
(9, 1, 5, 4, 4, 4, 4, 4, 3),
(10, 2, 5, 4, 4, 4, 4, 4, 3),
(36, 3, 5, 5, 5, 5, 5, 5, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `team`
--

CREATE TABLE `team` (
  `tid` int(11) NOT NULL,
  `rank` int(2) NOT NULL,
  `Tcost` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `team`
--

INSERT INTO `team` (`tid`, `rank`, `Tcost`, `status`) VALUES
(1, 0, 0, 1),
(2, 6, 0, 0),
(3, 0, 0, 0),
(4, 0, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `uid` bigint(20) NOT NULL,
  `loginID` text NOT NULL,
  `pwd` text NOT NULL,
  `pms` int(1) NOT NULL,
  `rid` int(1) NOT NULL,
  `tid` int(2) NOT NULL,
  `Ucost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`uid`, `loginID`, `pwd`, `pms`, `rid`, `tid`, `Ucost`) VALUES
(1, 'test', '123', 0, 1, 1, 0),
(2, 'ttt', '111', 0, 2, 1, 0),
(3, 'qq', '1', 0, 3, 1, 0),
(4, 'qqq', '123', 0, 4, 1, 0),
(6, '0', '1234', 1, 0, 0, 0),
(7, 'q', '222', 0, 2, 2, 0);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`oid`);

--
-- 資料表索引 `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`tid`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `ord`
--
ALTER TABLE `ord`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- 使用資料表 AUTO_INCREMENT `team`
--
ALTER TABLE `team`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
