
DROP TABLE IF EXISTS `bono_module_subscribers`;
CREATE TABLE `bono_module_subscribers` (
	
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`lang_id` INT NOT NULL,
    `name` varchar(100) NOT NULL,
	`email` varchar(250) NOT NULL,
	`timestamp` INT(10) NOT NULL,
	`active` varchar(1) NOT NULL,
    `key` varchar(32) NOT NULL COMMENT 'Unique key for this email. Used to confirm an email or to unsubscribe'
	
) DEFAULT CHARSET=UTF8;
