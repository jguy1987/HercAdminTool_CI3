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

--
-- Table structure for table `hat_sysinfo`
--

DROP TABLE IF EXISTS `hat_sysinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_sysinfo` (
  `cpuload` varchar(35) DEFAULT NULL,
  `uptime` varchar(35) DEFAULT NULL,
  `memusage` smallint(5) DEFAULT NULL,
  `memtotal` smallint(5) DEFAULT NULL,
  `swapusage` smallint(5) DEFAULT NULL,
  `swaptotal` smallint(5) DEFAULT NULL,
  `procrun` smallint(4) DEFAULT NULL,
  `proczombie` smallint(4) DEFAULT NULL,
  `procsleep` smallint(4) DEFAULT NULL,
  `charsrvmem` smallint(4) DEFAULT NULL,
  `mapsrvmem` smallint(4) DEFAULT NULL,
  `udate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_sysinfo`
--