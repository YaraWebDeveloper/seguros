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
  `ciu_id` int(11) NOT NULL AUTO_INCREMENT,
  `ciu_nombre` varchar(45) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  PRIMARY KEY (`ciu_id`),
  KEY `fk_accesorio_ciudad_estado1_idx` (`est_id`),
  KEY `fk_accesorio_ciudad_accesorio_pais1_idx` (`dep_id`),
  CONSTRAINT `fk_accesorio_ciudad_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_ciudad`
--

LOCK TABLES `accesorio_ciudad` WRITE;
/*!40000 ALTER TABLE `accesorio_ciudad` DISABLE KEYS */;
INSERT INTO `accesorio_ciudad` VALUES (1,'Bogotá D.C',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_clase_mercancia`
--

LOCK TABLES `accesorio_clase_mercancia` WRITE;
/*!40000 ALTER TABLE `accesorio_clase_mercancia` DISABLE KEYS */;
INSERT INTO `accesorio_clase_mercancia` VALUES (1,'Liquida','0000-00-00 00:00:00',NULL,1);
/*!40000 ALTER TABLE `accesorio_clase_mercancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_departamento`
--

DROP TABLE IF EXISTS `accesorio_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_departamento` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_nombre` varchar(50) NOT NULL,
  `dep_fecha_creacion` datetime NOT NULL,
  `dep_fecha_edicion` datetime DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`dep_id`),
  KEY `fk_accesorio_pais_estado1_idx` (`est_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_departamento`
--

LOCK TABLES `accesorio_departamento` WRITE;
/*!40000 ALTER TABLE `accesorio_departamento` DISABLE KEYS */;
INSERT INTO `accesorio_departamento` VALUES (1,'Bogota D.C','0000-00-00 00:00:00',NULL,1);
/*!40000 ALTER TABLE `accesorio_departamento` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_medio_transporte`
--

LOCK TABLES `accesorio_medio_transporte` WRITE;
/*!40000 ALTER TABLE `accesorio_medio_transporte` DISABLE KEYS */;
INSERT INTO `accesorio_medio_transporte` VALUES (1,'Terrestre','0000-00-00 00:00:00',NULL,1);
/*!40000 ALTER TABLE `accesorio_medio_transporte` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_parametros`
--

LOCK TABLES `accesorio_parametros` WRITE;
/*!40000 ALTER TABLE `accesorio_parametros` DISABLE KEYS */;
INSERT INTO `accesorio_parametros` VALUES (1,'nom_empresa','BERKLEY INTERNACIONAL SEGUROS COLOMBIA S.A.'),(2,'val_dolar','3100');
/*!40000 ALTER TABLE `accesorio_parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_tipo_seguro`
--

DROP TABLE IF EXISTS `accesorio_tipo_seguro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_tipo_seguro` (
  `tip_seg_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_seg_nombre` varchar(45) DEFAULT NULL,
  `tip_seg_valor` varchar(45) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`tip_seg_id`),
  KEY `fk_accesorio_tipo_seguro_estado1_idx` (`est_id`),
  CONSTRAINT `fk_accesorio_tipo_seguro_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_tipo_seguro`
--

LOCK TABLES `accesorio_tipo_seguro` WRITE;
/*!40000 ALTER TABLE `accesorio_tipo_seguro` DISABLE KEYS */;
INSERT INTO `accesorio_tipo_seguro` VALUES (1,'Transportadora','200000000',1),(2,'Generadora','12299',1);
/*!40000 ALTER TABLE `accesorio_tipo_seguro` ENABLE KEYS */;
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
  `tip_seg_id` int(11) DEFAULT NULL,
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
INSERT INTO `accesorio_tipo_usuario` VALUES (1,'Generadora',2,1,NULL,'2016-03-03 19:29:29',2),(2,'Transportadora',2,1,'2016-03-03 19:27:56','2016-03-09 22:44:59',1);
/*!40000 ALTER TABLE `accesorio_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesorio_transportadora`
--

DROP TABLE IF EXISTS `accesorio_transportadora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesorio_transportadora` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_nit` varchar(45) DEFAULT NULL,
  `tra_nombre` varchar(45) DEFAULT NULL,
  `tra_fecha_creacion` varchar(45) DEFAULT NULL,
  `tra_fecha_edicion` varchar(45) DEFAULT NULL,
  `est_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesorio_transportadora`
--

LOCK TABLES `accesorio_transportadora` WRITE;
/*!40000 ALTER TABLE `accesorio_transportadora` DISABLE KEYS */;
INSERT INTO `accesorio_transportadora` VALUES (1,'123456789','Rapido humadea','0000-00-00',NULL,1);
/*!40000 ALTER TABLE `accesorio_transportadora` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'8001202030','Critical Cargos','Calle 70#4-70','5718416',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=1747 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_acceso_historial`
--

LOCK TABLES `log_acceso_historial` WRITE;
/*!40000 ALTER TABLE `log_acceso_historial` DISABLE KEYS */;
INSERT INTO `log_acceso_historial` VALUES (1229,'2016-03-04 01:34:28',3,2),(1230,'2016-03-04 01:34:30',2,2),(1231,'2016-03-04 01:34:32',3,2),(1232,'2016-03-04 01:34:56',2,2),(1233,'2016-03-04 01:34:58',3,2),(1234,'2016-03-04 01:37:38',5,2),(1235,'2016-03-04 01:37:40',4,2),(1236,'2016-03-04 01:37:41',2,2),(1237,'2016-03-04 01:37:42',3,2),(1238,'2016-03-04 01:37:43',2,2),(1239,'2016-03-04 01:37:43',4,2),(1240,'2016-03-04 01:37:44',5,2),(1241,'2016-03-04 01:37:54',5,2),(1242,'2016-03-04 01:38:00',4,2),(1243,'2016-03-04 01:38:01',2,2),(1244,'2016-03-04 01:38:02',3,2),(1245,'2016-03-04 01:38:03',2,2),(1246,'2016-03-04 01:38:03',4,2),(1247,'2016-03-04 01:38:04',5,2),(1248,'2016-03-04 01:38:05',3,2),(1249,'2016-03-04 01:38:52',2,2),(1250,'2016-03-04 01:38:53',2,2),(1251,'2016-03-04 01:38:54',5,2),(1252,'2016-03-04 01:39:10',4,2),(1253,'2016-03-04 01:39:11',2,2),(1254,'2016-03-04 01:39:13',3,2),(1255,'2016-03-04 01:39:17',2,2),(1256,'2016-03-04 01:40:35',2,2),(1257,'2016-03-04 01:41:18',2,2),(1258,'2016-03-07 23:52:01',3,2),(1259,'2016-03-07 23:52:57',2,2),(1260,'2016-03-07 23:52:58',4,2),(1261,'2016-03-07 23:53:00',5,2),(1262,'2016-03-07 23:53:14',3,2),(1263,'2016-03-10 02:08:09',3,2),(1264,'2016-03-10 02:09:23',3,2),(1265,'2016-03-10 02:10:11',3,2),(1266,'2016-03-10 02:10:54',5,2),(1267,'2016-03-10 02:11:27',4,2),(1268,'2016-03-10 02:11:28',5,2),(1269,'2016-03-10 02:11:29',4,2),(1270,'2016-03-10 02:11:30',2,2),(1271,'2016-03-10 02:11:31',3,2),(1272,'2016-03-10 02:12:16',3,2),(1273,'2016-03-10 02:12:16',3,2),(1274,'2016-03-10 02:17:34',3,2),(1275,'2016-03-10 02:18:50',3,2),(1276,'2016-03-10 02:19:14',3,2),(1277,'2016-03-10 02:19:40',3,2),(1278,'2016-03-10 02:19:57',3,2),(1279,'2016-03-10 02:20:28',3,2),(1280,'2016-03-10 02:21:45',3,2),(1281,'2016-03-10 02:22:35',3,2),(1282,'2016-03-10 02:24:29',3,2),(1283,'2016-03-10 02:26:01',3,2),(1284,'2016-03-10 02:26:09',3,2),(1285,'2016-03-10 02:27:55',3,2),(1286,'2016-03-10 02:28:02',3,2),(1287,'2016-03-10 02:28:17',3,2),(1288,'2016-03-10 02:29:54',3,2),(1289,'2016-03-10 02:30:34',3,2),(1290,'2016-03-10 02:30:34',3,2),(1291,'2016-03-10 02:30:55',3,2),(1292,'2016-03-10 02:34:09',3,2),(1293,'2016-03-10 02:35:19',3,2),(1294,'2016-03-10 02:35:30',3,2),(1295,'2016-03-10 02:35:45',3,2),(1296,'2016-03-10 02:36:39',3,2),(1297,'2016-03-10 02:37:18',3,2),(1298,'2016-03-10 02:37:30',3,2),(1299,'2016-03-10 02:42:15',3,2),(1300,'2016-03-10 02:42:58',3,2),(1301,'2016-03-10 03:37:58',3,2),(1302,'2016-03-10 03:39:38',3,2),(1303,'2016-03-10 03:40:05',3,2),(1304,'2016-03-10 03:41:56',2,2),(1305,'2016-03-10 03:43:36',3,2),(1306,'2016-03-10 03:45:37',3,2),(1307,'2016-03-10 03:45:53',3,2),(1308,'2016-03-10 03:46:25',3,2),(1309,'2016-03-10 03:46:28',3,2),(1310,'2016-03-10 03:47:02',3,2),(1311,'2016-03-10 03:47:04',3,2),(1312,'2016-03-10 03:47:07',3,2),(1313,'2016-03-10 03:47:19',3,2),(1314,'2016-03-10 04:06:00',2,2),(1315,'2016-03-10 04:06:17',2,2),(1316,'2016-03-10 04:06:32',2,2),(1317,'2016-03-10 04:39:23',2,2),(1318,'2016-03-10 04:44:41',2,2),(1319,'2016-03-10 04:44:48',2,2),(1320,'2016-03-10 04:44:50',2,2),(1321,'2016-03-10 04:44:59',2,2),(1322,'2016-03-10 04:45:12',5,2),(1323,'2016-03-10 04:48:44',5,2),(1324,'2016-03-10 04:48:53',5,2),(1325,'2016-03-10 04:49:34',5,2),(1326,'2016-03-10 04:52:59',5,2),(1327,'2016-03-10 04:53:00',5,2),(1328,'2016-03-10 04:53:05',5,2),(1329,'2016-03-10 04:53:22',7,3),(1330,'2016-03-10 04:53:23',7,3),(1331,'2016-03-10 04:53:30',7,3),(1332,'2016-03-10 04:55:41',7,3),(1333,'2016-03-10 04:55:51',7,3),(1334,'2016-03-10 04:55:57',7,3),(1335,'2016-03-10 04:56:05',7,3),(1336,'2016-03-10 04:56:07',7,3),(1337,'2016-03-10 04:56:09',7,3),(1338,'2016-03-10 04:56:13',7,3),(1339,'2016-03-10 04:56:21',7,3),(1340,'2016-03-10 04:56:27',7,3),(1341,'2016-03-10 04:56:33',7,3),(1342,'2016-03-10 04:58:24',7,3),(1343,'2016-03-10 04:58:39',7,3),(1344,'2016-03-10 05:00:21',7,3),(1345,'2016-03-10 05:00:32',7,3),(1346,'2016-03-10 05:01:26',7,3),(1347,'2016-03-10 05:01:50',7,3),(1348,'2016-03-10 05:01:54',7,3),(1349,'2016-03-10 05:01:54',7,3),(1350,'2016-03-10 05:02:06',7,3),(1351,'2016-03-10 05:02:09',7,3),(1352,'2016-03-10 05:03:05',7,3),(1353,'2016-03-10 05:03:16',7,3),(1354,'2016-03-10 05:03:29',7,3),(1355,'2016-03-10 05:03:45',7,3),(1356,'2016-03-10 05:04:07',7,3),(1357,'2016-03-10 05:04:08',7,3),(1358,'2016-03-10 05:04:09',7,3),(1359,'2016-03-10 05:04:10',7,3),(1360,'2016-03-10 05:04:38',7,3),(1361,'2016-03-10 05:04:54',7,3),(1362,'2016-03-10 05:05:16',7,3),(1363,'2016-03-10 05:05:24',7,3),(1364,'2016-03-10 05:05:53',7,3),(1365,'2016-03-10 05:05:54',7,3),(1366,'2016-03-10 05:05:55',7,3),(1367,'2016-03-10 05:05:59',7,3),(1368,'2016-03-10 05:06:21',7,3),(1369,'2016-03-10 05:06:26',7,3),(1370,'2016-03-10 05:06:51',7,3),(1371,'2016-03-10 05:08:03',7,3),(1372,'2016-03-10 05:08:51',7,3),(1373,'2016-03-10 05:08:52',7,3),(1374,'2016-03-10 05:09:21',7,3),(1375,'2016-03-10 05:10:33',7,3),(1376,'2016-03-10 05:10:34',7,3),(1377,'2016-03-10 05:11:46',7,3),(1378,'2016-03-10 05:12:13',7,3),(1379,'2016-03-10 05:12:43',7,3),(1380,'2016-03-10 05:16:55',7,3),(1381,'2016-03-10 05:17:06',7,3),(1382,'2016-03-10 05:19:35',7,3),(1383,'2016-03-10 05:19:54',7,3),(1384,'2016-03-10 05:20:28',7,3),(1385,'2016-03-10 05:21:15',7,3),(1386,'2016-03-10 05:21:47',7,3),(1387,'2016-03-10 05:22:31',7,3),(1388,'2016-03-10 05:22:33',7,3),(1389,'2016-03-10 05:23:43',7,3),(1390,'2016-03-10 05:24:22',7,3),(1391,'2016-03-10 05:24:35',7,3),(1392,'2016-03-10 05:24:41',7,3),(1393,'2016-03-10 05:24:42',7,3),(1394,'2016-03-10 05:24:44',7,3),(1395,'2016-03-10 05:25:28',7,3),(1396,'2016-03-10 05:25:29',7,3),(1397,'2016-03-10 05:25:34',7,3),(1398,'2016-03-10 05:25:35',7,3),(1399,'2016-03-10 05:25:53',7,3),(1400,'2016-03-10 05:25:54',7,3),(1401,'2016-03-10 05:25:55',7,3),(1402,'2016-03-10 05:26:07',7,3),(1403,'2016-03-10 05:26:15',7,3),(1404,'2016-03-10 05:26:16',7,3),(1405,'2016-03-10 05:26:29',7,3),(1406,'2016-03-10 05:26:30',7,3),(1407,'2016-03-10 05:26:53',7,3),(1408,'2016-03-10 05:27:38',7,3),(1409,'2016-03-10 05:28:17',7,3),(1410,'2016-03-10 05:28:18',7,3),(1411,'2016-03-10 05:28:19',7,3),(1412,'2016-03-10 05:31:41',7,3),(1413,'2016-03-10 05:32:33',7,3),(1414,'2016-03-10 05:32:58',7,3),(1415,'2016-03-10 05:33:36',7,3),(1416,'2016-03-10 05:34:22',7,3),(1417,'2016-03-10 05:34:30',7,3),(1418,'2016-03-10 05:35:00',7,3),(1419,'2016-03-10 05:35:03',7,3),(1420,'2016-03-10 05:35:10',7,3),(1421,'2016-03-10 05:35:52',7,3),(1422,'2016-03-10 05:35:54',7,3),(1423,'2016-03-10 05:36:42',7,3),(1424,'2016-03-10 05:39:03',7,3),(1425,'2016-03-10 05:39:50',7,3),(1426,'2016-03-10 05:40:55',7,3),(1427,'2016-03-10 05:41:50',7,3),(1428,'2016-03-10 05:41:51',7,3),(1429,'2016-03-10 05:42:10',7,3),(1430,'2016-03-10 05:42:52',7,3),(1431,'2016-03-10 05:44:32',7,3),(1432,'2016-03-10 05:44:48',7,3),(1433,'2016-03-10 05:46:05',7,3),(1434,'2016-03-10 05:46:07',7,3),(1435,'2016-03-10 05:46:18',7,3),(1436,'2016-03-10 05:46:19',7,3),(1437,'2016-03-10 05:46:20',7,3),(1438,'2016-03-10 05:46:52',7,3),(1439,'2016-03-10 05:47:30',7,3),(1440,'2016-03-10 05:47:31',7,3),(1441,'2016-03-10 05:47:35',7,3),(1442,'2016-03-10 05:48:00',7,3),(1443,'2016-03-10 05:48:37',7,3),(1444,'2016-03-10 05:49:10',7,3),(1445,'2016-03-10 05:49:11',7,3),(1446,'2016-03-10 05:49:54',7,3),(1447,'2016-03-10 05:50:05',7,3),(1448,'2016-03-10 05:50:06',7,3),(1449,'2016-03-10 05:50:10',7,3),(1450,'2016-03-10 05:50:11',7,3),(1451,'2016-03-10 05:50:39',7,3),(1452,'2016-03-10 05:50:40',7,3),(1453,'2016-03-10 05:51:43',7,3),(1454,'2016-03-10 05:52:04',7,3),(1455,'2016-03-10 05:52:05',7,3),(1456,'2016-03-10 05:52:32',7,3),(1457,'2016-03-10 05:52:37',7,3),(1458,'2016-03-10 05:52:42',7,3),(1459,'2016-03-10 05:52:44',7,3),(1460,'2016-03-10 05:53:33',7,3),(1461,'2016-03-10 05:53:35',7,3),(1462,'2016-03-10 05:53:43',7,3),(1463,'2016-03-10 05:54:07',7,3),(1464,'2016-03-10 05:54:28',7,3),(1465,'2016-03-10 05:54:47',7,3),(1466,'2016-03-10 05:54:53',7,3),(1467,'2016-03-10 05:57:11',7,3),(1468,'2016-03-10 05:57:45',7,3),(1469,'2016-03-10 05:59:01',7,3),(1470,'2016-03-10 05:59:02',7,3),(1471,'2016-03-10 05:59:31',7,3),(1472,'2016-03-10 05:59:49',7,3),(1473,'2016-03-10 05:59:50',7,3),(1474,'2016-03-10 05:59:59',7,3),(1475,'2016-03-10 06:00:01',7,3),(1476,'2016-03-10 06:00:14',7,3),(1477,'2016-03-10 06:00:38',7,3),(1478,'2016-03-10 06:02:00',7,3),(1479,'2016-03-10 06:02:01',7,3),(1480,'2016-03-10 06:02:11',7,3),(1481,'2016-03-10 06:02:13',7,3),(1482,'2016-03-10 06:02:14',7,3),(1483,'2016-03-10 06:02:14',7,3),(1484,'2016-03-10 06:02:38',7,3),(1485,'2016-03-10 06:03:05',7,3),(1486,'2016-03-10 06:04:45',7,3),(1487,'2016-03-10 06:04:46',7,3),(1488,'2016-03-10 06:05:24',7,3),(1489,'2016-03-10 06:05:25',7,3),(1490,'2016-03-10 06:05:46',7,3),(1491,'2016-03-10 06:05:47',7,3),(1492,'2016-03-10 06:05:54',7,3),(1493,'2016-03-10 06:05:55',7,3),(1494,'2016-03-10 06:07:11',7,3),(1495,'2016-03-10 06:07:17',7,3),(1496,'2016-03-10 06:07:18',7,3),(1497,'2016-03-10 06:07:19',7,3),(1498,'2016-03-10 06:07:22',7,3),(1499,'2016-03-10 06:07:26',7,3),(1500,'2016-03-10 17:11:05',7,3),(1501,'2016-03-10 17:12:26',7,3),(1502,'2016-03-10 17:13:19',7,3),(1503,'2016-03-10 17:13:34',7,3),(1504,'2016-03-10 17:13:55',7,3),(1505,'2016-03-10 17:17:21',7,3),(1506,'2016-03-10 17:17:33',7,3),(1507,'2016-03-10 17:17:43',7,3),(1508,'2016-03-10 17:17:53',7,3),(1509,'2016-03-10 17:18:07',7,3),(1510,'2016-03-10 17:18:30',7,3),(1511,'2016-03-10 17:18:37',7,3),(1512,'2016-03-10 17:19:07',7,3),(1513,'2016-03-10 17:19:32',7,3),(1514,'2016-03-10 17:19:40',7,3),(1515,'2016-03-10 17:19:47',7,3),(1516,'2016-03-10 17:19:54',7,3),(1517,'2016-03-10 17:21:21',7,3),(1518,'2016-03-10 17:21:52',7,3),(1519,'2016-03-10 17:21:53',7,3),(1520,'2016-03-10 17:21:54',7,3),(1521,'2016-03-10 17:22:11',7,3),(1522,'2016-03-10 17:24:10',7,3),(1523,'2016-03-10 17:24:20',7,3),(1524,'2016-03-10 17:24:30',7,3),(1525,'2016-03-10 17:24:31',7,3),(1526,'2016-03-10 17:24:32',7,3),(1527,'2016-03-10 17:24:32',7,3),(1528,'2016-03-10 17:26:01',7,3),(1529,'2016-03-10 17:26:15',7,3),(1530,'2016-03-10 17:26:56',7,3),(1531,'2016-03-10 17:27:21',7,3),(1532,'2016-03-10 17:27:23',7,3),(1533,'2016-03-10 17:27:24',7,3),(1534,'2016-03-10 17:27:25',7,3),(1535,'2016-03-10 17:29:38',7,3),(1536,'2016-03-10 17:30:03',7,3),(1537,'2016-03-10 17:30:20',7,3),(1538,'2016-03-10 17:30:29',7,3),(1539,'2016-03-10 17:32:08',7,3),(1540,'2016-03-10 17:32:14',7,3),(1541,'2016-03-10 17:32:35',7,3),(1542,'2016-03-10 17:33:01',7,3),(1543,'2016-03-10 17:33:39',7,3),(1544,'2016-03-10 17:33:51',7,3),(1545,'2016-03-10 17:33:56',7,3),(1546,'2016-03-10 17:34:54',7,3),(1547,'2016-03-10 17:35:12',7,3),(1548,'2016-03-10 17:35:24',7,3),(1549,'2016-03-10 17:36:11',7,3),(1550,'2016-03-10 17:37:00',7,3),(1551,'2016-03-10 17:39:20',7,3),(1552,'2016-03-10 17:39:59',7,3),(1553,'2016-03-10 17:40:42',7,3),(1554,'2016-03-10 17:42:40',7,3),(1555,'2016-03-10 17:42:48',7,3),(1556,'2016-03-10 17:43:00',7,3),(1557,'2016-03-10 17:43:24',7,3),(1558,'2016-03-10 17:44:50',7,3),(1559,'2016-03-10 17:55:14',7,3),(1560,'2016-03-10 17:56:02',7,3),(1561,'2016-03-10 17:56:28',7,3),(1562,'2016-03-10 17:56:37',7,3),(1563,'2016-03-10 18:11:17',7,3),(1564,'2016-03-10 18:14:52',7,3),(1565,'2016-03-10 18:18:29',7,3),(1566,'2016-03-10 18:18:32',7,3),(1567,'2016-03-10 18:18:55',7,3),(1568,'2016-03-10 18:19:16',7,3),(1569,'2016-03-10 18:20:05',7,3),(1570,'2016-03-10 18:43:48',7,3),(1571,'2016-03-10 18:43:49',7,3),(1572,'2016-03-10 18:43:49',7,3),(1573,'2016-03-10 18:43:50',7,3),(1574,'2016-03-10 18:45:40',7,3),(1575,'2016-03-10 18:45:55',7,3),(1576,'2016-03-10 18:45:56',7,3),(1577,'2016-03-10 18:45:56',7,3),(1578,'2016-03-10 18:45:56',7,3),(1579,'2016-03-10 18:45:56',7,3),(1580,'2016-03-10 18:45:56',7,3),(1581,'2016-03-10 18:45:57',7,3),(1582,'2016-03-10 18:46:07',7,3),(1583,'2016-03-10 18:46:50',7,3),(1584,'2016-03-10 18:46:50',7,3),(1585,'2016-03-10 18:46:51',7,3),(1586,'2016-03-10 18:46:51',7,3),(1587,'2016-03-10 18:46:51',7,3),(1588,'2016-03-10 18:46:59',7,3),(1589,'2016-03-10 18:46:59',7,3),(1590,'2016-03-10 18:46:59',7,3),(1591,'2016-03-10 18:47:09',7,3),(1592,'2016-03-10 18:47:10',7,3),(1593,'2016-03-10 18:47:10',7,3),(1594,'2016-03-10 18:47:32',7,3),(1595,'2016-03-10 18:47:32',7,3),(1596,'2016-03-10 18:47:32',7,3),(1597,'2016-03-10 18:47:52',7,3),(1598,'2016-03-10 18:47:52',7,3),(1599,'2016-03-10 18:47:53',7,3),(1600,'2016-03-10 18:47:53',7,3),(1601,'2016-03-10 18:48:06',7,3),(1602,'2016-03-10 18:48:29',7,3),(1603,'2016-03-10 18:50:57',7,3),(1604,'2016-03-10 18:51:06',7,3),(1605,'2016-03-10 18:51:07',7,3),(1606,'2016-03-10 18:51:07',7,3),(1607,'2016-03-10 18:51:07',7,3),(1608,'2016-03-10 18:51:08',7,3),(1609,'2016-03-10 18:51:08',7,3),(1610,'2016-03-10 18:51:29',7,3),(1611,'2016-03-10 18:51:31',7,3),(1612,'2016-03-10 18:51:31',7,3),(1613,'2016-03-10 18:51:31',7,3),(1614,'2016-03-10 18:51:32',7,3),(1615,'2016-03-10 18:51:32',7,3),(1616,'2016-03-10 18:51:32',7,3),(1617,'2016-03-10 18:51:33',7,3),(1618,'2016-03-10 18:51:34',7,3),(1619,'2016-03-10 18:51:34',7,3),(1620,'2016-03-10 18:51:34',7,3),(1621,'2016-03-10 18:53:02',7,3),(1622,'2016-03-10 18:53:03',7,3),(1623,'2016-03-10 18:53:03',7,3),(1624,'2016-03-10 18:53:03',7,3),(1625,'2016-03-10 18:53:03',7,3),(1626,'2016-03-10 18:53:04',7,3),(1627,'2016-03-10 18:53:04',7,3),(1628,'2016-03-10 19:09:21',7,3),(1629,'2016-03-10 19:09:46',7,3),(1630,'2016-03-10 19:21:49',7,3),(1631,'2016-03-10 19:22:47',7,3),(1632,'2016-03-10 19:23:02',7,3),(1633,'2016-03-10 19:23:27',7,3),(1634,'2016-03-10 19:23:54',7,3),(1635,'2016-03-10 19:25:43',7,3),(1636,'2016-03-10 19:26:19',7,3),(1637,'2016-03-10 19:27:01',7,3),(1638,'2016-03-10 19:27:13',7,3),(1639,'2016-03-10 19:27:41',7,3),(1640,'2016-03-10 19:28:53',7,3),(1641,'2016-03-10 19:28:54',7,3),(1642,'2016-03-10 19:32:55',7,3),(1643,'2016-03-10 19:33:06',7,3),(1644,'2016-03-10 19:34:52',7,3),(1645,'2016-03-10 19:35:00',7,3),(1646,'2016-03-10 19:35:31',7,3),(1647,'2016-03-10 19:35:33',7,3),(1648,'2016-03-10 19:35:33',7,3),(1649,'2016-03-10 19:35:33',7,3),(1650,'2016-03-10 19:36:06',7,3),(1651,'2016-03-10 19:36:19',7,3),(1652,'2016-03-10 19:36:19',7,3),(1653,'2016-03-10 19:37:31',7,3),(1654,'2016-03-10 19:37:47',7,3),(1655,'2016-03-10 19:37:47',7,3),(1656,'2016-03-10 19:39:11',7,3),(1657,'2016-03-10 19:39:23',7,3),(1658,'2016-03-10 19:39:47',7,3),(1659,'2016-03-10 19:40:34',7,3),(1660,'2016-03-10 19:41:05',7,3),(1661,'2016-03-10 19:41:06',7,3),(1662,'2016-03-10 19:41:06',7,3),(1663,'2016-03-10 19:41:06',7,3),(1664,'2016-03-10 19:42:16',7,3),(1665,'2016-03-10 19:43:35',7,3),(1666,'2016-03-10 19:43:53',7,3),(1667,'2016-03-10 19:45:13',7,3),(1668,'2016-03-10 19:45:43',7,3),(1669,'2016-03-10 19:45:59',7,3),(1670,'2016-03-10 19:46:17',7,3),(1671,'2016-03-10 19:46:31',7,3),(1672,'2016-03-10 19:46:39',7,3),(1673,'2016-03-10 19:46:53',7,3),(1674,'2016-03-10 19:47:08',7,3),(1675,'2016-03-10 19:47:19',7,3),(1676,'2016-03-10 19:47:46',7,3),(1677,'2016-03-10 19:48:33',7,3),(1678,'2016-03-10 19:48:46',7,3),(1679,'2016-03-10 19:50:15',7,3),(1680,'2016-03-10 19:50:28',7,3),(1681,'2016-03-10 19:51:45',7,3),(1682,'2016-03-10 19:52:39',7,3),(1683,'2016-03-10 19:53:11',7,3),(1684,'2016-03-10 19:53:35',7,3),(1685,'2016-03-10 19:54:29',7,3),(1686,'2016-03-10 19:54:55',7,3),(1687,'2016-03-10 19:55:25',7,3),(1688,'2016-03-10 19:55:36',7,3),(1689,'2016-03-10 19:55:49',7,3),(1690,'2016-03-10 19:57:32',7,3),(1691,'2016-03-10 19:57:39',7,3),(1692,'2016-03-10 19:58:19',7,3),(1693,'2016-03-10 19:58:46',7,3),(1694,'2016-03-10 19:59:00',7,3),(1695,'2016-03-10 19:59:32',7,3),(1696,'2016-03-10 20:00:25',7,3),(1697,'2016-03-10 20:00:34',7,3),(1698,'2016-03-10 20:00:35',7,3),(1699,'2016-03-10 20:00:36',7,3),(1700,'2016-03-10 20:00:36',7,3),(1701,'2016-03-10 20:00:56',7,3),(1702,'2016-03-10 20:01:13',7,3),(1703,'2016-03-10 20:01:14',7,3),(1704,'2016-03-10 20:02:15',7,3),(1705,'2016-03-10 20:02:30',7,3),(1706,'2016-03-10 20:02:30',7,3),(1707,'2016-03-10 20:03:48',7,3),(1708,'2016-03-10 20:03:59',7,3),(1709,'2016-03-10 20:04:07',7,3),(1710,'2016-03-10 20:04:18',7,3),(1711,'2016-03-10 20:04:48',7,3),(1712,'2016-03-10 20:04:48',7,3),(1713,'2016-03-10 20:05:00',7,3),(1714,'2016-03-10 20:05:45',7,3),(1715,'2016-03-10 20:05:54',7,3),(1716,'2016-03-10 20:06:56',7,3),(1717,'2016-03-10 20:08:05',7,3),(1718,'2016-03-10 20:08:28',7,3),(1719,'2016-03-10 20:08:38',7,3),(1720,'2016-03-10 20:09:22',7,3),(1721,'2016-03-10 20:09:40',7,3),(1722,'2016-03-10 20:10:16',7,3),(1723,'2016-03-10 20:11:01',7,3),(1724,'2016-03-10 20:11:18',7,3),(1725,'2016-03-10 20:11:36',7,3),(1726,'2016-03-10 20:11:54',7,3),(1727,'2016-03-10 20:12:16',7,3),(1728,'2016-03-10 20:13:17',7,3),(1729,'2016-03-10 20:13:25',7,3),(1730,'2016-03-10 20:14:30',7,3),(1731,'2016-03-10 20:14:55',7,3),(1732,'2016-03-10 20:15:04',7,3),(1733,'2016-03-10 20:16:11',7,3),(1734,'2016-03-10 20:16:19',7,3),(1735,'2016-03-10 20:16:35',7,3),(1736,'2016-03-10 20:17:05',7,3),(1737,'2016-03-10 20:19:44',7,3),(1738,'2016-03-10 20:20:00',7,3),(1739,'2016-03-10 20:21:48',7,3),(1740,'2016-03-10 20:26:01',7,3),(1741,'2016-03-10 20:26:43',7,3),(1742,'2016-03-10 20:27:23',7,3),(1743,'2016-03-10 20:28:19',7,3),(1744,'2016-03-10 20:29:17',7,3),(1745,'2016-03-10 20:29:55',7,3),(1746,'2016-03-10 20:29:59',7,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,'Usuarios','fa-user',0,'acc',NULL,NULL,1,NULL),(2,'Tipo Usuario','fa-users',1,'tipousuario',NULL,'1',1,NULL),(3,'Usuarios','fa-user',1,'usuario',NULL,'2',1,NULL),(4,'Roles','fa-users',1,'rol',NULL,'3',1,NULL),(5,'Permisos a roles','fa-users',1,'permisorol',NULL,'4',1,NULL),(6,'Seguros','fa-barcode',0,'seg',NULL,'1',1,NULL),(7,'Generar Seguro','fa-barcode',6,'seguro',NULL,'2',1,NULL);
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
INSERT INTO `modulo_acceso` VALUES (2,1),(3,1),(4,1),(5,1),(7,5);
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
  `seg_fecha_salida` date DEFAULT NULL,
  `seg_peso_bruto` varchar(45) DEFAULT NULL,
  `seg_poliza` varchar(45) DEFAULT NULL,
  `seg_certificado` varchar(45) DEFAULT NULL,
  `seg_do` varchar(45) DEFAULT NULL,
  `seg_valor_asegurado` varchar(45) DEFAULT NULL,
  `seg_usd` varchar(45) DEFAULT NULL,
  `seg_observaciones` text,
  `cla_mer_id` int(11) NOT NULL,
  `ciu_id_origen` int(11) NOT NULL,
  `ciu_id_destino` int(11) NOT NULL,
  `med_tra_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL,
  `tip_seg_id` int(11) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `tra_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`seg_id`),
  KEY `fk_seguro_empresa1_idx` (`emp_id`),
  KEY `fk_seguro_accesorio_medio_transporte1_idx` (`med_tra_id`),
  KEY `fk_seguro_accesorio_clase_mercancia1_idx` (`cla_mer_id`),
  KEY `fk_seguro_estado1_idx` (`est_id`),
  KEY `fk_seguro_accesorio_ciudad1_idx` (`ciu_id_origen`),
  KEY `fk_seguro_accesorio_ciudad2_idx` (`ciu_id_destino`),
  KEY `fk_seguro_generadora_idx` (`tip_seg_id`),
  KEY `fk_seguro_usuario_idx` (`usu_id`),
  KEY `fk_seguro_tranposrte_idx` (`tra_id`),
  CONSTRAINT `fk_seguro_accesorio_ciudad1` FOREIGN KEY (`ciu_id_origen`) REFERENCES `accesorio_ciudad` (`ciu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_accesorio_ciudad2` FOREIGN KEY (`ciu_id_destino`) REFERENCES `accesorio_ciudad` (`ciu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_accesorio_clase_mercancia1` FOREIGN KEY (`cla_mer_id`) REFERENCES `accesorio_clase_mercancia` (`cla_mer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_accesorio_medio_transporte1` FOREIGN KEY (`med_tra_id`) REFERENCES `accesorio_medio_transporte` (`med_tra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_empresa1` FOREIGN KEY (`emp_id`) REFERENCES `empresa` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_generadora` FOREIGN KEY (`tip_seg_id`) REFERENCES `accesorio_tipo_seguro` (`tip_seg_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_tranposrte` FOREIGN KEY (`tra_id`) REFERENCES `accesorio_transportadora` (`tra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_seguro_usuario` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguro`
--

LOCK TABLES `seguro` WRITE;
/*!40000 ALTER TABLE `seguro` DISABLE KEYS */;
INSERT INTO `seguro` VALUES (1,'2016-03-10 19:23:54',NULL,'0000-00-00','123456','1','berk_56e1bbba14a22','','200000000','64516.13','ninguna',1,1,1,1,1,1,1,3,1),(2,'2016-03-10 19:25:43',NULL,'2015-03-12','65432','2','berk_56e1bc276d007','qwe','200000000','64516.13','12sd',1,1,1,1,1,1,1,3,1),(3,'2016-03-10 19:26:19',NULL,'2015-02-15','432123','3','berk_56e1bc4b3343f','123','200000000','64516.13','Esto es una observacion de los datos que se van a almacear',1,1,1,1,1,1,1,3,1),(4,'2016-03-10 20:21:48',NULL,'2016-03-16','12000 kg','4','berk_56e1c94c59b97','101020','200000000','64516.13','Seguro realizado para nuevo',1,1,1,1,1,1,1,3,1),(5,'2016-03-10 20:26:43',NULL,'2016-03-16','12000 kg','5','berk_56e1ca73bea6f','101020','12299','3.97','Seguro realizado para nuevo',1,1,1,1,1,1,2,3,1),(6,'2016-03-10 20:29:17',NULL,'2014-03-14','1000 lts','6','berk_56e1cb0d1d44f','12030','12299','3.97','Este es una observacion de creaion de seguro',1,1,1,1,1,1,2,3,1),(7,'2016-03-10 20:29:55',NULL,'2014-03-14','1000 lts','7','berk_56e1cb33dab88','12030','12299','3.97','Este es una observacion de creaion de seguro',1,1,1,1,1,1,2,3,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (2,'1030673335','Luis Fernando','Yara Quesada','admin','fyara014@gmail.com','5718416','3057452832','0000-00-00 00:00:00',NULL,NULL,'81dc9bdb52d04dc20036dbd8313ed055',1,0,1,NULL),(3,'12345','Jose Fernando','Sanchez','gen','f@g.com','5819416','34567890','0000-00-00 00:00:00',NULL,NULL,'81dc9bdb52d04dc20036dbd8313ed055',1,1,5,'1');
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

-- Dump completed on 2016-03-10 14:31:57
