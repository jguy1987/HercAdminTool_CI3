--
-- Table structure for table `hat_adminnews`
--

DROP TABLE IF EXISTS `hat_adminnews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_adminnews` (
  `id` int(6) NOT NULL,
  `user` int(4) NOT NULL,
  `date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `content` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_adminnews`
--

--
-- Table structure for table `hat_bughistory`
--

DROP TABLE IF EXISTS `hat_bughistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_bughistory` (
  `action_id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `bug_id` mediumint(7) NOT NULL,
  `datetime` datetime NOT NULL,
  `action_type` tinyint(2) NOT NULL,
  `userid` smallint(4) NOT NULL,
  `old_value` varchar(255) DEFAULT NULL,
  `new_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_bughistory`
--

--
-- Table structure for table `hat_bugs`
--

DROP TABLE IF EXISTS `hat_bugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_bugs` (
  `bug_id` mediumint(7) NOT NULL AUTO_INCREMENT,
  `starter` smallint(4) NOT NULL,
  `startdate` datetime NOT NULL,
  `status` tinyint(2) NOT NULL,
  `resolution` tinyint(2) NOT NULL,
  `version` varchar(15) DEFAULT NULL,
  `assigned` smallint(4) DEFAULT NULL,
  `priority` tinyint(2) NOT NULL,
  `comment` text NOT NULL,
  `reproduce` text,
  `category` tinyint(3) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `server` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`bug_id`),
  UNIQUE KEY `bug_id` (`bug_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65001 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_bugs`
--

DROP TABLE IF EXISTS `hat_bugcomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_bugcomments` (
	`commentid` mediumint(7) NOT NULL AUTO_INCREMENT,
	`datetime` datetime NOT NULL,
	`bug_id` mediumint(7) NOT NULL,
	`userid` smallint(4) NOT NULL,
	`comment` text NOT NULL,
	PRIMARY KEY (`commentid`),
	UNIQUE KEY `commentid` (`commentid`)
) ENGINE=InnoDB AUTO_INCREMENT=30000 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_bugcomments`
--

--
-- Table structure for table `hat_groups`
--

DROP TABLE IF EXISTS `hat_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_groups` (
  `id` int(2) NOT NULL,
  `name` varchar(60) NOT NULL,
  `viewemail` tinyint(1) NOT NULL,
  `editacctemail` tinyint(1) NOT NULL,
  `resetacctpass` tinyint(1) NOT NULL,
  `editgender` tinyint(1) NOT NULL,
  `editacctgroup` tinyint(1) NOT NULL,
  `acctgroupmax` tinyint(2) NOT NULL,
  `editacctbd` tinyint(1) NOT NULL,
  `editacctslots` tinyint(1) NOT NULL,
  `addaccount` tinyint(1) NOT NULL,
  `usepurge` tinyint(1) NOT NULL,
  `banaccount` tinyint(1) NOT NULL,
  `unbanaccount` tinyint(1) NOT NULL,
  `edittrust` tinyint(1) NOT NULL,
  `editstorageitem` tinyint(1) NOT NULL,
  `editcharname` tinyint(1) NOT NULL,
  `editcharslot` tinyint(1) NOT NULL,
  `editcharzeny` tinyint(1) NOT NULL,
  `editcharlv` tinyint(1) NOT NULL,
  `editcharstats` tinyint(1) NOT NULL,
  `editcharjob` tinyint(1) NOT NULL,
  `editcharlook` tinyint(1) NOT NULL,
  `whosonline` tinyint(1) NOT NULL,
  `delcharitem` tinyint(1) NOT NULL,
  `editcharitem` tinyint(1) NOT NULL,
  `senditem` tinyint(1) NOT NULL,
  `kickchar` tinyint(1) NOT NULL,
  `delcharacter` tinyint(1) NOT NULL,
  `restoredelchar` tinyint(1) NOT NULL,
  `changeposition` tinyint(1) NOT NULL,
  `editgroups` tinyint(1) NOT NULL,
  `addgroup` tinyint(1) NOT NULL,
  `deladmingroup` tinyint(1) NOT NULL,
  `addadmin` tinyint(1) NOT NULL,
  `editadmin` tinyint(1) NOT NULL,
  `deladmin` tinyint(1) NOT NULL,
  `viewtickets` tinyint(1) NOT NULL,
  `editcategory` tinyint(1) NOT NULL,
  `editpredef` tinyint(1) NOT NULL,
  `levellock` tinyint(1) NOT NULL,
  `assigngm` tinyint(1) NOT NULL,
  `canreopen` tinyint(1) NOT NULL,
  `announcement` tinyint(1) NOT NULL,
  `items` tinyint(1) NOT NULL,
  `itemshop` tinyint(1) NOT NULL,
  `mobs` tinyint(1) NOT NULL,
  `serverstats` tinyint(1) NOT NULL,
  `servermaint` tinyint(1) NOT NULL,
  `viewadminlogs` tinyint(1) NOT NULL,
  `editguildname` tinyint(1) NOT NULL,
  `editguildlv` tinyint(1) NOT NULL,
  `delguild` tinyint(1) NOT NULL,
  `changeleader` tinyint(1) NOT NULL,
  `backupdb` tinyint(1) NOT NULL,
  `atcmdlog` tinyint(1) NOT NULL,
  `branchlog` tinyint(1) NOT NULL,
  `chatlog` tinyint(1) NOT NULL,
  `loginlog` tinyint(1) NOT NULL,
  `mvplog` tinyint(1) NOT NULL,
  `npclog` tinyint(1) NOT NULL,
  `picklog` tinyint(1) NOT NULL,
  `zenylog` tinyint(1) NOT NULL,
  `sftp` tinyint(1) NOT NULL,
  `serverconfig` tinyint(1) NOT NULL,
  `hatconfig` tinyint(1) NOT NULL,
  `delcharsaccts` tinyint(1) NOT NULL,
  `editadminnews` tinyint(1) NOT NULL,
  `sqlquery` tinyint(1) NOT NULL,
  `itemcount` tinyint(1) NOT NULL,
  `level1zeny` tinyint(1) NOT NULL,
  `nocharaccts` tinyint(1) NOT NULL,
  `top100` tinyint(1) NOT NULL,
  `mvpkill` tinyint(1) NOT NULL,
  `viewbugs` tinyint(1) DEFAULT NULL,
  `openbugs` tinyint(1) DEFAULT NULL,
  `changestatus` tinyint(1) DEFAULT NULL,
  `makeprivate` tinyint(1) DEFAULT NULL,
  `assignbug` tinyint(1) DEFAULT NULL,
  `editbugs` tinyint(1) DEFAULT NULL,
  `isdev` tinyint(1) NOT NULL,
  `viewprivate` tinyint(1) DEFAULT NULL,
  `viewaccounts` tinyint(1) DEFAULT NULL,
  `viewchars` tinyint(1) DEFAULT NULL,
  `viewguilds` tinyint(1) DEFAULT NULL,
  `managecastles` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_groups`
--

LOCK TABLES `hat_groups` WRITE;
/*!40000 ALTER TABLE `hat_groups` DISABLE KEYS */;
INSERT INTO `hat_groups` (`id`, `name`, `viewemail`, `editacctemail`, `resetacctpass`, `editgender`, `editacctgroup`, `acctgroupmax`, `editacctbd`, `editacctslots`, `addaccount`, `usepurge`, `banaccount`, `unbanaccount`, `edittrust`, `editstorageitem`, `editcharname`, `editcharslot`, `editcharzeny`, `editcharlv`, `editcharstats`, `editcharjob`, `editcharlook`, `whosonline`, `delcharitem`, `editcharitem`, `senditem`, `kickchar`, `delcharacter`, `restoredelchar`, `changeposition`, `editgroups`, `addgroup`, `deladmingroup`, `addadmin`, `editadmin`, `deladmin`, `viewtickets`, `editcategory`, `editpredef`, `levellock`, `assigngm`, `canreopen`, `announcement`, `items`, `itemshop`, `mobs`, `serverstats`, `servermaint`, `viewadminlogs`, `editguildname`, `editguildlv`, `delguild`, `changeleader`, `backupdb`, `atcmdlog`, `branchlog`, `chatlog`, `loginlog`, `mvplog`, `npclog`, `picklog`, `zenylog`, `sftp`, `serverconfig`, `hatconfig`, `delcharsaccts`, `editadminnews`, `sqlquery`, `itemcount`, `level1zeny`, `nocharaccts`, `top100`, `mvpkill`, `viewbugs`, `openbugs`, `changestatus`, `makeprivate`, `assignbug`, `editbugs`, `isdev`, `viewprivate`, `viewaccounts`, `viewchars`, `viewguilds`, `managecastles`) VALUES
(1, 'Trial Gamemaster', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 'Gamemaster', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(50, 'Super Gamemaster', 1, 1, 1, 1, 0, 0, 0, 1, 1, 0, 1, 1, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0),
(75, 'Game Administrator', 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1),
(80, 'Developer', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(98, 'Co-Owner', 1, 1, 1, 1, 1, 99, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
(99, 'Owner', 1, 1, 1, 1, 1, 99, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

/*!40000 ALTER TABLE `hat_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hat_loginlog`
--

DROP TABLE IF EXISTS `hat_loginlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_loginlog` (
  `userid` int(5) NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_loginlog`
--

--
-- Table structure for table `hat_sessions`
--

DROP TABLE IF EXISTS `hat_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hat_sessions_id_ip` (`id`,`ip_address`),
  KEY `hat_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_sessions`
--

--
-- Table structure for table `hat_tktfolders`
--

DROP TABLE IF EXISTS `hat_tktfolders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_tktfolders` (
  `folderid` int(3) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `foldername` varchar(60) NOT NULL,
  PRIMARY KEY (`folderid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_tktfolders`
--

LOCK TABLES `hat_tktfolders` WRITE;
/*!40000 ALTER TABLE `hat_tktfolders` DISABLE KEYS */;
INSERT INTO `hat_tktfolders` VALUES (1,1,'Account Deletion'),(2,1,'Account Theft'),(3,1,'Banned Account Inquiry'),(4,1,'Bug Report'),(5,1,'Email Activation Problems'),(6,1,'Email Address Changes'),(7,1,'Miscellaneous'),(8,1,'Installation / Technical Problems'),(9,1,'Player Report'),(10,1,'Item Reimbursement'),(11,1,'Item Shop Problems'),(12,1,'Password Problems'),(13,1,'Quest Problems');
/*!40000 ALTER TABLE `hat_tktfolders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hat_tktlog`
--

DROP TABLE IF EXISTS `hat_tktlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_tktlog` (
  `histid` int(9) NOT NULL AUTO_INCREMENT,
  `t_id` int(7) NOT NULL,
  `type_id` int(2) NOT NULL,
  `user` varchar(55) NOT NULL,
  `hist_date` datetime NOT NULL,
  `old_value` int(5) DEFAULT NULL,
  `new_value` int(5) DEFAULT NULL,
  PRIMARY KEY (`histid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_tktlog`
--

--
-- Table structure for table `hat_tktmain`
--

DROP TABLE IF EXISTS `hat_tktmain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_tktmain` (
  `t_id` int(7) NOT NULL AUTO_INCREMENT,
  `t_sender` varchar(50) NOT NULL,
  `t_subject` varchar(80) NOT NULL,
  `t_folderid` int(3) DEFAULT NULL,
  `t_submittime` datetime NOT NULL,
  `t_lastreply` datetime DEFAULT NULL,
  `t_status` int(2) NOT NULL,
  `t_groupid` int(3) DEFAULT NULL,
  `t_userid` int(3) DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_tktmain`
--

--
-- Table structure for table `hat_tktreplies`
--

DROP TABLE IF EXISTS `hat_tktreplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_tktreplies` (
  `t_replyid` int(7) NOT NULL AUTO_INCREMENT,
  `t_id` int(7) NOT NULL,
  `r_date` datetime NOT NULL,
  `r_content` text NOT NULL,
  `r_user` varchar(55) NOT NULL,
  `r_groupid` int(2) DEFAULT NULL,
  PRIMARY KEY (`t_replyid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_tktreplies`
--

--
-- Table structure for table `hat_users`
--

DROP TABLE IF EXISTS `hat_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hat_users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `pemail` varchar(128) NOT NULL,
  `gameacctid` mediumint(7) DEFAULT NULL,
  `createdate` date NOT NULL,
  `groupid` int(2) NOT NULL,
  `disablelogin` tinyint(1) NOT NULL,
  `lastactive` datetime DEFAULT NULL,
  `lastmodule` varchar(45) NOT NULL,
  `vacation` tinyint(1) NOT NULL DEFAULT 0,
  `vacationsince` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2002 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hat_users`
--

INSERT INTO `hat_users` (`username`, `passwd`, `pemail`, `createdate`, `groupid`, `disablelogin`, `lastmodule`, `vacation`) VALUES ('admin', MD5('changeme1!'), 'tempemail@yourdomain.com', NOW(), 99, 0, 'admin/install', 0);
