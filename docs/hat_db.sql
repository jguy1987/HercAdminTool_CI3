--
-- Create table `users`
--
CREATE TABLE users (
  userID INT(11) NOT NULL AUTO_INCREMENT,
  userName VARCHAR(255) NOT NULL,
  userPass VARCHAR(255) NOT NULL,
  userEmail VARCHAR(255) NOT NULL,
  userAcctID INT(8) DEFAULT NULL,
  userGroupID INT(2) NOT NULL,
  PRIMARY KEY (userID)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create table `groups`
--
CREATE TABLE groups (
  groupID INT(2) NOT NULL,
  groupName VARCHAR(80) DEFAULT NULL,
  viewAccounts TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (groupID)
)
ENGINE = INNODB,
AVG_ROW_LENGTH = 16384,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Dumping data for table users
--
-- Table aesira_hat.users does not contain any data (it is empty)

--
-- Dumping data for table groups
--
INSERT INTO groups VALUES
(99, 'Owner', 1);
