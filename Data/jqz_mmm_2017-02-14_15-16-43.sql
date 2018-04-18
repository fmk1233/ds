-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: 192.168.1.200    Database: jqz_mmm
-- ------------------------------------------------------
-- Server version	5.5.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `nm_admin`
--

DROP TABLE IF EXISTS `nm_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `auth_id` int(10) NOT NULL,
  `is_all` tinyint(1) NOT NULL,
  `addtime` int(10) DEFAULT '0',
  `mobile` varchar(64) DEFAULT '' COMMENT '管理员电话',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_admin`
--

LOCK TABLES `nm_admin` WRITE;
/*!40000 ALTER TABLE `nm_admin` DISABLE KEYS */;
INSERT INTO `nm_admin` VALUES (1,'admin','39e5f23b219bd89e7715a6b1e8982c95','N6g2aWJR',1,1,1483598884,''),(4,'liu','3422183300559a3b29fe40d53451137a','cpDwrbIh',3,0,1483602946,'');
/*!40000 ALTER TABLE `nm_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_bonus`
--

DROP TABLE IF EXISTS `nm_bonus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_bonus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '用户id',
  `oid` int(10) NOT NULL COMMENT '订单id',
  `money` decimal(12,2) NOT NULL,
  `frezze_state` tinyint(1) NOT NULL COMMENT '是否冻结',
  `meno` varchar(255) NOT NULL COMMENT '说明',
  `money_type` tinyint(1) NOT NULL COMMENT '钱包类型',
  `addtime` int(10) NOT NULL COMMENT '时间',
  `type` tinyint(10) NOT NULL COMMENT '类型',
  `dai` tinyint(1) DEFAULT '0',
  `from_id` int(10) DEFAULT '0',
  `rate` decimal(4,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='货币支付收入明细表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_bonus`
--

LOCK TABLES `nm_bonus` WRITE;
/*!40000 ALTER TABLE `nm_bonus` DISABLE KEYS */;
INSERT INTO `nm_bonus` VALUES (1,85645690,0,1000.00,0,'后台给会员admin充值',0,1484649883,3,0,0,0.00),(2,85645690,0,-5.00,0,'自动解冻会员',0,1486450115,5,0,0,0.00),(3,85645690,0,-5.00,0,'自动解冻会员',0,1486450120,5,0,0,0.00),(4,85645690,0,-5.00,0,'自动解冻会员',0,1486450124,5,0,0,0.00),(5,85645690,0,-5.00,0,'自动解冻会员',0,1486450610,5,0,0,0.00),(6,85645690,0,-5.00,0,'自动解冻会员',0,1486450623,5,0,0,0.00),(7,85645690,0,-5.00,0,'自动解冻会员',0,1486610608,5,0,0,0.00),(8,85645690,0,-5.00,0,'自动解冻会员',0,1486610611,5,0,0,0.00),(9,85645690,0,-5.00,0,'自动解冻会员',0,1486610616,5,0,0,0.00),(10,85645690,0,-5.00,0,'自动解冻会员',0,1486610622,5,0,0,0.00),(11,85645690,0,-5.00,0,'自动解冻会员',0,1486610625,5,0,0,0.00),(12,85645690,0,-5.00,0,'自动解冻会员',0,1486610627,5,0,0,0.00),(13,85645690,0,-5.00,0,'自动解冻会员',0,1486610729,5,0,0,0.00),(14,85645690,0,-5.00,0,'自动解冻会员',0,1486610780,5,0,0,0.00);
/*!40000 ALTER TABLE `nm_bonus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_fee`
--

DROP TABLE IF EXISTS `nm_fee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_fee` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '奖金参数',
  `setting` text NOT NULL COMMENT '奖金参数数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='奖金参数表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_fee`
--

LOCK TABLES `nm_fee` WRITE;
/*!40000 ALTER TABLE `nm_fee` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_icon`
--

DROP TABLE IF EXISTS `nm_icon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_icon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `url` varchar(64) DEFAULT '',
  `icon` varchar(255) DEFAULT '' COMMENT '图标地址',
  `sort` tinyint(2) DEFAULT '127' COMMENT '255',
  `addtime` int(10) DEFAULT '0',
  `is_rec` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='首页推荐展位表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_icon`
--

LOCK TABLES `nm_icon` WRITE;
/*!40000 ALTER TABLE `nm_icon` DISABLE KEYS */;
INSERT INTO `nm_icon` VALUES (2,'指遍全球','','/upload/icon/201701/210ae489f8800b113cb63b485402bea2.PNG',127,1483426120,1),(3,'鲜花蛋糕','','/upload/icon/201701/1674e06c7dc028f4be3d445617904165.PNG',127,1483426537,1),(4,'果蔬生鲜','','/upload/icon/201701/89569dd1773016b1053b04e3bc3f5526.PNG',127,1483426575,1),(5,'美食外卖','','/upload/icon/201701/f19df7a66db70fd8a17d477f86b8baf9.PNG',127,1483426614,1),(6,'社区良品','','/upload/icon/201701/35a6233eb2315819a5d5a19238bcca57.PNG',127,1483426631,1),(7,'虚拟世界','','/upload/icon/201701/242fcc1340d6dadd25b1d0794cc8181e.PNG',127,1483426645,1),(8,'人工智能','','/upload/icon/201701/4eb374689eb47c426c1ed1543de0ca08.PNG',127,1483426664,1),(9,'YH矿场','http://192.168.1.116/201612/hbhz_mmm/public/hjkg/','/upload/icon/201701/7baa3f3edbd37fc8dba7ff48f8108faa.PNG',127,1483426677,1);
/*!40000 ALTER TABLE `nm_icon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_lock`
--

DROP TABLE IF EXISTS `nm_lock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_lock` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `state` tinyint(1) NOT NULL,
  `rdt` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='锁表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_lock`
--

LOCK TABLES `nm_lock` WRITE;
/*!40000 ALTER TABLE `nm_lock` DISABLE KEYS */;
INSERT INTO `nm_lock` VALUES (1,0,1486975060),(2,0,1486975060);
/*!40000 ALTER TABLE `nm_lock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_logcom`
--

DROP TABLE IF EXISTS `nm_logcom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_logcom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) DEFAULT '' COMMENT '公司名称',
  `address` varchar(255) DEFAULT '' COMMENT '公司地址',
  `tel` varchar(255) DEFAULT '' COMMENT '联系电话',
  `contact` varchar(255) DEFAULT '' COMMENT '联系人',
  `url` varchar(255) DEFAULT '' COMMENT '公司网址',
  `addtime` int(10) DEFAULT '0' COMMENT '添加时间',
  `code` varchar(64) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='快递公司表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_logcom`
--

LOCK TABLES `nm_logcom` WRITE;
/*!40000 ALTER TABLE `nm_logcom` DISABLE KEYS */;
INSERT INTO `nm_logcom` VALUES (2,'申通','广东省深圳市罗湖区98号','13512345678','李红','www.baidu.com',1483109215,'shentong',0);
/*!40000 ALTER TABLE `nm_logcom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_msg`
--

DROP TABLE IF EXISTS `nm_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_msg` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` tinyint(1) NOT NULL,
  `uid` int(10) NOT NULL,
  `reply` text NOT NULL,
  `is_reply` tinyint(4) NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_msg`
--

LOCK TABLES `nm_msg` WRITE;
/*!40000 ALTER TABLE `nm_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_news`
--

DROP TABLE IF EXISTS `nm_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `is_top` tinyint(1) NOT NULL,
  `category` tinyint(1) NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='新闻公告表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_news`
--

LOCK TABLES `nm_news` WRITE;
/*!40000 ALTER TABLE `nm_news` DISABLE KEYS */;
INSERT INTO `nm_news` VALUES (1,'大家好','\n                                        \n                                        \n                                        \n                                        \n                                        \n                                        \n                                        <img src=\"http://192.168.1.116/201611/sxk/public/..//Public/static/upload/image/37af00f35be1fdc8346965320a14337d.jpg\" style=\"width: 284.75px;\"><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAF0AAAAZCAYAAABTuCK5AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE2QjUyM0RFNkRENzExRTZBQ0JCQkI0NkQyMDUzQjYwIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE2QjUyM0RGNkRENzExRTZBQ0JCQkI0NkQyMDUzQjYwIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTZCNTIzREM2REQ3MTFFNkFDQkJCQjQ2RDIwNTNCNjAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTZCNTIzREQ2REQ3MTFFNkFDQkJCQjQ2RDIwNTNCNjAiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6RhgeqAAAE8ElEQVR42txZzWsTQRSfxLYqLUKKCHppiR+oBS8pCh6Kh+QfUNaLIMXDFgRPHppDPdlD1ruH7KHejQgepQFRxIM2N78QG+pBCyJExM/4Ud/bvmlfpjO7s9mNVh88djNfu/ntb37z3kxmZWVF6Gx0dFSE2DR4AXwKvCV6YEtLS+J/tb6Y7fPg1wlwNB+83quXgw/v0DMb8BHq/wvomRhMd8Er4DlWthe8mfI75WkmOcqzpgB4P6zjk4mJQbjMgh8D7wf/lfBdthMxv4C3ES9W9onGxzIEcSv4AF2x/D2rz9D9Y/AZW6ZPE+Dc/JQBz9EzXEN9FYhQB+DDnlkFP7OJSY5kOJS1aFjRAI46Xk7xZVCuFglwOXbN8PHD7MQ/oC5HshFALBj+aI5YlU/I7CKNMU+/PZIsjxbpuPY5qsHw5KQYu3dP7JmdXSsbKpWCslHfj7fmQHvsh/1j2Ie+kAWsqmiqag6B5pHUxI1ipskbNEad7mX00oL3qNFzpDUixvz5N6g7cumSEOiKvbp8WXycn1eLV/o0gOv0W2p4gUUuqg5L8G3NZTOqZgC0ERP0UENWrr34xIQYunlTtN+9E4MHDwZleJVtWnB9MzNjNa4BXKNlFcCrIYDjdB83aHmeZsYisTcX8VzHos0GkIH9iUCH6EYsz82tgfri5Emx5LoBaLJM3v+ROB0AN0UOvqKvHkUtOvnJs4W3zryhaWdjTbGJ7ADMjP6dO63kBT9wKOik4dMhgFdIBloEIIJRokTJBGCRvKwBvWiZlTZ5vgD3hW7ZjovdCANGJy9fX760njFxP4yO6ZUIhjsMXIcxfpwY7xjGrxl0Pq/5LSOZnGF2CEtJsjKu2RiFIPC7z50LynttWWSPBgRPIylCE6ujnyYvM8dZMEzlLQvQXQob5ZpSTPuP4kLHNZ3PAAQcwcb6D3fvdoSXccPIKJZLpqvsCdJtZRugofkonsLotKwRMwpKHO59B4mRrA+iEChD+RHgOuaPRcyGqNnShxtJAHCZGKbb35DJi5SchpIclZOGcpqP2ZOdSykjQYYCjEaWI+AYxdhottqua3mhBcsDzxg2lHh45zIJcEkG0tBZn+So3CvAA6AfPOiIq5HlH58+7cgueYbKs1a8l9mnWh/VNzRO7yJs81NieVMHNszAXJqg7zh+fF1CwJDlQ4cPd3wQ1HGs53VoA7t2rfWV/WV9++3bjr68rlvQaxSllJTEqJmAmb5lVOKkCfoALHIIps7ar18H12379q3+hnZ8UURZ4n35vQw1Zd9Pz5+HLqiZmCdHRabvUwkWPD6OMIyXow03HumUwg4zQItfwGX/Jt9lXM4m6JzkJEcnSVVKtoqUqC1oQstCxLiDYvPbjmwXDE0jRW8ZZolDM6BiyHSjPvTtfwD0R3HOSAtsbyaNA4wpYrxrweBgHbDYAjiPaxj4UbF6vGaSmmWxug2ciVoGwLeAf2PtB2gtxDKpzXjtp7xnC/3+wuqx/Q/wZ+Bno0CXMXqeMTSJlusWVJ/Gdwh8NQxtEuCexXhfKQtGOwV+Q6lH4C6CXxXr55ehCSa1+SHW9+r7CcTvCugS8Cz9bouNZ6S/OnYZQ0DngJdSTITUkNFTNruSjnmN3WOocQv8CuY4McbQHYp8M7Rt2w4aBXqdSUk3p0N/w/A0/gL4Q/A7qKHg94XFUd6fst8CDADwqt5LwbwhTQAAAABJRU5ErkJggg==\" style=\"width: 93px;\">                                                                        ',1,2,1480655427),(2,'大家的算法','\n                                        <img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAF0AAAAZCAYAAABTuCK5AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE2QjUyM0RFNkRENzExRTZBQ0JCQkI0NkQyMDUzQjYwIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE2QjUyM0RGNkRENzExRTZBQ0JCQkI0NkQyMDUzQjYwIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTZCNTIzREM2REQ3MTFFNkFDQkJCQjQ2RDIwNTNCNjAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTZCNTIzREQ2REQ3MTFFNkFDQkJCQjQ2RDIwNTNCNjAiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6RhgeqAAAE8ElEQVR42txZzWsTQRSfxLYqLUKKCHppiR+oBS8pCh6Kh+QfUNaLIMXDFgRPHppDPdlD1ruH7KHejQgepQFRxIM2N78QG+pBCyJExM/4Ud/bvmlfpjO7s9mNVh88djNfu/ntb37z3kxmZWVF6Gx0dFSE2DR4AXwKvCV6YEtLS+J/tb6Y7fPg1wlwNB+83quXgw/v0DMb8BHq/wvomRhMd8Er4DlWthe8mfI75WkmOcqzpgB4P6zjk4mJQbjMgh8D7wf/lfBdthMxv4C3ES9W9onGxzIEcSv4AF2x/D2rz9D9Y/AZW6ZPE+Dc/JQBz9EzXEN9FYhQB+DDnlkFP7OJSY5kOJS1aFjRAI46Xk7xZVCuFglwOXbN8PHD7MQ/oC5HshFALBj+aI5YlU/I7CKNMU+/PZIsjxbpuPY5qsHw5KQYu3dP7JmdXSsbKpWCslHfj7fmQHvsh/1j2Ie+kAWsqmiqag6B5pHUxI1ipskbNEad7mX00oL3qNFzpDUixvz5N6g7cumSEOiKvbp8WXycn1eLV/o0gOv0W2p4gUUuqg5L8G3NZTOqZgC0ERP0UENWrr34xIQYunlTtN+9E4MHDwZleJVtWnB9MzNjNa4BXKNlFcCrIYDjdB83aHmeZsYisTcX8VzHos0GkIH9iUCH6EYsz82tgfri5Emx5LoBaLJM3v+ROB0AN0UOvqKvHkUtOvnJs4W3zryhaWdjTbGJ7ADMjP6dO63kBT9wKOik4dMhgFdIBloEIIJRokTJBGCRvKwBvWiZlTZ5vgD3hW7ZjovdCANGJy9fX760njFxP4yO6ZUIhjsMXIcxfpwY7xjGrxl0Pq/5LSOZnGF2CEtJsjKu2RiFIPC7z50LynttWWSPBgRPIylCE6ujnyYvM8dZMEzlLQvQXQob5ZpSTPuP4kLHNZ3PAAQcwcb6D3fvdoSXccPIKJZLpqvsCdJtZRugofkonsLotKwRMwpKHO59B4mRrA+iEChD+RHgOuaPRcyGqNnShxtJAHCZGKbb35DJi5SchpIclZOGcpqP2ZOdSykjQYYCjEaWI+AYxdhottqua3mhBcsDzxg2lHh45zIJcEkG0tBZn+So3CvAA6AfPOiIq5HlH58+7cgueYbKs1a8l9mnWh/VNzRO7yJs81NieVMHNszAXJqg7zh+fF1CwJDlQ4cPd3wQ1HGs53VoA7t2rfWV/WV9++3bjr68rlvQaxSllJTEqJmAmb5lVOKkCfoALHIIps7ar18H12379q3+hnZ8UURZ4n35vQw1Zd9Pz5+HLqiZmCdHRabvUwkWPD6OMIyXow03HumUwg4zQItfwGX/Jt9lXM4m6JzkJEcnSVVKtoqUqC1oQstCxLiDYvPbjmwXDE0jRW8ZZolDM6BiyHSjPvTtfwD0R3HOSAtsbyaNA4wpYrxrweBgHbDYAjiPaxj4UbF6vGaSmmWxug2ciVoGwLeAf2PtB2gtxDKpzXjtp7xnC/3+wuqx/Q/wZ+Bno0CXMXqeMTSJlusWVJ/Gdwh8NQxtEuCexXhfKQtGOwV+Q6lH4C6CXxXr55ehCSa1+SHW9+r7CcTvCugS8Cz9bouNZ6S/OnYZQ0DngJdSTITUkNFTNruSjnmN3WOocQv8CuY4McbQHYp8M7Rt2w4aBXqdSUk3p0N/w/A0/gL4Q/A7qKHg94XFUd6fst8CDADwqt5LwbwhTQAAAABJRU5ErkJggg==\" style=\"width: 93px;\">而爱的发声                                    ',0,2,1480647563),(5,'444','<img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAF0AAAAZCAYAAABTuCK5AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE2QjUyM0RFNkRENzExRTZBQ0JCQkI0NkQyMDUzQjYwIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE2QjUyM0RGNkRENzExRTZBQ0JCQkI0NkQyMDUzQjYwIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTZCNTIzREM2REQ3MTFFNkFDQkJCQjQ2RDIwNTNCNjAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTZCNTIzREQ2REQ3MTFFNkFDQkJCQjQ2RDIwNTNCNjAiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6RhgeqAAAE8ElEQVR42txZzWsTQRSfxLYqLUKKCHppiR+oBS8pCh6Kh+QfUNaLIMXDFgRPHppDPdlD1ruH7KHejQgepQFRxIM2N78QG+pBCyJExM/4Ud/bvmlfpjO7s9mNVh88djNfu/ntb37z3kxmZWVF6Gx0dFSE2DR4AXwKvCV6YEtLS+J/tb6Y7fPg1wlwNB+83quXgw/v0DMb8BHq/wvomRhMd8Er4DlWthe8mfI75WkmOcqzpgB4P6zjk4mJQbjMgh8D7wf/lfBdthMxv4C3ES9W9onGxzIEcSv4AF2x/D2rz9D9Y/AZW6ZPE+Dc/JQBz9EzXEN9FYhQB+DDnlkFP7OJSY5kOJS1aFjRAI46Xk7xZVCuFglwOXbN8PHD7MQ/oC5HshFALBj+aI5YlU/I7CKNMU+/PZIsjxbpuPY5qsHw5KQYu3dP7JmdXSsbKpWCslHfj7fmQHvsh/1j2Ie+kAWsqmiqag6B5pHUxI1ipskbNEad7mX00oL3qNFzpDUixvz5N6g7cumSEOiKvbp8WXycn1eLV/o0gOv0W2p4gUUuqg5L8G3NZTOqZgC0ERP0UENWrr34xIQYunlTtN+9E4MHDwZleJVtWnB9MzNjNa4BXKNlFcCrIYDjdB83aHmeZsYisTcX8VzHos0GkIH9iUCH6EYsz82tgfri5Emx5LoBaLJM3v+ROB0AN0UOvqKvHkUtOvnJs4W3zryhaWdjTbGJ7ADMjP6dO63kBT9wKOik4dMhgFdIBloEIIJRokTJBGCRvKwBvWiZlTZ5vgD3hW7ZjovdCANGJy9fX760njFxP4yO6ZUIhjsMXIcxfpwY7xjGrxl0Pq/5LSOZnGF2CEtJsjKu2RiFIPC7z50LynttWWSPBgRPIylCE6ujnyYvM8dZMEzlLQvQXQob5ZpSTPuP4kLHNZ3PAAQcwcb6D3fvdoSXccPIKJZLpqvsCdJtZRugofkonsLotKwRMwpKHO59B4mRrA+iEChD+RHgOuaPRcyGqNnShxtJAHCZGKbb35DJi5SchpIclZOGcpqP2ZOdSykjQYYCjEaWI+AYxdhottqua3mhBcsDzxg2lHh45zIJcEkG0tBZn+So3CvAA6AfPOiIq5HlH58+7cgueYbKs1a8l9mnWh/VNzRO7yJs81NieVMHNszAXJqg7zh+fF1CwJDlQ4cPd3wQ1HGs53VoA7t2rfWV/WV9++3bjr68rlvQaxSllJTEqJmAmb5lVOKkCfoALHIIps7ar18H12379q3+hnZ8UURZ4n35vQw1Zd9Pz5+HLqiZmCdHRabvUwkWPD6OMIyXow03HumUwg4zQItfwGX/Jt9lXM4m6JzkJEcnSVVKtoqUqC1oQstCxLiDYvPbjmwXDE0jRW8ZZolDM6BiyHSjPvTtfwD0R3HOSAtsbyaNA4wpYrxrweBgHbDYAjiPaxj4UbF6vGaSmmWxug2ciVoGwLeAf2PtB2gtxDKpzXjtp7xnC/3+wuqx/Q/wZ+Bno0CXMXqeMTSJlusWVJ/Gdwh8NQxtEuCexXhfKQtGOwV+Q6lH4C6CXxXr55ehCSa1+SHW9+r7CcTvCugS8Cz9bouNZ6S/OnYZQ0DngJdSTITUkNFTNruSjnmN3WOocQv8CuY4McbQHYp8M7Rt2w4aBXqdSUk3p0N/w/A0/gL4Q/A7qKHg94XFUd6fst8CDADwqt5LwbwhTQAAAABJRU5ErkJggg==\" style=\"width: 93px;\"> ',0,2,1480647166);
/*!40000 ALTER TABLE `nm_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_orders`
--

DROP TABLE IF EXISTS `nm_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(64) NOT NULL COMMENT '订单id',
  `addtime` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `money` decimal(12,2) NOT NULL,
  `money_two` decimal(12,2) NOT NULL,
  `is_sh` tinyint(1) NOT NULL,
  `is_lock` tinyint(1) NOT NULL,
  `rdt` int(1) NOT NULL COMMENT '打款时间或者收款时间',
  `s_type` tinyint(1) NOT NULL COMMENT '0：进场订单 1：出场订单',
  `is_q` tinyint(1) NOT NULL COMMENT '是否可以抢单',
  `money_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '接受帮助的类型',
  `okdt` int(10) NOT NULL COMMENT '交易完成时间',
  `is_pay` tinyint(1) NOT NULL COMMENT '交易是否完成',
  `pay_types` varchar(64) NOT NULL,
  `meno` varchar(64) NOT NULL,
  `market` tinyint(1) DEFAULT '0',
  `rate` decimal(4,2) DEFAULT '0.00' COMMENT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='提供帮助和接受帮助订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_orders`
--

LOCK TABLES `nm_orders` WRITE;
/*!40000 ALTER TABLE `nm_orders` DISABLE KEYS */;
INSERT INTO `nm_orders` VALUES (3,'KO20170114112213',1484364133,85645690,2000.00,2000.00,0,0,0,0,0,0,0,2,'a:3:{i:0;s:1:\"1\";i:1;s:1:\"3\";i:2;s:1:\"2\";}','yDBkWiX2',1,0.00),(4,'YU20170116115937',1484539177,85645690,1000.00,1000.00,0,0,0,0,0,0,0,2,'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}','F846Yzca',1,0.00),(5,'LC20170209192146',1486639306,85645690,1000.00,1000.00,0,0,0,0,0,0,0,0,'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}','8T93wzwO',1,0.00);
/*!40000 ALTER TABLE `nm_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_power`
--

DROP TABLE IF EXISTS `nm_power`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_power` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限管理表',
  `power` text,
  `name` varchar(255) DEFAULT '' COMMENT '部门名字',
  `addtime` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='权限管理表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_power`
--

LOCK TABLES `nm_power` WRITE;
/*!40000 ALTER TABLE `nm_power` DISABLE KEYS */;
INSERT INTO `nm_power` VALUES (1,'DUser.Users,DUser.Userreg,DUser.UserList,DUser.UserRegAC,DUser.Userinfo,DUser.ChangeUserInfo,DUser.LoginHome,DBonus.Recharge,DBonus.BonusList,DBonus.BonusListAC,DBonus.DoRecharge,DBonus.RechargeList,DNews.News,DNews.NewsAdd,DNews.NewsDelete,DNews.NewsInsert,DNews.NewsList,DMsg.CheckMsg,DMsg.UncheckMsg,DMsg.MsgList,DMsg.MsgDetail,DMsg.MsgReply,Setting.Setting,Setting.DoSetting,Setting.ClearData,DOrders.AutoMatch,DOrders.CashManager,DOrders.DeletePP,DOrders.MatchOrder,DOrders.OrderList,DOrders.PPOrderList,DOrders.UnfrezzeOrder,Admin.AdminInfo,Admin.AdminList,Admin.GetAdminList,Admin.ChangeAdminInfo,Admin.DelAdmin,Admin.PowerList,Admin.GetPowerList,Admin.AddPower,Admin.PowerAddAC,Admin.DelPower,DB.Dbbackup,DB.Backup,DB.Download,DB.Restore,DB.Del','总管',1483598884),(3,'DBonus.Recharge,DBonus.BonusList,DBonus.BonusListAC,DBonus.DoRecharge,DBonus.RechargeList','财务',1483602782);
/*!40000 ALTER TABLE `nm_power` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_pporders`
--

DROP TABLE IF EXISTS `nm_pporders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_pporders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(64) NOT NULL,
  `b_order_id` varchar(64) NOT NULL,
  `uid` int(10) NOT NULL COMMENT '进场人id',
  `b_uid` int(10) NOT NULL COMMENT '出场人id',
  `money` decimal(12,2) NOT NULL COMMENT '匹配金额',
  `is_pay` tinyint(1) NOT NULL COMMENT '交易是否完成',
  `is_buy` tinyint(1) NOT NULL COMMENT '是否打款',
  `addtime` int(10) NOT NULL COMMENT '匹配时间',
  `rdt` int(10) NOT NULL COMMENT '打款时间',
  `okdt` int(10) NOT NULL COMMENT '交易完成时间',
  `star` tinyint(1) NOT NULL COMMENT '是否获得诚信奖',
  `pz` varchar(255) NOT NULL COMMENT '上传的凭证',
  `meno` varchar(64) NOT NULL,
  `money_type` tinyint(1) NOT NULL,
  `is_hand` tinyint(1) NOT NULL,
  `is_q` tinyint(1) NOT NULL,
  `oid` int(10) NOT NULL,
  `b_oid` int(10) NOT NULL,
  `pdt` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `b_order_id` (`b_order_id`),
  KEY `uid` (`uid`),
  KEY `b_uid` (`b_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单匹配表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_pporders`
--

LOCK TABLES `nm_pporders` WRITE;
/*!40000 ALTER TABLE `nm_pporders` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_pporders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_pusers`
--

DROP TABLE IF EXISTS `nm_pusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_pusers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL COMMENT '父级id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `dept` int(2) NOT NULL COMMENT '深度',
  `state` tinyint(1) NOT NULL COMMENT '是否激活',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `uid` (`uid`),
  KEY `dept` (`dept`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COMMENT='会员推荐关系图谱';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_pusers`
--

LOCK TABLES `nm_pusers` WRITE;
/*!40000 ALTER TABLE `nm_pusers` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_pusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_recharge`
--

DROP TABLE IF EXISTS `nm_recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_recharge` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `money` int(10) NOT NULL,
  `money_type` tinyint(1) NOT NULL COMMENT '充值金额类型',
  `addtime` int(10) NOT NULL COMMENT '充值时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_recharge`
--

LOCK TABLES `nm_recharge` WRITE;
/*!40000 ALTER TABLE `nm_recharge` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_rel_users`
--

DROP TABLE IF EXISTS `nm_rel_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_rel_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT '0',
  `pos_num` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员接点posnum表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_rel_users`
--

LOCK TABLES `nm_rel_users` WRITE;
/*!40000 ALTER TABLE `nm_rel_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_rel_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_rusers`
--

DROP TABLE IF EXISTS `nm_rusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_rusers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `dept` tinyint(1) DEFAULT NULL,
  `pos` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `uid` (`uid`),
  KEY `dept` (`dept`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员接点关系图谱';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_rusers`
--

LOCK TABLES `nm_rusers` WRITE;
/*!40000 ALTER TABLE `nm_rusers` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_rusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_shop_good_category`
--

DROP TABLE IF EXISTS `nm_shop_good_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_shop_good_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '' COMMENT '分类标题',
  `pid` int(10) DEFAULT '0' COMMENT '分类父级id',
  `dept` tinyint(2) DEFAULT '0' COMMENT '分类的深度',
  `sort` tinyint(1) DEFAULT '0' COMMENT '分类排序',
  `orders` int(4) DEFAULT '0' COMMENT '排序规则',
  `pre_str` varchar(255) DEFAULT '' COMMENT '所有上级',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='商品分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_shop_good_category`
--

LOCK TABLES `nm_shop_good_category` WRITE;
/*!40000 ALTER TABLE `nm_shop_good_category` DISABLE KEYS */;
INSERT INTO `nm_shop_good_category` VALUES (1,'时尚女鞋',0,1,127,1,''),(9,'数码电器',0,1,127,9,'');
/*!40000 ALTER TABLE `nm_shop_good_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_shop_goods`
--

DROP TABLE IF EXISTS `nm_shop_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_shop_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT '0',
  `name` varchar(255) DEFAULT '' COMMENT '商品名称',
  `goods_pics` text COMMENT '商品图片',
  `addtime` int(10) DEFAULT '0' COMMENT '添加时间',
  `edittime` int(10) DEFAULT '0' COMMENT '修改时间',
  `sort` tinyint(2) DEFAULT '0' COMMENT '商品排序',
  `is_rec` tinyint(1) DEFAULT '0' COMMENT '是否首页推荐',
  `meno` text COMMENT '详细说明',
  `market_price` decimal(10,2) DEFAULT '0.00',
  `price` decimal(10,2) DEFAULT '0.00',
  `kucun` int(4) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1' COMMENT '1：上架，0：下架',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_shop_goods`
--

LOCK TABLES `nm_shop_goods` WRITE;
/*!40000 ALTER TABLE `nm_shop_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_shop_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_shop_order_goods`
--

DROP TABLE IF EXISTS `nm_shop_order_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_shop_order_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orderid` int(10) DEFAULT '0' COMMENT '订单ID',
  `goodsid` int(10) DEFAULT '0' COMMENT '商品ID',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '商品价格',
  `total` int(4) DEFAULT '1' COMMENT '商品数量',
  `goodsoption` text COMMENT '商品的属性',
  `addtime` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_shop_order_goods`
--

LOCK TABLES `nm_shop_order_goods` WRITE;
/*!40000 ALTER TABLE `nm_shop_order_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_shop_order_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_shop_orders`
--

DROP TABLE IF EXISTS `nm_shop_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_shop_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ordersn` varchar(255) DEFAULT '' COMMENT '订单编号',
  `uid` int(10) DEFAULT '0' COMMENT '用户ID',
  `order_amount` decimal(12,2) DEFAULT '0.00' COMMENT '订单金额',
  `addressid` int(10) DEFAULT '0' COMMENT '收货地址ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '订单状态 0 待付款，1：待发货，2：待收货，3，完成，4：取消订单，5：退货',
  `pay_type` tinyint(1) DEFAULT '0' COMMENT '支付方式',
  `addtime` int(10) DEFAULT '0' COMMENT '添加时间',
  `paytime` int(10) DEFAULT '0' COMMENT '支付时间',
  `comfirmtime` int(10) DEFAULT '0' COMMENT '收货时间',
  `deliverytime` int(10) DEFAULT '0' COMMENT '发货时间',
  `ordertype` tinyint(1) DEFAULT '0' COMMENT '订单类型',
  `delivery_name` varchar(255) DEFAULT '0' COMMENT '快递公司',
  `delivery_code` varchar(255) DEFAULT '' COMMENT '快递公司代码',
  `pay_amount` decimal(12,2) DEFAULT '0.00',
  `balance_amount` decimal(12,2) DEFAULT '0.00',
  `delivery_sn` varchar(255) DEFAULT '' COMMENT '快递单号',
  `canceltime` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商城订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_shop_orders`
--

LOCK TABLES `nm_shop_orders` WRITE;
/*!40000 ALTER TABLE `nm_shop_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_shop_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_transfer`
--

DROP TABLE IF EXISTS `nm_transfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_transfer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '转出人id',
  `tid` int(10) NOT NULL COMMENT '转入人id',
  `addtime` int(10) NOT NULL COMMENT '转出时间',
  `meno` varchar(255) NOT NULL COMMENT '说明',
  `money` decimal(12,2) NOT NULL COMMENT '转出金额',
  `money_type` decimal(12,2) NOT NULL COMMENT '账户类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_transfer`
--

LOCK TABLES `nm_transfer` WRITE;
/*!40000 ALTER TABLE `nm_transfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nm_users`
--

DROP TABLE IF EXISTS `nm_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(64) NOT NULL COMMENT '用户编号',
  `mobile` varchar(64) NOT NULL COMMENT '手机号',
  `regtime` int(10) NOT NULL COMMENT '注册时间',
  `logintime` int(10) NOT NULL COMMENT '登录时间',
  `regip` varchar(64) NOT NULL COMMENT '注册ip',
  `loginip` varchar(64) NOT NULL COMMENT '登录ip',
  `lastip` varchar(64) NOT NULL COMMENT '上次登录ip',
  `zfb` varchar(64) NOT NULL COMMENT '支付宝账号',
  `wx` varchar(64) NOT NULL COMMENT '微信账号',
  `bank_user` varchar(64) NOT NULL COMMENT '开户名',
  `bank_name` varchar(64) NOT NULL COMMENT '开户行',
  `bank_address` varchar(64) NOT NULL COMMENT '开户行地址',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '推荐人id',
  `b0` decimal(12,2) NOT NULL COMMENT '互助钱包金额',
  `b1` decimal(12,2) NOT NULL COMMENT '动态奖金钱包',
  `b2` decimal(12,2) NOT NULL COMMENT '排单币钱包',
  `state` tinyint(1) NOT NULL COMMENT '状态值 0:未激活，1：已激活，2：冻结',
  `star` int(4) NOT NULL DEFAULT '0' COMMENT '诚信星级',
  `k_cx` tinyint(1) NOT NULL COMMENT '连续扣除诚信星次数',
  `password` varchar(64) NOT NULL,
  `password2` varchar(64) NOT NULL,
  `salt` varchar(12) NOT NULL,
  `salt2` varchar(12) NOT NULL,
  `bank_account` varchar(64) NOT NULL,
  `b3` decimal(12,2) NOT NULL COMMENT '报单币',
  `in_amount` decimal(12,2) NOT NULL,
  `order_count` int(4) NOT NULL COMMENT '连续诚信打款次数',
  `pdt` int(10) NOT NULL COMMENT '激活时间',
  `rank` tinyint(1) DEFAULT '0',
  `rid` int(10) DEFAULT '0',
  `pos` tinyint(1) DEFAULT '0',
  `tjdept` int(4) DEFAULT '0',
  `is_fenh` tinyint(1) DEFAULT '0',
  `affect_num` int(4) DEFAULT '0' COMMENT '会员捐助金额满奖给上级的次数',
  `month` tinyint(1) DEFAULT '0',
  `is_modify` tinyint(1) DEFAULT '0',
  `code` varchar(64) DEFAULT '',
  `sdt` int(10) DEFAULT '0',
  `fenh_dt` int(10) DEFAULT '0',
  `market` tinyint(1) DEFAULT '0',
  `sjje` varchar(64) DEFAULT '' COMMENT '领导级别会员随机排单金额',
  `frezze_count` int(4) DEFAULT '0' COMMENT '冻结次数',
  `deleted` tinyint(1) DEFAULT '0' COMMENT '会员删除状态',
  `b4` decimal(12,2) DEFAULT '0.00' COMMENT '购物币，购物使用',
  `money` decimal(12,2) DEFAULT '0.00' COMMENT '当前交易金额',
  `daytime` int(10) DEFAULT '0',
  `b5` decimal(12,2) DEFAULT '0.00' COMMENT '本金',
  `user_logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`) USING BTREE,
  KEY `mobile` (`mobile`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=85645691 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_users`
--

LOCK TABLES `nm_users` WRITE;
/*!40000 ALTER TABLE `nm_users` DISABLE KEYS */;
INSERT INTO `nm_users` VALUES (85645690,'admin','15312345678',1484354294,0,'192.168.1.116','','','645646444','46456546','45654564','45654646','54654564',0,935.00,0.00,0.00,1,0,0,'218f48d01409dfc201368a4d6c510ce0','ab266cf8deefa6b6daedc8ad545af774','MNQ2LhZW','LphZVPuD','4564564',0.00,0.00,0,1486639290,0,0,0,1,0,0,0,1,'',0,1486639290,1,'',13,0,0.00,0.00,1484354294,0.00,'/upload/user/201701/71458bf6285879469443f82203114dcb.JPG');
/*!40000 ALTER TABLE `nm_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `User.add` AFTER INSERT ON `nm_users`

FOR EACH ROW begin

if(new.pid>0) then

insert into nm_pusers (pid,uid,dept) values(new.pid,new.id,1);

insert into nm_pusers (pid,uid,dept) select pid,new.id,dept+1 from nm_pusers where uid=new.pid;

end if;

if(new.rid>0) then

insert into nm_rusers (pid,uid,dept,pos) values(new.rid,new.id,1,new.pos);

insert into nm_rusers (pid,uid,dept,pos) select pid,new.id,dept+1,pos from nm_rusers where uid=new.rid;

insert into nm_rel_users (uid) values(new.id);

update nm_rel_users set pos_num=pos_num+1 where uid=new.rid;

end if;

end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `User.update` AFTER UPDATE ON `nm_users`

FOR EACH ROW begin 



if(old.state<>new.state) then

update nm_pusers set state=new.state where uid=new.id;

end if;



end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `User.delete` AFTER DELETE ON `nm_users` FOR EACH ROW begin 



delete from nm_pusers where uid=old.id;



delete from nm_rusers where uid=old.id;



delete from nm_rel_users where uid=old.id;



if(old.rid>0) then

update nm_rel_users set pos_num=pos_num-1 where uid=old.rid;

end if;

end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `nm_users_address`
--

DROP TABLE IF EXISTS `nm_users_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nm_users_address` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT '0',
  `realname` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `province` varchar(30) DEFAULT '',
  `city` varchar(30) DEFAULT '',
  `area` varchar(30) DEFAULT '',
  `address` varchar(300) DEFAULT '',
  `isdefault` tinyint(1) DEFAULT '0',
  `zipcode` varchar(255) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `country` varchar(255) DEFAULT '' COMMENT '国家',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户地址表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nm_users_address`
--

LOCK TABLES `nm_users_address` WRITE;
/*!40000 ALTER TABLE `nm_users_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `nm_users_address` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-14 15:16:44
