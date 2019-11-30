DROP DATABASE IF EXISTS `SCC`;
CREATE DATABASE IF NOT EXISTS `SCC`;
USE `SCC`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `user_roles`;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS  `group_members`;
DROP TABLE IF EXISTS `events`;
DROP TABLE IF EXISTS `bank_information`;
DROP TABLE IF EXISTS `event_organization_participants`;
DROP TABLE IF EXISTS `organizations`;
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `group_posts`;
DROP TABLE IF EXISTS `messages`;
DROP TABLE IF EXISTS `post_comments`;
DROP TABLE IF EXISTS `user_bank_information`;

CREATE TABLE `users` (
  `user_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(254) NOT NULL UNIQUE,
  `password` VARCHAR(300) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `phone_number` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`user_ID`)
);

CREATE TABLE `roles` (
  `role_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`role_ID`)
);

CREATE TABLE `groups` (
  `group_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `manager_ID` INT(10) NOT NULL,
  PRIMARY KEY (group_ID),
  KEY `manager_ID` (`manager_ID`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`manager_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `events` (
  `event_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(10) NOT NULL,
  `manager_ID` INT(10) NOT NULL,
  `date` DATE NOT NULL, /* Date format is yyyy-mm-dd */
  `expiration_date` DATE,
  `status` BOOLEAN DEFAULT TRUE,
  `price` FLOAT(5,2),
  PRIMARY KEY (`event_ID`),
  KEY `manager_ID` (`manager_ID`),
  CONSTRAINT `users_ibfk_4` FOREIGN KEY (`manager_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `bank_information` (
  `bank_information_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `card_number` VARCHAR(16) NOT NULL,
  `expiration_date` DATE NOT NULL,
  PRIMARY KEY (`bank_information_ID`)
);

CREATE TABLE `organizations` (
  `organization_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`organization_ID`)
);

CREATE TABLE `posts` (
  `post_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(60) NOT NULL,
  `text` VARCHAR(4000) NOT NULL,
  `media` MEDIUMBLOB,
  PRIMARY KEY (`post_ID`)
);

CREATE TABLE `messages` (
  `user1_ID` INT(10) NOT NULL,
  `user2_ID` INT(10) NOT NULL,
  `text` VARCHAR(6000) NOT NULL,
  PRIMARY KEY (`user1_ID`, `user2_ID`),
  KEY `user1_ID` (`user1_ID`),
  KEY `user2_ID` (`user2_ID`),
  CONSTRAINT `users_ibfk_6` FOREIGN KEY (`user1_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_7` FOREIGN KEY (`user2_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `post_comments` (
  `post_comment_ID` INT(10) NOT NULL AUTO_INCREMENT,
  `post_ID` INT(10) NOT NULL,
  `comment` VARCHAR(4000) NOT NULL,
  PRIMARY KEY (`post_comment_ID`),
  KEY `post_ID` (`post_ID`),
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_ID`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `user_roles` (
  `user_ID` INT(10) NOT NULL,
  `role_ID` INT(10) NOT NULL,
  PRIMARY KEY (`user_ID`, `role_ID`),
  KEY `user_ID` (`user_ID`),
  KEY `role_ID` (`role_ID`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`role_ID`) REFERENCES `roles` (`role_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `group_members` (
  `group_ID` INT(10) NOT NULL,
  `user_ID` INT(10) NOT NULL,
  PRIMARY KEY (`group_ID`, `user_ID`),
  KEY `group_ID` (`group_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`group_ID`) REFERENCES `groups` (`group_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_3` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `event_organization_participants` (
  `event_ID` INT(10) NOT NULL,
  `organization_ID` INT(10) NOT NULL,
  `user_ID` INT(10) NOT NULL,
  PRIMARY KEY (`event_ID`, `organization_ID`, `user_ID`),
  KEY `event_ID` (`event_ID`),
  KEY `organization_ID` (`organization_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `events` (`event_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `organizations_ibfk_1` FOREIGN KEY (`organization_ID`) REFERENCES `organizations` (`organization_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_5` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `group_posts` (
  `group_ID` INT(10) NOT NULL,
  `post_ID` INT(10) NOT NULL,
  PRIMARY KEY (`group_ID`, `post_ID`),
  KEY `group_ID` (`group_ID`),
  KEY `post_ID` (`post_ID`),
  CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`group_ID`) REFERENCES `groups` (`group_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_ID`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `user_bank_information` (
  `user_ID` INT(10) NOT NULL,
  `bank_information_ID` INT(10) NOT NULL,
  PRIMARY KEY (`user_ID`, `bank_information_ID`),
  KEY `user_ID` (`user_ID`),
  KEY `bank_information_ID` (`bank_information_ID`),
  CONSTRAINT `users_ibfk_8` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_information_ibfk_1` FOREIGN KEY (`bank_information_ID`) REFERENCES `bank_information` (`bank_information_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);
