/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cyan

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-04 15:19:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cyan_auth_user
-- ----------------------------
DROP TABLE IF EXISTS `cyan_auth_user`;
CREATE TABLE `cyan_auth_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '会员自增id',
  `realname` varchar(150) NOT NULL COMMENT '管理员真实姓名',
  `password` varchar(255) NOT NULL COMMENT '管理员登录密码',
  `loginname` varchar(100) DEFAULT NULL COMMENT '管理员登录名',
  `phone` varchar(15) DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cyan_auth_user
-- ----------------------------
INSERT INTO `cyan_auth_user` VALUES ('17', 'super', '14e1b600b1fd579f47433b88e8d85291', 'admin', '13000000000', '1');
INSERT INTO `cyan_auth_user` VALUES ('1', '超级管理员', '123b24c7b5eb74357aa1d57f43decd99', 'cyanadmin', null, '1');
