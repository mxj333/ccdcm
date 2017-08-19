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

 Date: 06/29/2017 13:16:29 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `surname` varchar(100) DEFAULT '' COMMENT '姓名',
  `password` varchar(255) DEFAULT NULL,
  `group_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '用户组ID',
  `role` varchar(20) DEFAULT '',
  `photo` varchar(255) DEFAULT '',
  `dir` varchar(255) DEFAULT '',
  `email` varchar(100) DEFAULT '' COMMENT '邮箱',
  `active` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `u_start` int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'VIP结束时间',
  `u_end` int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'VIP结束时间',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 0 COMMENT '公司id',
  `forbidden` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否禁用(1:禁用;0:正常)',
  `phone` varchar(255) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '电话号',
  `department_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '部门ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'admin', '', '$2y$10$cfidafDDSdIwZeiel5PG6.9xl5nDizNZopHbT3CL2MMIYDvT0Y3Ve', '1', 'admin', '', '', '', '1', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0', '', '0'), ('2', 'test', '测试用户', '$2y$10$cfidafDDSdIwZeiel5PG6.9xl5nDizNZopHbT3CL2MMIYDvT0Y3Ve', '2', '百度管理员', '', '', '', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '0', '', '0'), ('16', 'cloudcon', '云控', '$2y$10$lS3kuPJ6BSe4AuWHcdQ3W.qOzkdFOlELIbUGQI5nuIrcDqyieQA/i', '2', '云控管理员', '', '', '15765487659@qq.com', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '0', '15765487659', '0'), ('17', 'albb', '阿狸', '$2y$10$lS3kuPJ6BSe4AuWHcdQ3W.qOzkdFOlELIbUGQI5nuIrcDqyieQA/i', '2', '阿里巴巴的管理员', '', '', '15688920128@126.com', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '0', '15688920128', '0'), ('18', 'guangda', '光大', '$2y$10$ySskj0nkBec3lyg8pnP38u9oiee99LRl.EHWpwpr6DH1sv/NAkwH.', '2', '光大管理员', '', '', '18675544281@163.com', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '4', '0', '18675544281', '0'), ('19', 'xiaoming', '小明', '$2y$10$EHcNPGWLrCreb67jyZkIUeavOq/WopIF0qg9yYaB1aBBdysshq1Xe', '3', '', '', '', '15688289182@163.com', '0', '0', '0', '2017-06-06 09:35:43', '2017-06-06 09:35:43', '1', '0', '15688289182', '14'), ('20', 'xiaozhang', '小张', '$2y$10$WBQT96Rf2USC7v.tbm4aY.R6Xe558av0bLAxafToiESZFzXt2wNoG', '3', '', '', '', '15765488678@qq.com', '0', '0', '0', '2017-06-06 09:39:23', '2017-06-06 09:39:23', '1', '0', '15765488678', '15'), ('21', 'zhangsan', '张三', '$2y$10$kikXQ9viXxE18HoLVvNZlezsbBveXuPO3Kqvgzwrzf3CA5Yb9wf3K', '3', '', '', '', '17726829302@126.com', '0', '0', '0', '2017-06-06 09:41:18', '2017-06-06 10:20:35', '1', '0', '17726829302', '15'), ('22', 'lisi', '李四', '$2y$10$9xd5fxqkR95GDh9CXHjur.lCfCj.Gvg82s3p8UnZa33G304jAYo3u', '3', '', '', '', '18827629102@126.com', '0', '0', '0', '2017-06-06 09:42:10', '2017-06-06 09:42:10', '1', '0', '18827629102', '15'), ('23', 'wangwu', '王武', '$2y$10$0o0lYSL/7HIjbHgUL65P6.qZEmGCclfT2P2WqnGrzE./..RvHRNOq', '3', '', '', '', '13718283948@126.com', '0', '0', '0', '2017-06-06 09:43:10', '2017-06-06 09:43:10', '1', '0', '13718283948', '14'), ('24', 'zhaoliu', '赵柳', '$2y$10$9Oe6.h6YbNap7RVLV/siBuFWZJd5a7C5rf0LvW6YeO/5gtnf/bQji', '3', '', '', '', '13827384950@163.com', '0', '0', '0', '2017-06-06 09:44:03', '2017-06-06 10:20:52', '1', '0', '13827384950', '14'), ('25', 'engineer01', '一号工程师', '$2y$10$ZuYL712tLBrfivV5DFaOC.RqMZ0DHoj.EkyH6OyxLFzGGYWJoRUQy', '3', '', '', '', '15765487659@qq.com', '0', '0', '0', '2017-06-06 14:43:52', '2017-06-06 14:43:52', '3', '0', '15765487659', '26'), ('26', 'engineer02', '二号工程师', '$2y$10$ApPgMQOhXWu6WBTQz5/7ROURbprb36aSCZgjvUZ7N/XiG/cIx.wre', '3', '', '', '', '15688920128@126.com', '0', '0', '0', '2017-06-06 14:45:05', '2017-06-06 14:45:05', '3', '0', '15688920128', '26'), ('27', 'yanfa01', '研发01号', '$2y$10$lvWODTTIgkhvvrDshUgsRODc.FGNnPLYF1qhhdch2ZQ4gewNNXM7y', '3', '', '', '', '18646789231@qq.com', '0', '0', '0', '2017-06-06 14:46:07', '2017-06-06 14:46:07', '3', '0', '18675544281', '27'), ('28', 'yanfa02', '研发02号', '$2y$10$Y8fupacPx9HuRakAYZRe..Y3Xi4Wz7lTU9imz.SMRBpkKDQO.dI/u', '3', '', '', '', '18675547732@126.com', '0', '0', '0', '2017-06-06 14:47:09', '2017-06-06 14:47:09', '3', '0', '18675547732', '27'), ('29', 'zhuli', '工程师助理', '$2y$10$tzJp7Y1W/PQWsKTSHtM0ve.swnPYqiteudoAzGod9pOw8YsTsBj6W', '3', '', '', '', '17717112322@qqcom', '0', '0', '0', '2017-06-07 09:40:58', '2017-06-07 09:40:58', '3', '0', '17717112322', '27'), ('30', 'zhaoyun', '赵云', '$2y$10$iIH92HbhNz1uQllKwG65dexd6U8uJKj2aTe/BtVhwLJKd./8APrKK', '3', '', '', '', '13698754568@126.com', '0', '0', '0', '2017-06-07 13:37:07', '2017-06-07 13:39:24', '1', '0', '13698754568', '18');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
