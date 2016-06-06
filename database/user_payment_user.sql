CREATE TABLE `user_payment_plan` (
 `user_id` mediumint(8) unsigned NOT NULL,
 `payment_plan_id` int(10) unsigned NOT NULL,
 `status` enum('active','dsable') NOT NULL,
 `created_at` datetime NOT NULL COMMENT '{"order":"desc"}',
 `modified_at` datetime NOT NULL,
 `close_date` datetime NOT NULL,
 KEY `user_id` (`user_id`),
 KEY `payment_plan_id` (`payment_plan_id`),
 CONSTRAINT `user_payment_plan_ibfk_1` FOREIGN KEY (`payment_plan_id`) REFERENCES `payment_plan` (`id`),
 CONSTRAINT `user_payment_plan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET= utf8_unicode_ci COMMENT='{"grp":"Billing","pstn":3,"rls":["ADM"]}'

ALTER TABLE  `user_payment_plan` ADD  `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ;

