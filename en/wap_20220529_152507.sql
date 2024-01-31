-- MySQL dump 10.13  Distrib 5.6.50, for Linux (x86_64)
--
-- Host: localhost    Database: wap
-- ------------------------------------------------------
-- Server version	5.6.50-log

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_obmen` int(11) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,1,18,'抄袭迷你世界的游戏',1640838245),(2,1,67,'320×240\r\n按*键有问题',1642124444),(3,1,76,'744.97KB 按0键生命全满，获得99手雷，火焰喷射器',1643282344),(4,1,76,'990.51KB 0键：满血；炸弹99',1643283074);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_msg`
--

DROP TABLE IF EXISTS `forum_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_msg` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  `text` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_msg`
--

LOCK TABLES `forum_msg` WRITE;
/*!40000 ALTER TABLE `forum_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_podrazdel`
--

DROP TABLE IF EXISTS `forum_podrazdel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_podrazdel` (
  `id` int(11) NOT NULL,
  `id_razdel` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_podrazdel`
--

LOCK TABLES `forum_podrazdel` WRITE;
/*!40000 ALTER TABLE `forum_podrazdel` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_podrazdel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_razdel`
--

DROP TABLE IF EXISTS `forum_razdel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_razdel` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_razdel`
--

LOCK TABLES `forum_razdel` WRITE;
/*!40000 ALTER TABLE `forum_razdel` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_razdel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_theme`
--

DROP TABLE IF EXISTS `forum_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_theme` (
  `id` int(11) NOT NULL,
  `id_podraz` int(11) NOT NULL,
  `up` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text` varchar(9000) NOT NULL,
  `time` int(11) NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_theme`
--

LOCK TABLES `forum_theme` WRITE;
/*!40000 ALTER TABLE `forum_theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_raz` varchar(250) NOT NULL,
  `id_user` varchar(250) NOT NULL,
  `icon` varchar(9999) NOT NULL,
  `downs` int(11) NOT NULL DEFAULT '0',
  `name` varchar(1000) DEFAULT NULL,
  `cn` varchar(20) DEFAULT '',
  `platform` varchar(250) NOT NULL,
  `text` varchar(250) DEFAULT '',
  `author` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'SLG','1','1.png',74,'Plants vs Zombies','植物大战僵尸','J2ME','','Electronic Arts Inc.'),(2,'STG','1','2.png',178,'Modern Combat4 Zero Hour','现代战争4：决战时刻','J2ME','Visit dedomil.net for more games!','Gameloft SA'),(3,'SLG','1','3.png',53,'Plants vs Zombies','','J2ME','模拟器黑屏','Electronic Arts'),(4,'RTS','1','4.png',139,'植物大战僵尸','','J2ME','','PopCap Games'),(5,'SLG','1','5.png',60,'三国英雄杀-群殴传 ','','J2ME','','Gamewave '),(6,'ACT','1','6.png',34,'哆啦A梦-道具大作战','','J2ME','','CNMOSUN'),(7,'ACT','1','7.png',32,'AlexiaTheGreatTouch_360×640','','J2ME','','7Seas Entertainment Limited by dedomil.net'),(8,'ACT','1','8.png',34,'木乃伊3-gameloft正版','','J2ME','','Gameloft SA'),(9,'ACT','1','9.png',32,'索尼PS2正版-战神2－经典巨作','','J2ME','','广州摩讯科技'),(10,'ACT','1','10.png',40,'（史诗巨作）战神3-背叛','','J2ME','','广州摩讯科技'),(11,'ACT','1','11.png',27,'BioShock','','J2ME','','Indiagames Ltd.'),(12,'ACT','1','12.png',29,'生化危机-险境求生','','J2ME','','joymeng'),(13,'ETC','1','13.png',35,'Run2','神庙逃亡','J2ME','','mob.ua'),(14,'STG','1','14.png',34,'谍战手游--潜伏','潜伏','J2ME','','Ourpalm'),(15,'STG','1','15.png',41,'永远的魂斗罗','','J2ME','','北京盛天堂'),(16,'ACT','1','16.png',38,'生化危机之重生','','J2ME','','MIDlet Suite Vendor'),(17,'ACT','1','17.png',37,'碟中谍III汉化版','','J2ME','','Gameloft SA'),(18,'SLG','1','18.png',51,'Minecraft 3D','我的世界盗版垃圾游戏抄袭迷你世界','J2ME','','mob.ua'),(19,'ACT','1','19.png',47,'核弹危机之杀手契约','','J2ME','','飞虎数码'),(20,'AVG','37','20.png',47,'Bounce','蹦球一代','J2ME','https://iniche.cn/M/s/10783.png','mob.ua'),(21,'ACT','1','21.png',52,'终·打鬼子III-喋血双雄','','J2ME','','丰趣信息'),(22,'ACT','1','22.png',76,'Rainbow Islands','彩虹岛','J2ME','','Electronic Arts/BiNPDA'),(23,'ACT','37','23.png',36,'铠甲勇士-刑天','','J2ME','','socogame'),(24,'FTG','37','24.png',32,'拳王2012格斗之王','拳皇2012最终版1.40','J2ME','动作格斗冒险游戏，适用于N73，游戏运行相当不赖，强烈推荐大家下载！','songge'),(25,'ACT','37','25.png',34,'Gangstar Rio City of Saints','里约热内卢.圣徒之城','J2ME','动作冒险游戏，适用于多平台，非常好玩','Gameloft SA'),(26,'RAC','37','26.png',57,'Asphalt6','狂野飙车6 豪华版','J2ME','手机上超炫酷的赛车竞速类游戏！漂移氮气赛车竞速，最刺激的游戏体验...还在等什么？赶快下载它吧！','Gameloft SA'),(27,'ARPG','37','27.png',25,'迪迦奥特曼大战怪兽','','J2ME','','sparkgen'),(28,'ACT','1','28.png',31,'The Amazing Spider Man 2','超凡蜘蛛侠','J2ME','','Gameloft SA'),(29,'STG','1','29.png',49,'Modern Combat 2 Black Pegasus','现代战争2黑色飞马','J2ME','','mob.ua'),(30,'ACT','1','30.png',42,'万能战车合金弹头-阴谋','','J2ME','','BMIT'),(31,'RPG','1','31.png',72,'仙剑奇侠传','仙剑奇侠传-忘情篇','J2ME','','ETgame'),(32,'ACT','1','32.png',42,'SplinterCell-ChaosTheory','细胞分裂 混沌理论','J2ME','','Gameloft SA'),(33,'STG','1','33.png',5,'DiGuoYanYI','帝王演义-新康熙传','J2ME','','游戏盒子'),(34,'STG','1','34.png',34,'Modern Combat4 Zero Hour DEDOMIL.NET','现代战争4：决战时刻','J2ME','','Gameloft SA'),(35,'STG','1','35.png',42,'Modern Combat4: Zero Hour DEDOMIL.NET','现代战争4：决战时刻','J2ME','','Gameloft SA'),(36,'STG','1','36.png',109,'CF反恐-穿越前线','','J2ME','','PFUmobile'),(37,'ACT','1','37.png',70,'特警精英-反恐24小时','','J2ME','','linktone'),(38,'ACT','1','38.png',50,'侠盗飞车-Gameloft正版','','J2ME','','Gameloft SA'),(39,'ETC','1','39.png',38,'Bubble Bobble','泡泡龙','J2ME','','Electronic Arts'),(40,'ACT','1','40.png',35,'Tom And Jerry Mouse Maze','猫和老鼠','J2ME','','GlobalFun, serviak'),(41,'ACT','1','41.png',323,'13号特工2','','J2ME','','Gameloft SA'),(42,'ACT','1','42.png',39,'Zombie Infection','生化惊悚','J2ME','','Gameloft SA'),(43,'ETC','1','43.png',36,'Retro Games','','J2ME','','Qplaze'),(44,'ETC','1','44.png',224,'猎鱼达人2013','','J2ME','','xx'),(45,'ETC','1','45.png',67,'逃离密室100门','','J2ME','','PlayPlus'),(46,'STG','1','46.png',63,'N.O.V.A.','','J2ME','','Gameloft SA'),(47,'ETC','1','47.png',99,'Snake Arcade','','J2ME','','GlobalFun'),(48,'FPS','1','48.png',45,'HOW Sandstorm','','J2ME','','mob.ua'),(49,'FPS','1','49.png',37,'Micro Counter Strike','','J2ME','','mob.ua'),(50,'FPS','1','50.png',40,'CS New Year','','J2ME','','mob.ua'),(51,'ETC','1','51.png',68,'麻将象棋五子棋3合1','','J2ME','','新浪'),(52,'AVG','1','52.png',57,'荒岛余生','','J2ME','','Electronic Arts'),(53,'RAC','1','53.png',115,'跑跑卡丁车2012','','J2ME','','BeiWei'),(54,'FPS','1','54.png',31,'Doom RPG','','J2ME','','Electronic Arts'),(55,'FPS','1','55.png',45,'Doom II RPG','毁灭战士2-RPG','J2ME','','Electronic Arts'),(56,'ACT','1','56.png',34,'反 恐 炸 弹 人 - 阿 童 木 正 版','','J2ME','','搜 狐'),(57,'ETC','1','57.png',50,'宝宝 -炮炮堂','','J2ME','','天一讯灵'),(58,'APP','1','58.png',114,'小众网','','J2ME','','mxk'),(59,'STG','1','59.png',38,'特种兵之二战风云','','J2ME','','世纪天开'),(60,'ACT','1','60.png',42,'Crazy Hospital','血腥疯狂医院','J2ME','','www.handy-games.com GmbH / moonsc4p3'),(61,'ACT','1','61.png',35,'狙杀','','J2ME','','深圳创图'),(62,'ETC','1','62.png',43,'非种不可开心农场','','J2ME','','Joymaster'),(63,'ACT','1','63.png',90,'女皇骑士团-月神传说','','J2ME','','汇川科技'),(64,'ACT','1','64.png',163,'战狼-贝奥武夫','','J2ME','','空中猛犸'),(65,'ACT','1','65.png',78,'神庙逃亡','','J2ME','','liwang'),(66,'STG','1','66.png',59,'彩虹六号-拉斯维加斯','','J2ME','','Gameloft SA'),(67,'STG','1','67.png',82,'(国际巨作)CS反恐特警-狙击精英','','J2ME','','深蓝创娱'),(68,'STG','1','68.png',33,'Bionic Commando','','J2ME','','CAPCOM'),(69,'APP','1','69.png',104,'QQ音乐2010','','J2ME','','Tencent'),(70,'ACT','1','70.png',32,'反恐女特','反恐暗夜女特工','J2ME','','ZED'),(71,'ETC','1','71.png',33,'犯罪现场调查之迈阿密2','','J2ME','','Gameloft SA'),(72,'AVG','1','72.png',25,'Darkest Fear 2','漆黑惊栗2黑橡树','J2ME','','Rovio'),(73,'ACT','1','73.png',34,'生化危机之丧尸围城','','J2ME','','MIDlet Suite Vendor'),(74,'RPG','1','74.png',76,'海绵宝宝大冒险','','J2ME','','icetea'),(75,'STG','1','75.png',28,'新铁血战士III毁灭者（电影正版）','','J2ME','','kongzhong.com'),(76,'STG','1','76.png',127,'新铁血战士III毁灭者（电影正版）','','J2ME','','空中猛犸'),(77,'STG','1','77.png',22,'zzbdqxxx','重装部队奇袭行动','J2ME','','linktone'),(78,'STG','1','78.png',76,'重装部队奇袭行动(火爆版)','','J2ME','','linktone'),(79,'ACT','1','79.png',32,'海盗王之文明奇遇','','J2ME','','北京中西网联'),(80,'ACT','1','80.png',34,'古惑狼之勇闯夺命岛','','J2ME','','MIG'),(81,'STG','1','81.png',24,'魂斗罗2012','','J2ME','','gamecho'),(82,'STG','1','82.png',33,'RED http://www.universosymbian.org/','生化危机退化','J2ME','','Glu Mobile'),(83,'STG','1','83.png',35,'shwjd','生化危机3D','J2ME','','CAPCOM'),(84,'STG','1','84.png',41,'Resident Evil: Degeneration','生化危机：堕落','J2ME','','CAPCOM/kriker'),(85,'ACT','1','85.png',32,'波斯王子时之沙（电影正版）','','J2ME','','Gameloft SA'),(86,'STG','1','86.png',31,'恐精英_大姐头','反恐精英-大姐头','J2ME','反恐精英_大姐头','YBKJ'),(87,'ACT','1','87.png',105,'丧尸危机-全城爆发','','J2ME','','moonic'),(88,'ACT','1','88.png',103,'丧尸危机2-自由之翼','','J2ME','','moonic'),(89,'ACT','1','89.png',30,'丧尸危机2-自由之翼5800','','J2ME','','moonic'),(90,'AVG','1','90.png',29,'寂静岭汉化版','','J2ME','','Konami n polick11'),(91,'ACT','1','91.png',25,'蝙蝠侠-黑暗骑士崛起[英文版]','','J2ME','','Gameloft SA'),(92,'ACT','1','92.png',23,'超级大坏蛋','','J2ME','','PALMLINK'),(93,'ETC','1','93.png',471,'犯罪现场-gameloft正版','','J2ME','','Gameloft SA'),(94,'AVG','1','94.png',44,'哆啦A梦大雄的奇幻大冒险-正版','','J2ME','','广州摩讯科技'),(95,'ACT','1','95.png',40,'DoubleDragon2','双截龙2','J2ME','','Elite/BiNPDA'),(96,'AVG','1','96.png',30,'超级警探大战悍匪中文版','','J2ME','','Gameloft SA'),(97,'ARPG','1','97.png',34,'蜘蛛侠3','','J2ME','','SOE'),(98,'ARPG','1','98.png',42,'原神','','J2ME','原神 0.4.05适配横屏全键盘机型，E键技能，Q键大招，1234换人','Pyy'),(99,'APP','1','99.png',74,'MRP模拟器-*软件狂人:)','','J2ME','','*软件狂人:)'),(100,'ETC','1','100.png',24,'主题公园:海洋馆','','J2ME','','BE'),(101,'SLG','1','101.png',24,'主题公园 ','','J2ME','','掌趣科技 '),(102,'STG','1','102.png',28,'铁血战士','','J2ME','','My Vendor'),(103,'ETC','1','103.png',22,'大汉王朝','','J2ME','','岩浆数码'),(104,'SLG','1','104.png',17,'Gangstar City','黑帮城市','J2ME','','Gameloft SA by dedomil.net'),(105,'STG','1','105.png',42,'Contra 3 ','魂斗罗3','J2ME','','KONAMI'),(106,'STG','1','106.png',23,'Super contra RUS','','J2ME','','mob.ua'),(107,'STG','1','107.png',20,'魂斗罗2代-Konami正版','','J2ME','','mob.ua'),(108,'STG','1','108.png',27,'Contra','魂斗罗','J2ME','','mob.ua'),(109,'STG','1','109.png',56,'Contra 4','魂斗罗4','J2ME','','mob.ua'),(110,'STG','1','110.png',30,'Contra 4','','J2ME','','Konami Digital Entertainment'),(111,'STG','1','111.png',39,'Contra 4','','J2ME','','Connect 2 Media/BiNPDA'),(112,'STG','1','112.png',19,'Contra 4','','J2ME','','Konami_Retail_Etty'),(113,'ETC','1','113.png',21,'Tropiki Pirgi','','J2ME','','Mr. Goodliving Ltd'),(114,'RTS','1','114.png',21,'mlzfhsj','','J2ME','','电子艺界'),(115,'APP','1','115.png',35,'文件存档修改器','','J2ME','','qq379264347'),(116,'ACT','1','116.png',19,'Spider-Man 3','蜘蛛侠3','J2ME','Play as Spider-Man in a web-slinging adventure.','Sony Pictures'),(117,'STG','1','117.png',30,'坦克大战之决战柏林','','J2ME','','Aone'),(118,'SLG','1','118.png',30,'Minecraft 2D','我的世界2D盗版垃圾游戏抄袭迷你世界','J2ME','','mob.ua'),(119,'SLG','1','119.png',27,'装甲特战队(拉阔正版)','','J2ME','','北京春腾'),(120,'ACT','1','120.png',29,'赤色要塞之游击队BT版','','J2ME','','Palmlink'),(121,'SLG','1','121.png',39,'xyytfz','喜羊羊塔防大作战','J2ME','','BMIT'),(122,'STG','1','122.png',37,'Galaxy on Fire 2: Valkyrie','浴火银河2: 瓦尔基里（索爱专用）','J2ME','','www.fishlabs.net'),(123,'ACT','1','123.png',39,'血战上海滩-英雄本色','','J2ME','','TDY'),(124,'ETC','1','124.png',27,'SkeeBall','跳跃滚球','J2ME','','Gameloft SA'),(125,'ACT','1','125.png',22,'Crash Mutant Island','','J2ME','','mob.ua'),(126,'ACT','1','126.png',20,'憨豆先生－环游世界大冒险（正版）','','J2ME','','FunLikeDown');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_download`
--

DROP TABLE IF EXISTS `game_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `downs` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_download`
--

LOCK TABLES `game_download` WRITE;
/*!40000 ALTER TABLE `game_download` DISABLE KEYS */;
INSERT INTO `game_download` VALUES (1,5,1,93);
/*!40000 ALTER TABLE `game_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `down` varchar(250) NOT NULL,
  `zh` varchar(5) NOT NULL,
  `v` varchar(8) DEFAULT NULL,
  `DJ` varchar(5) NOT NULL,
  `dpi` varchar(10) NOT NULL,
  `time` int(11) NOT NULL,
  `format` varchar(250) NOT NULL DEFAULT '.png',
  `ivent` varchar(3) DEFAULT '通过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,1,1,'1.jar','中文',NULL,'单机','240×320',1634098633,'.jar','通过'),(2,1,1,'2.jar','英文',NULL,'单机','320×240',1634098692,'.jar','通过'),(3,2,1,'3.jar','英文',NULL,'单机','360×640',1634132948,'.jar','通过'),(4,2,1,'4.jar','英文',NULL,'单机','360×640',1634133661,'.jar','通过'),(5,3,1,'5.jar','英文',NULL,'单机','320×240',1634219823,'.jar','通过'),(6,4,1,'6.jar','中文',NULL,'单机','360×640',1634220330,'.jar','通过'),(7,5,1,'7.jar','中文',NULL,'单机','240×320',1634339429,'.jar','通过'),(8,5,1,'8.jar','中文',NULL,'单机','360×640',1634339628,'.jar','通过'),(9,6,1,'9.jar','中文',NULL,'单机','360×640',1634425254,'.jar','通过'),(10,7,1,'10.jar','中文',NULL,'单机','360×640',1634485138,'.jar','通过'),(11,8,1,'11.jar','中文',NULL,'单机','240×320',1634565188,'.jar','通过'),(12,9,1,'12.jar','中文',NULL,'单机','240×320',1634650912,'.jar','通过'),(13,10,1,'13.jar','中文',NULL,'单机','240×320',1634652548,'.jar','通过'),(14,11,1,'14.jar','中文',NULL,'单机','320×240',1634684843,'.jar','通过'),(15,12,1,'15.jar','中文',NULL,'单机','240×320',1634685335,'.jar','通过'),(16,13,1,'16.jar','中文',NULL,'单机','360×640',1634685555,'.jar','通过'),(17,14,1,'17.jar','中文',NULL,'单机','240×320',1634743037,'.jar','通过'),(18,15,1,'18.jar','中文',NULL,'单机','240×320',1634743278,'.jar','通过'),(19,16,1,'19.jar','中文',NULL,'单机','240×320',1634743677,'.jar','通过'),(20,17,1,'20.jar','中文',NULL,'单机','240×320',1634771559,'.jar','通过'),(21,18,1,'21.jar','英文',NULL,'单机','240×320',1634792722,'.jar','通过'),(22,19,1,'22.jar','中文',NULL,'单机','240×320',1634905620,'.jar','通过'),(23,20,37,'23.jar','中文',NULL,'单机','128×128',1634959833,'.jar','通过'),(24,21,1,'24.jar','中文',NULL,'单机','240×320',1634998820,'.jar','通过'),(25,22,1,'25.jar','中文',NULL,'单机','240×320',1635029595,'.jar','通过'),(26,22,1,'26.jar','中文',NULL,'单机','320×240',1635029715,'.jar','通过'),(27,23,37,'27.jar','中文',NULL,'单机','240×320',1635058799,'.jar','通过'),(28,24,37,'28.jar','中文',NULL,'单机','240×320',1635059011,'.jar','通过'),(29,33,1,'29.jar','中文',NULL,'单机','240×320',1635059199,'.jar','通过'),(30,4,37,'30.jar','中文',NULL,'单机','320×240',1635059216,'.jar','通过'),(31,4,37,'31.jar','中文',NULL,'单机','320×240',1635059256,'.jar','通过'),(32,25,37,'32.jar','英文',NULL,'单机','240×320',1635059320,'.jar','通过'),(33,26,37,'33.jar','中文',NULL,'单机','240×320',1635059593,'.jar','通过'),(34,27,37,'34.jar','中文',NULL,'单机','240×320',1635059892,'.jar','通过'),(35,28,1,'35.jar','英文',NULL,'单机','240×320',1635343466,'.jar','通过'),(36,29,1,'36.jar','英文',NULL,'单机','240×320',1635429320,'.jar','通过'),(37,30,1,'37.jar','中文',NULL,'单机','240×320',1635603763,'.jar','通过'),(38,31,1,'38.jar','中文',NULL,'单机','320×240',1635778650,'.jar','通过'),(39,32,1,'39.jar','英文',NULL,'单机','240×320',1635861848,'.jar','通过'),(40,31,1,'40.jar','中文',NULL,'单机','240×320',1635868584,'.jar','通过'),(41,2,1,'41.jar','英文',NULL,'单机','320×240',1636041407,'.jar','通过'),(42,2,1,'42.jar','英文',NULL,'单机','240×432',1636041463,'.jar','通过'),(43,34,1,'43.jar','英文',NULL,'单机','240×320',1636041532,'.jar','通过'),(44,34,1,'44.jar','英文',NULL,'单机','240×320',1636041599,'.jar','通过'),(45,35,1,'45.jar','英文',NULL,'单机','240×320',1636041642,'.jar','通过'),(46,2,1,'46.jar','英文',NULL,'单机','176×220',1636041682,'.jar','通过'),(47,36,1,'47.jar','中文',NULL,'单机','360×640',1636293994,'.jar','通过'),(48,36,1,'48.jar','中文',NULL,'单机','320×240',1636294712,'.jar','通过'),(49,36,1,'49.jar','中文',NULL,'单机','240×320',1637849406,'.jar','通过'),(50,37,1,'50.jar','中文',NULL,'单机','240×320',1639454961,'.jar','通过'),(51,37,1,'51.jar','中文',NULL,'单机','128×160',1639455093,'.jar','通过'),(52,38,1,'52.jar','中文',NULL,'单机','240×320',1639502078,'.jar','通过'),(53,39,1,'53.jar','英文',NULL,'单机','240×320',1639525316,'.jar','通过'),(54,40,1,'54.jar','中文',NULL,'单机','240×320',1639627161,'.jar','通过'),(55,41,1,'55.jar','中文',NULL,'单机','240×320',1639627277,'.jar','通过'),(56,42,1,'56.jar','英文',NULL,'单机','240×320',1639627971,'.jar','通过'),(57,43,1,'57.jar','英文',NULL,'单机','128×160',1639628446,'.jar','通过'),(58,44,1,'58.jar','中文',NULL,'单机','176×220',1639628741,'.jar','通过'),(59,44,1,'59.jar','中文',NULL,'单机','240×320',1639636657,'.jar','通过'),(60,44,1,'60.jar','中文',NULL,'单机','360×640',1639636740,'.jar','通过'),(61,44,1,'61.jar','中文',NULL,'单机','176×220',1639636786,'.jar','通过'),(62,44,1,'62.jar','中文',NULL,'单机','208×320',1639636830,'.jar','通过'),(63,44,1,'63.jar','中文',NULL,'单机','320×240',1639636884,'.jar','通过'),(64,45,1,'64.jar','中文',NULL,'单机','240×320',1639646726,'.jar','通过'),(65,45,1,'65.jar','中文',NULL,'单机','320×240',1639646887,'.jar','通过'),(66,46,1,'66.jar','中文',NULL,'单机','360×640',1639647164,'.jar','通过'),(67,47,1,'67.jar','英文',NULL,'单机','176×220',1639647393,'.jar','通过'),(68,47,1,'68.jar','英文',NULL,'单机','128×160',1639647501,'.jar','通过'),(69,47,1,'69.jar','英文',NULL,'单机','240×320',1639647663,'.jar','通过'),(70,48,1,'70.jar','英文',NULL,'单机','240×320',1639647831,'.jar','通过'),(71,41,1,'71.jar','中文',NULL,'单机','176×220',1639866675,'.jar','通过'),(72,41,1,'72.jar','中文',NULL,'单机','176×208',1639866724,'.jar','通过'),(73,41,1,'73.jar','中文',NULL,'单机','240×320',1639955457,'.jar','通过'),(74,41,1,'74.jar','中文',NULL,'单机','176×220',1639955513,'.jar','通过'),(75,49,1,'75.jar','英文',NULL,'单机','flex',1639956114,'.jar','通过'),(76,50,1,'76.jar','英文',NULL,'单机','flex',1639956136,'.jar','通过'),(77,41,1,'77.jar','中文',NULL,'单机','128×160',1640041281,'.jar','通过'),(78,41,1,'78.jar','中文',NULL,'单机','128×160',1640041317,'.jar','通过'),(79,51,1,'79.jar','中文',NULL,'单机','240×320',1640042239,'.jar','通过'),(80,51,1,'80.jar','中文',NULL,'单机','176×208',1640042466,'.jar','通过'),(81,41,1,'81.jar','中文',NULL,'单机','128×128',1640127143,'.jar','通过'),(82,52,1,'82.jar','中文',NULL,'单机','240×320',1640127282,'.jar','通过'),(83,53,1,'83.jar','中文',NULL,'单机','flex',1640301425,'.jar','通过'),(84,53,1,'84.jar','中文',NULL,'单机','240×320',1640301469,'.jar','通过'),(85,54,1,'85.jar','英文',NULL,'单机','128×160',1640385901,'.jar','通过'),(86,55,1,'86.jar','英文',NULL,'单机','240×320',1640385975,'.jar','通过'),(87,56,1,'87.jar','中文',NULL,'单机','240×320',1640473157,'.jar','通过'),(88,57,1,'88.jar','中文',NULL,'单机','240×320',1640473211,'.jar','通过'),(89,58,1,'89.jar','中文',NULL,'互联网','240×320',1640574719,'.jar','通过'),(90,59,1,'90.jar','中文',NULL,'单机','240×320',1641135197,'.jar','通过'),(91,60,1,'91.jar','中文',NULL,'单机','240×320',1641137161,'.jar','通过'),(92,61,1,'92.jar','中文',NULL,'单机','240×320',1641162827,'.jar','通过'),(93,62,1,'93.jar','中文',NULL,'单机','240×320',1641162938,'.jar','通过'),(94,63,1,'94.jar','中文',NULL,'单机','320×240',1641250663,'.jar','通过'),(95,63,1,'95.jar','中文',NULL,'单机','240×320',1641250704,'.jar','通过'),(96,64,1,'96.jar','中文',NULL,'单机','240×320',1641335291,'.jar','通过'),(97,64,1,'97.jar','中文',NULL,'单机','176×220',1641335328,'.jar','通过'),(98,64,1,'98.jar','中文',NULL,'单机','176×208',1641424287,'.jar','通过'),(99,64,1,'99.jar','中文',NULL,'单机','128×160',1641424326,'.jar','通过'),(100,64,1,'100.jar','中文',NULL,'单机','128×128',1641593286,'.jar','通过'),(101,65,1,'101.jar','中文',NULL,'单机','240×320',1641593538,'.jar','通过'),(102,66,1,'102.jar','中文',NULL,'单机','240×320',1641677910,'.jar','通过'),(103,67,1,'103.jar','中文',NULL,'单机','320×240',1641678023,'.jar','通过'),(104,67,1,'104.jar','中文',NULL,'单机','240×320',1641768580,'.jar','通过'),(105,68,1,'105.jar','英文',NULL,'单机','320×240',1641768887,'.jar','通过'),(106,0,22,'106.n-gage','',NULL,'','',1642088666,'.n-gage','通过'),(107,69,1,'107.jar','中文',NULL,'互联网','240×320',1642115919,'.jar','通过'),(108,70,1,'108.jar','中文',NULL,'单机','240×320',1642546720,'.jar','通过'),(109,71,1,'109.jar','英文',NULL,'单机','240×320',1642547101,'.jar','通过'),(110,72,1,'110.jar','中文',NULL,'单机','240×320',1642568842,'.jar','通过'),(111,73,1,'111.jar','中文',NULL,'单机','240×320',1642569328,'.jar','通过'),(112,74,1,'112.jar','中文',NULL,'单机','320×240',1642654475,'.jar','通过'),(113,74,1,'113.jar','中文',NULL,'单机','240×320',1642654649,'.jar','通过'),(114,75,1,'114.jar','中文',NULL,'单机','360×640',1642656347,'.jar','通过'),(115,76,1,'115.jar','中文',NULL,'单机','320×240',1642656531,'.jar','通过'),(116,76,1,'116.jar','中文',NULL,'单机','240×320',1642656843,'.jar','通过'),(117,77,1,'117.jar','中文',NULL,'单机','360×640',1642657045,'.jar','通过'),(118,78,1,'118.jar','中文',NULL,'单机','320×240',1642657263,'.jar','通过'),(119,78,1,'119.jar','中文',NULL,'单机','240×320',1642657441,'.jar','通过'),(120,79,1,'120.jar','中文',NULL,'单机','240×320',1642720231,'.jar','通过'),(121,80,1,'121.jar','中文',NULL,'单机','240×320',1642720447,'.jar','通过'),(122,81,1,'122.jar','中文',NULL,'单机','240×320',1642825209,'.jar','通过'),(123,82,1,'123.jar','英文',NULL,'单机','240×320',1642825374,'.jar','通过'),(124,83,1,'124.jar','中文',NULL,'单机','240×320',1642825537,'.jar','通过'),(125,84,1,'125.jar','英文',NULL,'单机','240×320',1642825677,'.jar','通过'),(126,85,1,'126.jar','中文',NULL,'单机','240×320',1642942038,'.jar','通过'),(127,86,1,'127.jar','中文',NULL,'单机','240×320',1642942668,'.jar','通过'),(128,87,1,'128.jar','中文',NULL,'单机','360×640',1642980066,'.jar','通过'),(129,87,1,'129.jar','中文',NULL,'单机','240×320',1642980160,'.jar','通过'),(130,88,1,'130.jar','中文',NULL,'单机','360×640',1643268756,'.jar','通过'),(131,89,1,'131.jar','中文',NULL,'单机','360×640',1643268812,'.jar','通过'),(132,90,1,'132.jar','中文',NULL,'单机','240×320',1643270660,'.jar','通过'),(133,91,1,'133.jar','英文',NULL,'单机','240×320',1643270803,'.jar','通过'),(134,92,1,'134.jar','中文',NULL,'单机','240×320',1643270865,'.jar','通过'),(135,93,1,'135.jar','中文',NULL,'单机','240×320',1643271366,'.jar','通过'),(136,93,1,'136.jar','中文',NULL,'单机','240×320',1643271493,'.jar','通过'),(137,93,1,'137.jar','中文',NULL,'单机','240×320',1643271540,'.jar','通过'),(138,93,1,'138.jar','中文',NULL,'单机','240×320',1643271579,'.jar','通过'),(139,93,1,'139.jar','中文',NULL,'单机','176×220',1643271637,'.jar','通过'),(140,93,1,'140.jar','中文',NULL,'单机','176×220',1643271671,'.jar','通过'),(141,93,1,'141.jar','中文',NULL,'单机','176×220',1643271710,'.jar','通过'),(142,93,1,'142.jar','中文',NULL,'单机','176×220',1643271746,'.jar','通过'),(143,93,1,'143.jar','中文',NULL,'单机','128×160',1643271792,'.jar','通过'),(144,93,1,'144.jar','中文',NULL,'单机','128×160',1643271819,'.jar','通过'),(145,93,1,'145.jar','中文',NULL,'单机','128×128',1643271849,'.jar','通过'),(146,93,1,'146.jar','中文',NULL,'单机','128×128',1643271876,'.jar','通过'),(147,94,1,'147.jar','中文',NULL,'单机','240×320',1643272229,'.jar','通过'),(148,95,1,'148.jar','中文',NULL,'单机','240×320',1643272462,'.jar','通过'),(149,96,1,'149.jar','中文',NULL,'单机','240×320',1643272526,'.jar','通过'),(150,76,1,'150.jar','中文',NULL,'单机','320×240',1643282058,'.jar','通过'),(151,76,1,'151.jar','中文',NULL,'单机','240×320',1643282955,'.jar','通过'),(152,88,1,'152.jar','中文',NULL,'单机','240×320',1643329827,'.jar','通过'),(153,88,1,'153.jar','中文',NULL,'单机','240×320',1643329863,'.jar','通过'),(154,97,1,'154.jar','中文',NULL,'单机','240×320',1643591305,'.jar','通过'),(155,88,1,'155.jar','中文',NULL,'单机','240×320',1643771084,'.jar','通过'),(156,98,1,'156.jar','中文',NULL,'单机','flex',1643771456,'.jar','通过'),(157,99,1,'157.jar','中文',NULL,'单机','flex',1643772220,'.jar','通过'),(158,100,1,'158.jar','中文',NULL,'单机','240×320',1643772389,'.jar','通过'),(159,101,1,'159.jar','中文',NULL,'单机','240×320',1643772452,'.jar','通过'),(160,102,1,'160.jar','中文',NULL,'单机','240×320',1643772678,'.jar','通过'),(161,103,1,'161.jar','中文',NULL,'单机','240×320',1644965817,'.jar','通过'),(162,104,1,'162.jar','英文',NULL,'单机','240×320',1645765025,'.jar','通过'),(163,105,1,'163.jar','中文',NULL,'单机','240×320',1645765809,'.jar','通过'),(164,105,1,'164.jar','中文',NULL,'单机','176×208',1645766008,'.jar','通过'),(165,106,1,'165.jar','其他',NULL,'单机','176×220',1645766285,'.jar','通过'),(166,107,1,'166.jar','中文',NULL,'单机','240×320',1645766823,'.jar','通过'),(167,108,1,'167.jar','中文',NULL,'单机','176×208',1645767040,'.jar','通过'),(168,109,1,'168.jar','英文',NULL,'单机','240×320',1645767175,'.jar','通过'),(169,109,1,'169.jar','英文',NULL,'单机','240×320',1645767201,'.jar','通过'),(170,110,1,'170.jar','英文',NULL,'单机','240×320',1645767535,'.jar','通过'),(171,111,1,'171.jar','英文',NULL,'单机','240×320',1645767581,'.jar','通过'),(172,111,1,'172.jar','英文',NULL,'单机','176×208',1645767605,'.jar','通过'),(173,112,1,'173.jar','英文',NULL,'单机','176×208',1645767709,'.jar','通过'),(174,113,1,'174.jar','中文',NULL,'单机','240×320',1645767779,'.jar','通过'),(175,114,1,'175.jar','中文',NULL,'单机','360×640',1645767872,'.jar','通过'),(176,115,1,'176.jar','中文',NULL,'单机','flex',1645780562,'.jar','通过'),(177,116,1,'177.jar','英文',NULL,'单机','240×320',1645791737,'.jar','通过'),(178,117,1,'178.jar','中文',NULL,'单机','240×320',1645826799,'.jar','通过'),(179,118,1,'179.jar','英文',NULL,'单机','240×320',1645827479,'.jar','通过'),(180,119,1,'180.jar','中文',NULL,'单机','240×320',1645929923,'.jar','通过'),(181,120,1,'181.jar','中文',NULL,'单机','240×320',1645930045,'.jar','通过'),(182,121,1,'182.jar','中文',NULL,'单机','240×320',1646029484,'.jar','通过'),(183,122,1,'183.jar','中文',NULL,'单机','240×320',1646029917,'.jar','通过'),(184,123,1,'184.jar','中文',NULL,'单机','240×320',1646345627,'.jar','通过'),(185,124,1,'185.jar','英文',NULL,'单机','240×320',1647472181,'.jar','通过'),(186,125,1,'186.jar','英文',NULL,'单机','240×320',1648008944,'.jar','通过'),(187,126,1,'187.jar','中文',NULL,'单机','360×640',1648422699,'.jar','通过');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(9999) NOT NULL,
  `format` varchar(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `background` int(11) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'1.png','.png',1,1634909506,19,0),(2,'2.png','.png',1,1634909728,19,0),(3,'3.png','.png',1,1635002235,21,0),(4,'4.png','.png',1,1635002326,21,0),(5,'5.png','.png',1,1635003019,18,0),(6,'6.png','.png',1,1635003048,18,0),(7,'7.png','.png',1,1641661086,60,0),(8,'8.png','.png',1,1641661107,60,0),(9,'9.png','.png',1,1641661372,63,0),(10,'10.png','.png',1,1641661419,63,0),(11,'11.png','.png',1,1641661717,59,0),(12,'12.png','.png',1,1641661739,59,0),(13,'13.png','.png',1,1641662138,41,0),(14,'14.png','.png',1,1641662158,41,0),(15,'15.png','.png',1,1641662274,47,0),(16,'16.png','.png',1,1641662425,47,0),(17,'17.png','.png',1,1641662698,8,0),(18,'18.png','.png',1,1641662759,8,0),(19,'19.png','.png',1,1641679009,9,0),(20,'20.png','.png',1,1641679024,9,0),(21,'21.png','.png',1,1641679224,10,0),(22,'22.png','.png',1,1641679258,10,0),(23,'23.png','.png',1,1641679808,15,0),(24,'24.png','.png',1,1641679937,15,0),(25,'25.png','.png',1,1641680188,14,1),(26,'26.png','.png',1,1641680320,14,0),(27,'27.png','.png',1,1641680556,23,0),(28,'28.png','.png',1,1641680569,23,0),(29,'29.png','.png',1,1641680900,49,0),(30,'30.png','.png',1,1641680950,49,0),(31,'31.png','.png',1,1641681091,50,0),(32,'32.png','.png',1,1641681295,7,0),(33,'33.png','.png',1,1641681367,7,0),(34,'34.png','.png',1,1641681720,32,0),(35,'35.png','.png',1,1641681732,32,0),(36,'36.png','.png',1,1641681888,36,0),(37,'37.png','.png',1,1641681906,36,0),(38,'38.png','.png',1,1641682072,11,0),(39,'39.png','.png',1,1641682156,11,0),(40,'40.png','.png',1,1641799949,58,1),(41,'41.png','.png',1,1641799962,58,0),(42,'42.png','.png',1,1641830929,66,0),(43,'43.png','.png',1,1641830946,66,0),(44,'44.png','.png',1,1641830960,66,0),(45,'45.png','.png',1,1641969678,67,0),(46,'46.png','.png',1,1641969692,67,0),(47,'47.png','.png',1,1642657901,78,0),(48,'48.png','.png',1,1642657915,78,0),(49,'49.png','.png',1,1643269538,72,0),(50,'50.png','.png',1,1643269550,72,0),(51,'51.png','.png',1,1643284522,95,1),(52,'52.png','.png',1,1643284540,95,0),(53,'53.png','.png',1,1643285068,94,1),(54,'54.png','.png',1,1643285110,94,0),(55,'55.png','.png',1,1643285617,81,0),(56,'56.png','.png',1,1643285628,81,0),(57,'57.png','.png',1,1643286301,93,0),(58,'58.png','.png',1,1643286314,93,0),(59,'59.png','.png',1,1643286735,90,0),(60,'60.png','.png',1,1643286749,90,0),(61,'61.png','.png',1,1643286939,84,0),(62,'62.png','.png',1,1643286951,84,0),(63,'63.png','.png',1,1643330549,88,0),(64,'64.png','.png',1,1643330562,88,0),(65,'65.png','.png',1,1643330587,87,1),(66,'66.png','.png',1,1643330599,87,0),(67,'67.png','.png',1,1644965863,103,1),(68,'68.png','.png',1,1646000973,104,0),(69,'69.png','.png',1,1646000986,104,0),(70,'70.png','.png',1,1646001273,105,0),(71,'71.png','.png',1,1646001285,105,0),(72,'72.png','.png',1,1646001298,105,0),(73,'73.png','.png',1,1646001543,106,0),(74,'74.png','.png',1,1646001564,106,0),(75,'75.png','.png',1,1646001747,108,0),(76,'76.png','.png',1,1646001759,108,0),(77,'77.png','.png',1,1646001927,109,0),(78,'78.png','.png',1,1646001939,109,0),(79,'79.png','.png',1,1646002072,113,0),(80,'80.png','.png',1,1646002084,113,0),(81,'81.png','.png',1,1646002098,113,0),(82,'82.png','.png',1,1646002363,116,0),(83,'83.png','.png',1,1646002374,116,0),(84,'84.png','.png',1,1646002506,117,0),(85,'85.png','.png',1,1646002519,117,0),(86,'86.png','.png',1,1646002648,118,0),(87,'87.png','.png',1,1646002660,118,0),(88,'88.png','.png',1,1646028953,119,0),(89,'89.png','.png',1,1646028964,119,0),(90,'90.png','.png',1,1646029075,120,0),(91,'91.png','.png',1,1646029086,120,0),(92,'92.png','.png',1,1646029712,121,0),(93,'93.png','.png',1,1646029723,121,0),(94,'94.png','.png',1,1646029734,121,0),(95,'95.png','.png',1,1646345735,123,0),(96,'96.png','.png',1,1646345764,123,0),(97,'97.png','.png',1,1646345788,123,0),(98,'98.jpg','.jpg',8,1653791393,23,0);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komm_news`
--

DROP TABLE IF EXISTS `komm_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komm_news` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `text` varchar(9999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komm_news`
--

LOCK TABLES `komm_news` WRITE;
/*!40000 ALTER TABLE `komm_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `komm_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_auth`
--

DROP TABLE IF EXISTS `log_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `type` enum('0','1') NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_auth`
--

LOCK TABLES `log_auth` WRITE;
/*!40000 ALTER TABLE `log_auth` DISABLE KEYS */;
INSERT INTO `log_auth` VALUES (1,1,1653401014,'183.146.67.128','1'),(2,1,1653401016,'183.146.67.128','1'),(3,1,1653401022,'183.146.67.128','1'),(4,1,1653401024,'183.146.67.128','1'),(5,1,1653401026,'183.146.67.128','1'),(6,0,1653401027,'183.146.67.128','0'),(7,1,1653401029,'183.146.67.128','1'),(8,1,1653401030,'183.146.67.128','1'),(9,1,1653487839,'183.146.67.128','1'),(10,1,1653530800,'125.117.233.10','1'),(11,1,1653644856,'124.160.213.37','1'),(12,1,1653652372,'218.72.129.225','1'),(13,1,1653734840,'124.160.214.158','1'),(14,1,1653794263,'111.73.167.191','0'),(15,1,1653794289,'111.73.167.191','0'),(16,1,1653794294,'111.73.167.191','0');
/*!40000 ALTER TABLE `log_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msg`
--

DROP TABLE IF EXISTS `msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg` (
  `id` int(11) NOT NULL,
  `text` varchar(9500) NOT NULL,
  `time` int(11) NOT NULL,
  `read` enum('0','1') NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msg`
--

LOCK TABLES `msg` WRITE;
/*!40000 ALTER TABLE `msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msg_chat`
--

DROP TABLE IF EXISTS `msg_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg_chat` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `text` varchar(2500) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msg_chat`
--

LOCK TABLES `msg_chat` WRITE;
/*!40000 ALTER TABLE `msg_chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `msg_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `author` int(11) NOT NULL,
  `time_new` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_chat`
--

DROP TABLE IF EXISTS `room_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_chat` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `info` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_chat`
--

LOCK TABLES `room_chat` WRITE;
/*!40000 ALTER TABLE `room_chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `room_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_log`
--

DROP TABLE IF EXISTS `search_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(250) NOT NULL,
  `num` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_log`
--

LOCK TABLES `search_log` WRITE;
/*!40000 ALTER TABLE `search_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `reg_on` enum('0','1') NOT NULL DEFAULT '1',
  `aut_ban_time` int(11) NOT NULL DEFAULT '60',
  `index_forum` int(11) NOT NULL DEFAULT '5',
  `uphold` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'0',600,7,0);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_raz` varchar(250) NOT NULL,
  `id_user` varchar(250) NOT NULL,
  `icon` varchar(9999) NOT NULL,
  `downs` int(11) NOT NULL DEFAULT '0',
  `name` varchar(1000) DEFAULT NULL,
  `platform` varchar(250) NOT NULL,
  `text` varchar(250) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_comment`
--

DROP TABLE IF EXISTS `theme_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_obmen` int(11) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_comment`
--

LOCK TABLES `theme_comment` WRITE;
/*!40000 ALTER TABLE `theme_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_download`
--

DROP TABLE IF EXISTS `theme_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `downs` int(11) DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_download`
--

LOCK TABLES `theme_download` WRITE;
/*!40000 ALTER TABLE `theme_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_image`
--

DROP TABLE IF EXISTS `theme_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(9999) NOT NULL,
  `format` varchar(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `id_theme` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_image`
--

LOCK TABLES `theme_image` WRITE;
/*!40000 ALTER TABLE `theme_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme_search_log`
--

DROP TABLE IF EXISTS `theme_search_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme_search_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(250) NOT NULL,
  `num` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme_search_log`
--

LOCK TABLES `theme_search_log` WRITE;
/*!40000 ALTER TABLE `theme_search_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme_search_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qq` varchar(250) DEFAULT NULL,
  `baidu` varchar(250) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `theme_downs` int(11) DEFAULT '0',
  `downs` int(11) DEFAULT '0',
  `v_name` varchar(8) DEFAULT NULL,
  `v` int(11) DEFAULT NULL,
  `qq_avatar` varchar(250) DEFAULT NULL,
  `baidu_avatar` varchar(250) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(80) NOT NULL,
  `pol` varchar(1) DEFAULT NULL,
  `data_reg` int(11) NOT NULL DEFAULT '1',
  `admin_level` varchar(3) NOT NULL DEFAULT '会员',
  `up_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,NULL,NULL,'李白怀旧',0,134,'续梦网',1,'/M/u/1.jpg','','admin','c6e1361424bbd531b96fd7b501acb09a','2',1566678206,'管理员',1653782674),(2,'63F34AA0262432AFBD717A2BE5502988',NULL,'码农李白',0,0,NULL,NULL,'http://thirdqq.qlogo.cn/g?b=oidb&k=9c7e2PDia5X3Crzk0ib17N6g',NULL,'','','1',1653431549,'会员',1653808894),(3,NULL,'51a07a0c8655ed9c0e3cf51b6b133f70','触***白',0,0,NULL,NULL,NULL,'b425e8a7a6e69d8ee799bdb9ef','','','1',1653479407,'会员',1653808916),(4,NULL,'19037179323efde3ca54c74039231ba4','A***刃',0,0,NULL,NULL,NULL,'d750416c6578e796bee9a38ee4b98be588835137','','','1',1653680170,'会员',1653742363),(5,NULL,'fee6f06411135406c90d7d0176caa136','176******35',0,1,NULL,NULL,NULL,'c8ecg0d6301000000','','','1',1653718497,'禁言',1653791336),(6,NULL,'8ea2795ae47e2c988f8d02fcd48c5ae1','双***R',0,0,NULL,NULL,NULL,'c02de58f8ce5ad90475352505e','','','1',1653755923,'禁言',1653799174),(7,'B1DC3CD24F33625ECAE82127E30A29C0',NULL,'夜色沉沉.',0,0,NULL,NULL,'http://thirdqq.qlogo.cn/g?b=oidb&k=rbE0gQ5P07tO16M3rIflyg','','','','1',1653791242,'禁言',1653791504),(8,'04F366E1BB2099669870181A0B40FC48',NULL,'玉风emo了',0,0,NULL,NULL,'http://thirdqq.qlogo.cn/g?b=oidb&k=icHJv8oZ0sfT3aSZwPMvia5g','','','','1',1653791347,'禁言',1653796634),(9,'ACBA25C9E9E62C39390750F4544B5C9B',NULL,'X',0,0,NULL,NULL,'http://thirdqq.qlogo.cn/g?b=oidb&k=DHYiboaRHY1icxBHuWMibooHA','','','','1',1653793226,'禁言',1653797553),(10,NULL,'d41d8cd98f00b204e9800998ecf8427e','',0,0,NULL,NULL,'',NULL,'','','1',1653797982,'会员',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'wap'
--

--
-- Dumping routines for database 'wap'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-29 15:25:07
