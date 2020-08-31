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
  `featured` smallint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cuisines` */

insert  into `cuisines`(`id`,`name`,`description`,`featured`,`created`,`modified`) values 
(2,'All Day Dining','Test 123 update',NULL,'2020-07-01 00:00:00','2020-08-29 13:30:56'),
(3,'Arabic','test 123',NULL,'2020-07-01 00:00:00',NULL),
(4,'Asian\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(5,'Australian\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(6,'Bar\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(7,'British\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(8,'Cantonese\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(9,'Chinese\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(10,'Cigar Divan\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(11,'ELITE\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(12,'European\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(13,'French\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(14,'Fusion\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(15,'German\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(16,'Grill\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(17,'Indian\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(18,'Indochinese\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(19,'Indonesian\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(20,'International\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(21,'Italian\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(22,'Japanese\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(23,'Japanese Tapas\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(24,'Japanese Yakitori\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(25,'Korean\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(26,'Latin American\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(27,'Local\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(28,'Malacca Portuguese\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(29,'Malay\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(30,'Mediterranean\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(31,'Mexican\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(32,'Middle Eastern\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(33,'Nyonya\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(34,'Pakistani\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(35,'Pub\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(36,'Seafood\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(37,'Southeast Asian\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(38,'Southern Indian\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(39,'Spanish\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(40,'Sri Lankan\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(41,'Steakhouse\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(42,'Steamboat\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(43,'Taiwanese\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(44,'Teo Chew\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(45,'Thai\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(46,'Vietnamese\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(47,'Western\r',NULL,NULL,'2020-07-01 00:00:00',NULL),
(64,'Tea','',NULL,'2020-08-31 21:11:11','2020-08-31 21:11:11');

/*Table structure for table `menu_categories` */

DROP TABLE IF EXISTS `menu_categories`;

CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sequence` int(2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu_categories` */

insert  into `menu_categories`(`id`,`name`,`sequence`,`created`,`modified`) values 
(1,'Main Menu',1,'2020-08-19 01:37:17','2020-08-29 11:13:12'),
(2,'Breakfast',2,'2020-08-19 03:36:07','2020-08-29 11:46:11'),
(3,'Drink Menu',2,'2020-08-21 14:21:46',NULL);

/*Table structure for table `menu_items` */

DROP TABLE IF EXISTS `menu_items`;

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sequence` int(2) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_key` (`menu_id`),
  CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu_items` */

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `menu_category_id` int(11) NOT NULL,
  `sequence` int(2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_category_key` (`menu_category_id`),
  KEY `menu_restaurant_key` (`restaurant_id`),
  CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`),
  CONSTRAINT `menus_ibfk_2` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `menus` */

/*Table structure for table `reservations` */

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE `reservations` (
  `id` char(36) NOT NULL,
  `status` enum('pending','declined','cancelled','completed','accepted') NOT NULL DEFAULT 'pending',
  `phone_no` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `total_guests` int(2) NOT NULL,
  `reserved_date` datetime NOT NULL,
  `occasion` varchar(50) DEFAULT NULL,
  `request` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `restaurant_id` (`restaurant_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `reservations` */

insert  into `reservations`(`id`,`status`,`phone_no`,`user_id`,`restaurant_id`,`total_guests`,`reserved_date`,`occasion`,`request`,`created`,`modified`) values 
('006fcec6-ee1b-49c1-baba-0149f1eab95d','accepted','0182569784',4,2,2,'2020-08-30 07:30:00','birthday','Fridge to temporarily store the cake','2020-08-30 07:08:52','2020-08-30 07:08:52'),
('11977184-4d97-4d72-bb82-ae21c553f529','pending','01123123123',4,3,2,'2020-08-30 07:00:00','','','2020-08-30 06:43:48','2020-08-30 06:43:48'),
('3cca30df-146c-4c02-ac3b-a46b8b090840','pending','01231231234',6,3,2,'2020-08-29 19:00:00','','','2020-08-29 18:44:49','2020-08-29 18:44:49'),
('4243d66a-356f-4b3a-b82a-b661a9a88e74','pending','01123123123',4,3,2,'2020-09-05 19:45:00','birthday','qwe','2020-08-31 02:18:29','2020-08-31 02:18:29'),
('5295704f-7bdb-48e0-af8c-4864a32a23ae','pending','0182569784',7,3,2,'2020-09-04 20:00:00','anniversary','','2020-08-30 11:08:19','2020-08-31 02:20:04'),
('59ceb5c8-eedd-4cee-8e02-8797bdeb86cc','pending','0182569784',4,2,10,'2020-08-30 13:30:00','birthday','Fridge to temporarily store the cake','2020-08-30 07:11:30','2020-08-30 07:11:30'),
('77911ee7-12b2-44c8-b3e9-0824874a6466','accepted','9182569784',4,2,2,'2020-08-30 07:15:00','birthday','Fridge to temporarily store the cake','2020-08-30 07:05:07','2020-08-30 07:05:07'),
('d9c2feca-0878-4b22-8b54-0a3f17df2879','cancelled','0182569784',7,2,2,'2020-08-30 13:45:00','birthday','Fridge to temporarily store the cake','2020-08-30 07:27:35','2020-08-30 07:27:35');

/*Table structure for table `restaurant_cuisines` */

DROP TABLE IF EXISTS `restaurant_cuisines`;

CREATE TABLE `restaurant_cuisines` (
  `restaurant_id` int(11) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  PRIMARY KEY (`restaurant_id`,`cuisine_id`),
  KEY `cuisine_key` (`cuisine_id`),
  KEY `restaurant_key` (`restaurant_id`),
  CONSTRAINT `restaurant_cuisines_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`),
  CONSTRAINT `restaurant_cuisines_ibfk_2` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisines` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurant_cuisines` */

insert  into `restaurant_cuisines`(`restaurant_id`,`cuisine_id`) values 
(2,6),
(2,11),
(2,12),
(2,27),
(3,2),
(3,3),
(9,7),
(9,41),
(10,6),
(10,7),
(11,16),
(11,20),
(11,36),
(12,47);

/*Table structure for table `restaurant_photos` */

DROP TABLE IF EXISTS `restaurant_photos`;

CREATE TABLE `restaurant_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_restaurant_key` (`restaurant_id`),
  CONSTRAINT `restaurant_photos_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurant_photos` */

insert  into `restaurant_photos`(`id`,`restaurant_id`,`name`,`image_file`,`created`,`modified`) values 
(12,9,'success','Annotation-2020-08-29-162659.jpg','2020-08-29 18:30:22','2020-08-29 18:30:22'),
(13,9,'success','Annotation-2020-08-29-165001.jpg','2020-08-29 18:30:22','2020-08-29 18:30:22'),
(17,9,'success','Annotation-2020-08-29-175518.jpg','2020-08-29 18:30:23','2020-08-29 18:30:23'),
(18,3,'success','kulwh-yen-0433-hor-clsc.jpg','2020-08-29 19:00:19','2020-08-29 19:00:19'),
(19,3,'success','kulwh-yen-0434-hor-clsc.jpg','2020-08-29 19:00:20','2020-08-29 19:00:20');

/*Table structure for table `restaurants` */

DROP TABLE IF EXISTS `restaurants`;

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_line_1` varchar(150) NOT NULL,
  `address_line_2` varchar(150) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `website` varchar(150) NOT NULL,
  `operation_hours` tinytext NOT NULL,
  `price_range` decimal(8,2) NOT NULL,
  `payment_options` varchar(100) NOT NULL,
  `image_file` varchar(150) NOT NULL,
  `status` enum('pending','active','featured','disabled') NOT NULL DEFAULT 'pending',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurants` */

insert  into `restaurants`(`id`,`name`,`slug`,`description`,`user_id`,`address_line_1`,`address_line_2`,`postcode`,`city`,`state`,`contact_no`,`website`,`operation_hours`,`price_range`,`payment_options`,`image_file`,`status`,`created`,`modified`) values 
(2,'WET Deck - W Kuala Lumpur 2','wet-deck-w-kuala-lumpur','Get lost in a daydream at WET Deck, W Kuala Lumpur. We are back, opening our doors again on 17/06 with a brand new summer menu. An all new, al-fresco dining experience awaits at your favourite downtown spot, featuring a playful twist of sustainable flavours from Flock to your favourite sundowner cocktails by our mixologists. Rest assured we are guided with the ‘new-norm’ procedures so swing by in your sexiest smart casual while enjoying the breathtaking views of the Kuala Lumpur skyline.',2,'No. 121,','Jalan Ampang','50450','Kuala Lumpur','Kuala Lumpur','012-347 9088','https://www.marriott.com/hotels/hotel-information/restaurant/kulwh-w-kuala-lumpur/','Daily: 10:00 am - 12:00 pm',100.00,'AMEX, Carte Blanche, MasterCard, Visa','7804-wet-deck-at-w-hotel-kuala-lumpur.jpg','featured','2020-08-22 07:59:10','2020-08-30 06:50:09'),
(3,'Flock - W Kuala Lumpur','flock-w-kuala-lumpur','In our energetic all-day dining restaurant, chefs prepare local specialties and Western favorites with dazzling performances in live kitchens. Select from a gourmet buffet at breakfast, and indulge in our free-flowing champagne brunch on weekends.',3,'121','Jalan Ampang','50450','Kuala Lumpur','Kuala Lumpur','012-347 9088','https://www.marriott.com/hotels/hotel-information/restaurant/kulwh-w-kuala-lumpur/','Tue - Sun: 10:00 am - 11:00 pm\r\nClosed on Mondays',100.00,'AMEX, JCB, MasterCard, Visa','26171807.jpg','featured','2020-08-22 13:27:44','2020-08-30 06:49:59'),
(9,'Emily Steakhouse Kuala Lumpur','Emily-s-Steakhouse-Kuala-Lumpur','Emily serving the finest steaks in Derby, UK since 2007, best kept secret specializing in Aged Aberdeen Angus finest steak and seafood with a friendly atmosphere.\r\nIt is fitting for Emily to open her very next restaurant in her home country Malaysia. With an open invitation by the Malaysian government to bring home knowledge and expertise acquired from around the world, Emily believes it is apt to bring to Malaysia a real taste of Britain serving classic hot English breakfast, fish & chips, and char-grilled steaks.',2,'Ground Floor, Sheraton Imperial Kuala Lumpur','Jalan Sultan Ismail','50250','Kuala Lumpur','Kuala Lumpur','60132106884','http://www.emilys.biz/','Daily: 11:00 am - 11:00 pm',30.00,'eWallet, MasterCard, Visa, AMEX','Annotation-2020-08-29-162659.jpg','featured','2020-08-29 16:31:14','2020-08-31 21:11:44'),
(10,'The Lounge at Four Seasons Hotel Kuala Lumpur','The-Lounge-at-Four-Seasons-Hotel-Kuala-Lumpur','An ultimate destination to see and be seen. An homage to classic hotel lounge fare sits comfortably next to a menu of Malaysian signature dishes that combine authentic flavours with presentation in a contemporary way. Be spoke afternoon tea, the classic indulgence where a truly personalized experience can be found.',10,'Four Seasons Hotel Kuala Lumpur',' 145 Jalan Ampang','50450','Kuala Lumpur','Kuala Lumpur','0323828650','http://www.fourseasons.com/kualalumpur/dining/lounges/lobby-lounge/','Tue - Sun: 10:00 am - 11:00 pm\r\nClosed on Mondays',100.00,'eWallet, MasterCard, Visa, AMEX','26155475.jpg','featured','2020-08-31 20:57:05','2020-08-31 20:57:05'),
(11,'The Beach Grill & Bar - The Ritz-Carlton, Langkawi','The-Beach-Grill-Bar-The-Ritz-Carlton-Langkawi','The focal point inside the stunning dining venue is an open wood grill that sizzles with freshly caught lobsters, prawns and fish delivered daily by local fishermen. Catering to every taste, the menu includes also Western favorites from crunchy salads, to freshly baked pastries to hearty steaks. The bar tempts with fresh tropical juices, chilled beer and an exciting selection of locally inspired mocktails & cocktails flavored with tropical herbs and spices.\r\n\r\nAs the sun goes down and the candles are lit, the animated ambiance gives way to a quiet, romantic mood accentuated by mellow lounge music. An ideal setting to savor a fresh seafood bucket, a grilled fish or the occasional treat of caviar and lemon-sprinkled oysters. Accompanied by a glass of perfectly chilled vintage wine - a true revelation!',3,'Jalan Pantai Kok','Teluk Nibung','07000','Langkawi','Kedah','6049524954','http://www.ritzcarlton.com/en/hotels/malaysia/langkawi/dining/beach-grill','Tue - Sun: 10:00 am - 11:00 pm\r\nClosed on Mondays',100.00,'eWallet, MasterCard, Visa, AMEX','25298190.jpg','featured','2020-08-31 21:15:43','2020-08-31 21:15:43'),
(12,'Harley\'s Burgers & Roasters @ Cyberjaya','Harley-s-Burgers-Roasters-Cyberjaya','Inspired by “In-N-Out Burger” of California, we serve delicious burgers that are 100% beef & Crispy Fried Chicken. Our food are made fresh daily from premium ingredients without any food additives or preservatives. ',3,'LG-01&02, Ground Floor','Third Avenue, Jalan Teknokrat 3, Cyber 4','63000','Cyberjaya','Selangor','60306896227','https://www.facebook.com/HarleysMalaysia/','Tue - Sun: 10:00 am - 11:00 pm\r\nClosed on Mondays',50.00,'eWallet, MasterCard, Visa, AMEX','Harleys-Cyberjaya.JPG','featured','2020-08-31 21:21:31','2020-08-31 21:21:31');

/*Table structure for table `saved_restaurants` */

DROP TABLE IF EXISTS `saved_restaurants`;

CREATE TABLE `saved_restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `restaurant_id` (`restaurant_id`),
  CONSTRAINT `saved_restaurants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `saved_restaurants_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `saved_restaurants` */

/*Table structure for table `user_profiles` */

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `phone_no_2` varchar(15) DEFAULT NULL,
  `address_line_1` varchar(150) DEFAULT NULL,
  `address_line_2` varchar(150) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_profiles` */

insert  into `user_profiles`(`id`,`user_id`,`gender`,`phone_no_2`,`address_line_1`,`address_line_2`,`postcode`,`city`,`state`) values 
(1,1,'1','0311111111','130, Jalan Timur 4/2C,','Timur@Enstek','71760','Nilai','Negeri Sembilan'),
(2,5,'0','','1 Jalan KL','Jalan Besar','12312','Bangsar','Kuala Lumpur'),
(3,3,'0','','','','','',''),
(4,4,'1','','130, Jalan Timur 4/2C,','Timur@Enstek','71760','Nilai','Negeri Sembilan'),
(5,2,'','','','','','',''),
(6,7,'1','','','','','','');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `role` enum('member','owner','admin') NOT NULL,
  `image_file` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`email`,`phone_no`,`password`,`token`,`role`,`image_file`,`status`,`created`,`modified`) values 
(1,'Muhamad Syauqi','Jamil','admin@gmail.com','0192569784','$2y$10$tFsbNhQP0NPpMIVA0n2uj.Q164HVZifR9FQfKCX7LVLcaL79e358u','a28bdea25f447aa261fb26c0111166f5009b3e2e','admin','The-Flash-Profile.jpg',1,'2020-08-27 14:44:27','2020-08-31 20:17:09'),
(2,'Owner 1','Syauqi','owner1@gmail.com','0182569123','$2y$10$YkWZnaP4rJe9eNUfYw3ituhMnH3GqsdZJKyH39mDotBRWOa8k0jte','df3c09c78c26dd4e5803fd20d72e5c4d14ff69a0','owner','sub-buzz-23241-1519512766-12.jpg',1,'2020-08-27 15:28:10','2020-08-31 21:18:35'),
(3,'Owner 2','Abli','owner2@gmail.com','0123123123','$2y$10$uzfCrkfRC06FruuK1ZpcReJmSYbUp3anOITJl3aanytPxiV0O4C9u','cf22a9302a5e5344c83de68e3f89cf18f42d3c5b','owner','c6a4645d9f9af45a9c9d7b094c18a47a-portrait-ideas-girl-photos.jpg',1,'2020-08-27 15:43:52','2020-08-31 21:17:40'),
(4,'Member 1','Lili','member1@gmail.com','01123123123','$2y$10$1JPlHvDd7zAyYFUThfR.KuXYBQzKqr4HFEBn5QJ.S81gYG5vk6jZa','020690221620ff692d96eacf9f0e9ba4bf71943b','member','pexels-cottonbro-4709285.jpg',1,'2020-08-27 15:45:07','2020-08-29 16:00:37'),
(5,'Member 2','Sarah','member2@gmail.com','0123123129','$2y$10$E73rLeEWjbFhnjkuXSp6jeMA4F7UcY8.NFkIKboyOzVA1GTcN11fG','5da4d8f0facb50145c950cb4ad263f7369c3f8b0','member','The_Flash_Profile.jpg',1,'2020-08-27 15:57:15','2020-08-29 15:37:14'),
(6,'Member 3','Peter','member3@gmail.com','01231231234','$2y$10$KusocVlSlEtVfn7w41N0SOJ4F5aq2mFndRRtW7eXrZv.BFEV8/Xcq','0c0b8402dab81630ae307775e29f691ffe20665d','member',NULL,1,'2020-08-29 18:35:33','2020-08-29 18:35:33'),
(7,'Muhamad Syauqi','Jamil','syauqi.j@outlook.com','0182569784','$2y$10$Kjs7UvHWfon8SDSbP48u2e68Kz6WPMHiaqe.3wPZs3TJzV26eMPKa','a6c13f09ebaff0620ae19fe80a2c50bf76c4b571','member','The-Flash-Profile.jpg',1,'2020-08-30 07:24:12','2020-08-31 20:09:44'),
(10,'Gordon','Ramsay','gordon@gmail.com','012345678910','$2y$10$R268AaWsG2hE8ogZGOhzi.BXQxw7F2JXsxCOsk2prarkxNty0F9Ra','545ef9550b6da0779e737cc45bf2975dbc931af9','owner',NULL,1,'2020-08-31 20:45:57','2020-08-31 20:45:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
