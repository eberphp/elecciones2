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

 Date: 19/08/2022 19:57:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for departamentos
-- ----------------------------
DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of departamentos
-- ----------------------------
BEGIN;
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (1, 'AMAZONAS', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (2, 'ANCASH', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (3, 'APURIMAC', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (4, 'AREQUIPA', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (5, 'AYACUCHO', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (6, 'CAJAMARCA', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (7, 'CALLAO', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (8, 'CUSCO', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (9, 'HUANCAVELICA', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (10, 'HUANUCO', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (11, 'ICA', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (12, 'JUNIN', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (13, 'LA LIBERTAD', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (14, 'LAMBAYEQUE', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (15, 'LIMA', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (16, 'LORETO', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (17, 'MADRE DE DIOS', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (18, 'PASCO', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (19, 'PIURA', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (20, 'PUNO', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (21, 'SAN MARTIN', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (22, 'TACNA', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (23, 'TUMBES', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (24, 'UCAYALI', 'activo', '2022-07-27 01:56:54', '2022-07-27 01:56:54');
INSERT INTO `departamentos` (`id`, `departamento`, `estado`, `created_at`, `updated_at`) VALUES (25, 'MOQUEGUA', 'activo', '2022-07-27 02:49:26', '2022-07-27 02:49:26');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
