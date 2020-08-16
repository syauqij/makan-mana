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

/*Table structure for table `business_hours` */

DROP TABLE IF EXISTS `business_hours`;

CREATE TABLE `business_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `day_of_week` int(1) NOT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hours_restaurant_key` (`restaurant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `business_hours` */

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ori_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `iso2` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` int(4) unsigned NOT NULL DEFAULT 0,
  `eu_member` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT 'Member of the EU',
  `special` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `zip_length` tinyint(2) unsigned NOT NULL DEFAULT 0 COMMENT 'if > 0 validate on this length',
  `zip_regexp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT 0,
  `lat` float(10,6) NOT NULL DEFAULT 0.000000 COMMENT 'forGoogleMap',
  `lng` float(10,6) NOT NULL DEFAULT 0.000000 COMMENT 'forGoogleMap',
  `address_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=246 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `countries` */

insert  into `countries`(`id`,`name`,`ori_name`,`iso2`,`iso3`,`country_code`,`eu_member`,`special`,`zip_length`,`zip_regexp`,`sort`,`lat`,`lng`,`address_format`,`status`,`modified`) values 
(1,'Deutschland','Deutschland','DE','DEU',49,1,'',5,'',3,51.165691,10.451526,':name :street_address D-:postcode :city :country',1,'2010-06-06 00:19:04'),
(2,'Österreich','Österreich','AT','AUT',43,1,'',0,'',2,47.516232,14.550072,'',1,'2010-06-06 00:19:04'),
(3,'Schweiz','Schweiz','CH','CHE',41,0,'',0,'',1,46.818188,8.227512,'',1,'2010-06-06 00:19:04'),
(4,'Belgien','Belgium','BE','BEL',32,1,'',0,'',0,50.503887,4.469936,'',1,'2010-06-06 00:19:09'),
(5,'Niederlande','Netherlands','NL','NLD',31,1,'',0,'',0,52.132633,5.291266,'',1,'2010-06-06 00:19:40'),
(6,'Dänemark','Denmark','DK','DNK',45,1,'',0,'',0,56.263920,9.501785,'',1,'2010-06-06 00:19:14'),
(7,'Luxemburg','Luxembourg','LU','LUX',352,1,'',0,'',0,49.815273,6.129583,'',1,'2010-06-06 00:19:34'),
(8,'Frankreich','France','FR','FRA',33,1,'',0,'',0,46.227638,2.213749,'',1,'2010-06-06 00:19:17'),
(9,'Großbritannien','United Kingdom (Great Britian)','GB','GBR',44,1,'',0,'',0,55.378052,-3.435973,'',1,'2010-06-06 00:19:19'),
(12,'Ukraine','Ukraine','UA','UKR',380,1,'',0,'',0,48.379433,31.165581,'',1,'2010-06-06 00:19:57'),
(13,'Bulgarien','Bulgaria','BG','BGR',359,1,'',0,'',0,42.733883,25.485830,'',1,'2010-06-06 00:19:12'),
(14,'Estland','Estonia','EE','EST',372,1,'',0,'',0,58.595272,25.013607,'',1,'2010-06-06 00:19:15'),
(15,'Slowenien','Slovenia','SI','SVN',386,1,'',0,'',0,46.151241,14.995463,'',1,'2010-06-06 00:19:50'),
(16,'Slowakei','Slovakia (Slovak Republic)','SK','SVK',421,1,'',0,'',0,48.669025,19.699024,'',1,'2010-06-06 00:19:50'),
(17,'Tschechien','Czech Republic','CZ','CZE',420,1,'',0,'',0,49.817493,15.472962,'',1,'2010-06-06 00:19:55'),
(18,'Portugal','Portugal','PT','PRT',351,1,'',0,'',0,39.399872,-8.224454,'',1,'2010-06-06 00:19:45'),
(19,'Russland','Russian Federation','RU','RUS',7,0,'',0,'',0,61.524010,105.318756,'',1,'2010-06-06 00:19:46'),
(20,'Türkei','Turkey','TR','TUR',90,0,'',0,'',0,38.963745,35.243320,'',1,'2010-06-06 00:19:56'),
(21,'Ungarn','Hungary','HU','HUN',36,1,'',0,'',0,47.162495,19.503304,'',1,'2010-06-06 00:19:57'),
(22,'Norwegen','Norway','NO','NOR',47,0,'',0,'',0,60.472023,8.468946,'',1,'2010-06-06 00:19:42'),
(23,'Schweden','Sweden','SE','SWE',46,1,'',0,'',0,60.128162,18.643501,'',1,'2010-06-06 00:19:48'),
(24,'Irland','Ireland','IE','IRL',353,1,'',0,'',0,53.412910,-8.243890,'',1,'2010-06-06 00:19:23'),
(25,'Italien','Italy','IT','ITA',39,1,'',0,'',0,41.871941,12.567380,'',1,'2010-06-06 00:19:24'),
(26,'Finnland','Finland','FI','FIN',358,1,'',0,'',0,61.924110,25.748152,'',1,'2010-06-06 00:19:16'),
(27,'Polen','Poland','PL','POL',48,1,'',0,'',0,51.919437,19.145136,'',1,'2010-06-06 00:19:45'),
(28,'Litauen','Lithuania','LT','LTU',370,1,'',0,'',0,55.169437,23.881275,'',1,'2010-06-06 00:19:34'),
(29,'Lettland','Latvia','LV','LVA',371,1,'',0,'',0,56.879635,24.603189,'',1,'2010-06-06 00:19:33'),
(30,'Liechtenstein','Liechtenstein','LI','LIE',423,0,'',0,'',0,47.166000,9.555373,'',1,'2010-06-06 00:19:33'),
(31,'USA','United States (of America)','US','USA',1,0,'',0,'',0,37.090240,-95.712891,'',1,'2010-06-06 00:19:58'),
(32,'Rumaenien','Romania','RO','ROM',40,1,'',0,'',0,45.943161,24.966761,'',1,'2010-06-06 00:19:46'),
(33,'SONSTIGE','Other','','',0,0,'',0,'',0,48.022968,8.032690,'',1,'2010-06-06 00:19:51'),
(34,'Aruba','','AW','ABW',0,0,'',0,'',0,12.521110,-69.968338,'',1,'2010-06-06 00:19:07'),
(35,'Afghanistan','','AF','AFG',0,0,'',0,'',0,33.939110,67.709953,'',1,'2010-06-06 00:19:04'),
(36,'Angola','','AO','AGO',0,0,'',0,'',0,-11.202692,17.873886,'',1,'2010-06-06 00:19:06'),
(37,'Anguilla','','AI','AIA',0,0,'',0,'',0,18.220554,-63.068615,'',1,'2010-06-06 00:19:06'),
(39,'Albanien','','AL','ALB',0,0,'',0,'',0,41.153332,20.168331,'',1,'2010-06-06 00:19:05'),
(40,'Andorra','','AD','AND',0,0,'',0,'',0,42.546246,1.601554,'',1,'2010-06-06 00:19:06'),
(41,'Niederländische Antillen','','AN','ANT',0,0,'',0,'',0,12.226079,-69.060089,'',1,'2010-06-06 00:19:41'),
(42,'Vereinigte Arabische Emirate','','AE','ARE',0,0,'',0,'',0,23.424076,53.847816,'',1,'2010-06-06 00:19:59'),
(43,'Argentinien','','AR','ARG',0,0,'',0,'',0,-38.416096,-63.616673,'',1,'2010-06-06 00:19:07'),
(44,'Armenien','','AM','ARM',0,0,'',0,'',0,40.069099,45.038189,'',1,'2010-06-06 00:19:07'),
(45,'Amerikanisch Samoa','','AS','ASM',0,0,'',0,'',0,-14.270972,-170.132217,'',1,'2010-06-06 00:19:05'),
(46,'Antarktis','','AQ','ATA',0,0,'',0,'',0,-75.250977,-0.071389,'',1,'2010-06-06 00:19:06'),
(47,'Französische Südgebiete','','TF','ATF',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:47'),
(48,'Antigua Und Barbuda','','AG','ATG',0,0,'',0,'',0,17.060816,-61.796429,'',1,'2010-06-06 00:19:07'),
(49,'Australien','','AU','AUS',0,0,'',0,'',0,-25.274399,133.775131,'',1,'2010-06-06 00:19:08'),
(50,'Aserbaidschan','','AZ','AZE',0,0,'',0,'',0,40.143105,47.576927,'',1,'2010-06-06 00:19:08'),
(51,'Burundi','','BI','BDI',0,0,'',0,'',0,-3.373056,29.918886,'',1,'2010-06-06 00:19:13'),
(52,'Benin','','BJ','BEN',0,0,'',0,'',0,9.307690,2.315834,'',1,'2010-06-06 00:19:10'),
(53,'Burkina Faso','','BF','BFA',0,0,'',0,'',0,12.238333,-1.561593,'',1,'2010-06-06 00:19:12'),
(54,'Bangladesch','','BD','BGD',0,0,'',0,'',0,23.684994,90.356331,'',1,'2010-06-06 00:19:09'),
(55,'Bahrain','','BH','BHR',0,0,'',0,'',0,25.930414,50.637772,'',1,'2010-06-06 00:19:09'),
(56,'Bahamas','','BS','BHS',0,0,'',0,'',0,25.034281,-77.396278,'',1,'2010-06-06 00:19:08'),
(57,'Bosnien Und Herzegowin','','BA','BIH',0,0,'',0,'',0,43.915886,17.679075,'',1,'2010-06-06 00:19:11'),
(58,'St','','BL','BLM',0,0,'',0,'',0,52.205547,7.544862,'',1,'2010-06-06 00:19:51'),
(59,'Weißrussland','','BY','BLR',0,0,'',0,'',0,53.709808,27.953388,'',1,'2010-06-06 00:19:59'),
(60,'Belize','','BZ','BLZ',0,0,'',0,'',0,17.189877,-88.497650,'',1,'2010-06-06 00:19:09'),
(61,'Bermuda','','BM','BMU',0,0,'',0,'',0,32.321384,-64.757370,'',1,'2010-06-06 00:19:10'),
(62,'Bolivien','','BO','BOL',0,0,'',0,'',0,-16.290154,-63.588654,'',1,'2010-06-06 00:19:10'),
(63,'Brasilien','','BR','BRA',0,0,'',0,'',0,-14.235004,-51.925282,'',1,'2010-06-06 00:19:11'),
(64,'Barbados','','BB','BRB',0,0,'',0,'',0,13.193887,-59.543198,'',1,'2010-06-06 00:19:09'),
(65,'Brunei Darussalam','','BN','BRN',0,0,'',0,'',0,4.535277,114.727669,'',1,'2010-06-06 00:19:12'),
(66,'Bhutan','','BT','BTN',0,0,'',0,'',0,27.514162,90.433601,'',1,'2010-06-06 00:19:10'),
(67,'Bouvetinsel','','BV','BVT',0,0,'',0,'',0,-54.423199,3.413194,'',1,'2010-06-06 00:19:11'),
(68,'Botsuana','','BW','BWA',0,0,'',0,'',0,-22.328474,24.684866,'',1,'2010-06-06 00:19:11'),
(69,'Zentralafrikanische Republik','','CF','CAF',0,0,'',0,'',0,6.611111,20.939444,'',1,'2010-06-06 00:20:00'),
(70,'Kanada','','CA','CAN',0,0,'',0,'',0,56.130367,-106.346771,'',1,'2010-06-06 00:19:26'),
(71,'Kokosinseln','Territory of the Cocos (Keeling) Islands','CC','CCK',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:48'),
(72,'Chile','','CL','CHL',0,0,'',0,'',0,-35.675148,-71.542969,'',1,'2010-06-06 00:19:13'),
(73,'China','','CN','CHN',0,0,'',0,'',0,35.861660,104.195396,'',1,'2010-06-06 00:19:13'),
(74,'Côte D´Ivoire','','CI','CIV',0,0,'',0,'',0,7.539989,-5.547080,'',1,'2010-06-06 00:19:14'),
(75,'Kamerun','','CM','CMR',0,0,'',0,'',0,7.369722,12.354722,'',1,'2010-06-06 00:19:26'),
(76,'Kongo, Dem','','CD','COD',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:48'),
(77,'Kongo','','CG','COG',0,0,'',0,'',0,-0.228021,15.827659,'',1,'2010-06-06 00:19:28'),
(78,'Cookinseln','','CK','COK',0,0,'',0,'',0,-21.236736,-159.777664,'',1,'2010-06-06 00:19:13'),
(79,'Kolumbien','','CO','COL',0,0,'',0,'',0,4.570868,-74.297333,'',1,'2010-06-06 00:19:28'),
(80,'Komoren','','KM','COM',0,0,'',0,'',0,-11.875001,43.872219,'',1,'2010-06-06 00:19:28'),
(81,'Kap Verde','','CV','CPV',0,0,'',0,'',0,16.002083,-24.013197,'',1,'2010-06-06 00:19:26'),
(82,'Costa Rica','','CR','CRI',0,0,'',0,'',0,9.748917,-83.753426,'',1,'2010-06-06 00:19:14'),
(83,'Kuba','','CU','CUB',0,0,'',0,'',0,21.521757,-77.781166,'',1,'2010-06-06 00:19:30'),
(84,'Weihnachtsinsel','','CX','CXR',0,0,'',0,'',0,-10.447525,105.690453,'',1,'2010-06-06 00:19:59'),
(85,'Kaimaninseln','','KY','CYM',0,0,'',0,'',0,19.513470,-80.566956,'',1,'2010-06-06 00:19:25'),
(86,'Zypern','','CY','CYP',0,0,'',0,'',0,35.126411,33.429859,'',1,'2010-06-06 00:20:00'),
(87,'Republik Dschibuti','','DJ','DJI',0,0,'',0,'',0,11.588000,43.145000,'',1,'2010-06-06 00:19:45'),
(88,'Dominica','','DM','DMA',0,0,'',0,'',0,15.414999,-61.370975,'',1,'2010-06-06 00:19:14'),
(89,'Dominikanische Republik','','DO','DOM',0,0,'',0,'',0,18.735693,-70.162651,'',1,'2010-06-06 00:19:14'),
(90,'Algerien','','DZ','DZA',0,0,'',0,'',0,28.033886,1.659626,'',1,'2010-06-06 00:19:05'),
(91,'Ecuador','','EC','ECU',0,0,'',0,'',0,-1.831239,-78.183403,'',1,'2010-06-06 00:19:15'),
(92,'Ägypten','','EG','EGY',0,0,'',0,'',0,26.820553,30.802498,'',1,'2010-06-06 00:19:04'),
(93,'Eritrea','','ER','ERI',0,0,'',0,'',0,15.179384,39.782333,'',1,'2010-06-06 00:19:15'),
(94,'Westsahara','','EH','ESH',0,0,'',0,'',0,24.215527,-12.885834,'',1,'2010-06-06 00:20:00'),
(95,'Spanien','','ES','ESP',0,0,'',0,'',0,40.463669,-3.749220,'',1,'2010-06-06 00:19:51'),
(96,'Äthiopien','','ET','ETH',0,0,'',0,'',0,9.145000,40.489674,'',1,'2010-06-06 00:19:08'),
(97,'Fidschi','','FJ','FJI',0,0,'',0,'',0,-16.578194,179.414413,'',1,'2010-06-06 00:19:16'),
(98,'Falklandinseln','','FK','FLK',0,0,'',0,'',0,-51.796253,-59.523613,'',1,'2010-06-06 00:19:16'),
(99,'Färöer','','FO','FRO',0,0,'',0,'',0,61.892635,-6.911806,'',1,'2010-06-06 00:19:16'),
(100,'Mikronesien, Föderierte Staaten Von','','FM','FSM',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:49'),
(101,'Gabun','','GA','GAB',0,0,'',0,'',0,-0.803689,11.609444,'',1,'2010-06-06 00:19:17'),
(102,'Georgien','','GE','GEO',0,0,'',0,'',0,42.315407,43.356892,'',1,'2010-06-06 00:19:18'),
(103,'Guernsey','','GG','GGY',0,0,'',0,'',0,49.465691,-2.585278,'',1,'2010-06-06 00:19:20'),
(104,'Ghana','','GH','GHA',0,0,'',0,'',0,7.946527,-1.023194,'',1,'2010-06-06 00:19:18'),
(105,'Gibraltar','','GI','GIB',0,0,'',0,'',0,36.137741,-5.345374,'',1,'2010-06-06 00:19:18'),
(106,'Guinea','','GN','GIN',0,0,'',0,'',0,9.945587,-9.696645,'',1,'2010-06-06 00:19:20'),
(107,'Guadeloupe','','GP','GLP',0,0,'',0,'',0,16.995972,-62.067642,'',1,'2010-06-06 00:19:19'),
(108,'Gambia','','GM','GMB',0,0,'',0,'',0,13.443182,-15.310139,'',1,'2010-06-06 00:19:18'),
(109,'Guinea-Bissau','','GW','GNB',0,0,'',0,'',0,11.803749,-15.180413,'',1,'2010-06-06 00:19:21'),
(110,'Äquatorialguinea','','GQ','GNQ',0,0,'',0,'',0,1.650801,10.267895,'',1,'2010-06-06 00:19:07'),
(111,'Griechenland','','GR','GRC',0,0,'',0,'',0,39.074207,21.824312,'',1,'2010-06-06 00:19:19'),
(112,'Grenada','','GD','GRD',0,0,'',0,'',0,12.262776,-61.604172,'',1,'2010-06-06 00:19:19'),
(113,'Grönland','','GL','GRL',0,0,'',0,'',0,71.706940,-42.604301,'',1,'2010-06-06 00:19:19'),
(114,'Guatemala','','GT','GTM',0,0,'',0,'',0,15.783471,-90.230759,'',1,'2010-06-06 00:19:20'),
(115,'Französisch Guiana','','GF','GUF',0,0,'',0,'',0,3.933889,-53.125782,'',1,'2010-06-06 00:19:17'),
(116,'Guam','','GU','GUM',0,0,'',0,'',0,13.444304,144.793732,'',1,'2010-06-06 00:19:20'),
(117,'Guyana','','GY','GUY',0,0,'',0,'',0,4.860416,-58.930180,'',1,'2010-06-06 00:19:21'),
(118,'Hong Kong','','HK','HKG',0,0,'',0,'',0,22.396427,114.109497,'',1,'2010-06-06 00:19:22'),
(119,'Heard Insel Und McDonald Inseln','','HM','HMD',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:49'),
(120,'Honduras','','HN','HND',0,0,'',0,'',0,15.199999,-86.241905,'',1,'2010-06-06 00:19:22'),
(121,'Kroatien','','HR','HRV',0,0,'',0,'',0,45.099998,15.200000,'',1,'2010-06-06 00:19:30'),
(122,'Haiti','','HT','HTI',0,0,'',0,'',0,18.971188,-72.285217,'',1,'2010-06-06 00:19:21'),
(123,'Indonesien','','ID','IDN',0,0,'',0,'',0,-0.789275,113.921326,'',1,'2010-06-06 00:19:22'),
(124,'Isle Of Man','','IM','IMN',0,0,'',0,'',0,54.236107,-4.548056,'',1,'2010-06-06 00:19:23'),
(125,'Indien','','IN','IND',0,0,'',0,'',0,20.593683,78.962883,'',1,'2010-06-06 00:19:22'),
(126,'Britische Territorien Im Indischen Ozean','','IO','IOT',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:49'),
(127,'Iran, Islam','','IR','IRN',0,0,'',0,'',0,36.264851,59.612049,'',1,'2010-06-06 00:19:23'),
(128,'Irak','','IQ','IRQ',0,0,'',0,'',0,33.223190,43.679291,'',1,'2010-06-06 00:19:23'),
(129,'Island','','IS','ISL',0,0,'',0,'',0,64.963051,-19.020836,'',1,'2010-06-06 00:19:23'),
(130,'Israel','','IL','ISR',0,0,'',0,'',0,31.046051,34.851612,'',1,'2010-06-06 00:19:24'),
(131,'Jamaika','','JM','JAM',0,0,'',0,'',0,18.109581,-77.297508,'',1,'2010-06-06 00:19:24'),
(132,'Jersey','','JE','JEY',0,0,'',0,'',0,49.214439,-2.131250,'',1,'2010-06-06 00:19:25'),
(133,'Jordanien','','JO','JOR',0,0,'',0,'',0,30.585163,36.238415,'',1,'2010-06-06 00:19:25'),
(134,'Japan','','JP','JPN',0,0,'',0,'',0,36.204823,138.252930,'',1,'2010-06-06 00:19:24'),
(135,'Kasachstan','','KZ','KAZ',0,0,'',0,'',0,48.019573,66.923683,'',1,'2010-06-06 00:19:26'),
(136,'Kenia','','KE','KEN',0,0,'',0,'',0,-0.023559,37.906193,'',1,'2010-06-06 00:19:27'),
(137,'Kirgisistan','','KG','KGZ',0,0,'',0,'',0,41.204380,74.766098,'',1,'2010-06-06 00:19:27'),
(138,'Kambodscha','','KH','KHM',0,0,'',0,'',0,12.565679,104.990967,'',1,'2010-06-06 00:19:26'),
(139,'Kiribati','','KI','KIR',0,0,'',0,'',0,-3.370417,-168.734039,'',1,'2010-06-06 00:19:27'),
(140,'Korea, Rep','','KR','KOR',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:49'),
(141,'Kuwait','','KW','KWT',0,0,'',0,'',0,29.311661,47.481766,'',1,'2010-06-06 00:19:31'),
(142,'Laos, Dem','','LA','LAO',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:49'),
(143,'Libanon','','LB','LBN',0,0,'',0,'',0,33.854721,35.862286,'',1,'2010-06-06 00:19:33'),
(144,'Liberia','','LR','LBR',0,0,'',0,'',0,6.428055,-9.429499,'',1,'2010-06-06 00:19:33'),
(145,'Libysch-Arabische Dschamahirija','','LY','LBY',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:49'),
(146,'Sri Lanka','','LK','LKA',0,0,'',0,'',0,7.873054,80.771797,'',1,'2010-06-06 00:19:51'),
(147,'Lesotho','','LS','LSO',0,0,'',0,'',0,-29.609987,28.233608,'',1,'2010-06-06 00:19:32'),
(148,'Macao','','MO','MAC',0,0,'',0,'',0,22.198746,113.543877,'',1,'2010-06-06 00:19:34'),
(149,'Marokko','','MA','MAR',0,0,'',0,'',0,31.791702,-7.092620,'',1,'2010-06-06 00:19:36'),
(150,'Monaco','','MC','MCO',0,0,'',0,'',0,43.750298,7.412841,'',1,'2010-06-06 00:19:38'),
(151,'Moldau, Rep','','MD','MDA',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:49'),
(152,'Madagaskar','','MG','MDG',0,0,'',0,'',0,-18.766947,46.869106,'',1,'2010-06-06 00:19:34'),
(153,'Malediven','','MV','MDV',0,0,'',0,'',0,3.202778,73.220680,'',1,'2010-06-06 00:19:35'),
(154,'Mexiko','','MX','MEX',0,0,'',0,'',0,23.634501,-102.552788,'',1,'2010-06-06 00:19:37'),
(155,'Marshallinseln','','MH','MHL',0,0,'',0,'',0,7.131474,171.184479,'',1,'2010-06-06 00:19:36'),
(156,'Mazedonien, Ehemalige Jugoslawische Republik','','MK','MKD',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:49'),
(157,'Mali','','ML','MLI',0,0,'',0,'',0,17.570692,-3.996166,'',1,'2010-06-06 00:19:35'),
(158,'Malta','','MT','MLT',0,0,'',0,'',0,35.937496,14.375416,'',1,'2010-06-06 00:19:35'),
(159,'Myanmar','','MM','MMR',0,0,'',0,'',0,21.913965,95.956223,'',1,'2010-06-06 00:19:39'),
(160,'Montenegro','','ME','MNE',0,0,'',0,'',0,42.708679,19.374390,'',1,'2010-06-06 00:19:38'),
(161,'Mongolei','','MN','MNG',0,0,'',0,'',0,46.862495,103.846657,'',1,'2010-06-06 00:19:38'),
(162,'Nördliche Marianen','','MP','MNP',0,0,'',0,'',0,17.330830,145.384689,'',1,'2010-06-06 00:19:42'),
(163,'Mosambik','','MZ','MOZ',0,0,'',0,'',0,-18.665695,35.529564,'',1,'2010-06-06 00:19:39'),
(164,'Mauretanien','','MR','MRT',0,0,'',0,'',0,21.007891,-10.940835,'',1,'2010-06-06 00:19:36'),
(165,'Montserrat','','MS','MSR',0,0,'',0,'',0,16.742498,-62.187366,'',1,'2010-06-06 00:19:38'),
(166,'Martinique','','MQ','MTQ',0,0,'',0,'',0,14.641528,-61.024174,'',1,'2010-06-06 00:19:36'),
(167,'Mauritius','','MU','MUS',0,0,'',0,'',0,-20.348404,57.552151,'',1,'2010-06-06 00:19:37'),
(168,'Malawi','','MW','MWI',0,0,'',0,'',0,-13.254308,34.301525,'',1,'2010-06-06 00:19:35'),
(169,'Malaysia','','MY','MYS',0,0,'',0,'',0,4.210484,101.975769,'',1,'2010-06-06 00:19:35'),
(170,'Mayotte','','YT','MYT',0,0,'',0,'',0,-12.827500,45.166245,'',1,'2010-06-06 00:19:37'),
(171,'Namibia','','NA','NAM',0,0,'',0,'',0,-22.957640,18.490410,'',1,'2010-06-06 00:19:39'),
(172,'Neukaledonien','','NC','NCL',0,0,'',0,'',0,-20.904305,165.618042,'',1,'2010-06-06 00:19:40'),
(173,'Niger','','NE','NER',0,0,'',0,'',0,17.607788,8.081666,'',1,'2010-06-06 00:19:41'),
(174,'Norfolk Insel','','NF','NFK',0,0,'',0,'',0,-29.040834,167.954712,'',1,'2010-06-06 00:19:42'),
(175,'Nigeria','','NG','NGA',0,0,'',0,'',0,9.081999,8.675277,'',1,'2010-06-06 00:19:41'),
(176,'Nicaragua','','NI','NIC',0,0,'',0,'',0,12.865416,-85.207230,'',1,'2010-06-06 00:19:40'),
(177,'Niue','','NU','NIU',0,0,'',0,'',0,-19.054445,-169.867233,'',1,'2010-06-06 00:19:41'),
(178,'Nepal','','NP','NPL',0,0,'',0,'',0,28.394857,84.124008,'',1,'2010-06-06 00:19:40'),
(179,'Nauru','','NR','NRU',0,0,'',0,'',0,-0.522778,166.931503,'',1,'2010-06-06 00:19:39'),
(180,'Neuseeland','','NZ','NZL',0,0,'',0,'',0,-40.900558,174.885971,'',1,'2010-06-06 00:19:40'),
(181,'Oman','','OM','OMN',0,0,'',0,'',0,21.512583,55.923256,'',1,'2010-06-06 00:19:42'),
(182,'Pakistan','','PK','PAK',0,0,'',0,'',0,30.375320,69.345116,'',1,'2010-06-06 00:19:43'),
(183,'Panama','','PA','PAN',0,0,'',0,'',0,8.537981,-80.782127,'',1,'2010-06-06 00:19:43'),
(184,'Pitcairn','','PN','PCN',0,0,'',0,'',0,-24.703615,-127.439308,'',1,'2010-06-06 00:19:44'),
(185,'Peru','','PE','PER',0,0,'',0,'',0,-9.189967,-75.015152,'',1,'2010-06-06 00:19:44'),
(186,'Philippinen','','PH','PHL',0,0,'',0,'',0,12.879721,121.774017,'',1,'2010-06-06 00:19:44'),
(187,'Palau','','PW','PLW',0,0,'',0,'',0,7.514980,134.582520,'',1,'2010-06-06 00:19:43'),
(188,'Papua-Neuguinea','','PG','PNG',0,0,'',0,'',0,-6.314993,143.955551,'',1,'2010-06-06 00:19:43'),
(189,'Puerto Rico','','PR','PRI',0,0,'',0,'',0,18.220833,-66.590149,'',1,'2010-06-06 00:19:45'),
(190,'Korea, Dem','','KP','PRK',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:50'),
(191,'Paraguay','','PY','PRY',0,0,'',0,'',0,-23.442503,-58.443832,'',1,'2010-06-06 00:19:44'),
(192,'Palästinische Gebiete','','PS','PSE',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:50'),
(193,'Französisch Polynesien','','PF','PYF',0,0,'',0,'',0,-17.679743,-149.406845,'',1,'2010-06-06 00:19:17'),
(194,'Katar','','QA','QAT',0,0,'',0,'',0,25.354826,51.183884,'',1,'2010-06-06 00:19:27'),
(195,'Réunion','','RE','REU',0,0,'',0,'',0,-21.115141,55.536385,'',1,'2010-06-06 00:19:46'),
(196,'Ruanda','','RW','RWA',0,0,'',0,'',0,-1.940278,29.873888,'',1,'2010-06-06 00:19:46'),
(197,'Saudi-Arabien','','SA','SAU',0,0,'',0,'',0,23.885942,45.079163,'',1,'2010-06-06 00:19:48'),
(198,'Sudan','','SD','SDN',0,0,'',0,'',0,12.862807,30.217636,'',1,'2010-06-06 00:19:52'),
(199,'Senegal','','SN','SEN',0,0,'',0,'',0,14.497401,-14.452362,'',1,'2010-06-06 00:19:49'),
(200,'Singapur','','SG','SGP',0,0,'',0,'',0,1.352083,103.819839,'',1,'2010-06-06 00:19:50'),
(201,'Südgeorgien Und Die Südlichen Sandwichinseln','','GS','SGS',0,0,'',0,'',0,-54.429581,-36.587910,'',1,'2010-06-06 00:19:52'),
(202,'Saint Helena','','SH','SHN',0,0,'',0,'',0,-24.143475,-10.030696,'',1,'2010-06-06 00:19:46'),
(203,'Svalbard Und Jan Mayen','','SJ','SJM',0,0,'',0,'',0,77.553604,23.670273,'',1,'2010-06-06 00:19:53'),
(204,'Salomonen','','SB','SLB',0,0,'',0,'',0,-9.645710,160.156189,'',1,'2010-06-06 00:19:47'),
(205,'Sierra Leone','','SL','SLE',0,0,'',0,'',0,8.460555,-11.779889,'',1,'2010-06-06 00:19:49'),
(206,'El Salvador','','SV','SLV',0,0,'',0,'',0,13.794185,-88.896530,'',1,'2010-06-06 00:19:15'),
(207,'San Marino','','SM','SMR',0,0,'',0,'',0,43.942360,12.457777,'',1,'2010-06-06 00:19:48'),
(208,'Somalia','','SO','SOM',0,0,'',0,'',0,5.152149,46.199615,'',1,'2010-06-06 00:19:50'),
(209,'Saint Pierre Und Miquelon','','PM','SPM',0,0,'',0,'',0,46.941936,-56.271111,'',1,'2010-06-06 00:19:47'),
(210,'Serbien','','RS','SRB',0,0,'',0,'',0,44.016521,21.005859,'',1,'2010-06-06 00:19:49'),
(211,'São Tomé Und Príncipe','','ST','STP',0,0,'',0,'',0,0.186360,6.613081,'',1,'2010-06-06 00:19:48'),
(212,'Suriname','','SR','SUR',0,0,'',0,'',0,3.919305,-56.027782,'',1,'2010-06-06 00:19:52'),
(213,'Swasiland','','SZ','SWZ',0,0,'',0,'',0,-26.522503,31.465866,'',1,'2010-06-06 00:19:53'),
(214,'Seychellen','','SC','SYC',0,0,'',0,'',0,-4.679574,55.491978,'',1,'2010-06-06 00:19:49'),
(215,'Syrien, Arab','','SY','SYR',0,0,'',0,'',0,34.547417,38.272701,'',1,'2010-06-06 00:19:53'),
(216,'Turks- Und Caicosinseln','','TC','TCA',0,0,'',0,'',0,21.694025,-71.797928,'',1,'2010-06-06 00:19:56'),
(217,'Tschad','','TD','TCD',0,0,'',0,'',0,15.454166,18.732206,'',1,'2010-06-06 00:19:55'),
(218,'Togo','','TG','TGO',0,0,'',0,'',0,8.619543,0.824782,'',1,'2010-06-06 00:19:54'),
(219,'Thailand','','TH','THA',0,0,'',0,'',0,15.870032,100.992538,'',1,'2010-06-06 00:19:54'),
(220,'Tadschikistan','','TJ','TJK',0,0,'',0,'',0,38.861034,71.276093,'',1,'2010-06-06 00:19:53'),
(221,'Tokelau','','TK','TKL',0,0,'',0,'',0,-8.967363,-171.855881,'',1,'2010-06-06 00:19:54'),
(222,'Turkmenistan','','TM','TKM',0,0,'',0,'',0,38.969719,59.556278,'',1,'2010-06-06 00:19:56'),
(224,'Tonga','','TO','TON',0,0,'',0,'',0,-21.178986,-175.198242,'',1,'2010-06-06 00:19:54'),
(225,'Trinidad Und Tobago','','TT','TTO',0,0,'',0,'',0,10.691803,-61.222504,'',1,'2010-06-06 00:19:55'),
(226,'Tunesien','','TN','TUN',0,0,'',0,'',0,33.886917,9.537499,'',1,'2010-06-06 00:19:55'),
(227,'Tuvalu','','TV','TUV',0,0,'',0,'',0,-7.109535,177.649323,'',1,'2010-06-06 00:19:56'),
(228,'Taiwan','','TW','TWN',0,0,'',0,'',0,23.697809,120.960518,'',1,'2010-06-06 00:19:53'),
(229,'Tansania, Vereinigte Rep','','TZ','TZA',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:51'),
(230,'Uganda','','UG','UGA',0,0,'',0,'',0,1.373333,32.290276,'',1,'2010-06-06 00:19:57'),
(231,'United States Minor Outlying Islands','United States Minor Outlying Islands','UM','UMI',0,0,'',0,'',0,0.000000,0.000000,'',0,'2010-06-06 01:27:32'),
(232,'Uruguay','','UY','URY',0,0,'',0,'',0,-32.522778,-55.765835,'',1,'2010-06-06 00:19:57'),
(233,'Usbekistan','','UZ','UZB',0,0,'',0,'',0,41.377491,64.585258,'',1,'2010-06-06 00:19:58'),
(234,'Heiliger Stuhl','Vatikanstadt','VA','VAT',0,0,'',0,'',0,41.902916,12.453389,'',1,'2010-06-06 01:20:37'),
(235,'Venezuela','','VE','VEN',0,0,'',0,'',0,6.423750,-66.589729,'',1,'2010-06-06 00:19:58'),
(236,'Britische Jungferninseln','','VG','VGB',0,0,'',0,'',0,18.420694,-64.639969,'',1,'2010-06-06 00:19:12'),
(237,'Amerikanische Jungferninseln','','VI','VIR',0,0,'',0,'',0,0.000000,0.000000,'',1,'2009-12-21 18:29:51'),
(238,'Vietnam','','VN','VNM',0,0,'',0,'',0,14.058324,108.277199,'',1,'2010-06-06 00:19:59'),
(239,'Vanuatu','','VU','VUT',0,0,'',0,'',0,-15.376706,166.959152,'',1,'2010-06-06 00:19:58'),
(240,'Wallis Und Futuna','','WF','WLF',0,0,'',0,'',0,-13.768752,-177.156097,'',1,'2010-06-06 00:19:59'),
(241,'Samoa','','WS','WSM',0,0,'',0,'',0,-13.759029,-172.104630,'',1,'2010-06-06 00:19:47'),
(242,'Jemen','','YE','YEM',0,0,'',0,'',0,15.552727,48.516388,'',1,'2010-06-06 00:19:25'),
(243,'Südafrika','','ZA','ZAF',0,0,'',0,'',0,-30.559483,22.937506,'',1,'2010-06-06 00:19:52'),
(244,'Sambia','','ZM','ZMB',0,0,'',0,'',0,-13.133897,27.849333,'',1,'2010-06-06 00:19:47'),
(245,'Simbabwe','','ZW','ZWE',0,0,'',0,'',0,-19.015438,29.154858,'',1,'2010-06-06 00:19:50');

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
  KEY `menu_restaurant_key` (`restaurant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`description`,`restaurant_id`,`menu_category_id`,`order`,`created`,`modified`) values 
(1,'Afternoon Tea Menu','Lorem Ipsum 123',1,1,0,'2020-07-31 17:59:08',NULL);

/*Table structure for table `reservation_logs` */

DROP TABLE IF EXISTS `reservation_logs`;

CREATE TABLE `reservation_logs` (
  `id` int(11) NOT NULL,
  `action` varchar(250) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `reservation_logs` */

/*Table structure for table `reservations` */

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('pending','accepted','declined','cancelled','completed') NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `total_guests` int(2) NOT NULL,
  `reserved_date` datetime NOT NULL,
  `time` time DEFAULT NULL,
  `restaurant_table_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `reservations` */

insert  into `reservations`(`id`,`status`,`user_id`,`restaurant_id`,`total_guests`,`reserved_date`,`time`,`restaurant_table_id`,`created`,`modified`) values 
(1,'pending',1,3,2,'2020-08-16 17:05:30',NULL,NULL,'2020-08-16 23:20:53','2020-08-16 15:20:53');

/*Table structure for table `restaurant_cuisines` */

DROP TABLE IF EXISTS `restaurant_cuisines`;

CREATE TABLE `restaurant_cuisines` (
  `restaurant_id` int(11) NOT NULL,
  `cuisine_id` int(11) NOT NULL,
  PRIMARY KEY (`restaurant_id`,`cuisine_id`),
  KEY `cuisine_key` (`cuisine_id`),
  KEY `restaurant_key` (`restaurant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurant_cuisines` */

insert  into `restaurant_cuisines`(`restaurant_id`,`cuisine_id`) values 
(3,3),
(3,4),
(3,5),
(4,1),
(4,5),
(4,7);

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
  KEY `gallery_restaurant_key` (`restaurant_id`)
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
  KEY `table_restaurant_key` (`restaurant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurant_tables` */

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
  `city` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `website` varchar(150) DEFAULT NULL,
  `price_range` float(10,2) NOT NULL,
  `payment_options` varchar(100) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `restaurants` */

insert  into `restaurants`(`id`,`name`,`slug`,`description`,`user_id`,`address_line_1`,`address_line_2`,`city`,`state`,`contact_no`,`website`,`price_range`,`payment_options`,`created`,`modified`) values 
(3,'Restaurant A','restaurant-a','asdasdas\r\nasdasdasd',1,'','','Petaling Jaya','','',NULL,0.00,'','2020-08-04 13:28:18',NULL),
(5,'Restaurant 2','Restaurant-2(0)','asd asd\r\nasd asd',1,'130, Jalan Timur 4/2C,','Timur@Enstek','Nilai','Negeri Sembilan','0123123213','',2.00,'asd','2020-08-17 00:00:56','2020-08-16 16:00:56');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`email`,`password`,`profile_photo`,`active`,`created`,`modified`) values 
(1,'Muhamad Syauqi','Jamil','syauqi.j@outlook.com','$2y$10$BLGGs6yE6nfld5R4m7PCAeHu20e4uhr.exLykuAegYtNoDKQcOpYy',NULL,0,'2020-08-16 15:20:22','2020-08-16 15:20:22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
