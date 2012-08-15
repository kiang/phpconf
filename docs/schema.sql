SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `name` varchar(20) NOT NULL COMMENT '帳號',
  `passwd` varchar(100) NOT NULL COMMENT '密碼',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理員' ;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `conferenceId` int(10) unsigned DEFAULT NULL COMMENT '會議編號',
  `title` varchar(200) NOT NULL COMMENT '標題',
  `content` text NOT NULL COMMENT '內容',
  `published` enum('y','n') NOT NULL DEFAULT 'n' COMMENT '是否發佈',
  `createDateTime` datetime NOT NULL COMMENT '建立日期',
  PRIMARY KEY (`id`),
  KEY `conferenceId` (`conferenceId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='公告'  ;

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE IF NOT EXISTS `conferences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `year` smallint(4) unsigned NOT NULL COMMENT '年度',
  `registrationUrl` varchar(250) DEFAULT NULL COMMENT '報名網址',
  `registrationStartDate` datetime DEFAULT NULL COMMENT '報名開始日期',
  `registrationEndDate` datetime DEFAULT NULL COMMENT '報名結束日期',
  `startDate` date NOT NULL COMMENT '舉辦日期',
  `endDate` date NOT NULL COMMENT '結束日期',
  `location` varchar(200) NOT NULL COMMENT '地點',
  `address` varchar(200) NOT NULL COMMENT '場地地址',
  `mapUrl` varchar(250) NOT NULL COMMENT '地圖連結',
  `traffic` text COMMENT '交通資訊',
  `description` text NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='會議' ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `name` varchar(20) NOT NULL COMMENT '名稱',
  `sortOrder` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '排列順序',
  `display` enum('y','n') NOT NULL DEFAULT 'y' COMMENT '是否顯示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='工作內容' ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `conferenceId` int(10) unsigned DEFAULT NULL COMMENT '會議編號',
  `subject` varchar(200) NOT NULL COMMENT '主題',
  `talkerId` int(10) unsigned DEFAULT NULL COMMENT '講者編號',
  `brief` text COMMENT '摘要',
  `type` enum('n','b','o') DEFAULT 'n' COMMENT '議程類型 (n: 一般議程 / b: 休息或午餐 / o: 其他) ',
  `startTime` time NOT NULL COMMENT '開始時間',
  `endTime` time NOT NULL COMMENT '結束時間',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='議程' ;

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `conferenceId` int(10) unsigned DEFAULT NULL COMMENT '會議編號',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `url` varchar(200) DEFAULT NULL COMMENT '贊助者連結',
  `logoUrl` varchar(200) DEFAULT NULL COMMENT '贊助者圖片',
  `supply` varchar(100) DEFAULT NULL COMMENT '提供',
  `sortOrder` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '排列順序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='贊助單位' ;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE IF NOT EXISTS `staffs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `conferenceId` int(10) unsigned NOT NULL COMMENT '會議編號',
  `jobId` int(10) unsigned DEFAULT NULL COMMENT '工作內容編號',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `url` varchar(200) DEFAULT NULL COMMENT '網址',
  `logoUrl` varchar(200) DEFAULT NULL COMMENT 'Logo 網址',
  `email` varchar(100) DEFAULT NULL COMMENT 'Email',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='工作人員' ;

-- --------------------------------------------------------

--
-- Table structure for table `talkers`
--

CREATE TABLE IF NOT EXISTS `talkers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自動編號',
  `conferenceId` int(10) unsigned NOT NULL COMMENT '會議編號',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `engName` varchar(200) DEFAULT NULL COMMENT '英文姓名',
  `nickname` varchar(20) DEFAULT NULL COMMENT '暱稱',
  `photo` varchar(200) DEFAULT NULL COMMENT '照片',
  `job` varchar(200) DEFAULT NULL COMMENT '工作或職稱',
  `skill` text COMMENT '專長',
  `brief` text COMMENT '自我簡介',
  `creation` text COMMENT '創作',
  `email` varchar(200) DEFAULT NULL COMMENT 'Email',
  `blog` varchar(200) DEFAULT NULL COMMENT '部落格',
  `twitter` varchar(200) DEFAULT NULL COMMENT 'Twitter 連結',
  `facebook` varchar(200) DEFAULT NULL COMMENT 'Facebook 連結',
  `plurk` varchar(200) DEFAULT NULL COMMENT 'Plurk 連結',
  `googleplus` varchar(200) DEFAULT NULL COMMENT 'Google Plus 連結',
  `aboutme` varchar(200) DEFAULT NULL COMMENT 'About.me 連結',
  `github` varchar(200) DEFAULT NULL COMMENT 'GitHub 連結',
  `slideshare` varchar(200) DEFAULT NULL COMMENT 'SlideShare 連結',
  PRIMARY KEY (`id`),
  KEY `conferenceId` (`conferenceId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='講師' ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
