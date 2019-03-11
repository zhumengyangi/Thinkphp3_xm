/*
Navicat MySQL Data Transfer

Source Server         : table
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : shop0926_goods

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-06 20:21:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for shop0926_admin
-- ----------------------------
DROP TABLE IF EXISTS `shop0926_admin`;
CREATE TABLE `shop0926_admin` (
  `admin_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(45) NOT NULL COMMENT '账号',
  `admin_pwd` char(32) NOT NULL COMMENT '管理员密码',
  `is_use` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用 1启用 0禁用',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of shop0926_admin
-- ----------------------------
INSERT INTO `shop0926_admin` VALUES ('1', 'xszx', 'dsds', '1', '0');
INSERT INTO `shop0926_admin` VALUES ('2', 'xszx', 'dsds', '1', '0');
INSERT INTO `shop0926_admin` VALUES ('3', 'xszx', 'dsds', '1', '0');
INSERT INTO `shop0926_admin` VALUES ('4', '211573', '2dd46f6dc738066c5d27ab216304fe56', '1', '0');

-- ----------------------------
-- Table structure for shop0926_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `shop0926_admin_role`;
CREATE TABLE `shop0926_admin_role` (
  `admin_id` mediumint(8) unsigned NOT NULL COMMENT '管理员id',
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色id',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员角色表';

-- ----------------------------
-- Records of shop0926_admin_role
-- ----------------------------

-- ----------------------------
-- Table structure for shop0926_auth
-- ----------------------------
DROP TABLE IF EXISTS `shop0926_auth`;
CREATE TABLE `shop0926_auth` (
  `auth_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(45) NOT NULL COMMENT '权限名称',
  `module_name` varchar(10) NOT NULL COMMENT '模块名称',
  `controller_name` varchar(10) NOT NULL COMMENT '控制器名称',
  `action_name` varchar(10) NOT NULL COMMENT '方法名称',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '上级权限id 0: 顶级权限',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`auth_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of shop0926_auth
-- ----------------------------
INSERT INTO `shop0926_auth` VALUES ('21', '权限管理', 'model', 'controller', 'add1', '0', '1539340829');
INSERT INTO `shop0926_auth` VALUES ('24', '分类管理', 'Index', '', '', '0', '1539513248');

-- ----------------------------
-- Table structure for shop0926_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop0926_goods`;
CREATE TABLE `shop0926_goods` (
  `goods_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(150) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_big_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_small_logo` varchar(150) NOT NULL DEFAULT '' COMMENT '商品缩略图片',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_num` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  `goods_desc` longtext NOT NULL COMMENT '商品描述',
  `is_sale` int(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架： 1上架0下架',
  `is_delete` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除： 1删除0未删除',
  `goods_add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`goods_id`),
  KEY `is_sale` (`is_sale`),
  KEY `is_delete` (`is_delete`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop0926_goods
-- ----------------------------
INSERT INTO `shop0926_goods` VALUES ('22', '热热', '/Uploads//Goods/2018-09-29/5baed4f1ebf50.jpg', '/Uploads//Goods/2018-09-29/thumb_5baed4f1ebf50.jpg', '112.00', '0', '212', '1', '0', '1538184433');
INSERT INTO `shop0926_goods` VALUES ('19', '辅导费', '/Uploads//Goods/2018-09-28/5bae2279336be.jpg', '/Uploads//Goods/2018-09-28/thumb_5bae2279336be.jpg', '1111.00', '0', '', '1', '0', '1538138745');
INSERT INTO `shop0926_goods` VALUES ('23', '767', '/Uploads//Goods/2018-10-03/5bb45a382dcae.jpg', '/Uploads//Goods/2018-10-03/thumb_5bb45a382dcae.jpg', '121.00', '0', '', '1', '0', '1538546232');
INSERT INTO `shop0926_goods` VALUES ('24', 'few ', '/Uploads//Goods/2018-10-23/5bcee3598ae62.jpg', '/Uploads//Goods/2018-10-23/thumb_5bcee3598ae62.jpg', '111.00', '0', 'fdf ', '1', '0', '1540285273');
INSERT INTO `shop0926_goods` VALUES ('25', '887', '/Uploads//Goods/2018-10-25/5bd15c30d56b0.jpg', '/Uploads//Goods/2018-10-25/thumb_5bd15c30d56b0.jpg', '8678.00', '0', '8678', '1', '0', '1540447280');
INSERT INTO `shop0926_goods` VALUES ('14', '11', '/Uploads//Goods/2018-09-28/5badf28ff107f.jpg', '/Uploads//Goods/2018-09-28/thumb_5badf28ff107f.jpg', '111.00', '0', '111', '1', '0', '1538126479');
INSERT INTO `shop0926_goods` VALUES ('15', 'trt', '/Uploads//Goods/2018-09-28/5bae02f30e386.jpg', '/Uploads//Goods/2018-09-28/thumb_5bae02f30e386.jpg', '121212.00', '0', '', '1', '0', '1538130675');

-- ----------------------------
-- Table structure for shop0926_role
-- ----------------------------
DROP TABLE IF EXISTS `shop0926_role`;
CREATE TABLE `shop0926_role` (
  `role_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) NOT NULL COMMENT '角色名称',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of shop0926_role
-- ----------------------------

-- ----------------------------
-- Table structure for shop0926_role_auth
-- ----------------------------
DROP TABLE IF EXISTS `shop0926_role_auth`;
CREATE TABLE `shop0926_role_auth` (
  `role_id` mediumint(8) unsigned NOT NULL COMMENT '角色id',
  `auth_id` mediumint(8) unsigned NOT NULL COMMENT '权限id',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  KEY `role_id` (`role_id`),
  KEY `auth_id` (`auth_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色权限表';

-- ----------------------------
-- Records of shop0926_role_auth
-- ----------------------------

-- ----------------------------
-- Table structure for show_goods
-- ----------------------------
DROP TABLE IF EXISTS `show_goods`;
CREATE TABLE `show_goods` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of show_goods
-- ----------------------------
INSERT INTO `show_goods` VALUES ('1', null, null);
INSERT INTO `show_goods` VALUES ('2', null, null);
