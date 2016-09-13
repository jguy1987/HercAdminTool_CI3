--
-- Table structure for table `hat_accteditlog`
--

DROP TABLE IF EXISTS `hat_accteditlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_accteditlog` (
  `chg_id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `acct_id` int(7) NOT NULL,
  `user` smallint(4) NOT NULL,
  `datetime` datetime NOT NULL,
  `chg_attr` varchar(20) NOT NULL,
  `old_value` varchar(60) NOT NULL,
  `new_value` varchar(60) NOT NULL,
  PRIMARY KEY (`chg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_accteditlog`
--

--
-- Table structure for table `hat_acctnotes`
--

DROP TABLE IF EXISTS `hat_acctnotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_acctnotes` (
  `note_id` int(7) NOT NULL AUTO_INCREMENT,
  `acct_id` int(7) NOT NULL,
  `datetime` datetime NOT NULL,
  `userid` int(5) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_acctnotes`
--

--
-- Table structure for table `hat_blockinfo`
--

DROP TABLE IF EXISTS `hat_blockinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_blockinfo` (
  `blockid` int(7) NOT NULL AUTO_INCREMENT,
  `acct_id` int(7) NOT NULL,
  `blockdate` datetime NOT NULL,
  `block_type` enum('temp','perm') NOT NULL,
  `expiredate` datetime NOT NULL,
  `block_user` smallint(5) NOT NULL,
  `unblock_user` smallint(5) DEFAULT NULL,
  `unblock_date` datetime DEFAULT NULL,
  `reason` varchar(60) NOT NULL,
  `block_comment` text NOT NULL,
  `unblock_comment` text,
  PRIMARY KEY (`blockid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_blockinfo`
--

CREATE TABLE IF NOT EXISTS `hat_herc_login` (
	`account_id` mediumint(7) NOT NULL,
	`createdate` DATE NOT NULL,
	`register_ip` VARCHAR(15) NOT NULL, 
	`auth_ip` VARCHAR(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;