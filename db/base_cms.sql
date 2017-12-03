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
  `type` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),  
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `type`)
VALUES
  (1, 'Juan', 'Perez', 'test@mail.com', 0),
  (2, 'Cristian', 'Martinez', 'alumno@mail.com', 1),
  (3, 'Sergio', 'Jimenez', 'alumno2@mail.com', 1);




DROP TABLE IF EXISTS `moves`;
DROP TABLE IF EXISTS `materials`;

CREATE TABLE `materials` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `description` text DEFAULT '',  
  `catalog_number` varchar(255) DEFAULT '',  
  `stock_count` int(11) unsigned DEFAULT 0,
  `stock_min` int(11) unsigned DEFAULT 0,
  `stock_max` int(11) unsigned DEFAULT 0,
  `borrowed_count` int(11) unsigned DEFAULT 0,
  `total_count` int(11) unsigned DEFAULT 0,
  `price_per_unit` int(11) unsigned DEFAULT 0,
  `image_path` varchar(255) DEFAULT '',  
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `moves` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_material` int(11) unsigned NOT NULL, 
  `pieces` int(11) unsigned NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  `type` varchar(10) DEFAULT '',
  `no_order` varchar(255) DEFAULT '',
  `description` text DEFAULT '', 
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`), 
  FOREIGN KEY (`id_material`) REFERENCES `materials` (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `loans`;

CREATE TABLE `loans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_student` int(11) unsigned NOT NULL,
  `id_employee` int(11) unsigned DEFAULT NULL,
  `status` varchar(10) DEFAULT '',  
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `loan_materials`;

CREATE TABLE `loan_materials` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_loan` int(11) unsigned NOT NULL,     
  `id_material` int(11) unsigned NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `returned_amount` int(11) unsigned NOT NULL,
  `description` text DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_loan_id_materialx` (`id_loan`,`id_material`),
  UNIQUE KEY `id_material_id_loanx` (`id_material`, `id_loan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;