-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-02-04 04:59:06
-- 伺服器版本: 10.1.21-MariaDB
-- PHP 版本： 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `fishtalk`
--
CREATE DATABASE IF NOT EXISTS `fishtalk` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fishtalk`;

-- --------------------------------------------------------

--
-- 資料表結構 `boat`
--

CREATE TABLE `boat` (
  `number` int(11) NOT NULL,
  `account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spicies` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirement` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `boat`
--

INSERT INTO `boat` (`number`, `account`, `type`, `spicies`, `location`, `requirement`) VALUES
(1, 'aaa', '拖網漁船', '白鯧', '小琉球沿岸', '如何降低拖網漁船對生態造成的破壞。'),
(2, 'aaa', '延繩釣漁船', '鮪魚、旗魚', '太平洋', '如何識別鮪魚之種類'),
(3, 'aaa', '刺網漁船', '土魠魚', '非洲沿岸', '資源永續運作'),
(4, 'aaa', '圍網漁船', '鯊魚', '大西洋', '保護資源'),
(5, 'fishman', '獨木舟', '蝌蚪', '秀姑巒溪', '旅行青蛙'),
(6, 'fishman', '遊艇', '櫻花鉤吻鮭', '七家灣溪下游', '保育鮭魚'),
(7, 'aaa', 'aa', 'bb', 'aaa', 'dd'),
(10, 'aaa', 'aaa', 'bbb', 'aaa', 'ddd'),
(12, 'aaa', 'a', 'bbb', 'ccc', 'd'),
(13, 'aaa', 'p', 'p', 'p', 'p');

-- --------------------------------------------------------

--
-- 資料表結構 `content`
--

