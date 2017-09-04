/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cyan

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-04 15:18:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cyan_auth_access
-- ----------------------------
DROP TABLE IF EXISTS `cyan_auth_access`;
CREATE TABLE `cyan_auth_access` (
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色',
  `node_id` mediumint(8) NOT NULL COMMENT '节点id',
  KEY `role_id` (`role_id`),
  KEY `rule_name` (`node_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限授权表';

-- ----------------------------
-- Records of cyan_auth_access
-- ----------------------------
INSERT INTO `cyan_auth_access` VALUES ('11', '19');
INSERT INTO `cyan_auth_access` VALUES ('11', '18');
INSERT INTO `cyan_auth_access` VALUES ('11', '17');
INSERT INTO `cyan_auth_access` VALUES ('10', '15');
INSERT INTO `cyan_auth_access` VALUES ('10', '19');
INSERT INTO `cyan_auth_access` VALUES ('10', '18');
INSERT INTO `cyan_auth_access` VALUES ('10', '17');
INSERT INTO `cyan_auth_access` VALUES ('10', '16');
INSERT INTO `cyan_auth_access` VALUES ('10', '14');
INSERT INTO `cyan_auth_access` VALUES ('10', '13');
INSERT INTO `cyan_auth_access` VALUES ('10', '12');
INSERT INTO `cyan_auth_access` VALUES ('10', '11');
INSERT INTO `cyan_auth_access` VALUES ('10', '10');
INSERT INTO `cyan_auth_access` VALUES ('10', '9');
INSERT INTO `cyan_auth_access` VALUES ('10', '8');
INSERT INTO `cyan_auth_access` VALUES ('10', '7');
INSERT INTO `cyan_auth_access` VALUES ('10', '25');
INSERT INTO `cyan_auth_access` VALUES ('10', '26');
INSERT INTO `cyan_auth_access` VALUES ('10', '24');
INSERT INTO `cyan_auth_access` VALUES ('10', '23');
INSERT INTO `cyan_auth_access` VALUES ('10', '22');
INSERT INTO `cyan_auth_access` VALUES ('10', '21');
INSERT INTO `cyan_auth_access` VALUES ('10', '20');
INSERT INTO `cyan_auth_access` VALUES ('10', '27');
