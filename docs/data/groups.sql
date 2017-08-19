/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100206
 Source Host           : 127.0.0.1
 Source Database       : cms

 Target Server Type    : MariaDB
 Target Server Version : 100206
 File Encoding         : utf-8

 Date: 06/29/2017 13:43:43 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `groups`
-- ----------------------------
BEGIN;
INSERT INTO `groups` VALUES ('1', 'Administrator', '2016-06-13 12:51:25', '2016-06-13 12:51:25'), ('2', 'Manager', '2016-06-13 12:51:40', '2016-06-13 12:51:40'), ('3', 'User', '2016-06-13 12:51:49', '2016-06-13 12:51:49');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
