CREATE TABLE IF NOT EXISTS `hat_chareditlog` (
`chg_id` int(6) NOT NULL,
  `char_id` int(5) NOT NULL,
  `user` smallint(4) NOT NULL,
  `datetime` datetime NOT NULL,
  `chg_attr` varchar(25) NOT NULL,
  `old_value` varchar(50) NOT NULL,
  `new_value` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `hat_chareditlog`
 ADD PRIMARY KEY (`chg_id`);

ALTER TABLE `hat_chareditlog`
MODIFY `chg_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;


