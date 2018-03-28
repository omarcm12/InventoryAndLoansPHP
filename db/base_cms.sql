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

DROP TABLE IF EXISTS `students`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',  
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,  
  `type` int(11) unsigned NOT NULL,
  `carrer` varchar(255) DEFAULT '',  
  `status` int(11) unsigned DEFAULT 1,
  `semester` int(11) unsigned DEFAULT 0,
  `enrollment` int(11) unsigned DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),  
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `type`,`carrer`,`status`, `semester`,`enrollment`)
VALUES
  (1, 'Juan', 'Perez', 'test@mail.com', 0,'empleado',1,0,12123),
  (2, 'Jose', 'Sanchez', 'alumno@mail.com', 1,'Ing Quimica',1, 4, 12321),
  (3, 'Sergio', 'Ramirez', 'alumno2@mail.com', 1,'Quimico Farmacobiologo',1, 6, 231234);

/*
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id_student` int(11) unsigned DEFAULT 0,
  `carrer` varchar(255) DEFAULT '',  
  `semester` int(11) unsigned DEFAULT 0,
  `enrollment` int(11) unsigned DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_student`),
  FOREIGN KEY (`id_student`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `students` (`id_student`, `carrer`, `semester`,`enrollment` )
VALUES
  (2, 'Ing Quimica', 4, 12321),
  (3, 'Quimico Farmacobiologo', 6, 231234);
*/
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
  `num_employee` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `days` int(11) unsigned DEFAULT 0,
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
  `id_employee_deliver` int(11) unsigned DEFAULT NULL,
  `id_employee_return` int(11) unsigned DEFAULT NULL,
  `status` varchar(10) DEFAULT '',  
  `deliver_at` timestamp NULL DEFAULT NULL,
  `return_at` timestamp NULL DEFAULT NULL,
  `request_at` timestamp NULL DEFAULT NULL,
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
  `deliver_at` timestamp NULL DEFAULT NULL,
  `return_at` timestamp NULL DEFAULT NULL,
  `returned_amount` int(11) unsigned NOT NULL,
  `description` text DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_loan_id_materialx` (`id_loan`,`id_material`),
  UNIQUE KEY `id_material_id_loanx` (`id_material`, `id_loan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `move_loans`;
CREATE TABLE `move_loans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_loan` int(11) unsigned NOT NULL, 
  `id_student` int(11) unsigned NOT NULL,
  `id_user` int(11) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `move_loan_materials`;
CREATE TABLE `move_loan_materials` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_move_loan` int(11) unsigned NOT NULL,     
  `id_material` int(11) unsigned NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `penalty_materials`;

CREATE TABLE `penalty_materials` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_material` int(11) unsigned NOT NULL,
  `id_loan_material` int(11) unsigned NOT NULL,
  `id_student` int(11) unsigned NOT NULL, 
  `amount` int(11) unsigned NOT NULL,
  `pieces` int(11) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL,   
  `days` int(11) unsigned NOT NULL,            
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_penalty` int(11) unsigned NOT NULL,
  `id_student` int(11) unsigned NOT NULL,
  `id_employee` int(11) unsigned NOT NULL,
  `description` text DEFAULT '', 
  `amount` int(11) unsigned NOT NULL,
  `amount_payd` int(11) unsigned NOT NULL,              
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `configurations`;

CREATE TABLE `configurations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `days_loan` int(11) unsigned NOT NULL,     
  `days_price` int(11) unsigned NOT NULL,
  `days_expired_loan` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `configurations` (`id`, `days_loan`, `days_price`, `days_expired_loan`)
VALUES
  (1, 3, 4, 2);
