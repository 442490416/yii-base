/*
 Navicat Premium Data Transfer

 Source Server         : qiang
 Source Server Type    : MySQL
 Source Server Version : 50545
 Source Host           : www.83cloud.cn
 Source Database       : yii-base

 Target Server Type    : MySQL
 Target Server Version : 50545
 File Encoding         : utf-8

 Date: 11/10/2018 18:04:30 PM
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `base_admin_access`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_access`;
CREATE TABLE `base_admin_access` (
  `role_id` int(10) unsigned NOT NULL COMMENT '角色id',
  `right_id` int(10) unsigned NOT NULL COMMENT '权限id',
  PRIMARY KEY (`role_id`,`right_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='角色权限表';

-- ----------------------------
--  Table structure for `base_admin_operate_log`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_operate_log`;
CREATE TABLE `base_admin_operate_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '操作日志',
  `admin_id` int(10) unsigned DEFAULT NULL COMMENT '管理员ID',
  `admin_name` varchar(32) CHARACTER SET utf8 DEFAULT '' COMMENT '管理员名称',
  `router` varchar(128) DEFAULT '' COMMENT '路由',
  `operate_desc` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT '操作描述',
  `operate_ip` bigint(20) unsigned DEFAULT NULL COMMENT '操作ip',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `router` (`router`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `base_admin_rights`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_rights`;
CREATE TABLE `base_admin_rights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限表',
  `name` varchar(64) CHARACTER SET utf8 DEFAULT '' COMMENT '权限名称',
  `description` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '权限描述',
  `level` tinyint(3) unsigned DEFAULT NULL COMMENT '登记(0app,1module,2controller,3action)',
  `parent_id` int(10) unsigned DEFAULT '0' COMMENT '父id',
  `range` tinyint(3) unsigned DEFAULT NULL COMMENT '拍讯',
  `is_on` tinyint(3) unsigned DEFAULT '0' COMMENT '是否启用(0未启用1启用)',
  `is_show` tinyint(3) unsigned DEFAULT '1' COMMENT '是否显示(0不显示1显示)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`level`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='权限表';

-- ----------------------------
--  Records of `base_admin_rights`
-- ----------------------------
BEGIN;
INSERT INTO `base_admin_rights` VALUES ('1', 'backend', 'base_admin????', '1', '0', '255', '1', '1'), ('2', 'right', '??', '2', '1', '254', '1', '1'), ('3', 'add', '??', '3', '2', '253', '1', '1'), ('4', 'del', '??', '3', '2', '252', '1', '1'), ('5', 'role', '?????', '2', '1', '250', '1', '1'), ('6', 'admin', '???', '2', '1', '249', '1', '1'), ('7', 'index', '??', '3', '5', '248', '1', '1'), ('8', 'del', '??', '3', '5', '246', '1', '1'), ('9', 'add', '??', '3', '5', '234', '1', '1'), ('10', 'edit', '??', '3', '5', '123', '1', '1'), ('11', 'index', '??', '3', '6', '250', '1', '1'), ('12', 'del', '??', '3', '6', '249', '1', '1'), ('13', 'add', '??', '3', '6', '248', '1', '1'), ('14', 'edit', '??', '3', '6', '247', '1', '1'), ('15', 'show', '????', '3', '2', '0', '1', '1'), ('16', 'on', '????', '3', '2', '0', '1', '1'), ('17', 'add-right', '????', '3', '5', '0', '1', '1'), ('18', 'password', '???????', '3', '6', '0', '1', '1'), ('19', 'super', '????', '3', '6', '0', '1', '1'), ('20', 'backend', '????', '2', '1', '255', '1', '1'), ('21', 'index', '?????', '3', '20', '255', '1', '1'), ('22', 'index', '??', '3', '2', '255', '1', '1'), ('23', 'user-role', '????', '3', '6', '255', '1', '1'), ('24', 'on', '???????', '3', '5', '0', '1', '1'), ('25', 'operate', '????', '2', '1', '10', '1', '1'), ('26', 'operate-log', '????', '2', '1', '9', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `base_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_role`;
CREATE TABLE `base_admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `role_name` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '角色名称',
  `is_on` tinyint(3) unsigned DEFAULT NULL COMMENT '是否启用(0未启用1已启用)',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='角色表';

-- ----------------------------
--  Records of `base_admin_role`
-- ----------------------------
BEGIN;
INSERT INTO `base_admin_role` VALUES ('1', 'BOSS', '1', '2017-05-17 19:23:31', '2017');
COMMIT;

-- ----------------------------
--  Table structure for `base_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_user`;
CREATE TABLE `base_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员',
  `user_name` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '登录名',
  `true_name` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '真实姓名',
  `password` char(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '登录密码',
  `is_on` tinyint(3) unsigned DEFAULT '0' COMMENT '是否启用(0未启用1已启用)',
  `is_super_admin` tinyint(3) unsigned DEFAULT '0' COMMENT '是否是超级管理员(0否1是)',
  `last_login_ip` bigint(20) unsigned DEFAULT NULL COMMENT '上次登录ip',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='后台管理员表';

-- ----------------------------
--  Records of `base_admin_user`
-- ----------------------------
BEGIN;
INSERT INTO `base_admin_user` VALUES ('6', 'qiang', null, '3fe098dfaf08d8dc52991148448572f3', '0', '0', '2034568151', '2018-11-10 13:20:24', '1541832370');
COMMIT;

-- ----------------------------
--  Table structure for `base_admin_user_role`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_user_role`;
CREATE TABLE `base_admin_user_role` (
  `admin_id` int(10) unsigned NOT NULL COMMENT '管理员id',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`admin_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='管理员角色表';

-- ----------------------------
--  Records of `base_admin_user_role`
-- ----------------------------
BEGIN;
INSERT INTO `base_admin_user_role` VALUES ('2', '1');
COMMIT;

-- ----------------------------
--  Table structure for `base_login_log`
-- ----------------------------
DROP TABLE IF EXISTS `base_login_log`;
CREATE TABLE `base_login_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '登录日志id',
  `user_id` int(10) unsigned DEFAULT '0' COMMENT '用户ID',
  `ip` bigint(20) unsigned DEFAULT '0' COMMENT 'ip',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `type` tinyint(3) unsigned DEFAULT '0' COMMENT '登录类型',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip` (`ip`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='登录日志表';

-- ----------------------------
--  Table structure for `base_user`
-- ----------------------------
DROP TABLE IF EXISTS `base_user`;
CREATE TABLE `base_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '昵称',
  `head_img` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT '头像地址',
  `password` char(32) CHARACTER SET utf8 DEFAULT '' COMMENT '登录密码',
  `addition` varchar(64) CHARACTER SET utf8 DEFAULT '' COMMENT 'salt',
  `mobile` bigint(20) unsigned DEFAULT NULL COMMENT '手机号',
  `add_type` tinyint(3) unsigned DEFAULT '0' COMMENT '注册类型',
  `wx_open_id` varchar(64) CHARACTER SET utf8 DEFAULT NULL COMMENT '微信open_id',
  `qq_open_id` varchar(64) CHARACTER SET utf8 DEFAULT NULL COMMENT 'QQ open_id',
  `sina_open_id` varchar(64) CHARACTER SET utf8 DEFAULT NULL COMMENT '新浪微博open_id',
  `wx_public_open_id` varchar(64) CHARACTER SET utf8 DEFAULT NULL COMMENT '微信公众号open_id',
  `add_ip` bigint(20) unsigned DEFAULT '0' COMMENT '注册ip',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `last_login_ip` bigint(20) unsigned DEFAULT '0' COMMENT '上次登录ip',
  `last_login_time` int(10) unsigned DEFAULT '0' COMMENT '上次登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `wx_open_id` (`wx_open_id`),
  UNIQUE KEY `qq_open_id` (`qq_open_id`),
  KEY `sina_open_id` (`sina_open_id`),
  KEY `wx_public_open_id` (`wx_public_open_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

SET FOREIGN_KEY_CHECKS = 1;
