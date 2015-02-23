CREATE TABLE IF NOT EXISTS `hat_accteditlog` (
`chg_id` mediumint(6) NOT NULL,
  `acct_id` int(7) NOT NULL,
  `user` smallint(4) NOT NULL,
  `datetime` datetime NOT NULL,
  `chg_attr` varchar(20) NOT NULL,
  `old_value` varchar(60) NOT NULL,
  `new_value` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hat_chareditlog` (
`chg_id` int(6) NOT NULL,
  `char_id` int(5) NOT NULL,
  `user` smallint(4) NOT NULL,
  `datetime` datetime NOT NULL,
  `chg_attr` varchar(25) NOT NULL,
  `old_value` int(10) NOT NULL,
  `new_value` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hat_acctnotes` (
`note_id` int(7) NOT NULL,
  `acct_id` int(7) NOT NULL,
  `datetime` datetime NOT NULL,
  `userid` int(5) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hat_adminnews` (
  `id` int(6) NOT NULL,
  `user` int(4) NOT NULL,
  `date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `content` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hat_blockinfo` (
`blockid` int(7) NOT NULL,
  `acct_id` int(7) NOT NULL,
  `blockdate` datetime NOT NULL,
  `block_type` enum('temp','perm') NOT NULL,
  `expiredate` datetime NOT NULL,
  `block_user` smallint(5) NOT NULL,
  `unblock_user` smallint(5) DEFAULT NULL,
  `unblock_date` datetime DEFAULT NULL,
  `reason` varchar(60) NOT NULL,
  `block_comment` text NOT NULL,
  `unblock_comment` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hat_groups` (
  `id` int(2) NOT NULL,
  `name` varchar(60) NOT NULL,
  `viewemail` tinyint(1) NOT NULL,
  `editacctemail` tinyint(1) NOT NULL,
  `resetacctpass` tinyint(1) NOT NULL,
  `editgender` tinyint(1) NOT NULL,
  `editacctgroup` tinyint(1) NOT NULL,
  `acctgroupmax` tinyint(2) NULL,
  `editacctbd` tinyint(1) NOT NULL,
  `editacctslots` tinyint(1) NOT NULL,
  `addaccount` tinyint(1) NOT NULL,
  `usepurge` tinyint(1) NOT NULL,
  `banaccount` tinyint(1) NOT NULL,
  `unbanaccount` tinyint(1) NOT NULL,
  `edittrust` tinyint(1) NOT NULL,
  `editcharzeny` tinyint(1) NOT NULL,
  `editcharlv` tinyint(1) NOT NULL,
  `editcharstats` tinyint(1) NOT NULL,
  `editcharjob` tinyint(1) NOT NULL,
  `whosonline` tinyint(1) NOT NULL,
  `delcharitem` tinyint(1) NOT NULL,
  `senditem` tinyint(1) NOT NULL,
  `kickchar` tinyint(1) NOT NULL,
  `delcharacter` tinyint(1) NOT NULL,
  `restoredelchar` tinyint(1) NOT NULL,
  `changeposition` tinyint(1) NOT NULL,
  `editgroups` tinyint(1) NOT NULL,
  `addgroup` tinyint(1) NOT NULL,
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
  `servermaint` tinyint(1) NOT NULL,
  `viewadminlogs` tinyint(1) NOT NULL,
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
  `editadminnews` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `hat_groups` (`id`, `name`, `viewemail`, `editacctemail`, `resetacctpass`, `editgender`, `editacctgroup`, `editacctbd`, `editacctslots`, `addaccount`, `usepurge`, `banaccount`, `unbanaccount`, `edittrust`, `editcharzeny`, `editcharlv`, `editcharstats`, `editcharjob`, `whosonline`, `delcharitem`, `senditem`, `kickchar`, `delcharacter`, `restoredelchar`, `changeposition`, `editgroups`, `addgroup`, `addadmin`, `editadmin`, `deladmin`, `viewtickets`, `editcategory`, `editpredef`, `levellock`, `assigngm`, `canreopen`, `announcement`, `items`, `itemshop`, `mobs`, `servermaint`, `viewadminlogs`, `backupdb`, `atcmdlog`, `branchlog`, `chatlog`, `loginlog`, `mvplog`, `npclog`, `picklog`, `zenylog`, `sftp`, `serverconfig`, `hatconfig`, `editadminnews`) VALUES
(1, 'Trial Gamemaster', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 'Gamemaster', 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0),
(50, 'Super Gamemaster', 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(75, 'Game Administrator', 1, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0),
(98, 'Co-Owner', 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(99, 'Owner', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

CREATE TABLE IF NOT EXISTS `hat_loginlog` (
  `userid` int(5) NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hat_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hat_tktfolders` (
`folderid` int(3) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `foldername` varchar(60) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

INSERT INTO `hat_tktfolders` (`folderid`, `active`, `foldername`) VALUES
(1, 1, 'Account Deletion'),
(2, 1, 'Account Theft'),
(3, 1, 'Banned Account Inquiry'),
(4, 1, 'Bug Report'),
(5, 1, 'Email Activation Problems'),
(6, 1, 'Email Address Changes'),
(7, 1, 'Miscellaneous'),
(8, 1, 'Installation / Technical Problems'),
(9, 1, 'Player Report'),
(10, 1, 'Item Reimbursement'),
(11, 1, 'Item Shop Problems'),
(12, 1, 'Password Problems'),
(13, 1, 'Quest Problems');

CREATE TABLE IF NOT EXISTS `hat_tktlog` (
`histid` int(9) NOT NULL,
  `t_id` int(7) NOT NULL,
  `type_id` int(2) NOT NULL,
  `user` varchar(55) NOT NULL,
  `hist_date` datetime NOT NULL,
  `old_value` int(5) DEFAULT NULL,
  `new_value` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000 ;

CREATE TABLE IF NOT EXISTS `hat_tktmain` (
`t_id` int(7) NOT NULL,
  `t_sender` varchar(50) NOT NULL,
  `t_subject` varchar(80) NOT NULL,
  `t_folderid` int(3) DEFAULT NULL,
  `t_submittime` datetime NOT NULL,
  `t_lastreply` datetime DEFAULT NULL,
  `t_status` int(2) NOT NULL,
  `t_groupid` int(3) DEFAULT NULL,
  `t_userid` int(3) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;

CREATE TABLE IF NOT EXISTS `hat_tktreplies` (
`t_replyid` int(7) NOT NULL,
  `t_id` int(7) NOT NULL,
  `r_date` datetime NOT NULL,
  `r_content` text NOT NULL,
  `r_user` varchar(55) NOT NULL,
  `r_groupid` int(2) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

CREATE TABLE IF NOT EXISTS `hat_users` (
`id` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `pemail` varchar(128) NOT NULL,
  `gameacctid` mediumint(7) DEFAULT NULL,
  `createdate` date NOT NULL,
  `groupid` int(2) NOT NULL,
  `disablelogin` tinyint(1) NOT NULL,
  `lastactive` datetime DEFAULT NULL,
  `lastmodule` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2000 ;

ALTER TABLE `hat_accteditlog`
 ADD PRIMARY KEY (`chg_id`);
 
ALTER TABLE `hat_chareditlog`
 ADD PRIMARY KEY (`chg_id`);

ALTER TABLE `hat_acctnotes`
 ADD PRIMARY KEY (`note_id`);

ALTER TABLE `hat_adminnews`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `hat_blockinfo`
 ADD PRIMARY KEY (`blockid`);

ALTER TABLE `hat_groups`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `hat_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

ALTER TABLE `hat_tktfolders`
 ADD PRIMARY KEY (`folderid`);

ALTER TABLE `hat_tktlog`
 ADD PRIMARY KEY (`histid`);

ALTER TABLE `hat_tktmain`
 ADD PRIMARY KEY (`t_id`);

ALTER TABLE `hat_tktreplies`
 ADD PRIMARY KEY (`t_replyid`);

ALTER TABLE `hat_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);


ALTER TABLE `hat_accteditlog`
MODIFY `chg_id` mediumint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `hat_chareditlog`
MODIFY `chg_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `hat_acctnotes`
MODIFY `note_id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `hat_blockinfo`
MODIFY `blockid` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `hat_tktfolders`
MODIFY `folderid` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
ALTER TABLE `hat_tktlog`
MODIFY `histid` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10000;
ALTER TABLE `hat_tktmain`
MODIFY `t_id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
ALTER TABLE `hat_tktreplies`
MODIFY `t_replyid` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
ALTER TABLE `hat_users`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2000;

-- Table modifications for the hercules tables
ALTER TABLE `login` 
ADD `createdate` DATE NOT NULL AFTER `group_id`,
ADD `register_ip` VARCHAR(15) NOT NULL AFTER `createdate`, 
ADD `auth_ip` VARCHAR(15) NOT NULL AFTER `register_ip`;
