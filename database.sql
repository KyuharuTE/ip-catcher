-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2023-06-09 23:29:53
-- 服务器版本： 5.5.62-log
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ip_yaou_pro`
--

-- --------------------------------------------------------

--
-- 表的结构 `ip`
--

CREATE TABLE IF NOT EXISTS `ip` (
  `zid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT '无',
  `user` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `ip`
--

INSERT INTO `ip` (`zid`, `id`, `value`, `user`) VALUES
(1, 1, '127.0.0.1', 'azusa@qq.com'),
(2, 2, '无', 'azusa@qq.com'),
(3, 3, '无', 'azusa@qq.com'),
(4, 4, '无', 'azusa@qq.com'),
(5, 5, '无', 'azusa@qq.com'),
(6, 6, '无', 'azusa@qq.com'),
(7, 7, '无', 'azusa@qq.com'),
(8, 8, '无', 'azusa@qq.com'),
(9, 9, '无', 'azusa@qq.com'),
(10, 10, '无', 'azusa@qq.com'),
(11, 11, '无', 'azusa@qq.com'),
(12, 12, '无', 'azusa@qq.com'),
(13, 13, '无', 'azusa@qq.com'),
(14, 14, '无', 'azusa@qq.com'),
(15, 15, '无', 'azusa@qq.com'),
(16, 16, '无', 'azusa@qq.com'),
(17, 17, '无', 'azusa@qq.com'),
(18, 18, '无', 'azusa@qq.com'),
(19, 19, '无', 'azusa@qq.com'),
(20, 20, '无', 'azusa@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`) VALUES
(1, 'Azusa', 'azusate@vip.qq.com', ''),
(2, 'Azusate', 'azusate@qq.com', ''),
(3, 'Azusa', 'azusa@qq.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`zid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ip`
--
ALTER TABLE `ip`
  MODIFY `zid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
