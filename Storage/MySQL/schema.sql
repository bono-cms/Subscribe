
DROP TABLE IF EXISTS `bono_module_subscribers`;
CREATE TABLE `bono_module_subscribers` (
	
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`langId` INT NOT NULL,
	`email` varchar(250) NOT NULL,
	`timestamp` INT(10) NOT NULL,
	`active` varchar(1) NOT NULL
	
) DEFAULT CHARSET=UTF8;


DROP TABLE IF EXISTS `bono_module_subscribers_history`;
CREATE TABLE `bono_module_subscribers_history` (
	
	`email` varchar(250) NOT NULL PRIMARY KEY,
	`timestamp` INT(10) NOT NULL
	
) DEFAULT CHARSET=UTF8;