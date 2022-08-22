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

 Date: 21/08/2022 23:28:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for encuestas
-- ----------------------------
DROP TABLE IF EXISTS `encuestas`;
CREATE TABLE `encuestas` (
  `idEncuesta` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEncuesta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `datos_empresa_id` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaTermino` date DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encuestaManual` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `publicacion` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `dispositivo` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT 'Si',
  `encuestador` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT 'Si',
  `manual` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT 'Si',
  `estado` enum('Activo','Inactivo','Eliminado') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo',
  PRIMARY KEY (`idEncuesta`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
