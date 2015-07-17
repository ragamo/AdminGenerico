/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50144
 Source Host           : localhost

 Target Server Type    : MySQL
 Target Server Version : 50144
 File Encoding         : utf-8

 Date: 07/17/2015 22:47:03 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `administrators`
-- ----------------------------
DROP TABLE IF EXISTS `administrators`;
CREATE TABLE `administrators` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_user` varchar(100) DEFAULT NULL,
  `adm_pass` varchar(255) DEFAULT NULL,
  `adm_active` tinyint(4) DEFAULT NULL,
  `adm_permissions` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`adm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `administrators`
-- ----------------------------
BEGIN;
INSERT INTO `administrators` VALUES ('1', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 'home,administrators');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
