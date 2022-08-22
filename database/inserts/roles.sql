/*
 Navicat Premium Data Transfer

 Source Server         : Ebert
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : 146.190.54.219:3306
 Source Schema         : elecciones2

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 19/08/2022 23:52:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idUsuarioCreador` int DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `rol`, `created_at`, `updated_at`, `idUsuarioCreador`, `estado`) VALUES (1, 'Super Admin', NULL, NULL, NULL, NULL);
INSERT INTO `roles` (`id`, `rol`, `created_at`, `updated_at`, `idUsuarioCreador`, `estado`) VALUES (2, 'Admin', NULL, NULL, NULL, NULL);
INSERT INTO `roles` (`id`, `rol`, `created_at`, `updated_at`, `idUsuarioCreador`, `estado`) VALUES (3, 'Encuestador', NULL, NULL, 2, 'activo');
INSERT INTO `roles` (`id`, `rol`, `created_at`, `updated_at`, `idUsuarioCreador`, `estado`) VALUES (6, 'Encuestador2', '2022-07-29 08:30:40', '2022-07-29 08:30:43', 2, 'inactivo');
INSERT INTO `roles` (`id`, `rol`, `created_at`, `updated_at`, `idUsuarioCreador`, `estado`) VALUES (7, 'admin', '2022-07-30 19:53:45', '2022-07-30 19:53:45', 2, 'activo');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
