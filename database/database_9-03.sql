-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: yw_seguros
-- ------------------------------------------------------
-- Server version	5.5.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accesorio_ciudad`
--

DROP TABLE IF EXISTS `accesorio_ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_ciudad` (
  `ciu_id` int(11) NOT NULL,
  `ciu_nombre` varchar(45) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  `pai_id` int(11) NOT NULL,
  PRIMARY KEY (`ciu_id`),
  KEY `fk_accesorio_ciudad_estado1_idx` (`est_id`),
  KEY `fk_accesorio_ciudad_accesorio_pais1_idx` (`pai_id`),
  CONSTRAINT `fk_accesorio_ciudad_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_accesorio_ciudad_accesorio_pais1` FOREIGN KEY (`pai_id`) REFERENCES `accesorio_pais` (`pai_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_ciudad`
--

LOCK TABLES `accesorio_ciudad` WRITE;
/*!40000 ALTER TABLE `accesorio_ciudad` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesorio_ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_clase_mercancia`
--

DROP TABLE IF EXISTS `accesorio_clase_mercancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_clase_mercancia` (
  `cla_mer_id` int(11) NOT NULL AUTO_INCREMENT,
  `cla_mer_nombre` varchar(45) DEFAULT NULL,
  `cla_mer_fecha_creacion` datetime DEFAULT NULL,
  `cla_mer_fecha_edicion` datetime DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`cla_mer_id`),
  KEY `fk_accesorio_clase_mercancia_estado1_idx` (`est_id`),
  CONSTRAINT `fk_accesorio_clase_mercancia_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_clase_mercancia`
--

