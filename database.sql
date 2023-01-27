-- Adminer 4.8.1 MySQL 10.4.10-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `addressid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `zipcode` bigint(20) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`addressid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `delivery`;
CREATE TABLE `delivery` (
  `deliveryid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `senderid` int(10) unsigned NOT NULL,
  `receiverid` int(10) unsigned NOT NULL,
  `dimensions` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `driverid` bigint(20) unsigned NOT NULL,
  `currentloc` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `expecteddate` datetime NOT NULL,
  PRIMARY KEY (`deliveryid`),
  KEY `driverid` (`driverid`),
  KEY `senderid` (`senderid`),
  KEY `receiverid` (`receiverid`),
  CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`driverid`) REFERENCES `deliverydrivers` (`driverid`),
  CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`senderid`) REFERENCES `peersinfo` (`peerid`),
  CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`receiverid`) REFERENCES `peersinfo` (`peerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `deliverydrivers`;
CREATE TABLE `deliverydrivers` (
  `driverid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `vehicles` varchar(255) NOT NULL,
  `status` bit(1) NOT NULL,
  PRIMARY KEY (`driverid`),
  CONSTRAINT `deliverydrivers_ibfk_1` FOREIGN KEY (`driverid`) REFERENCES `wp_users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `peersinfo`;
CREATE TABLE `peersinfo` (
  `peerid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `phoneno` int(25) DEFAULT NULL,
  `address` int(10) unsigned NOT NULL,
  PRIMARY KEY (`peerid`),
  KEY `address` (`address`),
  CONSTRAINT `peersinfo_ibfk_1` FOREIGN KEY (`address`) REFERENCES `address` (`addressid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



