/*
Navicat MySQL Data Transfer

Source Server         : My Connection
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : nitro

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-21 18:46:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `about_section`
-- ----------------------------
DROP TABLE IF EXISTS `about_section`;
CREATE TABLE `about_section` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT,
  `about_heading` varchar(50) DEFAULT '',
  `about_paragraph` text DEFAULT NULL,
  `about_list` varchar(255) DEFAULT NULL,
  `about_img` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of about_section
-- ----------------------------
INSERT INTO `about_section` VALUES ('1', 'For the next great Web', 'Lorem ipsum, dolor sit amet consectetur', 'Hello World, Computer,Keyboard', 'wp-content/themes/astra/inc/assets/images/starter-content/about-us.jpg', '1');

-- ----------------------------
-- Table structure for `blog_categories`
-- ----------------------------
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories` (
  `blogImg_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_cat` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`blogImg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of blog_categories
-- ----------------------------
INSERT INTO `blog_categories` VALUES ('1', 'Creatives', '1');
INSERT INTO `blog_categories` VALUES ('2', 'News', '1');
INSERT INTO `blog_categories` VALUES ('3', 'Design', '1');
INSERT INTO `blog_categories` VALUES ('4', 'HTML 5', '1');
INSERT INTO `blog_categories` VALUES ('5', 'Laravel 11', '1');

-- ----------------------------
-- Table structure for `blog_section`
-- ----------------------------
DROP TABLE IF EXISTS `blog_section`;
CREATE TABLE `blog_section` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) DEFAULT NULL,
  `blog_para` text DEFAULT NULL,
  `upload_by` varchar(20) DEFAULT NULL,
  `blog_img` varchar(255) DEFAULT NULL,
  `blogcat_id` int(11) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of blog_section
-- ----------------------------
INSERT INTO `blog_section` VALUES ('2', 'Where Do You Learn HTML & CSS in 2019?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda nihil aspernatur nemo sunt, qui, harum repudiandae quisquam eaque dolore itaque quod tenetur quo quos labore?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Quae expedita cumque necessitatibus ducimus debitis totam, quasi praesentium eveniet tempore possimus illo esse, facilis? Corrupti possimus quae ipsa pariatur cumque, accusantium tenetur voluptatibus incidunt reprehenderit, quidem repellat sapiente, id, earum obcaecati.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Provident vero tempora aliquam excepturi labore, ad soluta voluptate necessitatibus. Nulla error beatae, quam, facilis suscipit quaerat aperiam minima eveniet quis placeat.', 'Muhammad Zubair', 'imgs/img_7.jpg', '1', '2024-05-21 15:41:36', '1');
INSERT INTO `blog_section` VALUES ('3', 'Laravel the future of Web Developers', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda nihil aspernatur nemo sunt, qui, harum repudiandae quisquam eaque dolore itaque quod tenetur quo quos labore?\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Quae expedita cumque necessitatibus ducimus debitis totam, quasi praesentium eveniet tempore possimus illo esse, facilis? Corrupti possimus quae ipsa pariatur cumque, accusantium tenetur voluptatibus incidunt reprehenderit, quidem repellat sapiente, id, earum obcaecati.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Provident vero tempora aliquam excepturi labore, ad soluta voluptate necessitatibus. Nulla error beatae, quam, facilis suscipit quaerat aperiam minima eveniet quis placeat.', 'Muhammad Sumair', 'imgs/img_8.jpg', '2', '2024-05-21 15:41:38', '1');
INSERT INTO `blog_section` VALUES ('4', 'HTML 5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda nihil aspernatur nemo sunt, qui, harum repudiandae quisquam eaque dolore itaque quod tenetur quo quos labore?<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Quae expedita cumque necessitatibus ducimus debitis totam, quasi praesentium eveniet tempore possimus illo esse, facilis? Corrupti possimus quae ipsa pariatur cumque, accusantium tenetur voluptatibus incidunt reprehenderit, quidem repellat sapiente, id, earum obcaecati.<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Provident vero tempora aliquam excepturi labore, ad soluta voluptate necessitatibus. Nulla error beatae, quam, facilis suscipit quaerat aperiam minima eveniet quis placeat.', 'Muhammad Zubair', 'imgs/img_10.jpg', '3', '2024-05-21 15:50:51', '1');

-- ----------------------------
-- Table structure for `categories_imgs`
-- ----------------------------
DROP TABLE IF EXISTS `categories_imgs`;
CREATE TABLE `categories_imgs` (
  `catImg_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_img` varchar(255) NOT NULL,
  `cat_id` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`catImg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of categories_imgs
-- ----------------------------
INSERT INTO `categories_imgs` VALUES ('1', 'imgs/img_big_1.jpg', '2', '1');
INSERT INTO `categories_imgs` VALUES ('2', 'imgs/img_3.jpg', '4', '1');
INSERT INTO `categories_imgs` VALUES ('4', 'imgs/img_12.jpg', '1', '1');
INSERT INTO `categories_imgs` VALUES ('5', 'imgs/img_7.jpg', '1', '1');

-- ----------------------------
-- Table structure for `categories_section`
-- ----------------------------
DROP TABLE IF EXISTS `categories_section`;
CREATE TABLE `categories_section` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(25) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of categories_section
-- ----------------------------
INSERT INTO `categories_section` VALUES ('1', 'Web', '1');
INSERT INTO `categories_section` VALUES ('2', 'Design', '1');
INSERT INTO `categories_section` VALUES ('4', 'Brand', '1');

-- ----------------------------
-- Table structure for `feature_section`
-- ----------------------------
DROP TABLE IF EXISTS `feature_section`;
CREATE TABLE `feature_section` (
  `fea_id` int(11) NOT NULL AUTO_INCREMENT,
  `fea_heading` varchar(50) DEFAULT '',
  `fea_subheading` varchar(50) DEFAULT '',
  `fea_para` text DEFAULT NULL,
  `fea_btn` int(1) NOT NULL DEFAULT 1,
  `fea_img` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`fea_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of feature_section
-- ----------------------------
INSERT INTO `feature_section` VALUES ('2', 'For the next great Bussiness', 'Lorem ipsum, dolor sit amet consectetur adipisicin', 'Lorem ipsum, dolor sit amet consectetur adipisicin', '1', 'imgs/img_10.jpg', '1');
INSERT INTO `feature_section` VALUES ('3', 'For the next great Web', 'Lorem ipsum, dolor sit amet consectetur adipisicin', 'Lorem ipsum, dolor sit amet consectetur adipisicin', '1', 'imgs/img_big_1.jpg', '1');
INSERT INTO `feature_section` VALUES ('5', 'For the next great AI Future', 'Lorem ipsum, ', 'asdgsdg', '1', 'imgs/img_8.jpg', '1');

-- ----------------------------
-- Table structure for `front_section`
-- ----------------------------
DROP TABLE IF EXISTS `front_section`;
CREATE TABLE `front_section` (
  `fr_id` int(11) NOT NULL AUTO_INCREMENT,
  `welcome_msg` varchar(50) DEFAULT '',
  `paragraph` text DEFAULT NULL,
  `button_switch` int(11) NOT NULL DEFAULT 1,
  `front_bg_img` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`fr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of front_section
-- ----------------------------
INSERT INTO `front_section` VALUES ('1', 'Welcome to My Website', 'Lorem ipsum, dolor sit amet consectetur', '1', 'imgs/hero_2.jpg', '1');

-- ----------------------------
-- Table structure for `team_section`
-- ----------------------------
DROP TABLE IF EXISTS `team_section`;
CREATE TABLE `team_section` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `member` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `member_img` varchar(255) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `twit_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `insta_link` varchar(255) DEFAULT NULL,
  `links_status` int(1) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of team_section
-- ----------------------------
INSERT INTO `team_section` VALUES ('1', 'Muhammad Zubair', 'Full Stack Web Developer', 'imgs/person_2.jpg', 'https://www.facebook.com/zubairarain.arain.73/', '#', 'https://www.linkedin.com/in/muhammad-zubair-b9a728169/', '#', '1', '1');
INSERT INTO `team_section` VALUES ('2', 'Haseeb Khan', 'Content Creator', 'imgs/person_3.jpg', '#', '#', '#', '#', '1', '1');
INSERT INTO `team_section` VALUES ('3', 'Ibrahim Memon', 'WordPress Developer', 'imgs/person_4.jpg', '#', '#', '#', '#', '1', '1');
INSERT INTO `team_section` VALUES ('5', 'Rameez', 'WordPress Developer', 'imgs/person_5.jpg', '#', '#', '#', '#', '1', '1');
INSERT INTO `team_section` VALUES ('6', 'Hammad', 'UI /UX Designer', 'imgs/person_6.jpg', '#', '', '#', '', '1', '1');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Muhammad Zubair', 'zubairarain335@gmail.com', '$2y$10$rBjQvKJUKJH0bnjJhGzW6u.X9QUyBWo2gd6T9CHQ4CiAGntKNWcIS', '1');
