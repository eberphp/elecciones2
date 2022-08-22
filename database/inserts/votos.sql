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

 Date: 21/08/2022 23:39:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for votos
-- ----------------------------
DROP TABLE IF EXISTS `votos`;
CREATE TABLE `votos` (
  `idVoto` int(11) NOT NULL AUTO_INCREMENT,
  `encuestaId` int(11) DEFAULT NULL,
  `partidoId` int(11) DEFAULT NULL,
  `departamentoId` int(11) DEFAULT NULL,
    `datos_empresa_id` int(11) DEFAULT NULL,
  `provinciaId` int(11) DEFAULT NULL,
  `distritoId` int(11) DEFAULT NULL,
  `zonaId` int(11) DEFAULT NULL,
  `region` enum('Regional','Distrital','Provincial') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `votos` int(11) DEFAULT NULL,
  `tipoEncuesta` enum('Dispositivo','Encuesta','Manual') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `publicado` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `grafico` enum('Si','No') COLLATE utf8mb4_unicode_ci DEFAULT 'Si',
  `estado` enum('Activo','Inactivo','Eliminado') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo',
  PRIMARY KEY (`idVoto`),
  KEY `FK_votos_candidatos` (`departamentoId`) USING BTREE,
  KEY `FK_votos_provincias` (`provinciaId`),
  KEY `FK_votos_distritos` (`distritoId`),
  KEY `FK_votos_encuestas` (`encuestaId`),
  KEY `FK_votos_partidos` (`partidoId`),
  KEY `FK_votos_zonas` (`zonaId`),
  CONSTRAINT `FK_votos_departamentos` FOREIGN KEY (`departamentoId`) REFERENCES `departamentos` (`id`),
  CONSTRAINT `FK_votos_distritos` FOREIGN KEY (`distritoId`) REFERENCES `distritos` (`id`),
  CONSTRAINT `FK_votos_encuestas` FOREIGN KEY (`encuestaId`) REFERENCES `encuestas` (`idEncuesta`),
  CONSTRAINT `FK_votos_partidos` FOREIGN KEY (`partidoId`) REFERENCES `partidos` (`id`),
  CONSTRAINT `FK_votos_provincias` FOREIGN KEY (`provinciaId`) REFERENCES `provincias` (`id`),
  CONSTRAINT `FK_votos_zonas` FOREIGN KEY (`zonaId`) REFERENCES `zonas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
