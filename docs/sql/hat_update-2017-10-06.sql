-- HAT Table update.
-- 2017-10-06 @ 14:31 UTC

ALTER TABLE `hat_herc_login` ADD PRIMARY KEY(`account_id`);

ALTER TABLE `hat_accteditlog` CHANGE `old_value` `old_value` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;