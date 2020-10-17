/*
SQLyog Ultimate
MySQL - 8.0.21-0ubuntu0.20.04.4 : Database - 2020_kamartamu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`2020_kamartamu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `2020_kamartamu`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

LOCK TABLES `admins` WRITE;

insert  into `admins`(`id`,`name`,`status`,`email`,`password`,`photo`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','1','admin@admin.com','$2y$10$OpU.umaGs3jMudGuqQFd8.KUiNa2Y8usdcxA42ynx1xCsBPTk0RiG','core/2020/06/17/file/interior-1026452-1920_1.jpg',NULL,'2020-05-05 05:17:52','2020-06-17 08:27:36');

UNLOCK TABLES;

/*Table structure for table `ameneties` */

DROP TABLE IF EXISTS `ameneties`;

CREATE TABLE `ameneties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ameneties` */

LOCK TABLES `ameneties` WRITE;

insert  into `ameneties`(`id`,`name`,`slug`,`icon`,`content`,`status`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Kamar Mandi','kamar-mandi',NULL,'{\"id\":\"Kamar Mandi\",\"en\":\"Bathroom\"}','1',NULL,'2020-05-22 03:32:10','2020-05-22 03:32:10'),
(2,'Kasur','kasur',NULL,'{\"id\":\"Kasur\",\"en\":\"Bed\"}','1',NULL,'2020-05-22 03:32:31','2020-05-22 03:32:31'),
(3,'Air','air',NULL,'{\"id\":\"Air\",\"en\":\"Water\"}','1',NULL,'2020-05-22 03:32:55','2020-05-22 03:32:55'),
(4,'Listrik','listrik',NULL,'{\"id\":\"Listrik\",\"en\":\"Power\"}','1',NULL,'2020-05-22 03:33:13','2020-05-22 03:33:13'),
(5,'AC','ac','icons/2020/06/13/file/air-conditioner.png','{\"id\":\"Air Conditioner\",\"en\":\"Air Conditioner\"}','1',NULL,'2020-05-22 03:33:36','2020-06-13 17:20:05');

UNLOCK TABLES;

/*Table structure for table `article_to_category` */

DROP TABLE IF EXISTS `article_to_category`;

CREATE TABLE `article_to_category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `article_to_category` */

LOCK TABLES `article_to_category` WRITE;

insert  into `article_to_category`(`id`,`article_id`,`category_id`,`created_at`,`updated_at`) values 
(27,1,2,'2020-05-25 13:23:29','2020-05-25 13:23:29'),
(29,3,2,'2020-05-27 15:18:02','2020-05-27 15:18:02'),
(30,2,2,'2020-05-27 15:21:25','2020-05-27 15:21:25'),
(31,2,3,'2020-05-27 15:21:25','2020-05-27 15:21:25');

UNLOCK TABLES;

/*Table structure for table `articles` */

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banners` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banners_mobile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `abstract` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `articles` */

LOCK TABLES `articles` WRITE;

insert  into `articles`(`id`,`name`,`slug`,`order`,`meta`,`banners`,`banners_mobile`,`images`,`title`,`abstract`,`content`,`is_featured`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'hallo indonesia','hallo-indonesia',0,'{\"id\":{\"title\":\"dfsdfgsdfg\",\"tag\":\"sdfgsdfg,sdfgsdfhj,sdfgjsdfgh\",\"description\":\"sdgfsdfg\"},\"en\":{\"title\":\"asdfasd\",\"tag\":\"asdf,asdgasd,hsdf\",\"description\":\"sdfsdfg\"}}','articles/2020/05/25/articles/room-2269594-1920.jpg','articles/2020/05/25/articles/water-3292794-1920.jpg','articles/2020/05/25/articles/travel-1677347-1920.jpg','{\"id\":\"Indo\",\"en\":\"English\"}','{\"id\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">Indo, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis.<\\/span><br><\\/p>\",\"en\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">English, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis.<\\/span><br><\\/p>\"}','{\"id\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">Indo,<\\/span><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">&nbsp;<\\/span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis. Etiam ut feugiat odio, consequat rhoncus nunc. Duis porta libero fermentum metus tincidunt, consequat congue velit aliquet. Duis condimentum, metus ut commodo imperdiet, turpis risus tincidunt tellus, sed elementum magna felis sed nibh. Proin lobortis nisl non bibendum lacinia. Pellentesque id elit cursus, fringilla nunc sit amet, pretium lectus. Sed turpis dolor, pretium eleifend sagittis lobortis, facilisis eget quam. Mauris pellentesque tincidunt tellus, quis condimentum libero pretium in. Aliquam suscipit nulla non pharetra elementum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit nibh sem, at iaculis nibh ultricies nec. Ut sodales lacus lectus, sit amet maximus est gravida ut.<\\/p><p><br><\\/p><p>Pellentesque sit amet orci ac lectus venenatis tristique quis non urna. Nulla luctus non ipsum in commodo. Phasellus ut nibh a metus accumsan tincidunt. Nullam non nulla ac diam venenatis ullamcorper a at justo. Donec et efficitur leo. Vivamus et aliquet tellus, sit amet lobortis tortor. Sed consequat et felis in suscipit. Nullam elementum sem lorem, pellentesque facilisis diam gravida euismod. Proin ac tincidunt lectus. Nam ultricies porta odio sit amet ornare. Aliquam condimentum semper purus, ac posuere mi scelerisque lobortis. Proin at lacus nec felis pulvinar volutpat non nec sem. Vivamus vestibulum velit non dui sollicitudin vehicula ac eget dui. Aenean cursus sagittis libero ac tempus.<\\/p><p><br><\\/p><p>Duis volutpat gravida elementum. Nam congue ullamcorper pellentesque. Vestibulum ultrices sollicitudin ligula, nec convallis orci tincidunt vitae. Donec facilisis a lacus vitae tempus. Quisque ultricies vestibulum magna, eget consequat enim. Praesent imperdiet purus laoreet, dapibus ipsum eu, porta diam. Suspendisse eget lectus quis augue suscipit blandit. Vestibulum sit amet augue eu dolor venenatis iaculis. Curabitur rutrum, urna eget convallis laoreet, risus dolor accumsan massa, quis lacinia leo magna nec eros. Pellentesque non blandit sem. Sed vestibulum, sem at ultricies ultrices, urna sem dictum velit, nec blandit magna diam sed metus. Aliquam erat volutpat. In nisi lorem, porta nec mauris quis, aliquet aliquet est.<\\/p><p><br><\\/p><p>In scelerisque est id neque consectetur, at dictum nisl commodo. Ut erat lorem, tempor nec ultrices ut, malesuada nec tellus. Curabitur at ante a ipsum mollis blandit sed vel sapien. Vivamus porttitor porta vestibulum. Fusce eu blandit lorem. Pellentesque accumsan turpis felis, in convallis leo tempus at. Duis pretium commodo felis a egestas. Etiam a massa magna. In sit amet orci nibh. Duis convallis bibendum lectus et hendrerit. Aliquam sed ipsum enim. Proin ut ipsum non odio faucibus tempor ac ac lorem. Sed ornare urna urna, ut consequat nunc imperdiet vel. Nunc bibendum orci vel tellus accumsan auctor. Nulla id auctor lectus. Etiam vel nibh mi.<\\/p>\",\"en\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">English,<\\/span><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">&nbsp;<\\/span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis. Etiam ut feugiat odio, consequat rhoncus nunc. Duis porta libero fermentum metus tincidunt, consequat congue velit aliquet. Duis condimentum, metus ut commodo imperdiet, turpis risus tincidunt tellus, sed elementum magna felis sed nibh. Proin lobortis nisl non bibendum lacinia. Pellentesque id elit cursus, fringilla nunc sit amet, pretium lectus. Sed turpis dolor, pretium eleifend sagittis lobortis, facilisis eget quam. Mauris pellentesque tincidunt tellus, quis condimentum libero pretium in. Aliquam suscipit nulla non pharetra elementum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit nibh sem, at iaculis nibh ultricies nec. Ut sodales lacus lectus, sit amet maximus est gravida ut.<\\/p><p><br><\\/p><p>Pellentesque sit amet orci ac lectus venenatis tristique quis non urna. Nulla luctus non ipsum in commodo. Phasellus ut nibh a metus accumsan tincidunt. Nullam non nulla ac diam venenatis ullamcorper a at justo. Donec et efficitur leo. Vivamus et aliquet tellus, sit amet lobortis tortor. Sed consequat et felis in suscipit. Nullam elementum sem lorem, pellentesque facilisis diam gravida euismod. Proin ac tincidunt lectus. Nam ultricies porta odio sit amet ornare. Aliquam condimentum semper purus, ac posuere mi scelerisque lobortis. Proin at lacus nec felis pulvinar volutpat non nec sem. Vivamus vestibulum velit non dui sollicitudin vehicula ac eget dui. Aenean cursus sagittis libero ac tempus.<\\/p><p><br><\\/p><p>Duis volutpat gravida elementum. Nam congue ullamcorper pellentesque. Vestibulum ultrices sollicitudin ligula, nec convallis orci tincidunt vitae. Donec facilisis a lacus vitae tempus. Quisque ultricies vestibulum magna, eget consequat enim. Praesent imperdiet purus laoreet, dapibus ipsum eu, porta diam. Suspendisse eget lectus quis augue suscipit blandit. Vestibulum sit amet augue eu dolor venenatis iaculis. Curabitur rutrum, urna eget convallis laoreet, risus dolor accumsan massa, quis lacinia leo magna nec eros. Pellentesque non blandit sem. Sed vestibulum, sem at ultricies ultrices, urna sem dictum velit, nec blandit magna diam sed metus. Aliquam erat volutpat. In nisi lorem, porta nec mauris quis, aliquet aliquet est.<\\/p><p><br><\\/p><p>In scelerisque est id neque consectetur, at dictum nisl commodo. Ut erat lorem, tempor nec ultrices ut, malesuada nec tellus. Curabitur at ante a ipsum mollis blandit sed vel sapien. Vivamus porttitor porta vestibulum. Fusce eu blandit lorem. Pellentesque accumsan turpis felis, in convallis leo tempus at. Duis pretium commodo felis a egestas. Etiam a massa magna. In sit amet orci nibh. Duis convallis bibendum lectus et hendrerit. Aliquam sed ipsum enim. Proin ut ipsum non odio faucibus tempor ac ac lorem. Sed ornare urna urna, ut consequat nunc imperdiet vel. Nunc bibendum orci vel tellus accumsan auctor. Nulla id auctor lectus. Etiam vel nibh mi.<\\/p>\"}',1,1,'2020-05-07 14:43:18','2020-05-25 13:23:29',NULL),
(2,'hallo indonesia','hallo-indonesia-1',0,'{\"id\":{\"title\":\"dfsdfgsdfg\",\"tag\":\"sdfgsdfg,sdfgsdfhj,sdfgjsdfgh\",\"description\":\"sdgfsdfg\"},\"en\":{\"title\":\"asdfasd\",\"tag\":\"asdf,asdgasd,hsdf\",\"description\":\"sdfsdfg\"}}','articles/2020/05/25/articles/room-2269594-1920.jpg',NULL,'articles/2020/05/25/articles/travel-1677347-1920.jpg','{\"id\":\"Indo\",\"en\":\"English\"}','{\"id\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">Indo, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis.<\\/span><br><\\/p>\",\"en\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">English, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis.<\\/span><br><\\/p>\"}','{\"id\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">Indo,<\\/span><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">&nbsp;<\\/span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis. Etiam ut feugiat odio, consequat rhoncus nunc. Duis porta libero fermentum metus tincidunt, consequat congue velit aliquet. Duis condimentum, metus ut commodo imperdiet, turpis risus tincidunt tellus, sed elementum magna felis sed nibh. Proin lobortis nisl non bibendum lacinia. Pellentesque id elit cursus, fringilla nunc sit amet, pretium lectus. Sed turpis dolor, pretium eleifend sagittis lobortis, facilisis eget quam. Mauris pellentesque tincidunt tellus, quis condimentum libero pretium in. Aliquam suscipit nulla non pharetra elementum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit nibh sem, at iaculis nibh ultricies nec. Ut sodales lacus lectus, sit amet maximus est gravida ut.<\\/p><p><br><\\/p><p>Pellentesque sit amet orci ac lectus venenatis tristique quis non urna. Nulla luctus non ipsum in commodo. Phasellus ut nibh a metus accumsan tincidunt. Nullam non nulla ac diam venenatis ullamcorper a at justo. Donec et efficitur leo. Vivamus et aliquet tellus, sit amet lobortis tortor. Sed consequat et felis in suscipit. Nullam elementum sem lorem, pellentesque facilisis diam gravida euismod. Proin ac tincidunt lectus. Nam ultricies porta odio sit amet ornare. Aliquam condimentum semper purus, ac posuere mi scelerisque lobortis. Proin at lacus nec felis pulvinar volutpat non nec sem. Vivamus vestibulum velit non dui sollicitudin vehicula ac eget dui. Aenean cursus sagittis libero ac tempus.<\\/p><p><br><\\/p><p>Duis volutpat gravida elementum. Nam congue ullamcorper pellentesque. Vestibulum ultrices sollicitudin ligula, nec convallis orci tincidunt vitae. Donec facilisis a lacus vitae tempus. Quisque ultricies vestibulum magna, eget consequat enim. Praesent imperdiet purus laoreet, dapibus ipsum eu, porta diam. Suspendisse eget lectus quis augue suscipit blandit. Vestibulum sit amet augue eu dolor venenatis iaculis. Curabitur rutrum, urna eget convallis laoreet, risus dolor accumsan massa, quis lacinia leo magna nec eros. Pellentesque non blandit sem. Sed vestibulum, sem at ultricies ultrices, urna sem dictum velit, nec blandit magna diam sed metus. Aliquam erat volutpat. In nisi lorem, porta nec mauris quis, aliquet aliquet est.<\\/p><p><br><\\/p><p>In scelerisque est id neque consectetur, at dictum nisl commodo. Ut erat lorem, tempor nec ultrices ut, malesuada nec tellus. Curabitur at ante a ipsum mollis blandit sed vel sapien. Vivamus porttitor porta vestibulum. Fusce eu blandit lorem. Pellentesque accumsan turpis felis, in convallis leo tempus at. Duis pretium commodo felis a egestas. Etiam a massa magna. In sit amet orci nibh. Duis convallis bibendum lectus et hendrerit. Aliquam sed ipsum enim. Proin ut ipsum non odio faucibus tempor ac ac lorem. Sed ornare urna urna, ut consequat nunc imperdiet vel. Nunc bibendum orci vel tellus accumsan auctor. Nulla id auctor lectus. Etiam vel nibh mi.<\\/p>\",\"en\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">English,<\\/span><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">&nbsp;<\\/span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis. Etiam ut feugiat odio, consequat rhoncus nunc. Duis porta libero fermentum metus tincidunt, consequat congue velit aliquet. Duis condimentum, metus ut commodo imperdiet, turpis risus tincidunt tellus, sed elementum magna felis sed nibh. Proin lobortis nisl non bibendum lacinia. Pellentesque id elit cursus, fringilla nunc sit amet, pretium lectus. Sed turpis dolor, pretium eleifend sagittis lobortis, facilisis eget quam. Mauris pellentesque tincidunt tellus, quis condimentum libero pretium in. Aliquam suscipit nulla non pharetra elementum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit nibh sem, at iaculis nibh ultricies nec. Ut sodales lacus lectus, sit amet maximus est gravida ut.<\\/p><p><br><\\/p><p>Pellentesque sit amet orci ac lectus venenatis tristique quis non urna. Nulla luctus non ipsum in commodo. Phasellus ut nibh a metus accumsan tincidunt. Nullam non nulla ac diam venenatis ullamcorper a at justo. Donec et efficitur leo. Vivamus et aliquet tellus, sit amet lobortis tortor. Sed consequat et felis in suscipit. Nullam elementum sem lorem, pellentesque facilisis diam gravida euismod. Proin ac tincidunt lectus. Nam ultricies porta odio sit amet ornare. Aliquam condimentum semper purus, ac posuere mi scelerisque lobortis. Proin at lacus nec felis pulvinar volutpat non nec sem. Vivamus vestibulum velit non dui sollicitudin vehicula ac eget dui. Aenean cursus sagittis libero ac tempus.<\\/p><p><br><\\/p><p>Duis volutpat gravida elementum. Nam congue ullamcorper pellentesque. Vestibulum ultrices sollicitudin ligula, nec convallis orci tincidunt vitae. Donec facilisis a lacus vitae tempus. Quisque ultricies vestibulum magna, eget consequat enim. Praesent imperdiet purus laoreet, dapibus ipsum eu, porta diam. Suspendisse eget lectus quis augue suscipit blandit. Vestibulum sit amet augue eu dolor venenatis iaculis. Curabitur rutrum, urna eget convallis laoreet, risus dolor accumsan massa, quis lacinia leo magna nec eros. Pellentesque non blandit sem. Sed vestibulum, sem at ultricies ultrices, urna sem dictum velit, nec blandit magna diam sed metus. Aliquam erat volutpat. In nisi lorem, porta nec mauris quis, aliquet aliquet est.<\\/p><p><br><\\/p><p>In scelerisque est id neque consectetur, at dictum nisl commodo. Ut erat lorem, tempor nec ultrices ut, malesuada nec tellus. Curabitur at ante a ipsum mollis blandit sed vel sapien. Vivamus porttitor porta vestibulum. Fusce eu blandit lorem. Pellentesque accumsan turpis felis, in convallis leo tempus at. Duis pretium commodo felis a egestas. Etiam a massa magna. In sit amet orci nibh. Duis convallis bibendum lectus et hendrerit. Aliquam sed ipsum enim. Proin ut ipsum non odio faucibus tempor ac ac lorem. Sed ornare urna urna, ut consequat nunc imperdiet vel. Nunc bibendum orci vel tellus accumsan auctor. Nulla id auctor lectus. Etiam vel nibh mi.<\\/p>\"}',1,1,'2020-05-07 14:43:18','2020-05-27 15:17:57',NULL),
(3,'hallo indonesia','hallo-indonesia-2',0,'{\"id\":{\"title\":\"dfsdfgsdfg\",\"tag\":\"sdfgsdfg,sdfgsdfhj,sdfgjsdfgh\",\"description\":\"sdgfsdfg\"},\"en\":{\"title\":\"asdfasd\",\"tag\":\"asdf,asdgasd,hsdf\",\"description\":\"sdfsdfg\"}}','articles/2020/05/25/articles/room-2269594-1920.jpg',NULL,'articles/2020/05/25/articles/travel-1677347-1920.jpg','{\"id\":\"Indo\",\"en\":\"English\"}','{\"id\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">Indo, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis.<\\/span><br><\\/p>\",\"en\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">English, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis.<\\/span><br><\\/p>\"}','{\"id\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">Indo,<\\/span><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">&nbsp;<\\/span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis. Etiam ut feugiat odio, consequat rhoncus nunc. Duis porta libero fermentum metus tincidunt, consequat congue velit aliquet. Duis condimentum, metus ut commodo imperdiet, turpis risus tincidunt tellus, sed elementum magna felis sed nibh. Proin lobortis nisl non bibendum lacinia. Pellentesque id elit cursus, fringilla nunc sit amet, pretium lectus. Sed turpis dolor, pretium eleifend sagittis lobortis, facilisis eget quam. Mauris pellentesque tincidunt tellus, quis condimentum libero pretium in. Aliquam suscipit nulla non pharetra elementum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit nibh sem, at iaculis nibh ultricies nec. Ut sodales lacus lectus, sit amet maximus est gravida ut.<\\/p><p><br><\\/p><p>Pellentesque sit amet orci ac lectus venenatis tristique quis non urna. Nulla luctus non ipsum in commodo. Phasellus ut nibh a metus accumsan tincidunt. Nullam non nulla ac diam venenatis ullamcorper a at justo. Donec et efficitur leo. Vivamus et aliquet tellus, sit amet lobortis tortor. Sed consequat et felis in suscipit. Nullam elementum sem lorem, pellentesque facilisis diam gravida euismod. Proin ac tincidunt lectus. Nam ultricies porta odio sit amet ornare. Aliquam condimentum semper purus, ac posuere mi scelerisque lobortis. Proin at lacus nec felis pulvinar volutpat non nec sem. Vivamus vestibulum velit non dui sollicitudin vehicula ac eget dui. Aenean cursus sagittis libero ac tempus.<\\/p><p><br><\\/p><p>Duis volutpat gravida elementum. Nam congue ullamcorper pellentesque. Vestibulum ultrices sollicitudin ligula, nec convallis orci tincidunt vitae. Donec facilisis a lacus vitae tempus. Quisque ultricies vestibulum magna, eget consequat enim. Praesent imperdiet purus laoreet, dapibus ipsum eu, porta diam. Suspendisse eget lectus quis augue suscipit blandit. Vestibulum sit amet augue eu dolor venenatis iaculis. Curabitur rutrum, urna eget convallis laoreet, risus dolor accumsan massa, quis lacinia leo magna nec eros. Pellentesque non blandit sem. Sed vestibulum, sem at ultricies ultrices, urna sem dictum velit, nec blandit magna diam sed metus. Aliquam erat volutpat. In nisi lorem, porta nec mauris quis, aliquet aliquet est.<\\/p><p><br><\\/p><p>In scelerisque est id neque consectetur, at dictum nisl commodo. Ut erat lorem, tempor nec ultrices ut, malesuada nec tellus. Curabitur at ante a ipsum mollis blandit sed vel sapien. Vivamus porttitor porta vestibulum. Fusce eu blandit lorem. Pellentesque accumsan turpis felis, in convallis leo tempus at. Duis pretium commodo felis a egestas. Etiam a massa magna. In sit amet orci nibh. Duis convallis bibendum lectus et hendrerit. Aliquam sed ipsum enim. Proin ut ipsum non odio faucibus tempor ac ac lorem. Sed ornare urna urna, ut consequat nunc imperdiet vel. Nunc bibendum orci vel tellus accumsan auctor. Nulla id auctor lectus. Etiam vel nibh mi.<\\/p>\",\"en\":\"<p><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">English,<\\/span><span style=\\\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\\\">&nbsp;<\\/span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc finibus vel dui eu aliquam. Integer pharetra leo non ex luctus, id congue eros convallis. Etiam ut feugiat odio, consequat rhoncus nunc. Duis porta libero fermentum metus tincidunt, consequat congue velit aliquet. Duis condimentum, metus ut commodo imperdiet, turpis risus tincidunt tellus, sed elementum magna felis sed nibh. Proin lobortis nisl non bibendum lacinia. Pellentesque id elit cursus, fringilla nunc sit amet, pretium lectus. Sed turpis dolor, pretium eleifend sagittis lobortis, facilisis eget quam. Mauris pellentesque tincidunt tellus, quis condimentum libero pretium in. Aliquam suscipit nulla non pharetra elementum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit nibh sem, at iaculis nibh ultricies nec. Ut sodales lacus lectus, sit amet maximus est gravida ut.<\\/p><p><br><\\/p><p>Pellentesque sit amet orci ac lectus venenatis tristique quis non urna. Nulla luctus non ipsum in commodo. Phasellus ut nibh a metus accumsan tincidunt. Nullam non nulla ac diam venenatis ullamcorper a at justo. Donec et efficitur leo. Vivamus et aliquet tellus, sit amet lobortis tortor. Sed consequat et felis in suscipit. Nullam elementum sem lorem, pellentesque facilisis diam gravida euismod. Proin ac tincidunt lectus. Nam ultricies porta odio sit amet ornare. Aliquam condimentum semper purus, ac posuere mi scelerisque lobortis. Proin at lacus nec felis pulvinar volutpat non nec sem. Vivamus vestibulum velit non dui sollicitudin vehicula ac eget dui. Aenean cursus sagittis libero ac tempus.<\\/p><p><br><\\/p><p>Duis volutpat gravida elementum. Nam congue ullamcorper pellentesque. Vestibulum ultrices sollicitudin ligula, nec convallis orci tincidunt vitae. Donec facilisis a lacus vitae tempus. Quisque ultricies vestibulum magna, eget consequat enim. Praesent imperdiet purus laoreet, dapibus ipsum eu, porta diam. Suspendisse eget lectus quis augue suscipit blandit. Vestibulum sit amet augue eu dolor venenatis iaculis. Curabitur rutrum, urna eget convallis laoreet, risus dolor accumsan massa, quis lacinia leo magna nec eros. Pellentesque non blandit sem. Sed vestibulum, sem at ultricies ultrices, urna sem dictum velit, nec blandit magna diam sed metus. Aliquam erat volutpat. In nisi lorem, porta nec mauris quis, aliquet aliquet est.<\\/p><p><br><\\/p><p>In scelerisque est id neque consectetur, at dictum nisl commodo. Ut erat lorem, tempor nec ultrices ut, malesuada nec tellus. Curabitur at ante a ipsum mollis blandit sed vel sapien. Vivamus porttitor porta vestibulum. Fusce eu blandit lorem. Pellentesque accumsan turpis felis, in convallis leo tempus at. Duis pretium commodo felis a egestas. Etiam a massa magna. In sit amet orci nibh. Duis convallis bibendum lectus et hendrerit. Aliquam sed ipsum enim. Proin ut ipsum non odio faucibus tempor ac ac lorem. Sed ornare urna urna, ut consequat nunc imperdiet vel. Nunc bibendum orci vel tellus accumsan auctor. Nulla id auctor lectus. Etiam vel nibh mi.<\\/p>\"}',1,1,'2020-05-07 14:43:18','2020-05-27 15:18:02',NULL);

UNLOCK TABLES;

/*Table structure for table `book_histories` */

DROP TABLE IF EXISTS `book_histories`;

CREATE TABLE `book_histories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uuid` text COLLATE utf8mb4_unicode_ci,
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `book_histories` */

LOCK TABLES `book_histories` WRITE;

insert  into `book_histories`(`id`,`uuid`,`data`,`created_at`,`updated_at`) values 
(1,'09f290f7-8349-450d-8eb4-5660c304d3bb','{\"uuid\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"customer_id\":1,\"room_id\":\"1\",\"payment_id\":null,\"rooms\":\"1\",\"guests\":2,\"nights\":\"1\",\"price\":\"1000\",\"total\":1000,\"service\":100,\"grand_total\":1100,\"date_checkin\":\"2020-06-09\",\"date_checkout\":\"2020-06-10\",\"notes\":null,\"status\":0}','2020-06-09 21:05:14','2020-06-09 21:05:14'),
(2,'6f1580ce-c370-4add-b2a7-dfb61330119a','{\"uuid\":\"6f1580ce-c370-4add-b2a7-dfb61330119a\",\"customer_id\":1,\"room_id\":\"1\",\"payment_id\":null,\"rooms\":\"1\",\"guests\":2,\"nights\":\"1\",\"price\":\"1000\",\"total\":1000,\"service\":100,\"grand_total\":1100,\"date_checkin\":\"2020-06-13\",\"date_checkout\":\"2020-06-14\",\"notes\":null,\"status\":0}','2020-06-13 15:22:24','2020-06-13 15:22:24'),
(3,'eb85770b-cdf3-47a7-9e18-302443466424','{\"uuid\":\"eb85770b-cdf3-47a7-9e18-302443466424\",\"customer_id\":6,\"room_id\":\"1\",\"payment_id\":null,\"rooms\":\"1\",\"guests\":2,\"nights\":\"2\",\"price\":\"1000\",\"total\":2000,\"service\":200,\"grand_total\":2200,\"date_checkin\":\"2020-06-23\",\"date_checkout\":\"2020-06-25\",\"notes\":null,\"status\":0}','2020-06-17 17:18:28','2020-06-17 17:18:28'),
(4,'98b0ea6c-5a5e-49f3-ba0c-aa119da06bbf','{\"uuid\":\"98b0ea6c-5a5e-49f3-ba0c-aa119da06bbf\",\"customer_id\":1,\"room_id\":\"1\",\"payment_id\":null,\"rooms\":\"1\",\"guests\":2,\"nights\":\"1\",\"price\":\"1000\",\"total\":1000,\"service\":100,\"grand_total\":1100,\"date_checkin\":\"2020-06-23\",\"date_checkout\":\"2020-06-24\",\"notes\":null,\"status\":0}','2020-06-23 15:46:38','2020-06-23 15:46:38');

UNLOCK TABLES;

/*Table structure for table `bookmark` */

DROP TABLE IF EXISTS `bookmark`;

CREATE TABLE `bookmark` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `bookmark` */

LOCK TABLES `bookmark` WRITE;

insert  into `bookmark`(`id`,`customer_id`,`room_id`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,1,1,'2020-06-13 13:32:07','2020-06-13 14:09:12',NULL),
(2,1,1,1,'2020-06-13 13:32:07','2020-06-13 14:09:12',NULL),
(3,1,1,1,'2020-06-13 13:32:07','2020-06-13 14:09:12',NULL),
(4,1,1,1,'2020-06-13 13:32:07','2020-06-13 14:09:12',NULL);

UNLOCK TABLES;

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uuid` text COLLATE utf8mb4_unicode_ci,
  `customer_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `payment_id` int DEFAULT NULL,
  `review_id` int DEFAULT NULL,
  `rooms` int DEFAULT NULL,
  `guests` int DEFAULT NULL,
  `nights` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `service` int DEFAULT NULL,
  `grand_total` int DEFAULT NULL,
  `date_checkin` date DEFAULT NULL,
  `date_checkout` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

LOCK TABLES `books` WRITE;

insert  into `books`(`id`,`uuid`,`customer_id`,`room_id`,`payment_id`,`review_id`,`rooms`,`guests`,`nights`,`price`,`total`,`service`,`grand_total`,`date_checkin`,`date_checkout`,`notes`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'09f290f7-8349-450d-8eb4-5660c304d3bb',1,1,7,NULL,1,2,1,1000,1000,100,1100,'2020-06-09','2020-06-10','{\"_token\":\"kmpAOmA2PUMTupZb8NAo65JxgcVRXgkNUbFqPbyR\",\"g-recaptcha-response\":\"03AGdBq26jFrIvYclknBkaqoPMdNmMFR-n8PsvMAt0Ypsq6o5NIHXu9oyqbRKwbIJU9H5IhEQj5c2HcDx-vxTv9d_TnCvxCfNsk-NAR4Wix4LNzQn8KRi7SeiZbli3Kzurj8bX8_LGX-3vZvc4Xkp4JEORzjsJECHxpwQu1t4_D90oRayiekgU6j4g5-jHViPws7rVFRskF2cPVXLuVzNui2DycUMozHxXx2slkJ13753kAdCuvKRVUdt0vJEzwNif5col_2JzHIWJQrw8RmeeksIrfV9EUBYK22oLmxvr7L3w1OHwj0U6adhtJ-lFaPCglsjQDNenXHiPxHv1pp0ZBs1yZ-b-lE_vmQ1_HI19Y9Lj5_x2AzauL35IRCP575uYAd13JYmMhtdz2dPdrrjQsbRM6IloSqjwsw\",\"status_code\":\"201\",\"status_message\":\"Transaksi sedang diproses\",\"transaction_id\":\"3301f055-0bd8-4ff5-ba88-09cf3c6fb988\",\"order_id\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"gross_amount\":\"1100.00\",\"payment_type\":\"bank_transfer\",\"transaction_time\":\"2020-06-09 21:05:19\",\"transaction_status\":\"pending\",\"va_numbers\":[{\"bank\":\"bca\",\"va_number\":\"81415125839\"}],\"fraud_status\":\"accept\",\"bca_va_number\":\"81415125839\",\"pdf_url\":\"https:\\/\\/app.sandbox.midtrans.com\\/snap\\/v1\\/transactions\\/ce7a4c15-1de5-420e-aeb3-6f166cdb2b97\\/pdf\",\"finish_redirect_url\":\"http:\\/\\/example.com?order_id=09f290f7-8349-450d-8eb4-5660c304d3bb&status_code=201&transaction_status=pending\"}',1,'2020-06-09 21:05:21','2020-06-09 21:23:07',NULL),
(2,'6f1580ce-c370-4add-b2a7-dfb61330119a',1,1,NULL,NULL,1,2,1,1000,1000,100,1100,'2020-06-13','2020-06-14','{\"_token\":\"pwtEz1FyAFUtljjx5RUO3ESQFvJc327IQMJ1HuiY\",\"g-recaptcha-response\":\"03AGdBq25DjY3aua3ZP69oqBhRiHLJkMnFyMkQAaySMlkP_PDCHDoRZOsyP6LfJ_vOB7X8LrLCxefAlgCyZBBj_0Svx73KMhVROtRIBGNwYSzNcb-5JcfDpsCxpfuEAaKKRhum9L9fsL4NFF_UGTfn4AhivFr4ta8Og4LsxqQ7oon4rSsCwmcP-FoH_5aa2mwL66tEjYMQlL6VKea-HQ1KUuTsLaY_FoVXypc8wj0acx-59wujQ1157PAh-XZfUsni2mB5FVreXy0aACV-iqQi6xsmUrsfpHU0Hqqv418qWNAVq8x3ZLBlkoYVWuqJRKgndK0moyE5jSdlIOKiPV6UvT2T_Gefe4s5Il9ZEqDRi9CWQDXAi4u5aGD4I7rlCGixqWWufoEKhfmn-DKAGDE6cRKshIE3J80mlg\",\"status_code\":\"201\",\"status_message\":\"Transaksi sedang diproses\",\"transaction_id\":\"183ec1a7-0baa-4d14-afa2-f16f739848e1\",\"order_id\":\"6f1580ce-c370-4add-b2a7-dfb61330119a\",\"gross_amount\":\"1100.00\",\"payment_type\":\"echannel\",\"transaction_time\":\"2020-06-13 15:22:30\",\"transaction_status\":\"pending\",\"fraud_status\":\"accept\",\"bill_key\":\"934920238458\",\"biller_code\":\"70012\",\"pdf_url\":\"https:\\/\\/app.sandbox.midtrans.com\\/snap\\/v1\\/transactions\\/5a0551d6-0d51-436e-af01-c552ab2aaa92\\/pdf\",\"finish_redirect_url\":\"http:\\/\\/example.com?order_id=6f1580ce-c370-4add-b2a7-dfb61330119a&status_code=201&transaction_status=pending\"}',0,'2020-06-13 15:22:31','2020-06-13 15:22:31',NULL);

UNLOCK TABLES;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

LOCK TABLES `categories` WRITE;

insert  into `categories`(`id`,`title`,`slug`,`order`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Post','post',0,1,'2020-05-07 13:23:03','2020-05-07 13:25:35','2020-05-07 13:25:35'),
(2,'Article','article',0,1,'2020-05-07 14:41:13','2020-05-07 14:41:13',NULL),
(3,'Blog','blog',0,1,'2020-05-27 15:21:08','2020-05-27 15:21:08',NULL);

UNLOCK TABLES;

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_forgot_password` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_verified` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

LOCK TABLES `customers` WRITE;

insert  into `customers`(`id`,`name`,`email`,`password`,`gender`,`dob`,`phone`,`photo`,`facebook_id`,`google_id`,`remember_token`,`token_forgot_password`,`token_verified`,`verified_at`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(10,'Natanael Kristiawan','nael.thia.cr@gmail.com',NULL,NULL,NULL,NULL,NULL,'3018859881531630',NULL,NULL,NULL,'zYvH9ikqBLHp6gqk5ZQrw4wp0B5MHO1YJdemecIK','2020-08-20 09:15:29',1,'2020-08-19 15:58:17','2020-08-19 15:58:17',NULL),
(11,'Natanael Kristiawan','natanaelkristiawan@maxsol.id','$2y$10$a4TJkhMRFA7B2.kqGAdFTOD/vUB..Y3k1Ux7i9GRnyrX.tED2AnQW',NULL,NULL,NULL,NULL,NULL,'118416872342991930572',NULL,NULL,NULL,'2020-08-19 16:20:31',1,'2020-08-19 16:20:14','2020-08-19 16:20:31',NULL);

UNLOCK TABLES;

/*Table structure for table `faq` */

DROP TABLE IF EXISTS `faq`;

CREATE TABLE `faq` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `faq_category_id` int NOT NULL,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `faq` */

LOCK TABLES `faq` WRITE;

insert  into `faq`(`id`,`faq_category_id`,`name`,`slug`,`title`,`description`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'asd','asd','{\"id\":\"asdf\",\"en\":\"sgdfj\"}','{\"id\":\"gfhs\",\"en\":\"fdgh\"}',1,'2020-05-21 04:30:35','2020-05-21 04:31:52',NULL);

UNLOCK TABLES;

/*Table structure for table `faq_categories` */

DROP TABLE IF EXISTS `faq_categories`;

CREATE TABLE `faq_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `faq_categories` */

LOCK TABLES `faq_categories` WRITE;

insert  into `faq_categories`(`id`,`name`,`slug`,`content`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Tipe 1','tipe-1','{\"id\":\"tipe satu\",\"en\":\"type one\"}',1,'2020-05-21 03:48:43','2020-05-21 03:48:43',NULL);

UNLOCK TABLES;

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `locations` */

LOCK TABLES `locations` WRITE;

insert  into `locations`(`id`,`name`,`slug`,`status`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Denpasar','denpasar','1',NULL,'2020-05-12 15:28:14','2020-05-12 15:28:14'),
(2,'Gianyar','gianyar','1',NULL,'2020-05-12 15:28:24','2020-05-12 15:28:24'),
(3,'Gianyar','gianyar','1',NULL,'2020-05-12 15:28:24','2020-05-12 15:28:24'),
(4,'Gianyar','gianyar','1',NULL,'2020-05-12 15:28:24','2020-05-12 15:28:24'),
(5,'Gianyar','gianyar','1',NULL,'2020-05-12 15:28:24','2020-05-12 15:28:24'),
(6,'hhahahah','gianyar','1',NULL,'2020-05-12 15:28:24','2020-05-12 15:28:24');

UNLOCK TABLES;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

LOCK TABLES `migrations` WRITE;

insert  into `migrations`(`id`,`migration`,`batch`) values 
(4,'2019_01_05_000000_create_admins_table',1),
(5,'2020_01_08_1578451801_articles_table',2),
(6,'2020_01_08_1578451802_categories_table',2),
(7,'2020_01_08_1578451803_articles_to_category_table',2),
(36,'2020_05_08_000000_create_ameneties_table',3),
(37,'2020_05_08_000001_create_types_table',3),
(38,'2020_05_08_000002_create_locations_table',3),
(39,'2020_05_08_000003_create_owners_table',3),
(40,'2020_05_08_000004_create_room_date_off_table',3),
(41,'2020_05_08_000004_create_rooms_table',3),
(43,'2020_05_16_000000_create_customers_table',4),
(44,'2020_05_17_0000000_create_faq_category_table',5),
(45,'2020_05_17_0000001_create_faq_table',5),
(46,'2020_05_17_1589714483_site_table',5),
(55,'2020_05_30_000001_create_histories_table',7),
(56,'2020_06_02_000000_create_payment_table',7),
(58,'2020_05_30_000000_create_books_table',8),
(59,'2020_06_07_000000_create_reviews_table',9),
(60,'2020_05_17_1589714484_bookmark_table',10),
(61,'2020_10_17_1602901356_packages_table',11);

UNLOCK TABLES;

/*Table structure for table `owners` */

DROP TABLE IF EXISTS `owners`;

CREATE TABLE `owners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `card_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `selfie_with_card_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bank` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_code` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `owners` */

LOCK TABLES `owners` WRITE;

insert  into `owners`(`id`,`name`,`email`,`phone`,`photo`,`card_id`,`selfie_with_card_id`,`bank`,`bank_code`,`bank_account`,`bank_account_photo`,`status`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Natanael Kristiawan','natanaelkristiawan@hotmail.com','081353000432',NULL,NULL,NULL,'BANK BCA - 014','014','0501833991',NULL,'0',NULL,'2020-05-22 03:34:20','2020-06-18 17:21:53');

UNLOCK TABLES;

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int DEFAULT NULL,
  `total_quota` int DEFAULT '0',
  `used_quota` int DEFAULT '0',
  `remaining_quota` int DEFAULT '0',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `packages` */

LOCK TABLES `packages` WRITE;

UNLOCK TABLES;

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` text COLLATE utf8mb4_unicode_ci,
  `status_code` text COLLATE utf8mb4_unicode_ci,
  `status_message` text COLLATE utf8mb4_unicode_ci,
  `transaction_id` text COLLATE utf8mb4_unicode_ci,
  `transaction_status` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `payments` */

LOCK TABLES `payments` WRITE;

insert  into `payments`(`id`,`order_id`,`status_code`,`status_message`,`transaction_id`,`transaction_status`,`details`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'09f290f7-8349-450d-8eb4-5660c304d3bb','201','midtrans payment notification','3301f055-0bd8-4ff5-ba88-09cf3c6fb988','pending','{\"va_numbers\":[{\"va_number\":\"81415125839\",\"bank\":\"bca\"}],\"transaction_time\":\"2020-06-09 21:05:19\",\"transaction_status\":\"pending\",\"transaction_id\":\"3301f055-0bd8-4ff5-ba88-09cf3c6fb988\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"201\",\"signature_key\":\"3077c243e7431ead2497f200faed76cba6fe698522fb194202d66726aa6624f50ed3417c119d969f5ed29063f73a03dab63c2fd553a32574644ee3c3052007dd\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"merchant_id\":\"G281781415\",\"gross_amount\":\"1100.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}',NULL,'2020-06-09 21:05:37','2020-06-09 21:05:37'),
(2,'09f290f7-8349-450d-8eb4-5660c304d3bb','200','midtrans payment notification','3301f055-0bd8-4ff5-ba88-09cf3c6fb988','settlement','{\"va_numbers\":[{\"va_number\":\"81415125839\",\"bank\":\"bca\"}],\"transaction_time\":\"2020-06-09 21:05:19\",\"transaction_status\":\"settlement\",\"transaction_id\":\"3301f055-0bd8-4ff5-ba88-09cf3c6fb988\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"dde00a62fb1e76dcfbb9438b11c363ac30303635a033ff785a216195392a4abfd2fd0217f6cf629ce8cc2d6aa33d64628191a90b620dd5eac4a2459790f70572\",\"settlement_time\":\"2020-06-09 21:06:07\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"merchant_id\":\"G281781415\",\"gross_amount\":\"1100.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}',NULL,'2020-06-09 21:06:58','2020-06-09 21:06:58'),
(3,'09f290f7-8349-450d-8eb4-5660c304d3bb','200','midtrans payment notification','3301f055-0bd8-4ff5-ba88-09cf3c6fb988','settlement','{\"va_numbers\":[{\"va_number\":\"81415125839\",\"bank\":\"bca\"}],\"transaction_time\":\"2020-06-09 21:05:19\",\"transaction_status\":\"settlement\",\"transaction_id\":\"3301f055-0bd8-4ff5-ba88-09cf3c6fb988\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"dde00a62fb1e76dcfbb9438b11c363ac30303635a033ff785a216195392a4abfd2fd0217f6cf629ce8cc2d6aa33d64628191a90b620dd5eac4a2459790f70572\",\"settlement_time\":\"2020-06-09 21:06:07\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"merchant_id\":\"G281781415\",\"gross_amount\":\"1100.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}',NULL,'2020-06-09 21:07:41','2020-06-09 21:07:41'),
(4,'09f290f7-8349-450d-8eb4-5660c304d3bb','200','midtrans payment notification','3301f055-0bd8-4ff5-ba88-09cf3c6fb988','settlement','{\"va_numbers\":[{\"va_number\":\"81415125839\",\"bank\":\"bca\"}],\"transaction_time\":\"2020-06-09 21:05:19\",\"transaction_status\":\"settlement\",\"transaction_id\":\"3301f055-0bd8-4ff5-ba88-09cf3c6fb988\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"dde00a62fb1e76dcfbb9438b11c363ac30303635a033ff785a216195392a4abfd2fd0217f6cf629ce8cc2d6aa33d64628191a90b620dd5eac4a2459790f70572\",\"settlement_time\":\"2020-06-09 21:06:07\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"merchant_id\":\"G281781415\",\"gross_amount\":\"1100.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}',NULL,'2020-06-09 21:08:26','2020-06-09 21:08:26'),
(5,'09f290f7-8349-450d-8eb4-5660c304d3bb','200','midtrans payment notification','3301f055-0bd8-4ff5-ba88-09cf3c6fb988','settlement','{\"va_numbers\":[{\"va_number\":\"81415125839\",\"bank\":\"bca\"}],\"transaction_time\":\"2020-06-09 21:05:19\",\"transaction_status\":\"settlement\",\"transaction_id\":\"3301f055-0bd8-4ff5-ba88-09cf3c6fb988\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"dde00a62fb1e76dcfbb9438b11c363ac30303635a033ff785a216195392a4abfd2fd0217f6cf629ce8cc2d6aa33d64628191a90b620dd5eac4a2459790f70572\",\"settlement_time\":\"2020-06-09 21:06:07\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"merchant_id\":\"G281781415\",\"gross_amount\":\"1100.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}',NULL,'2020-06-09 21:19:30','2020-06-09 21:19:30'),
(6,'09f290f7-8349-450d-8eb4-5660c304d3bb','200','midtrans payment notification','3301f055-0bd8-4ff5-ba88-09cf3c6fb988','settlement','{\"va_numbers\":[{\"va_number\":\"81415125839\",\"bank\":\"bca\"}],\"transaction_time\":\"2020-06-09 21:05:19\",\"transaction_status\":\"settlement\",\"transaction_id\":\"3301f055-0bd8-4ff5-ba88-09cf3c6fb988\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"dde00a62fb1e76dcfbb9438b11c363ac30303635a033ff785a216195392a4abfd2fd0217f6cf629ce8cc2d6aa33d64628191a90b620dd5eac4a2459790f70572\",\"settlement_time\":\"2020-06-09 21:06:07\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"merchant_id\":\"G281781415\",\"gross_amount\":\"1100.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}',NULL,'2020-06-09 21:20:24','2020-06-09 21:20:24'),
(7,'09f290f7-8349-450d-8eb4-5660c304d3bb','200','midtrans payment notification','3301f055-0bd8-4ff5-ba88-09cf3c6fb988','settlement','{\"va_numbers\":[{\"va_number\":\"81415125839\",\"bank\":\"bca\"}],\"transaction_time\":\"2020-06-09 21:05:19\",\"transaction_status\":\"settlement\",\"transaction_id\":\"3301f055-0bd8-4ff5-ba88-09cf3c6fb988\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"dde00a62fb1e76dcfbb9438b11c363ac30303635a033ff785a216195392a4abfd2fd0217f6cf629ce8cc2d6aa33d64628191a90b620dd5eac4a2459790f70572\",\"settlement_time\":\"2020-06-09 21:06:07\",\"payment_type\":\"bank_transfer\",\"payment_amounts\":[],\"order_id\":\"09f290f7-8349-450d-8eb4-5660c304d3bb\",\"merchant_id\":\"G281781415\",\"gross_amount\":\"1100.00\",\"fraud_status\":\"accept\",\"currency\":\"IDR\"}',NULL,'2020-06-09 21:23:07','2020-06-09 21:23:07'),
(8,NULL,NULL,NULL,NULL,NULL,'[]',NULL,'2020-07-02 13:05:34','2020-07-02 13:05:34');

UNLOCK TABLES;

/*Table structure for table `reviews` */

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `rating` int DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `reviews` */

LOCK TABLES `reviews` WRITE;

UNLOCK TABLES;

/*Table structure for table `room_date_off` */

DROP TABLE IF EXISTS `room_date_off`;

CREATE TABLE `room_date_off` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `room_date_off` */

LOCK TABLES `room_date_off` WRITE;

UNLOCK TABLES;

/*Table structure for table `rooms` */

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `owner_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address_detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `latitude` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_primary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gallery` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `youtube` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ameneties_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `abstract` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `house_rules` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date_off` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total_room` int DEFAULT NULL,
  `is_featured` tinyint DEFAULT NULL,
  `status` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rooms` */

LOCK TABLES `rooms` WRITE;

insert  into `rooms`(`id`,`meta`,`name`,`slug`,`location_id`,`owner_id`,`type_id`,`address`,`address_detail`,`latitude`,`longitude`,`photo_primary`,`gallery`,`youtube`,`ameneties_ids`,`title`,`abstract`,`description`,`house_rules`,`price`,`date_off`,`total_room`,`is_featured`,`status`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'{\"id\":{\"title\":\"dfgh\",\"tag\":\"dfgh\",\"description\":\"dfgh\"},\"en\":{\"title\":\"dfgh\",\"tag\":\"fgh\",\"description\":\"dfgh\"}}','hallo indonesia','hallo-indonesia',1,1,1,'Jl. Diponegoro No.124, Dauh Puri, Kec. Denpasar Bar., Kota Denpasar, Bali 80232, Indonesia','{\"id\":\"dfgh\",\"en\":\"dfg\"}','-8.66587628321571','115.21537588203125','rooms/2020/06/09/file/breakfast-801827.jpg','[{\"title\":null,\"caption\":\"Breakfast 801827\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/breakfast-801827.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:41\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/breakfast-801827.jpg\",\"file\":\"breakfast-801827.jpg\"},{\"title\":null,\"caption\":\"Architecture 1837150 1920\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/architecture-1837150-1920.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:41\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/architecture-1837150-1920.jpg\",\"file\":\"architecture-1837150-1920.jpg\"},{\"title\":null,\"caption\":\"Hotel 389256\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/hotel-389256.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:41\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/hotel-389256.jpg\",\"file\":\"hotel-389256.jpg\"},{\"title\":null,\"caption\":\"Hotel 1831072 1920\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/hotel-1831072-1920.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:41\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/hotel-1831072-1920.jpg\",\"file\":\"hotel-1831072-1920.jpg\"},{\"title\":null,\"caption\":\"Hotel 4416515 1920\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/hotel-4416515-1920.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:41\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/hotel-4416515-1920.jpg\",\"file\":\"hotel-4416515-1920.jpg\"},{\"title\":null,\"caption\":\"Indoors 4234071 1920\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/indoors-4234071-1920.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:41\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/indoors-4234071-1920.jpg\",\"file\":\"indoors-4234071-1920.jpg\"},{\"title\":null,\"caption\":\"Interior 1026452 1920\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/interior-1026452-1920.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:41\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/interior-1026452-1920.jpg\",\"file\":\"interior-1026452-1920.jpg\"},{\"title\":null,\"caption\":\"Room 2269594 1920\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/room-2269594-1920.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:41\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/room-2269594-1920.jpg\",\"file\":\"room-2269594-1920.jpg\"},{\"title\":null,\"caption\":\"The interior of the 3475656 1920\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/the-interior-of-the-3475656-1920.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:42\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/the-interior-of-the-3475656-1920.jpg\",\"file\":\"the-interior-of-the-3475656-1920.jpg\"},{\"title\":null,\"caption\":\"Travel 1677347 1920\",\"url\":\"https:\\/\\/kamartamu-satya-dev.com\\/image\\/original\\/rooms\\/2020\\/06\\/09\\/gallery\\/travel-1677347-1920.jpg\",\"desc\":null,\"folder\":\"2020\\/06\\/09\\/gallery\",\"time\":\"2020-06-09 21:04:42\",\"path\":\"rooms\\/2020\\/06\\/09\\/gallery\\/travel-1677347-1920.jpg\",\"file\":\"travel-1677347-1920.jpg\"}]',NULL,'[\"5\",\"1\",\"3\",\"2\"]','{\"id\":\"dfgh\",\"en\":\"dfgh\"}','{\"id\":\"<p>dfgh<\\/p>\",\"en\":\"<p>dfgh<\\/p>\"}','{\"id\":\"<p>dfgh<\\/p>\",\"en\":\"<p>dfgh<\\/p>\"}','{\"id\":\"<p>dfgh<\\/p>\",\"en\":\"<p>dfgh<\\/p>\"}','1000','[{\"status\":\"1\",\"date_start\":\"2020-06-30\",\"date_end\":\"2020-07-22\"}]',12,1,'1',NULL,'2020-06-09 21:04:44','2020-09-28 12:18:17');

UNLOCK TABLES;

/*Table structure for table `site` */

DROP TABLE IF EXISTS `site`;

CREATE TABLE `site` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `site` */

LOCK TABLES `site` WRITE;

insert  into `site`(`id`,`name`,`slug`,`value`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Main Banner','main-banner','\"site\\/2020\\/05\\/24\\/site\\/room-2269594-1920.jpg\"',1,'2020-05-18 14:43:39','2020-05-24 10:49:14',NULL),
(2,'Meta','meta','{\"id\":{\"title\":\"hahahaha\",\"tag\":\"Kost di bali, Bali, Jimbaran, Nusa Dua, kamartamu, kost, kost dekat UNUD, kost dekat Politeknik Negeri Bali, kost dekat STP Nusa Dua\",\"description\":\"kamartamu.com adalah website untuk menyewakan dan memesan akomodasi lokal secara online dan terjangkau.\"},\"en\":{\"title\":\"asdasdasd\",\"tag\":\"Kost di bali, Bali, Jimbaran, Nusa Dua, kamartamu, kost, kost dekat UNUD, kost dekat Politeknik Negeri Bali\",\"description\":\"kamartamu.com is a website for renting and booking local accommodation online and is affordable.\"}}',1,'2020-05-18 14:43:39','2020-06-19 10:55:17',NULL),
(3,'Phone','phone','\"081353000432\"',1,'2020-05-18 14:43:39','2020-05-18 14:43:39',NULL),
(4,'Email','email','\"satya@kamartamu.com\"',1,'2020-05-18 14:43:39','2020-05-21 11:01:33',NULL),
(5,'Address','address','\"Jalan Raya Uluwatu, Gang X, No. 14, Ungasan - Badung\"',1,'2020-05-18 14:43:39','2020-05-21 11:01:33',NULL),
(6,'Mission','mission','{\"id\":{\"title\":\"Mengapa Memilih Kita?\",\"description\":\"Baik melalui perdagangan atau hanya pengalaman untuk menceritakan kisah merek Anda, saatnya telah tiba untuk mulai menggunakan bahasa pengembangan yang sesuai dengan kebutuhan proyek Anda.\"},\"en\":{\"title\":\"Why Choose Us?\",\"description\":\"Whether through commerce or just an experience to tell your brand\'s story, the time has come to start using development languages that fit your projects needs.\"}}',1,'2020-05-18 15:26:49','2020-05-21 11:03:34',NULL),
(7,'Mission Banner','mission-banner','\"site\\/2020\\/05\\/24\\/site\\/water-3292794-1920.jpg\"',1,'2020-05-18 15:35:23','2020-05-24 10:49:14',NULL),
(8,'Privacy','privacy','{\"id\":{\"title\":\"sdfg\",\"description\":\"<p>sdfg<\\/p>\"},\"en\":{\"title\":\"dghfdfgikghk\",\"description\":\"<p>ghjlghjl<\\/p>\"}}',1,'2020-05-18 16:13:34','2020-05-18 16:14:50',NULL),
(9,'Privacy Banner','privacy-banner','\"\"',1,'2020-05-18 16:13:34','2020-06-05 16:48:57',NULL),
(10,'Mission Data','mission-data','[{\"id\":{\"title\":\"Sangat Aman dan Penuh Dukungan\",\"description\":\"Jika Anda adalah klien individu, atau hanya startup bisnis yang mencari backlink yang baik untuk situs web Anda.\"},\"en\":{\"title\":\"Fully Secure & Support\",\"description\":\"If you are an individual client, or just a business startup looking for good backlinks for your website.\"},\"icon\":\"fas fa-lock\"},{\"id\":{\"title\":\"Management Media Sosial dan Akun Bisnis\",\"description\":\"Jika Anda adalah klien individu, atau hanya startup bisnis yang mencari backlink yang baik untuk situs web Anda.\"},\"en\":{\"title\":\"Manage Your Social & Busness Account\",\"description\":\"If you are an individual client, or just a business startup looking for good backlinks for your website.\"},\"icon\":\"fab fa-twitter\"},{\"id\":{\"title\":\"Kami Kerja Dengan Hati\",\"description\":\"Jika Anda adalah klien individu, atau hanya startup bisnis yang mencari backlink yang baik untuk situs web Anda.\"},\"en\":{\"title\":\"We Work Hard With Love\",\"description\":\"If you are an individual client, or just a business startup looking for good backlinks for your website.\"},\"icon\":\"far fa-clone\"},{\"id\":{\"title\":\"Harga terjangkau dan penuh dukungan\",\"description\":\"Jika Anda adalah klien individu, atau hanya startup bisnis yang mencari backlink yang baik untuk situs web Anda.\"},\"en\":{\"title\":\"Flexible Price & Support\",\"description\":\"If you are an individual client, or just a business startup looking for good backlinks for your website.\"},\"icon\":\"fas fa-credit-card\"}]',1,'2020-05-19 14:18:36','2020-05-21 11:10:09',NULL),
(11,'Partner','partner','[{\"title\":\"Logo 1\",\"logo\":\"site\\/2020\\/06\\/04\\/site\\/hotel-1831072-1920.jpg\"}]',1,'2020-05-19 16:20:14','2020-06-04 18:25:58',NULL),
(12,'Aboutus','aboutus','{\"id\":{\"title\":\"asdf\",\"description\":\"<p>asdf<\\/p>\"},\"en\":{\"title\":\"sdf\",\"description\":\"<p>sdfg<\\/p>\"}}',1,'2020-05-30 02:21:32','2020-05-30 02:21:32',NULL),
(13,'Aboutus Banner','aboutus-banner','\"site\\/2020\\/05\\/30\\/site\\/travel-1677347-1920.jpg\"',1,'2020-05-30 02:21:32','2020-05-30 02:21:32',NULL),
(14,'Condition','condition','{\"id\":{\"title\":null,\"description\":null},\"en\":{\"title\":null,\"description\":null}}',1,'2020-05-30 02:21:32','2020-05-30 02:21:32',NULL),
(15,'Condition Banner','condition-banner','\"\"',1,'2020-05-30 02:21:32','2020-05-30 02:21:32',NULL),
(16,'Payment','payment','{\"id\":{\"title\":null,\"description\":null},\"en\":{\"title\":null,\"description\":null}}',1,'2020-05-30 02:21:32','2020-05-30 02:21:32',NULL),
(17,'Payment Banner','payment-banner','\"\"',1,'2020-05-30 02:21:32','2020-05-30 02:21:32',NULL),
(18,'Main Logo','main-logo','\"site\\/2020\\/06\\/17\\/site\\/logo_1.png\"',1,'2020-06-17 09:51:31','2020-06-17 09:52:27',NULL),
(19,'Media Facebook','media-facebook','\"asdasd\"',1,'2020-06-19 11:43:51','2020-06-19 11:43:51',NULL),
(20,'Media Instagram','media-instagram','\"\"',1,'2020-06-19 11:43:51','2020-06-19 11:43:51',NULL),
(21,'Media Twitter','media-twitter','\"\"',1,'2020-06-19 11:43:51','2020-06-19 11:43:51',NULL),
(22,'Media Linkedin','media-linkedin','\"\"',1,'2020-06-19 11:43:51','2020-06-19 11:43:51',NULL);

UNLOCK TABLES;

/*Table structure for table `types` */

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint DEFAULT '0',
  `status` tinyint DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `types` */

LOCK TABLES `types` WRITE;

insert  into `types`(`id`,`name`,`slug`,`content`,`is_featured`,`status`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Home Stay','home-stay','{\"id\":\"Kost\",\"en\":\"Home Stay\"}',1,1,NULL,'2020-05-12 15:11:28','2020-05-22 06:39:06'),
(2,'Cottage','cottage','{\"id\":\"Pondok\",\"en\":\"Cottage\"}',1,1,NULL,'2020-05-12 15:11:56','2020-05-22 03:57:12');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
