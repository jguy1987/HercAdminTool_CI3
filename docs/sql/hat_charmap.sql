--
-- Table structure for table `hat_chareditlog`
--

DROP TABLE IF EXISTS `hat_chareditlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_chareditlog` (
  `chg_id` int(6) NOT NULL AUTO_INCREMENT,
  `char_id` int(5) NOT NULL,
  `user` smallint(4) NOT NULL,
  `datetime` datetime NOT NULL,
  `chg_attr` varchar(25) NOT NULL,
  `old_value` varchar(50) NOT NULL,
  `new_value` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`chg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_chareditlog`
--


CREATE TABLE IF NOT EXISTS `hat_broadcasts` (
  `b_id` int(6) NOT NULL,
  `userid` int(4) NOT NULL,
  `contents` varchar(60) NOT NULL,
  `contents2` varchar(60) DEFAULT NULL,
  `contents3` varchar(60) DEFAULT NULL,
  `contents4` varchar(60) DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `b_interval` int(3) NOT NULL,
  `b_lastevent` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
