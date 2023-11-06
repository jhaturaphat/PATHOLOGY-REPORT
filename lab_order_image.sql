/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.170.96_Slave
 Source Server Type    : MySQL
 Source Server Version : 50742 (5.7.42-46-57-log)
 Source Host           : 192.168.170.96:3306
 Source Schema         : dud_hosxp

 Target Server Type    : MySQL
 Target Server Version : 50742 (5.7.42-46-57-log)
 File Encoding         : 65001

 Date: 06/11/2023 09:51:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for lab_order_image
-- ----------------------------
DROP TABLE IF EXISTS `lab_order_image`;
CREATE TABLE `lab_order_image`  (
  `lab_order_number` int(11) NOT NULL DEFAULT 0,
  `image1` longblob NULL,
  `image1_note` text CHARACTER SET tis620 COLLATE tis620_thai_ci NULL,
  `image2` longblob NULL,
  `image2_note` text CHARACTER SET tis620 COLLATE tis620_thai_ci NULL,
  `image3` longblob NULL,
  `image3_note` text CHARACTER SET tis620 COLLATE tis620_thai_ci NULL,
  `image4` longblob NULL,
  `image4_note` text CHARACTER SET tis620 COLLATE tis620_thai_ci NULL,
  `image5` longblob NULL,
  `image5_note` text CHARACTER SET tis620 COLLATE tis620_thai_ci NULL,
  `hos_guid` char(38) CHARACTER SET tis620 COLLATE tis620_thai_ci NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lab_order_number`) USING BTREE,
  INDEX `ix_hos_guid`(`hos_guid`) USING BTREE,
  INDEX `create_at`(`create_at`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = tis620 COLLATE = tis620_thai_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
