/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cyan

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-04 15:18:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cyan_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `cyan_auth_node`;
CREATE TABLE `cyan_auth_node` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `node` varchar(20) DEFAULT NULL COMMENT '方法或控制器',
  `nodename` varchar(20) DEFAULT NULL COMMENT '控制器或方法名',
  `pid` int(10) DEFAULT NULL COMMENT '父id;所属控制器id',
  `sort` int(10) DEFAULT '999' COMMENT '排序',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cyan_auth_node
-- ----------------------------
INSERT INTO `cyan_auth_node` VALUES ('1', 'Admin', '管理员管理', '0', '1', null);
INSERT INTO `cyan_auth_node` VALUES ('21', 'addUser', '添加管理员', '1', '0', null);
INSERT INTO `cyan_auth_node` VALUES ('20', 'sysUser', '管理员列表', '1', '0', null);
INSERT INTO `cyan_auth_node` VALUES ('7', 'role', '进入角色', '1', '1', null);
INSERT INTO `cyan_auth_node` VALUES ('8', 'addRole', '新增角色', '1', '2', null);
INSERT INTO `cyan_auth_node` VALUES ('9', 'editRole', '修改角色', '1', '2', null);
INSERT INTO `cyan_auth_node` VALUES ('10', 'delRole', '删除角色', '1', '3', null);
INSERT INTO `cyan_auth_node` VALUES ('11', 'auth', '权限管理', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('12', 'addChildNode', '控制器节点', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('13', 'delNode', '删除控制器', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('14', 'acNodeHt', '节点操作页', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('15', 'doAddMethod', '执行方法增加', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('16', 'delMethod', '删除方法', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('17', 'addNode', '增加权限节点', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('18', 'eidtNode', '修改控制器', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('19', 'doAddNode', '增加控制器', '1', '5', null);
INSERT INTO `cyan_auth_node` VALUES ('22', 'editSys', '编辑管理员', '1', '0', null);
INSERT INTO `cyan_auth_node` VALUES ('23', 'upSys', '管理员状态', '1', '0', null);
INSERT INTO `cyan_auth_node` VALUES ('24', 'delSys', '删除管理员', '1', '0', null);
INSERT INTO `cyan_auth_node` VALUES ('25', 'getRoleAcc', '获取角色权限', '1', '0', null);
INSERT INTO `cyan_auth_node` VALUES ('26', 'upRoleAcc', '更新角色权限', '1', '0', null);
INSERT INTO `cyan_auth_node` VALUES ('27', 'doAddRole', '增加角色', '1', '0', null);
