-- HAT Table update.
-- 2019-01-12 @ 14:31 UTC

ALTER TABLE `hat_adminnews`
	ADD `pinned` TINYINT(1) NOT NULL DEFAULT 0;