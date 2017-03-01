-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `text` text,
  `status` enum('new','success') NOT NULL DEFAULT 'new',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `author` (`author`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `fio` varchar(150) NOT NULL DEFAULT '',
  `country` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `phone_check` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phone_check_code` int(5) unsigned NOT NULL,
  `status` enum('active','banned') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `date_created`, `login`, `password`, `email`, `fio`, `country`, `city`, `image`, `phone`, `phone_check`, `phone_check_code`, `status`) VALUES
(1,	'2017-02-25 15:44:33',	'admin',	'202cb962ac59075b964b07152d234b70',	'agentran@gmail.com',	'Ивашко Алексей Алексеевич',	'Украина',	'Чернигов',	'58b1a6610e1cf.jpg',	'380974863640',	1,	9364,	'active');

-- 2017-03-01 04:28:16
