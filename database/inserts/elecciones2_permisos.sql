-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: elecciones2
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'Web',1,1,1,1,10),(2,'Datos de la empresa',1,2,1,1,0),(3,'Slider',1,2,2,1,0),(4,'Publicaciones',1,2,3,1,0),(5,'Productos',1,2,4,1,0),(6,'Servicios',1,2,5,1,0),(7,'Redes sociales',1,2,6,1,0),(8,'Nosotros',1,2,7,1,0),(9,'Testimonios',1,2,8,1,0),(10,'Pie de página',1,2,9,1,0),(11,'Términos y condiciones',1,2,10,1,0),(12,'Configuración',2,1,1,1,12),(13,'Cargo',2,2,1,1,0),(14,'Función',2,2,2,1,0),(15,'Estado evaluación',2,2,3,1,0),(16,'Vínculo',2,2,4,1,0),(17,'Tipo de usuario',2,2,5,1,0),(18,'Tipo de ubigeo',2,2,6,1,0),(19,'Tipo de actividad',2,2,7,1,0),(20,'Area',2,2,8,1,0),(21,'Prioridad',2,2,9,1,0),(22,'Estado gestión',2,2,10,1,0),(23,'Usuario responsable',2,2,11,1,0),(24,'Estado actividad',2,2,12,1,0),(25,'Personal',3,1,1,1,24),(26,'Id',3,2,1,1,0),(27,'Nombres y apellidos',3,2,2,1,0),(28,'Cargo 1',3,2,3,1,0),(29,'PPD',3,2,4,1,0),(30,'Perfil',3,2,5,1,0),(31,'Foto',3,2,6,1,0),(32,'CV',3,2,7,1,0),(33,'Evaluación',3,2,8,1,0),(34,'Facebook',3,2,9,1,0),(35,'WhatsApp',3,2,10,1,0),(36,'Instagram',3,2,11,1,0),(37,'Cargo 2',3,2,12,1,0),(38,'Nombre corto',3,2,13,1,0),(39,'Teléfono',3,2,14,1,0),(40,'Referencias',3,2,15,1,0),(41,'Estado',3,2,16,1,0),(42,'Vínculo',3,2,17,1,0),(43,'DNI',3,2,18,1,0),(44,'Fecha ingreso',3,2,19,1,0),(45,'Correo',3,2,20,1,0),(46,'Observaciones',3,2,21,1,0),(47,'Departamento',3,2,22,1,0),(48,'Provincia',3,2,23,1,0),(49,'Distrito',3,2,24,1,0),(50,'Encuestas',4,1,1,1,9),(51,'Ubigeo',4,2,1,1,0),(52,'Partidos',4,2,2,1,0),(53,'Candidatos',4,2,3,1,0),(54,'Crear encuestas',4,2,4,1,0),(55,'Encuestador',4,2,5,1,0),(56,'Registrar encuestas',4,2,6,1,3),(57,'Nuevo',4,3,6,1,0),(58,'Editar',4,3,6,2,0),(59,'Eliminar',4,3,6,3,0),(60,'Validar resultados',4,2,7,1,0),(61,'Resultados',4,2,8,1,0),(62,'Tipo ubigeo',4,2,9,1,3),(63,'Departamento',4,3,9,1,0),(64,'Provincia',4,3,9,2,0),(65,'Distrito',4,3,9,3,0),(66,'Calendario',5,1,1,1,4),(67,'Usuario Nivel 1',5,2,1,1,0),(68,'Usuario Nivel 2',5,2,2,1,0),(69,'Tabla de gestiones',5,2,3,1,3),(70,'Nuevo',5,3,3,1,0),(71,'Editar',5,3,3,2,0),(72,'Eliminar',5,3,3,3,0),(73,'Historial de gestiones',5,2,4,1,3),(74,'Nuevo',5,3,4,1,0),(75,'Editar',5,3,4,2,0),(76,'Eliminar',5,3,4,3,0),(77,'Proyectos',6,1,1,1,7),(78,'Nuevo',6,2,1,1,0),(79,'Editar',6,2,2,1,0),(80,'Eliminar',6,2,3,1,0),(81,'Ver',6,2,4,1,0),(82,'Iniciar',6,2,5,1,0),(83,'Entregables',6,2,6,1,5),(84,'Nuevo',6,3,6,1,0),(85,'Editar',6,3,6,2,0),(86,'Eliminar',6,3,6,3,0),(87,'Ver',6,3,6,4,0),(88,'Iniciar',6,3,6,5,0),(89,'Ajustes',6,2,7,1,4),(90,'Nuevo',6,3,7,1,0),(91,'Editar',6,3,7,2,0),(92,'Eliminar',6,3,7,3,0),(93,'Ver',6,3,7,4,0);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-03 12:45:14
