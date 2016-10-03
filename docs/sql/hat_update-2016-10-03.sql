-- HAT Table update.
-- 2016-10-03 @ 19:52 UTC

ALTER TABLE `hat_users`
	ADD `vacation` TINYINT(1) NOT NULL DEFAULT 0,
	ADD `vacationsince` DATETIME NULL;