LOCK TABLES `accesorio_clase_mercancia` WRITE;
/*!40000 ALTER TABLE `accesorio_clase_mercancia` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesorio_clase_mercancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_medio_transporte`
--

DROP TABLE IF EXISTS `accesorio_medio_transporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_medio_transporte` (
  `med_tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_tra_nombre` varchar(45) DEFAULT NULL,
  `med_tra_fecha_creacion` datetime DEFAULT NULL,
  `med_tra_fecha_edicion` datetime DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`med_tra_id`),
  KEY `fk_accesorio_medio_transporte_estado1_idx` (`est_id`),
  CONSTRAINT `fk_accesorio_medio_transporte_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_medio_transporte`
--

LOCK TABLES `accesorio_medio_transporte` WRITE;
/*!40000 ALTER TABLE `accesorio_medio_transporte` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesorio_medio_transporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_pais`
--

DROP TABLE IF EXISTS `accesorio_pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_pais` (
  `pai_id` int(11) NOT NULL AUTO_INCREMENT,
  `pai_nombre` varchar(50) NOT NULL,
  `pai_fecha_creacion` datetime NOT NULL,
  `pai_fecha_edicion` datetime DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`pai_id`),
  KEY `fk_accesorio_pais_estado1_idx` (`est_id`),
  CONSTRAINT `fk_accesorio_pais_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_pais`
--

LOCK TABLES `accesorio_pais` WRITE;
/*!40000 ALTER TABLE `accesorio_pais` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesorio_pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_parametros`
--

DROP TABLE IF EXISTS `accesorio_parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_parametros` (
  `par_id` int(11) NOT NULL AUTO_INCREMENT,
  `par_key` varchar(45) DEFAULT NULL,
  `par_value` text,
  PRIMARY KEY (`par_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_parametros`
--

LOCK TABLES `accesorio_parametros` WRITE;
/*!40000 ALTER TABLE `accesorio_parametros` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesorio_parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_tipo_usuario`
--

DROP TABLE IF EXISTS `accesorio_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_tipo_usuario` (
  `tip_usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_usu_nombre` varchar(45) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  `tip_usu_fecha_creacion` datetime DEFAULT NULL,
  `tip_usu_fecha_edicion` datetime DEFAULT NULL,
  PRIMARY KEY (`tip_usu_id`),
  KEY `fk_accesorio_tipo_usuario_estado_idx` (`est_id`),
  CONSTRAINT `fk_accesorio_tipo_usuario_estado` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_tipo_usuario`
--

LOCK TABLES `accesorio_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `accesorio_tipo_usuario` DISABLE KEYS */;
INSERT INTO `accesorio_tipo_usuario` VALUES (1,'Admin',2,1,NULL,'2016-03-03 19:29:29'),(2,'Empresa',2,1,'2016-03-03 19:27:56','2016-03-03 19:29:57');
/*!40000 ALTER TABLE `accesorio_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_nit` varchar(10) DEFAULT NULL,
  `emp_nombre` varchar(45) DEFAULT NULL,
  `emp_direccion` varchar(50) DEFAULT NULL,
  `emp_telefono` varchar(20) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `fk_empresa_estado1_idx` (`est_id`),
  CONSTRAINT `fk_empresa_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_acceso_historial`
--

DROP TABLE IF EXISTS `log_acceso_historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_acceso_historial` (
  `log_acc_his_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_acc_his_fecha` datetime NOT NULL,
  `mod_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`log_acc_his_id`),
  KEY `fk_eys_log_acceso_historial_modulo1_idx` (`mod_id`),
  KEY `fk_eys_log_acceso_historial_usuario1_idx` (`usu_id`),
  CONSTRAINT `fk_eys_log_acceso_historial_modulo1` FOREIGN KEY (`mod_id`) REFERENCES `modulo` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_acceso_historial_usuario1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1263 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_acceso_historial`
--

LOCK TABLES `log_acceso_historial` WRITE;
/*!40000 ALTER TABLE `log_acceso_historial` DISABLE KEYS */;
INSERT INTO `log_acceso_historial` VALUES (1229,'2016-03-04 01:34:28',3,2),(1230,'2016-03-04 01:34:30',2,2),(1231,'2016-03-04 01:34:32',3,2),(1232,'2016-03-04 01:34:56',2,2),(1233,'2016-03-04 01:34:58',3,2),(1234,'2016-03-04 01:37:38',5,2),(1235,'2016-03-04 01:37:40',4,2),(1236,'2016-03-04 01:37:41',2,2),(1237,'2016-03-04 01:37:42',3,2),(1238,'2016-03-04 01:37:43',2,2),(1239,'2016-03-04 01:37:43',4,2),(1240,'2016-03-04 01:37:44',5,2),(1241,'2016-03-04 01:37:54',5,2),(1242,'2016-03-04 01:38:00',4,2),(1243,'2016-03-04 01:38:01',2,2),(1244,'2016-03-04 01:38:02',3,2),(1245,'2016-03-04 01:38:03',2,2),(1246,'2016-03-04 01:38:03',4,2),(1247,'2016-03-04 01:38:04',5,2),(1248,'2016-03-04 01:38:05',3,2),(1249,'2016-03-04 01:38:52',2,2),(1250,'2016-03-04 01:38:53',2,2),(1251,'2016-03-04 01:38:54',5,2),(1252,'2016-03-04 01:39:10',4,2),(1253,'2016-03-04 01:39:11',2,2),(1254,'2016-03-04 01:39:13',3,2),(1255,'2016-03-04 01:39:17',2,2),(1256,'2016-03-04 01:40:35',2,2),(1257,'2016-03-04 01:41:18',2,2),(1258,'2016-03-07 23:52:01',3,2),(1259,'2016-03-07 23:52:57',2,2),(1260,'2016-03-07 23:52:58',4,2),(1261,'2016-03-07 23:53:00',5,2),(1262,'2016-03-07 23:53:14',3,2);
/*!40000 ALTER TABLE `log_acceso_historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nombre` varchar(45) NOT NULL,
  `mod_clase_icono` varchar(20) DEFAULT NULL,
  `mod_dependencia` int(11) NOT NULL,
  `mod_url` varchar(100) DEFAULT NULL,
  `mod_tipo` int(11) DEFAULT NULL,
  `mod_orden` varchar(45) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  `mod_descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`mod_id`),
  KEY `fk_modulo_estado1_idx` (`est_id`),
  CONSTRAINT `fk_modulo_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,'Usuarios','fa-user',0,'acc',NULL,NULL,1,NULL),(2,'Tipo Usuario','fa-users',1,'tipousuario',NULL,'1',1,NULL),(3,'Usuarios','fa-user',1,'usuario',NULL,'2',1,NULL),(4,'Roles','fa-users',1,'rol',NULL,'3',1,NULL),(5,'Permisos a roles','fa-users',1,'permisorol',NULL,'4',1,NULL);
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo_acceso`
--

DROP TABLE IF EXISTS `modulo_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo_acceso` (
  `mod_id` int(11) NOT NULL,
  `usu_rol_id` int(11) NOT NULL,
  PRIMARY KEY (`mod_id`,`usu_rol_id`),
  KEY `fk_modulo_has_usuario_rol_usuario_rol1_idx` (`usu_rol_id`),
  KEY `fk_modulo_has_usuario_rol_modulo1_idx` (`mod_id`),
  CONSTRAINT `fk_modulo_has_usuario_rol_modulo1` FOREIGN KEY (`mod_id`) REFERENCES `modulo` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_has_usuario_rol_usuario_rol1` FOREIGN KEY (`usu_rol_id`) REFERENCES `usuario_rol` (`usu_rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo_acceso`
--

LOCK TABLES `modulo_acceso` WRITE;
/*!40000 ALTER TABLE `modulo_acceso` DISABLE KEYS */;
INSERT INTO `modulo_acceso` VALUES (2,1),(3,1),(4,1),(5,1);
/*!40000 ALTER TABLE `modulo_acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguro`
--

DROP TABLE IF EXISTS `seguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguro` (
  `seg_id` int(11) NOT NULL AUTO_INCREMENT,
  `seg_fecha_creacion` datetime DEFAULT NULL,
  `seg_fecha_edicion` datetime DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `seg_poliza` varchar(45) DEFAULT NULL,
  `seg_certificado` varchar(45) DEFAULT NULL,
  `seg_do` varchar(45) DEFAULT NULL,
  `seg_valor_asergurado` varchar(45) DEFAULT NULL,
  `seg_usd` varchar(45) DEFAULT NULL,
  `seg_observaciones` text,
  `cla_mer_id` int(11) NOT NULL,
  `ciu_id_origen` int(11) NOT NULL,
  `ciu_id_destino` int(11) NOT NULL,
  `medio_transporte_med_tra_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`seg_id`),
  KEY `fk_seguro_empresa1_idx` (`emp_id`),
  KEY `fk_seguro_accesorio_medio_transporte1_idx` (`medio_transporte_med_tra_id`),
  KEY `fk_seguro_accesorio_clase_mercancia1_idx` (`cla_mer_id`),
  KEY `fk_seguro_estado1_idx` (`est_id`),
  KEY `fk_seguro_accesorio_ciudad1_idx` (`ciu_id_origen`),
  KEY `fk_seguro_accesorio_ciudad2_idx` (`ciu_id_destino`),
  CONSTRAINT `fk_seguro_empresa1` FOREIGN KEY (`emp_id`) REFERENCES `empresa` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_accesorio_medio_transporte1` FOREIGN KEY (`medio_transporte_med_tra_id`) REFERENCES `accesorio_medio_transporte` (`med_tra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_accesorio_clase_mercancia1` FOREIGN KEY (`cla_mer_id`) REFERENCES `accesorio_clase_mercancia` (`cla_mer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_accesorio_ciudad1` FOREIGN KEY (`ciu_id_origen`) REFERENCES `accesorio_ciudad` (`ciu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_accesorio_ciudad2` FOREIGN KEY (`ciu_id_destino`) REFERENCES `accesorio_ciudad` (`ciu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguro`
--

LOCK TABLES `seguro` WRITE;
/*!40000 ALTER TABLE `seguro` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_identificaion` varchar(45) DEFAULT NULL,
  `usu_nombre` varchar(45) NOT NULL,
  `usu_apellido` varchar(45) NOT NULL,
  `usu_username` varchar(20) NOT NULL,
  `usu_correo` varchar(100) NOT NULL,
  `usu_telefono` varchar(45) DEFAULT NULL,
  `usu_celular` varchar(45) DEFAULT NULL,
  `usu_fecha_creacion` datetime NOT NULL,
  `usu_fecha_edicion` datetime DEFAULT NULL,
  `usu_foto` text,
  `usu_contrasena` varchar(32) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  `tip_usu_id` int(11) NOT NULL,
  `usu_rol_id` int(11) DEFAULT NULL,
  `emp_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `fk_usuario_estado1_idx` (`est_id`),
  KEY `fk_usuario_usuario_rol_idx` (`usu_rol_id`),
  CONSTRAINT `fk_usuario_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_usuario_rol` FOREIGN KEY (`usu_rol_id`) REFERENCES `usuario_rol` (`usu_rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (2,'1030673335','Luis Fernando','Yara Quesada','admin','fyara014@gmail.com','5718416','3057452832','0000-00-00 00:00:00',NULL,NULL,'81dc9bdb52d04dc20036dbd8313ed055',1,1,1,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_rol`
--

DROP TABLE IF EXISTS `usuario_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_rol` (
  `usu_rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_rol_nombre` varchar(45) NOT NULL,
  `usu_rol_fecha_creacion` datetime NOT NULL,
  `usu_rol_fecha_edicion` datetime DEFAULT NULL,
  `est_id` int(11) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usu_rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_rol`
--

LOCK TABLES `usuario_rol` WRITE;
/*!40000 ALTER TABLE `usuario_rol` DISABLE KEYS */;
INSERT INTO `usuario_rol` VALUES (1,'Super Admin','0000-00-00 00:00:00',NULL,NULL,NULL),(5,'Generadora','2016-03-03 19:35:47','2016-03-03 19:36:04',1,2),(6,'Transportadora','2016-03-03 19:36:12',NULL,1,2);
/*!40000 ALTER TABLE `usuario_rol` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-09 20:06:42
