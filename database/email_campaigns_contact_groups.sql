CREATE TABLE `email_campaigns_contact_groups` (
 `email_campaign_id` int(10) unsigned NOT NULL,
 `contact_group_id` mediumint(8) unsigned NOT NULL,
 PRIMARY KEY (`email_campaign_id`,`contact_group_id`),
 KEY `email_campaign_id` (`email_campaign_id`,`contact_group_id`),
 KEY `contact_group_id_fk2` (`contact_group_id`),
 CONSTRAINT `contact_group_id_fk2` FOREIGN KEY (`contact_group_id`) REFERENCES `contact_group` (`id`),
 CONSTRAINT `email_campaign_id_fk1` FOREIGN KEY (`email_campaign_id`) REFERENCES `email_campaign` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci