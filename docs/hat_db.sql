-- Table `users`
CREATE TABLE users (
  userID INT(11) NOT NULL AUTO_INCREMENT,
  userName VARCHAR(255) NOT NULL,
  userPass VARCHAR(255) NOT NULL,
  userEmail VARCHAR(255) NOT NULL,
  userAcctID INT(8) DEFAULT NULL,
  userGroupID INT(2) NOT NULL,
  userLastLogin DATE DEFAULT NULL,
  userDisableLogin TINYINT(1) NOT NULL,
  PRIMARY KEY (userID)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

-- Table `groups`
CREATE TABLE groups (
  groupID INT(2) NOT NULL,
  groupName VARCHAR(80) DEFAULT NULL,
  viewAccounts TINYINT(1) DEFAULT 0,
  viewAdmins TINYINT(1) DEFAULT 0,
  PRIMARY KEY (groupID)
)
ENGINE = INNODB,
AVG_ROW_LENGTH = 16384,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

INSERT INTO groups VALUES
(1, 'Game Master', 1, 0),
(99, 'Owner', 1, 1);

-- Table `settings`
CREATE TABLE settings (
  settingName VARCHAR(255) NOT NULL,
  settingValue VARCHAR(255) NOT NULL,
  settingDesc VARCHAR(255) NOT NULL,
  PRIMARY KEY (settingName)
)
ENGINE = INNODB,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

INSERT INTO settings VALUES
('newUserPassLength', '15', 'The length of the randomly generated password for any new user (admin or player) generated through the panel.');
