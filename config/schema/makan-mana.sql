/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.13-MariaDB : Database - makan_mana
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`makan_mana` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `makan_mana`;

/*Table structure for table `cuisines` */

DROP TABLE IF EXISTS `cuisines`;

CREATE TABLE `cuisines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cuisines` */

insert  into `cuisines`(`id`,`name`,`description`) values 
(2,'All Day Dining\r',NULL),
(3,'Arabic\r',NULL),
(4,'Asian\r',NULL),
(5,'Australian\r',NULL),
(6,'Bar\r',NULL),
(7,'British\r',NULL),
(8,'Cantonese\r',NULL),
(9,'Chinese\r',NULL),
(10,'Cigar Divan\r',NULL),
(11,'ELITE\r',NULL),
(12,'European\r',NULL),
(13,'French\r',NULL),
(14,'Fusion\r',NULL),
(15,'German\r',NULL),
(16,'Grill\r',NULL),
(17,'Indian\r',NULL),
(18,'Indochinese\r',NULL),
(19,'Indonesian\r',NULL),
(20,'International\r',NULL),
(21,'Italian\r',NULL),
(22,'Japanese\r',NULL),
(23,'Japanese Tapas\r',NULL),
(24,'Japanese Yakitori\r',NULL),
(25,'Korean\r',NULL),
(26,'Latin American\r',NULL),
(27,'Local\r',NULL),
(28,'Malacca Portuguese\r',NULL),
(29,'Malay\r',NULL),
(30,'Mediterranean\r',NULL),
(31,'Mexican\r',NULL),
(32,'Middle Eastern\r',NULL),
(33,'Nyonya\r',NULL),
(34,'Pakistani\r',NULL),
(35,'Pub\r',NULL),
(36,'Seafood\r',NULL),
(37,'Southeast Asian\r',NULL),
(38,'Southern Indian\r',NULL),
(39,'Spanish\r',NULL),
(40,'Sri Lankan\r',NULL),
(41,'Steakhouse\r',NULL),
(42,'Steamboat\r',NULL),
(43,'Taiwanese\r',NULL),
(44,'Teo Chew\r',NULL),
(45,'Thai\r',NULL),
(46,'Vietnamese\r',NULL),
(47,'Western\r',NULL);

/*Table structure for table `menu_categories` */

DROP TABLE IF EXISTS `menu_categories`;

CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu_categories` */

insert  into `menu_categories`(`id`,`name`,`order`,`created`,`modified`) values 
(1,'Tea Selection',0,'2020-07-31 17:59:52',NULL);

/*Table structure for table `menu_items` */

DROP TABLE IF EXISTS `menu_items`;

CREATE TABLE `menu_items` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `order` int(2) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`int`),
  KEY `menu_key` (`menu_id`),
  CONSTRAINT `menu_key` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu_items` */

insert  into `menu_items`(`int`,`name`,`description`,`price`,`order`,`menu_id`,`created`,`modified`) values 
(1,'Green Tea','Lorem ipsum asdasd asdasd ',10.00,0,1,NULL,NULL),
(2,'Black Tea','asdasd asdadasd sdasdasdasds',11.50,1,1,NULL,NULL);

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `menu_category_id` int(11) NOT NULL,
  `order` int(2) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_category_key` (`menu_category_id`),
  KEY `menu_restaurant_key` (`restaurant_id`),
  CONSTRAINT `menu_category_key` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_categories` (`id`),
  CONSTRAINT `menu_restaurant_key` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`description`,`restaurant_id`,`menu_category_id`,`order`,`created`,`modified`) values 
(1,'Afternoon Tea Menu','Lorem Ipsum 123',1,1,0,'2020-07-31 17:59:08',NULL);

/*Table structure for table `reservations` */

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `total_guests` int(2) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `reservations` */

/*Table structure for table `restaurant_cuisines` */

DROP TABLE IF EXISTS `restaurant_cuisines`;

CREATE TABLE `restaurant_cuisines` (
  `restaurant_id` int(11) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  KEY `cuisine_key` (`cuisine_id`),
  KEY `restaurant_key` (`restaurant_id`),
  CONSTRAINT `cuisine_key` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisines` (`id`),
  CONSTRAINT `restaurant_key` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurant_cuisines` */

insert  into `restaurant_cuisines`(`restaurant_id`,`cuisine_id`) values 
(1,3),
(1,4);

/*Table structure for table `restaurant_galleries` */

DROP TABLE IF EXISTS `restaurant_galleries`;

CREATE TABLE `restaurant_galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_restaurant_key` (`restaurant_id`),
  CONSTRAINT `gallery_restaurant_key` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurant_galleries` */

/*Table structure for table `restaurant_tables` */

DROP TABLE IF EXISTS `restaurant_tables`;

CREATE TABLE `restaurant_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `total_seats` int(2) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `table_restaurant_key` (`restaurant_id`),
  CONSTRAINT `table_restaurant_key` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurant_tables` */

/*Table structure for table `restaurants` */

DROP TABLE IF EXISTS `restaurants`;

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_line_1` varchar(150) NOT NULL,
  `address_line_2` varchar(150) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `website` varchar(150) DEFAULT NULL,
  `operating_hours` text NOT NULL,
  `price_range` float(10,2) NOT NULL,
  `payment_options` text NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurants` */

insert  into `restaurants`(`id`,`name`,`description`,`user_id`,`address_line_1`,`address_line_2`,`contact_no`,`website`,`operating_hours`,`price_range`,`payment_options`,`created`,`modified`) values 
(1,'Restaurant A','asdasdas\r\nasdasdasd',1,'','','',NULL,'',0.00,'',NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modifief` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`email`,`password`,`created`,`modifief`) values 
(1,'Syauqi','Jamil','syauqi.j@gmail.com','5','2020-08-01 09:15:20',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
