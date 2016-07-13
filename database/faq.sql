CREATE TABLE `faq` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `question` text NOT NULL,
 `response` text NOT NULL,
 `creator_user_id` mediumint(8) unsigned NOT NULL,
 `created_at` datetime NOT NULL,
 `modifier_user_id` mediumint(8) unsigned DEFAULT NULL,
 `modified_at` datetime DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='{"grp":"Settings","pstn":0,"rls":["ADM"]}'


ALTER TABLE  `faq` ADD FOREIGN KEY (  `creator_user_id` ) REFERENCES  `publipr`.`user` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `faq` ADD FOREIGN KEY (  `modifier_user_id` ) REFERENCES  `publipr`.`user` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;