CREATE TABLE `payment_plan` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(20) NOT NULL,
 `stripe_reference` varchar(50) NOT NULL,
 `amount` float NOT NULL,
 `interval` varchar(50) NOT NULL,
 `interval_count` int(10) NOT NULL,
 `status` enum('active','disabled') NOT NULL,
 `creator_user_id` mediumint(8) unsigned NOT NULL COMMENT '{"prefix":"creator_"}',
 `created_at` datetime NOT NULL COMMENT '{"order":"desc"}',
 `modifier_user_id` mediumint(8) unsigned NOT NULL COMMENT '{"prefix":"modifier_"}',
 `modified_at` datetime NOT NULL,
 PRIMARY KEY (`id`),
 KEY `creator_user_id` (`creator_user_id`),
 KEY `modifier_user_id` (`modifier_user_id`),
 CONSTRAINT `payment_plan_ibfk_1` FOREIGN KEY (`creator_user_id`) REFERENCES `user` (`id`),
 CONSTRAINT `payment_plan_ibfk_2` FOREIGN KEY (`modifier_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  COMMENT='{"grp":"Billing","pstn":3,"rls":["ADM"]}'

ALTER TABLE `payment_plan` CHANGE `status` `status` ENUM( 'Active', 'Disabled' ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ;

ALTER TABLE  `payment_plan` CHANGE  `modifier_user_id`  `modifier_user_id` MEDIUMINT( 8 ) UNSIGNED NULL COMMENT  '{"prefix":"modifier_"}',
CHANGE  `modified_at`  `modified_at` DATETIME NULL ;
