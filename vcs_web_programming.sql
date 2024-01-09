-- Adminer 4.8.1 MySQL 8.0.35-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `vcs_web_programming`;
CREATE DATABASE `vcs_web_programming` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `vcs_web_programming`;

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE `assignments` (
  `assignment_id` int NOT NULL AUTO_INCREMENT,
  `teacher_id` int NOT NULL,
  `file_path` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`assignment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `assignments`;
INSERT INTO `assignments` (`assignment_id`, `teacher_id`, `file_path`) VALUES
(2,	3,	'/home/ryuu/Workplaces/vcs_web_programming/storages/1217399075-report_challenge_NamPV.pdf'),
(3,	3,	'/home/ryuu/Workplaces/vcs_web_programming/storages/1026354419-report_challenge_NamPV.pdf');

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `content` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `messages`;
INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `content`, `timestamp`) VALUES
(6,	1,	2,	'23213123',	'2024-01-08 02:19:09'),
(12,	3,	1,	'dsadsa',	'2024-01-08 02:58:42'),
(17,	1,	2,	'sadasdas',	'2024-01-08 03:07:39');

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE `submissions` (
  `submission_id` int NOT NULL AUTO_INCREMENT,
  `assignment_id` int NOT NULL,
  `student_id` int NOT NULL,
  `file_path` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`submission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `submissions`;
INSERT INTO `submissions` (`submission_id`, `assignment_id`, `student_id`, `file_path`) VALUES
(4,	2,	1,	'/home/ryuu/Workplaces/vcs_web_programming/storages/1802480946-6474295-report_challenge_NamPV.pdf'),
(5,	3,	1,	'/home/ryuu/Workplaces/vcs_web_programming/storages/1172983695-6474295-report_challenge_NamPV.pdf');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `users`;
INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `name`, `phonenumber`, `avatar`, `role`, `is_deleted`) VALUES
(1,	'student1',	'123456a@',	'student1@vcs',	'Student 1',	'0123456789111222',	'0123456789',	0,	0),
(2,	'student2',	'123456a@',	'student2@vcs',	'Student 2',	'01234567890',	'0123456789',	0,	0),
(3,	'teacher1',	'123456a@',	'teacher1@vcs',	'Teacher 1',	'0123456789',	'0123456789',	1,	0),
(4,	'student3',	'123456a@',	'student3@vcs',	'   ',	'  ',	'',	0,	0),
(5,	'teacher2',	'123456a@',	'teacher2@vcs',	'Teacher 2',	'416465162',	'adsadasfasf',	1,	0);

-- 2024-01-09 03:43:13
