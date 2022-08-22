/*
 Navicat Premium Data Transfer

 Source Server         : Local Host
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : elecciones

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 21/08/2022 16:34:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for configuraciones
-- ----------------------------
DROP TABLE IF EXISTS `configuraciones`;
CREATE TABLE `configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ----------------------------
-- Records of configuraciones
-- ----------------------------
BEGIN;
INSERT INTO `configuraciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES (1, 'Sólo Texto', NULL, NULL);
INSERT INTO `configuraciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES (2, 'Estática  con y sin Texto', NULL, NULL);
INSERT INTO `configuraciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES (3, 'Con URL Externa', NULL, NULL);
INSERT INTO `configuraciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES (5, 'Ver Detalle', NULL, NULL);
INSERT INTO `configuraciones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES (6, 'Slider', NULL, NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
