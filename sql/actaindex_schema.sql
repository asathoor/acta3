-- Adminer 3.3.3 MySQL dump
-- The actaindex database schema

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `articles_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8_bin NOT NULL,
  `vol` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `page` int(11) NOT NULL,
  PRIMARY KEY (`articles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `authors_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(100) COLLATE utf8_bin NOT NULL,
  `grad` varchar(100) COLLATE utf8_bin NOT NULL,
  `titel` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`authors_id`),
  KEY `authors_id` (`authors_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='authors';


DROP TABLE IF EXISTS `contains`;
CREATE TABLE `contains` (
  `contains_id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) NOT NULL,
  `indexes_id` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  PRIMARY KEY (`contains_id`),
  KEY `indexes_id` (`indexes_id`),
  KEY `contains_id` (`contains_id`),
  KEY `articles_id` (`articles_id`),
  CONSTRAINT `contains_to_articles` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`articles_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contains_to_index` FOREIGN KEY (`indexes_id`) REFERENCES `indexes` (`indexes_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `indexes`;
CREATE TABLE `indexes` (
  `indexes_id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`indexes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `skriver`;
CREATE TABLE `skriver` (
  `skriver_id` int(11) NOT NULL AUTO_INCREMENT,
  `authors_id` int(11) NOT NULL,
  `articles_id` int(11) NOT NULL,
  PRIMARY KEY (`skriver_id`),
  KEY `authors_id` (`authors_id`),
  KEY `articles_id` (`articles_id`),
  CONSTRAINT `skriverArticles` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`articles_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `skriverAuthor` FOREIGN KEY (`authors_id`) REFERENCES `authors` (`authors_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP VIEW IF EXISTS `authorArticle`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `authorArticle` AS select `articles`.`articles_id` AS `articles_id`,`articles`.`title` AS `title`,`articles`.`vol` AS `vol`,`articles`.`page` AS `pp`,`articles`.`year` AS `year`,`authors`.`authors_id` AS `authors_id`,`authors`.`firstname` AS `firstname`,`authors`.`lastname` AS `lastname`,`authors`.`grad` AS `grad`,`authors`.`titel` AS `titel` from ((`articles` join `authors`) join `skriver`) where ((`skriver`.`authors_id` = `authors`.`authors_id`) and (`skriver`.`articles_id` = `articles`.`articles_id`));

DROP VIEW IF EXISTS `indexes_last_id`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `indexes_last_id` AS select `indexes`.`indexes_id` AS `indexes_id`,`indexes`.`word` AS `word` from `indexes` order by `indexes`.`indexes_id` desc limit 0,1;

DROP VIEW IF EXISTS `word_vol_title_page`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `word_vol_title_page` AS select `indexes`.`word` AS `word`,`articles`.`vol` AS `vol`,`articles`.`year` AS `year`,`contains`.`page` AS `page`,`articles`.`title` AS `title` from ((`articles` join `contains`) join `indexes`) where ((`indexes`.`indexes_id` = `contains`.`indexes_id`) and (`articles`.`articles_id` = `contains`.`articles_id`)) order by `indexes`.`word`,`articles`.`vol`,`articles`.`title`,`contains`.`page`;

-- 2016-07-18 22:12:10
