-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: 192.168.1.200    Database: ds
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
-- Table structure for table `ds_admin`
--

DROP TABLE IF EXISTS `ds_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `power_id` int(10) NOT NULL COMMENT '角色ID',
  `add_time` int(10) DEFAULT '0',
  `mobile` varchar(64) DEFAULT '' COMMENT '管理员电话',
  `sec_pwd` varchar(64) DEFAULT '' COMMENT '二级密码',
  `sec_salt` varchar(64) DEFAULT '' COMMENT '二级密码加密字符',
  `edit_time` int(10) DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_admin`
--

LOCK TABLES `ds_admin` WRITE;
/*!40000 ALTER TABLE `ds_admin` DISABLE KEYS */;
INSERT INTO `ds_admin` VALUES (1,'admin','3422183300559a3b29fe40d53451137a','cpDwrbIh',1,1483598884,'','d0336d7f3b67526db921e0de32aa999a','z7LLlcv1',1487240353),(6,'liu','b07fa652396a428679fc93739a85a38b','kBy7wLwo',3,1487241763,'','f6048f9906720d329205b690db1eee9d','ILDzSaFM',0);
/*!40000 ALTER TABLE `ds_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_apply_center`
--

DROP TABLE IF EXISTS `ds_apply_center`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_apply_center` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `old_rank` tinyint(1) DEFAULT '0' COMMENT '旧的报单中心等级',
  `new_rank` tinyint(1) DEFAULT '0' COMMENT '新的报单中心等级',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `check_time` int(11) DEFAULT '0' COMMENT '处理时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态：0：未审核，1：审核通过，2：拒绝',
  `bd_type` tinyint(1) DEFAULT '0' COMMENT '提交报单中心申请类型',
  `momo` varchar(255) DEFAULT '' COMMENT '备注',
  `user_id` int(11) DEFAULT '0' COMMENT '会员等级',
  `user_name` varchar(64) DEFAULT '' COMMENT '会员编号',
  `real_name` varchar(64) DEFAULT '' COMMENT '会员姓名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='报单中心申请记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_apply_center`
--

LOCK TABLES `ds_apply_center` WRITE;
/*!40000 ALTER TABLE `ds_apply_center` DISABLE KEYS */;
INSERT INTO `ds_apply_center` VALUES (1,0,1,1488762801,1488763270,1,NULL,'',28,'1','1');
/*!40000 ALTER TABLE `ds_apply_center` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_bonus`
--

DROP TABLE IF EXISTS `ds_bonus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_bonus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户id',
  `order_id` int(10) NOT NULL COMMENT '订单id',
  `money` decimal(12,2) NOT NULL,
  `frezze_state` tinyint(1) NOT NULL COMMENT '是否冻结',
  `memo` varchar(255) NOT NULL COMMENT '说明',
  `money_type` tinyint(1) NOT NULL COMMENT '钱包类型',
  `add_time` int(10) NOT NULL COMMENT '时间',
  `bonus_type` tinyint(10) NOT NULL COMMENT '收入支出的类型',
  `dai` tinyint(1) DEFAULT '0',
  `from_id` int(10) DEFAULT '0' COMMENT '来源的用户ID',
  `is_out` tinyint(1) DEFAULT '0' COMMENT '收入还是支出 0：收入，1：支出',
  `rate` decimal(4,2) DEFAULT '0.00' COMMENT '比例',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='货币支付收入明细表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_bonus`
--

LOCK TABLES `ds_bonus` WRITE;
/*!40000 ALTER TABLE `ds_bonus` DISABLE KEYS */;
INSERT INTO `ds_bonus` VALUES (1,28,0,76.50,0,'奖金来源2和会员3发生对碰，奖金基数：300.00，奖金比例0.3',0,1488502260,2,0,0,0,0.00),(2,28,0,9.00,0,'奖金来源2和会员3发生对碰，奖金基数：300.00，奖金比例0.3',4,1488502260,42,0,0,0,0.00),(18,29,0,76.95,0,'奖金来源4和会员5发生对碰，奖金基数：300.00，奖金比例0.3',0,1488503026,2,0,0,0,0.00),(19,29,0,8.55,0,'奖金来源4和会员5发生对碰，奖金基数：300.00，奖金比例0.3',4,1488503026,42,0,0,0,0.00),(20,28,0,3.84,0,'奖金来源2产生对碰奖触发对碰管理奖，奖金基数：90，奖金比例0.05',0,1488503026,2,0,0,0,0.00),(21,28,0,0.43,0,'奖金来源2产生对碰奖触发对碰管理奖，奖金基数：90，奖金比例0.05',4,1488503026,42,0,0,0,0.00),(22,28,0,100.00,0,'后台admin给会员1充值100充值单号：CZ201703040249218089',3,1488610161,33,0,0,0,0.00),(23,28,0,76.95,0,'奖金来源6和会员4发生对碰，奖金基数：300.00，奖金比例0.3',0,1488614474,2,0,0,0,0.00),(24,28,0,8.55,0,'奖金来源6和会员4发生对碰，奖金基数：300.00，奖金比例0.3',4,1488614474,42,0,0,0,0.00),(25,30,0,76.95,0,'奖金来源7和会员6发生对碰，奖金基数：300.00，奖金比例0.3',0,1488614479,2,0,0,0,0.00),(26,30,0,8.55,0,'奖金来源7和会员6发生对碰，奖金基数：300.00，奖金比例0.3',4,1488614479,42,0,0,0,0.00),(27,28,0,3.84,0,'奖金来源3产生对碰奖触发对碰管理奖，奖金基数：90，奖金比例0.05',0,1488614479,2,0,0,0,0.00),(28,28,0,0.43,0,'奖金来源3产生对碰奖触发对碰管理奖，奖金基数：90，奖金比例0.05',4,1488614479,42,0,0,0,0.00),(29,28,0,76.95,0,'奖金来源7和会员5发生对碰，奖金基数：300.00，奖金比例0.3',0,1488614479,2,0,0,0,0.00),(30,28,0,8.55,0,'奖金来源7和会员5发生对碰，奖金基数：300.00，奖金比例0.3',4,1488614479,42,0,0,0,0.00),(31,28,0,-100.00,0,'提交100的金额提现申请',0,1488761097,1,0,0,1,0.00),(32,31,0,76.95,0,'奖金来源9和会员8发生对碰，奖金基数：300.00，奖金比例0.3',0,1488770308,2,0,0,0,0.00),(33,31,0,8.55,0,'奖金来源9和会员8发生对碰，奖金基数：300.00，奖金比例0.3',4,1488770308,42,0,0,0,0.00),(34,29,0,3.84,0,'奖金来源4产生对碰奖触发对碰管理奖，奖金基数：90，奖金比例0.05',0,1488770308,2,0,0,0,0.00),(35,29,0,0.43,0,'奖金来源4产生对碰奖触发对碰管理奖，奖金基数：90，奖金比例0.05',4,1488770308,42,0,0,0,0.00),(36,28,0,7.69,0,'奖金来源4产生对碰奖触发对碰管理奖，奖金基数：90，奖金比例0.1',0,1488770308,2,0,0,0,0.00),(37,28,0,0.86,0,'奖金来源4产生对碰奖触发对碰管理奖，奖金基数：90，奖金比例0.1',4,1488770308,42,0,0,0,0.00);
/*!40000 ALTER TABLE `ds_bonus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_cart`
--

DROP TABLE IF EXISTS `ds_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '购物车ID',
  `user_id` int(11) DEFAULT '0' COMMENT '会员ID',
  `total` int(10) DEFAULT '0' COMMENT '购物数量',
  `goods_id` int(11) DEFAULT '0' COMMENT '商品ID',
  `option_id` varchar(64) DEFAULT '' COMMENT '商品规格ID',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_cart`
--

LOCK TABLES `ds_cart` WRITE;
/*!40000 ALTER TABLE `ds_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_cash`
--

DROP TABLE IF EXISTS `ds_cash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增编号',
  `cash_sn` varchar(64) DEFAULT NULL COMMENT '提现单号',
  `user_id` int(11) DEFAULT NULL COMMENT '会员编号',
  `user_name` varchar(50) DEFAULT NULL COMMENT '会员名称',
  `amount` decimal(10,2) DEFAULT '0.00' COMMENT '金额',
  `bank_name` varchar(40) DEFAULT NULL COMMENT '收款银行',
  `bank_no` varchar(30) DEFAULT NULL COMMENT '收款账号',
  `bank_user` varchar(10) DEFAULT NULL COMMENT '开户人姓名',
  `bank_address` varchar(255) DEFAULT '' COMMENT '银行地址',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `payment_time` int(11) DEFAULT NULL COMMENT '付款时间',
  `payment_state` tinyint(4) DEFAULT '0' COMMENT '提现支付状态 0默认1支付完成',
  `payment_admin` varchar(30) DEFAULT NULL COMMENT '支付管理员',
  `type` tinyint(1) DEFAULT '0' COMMENT '提现类型：0为预存款，1为佣金',
  `fee` float(12,0) DEFAULT '0' COMMENT '提现手续费',
  `mobile` varchar(25) DEFAULT '' COMMENT '手机号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cash_sn` (`cash_sn`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='提现记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_cash`
--

LOCK TABLES `ds_cash` WRITE;
/*!40000 ALTER TABLE `ds_cash` DISABLE KEYS */;
INSERT INTO `ds_cash` VALUES (1,'TX201703060844575950',28,'1',100.00,'中国银行','64646554565464','李红','广东省深圳市支行',1488761097,NULL,0,NULL,0,20,'');
/*!40000 ALTER TABLE `ds_cash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_contact_user`
--

DROP TABLE IF EXISTS `ds_contact_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_contact_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `dept` tinyint(1) DEFAULT NULL,
  `pos` tinyint(1) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '0' COMMENT '会员激活状态',
  `p_status` tinyint(1) DEFAULT '0' COMMENT '是否发生对碰',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pid_2` (`pid`,`user_id`,`pos`),
  KEY `pid` (`pid`) USING BTREE,
  KEY `uid` (`user_id`) USING BTREE,
  KEY `dept` (`dept`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COMMENT='会员接点关系图谱';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_contact_user`
--

LOCK TABLES `ds_contact_user` WRITE;
/*!40000 ALTER TABLE `ds_contact_user` DISABLE KEYS */;
INSERT INTO `ds_contact_user` VALUES (56,28,29,1,1,1,1),(57,28,30,1,2,1,1),(58,29,31,1,1,1,1),(59,28,31,2,1,1,1),(60,29,32,1,2,1,1),(61,28,32,2,1,1,1),(62,30,33,1,2,1,1),(63,28,33,2,2,1,1),(67,30,35,1,1,1,1),(68,28,35,2,2,1,1),(69,31,36,1,1,1,1),(70,29,36,2,1,1,0),(71,28,36,3,1,1,0),(73,31,37,1,2,1,1),(74,29,37,2,1,1,0),(75,28,37,3,1,1,0);
/*!40000 ALTER TABLE `ds_contact_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_icon`
--

DROP TABLE IF EXISTS `ds_icon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_icon` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `url` varchar(64) DEFAULT '',
  `icon` varchar(255) DEFAULT '' COMMENT '图标地址',
  `sort` tinyint(2) DEFAULT '127' COMMENT '255',
  `addtime` int(10) DEFAULT '0',
  `is_rec` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='首页推荐展位表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_icon`
--

LOCK TABLES `ds_icon` WRITE;
/*!40000 ALTER TABLE `ds_icon` DISABLE KEYS */;
INSERT INTO `ds_icon` VALUES (2,'指遍全球','','/upload/icon/201701/210ae489f8800b113cb63b485402bea2.PNG',127,1483426120,1),(3,'鲜花蛋糕','','/upload/icon/201701/1674e06c7dc028f4be3d445617904165.PNG',127,1483426537,1),(4,'果蔬生鲜','','/upload/icon/201701/89569dd1773016b1053b04e3bc3f5526.PNG',127,1483426575,1),(5,'美食外卖','','/upload/icon/201701/f19df7a66db70fd8a17d477f86b8baf9.PNG',127,1483426614,1),(6,'社区良品','','/upload/icon/201701/35a6233eb2315819a5d5a19238bcca57.PNG',127,1483426631,1),(7,'虚拟世界','','/upload/icon/201701/242fcc1340d6dadd25b1d0794cc8181e.PNG',127,1483426645,1),(8,'人工智能','','/upload/icon/201701/4eb374689eb47c426c1ed1543de0ca08.PNG',127,1483426664,1),(9,'YH矿场','http://192.168.1.116/201612/hbhz_mmm/public/hjkg/','/upload/icon/201701/7baa3f3edbd37fc8dba7ff48f8108faa.PNG',127,1483426677,0);
/*!40000 ALTER TABLE `ds_icon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_lock`
--

DROP TABLE IF EXISTS `ds_lock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_lock` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `state` tinyint(1) NOT NULL,
  `rdt` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='锁表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_lock`
--

LOCK TABLES `ds_lock` WRITE;
/*!40000 ALTER TABLE `ds_lock` DISABLE KEYS */;
INSERT INTO `ds_lock` VALUES (1,0,1488770308),(2,0,1487137907);
/*!40000 ALTER TABLE `ds_lock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_log`
--

DROP TABLE IF EXISTS `ds_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `log_type` tinyint(2) DEFAULT '1' COMMENT '日志产生类型：0，系统；1：管理员；2：用户',
  `operator_id` int(10) DEFAULT '0' COMMENT '操作人id',
  `operator_name` varchar(255) DEFAULT NULL COMMENT '操作人姓名',
  `memo` varchar(255) DEFAULT NULL COMMENT '备注',
  `add_time` int(11) DEFAULT '0' COMMENT '生成时间',
  `operator_ip` varchar(255) DEFAULT NULL COMMENT 'ip地址',
  `operator_url` varchar(255) DEFAULT NULL COMMENT '操作url地址',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE COMMENT '主键'
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='系统日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_log`
--

LOCK TABLES `ds_log` WRITE;
/*!40000 ALTER TABLE `ds_log` DISABLE KEYS */;
INSERT INTO `ds_log` VALUES (1,1,1,'admin','管理员admin清空数据',1488502191,'192.168.1.116','Setting.ClearData'),(2,1,1,'admin','管理员admin注册会员1->成功',1488502211,'192.168.1.116','DUser.userRegAC'),(3,1,1,'admin','管理员admin注册会员2->成功',1488502231,'192.168.1.116','DUser.userRegAC'),(4,1,1,'admin','管理员admin注册会员3->成功',1488502249,'192.168.1.116','DUser.userRegAC'),(5,1,1,'admin','管理员admin激活会员3->成功',1488502255,'192.168.1.116','DUser.activateMember'),(6,1,1,'admin','管理员admin激活会员2->成功',1488502260,'192.168.1.116','DUser.activateMember'),(7,1,1,'admin','管理员admin注册会员4->成功',1488502276,'192.168.1.116','DUser.userRegAC'),(8,1,1,'admin','管理员admin注册会员5->成功',1488502294,'192.168.1.116','DUser.userRegAC'),(9,1,1,'admin','管理员admin激活会员5->成功',1488502301,'192.168.1.116','DUser.activateMember'),(10,1,1,'admin','管理员admin激活会员4->成功',1488503026,'192.168.1.116','DUser.activateMember'),(11,1,1,'admin','管理员admin提交会员升级申请->成功',1488519727,'192.168.1.116','DUser.EditRank'),(12,1,1,'admin','管理员admin同意会员1会员升级：原级别普卡->新级别金卡',1488519728,'192.168.1.116','DUser.EditRank'),(13,1,1,'admin','管理员admin提交会员升级申请->成功',1488519850,'192.168.1.116','DUser.EditRank'),(14,1,1,'admin','管理员admin同意会员1会员升级：原级别金卡->新级别普卡',1488519850,'192.168.1.116','DUser.EditRank'),(15,1,1,'admin','管理员admin修改系统参数',1488520278,'192.168.1.116','Setting.DoSysSetting'),(16,1,1,'admin','管理员admin修改系统参数',1488520305,'192.168.1.116','Setting.DoSysSetting'),(17,1,1,'admin','管理员admin修改系统参数',1488520317,'192.168.1.116','Setting.DoSysSetting'),(18,1,1,'admin','管理员admin修改系统参数',1488521044,'192.168.1.116','Setting.DoSysSetting'),(19,1,1,'admin','管理员admin修改系统参数',1488524853,'192.168.1.116','Setting.DoSysSetting'),(20,1,1,'admin','管理员admin修改系统参数',1488525015,'192.168.1.116','Setting.DoSysSetting'),(21,1,1,'admin','管理员admin修改系统参数',1488525951,'192.168.1.116','Setting.DoSysSetting'),(22,1,1,'admin','管理员admin提交会员升级申请->成功',1488533423,'192.168.1.116','DUser.EditRank'),(23,1,1,'admin','管理员admin同意会员1会员升级：原级别普卡->新级别金卡',1488533423,'192.168.1.116','DUser.EditRank'),(24,1,1,'admin','管理员admin提交会员升级申请->成功',1488533603,'192.168.1.116','DUser.EditRank'),(25,1,1,'admin','管理员admin同意会员1会员升级：原级别金卡->新级别普卡',1488533603,'192.168.1.116','DUser.EditRank'),(26,1,1,'admin','管理员admin提交会员升级申请->成功',1488533666,'192.168.1.116','DUser.EditRank'),(27,1,1,'admin','管理员admin同意会员1会员升级：原级别普卡->新级别金卡',1488533666,'192.168.1.116','DUser.EditRank'),(28,1,1,'admin','管理员admin提交会员升级申请->成功',1488533713,'192.168.1.116','DUser.EditRank'),(29,1,1,'admin','管理员admin同意会员1会员升级：原级别金卡->新级别普卡',1488533713,'192.168.1.116','DUser.EditRank'),(30,1,1,'admin','管理员admin注册会员6->成功',1488548411,'192.168.1.116','DUser.userRegAC'),(31,1,1,'admin','管理员admin注册会员7->成功',1488548577,'192.168.1.116','DUser.userRegAC'),(32,1,1,'admin','管理员admin删除会员7->成功',1488608419,'192.168.1.116','DUser.DelMember'),(33,1,1,'admin','管理员admin删除会员7->失败',1488608508,'192.168.1.116','DUser.DelMember'),(34,1,1,'admin','管理员admin删除会员7->失败',1488608585,'192.168.1.116','DUser.DelMember'),(35,1,1,'admin','管理员admin删除会员7->失败',1488608702,'192.168.1.116','DUser.DelMember'),(36,1,1,'admin','管理员admin删除会员7->失败',1488608751,'192.168.1.116','DUser.DelMember'),(37,1,1,'admin','管理员admin删除会员7->失败',1488608822,'192.168.1.116','DUser.DelMember'),(38,1,1,'admin','管理员admin删除会员7->失败',1488608952,'192.168.1.116','DUser.DelMember'),(39,1,1,'admin','管理员admin删除会员7->失败',1488609041,'192.168.1.116','DUser.DelMember'),(40,1,1,'admin','管理员admin删除会员7->成功',1488609080,'192.168.1.116','DUser.DelMember'),(41,1,1,'admin','管理员admin给会员1充值100充值单号：CZ201703040249218089',1488610161,'192.168.1.116','DBonus.DoRecharge'),(42,1,1,'admin','管理员admin提交会员升级申请->成功',1488611214,'192.168.1.116','DUser.EditRank'),(43,1,1,'admin','管理员admin同意会员1会员升级：原级别普卡->新级别金卡',1488611214,'192.168.1.116','DUser.EditRank'),(44,1,1,'admin','管理员admin注册会员7->成功',1488614467,'192.168.1.116','DUser.userRegAC'),(45,1,1,'admin','管理员admin激活会员6->成功',1488614475,'192.168.1.116','DUser.activateMember'),(46,1,1,'admin','管理员admin激活会员7->成功',1488614480,'192.168.1.116','DUser.activateMember'),(47,8,28,'1','会员1提交100的金额提现申请->成功',1488761097,'192.168.1.116','Bonus.AddCash'),(48,8,28,'1','会员1提交申请报单中心申请->成功',1488762801,'192.168.1.116','User.ApplyCenter'),(49,1,1,'admin','管理员admin同意会员1申请报单中心：原级别普卡->新级别报单中心',1488763270,'192.168.1.116','DUser.DealApplyCenter'),(50,1,1,'admin','管理员admin注册会员8->成功',1488770252,'192.168.1.116','DUser.userRegAC'),(51,1,1,'admin','管理员admin注册会员9->成功',1488770296,'192.168.1.116','DUser.userRegAC'),(52,1,1,'admin','管理员admin激活会员8->成功',1488770303,'192.168.1.116','DUser.activateMember'),(53,1,1,'admin','管理员admin激活会员9->成功',1488770308,'192.168.1.116','DUser.activateMember'),(54,1,1,'admin','管理员admin修改会员使用权限',1488772488,'192.168.1.116','Admin.UserPowerAc'),(55,1,1,'admin','管理员admin修改会员使用权限',1488772546,'192.168.1.116','Admin.UserPowerAc');
/*!40000 ALTER TABLE `ds_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_logistics_com`
--

DROP TABLE IF EXISTS `ds_logistics_com`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_logistics_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) DEFAULT '' COMMENT '公司名称',
  `address` varchar(255) DEFAULT '' COMMENT '公司地址',
  `tel` varchar(255) DEFAULT '' COMMENT '联系电话',
  `contact` varchar(255) DEFAULT '' COMMENT '联系人',
  `url` varchar(255) DEFAULT '' COMMENT '公司网址',
  `add_time` int(10) DEFAULT '0' COMMENT '添加时间',
  `code` varchar(64) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='快递公司表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_logistics_com`
--

LOCK TABLES `ds_logistics_com` WRITE;
/*!40000 ALTER TABLE `ds_logistics_com` DISABLE KEYS */;
INSERT INTO `ds_logistics_com` VALUES (2,'申通','广东省深圳市罗湖区98号','13512345678','李红','www.baidu.com',1483109215,'shentong',0),(3,'安能物流','','','','',1488349017,'annengwuliu',0);
/*!40000 ALTER TABLE `ds_logistics_com` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_msg`
--

DROP TABLE IF EXISTS `ds_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_title` varchar(255) DEFAULT NULL COMMENT '消息标题',
  `content` text COMMENT '消息内容',
  `category` tinyint(1) DEFAULT NULL COMMENT '消息分类',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `reply` text,
  `is_reply` tinyint(1) DEFAULT '0' COMMENT '是否回复',
  `add_time` int(10) DEFAULT '0' COMMENT '添加时间',
  `user_name` varchar(64) DEFAULT '' COMMENT '会员名',
  `reply_time` int(11) DEFAULT '0' COMMENT '回复时间',
  `t_user_id` int(11) DEFAULT '0' COMMENT '接收会员ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_msg`
--

LOCK TABLES `ds_msg` WRITE;
/*!40000 ALTER TABLE `ds_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_news`
--

DROP TABLE IF EXISTS `ds_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(64) NOT NULL COMMENT '新闻标题',
  `content` text NOT NULL COMMENT '新闻内容',
  `is_top` tinyint(1) NOT NULL COMMENT '是否置顶',
  `category` tinyint(1) NOT NULL COMMENT '新闻分类',
  `add_time` int(10) NOT NULL,
  `admin_name` varchar(64) DEFAULT '' COMMENT '发布人',
  `scan_num` int(11) DEFAULT '0' COMMENT '浏览量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='新闻公告表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_news`
--

LOCK TABLES `ds_news` WRITE;
/*!40000 ALTER TABLE `ds_news` DISABLE KEYS */;
INSERT INTO `ds_news` VALUES (2,'大家好','大家好',0,2,1488248092,'admin',0),(3,'333','333',1,2,1488434915,'admin',0),(4,'333333','23423423432',1,1,1488434926,'admin',0),(5,'24233423','33323323',1,1,1488434939,'admin',0);
/*!40000 ALTER TABLE `ds_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_orders`
--

DROP TABLE IF EXISTS `ds_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_orders` (
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
  KEY `uid` (`uid`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提供帮助和接受帮助订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_orders`
--

LOCK TABLES `ds_orders` WRITE;
/*!40000 ALTER TABLE `ds_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_parent_user`
--

DROP TABLE IF EXISTS `ds_parent_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_parent_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL COMMENT '父级id',
  `user_id` int(10) NOT NULL COMMENT '用户id',
  `dept` int(2) NOT NULL COMMENT '深度',
  `state` tinyint(1) DEFAULT '0' COMMENT '会员激活状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pid` (`pid`,`user_id`) USING BTREE,
  KEY `uid` (`user_id`) USING BTREE,
  KEY `dept` (`dept`) USING BTREE,
  KEY `pid_2` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='会员推荐关系图谱';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_parent_user`
--

LOCK TABLES `ds_parent_user` WRITE;
/*!40000 ALTER TABLE `ds_parent_user` DISABLE KEYS */;
INSERT INTO `ds_parent_user` VALUES (43,28,29,1,1),(44,28,30,1,1),(45,29,31,1,1),(46,28,31,2,1),(47,29,32,1,1),(48,28,32,2,1),(49,30,33,1,1),(50,28,33,2,1),(54,30,35,1,1),(55,28,35,2,1),(56,31,36,1,1),(57,29,36,2,1),(58,28,36,3,1),(60,31,37,1,1),(61,29,37,2,1),(62,28,37,3,1);
/*!40000 ALTER TABLE `ds_parent_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_payment`
--

DROP TABLE IF EXISTS `ds_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_payment` (
  `id` int(1) unsigned NOT NULL COMMENT '支付索引id',
  `payment_code` char(10) NOT NULL COMMENT '支付代码名称',
  `payment_name` char(10) NOT NULL COMMENT '支付名称',
  `payment_config` text COMMENT '支付接口配置信息',
  `payment_state` enum('0','1') NOT NULL DEFAULT '0' COMMENT '接口状态0禁用1启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_payment`
--

LOCK TABLES `ds_payment` WRITE;
/*!40000 ALTER TABLE `ds_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_power`
--

DROP TABLE IF EXISTS `ds_power`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_power` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限管理表',
  `power` text,
  `dep_name` varchar(255) DEFAULT '' COMMENT '部门名字',
  `add_time` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='权限管理表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_power`
--

LOCK TABLES `ds_power` WRITE;
/*!40000 ALTER TABLE `ds_power` DISABLE KEYS */;
INSERT INTO `ds_power` VALUES (1,'DIndex.Main,DUser.ExpUsers,DUser.UnConfirmUsers,DUser.Users,DUser.Userreg,DUser.UserList,DUser.ExpUserList,DUser.UserRegAC,DUser.Userinfo,DUser.ChangeUserInfo,DUser.LoginHome,DUser.PreNet,DUser.TjNet,DUser.Net,DUser.ActivateMember,DUser.DelMember,DUser.upgradeList,DUser.GetUpgradeList,DUser.dealUpgrade,DUser.EditRank,DUser.applyCenterList,DUser.GetApplyCenterList,DUser.dealApplyCenter,DBonus.BonusList,DBonus.BonusListAC,DBonus.Recharge,DBonus.RechargeList,DBonus.DoRecharge,DBonus.DealRecharge,DCash.CashList,DCash.GetCashList,DCash.DealCash,DNews.News,DNews.NewsAdd,DNews.NewsDelete,DNews.NewsInsert,DNews.NewsList,DMsg.MsgList,DMsg.GetMsgList,DMsg.MsgDetail,DMsg.MsgReply,Setting.Setting,Setting.DoSetting,Setting.ClearData,Reward.RewardList,Reward.GetRewardList,Reward.RewardTotal,Reward.GetRewardTotalList,Reward.RewardRatio,Admin.AdminInfo,Admin.AdminList,Admin.GetAdminList,Admin.ChangeAdminInfo,Admin.DelAdmin,Admin.PowerList,Admin.GetPowerList,Admin.AddPower,Admin.PowerAddAC,Admin.DelPower,Log.logListView,Log.logList,Admin.adminSecPower,Admin.addAdminSecPower,Admin.UserPower,Admin.UserPowerAc,Setting.SysSetting,Setting.DoSysSetting,DB.Dbbackup,DB.DbbackupList,DB.Backup,DB.Download,DB.Restore,DB.Del,Goods.AddCategory,Goods.AddGoodsCategoryAC,Goods.AddGoods,Goods.AddGoodsAC,Goods.DelCategory,Goods.DelGoods,Goods.GoodsList,Goods.GetGoodsList,Goods.GoodsCategory,Goods.GoodsCategoryList,Icon.IconList,Icon.GetIconList,Icon.DelIcon,Icon.IconAdd,Icon.IconAddAc,Icon.ChageStatus,Logistics.GetLogcomList,Logistics.LogcomList,Logistics.LogcomAdd,Logistics.AddLogcomAC,Logistics.DelLogcom,GoodOrders.CancelOrder,GoodOrders.ConfirmOrder,GoodOrders.GetOrderList,GoodOrders.OrdersList,GoodOrders.LookDelivery,GoodOrders.Orderinfo,GoodOrders.PayOrder,GoodOrders.SendGoods,GoodOrders.SendGoodsAc,Export.Reward','总管',1483598884),(3,'DBonus.BonusList,DBonus.BonusListAC,DBonus.Recharge,DBonus.RechargeList,DBonus.DoRecharge','财务',1483602782),(5,'DBonus.BonusList,DBonus.BonusListAC,DBonus.Recharge,DBonus.RechargeList,DBonus.DoRecharge','财务',1483602782);
/*!40000 ALTER TABLE `ds_power` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_pporders`
--

DROP TABLE IF EXISTS `ds_pporders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_pporders` (
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
  KEY `order_id` (`order_id`) USING BTREE,
  KEY `b_order_id` (`b_order_id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `b_uid` (`b_uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单匹配表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_pporders`
--

LOCK TABLES `ds_pporders` WRITE;
/*!40000 ALTER TABLE `ds_pporders` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_pporders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_recharge`
--

DROP TABLE IF EXISTS `ds_recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' COMMENT '充值人ID',
  `user_name` varchar(64) DEFAULT '' COMMENT '会员编号',
  `money_type` tinyint(1) DEFAULT '0' COMMENT '充值金额类型',
  `add_time` int(11) DEFAULT '0' COMMENT '充值时间',
  `recharge_type` tinyint(1) DEFAULT '1' COMMENT '充值类型，0：系统充值,1:会员充值，2：微信充值，3：支付宝充值',
  `check_time` int(11) DEFAULT '0' COMMENT '审核时间',
  `memo` varchar(255) DEFAULT '' COMMENT '备注',
  `true_name` varchar(255) DEFAULT '' COMMENT '真实姓名',
  `money` decimal(12,2) DEFAULT '0.00' COMMENT '充值金额',
  `recharge_sn` varchar(64) DEFAULT '' COMMENT '充值单号',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态，0：未审核，1：审核通过，2：拒绝',
  PRIMARY KEY (`id`),
  UNIQUE KEY `recharge_sn` (`recharge_sn`) USING BTREE,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_recharge`
--

LOCK TABLES `ds_recharge` WRITE;
/*!40000 ALTER TABLE `ds_recharge` DISABLE KEYS */;
INSERT INTO `ds_recharge` VALUES (1,28,'1',3,1488610161,1,1488610161,'','1',100.00,'CZ201703040249218089',1);
/*!40000 ALTER TABLE `ds_recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_shop_good_category`
--

DROP TABLE IF EXISTS `ds_shop_good_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_shop_good_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT '' COMMENT '分类标题',
  `pid` int(10) DEFAULT '0' COMMENT '分类父级id',
  `dept` tinyint(2) DEFAULT '0' COMMENT '分类的深度',
  `sort` tinyint(1) DEFAULT '0' COMMENT '分类排序',
  `orders` int(4) DEFAULT '0' COMMENT '排序规则',
  `pre_str` varchar(255) DEFAULT '' COMMENT '所有上级',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='商品分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_shop_good_category`
--

LOCK TABLES `ds_shop_good_category` WRITE;
/*!40000 ALTER TABLE `ds_shop_good_category` DISABLE KEYS */;
INSERT INTO `ds_shop_good_category` VALUES (1,'时尚女鞋',0,1,127,1,''),(9,'数码电器',0,1,127,11,''),(10,'女鞋',1,2,127,3,'1');
/*!40000 ALTER TABLE `ds_shop_good_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_shop_goods`
--

DROP TABLE IF EXISTS `ds_shop_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_shop_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT '0',
  `goods_name` varchar(255) DEFAULT '' COMMENT '商品名称',
  `goods_pics` text COMMENT '商品图片',
  `add_time` int(10) DEFAULT '0' COMMENT '添加时间',
  `edit_time` int(10) DEFAULT '0' COMMENT '修改时间',
  `sort` tinyint(2) DEFAULT '0' COMMENT '商品排序',
  `is_rec` tinyint(1) DEFAULT '0' COMMENT '是否首页推荐',
  `memo` text COMMENT '详细说明',
  `market_price` decimal(10,2) DEFAULT '0.00',
  `price` decimal(10,2) DEFAULT '0.00',
  `stock` int(4) DEFAULT '0' COMMENT '库存',
  `status` tinyint(1) DEFAULT '1' COMMENT '1：上架，0：下架',
  `goods_option` text COMMENT '商品的规格和属性',
  `option_title` text COMMENT '规格标题',
  `has_option` tinyint(1) DEFAULT '0' COMMENT '启用规格',
  `weight` decimal(12,2) DEFAULT '0.00' COMMENT '重量',
  `goods_sn` varchar(255) DEFAULT '' COMMENT '编码',
  `product_sn` varchar(255) DEFAULT '' COMMENT '条码',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_shop_goods`
--

LOCK TABLES `ds_shop_goods` WRITE;
/*!40000 ALTER TABLE `ds_shop_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_shop_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_shop_order`
--

DROP TABLE IF EXISTS `ds_shop_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_shop_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(255) DEFAULT '' COMMENT '订单编号',
  `user_id` int(10) DEFAULT '0' COMMENT '用户ID',
  `order_amount` decimal(12,2) DEFAULT '0.00' COMMENT '订单金额',
  `address` text COMMENT '收货人信息',
  `status` tinyint(1) DEFAULT '0' COMMENT '订单状态 0 待付款，1：待发货，2：待收货，3，完成，4：取消订单，5：退货',
  `pay_type` tinyint(1) DEFAULT '0' COMMENT '支付方式：0余额支付',
  `add_time` int(10) DEFAULT '0' COMMENT '添加时间',
  `pay_time` int(10) DEFAULT '0' COMMENT '支付时间',
  `delivery_time` int(10) DEFAULT '0' COMMENT '发货时间',
  `comfirm_time` int(10) DEFAULT '0' COMMENT '收货时间',
  `cancel_time` int(10) DEFAULT '0',
  `order_type` tinyint(1) DEFAULT '0' COMMENT '订单类型',
  `delivery_name` varchar(255) DEFAULT '' COMMENT '快递公司',
  `delivery_code` varchar(255) DEFAULT '' COMMENT '快递公司代码',
  `pay_amount` decimal(12,2) DEFAULT '0.00' COMMENT '剩余支付金额',
  `balance_amount` decimal(12,2) DEFAULT '0.00' COMMENT '余额支付金额',
  `delivery_sn` varchar(255) DEFAULT '' COMMENT '快递单号',
  `buyer_name` varchar(64) DEFAULT '' COMMENT '购物人会员编号',
  `buyer_realname` varchar(64) DEFAULT '' COMMENT '购物人姓名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商城订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_shop_order`
--

LOCK TABLES `ds_shop_order` WRITE;
/*!40000 ALTER TABLE `ds_shop_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_shop_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_shop_order_goods`
--

DROP TABLE IF EXISTS `ds_shop_order_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_shop_order_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT '0' COMMENT '订单ID',
  `goods_id` int(10) DEFAULT '0' COMMENT '商品ID',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '商品价格',
  `total` int(4) DEFAULT '1' COMMENT '商品数量',
  `goods_option` text COMMENT '商品的属性',
  `add_time` int(10) DEFAULT '0',
  `goods_pic` varchar(255) DEFAULT NULL COMMENT '商品主图',
  `goods_name` varchar(64) DEFAULT NULL COMMENT '商品名称',
  PRIMARY KEY (`id`),
  KEY `orderid` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_shop_order_goods`
--

LOCK TABLES `ds_shop_order_goods` WRITE;
/*!40000 ALTER TABLE `ds_shop_order_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_shop_order_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_system`
--

DROP TABLE IF EXISTS `ds_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_system` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `system_name` varchar(255) DEFAULT NULL COMMENT '系统名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_system`
--

LOCK TABLES `ds_system` WRITE;
/*!40000 ALTER TABLE `ds_system` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_transfer`
--

DROP TABLE IF EXISTS `ds_transfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_user_id` int(11) DEFAULT NULL COMMENT '转出人id',
  `f_user_name` varchar(64) DEFAULT '' COMMENT '转出人编号',
  `f_true_name` varchar(64) DEFAULT '' COMMENT '转出人姓名',
  `t_user_id` int(11) DEFAULT NULL COMMENT '转入人id',
  `t_user_name` varchar(64) DEFAULT '' COMMENT '转入人编号',
  `t_true_name` varchar(64) DEFAULT '' COMMENT '转出人姓名',
  `money` decimal(12,2) DEFAULT NULL COMMENT '转出金额',
  `money_type` tinyint(1) DEFAULT NULL COMMENT '账户类型',
  `add_time` int(11) DEFAULT NULL COMMENT '转出时间',
  `meno` varchar(255) DEFAULT NULL COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_transfer`
--

LOCK TABLES `ds_transfer` WRITE;
/*!40000 ALTER TABLE `ds_transfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_user`
--

DROP TABLE IF EXISTS `ds_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(64) NOT NULL COMMENT '用户编号',
  `true_name` varchar(64) DEFAULT '' COMMENT '真实姓名',
  `bdmoney` decimal(12,2) DEFAULT '0.00' COMMENT '会员报单金额',
  `mobile` varchar(64) NOT NULL COMMENT '手机号',
  `reg_time` int(10) NOT NULL COMMENT '注册时间',
  `login_time` int(10) NOT NULL COMMENT '登录时间',
  `reg_ip` varchar(64) NOT NULL COMMENT '注册ip',
  `login_ip` varchar(64) NOT NULL COMMENT '登录ip',
  `last_ip` varchar(64) NOT NULL COMMENT '上次登录ip',
  `b0` decimal(12,2) NOT NULL COMMENT '互助钱包金额',
  `b1` decimal(12,2) NOT NULL COMMENT '动态奖金钱包',
  `b2` decimal(12,2) NOT NULL COMMENT '排单币钱包',
  `b3` decimal(12,2) NOT NULL COMMENT '激活币',
  `b4` decimal(12,2) DEFAULT '0.00' COMMENT '购物币，购物使用',
  `b5` decimal(12,2) DEFAULT '0.00' COMMENT '本金',
  `state` tinyint(1) DEFAULT NULL COMMENT '状态值 0:未激活，1：已激活，2：冻结',
  `sex` tinyint(1) DEFAULT '1' COMMENT '性别：1：男，2：女',
  `pwd` varchar(64) DEFAULT '' COMMENT '一级密码',
  `sec_pwd` varchar(64) DEFAULT NULL COMMENT '二级密码',
  `salt` varchar(12) DEFAULT NULL COMMENT '密码加密标记',
  `sec_salt` varchar(12) DEFAULT NULL COMMENT '二级密码加密标记',
  `confirm_time` int(10) DEFAULT '0' COMMENT '激活时间',
  `rank` tinyint(1) DEFAULT '0',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '推荐人id',
  `rid` int(10) DEFAULT '0' COMMENT '接点人ID',
  `pos` tinyint(1) DEFAULT '0',
  `pos_num` int(4) DEFAULT '0',
  `gldept` int(4) DEFAULT '0' COMMENT '接点人深度',
  `tjdept` int(4) DEFAULT '1',
  `market` tinyint(1) DEFAULT '0',
  `user_logo` varchar(255) DEFAULT NULL,
  `user_power` text COMMENT '会员权限列表',
  `ext_data` text COMMENT '扩展信息',
  `bank_user` varchar(255) DEFAULT '' COMMENT '银行用户名',
  `bank_no` varchar(64) DEFAULT '' COMMENT '银行卡号',
  `bank_address` varchar(255) DEFAULT '' COMMENT '银行地址',
  `bank_name` varchar(64) DEFAULT '' COMMENT '银行名',
  `province` varchar(64) DEFAULT '' COMMENT '省',
  `city` varchar(64) DEFAULT '' COMMENT '市',
  `area` varchar(64) DEFAULT '' COMMENT '区',
  `reg_name` varchar(64) DEFAULT '' COMMENT '注册人',
  `reg_id` int(10) DEFAULT '0' COMMENT '注册人ID',
  `zmd_name` varchar(64) DEFAULT '' COMMENT '报单中心',
  `bd_center` tinyint(1) DEFAULT '0' COMMENT '是否报单中心',
  `rfd` decimal(12,2) DEFAULT '0.00' COMMENT '对碰奖日封顶金额(可删除）',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`) USING BTREE,
  KEY `mobile` (`mobile`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_user`
--

LOCK TABLES `ds_user` WRITE;
/*!40000 ALTER TABLE `ds_user` DISABLE KEYS */;
INSERT INTO `ds_user` VALUES (28,'1','1',1200.00,'13512345645',1488502211,0,'192.168.1.116','','',145.77,0.00,0.00,100.00,27.82,0.00,1,1,'119399989e504ee04d5aef82e193a000','2ce62513bbcf2194331e4daa7c8a2d37','iMYQCqjn','omiKPOJV',1488502211,1,0,0,0,2,1,1,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',1,270.00),(29,'2','2',300.00,'13512345678',1488502231,0,'192.168.1.116','','',80.79,0.00,0.00,0.00,8.98,0.00,1,1,'50ef09653a517af03d004a742e75e2f3','02f5c42cb39637552d94f22fb1b31250','QfS7gZQo','Mfs12AhE',1488502260,0,28,28,1,2,2,2,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',0,90.00),(30,'3','3',300.00,'13512345676',1488502249,0,'192.168.1.116','','',76.95,0.00,0.00,0.00,8.55,0.00,1,1,'e1f064bc7367467909c5d4d2ca929739','90a5f9e11ea9803305e11594d3b6b873','8y9WSq4B','pVv20lki',1488502255,0,28,28,2,2,2,2,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',0,90.00),(31,'4','4',300.00,'15312345676',1488502276,0,'192.168.1.116','','',76.95,0.00,0.00,0.00,8.55,0.00,1,1,'2ad8504ded22c460e309e58d34e77289','60ddbfcf65b4fcf03ee1d1a82c4f124e','cky4VG22','ARnNZZC6',1488503026,0,29,29,1,2,3,3,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',0,90.00),(32,'5','5',300.00,'13512345668',1488502294,0,'192.168.1.116','','',0.00,0.00,0.00,0.00,0.00,0.00,1,1,'beffe73c67f4ee4690fd334a0f2b8361','62df61dc726035d09c8afc613de727c4','gONiKNRw','ztPxfOo1',1488502301,0,29,29,2,0,3,3,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',0,0.00),(33,'6','6',300.00,'15312345671',1488548411,0,'192.168.1.116','','',0.00,0.00,0.00,0.00,0.00,0.00,1,1,'823ddcb57a5b4c6ee9e3d83f9df21435','83aafbfd23c557cff79053ea4bef34db','xPK7QRyj','7OHqdcPF',1488614474,0,30,30,2,0,3,3,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',0,0.00),(35,'7','7',300.00,'15312345674',1488614467,0,'192.168.1.116','','',0.00,0.00,0.00,0.00,0.00,0.00,1,1,'eb3280e1ebf37b10d77df6383fc19e9c','f276891b3ad3b225d3785f6c9e73a438','3zSp6ynj','qgvVcnCV',1488614479,0,30,30,1,0,3,3,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',0,0.00),(36,'8','8',300.00,'15312345614',1488770252,0,'192.168.1.116','','',0.00,0.00,0.00,0.00,0.00,0.00,1,1,'a4a35f05371adab7a0050c59a3f50b2b','c2afa0586dcd63a1203076e480d98374','OibJTuFw','DqQwEKNm',1488770302,0,31,31,1,0,4,4,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',0,0.00),(37,'9','9',300.00,'15312345672',1488770296,0,'192.168.1.116','','',0.00,0.00,0.00,0.00,0.00,0.00,1,1,'429bc8d7d894df37ad7836e70db24282','694cf221cddd2d407d86f24af1c1390a','WGRcs1cC','fRAFWIJn',1488770308,0,31,31,2,0,4,4,1,NULL,NULL,NULL,'','','','','北京市','北京市','朝阳区','admin',0,'',0,0.00);
/*!40000 ALTER TABLE `ds_user` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `User.delete` AFTER DELETE ON `ds_user`
FOR EACH ROW begin 
delete from ds_contact_user where user_id = old.id;
delete from ds_parent_user where user_id = old.id;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ds_user_address`
--

DROP TABLE IF EXISTS `ds_user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_user_address` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `realname` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `province` varchar(30) DEFAULT '',
  `city` varchar(30) DEFAULT '',
  `area` varchar(30) DEFAULT '',
  `address` varchar(300) DEFAULT '',
  `is_default` tinyint(1) DEFAULT '0',
  `zipcode` varchar(255) DEFAULT '',
  `country` varchar(255) DEFAULT '' COMMENT '国家',
  PRIMARY KEY (`id`),
  KEY `uid` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户地址表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_user_address`
--

LOCK TABLES `ds_user_address` WRITE;
/*!40000 ALTER TABLE `ds_user_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_user_bank`
--

DROP TABLE IF EXISTS `ds_user_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_user_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '会员ID',
  `bank_name` varchar(40) DEFAULT NULL COMMENT '收款银行',
  `bank_no` varchar(30) DEFAULT NULL COMMENT '收款账号',
  `bank_user` varchar(10) DEFAULT NULL COMMENT '开户人姓名',
  `bank_address` text COMMENT '开户地址',
  `type_state` tinyint(1) DEFAULT '0' COMMENT '是否默认状态,0：非默认，1：默认',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员银行信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_user_bank`
--

LOCK TABLES `ds_user_bank` WRITE;
/*!40000 ALTER TABLE `ds_user_bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `ds_user_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_user_reward`
--

DROP TABLE IF EXISTS `ds_user_reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_user_reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0' COMMENT '用户ID',
  `user_name` varchar(64) DEFAULT NULL COMMENT '用户标号',
  `true_name` varchar(64) DEFAULT NULL COMMENT '会员姓名',
  `money` decimal(12,2) DEFAULT '0.00' COMMENT '实得奖金',
  `fee` decimal(12,2) DEFAULT '0.00' COMMENT '扣税',
  `ztj` decimal(12,2) DEFAULT '0.00' COMMENT '直推奖',
  `jdj` decimal(12,2) DEFAULT '0.00' COMMENT '见点奖',
  `glj` decimal(12,2) DEFAULT '0.00' COMMENT '管理奖',
  `cxj` decimal(12,2) DEFAULT '0.00' COMMENT '重消奖',
  `fhj` decimal(12,2) DEFAULT '0.00' COMMENT '分红奖',
  `dpj` decimal(12,2) DEFAULT '0.00' COMMENT '分红奖',
  `cpj` decimal(12,2) DEFAULT '0.00' COMMENT '分红奖',
  `ldj` decimal(12,2) DEFAULT '0.00' COMMENT '领导奖',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `periods` int(11) DEFAULT '0' COMMENT '期数',
  `repeat_account` decimal(12,2) DEFAULT '0.00' COMMENT '重复消费',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_name` (`user_name`),
  KEY `periods` (`periods`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='奖金明细表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_user_reward`
--

LOCK TABLES `ds_user_reward` WRITE;
/*!40000 ALTER TABLE `ds_user_reward` DISABLE KEYS */;
INSERT INTO `ds_user_reward` VALUES (1,28,'1','1',76.50,4.50,0.00,0.00,0.00,0.00,0.00,90.00,0.00,0.00,1488502260,1,9.00),(12,29,'2','2',76.95,4.50,0.00,0.00,0.00,0.00,0.00,90.00,0.00,0.00,1488503026,2,8.55),(13,28,'1','1',3.84,0.23,0.00,0.00,4.50,0.00,0.00,0.00,0.00,0.00,1488503026,2,0.43),(14,28,'1','1',76.95,4.50,0.00,0.00,0.00,0.00,0.00,90.00,0.00,0.00,1488614474,3,8.55),(15,30,'3','3',76.95,4.50,0.00,0.00,0.00,0.00,0.00,90.00,0.00,0.00,1488614479,4,8.55),(16,28,'1','1',80.79,4.73,0.00,0.00,4.50,0.00,0.00,90.00,0.00,0.00,1488614479,4,8.98),(17,31,'4','4',76.95,4.50,0.00,0.00,0.00,0.00,0.00,90.00,0.00,0.00,1488770308,5,8.55),(18,29,'2','2',3.84,0.23,0.00,0.00,4.50,0.00,0.00,0.00,0.00,0.00,1488770308,5,0.43),(19,28,'1','1',7.69,0.45,0.00,0.00,9.00,0.00,0.00,0.00,0.00,0.00,1488770308,5,0.86);
/*!40000 ALTER TABLE `ds_user_reward` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ds_user_upgrade`
--

DROP TABLE IF EXISTS `ds_user_upgrade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ds_user_upgrade` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `old_rank` tinyint(1) DEFAULT '0' COMMENT '旧的等级',
  `new_rank` tinyint(1) DEFAULT '0' COMMENT '新的等级',
  `add_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `check_time` int(11) DEFAULT '0' COMMENT '处理时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态：0：未审核，1：审核通过，2：拒绝',
  `up_type` tinyint(1) DEFAULT '0' COMMENT '升级类型',
  `momo` varchar(255) DEFAULT '' COMMENT '备注',
  `user_id` int(11) DEFAULT '0' COMMENT '会员等级',
  `user_name` varchar(64) DEFAULT '' COMMENT '会员编号',
  `real_name` varchar(64) DEFAULT '' COMMENT '会员姓名',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='会员升级记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ds_user_upgrade`
--

LOCK TABLES `ds_user_upgrade` WRITE;
/*!40000 ALTER TABLE `ds_user_upgrade` DISABLE KEYS */;
INSERT INTO `ds_user_upgrade` VALUES (1,0,1,1488519727,1488519727,1,0,'',28,'1','1'),(2,1,0,1488519850,1488519850,1,0,'',28,'1','1'),(3,0,1,1488533423,1488533423,1,0,'',28,'1','1'),(4,1,0,1488533603,1488533603,1,0,'',28,'1','1'),(5,0,1,1488533666,1488533666,1,0,'',28,'1','1'),(6,1,0,1488533713,1488533713,1,0,'',28,'1','1'),(7,0,1,1488611214,1488611214,1,0,'',28,'1','1');
/*!40000 ALTER TABLE `ds_user_upgrade` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-06 13:55:18
