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

 Date: 19/08/2022 19:57:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provincias
-- ----------------------------
DROP TABLE IF EXISTS `provincias`;
CREATE TABLE `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idDepartamento` int(11) NOT NULL,
  `provincia` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('activo','inactivo') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of provincias
-- ----------------------------
BEGIN;
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (1, 1, 'CHACHAPOYAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (2, 1, 'BAGUA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (3, 1, 'BONGARA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (4, 1, 'LUYA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (5, 1, 'RODRIGUEZ DE MENDOZA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (6, 1, 'CONDORCANQUI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (7, 1, 'UTCUBAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (8, 2, 'AIJA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (9, 2, 'HUARAZ', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (10, 2, 'BOLOGNESI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (11, 2, 'CARHUAZ', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (12, 2, 'CASMA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (13, 2, 'CORONGO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (14, 2, 'HUAYLAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (15, 2, 'HUARI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (16, 2, 'MARISCAL LUZURIAGA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (17, 2, 'PALLASCA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (18, 2, 'POMABAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (19, 2, 'RECUAY', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (20, 2, 'SANTA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (21, 2, 'SIHUAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (22, 2, 'YUNGAY', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (23, 2, 'ANTONIO RAIMONDI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (24, 2, 'CARLOS FERMIN FITZCARRALD', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (25, 2, 'ASUNCION', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (26, 2, 'HUARMEY', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (27, 2, 'OCROS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (28, 3, 'ABANCAY', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (29, 3, 'AYMARAES', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (30, 3, 'ANDAHUAYLAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (31, 3, 'ANTABAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (32, 3, 'COTABAMBAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (33, 3, 'GRAU', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (34, 3, 'CHINCHEROS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (35, 4, 'AREQUIPA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (36, 4, 'CAYLLOMA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (37, 4, 'CAMANA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (38, 4, 'CARAVELI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (39, 4, 'CASTILLA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (40, 4, 'CONDESUYOS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (41, 4, 'ISLAY', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (42, 4, 'LA UNION', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (43, 5, 'HUAMANGA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (44, 5, 'CANGALLO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (45, 5, 'HUANTA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (46, 5, 'LA MAR', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (47, 5, 'LUCANAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (48, 5, 'PARINACOCHAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (49, 5, 'VICTOR FAJARDO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (50, 5, 'HUANCA SANCOS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (51, 5, 'VILCAS HUAMAN', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (52, 5, 'PAUCAR DEL SARA SARA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (53, 5, 'SUCRE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (54, 6, 'CAJAMARCA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (55, 6, 'CAJABAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (56, 6, 'CELENDIN', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (57, 6, 'CONTUMAZA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (58, 6, 'CUTERVO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (59, 6, 'CHOTA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (60, 6, 'HUALGAYOC', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (61, 6, 'JAEN', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (62, 6, 'SANTA CRUZ', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (63, 6, 'SAN MIGUEL', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (64, 6, 'SAN IGNACIO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (65, 6, 'SAN MARCOS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (66, 6, 'SAN PABLO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (67, 7, 'CALLAO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (68, 8, 'CUSCO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (69, 8, 'CANAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (70, 8, 'ACOMAYO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (71, 8, 'ANTA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (72, 8, 'CALCA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (73, 8, 'CANCHIS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (74, 8, 'CHUMBIVILCAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (75, 8, 'ESPINAR', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (76, 8, 'LA CONVENCION', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (77, 8, 'PARURO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (78, 8, 'PAUCARTAMBO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (79, 8, 'QUISPICANCHI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (80, 8, 'URUBAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (81, 9, 'HUANCAVELICA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (82, 9, 'ACOBAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (83, 9, 'ANGARAES', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (84, 9, 'CASTROVIRREYNA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (85, 9, 'TAYACAJA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (86, 9, 'HUAYTARA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (87, 9, 'CHURCAMPA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (88, 10, 'HUANUCO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (89, 10, 'AMBO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (90, 10, 'DOS DE MAYO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (91, 10, 'HUAMALIES', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (92, 10, 'MARAÑON', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (93, 10, 'LEONCIO PRADO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (94, 10, 'PACHITEA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (95, 10, 'PUERTO INCA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (96, 10, 'HUACAYBAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (97, 10, 'LAURICOCHA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (98, 10, 'YAROWILCA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (99, 11, 'PISCO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (100, 11, 'ICA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (101, 11, 'CHINCHA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (102, 11, 'NASCA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (103, 11, 'PALPA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (104, 12, 'HUANCAYO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (105, 12, 'CONCEPCION', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (106, 12, 'JAUJA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (107, 12, 'JUNIN', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (108, 12, 'TARMA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (109, 12, 'YAULI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (110, 12, 'SATIPO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (111, 12, 'CHANCHAMAYO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (112, 12, 'CHUPACA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (113, 13, 'VIRU', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (114, 13, 'TRUJILLO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (115, 13, 'BOLIVAR', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (116, 13, 'SANCHEZ CARRION', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (117, 13, 'OTUZCO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (118, 13, 'PACASMAYO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (119, 13, 'PATAZ', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (120, 13, 'SANTIAGO DE CHUCO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (121, 13, 'ASCOPE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (122, 13, 'CHEPEN', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (123, 13, 'JULCAN', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (124, 13, 'GRAN CHIMU', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (125, 14, 'CHICLAYO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (126, 14, 'FERREÑAFE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (127, 14, 'LAMBAYEQUE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (128, 15, 'LIMA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (129, 15, 'CAJATAMBO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (130, 15, 'CANTA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (131, 15, 'CAÑETE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (132, 15, 'HUAURA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (133, 15, 'HUAROCHIRI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (134, 15, 'YAUYOS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (135, 15, 'HUARAL', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (136, 15, 'BARRANCA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (137, 15, 'OYON', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (138, 16, 'MAYNAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (139, 16, 'ALTO AMAZONAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (140, 16, 'LORETO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (141, 16, 'REQUENA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (142, 16, 'UCAYALI', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (143, 16, 'MARISCAL RAMON CASTILLA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (144, 16, 'DATEM DEL MARAÑON', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (145, 16, 'PUTUMAYO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (146, 17, 'TAMBOPATA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (147, 17, 'MANU', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (148, 17, 'TAHUAMANU', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (149, 17, 'MARISCAL NIETO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (150, 17, 'GENERAL SANCHEZ CERRO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (151, 17, 'ILO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (152, 18, 'PASCO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (153, 18, 'OXAPAMPA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (154, 18, 'DANIEL ALCIDES CARRION', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (155, 19, 'PIURA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (156, 19, 'AYABACA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (157, 19, 'HUANCABAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (158, 19, 'MORROPON', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (159, 19, 'PAITA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (160, 19, 'SULLANA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (161, 19, 'TALARA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (162, 19, 'SECHURA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (163, 20, 'PUNO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (164, 20, 'AZANGARO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (165, 20, 'CARABAYA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (166, 20, 'CHUCUITO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (167, 20, 'HUANCANE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (168, 20, 'LAMPA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (169, 20, 'MELGAR', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (170, 20, 'SANDIA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (171, 20, 'SAN ROMAN', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (172, 20, 'YUNGUYO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (173, 20, 'SAN ANTONIO DE PUTINA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (174, 20, 'EL COLLAO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (175, 20, 'MOHO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (176, 21, 'MOYOBAMBA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (177, 21, 'HUALLAGA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (178, 21, 'LAMAS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (179, 21, 'MARISCAL CACERES', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (180, 21, 'RIOJA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (181, 21, 'SAN MARTIN', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (182, 21, 'BELLAVISTA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (183, 21, 'TOCACHE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (184, 21, 'PICOTA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (185, 21, 'EL DORADO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (186, 22, 'TACNA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (187, 22, 'TARATA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (188, 22, 'JORGE BASADRE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (189, 22, 'CANDARAVE', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (190, 23, 'TUMBES', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (191, 23, 'ZARUMILLA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (192, 23, 'CONTRALMIRANTE VILLAR', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (193, 24, 'CORONEL PORTILLO', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (194, 24, 'PADRE ABAD', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (195, 24, 'ATALAYA', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (196, 24, 'PURUS', 'activo', '2022-07-27 02:00:58', '2022-07-27 02:00:58');
INSERT INTO `provincias` (`id`, `idDepartamento`, `provincia`, `estado`, `created_at`, `updated_at`) VALUES (197, 25, 'MARISCAL NIETO', 'activo', '2022-07-27 02:49:59', '2022-07-27 02:49:59');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
