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

 Date: 21/08/2022 23:54:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for proyectos
-- ----------------------------
DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos` (
  `idProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diasVencidos` int(11) DEFAULT NULL,
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `plazo` timestamp NULL DEFAULT NULL,
  `totalEntregables` int(11) DEFAULT NULL,
  `encargado` int(11) DEFAULT NULL,
  `responsable` int(11) DEFAULT NULL,
      `datos_empresa_id` int(11) DEFAULT NULL,
  `costo` decimal(11,2) DEFAULT 0.00,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estadoActivida` bigint(20) unsigned DEFAULT NULL,
  `estado` enum('Activo','Inactivo','Eliminado') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo',
  PRIMARY KEY (`idProyecto`),
  KEY `FK__usuarios` (`encargado`),
  KEY `FK__usuarios_2` (`responsable`),
  KEY `FK_proyectos_estado_actividades` (`estadoActivida`),
  CONSTRAINT `FK__usuarios` FOREIGN KEY (`encargado`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK__usuarios_2` FOREIGN KEY (`responsable`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_proyectos_estado_actividades` FOREIGN KEY (`estadoActivida`) REFERENCES `estado_actividades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
