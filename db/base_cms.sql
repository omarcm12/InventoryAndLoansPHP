# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.23)
# Database: base
# ************************************************************

/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',  
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,  
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),  
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `materials`;

CREATE TABLE `materials` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `description`  varchar(255) DEFAULT '',  
  `catalog_number` varchar(255) DEFAULT '',  
  `stock_count` int(11) unsigned DEFAULT 0,
  `borrowed_count` int(11) unsigned DEFAULT 0,
  `total_count` int(11) unsigned DEFAULT 0,
  `price_per_unit` int(11) unsigned DEFAULT 0,
  `image_path` varchar(255) DEFAULT '',  
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;