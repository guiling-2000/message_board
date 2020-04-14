DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
	`username` varchar(20) NOT NULL DEFAULT '',
	`password` varchar(32) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `message_board`;
CREATE TABLE `message_board`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
	`name` varchar(20) NOT NULl DEFAULT '',
	`content` text NOT NULl DEFAULT '',
	`message_time` date DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;