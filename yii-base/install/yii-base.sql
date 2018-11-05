/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : 127.0.0.1
 Source Database       : yii-base

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : utf-8

 Date: 11/03/2018 19:47:47 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色权限表';

-- ----------------------------
--  Table structure for `base_admin_operate_log`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_operate_log`;
CREATE TABLE `base_admin_operate_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '后台管理员操作记录表',
  `admin_id` int(10) unsigned DEFAULT NULL COMMENT '管理员ID',
  `admin_name` varchar(32) DEFAULT '' COMMENT '管理员昵称',
  `title` varchar(64) DEFAULT '' COMMENT '操作标题',
  `router` varchar(128) DEFAULT '' COMMENT '操作路由',
  `operate_desc` varchar(255) DEFAULT '' COMMENT '操作描述',
  `operate_id` int(10) unsigned DEFAULT NULL COMMENT '操作id',
  `operate_ip` bigint(20) unsigned DEFAULT NULL COMMENT '操作ip',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `router` (`router`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `base_admin_rights`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_rights`;
CREATE TABLE `base_admin_rights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '改版后台权限表',
  `name` varchar(64) DEFAULT '' COMMENT '名称',
  `description` varchar(32) DEFAULT NULL COMMENT '菜单名称',
  `level` tinyint(3) unsigned DEFAULT NULL COMMENT '级别(1模块，2控制器，3操作)',
  `parent_id` int(10) unsigned DEFAULT '0' COMMENT '父id(模块的父id为0)',
  `range` tinyint(3) unsigned DEFAULT NULL COMMENT '排序',
  `is_on` tinyint(3) unsigned DEFAULT '0' COMMENT '是否启用(0未启用，1启用)',
  `is_show` tinyint(3) unsigned DEFAULT '1' COMMENT '是否显示(0不显示，1显示)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`level`,`parent_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='改版后台权限表';

-- ----------------------------
--  Records of `base_admin_rights`
-- ----------------------------
BEGIN;
INSERT INTO `base_admin_rights` VALUES ('1', 'backend', 'base_admin后台首页', '1', '0', '255', '1', '1'), ('2', 'right', '节点', '2', '1', '254', '1', '1'), ('3', 'add', '添加', '3', '2', '253', '1', '1'), ('4', 'del', '删除', '3', '2', '252', '1', '1'), ('5', 'role', '角色与权限', '2', '1', '250', '1', '1'), ('6', 'admin', '管理员', '2', '1', '249', '1', '1'), ('7', 'index', '列表', '3', '5', '248', '1', '1'), ('8', 'del', '删除', '3', '5', '246', '1', '1'), ('9', 'add', '添加', '3', '5', '234', '1', '1'), ('10', 'edit', '编辑', '3', '5', '123', '1', '1'), ('11', 'index', '列表', '3', '6', '250', '1', '1'), ('12', 'del', '删除', '3', '6', '249', '1', '1'), ('13', 'add', '添加', '3', '6', '248', '1', '1'), ('14', 'edit', '编辑', '3', '6', '247', '1', '1'), ('15', 'show', '显示设置', '3', '2', '0', '1', '1'), ('16', 'on', '启用设置', '3', '2', '0', '1', '1'), ('17', 'add-right', '分配权限', '3', '5', '0', '1', '1'), ('18', 'password', '重置管理员密码', '3', '6', '0', '1', '1'), ('19', 'super', '设置超管', '3', '6', '0', '1', '1'), ('20', 'backend', '后台首页', '2', '1', '255', '1', '1'), ('21', 'index', '后台欢迎页', '3', '20', '255', '1', '1'), ('22', 'index', '列表', '3', '2', '255', '1', '1'), ('23', 'user-role', '角色管理', '3', '6', '255', '1', '1'), ('24', 'on', '角色启用与禁用', '3', '5', '0', '1', '1'), ('25', 'operate', '操作类型', '2', '1', '10', '1', '1'), ('26', 'operate-log', '操作日志', '2', '1', '9', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `base_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_role`;
CREATE TABLE `base_admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色表',
  `role_name` varchar(32) DEFAULT NULL COMMENT '角色名称',
  `is_on` tinyint(3) unsigned DEFAULT NULL COMMENT '是否启用(0未启用，1启用)',
  `add_time` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `base_admin_role`
-- ----------------------------
BEGIN;
INSERT INTO `base_admin_role` VALUES ('1', 'BOSS', '1', '2017-05-17 19:23:31', '2017-05-18 18:28:34');
COMMIT;

-- ----------------------------
--  Table structure for `base_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_user`;
CREATE TABLE `base_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '后台用户表',
  `user_name` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '登录用户名',
  `true_name` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '真实姓名',
  `password` char(32) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '登录密码',
  `is_on` tinyint(3) unsigned DEFAULT '0' COMMENT '是否启用(0未启用，1启用)',
  `is_super_admin` tinyint(3) unsigned DEFAULT '0' COMMENT '是否为超管(0否，1是)',
  `last_login_ip` bigint(20) unsigned DEFAULT NULL COMMENT '最后一次登录ip',
  `add_time` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `base_admin_user`
-- ----------------------------
BEGIN;
INSERT INTO `base_admin_user` VALUES ('1', 'qiang', '姜海强', '8f17cede0b2c3d7ecf580adc663ec5e4', '1', '1', '3689579474', '2017-05-17 18:54:11', '2017-08-25 18:57:05'), ('2', 'boss', '老板', '2bfcc734100255174507f95dce767db6', '1', '0', '3689579474', '2017-05-17 19:24:13', '2017-05-22 16:10:20');
COMMIT;

-- ----------------------------
--  Table structure for `base_admin_user_role`
-- ----------------------------
DROP TABLE IF EXISTS `base_admin_user_role`;
CREATE TABLE `base_admin_user_role` (
  `admin_id` int(10) unsigned NOT NULL COMMENT '管理员id',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`admin_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '登录日志',
  `user_id` int(10) unsigned DEFAULT '0' COMMENT '用户ID',
  `ip` bigint(20) unsigned DEFAULT '0' COMMENT '登录ip',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `type` tinyint(3) unsigned DEFAULT '0' COMMENT '登录方式(0网站，1微信，2QQ，3新浪微博)',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip` (`ip`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `base_user`
-- ----------------------------
DROP TABLE IF EXISTS `base_user`;
CREATE TABLE `base_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `name` varchar(32) DEFAULT NULL COMMENT '用户名',
  `head_img` varchar(255) DEFAULT '' COMMENT '头像',
  `password` char(32) DEFAULT '' COMMENT '密码',
  `addition` varchar(64) DEFAULT '' COMMENT '密码项',
  `mobile` bigint(20) DEFAULT NULL COMMENT '手机号',
  `sex` tinyint(3) unsigned DEFAULT '1' COMMENT '性别（1男，2女）',
  `add_type` tinyint(3) unsigned DEFAULT '0' COMMENT '注册类型(0网站，1微信，2QQ，3新浪微博)',
  `wx_open_id` varchar(64) DEFAULT NULL COMMENT '微信open_id',
  `qq_open_id` varchar(64) DEFAULT NULL COMMENT 'QQ open_id',
  `sina_open_id` varchar(64) DEFAULT NULL COMMENT '新浪微博open_id',
  `wx_public_open_id` varchar(64) DEFAULT NULL COMMENT '微信公众平台open_id',
  `add_ip` bigint(20) unsigned DEFAULT '0' COMMENT '注册ip',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `last_login_ip` bigint(20) unsigned DEFAULT '0' COMMENT '上次登录ip地址',
  `last_login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上次登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `wx_open_id` (`wx_open_id`),
  UNIQUE KEY `qq_open_id` (`qq_open_id`),
  KEY `sina_open_id` (`sina_open_id`),
  KEY `wx_public_open_id` (`wx_public_open_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