CREATE TABLE `content` (
  `number` int(255) NOT NULL,
  `account_A` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_B` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `content`
--

INSERT INTO `content` (`number`, `account_A`, `account_B`, `message`, `timestamp`) VALUES
(61, 'Pescanova USA', 'Pat Livingston', 'Hello~ Pat!', '2018-02-03 18:01:36'),
(62, 'Pescanova USA', 'Shubha Pandit', 'Hi~ Shubha. I am Pescanova!', '2018-02-03 18:19:18'),
(63, 'Shubha Pandit', 'Pescanova USA', 'Hey, are u FIP partner?', '2018-02-03 18:20:38'),
(64, 'Pescanova USA', 'Shubha Pandit', 'Yes, would you give us some advice?', '2018-02-03 18:23:58'),
(65, 'Shubha Pandit', 'Pescanova USA', 'OK, u can see Fishery Improvement Tools first to support u progress towards MSC certification~', '2018-02-03 18:27:05'),
(66, 'Pescanova USA', 'Shubha Pandit', 'OK! I will', '2018-02-03 18:29:34'),
(67, '123', '', '', '2018-02-04 00:50:13'),
(68, 'Shubha Pandit', 'Hui-shan Ma', 'Have you ever heard mahi-mahi!!!!???', '2018-02-04 03:06:01');

-- --------------------------------------------------------

--
-- 資料表結構 `evaluation`
--

CREATE TABLE `evaluation` (
  `number` int(255) NOT NULL,
  `account_A` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_B` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `matching`
--

CREATE TABLE `matching` (
  `number` int(255) NOT NULL,
  `account_A` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_B` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `accept` int(50) NOT NULL DEFAULT '0',
  `timestamp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- 資料表的匯出資料 `matching`
--

INSERT INTO `matching` (`number`, `account_A`, `account_B`, `accept`, `timestamp`) VALUES
(14, 'Shubha Pandit', 'Pescanova USA', 1, ''),
(19, 'Pescanova USA', 'Pat Livingston', 0, ''),
(26, 'Shubha Pandit', 'Hui-shan Ma', 1, '');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `zone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `member`
--

INSERT INTO `member` (`account`, `password`, `salt`, `username`, `email`, `level`, `zone`, `introduction`, `identity`) VALUES
('123123', '321321', '123', '123', '123', '0', '231', '123', ''),
('654654654', 'PZ2o1C4XZdjsE8qa67NdJQuwUL05M2ZkYmUwYzVk', '93fdbe0c5d', '456456465', '654654564@DADAD.ADSD', '0', '-11', '			5465465		', '2'),
('aaa', 'vE3hztb70ltZw1i9MVoJtmHCe/E5Y2FjZWE2OWE1', '9cacea69a5', 'aaa', 'st890751999@gmail.com', '1', '-11', 'aaa', '3'),
('AIT', 'rrVK9td38okLeGnvMcVg/n8zRMEwZmJlMjNjYTVl', '0fbe23ca5e', '美國在臺協會', 'ait@gmail.com', '100', '+8', '美國的在台協會', '1'),
('Bob', 'VmAgZ7X9hy/nmq33zfxfKp2qlflhMDJiODU3ZjJl', 'a02b857f2e', 'Bob', 'Bob@student.nsysu.edu.tw', '1', '(GMT+08:00) Taipei', 'Hello, my baby~', '2'),
('Costco Wholesale', '5cyFD5nv3tLskGUA2IBFWLxIrGA5NDExZmZkMjc5', '9411ffd279', 'Costco Wholesale', 'Costco_Wholesale@gmail.com', '0', '11', 'Obey the law', '3'),
('David Fornander', 'FpCRj02nh7yEu5RR5eduVABzxiExNzM2MTE5Y2E0', '1736119ca4', 'David Fornander', 'David_Fornander@gmail.com', '10', '11', 'Initial engagement with EcoWB', '2'),
('eee', 'rrVK9td38okLeGnvMcVg/n8zRMEwZmJlMjNjYTVl', '0fbe23ca5e', 'eee', 'st890751999@gmail.com', '0', '-11', 'afa', '2'),
('fishman', '0fNKbUQ9XIa08HpfijTMVVZTOwszNjYzOTkyYTBm', '3663992a0f', '捕魚大隊', 'krisonepiece@gmail.com', '50', '8', '釣大魚囉', '3'),
('Hilton Worldwide', 'kNUUpVjOrZLXgA1GRGRqawIRtZAxYjYxYzY1MDZl', '1b61c6506e', 'Hilton Worldwide', 'Hilton_Worldwide@gmail.com', '0', '8', 'We Are HOSPITALITY', '3'),
('Hui-shan Ma', '0LBs32x8TpY6VEJevuHSl4w6wBA5MWFkZDVmMWQw', '91add5f1d0', 'Hui-shan Ma', 'sandrama7@ofdc.org.tw', '1', '8', 'Mahi-mahi	', '3'),
('Hyatt Corporation', '7iPrkU8Vi7AvghNg+zMGqYG8Qy5hMzQzZGEwNWRk', 'a343da05dd', 'Hyatt Corporation', 'Hyatt_Corporation@gmail.com', '0', '8', 'We are committed to working with suppliers and other partners\r\nto drive responsibility in our global supply chain		', '3'),
('Pat Livingston', 'p2/PJCn3JG7CFJ4YIdFdlez++koyMTMyYjliNDRi', '2132b9b44b', 'Pat Livingston', 'Pat_Livingston@gmail.com', '0', '5', 'Marine Fishery Scientist', '2'),
('Pescanova USA', '9MnjkHhPWVLoOMw+lgzCJl6VCFZhMjkwOThlOWQ4', 'a29098e9d8', 'Pescanova USA', 'Pescanova_USA@gmail.com', '1', '-11', 'Pescanova believes in maintaining seafood', '3'),
('Shubha Pandit', 'pZld3G5/Hl+O+tbGe2rbyGydmPFjOTNhMTNmMmRh', 'c93a13f2da', 'Shubha Pandit', 'Shubha_Pandit@gmail.com', '1', '-5', 'A Research Scientist ', '2');

-- --------------------------------------------------------

--
-- 資料表結構 `researcher`
--

CREATE TABLE `researcher` (
  `number` int(11) NOT NULL,
  `account` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `study` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practice` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `researcher`
--

INSERT INTO `researcher` (`number`, `account`, `department`, `skill`, `study`, `practice`, `contact`) VALUES
(1, 'eee', 'AIT', 'bfa', 'cfa', 'dfa', 'efa'),
(6, 'Hyatt Corporatio', '', '', '', '', ''),
(10, 'David Fornander', '', '', '', '', ''),
(11, 'Shubha Pandit', '', '', '', '', ''),
(12, 'Pat Livingston', '', '', '', '', ''),
(13, 'Bob', 'AIT', '海洋資源管理', '鮭魚迴游', '捕鮭魚', '10:00~12:00'),
(15, '654654654', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `study`
--

CREATE TABLE `study` (
  `account` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `study`
--

INSERT INTO `study` (`account`, `number`, `timestamp`) VALUES
('aaa', 1, '2018-02-04 01:11:26'),
('aaa', 2, '2018-02-04 01:15:27');

-- --------------------------------------------------------

--
-- 資料表結構 `tool`
--

CREATE TABLE `tool` (
  `number` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `tool`
--

INSERT INTO `tool` (`number`, `name`, `note`, `url`) VALUES
(1, 'aaa', 'bbb', 'https://www.facebook.com/'),
(2, 'bbb', 'ccc', 'https://www.facebook.com/');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `boat`
--
ALTER TABLE `boat`
  ADD PRIMARY KEY (`number`);

--
-- 資料表索引 `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`number`);

--
-- 資料表索引 `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`number`);

--
-- 資料表索引 `matching`
--
ALTER TABLE `matching`
  ADD PRIMARY KEY (`number`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`account`);

--
-- 資料表索引 `researcher`
--
ALTER TABLE `researcher`
  ADD PRIMARY KEY (`number`);

--
-- 資料表索引 `study`
--
ALTER TABLE `study`
  ADD PRIMARY KEY (`account`,`number`);

--
-- 資料表索引 `tool`
--
ALTER TABLE `tool`
  ADD PRIMARY KEY (`number`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `boat`
--
ALTER TABLE `boat`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用資料表 AUTO_INCREMENT `content`
--
ALTER TABLE `content`
  MODIFY `number` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- 使用資料表 AUTO_INCREMENT `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `number` int(255) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `matching`
--
ALTER TABLE `matching`
  MODIFY `number` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- 使用資料表 AUTO_INCREMENT `researcher`
--
ALTER TABLE `researcher`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用資料表 AUTO_INCREMENT `tool`
--
ALTER TABLE `tool`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
