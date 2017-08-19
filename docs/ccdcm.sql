/*
Navicat MySQL Data Transfer

Source Server         : 192.168.0.149_3306
Source Server Version : 50505
Source Host           : 192.168.0.149:3306
Source Database       : ccdcm

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-29 20:04:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for configs
-- ----------------------------
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `con_title` varchar(100) NOT NULL COMMENT '配置名',
  `con_name` varchar(50) NOT NULL COMMENT '英文名称',
  `con_value` varchar(500) DEFAULT '' COMMENT '配置值',
  `con_type` tinyint(3) unsigned DEFAULT '1' COMMENT '类型',
  `status` tinyint(3) unsigned DEFAULT '0' COMMENT '是否禁用0：是1：否',
  `created` datetime DEFAULT NULL COMMENT '创建时间',
  `modified` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of configs
-- ----------------------------
INSERT INTO `configs` VALUES ('1', '网站名称', 'WEB_SITENAME', 'CCDCM', '1', '1', '0000-00-00 00:00:00', '2017-04-13 19:50:22');
INSERT INTO `configs` VALUES ('2', '网站描述', 'WEB_DESCRIPTION', 'CCDCM', '1', '1', '2016-08-08 14:56:08', '2017-04-13 19:50:47');
INSERT INTO `configs` VALUES ('3', '版权信息', 'COPYRIGHT', 'Copyright &copy; 2017 <a href=\"http://www.xpower.com\">xpower&nbsp;</a>.</strong> All rights reserved.', '1', '1', '2016-08-18 18:33:40', '2016-08-18 18:33:40');
INSERT INTO `configs` VALUES ('4', '未执行工单状态', 'UNEXECUTED_WORKORDER_STATUSE_ID', '0', '1', '1', '2017-04-20 10:15:46', '2017-04-20 10:15:49');
INSERT INTO `configs` VALUES ('5', '执行中工单状态', 'EXECUTORY_WORKORDER_STATUSE_ID', '1', '1', '1', '2017-04-20 10:16:20', '2017-04-20 10:16:23');
INSERT INTO `configs` VALUES ('6', '审核中工单状态', 'CHECK_WORKORDER_STATUSE_ID', '2', '1', '1', '2017-04-20 10:16:52', '2017-04-20 10:16:54');
INSERT INTO `configs` VALUES ('7', 'APCIP地址', 'APC_IP', '192.168.0.154', '1', '1', '2017-05-09 09:18:41', '2017-05-09 09:18:48');
INSERT INTO `configs` VALUES ('8', 'APC用户名', 'APC_USERS', 'apc', '1', '1', '2017-05-09 09:19:20', '2017-05-09 09:19:20');
INSERT INTO `configs` VALUES ('9', 'APC密码', 'APC_PASS', 'apc', '1', '1', '2017-05-09 09:20:47', '2017-05-09 09:20:47');
INSERT INTO `configs` VALUES ('10', '库管角色ID', 'WO_ID', '5', '1', '1', '2017-05-17 01:24:38', '2017-05-17 01:24:38');

-- ----------------------------
-- Table structure for managements
-- ----------------------------
DROP TABLE IF EXISTS `managements`;
CREATE TABLE `managements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `structure_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '结构表ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `label` varchar(20) NOT NULL DEFAULT '' COMMENT '中文显示',
  `icon` varchar(30) DEFAULT NULL,
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` varchar(20) NOT NULL DEFAULT '' COMMENT '打开目标窗口',
  `weight` tinyint(4) unsigned DEFAULT '0' COMMENT '权重',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '1，启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of managements
-- ----------------------------
INSERT INTO `managements` VALUES ('1', '1', 'dashboards', '仪表盘', 'fa fa-tachometer', '', '', '0', '1');
INSERT INTO `managements` VALUES ('2', '2', 'articles', '内容管理', 'fa fa-pencil fa-fw', '', '', '1', '1');
INSERT INTO `managements` VALUES ('3', '3', 'users', '用户管理', 'fa fa-user', '', '', '0', '1');
INSERT INTO `managements` VALUES ('4', '3', 'groups', '用户组管理', 'fa fa-users', '', '', '1', '1');
INSERT INTO `managements` VALUES ('5', '5', 'roles', '权限控制', 'fa fa-cog fa-fw', '', '', '9', '1');
INSERT INTO `managements` VALUES ('6', '4', 'taxonomys', '分类管理', 'fa fa-certificate', '', '', '1', '1');
INSERT INTO `managements` VALUES ('7', '5', 'configs', '系统配置', 'fa fa-cog fa-fw', '', '', '8', '1');
INSERT INTO `managements` VALUES ('8', '5', 'structures', '结构管理', 'fa fa-gg', '', '', '2', '1');
INSERT INTO `managements` VALUES ('9', '5', 'managements', '菜单管理', 'fa fa-bars', '', '', '3', '1');
INSERT INTO `managements` VALUES ('10', '5', 'caches', '缓存管理', 'fa fa-fire-extinguis', '', '', '0', '1');
INSERT INTO `managements` VALUES ('11', '2', 'columns', '栏目管理', 'fa fa-pencil fa-fw', '', '', '1', '1');
INSERT INTO `managements` VALUES ('12', '4', 'navigations', '导航管理', 'fa fa-pencil fa-fw', '', '', '0', '1');
INSERT INTO `managements` VALUES ('13', '2', 'Collections', '内容采集', '', '', '', '5', '1');
INSERT INTO `managements` VALUES ('14', '4', 'Companies', '公司管理', 'fa fa-user', '', '', '3', '1');
INSERT INTO `managements` VALUES ('15', '4', 's_roles', '前台角色管理', '', '', '', '2', '1');
INSERT INTO `managements` VALUES ('16', '4', 'menus', '前台菜单管理', '', '', '', '3', '1');
INSERT INTO `managements` VALUES ('17', '4', 'nodes', '前台节点管理', '', '', '', '4', '1');
INSERT INTO `managements` VALUES ('18', '4', 'Mailsets', '邮件管理', 'glyphicon glyphicon-envelope', '', '', '3', '1');
INSERT INTO `managements` VALUES ('19', '5', 'Logs', '日志管理', '', '', '', '3', '1');
INSERT INTO `managements` VALUES ('20', '4', 'Cats', '种类管理', 'fa fa-cog fa-fw', '', '', '3', '1');

-- ----------------------------
-- Table structure for structures
-- ----------------------------
DROP TABLE IF EXISTS `structures`;
CREATE TABLE `structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '' COMMENT '名称',
  `label` varchar(20) NOT NULL DEFAULT '' COMMENT '中文显示',
  `icon` varchar(50) DEFAULT '' COMMENT 'calss名',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` varchar(20) NOT NULL DEFAULT '' COMMENT '打开目标窗口',
  `weight` tinyint(4) unsigned DEFAULT '0' COMMENT '权重',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '1,启用,',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of structures
-- ----------------------------
INSERT INTO `structures` VALUES ('1', 'index', '首页', 'fa fa-home', './index.php', '', '0', '1');
INSERT INTO `structures` VALUES ('2', 'content', '内容', 'fa fa-pencil fa-fw', './content.php', '', '1', '1');
INSERT INTO `structures` VALUES ('3', 'users', '用户', 'fa fa-user', './users.php', '', '2', '1');
INSERT INTO `structures` VALUES ('4', 'basic_configuration', '基础', 'fa fa-certificate', './basic_configuration.php', '', '3', '1');
INSERT INTO `structures` VALUES ('5', 'system_management', '系统', 'fa fa-cog fa-fw', './system_management.php', '', '4', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `surname` varchar(100) DEFAULT '' COMMENT '姓名',
  `password` varchar(255) DEFAULT NULL,
  `group_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `role` varchar(20) DEFAULT '',
  `photo` varchar(255) DEFAULT '',
  `dir` varchar(255) DEFAULT '',
  `email` varchar(100) DEFAULT '' COMMENT '邮箱',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `u_start` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'VIP结束时间',
  `u_end` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'VIP结束时间',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0' COMMENT '公司id',
  `forbidden` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否禁用(1:禁用;0:正常)',
  `phone` varchar(255) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '电话号',
  `department_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '部门ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '', '$2y$10$cfidafDDSdIwZeiel5PG6.9xl5nDizNZopHbT3CL2MMIYDvT0Y3Ve', '1', 'admin', '', '', '', '1', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0', '', '0');
INSERT INTO `users` VALUES ('2', 'test', '', '$2y$10$cfidafDDSdIwZeiel5PG6.9xl5nDizNZopHbT3CL2MMIYDvT0Y3Ve', '2', '', '', '', '', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '0', '', '0');
INSERT INTO `users` VALUES ('3', 'company1', '公司01', '$2y$10$OKkQh5UsTAlzYePJX/zbmu565qjSu9PEeTPlCeVoSJucZAZnC1ENu', '2', '公司管理员', '', '', '', '0', '1', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '0', '', '0');
INSERT INTO `users` VALUES ('4', 'user01', '普通用户001', '$2y$10$B8byVxXkpTCW45GZLUGzHu3gJGFHJnIhJI5ojH4wSobP76dqUNfLq', '3', '', '', '', '', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '0', '', '0');
INSERT INTO `users` VALUES ('5', 'user', '百度的普通员工', '$2y$10$BqxDlfy1zlm/8.Q9IYIXXO5auX0UJHkHNt0COazYgv90ThQMpLhBu', '3', '百度的普通员工', '', '', '', '0', '6', '8', '0000-00-00 00:00:00', '2017-04-24 16:58:13', '1', '0', '15811230890', '15');
INSERT INTO `users` VALUES ('6', 'xiaoli', '小李字', '$2y$10$cfidafDDSdIwZeiel5PG6.9xl5nDizNZopHbT3CL2MMIYDvT0Y3Ve', '3', '', '', '', '', '0', '0', '0', '2017-04-24 16:57:53', '2017-04-24 16:57:53', '1', '0', '18712576541', '14');
INSERT INTO `users` VALUES ('7', 'xiaoming', '小明', '$2y$10$AHHf2O34hqkl.I6aNb1TP.dKjw.b5DKpGnTWPWJZTfALqHqoI3tNC', '3', '', '', '', '', '0', '0', '0', '2017-04-24 17:01:36', '2017-04-24 17:01:36', '1', '0', '13567897654', '16');
INSERT INTO `users` VALUES ('8', 'engineer01', '工程师01', '$2y$10$egHPO9wZejh0iU3vIqk.7OxwVKfDRtZYotjRbwpstc9IdJqmp3Dmu', '3', '', '', '', '', '0', '0', '0', '2017-05-05 09:27:01', '2017-05-05 09:27:01', '1', '0', '15787679856', '18');
INSERT INTO `users` VALUES ('9', 'engineer02', 'php工程师02', '$2y$10$iFM0O8R36.aYs7BXvaYpDOWTVIw2WIBnwEZ89mLhlNH.49ecnR2n6', '3', '', '', '', '', '0', '0', '0', '2017-05-05 09:27:41', '2017-05-05 09:27:41', '1', '0', '13312348765', '18');
INSERT INTO `users` VALUES ('10', 'leader01', 'php工程师领导01', '$2y$10$SDL8EmKZbgzQb4Wb5QcyQeubt0Jyv.LGhuI36pd7C0AmBRQ5fJw6W', '3', '', '', '', '', '0', '0', '0', '2017-05-05 09:28:59', '2017-05-05 09:28:59', '1', '0', '18718281231', '18');
INSERT INTO `users` VALUES ('11', 'zhuli', '助理01', '$2y$10$6OPEacQ/5aSp1gMGPbxQFOH.an4y/.sR4ceBvUSsP2o7xLBbL.bG.', '3', '', '', '', '', '0', '0', '0', '2017-05-05 09:31:28', '2017-05-05 09:31:28', '1', '0', '15788926572', '17');
INSERT INTO `users` VALUES ('12', 'kuguan', '库管员', '$2y$10$t9KHZoq/ej3zl2btnwm3Y.2wIhY9FQGgJsS3KYOuDkl7ZNAmNjTI6', '3', '', '', '', '', '0', '0', '0', '2017-05-05 09:32:38', '2017-05-05 09:32:38', '1', '0', '135761729342', '12');
INSERT INTO `users` VALUES ('13', 'cloudcon', '云控', '$2y$10$nM20p56ZHVyo26wHzoPKEudsfV7s4rLez4jcMj13G.3Q0WMjG3yai', '2', '1', '1', '1', '1213@163.com', '0', '11', '22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '0', '13693640316', '0');
INSERT INTO `users` VALUES ('14', 'cloudcon001', 'cloudcon001', '$2y$10$LrIJCTb5dG65Dt.A7jJ67ev3rRkerYzv.m/PJ2RKsLeHWKFzRwnRu', '3', '', '', '', '', '0', '0', '0', '2017-05-09 17:49:06', '2017-05-09 17:49:06', '5', '0', '13391997878', '23');
INSERT INTO `users` VALUES ('15', 'cloudcon002', 'cloudcon002', '$2y$10$lapepJJgCMJX.YMtJzp.tOOycfs2ud1cSnVMLbO1y0BKRaGrMw4qS', '3', '', '', '', '', '0', '0', '0', '2017-05-09 18:48:04', '2017-05-09 18:48:04', '5', '0', '13798989999', '23');
