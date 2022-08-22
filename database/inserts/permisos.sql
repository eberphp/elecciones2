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

 Date: 19/08/2022 23:52:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `grupo` int NOT NULL,
  `nivel` int NOT NULL,
  `idx` int NOT NULL,
  `sub` int NOT NULL,
  `hijos` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
);

-- ----------------------------
-- Records of permisos
-- ----------------------------
BEGIN;
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (1, 'Web', 1, 1, 1, 1, 10);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (2, 'Datos de la empresa', 1, 2, 1, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (3, 'Slider', 1, 2, 2, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (4, 'Publicaciones', 1, 2, 3, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (5, 'Productos', 1, 2, 4, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (6, 'Servicios', 1, 2, 5, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (7, 'Redes sociales', 1, 2, 6, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (8, 'Nosotros', 1, 2, 7, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (9, 'Testimonios', 1, 2, 8, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (10, 'Pie de página', 1, 2, 9, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (11, 'Términos y condiciones', 1, 2, 10, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (12, 'Configuración', 2, 1, 1, 1, 12);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (13, 'Cargo', 2, 2, 1, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (14, 'Función', 2, 2, 2, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (15, 'Estado evaluación', 2, 2, 3, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (16, 'Vínculo', 2, 2, 4, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (17, 'Tipo de usuario', 2, 2, 5, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (18, 'Tipo de ubigeo', 2, 2, 6, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (19, 'Tipo de actividad', 2, 2, 7, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (20, 'Area', 2, 2, 8, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (21, 'Prioridad', 2, 2, 9, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (22, 'Estado gestión', 2, 2, 10, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (23, 'Usuario responsable', 2, 2, 11, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (24, 'Estado actividad', 2, 2, 12, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (25, 'Personal', 3, 1, 1, 1, 24);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (26, 'Id', 3, 2, 1, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (27, 'Nombres y apellidos', 3, 2, 2, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (28, 'Cargo 1', 3, 2, 3, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (29, 'PPD', 3, 2, 4, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (30, 'Perfil', 3, 2, 5, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (31, 'Foto', 3, 2, 6, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (32, 'CV', 3, 2, 7, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (33, 'Evaluación', 3, 2, 8, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (34, 'Facebook', 3, 2, 9, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (35, 'WhatsApp', 3, 2, 10, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (36, 'Instagram', 3, 2, 11, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (37, 'Cargo 2', 3, 2, 12, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (38, 'Nombre corto', 3, 2, 13, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (39, 'Teléfono', 3, 2, 14, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (40, 'Referencias', 3, 2, 15, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (41, 'Estado', 3, 2, 16, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (42, 'Vínculo', 3, 2, 17, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (43, 'DNI', 3, 2, 18, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (44, 'Fecha ingreso', 3, 2, 19, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (45, 'Correo', 3, 2, 20, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (46, 'Observaciones', 3, 2, 21, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (47, 'Departamento', 3, 2, 22, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (48, 'Provincia', 3, 2, 23, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (49, 'Distrito', 3, 2, 24, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (50, 'Encuestas', 4, 1, 1, 1, 9);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (51, 'Ubigeo', 4, 2, 1, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (52, 'Partidos', 4, 2, 2, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (53, 'Candidatos', 4, 2, 3, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (54, 'Crear encuestas', 4, 2, 4, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (55, 'Encuestador', 4, 2, 5, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (56, 'Registrar encuestas', 4, 2, 6, 1, 3);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (57, 'Nuevo', 4, 3, 6, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (58, 'Editar', 4, 3, 6, 2, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (59, 'Eliminar', 4, 3, 6, 3, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (60, 'Validar resultados', 4, 2, 7, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (61, 'Resultados', 4, 2, 8, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (62, 'Tipo ubigeo', 4, 2, 9, 1, 3);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (63, 'Departamento', 4, 3, 9, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (64, 'Provincia', 4, 3, 9, 2, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (65, 'Distrito', 4, 3, 9, 3, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (66, 'Calendario', 5, 1, 1, 1, 4);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (67, 'Usuario Nivel 1', 5, 2, 1, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (68, 'Usuario Nivel 2', 5, 2, 2, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (69, 'Tabla de gestiones', 5, 2, 3, 1, 3);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (70, 'Nuevo', 5, 3, 3, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (71, 'Editar', 5, 3, 3, 2, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (72, 'Eliminar', 5, 3, 3, 3, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (73, 'Historial de gestiones', 5, 2, 4, 1, 3);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (74, 'Nuevo', 5, 3, 4, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (75, 'Editar', 5, 3, 4, 2, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (76, 'Eliminar', 5, 3, 4, 3, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (77, 'Proyectos', 6, 1, 1, 1, 7);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (78, 'Nuevo', 6, 2, 1, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (79, 'Editar', 6, 2, 2, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (80, 'Eliminar', 6, 2, 3, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (81, 'Ver', 6, 2, 4, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (82, 'Iniciar', 6, 2, 5, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (83, 'Entregables', 6, 2, 6, 1, 5);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (84, 'Nuevo', 6, 3, 6, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (85, 'Editar', 6, 3, 6, 2, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (86, 'Eliminar', 6, 3, 6, 3, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (87, 'Ver', 6, 3, 6, 4, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (88, 'Iniciar', 6, 3, 6, 5, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (89, 'Ajustes', 6, 2, 7, 1, 4);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (90, 'Nuevo', 6, 3, 7, 1, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (91, 'Editar', 6, 3, 7, 2, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (92, 'Eliminar', 6, 3, 7, 3, 0);
INSERT INTO `permisos` (`id`, `nombre`, `grupo`, `nivel`, `idx`, `sub`, `hijos`) VALUES (93, 'Ver', 6, 3, 7, 4, 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
