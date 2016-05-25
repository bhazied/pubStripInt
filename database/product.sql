
CREATE TABLE IF NOT EXISTS `product` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(320) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `duration` smallint(5) unsigned NOT NULL,
  `stripe_reference` varchar(50) COLLATE utf8_unicode_ci  NULL,
  `status` enum('Draft','Online','Deactivated','Offline','Deleted','Archived') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Draft',
  `created_at` datetime NOT NULL COMMENT '{"order":"desc"}',
  `creator_user_id` mediumint(8) unsigned NOT NULL COMMENT '{"prefix":"creator_"}',
  `modified_at` datetime DEFAULT NULL,
  `modifier_user_id` mediumint(8) unsigned DEFAULT NULL COMMENT '{"prefix":"modifier_"}',
  PRIMARY KEY (`id`),
  KEY `creator_user_id` (`creator_user_id`),
  KEY `modifier_user_id` (`modifier_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='{"grp":"Billing","pstn":2,"rls":["ADM"]}' AUTO_INCREMENT=26 ;


ALTER TABLE `product`
  ADD CONSTRAINT `product_fk1` FOREIGN KEY (`creator_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `product_fk2` FOREIGN KEY (`modifier_user_id`) REFERENCES `user` (`id`);

ALTER TABLE `payment` ADD `product_id` SMALLINT UNSIGNED NOT NULL AFTER `is_valid` ,
ADD `start_date` DATETIME NULL AFTER `product_id` ,
ADD `end_date` DATETIME NULL AFTER `start_date` ,
ADD INDEX ( `product_id` ) ;

ALTER TABLE `payment` ADD CONSTRAINT `payment_fk3` FOREIGN KEY ( `product_id` ) REFERENCES `publipr`.`product` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;
