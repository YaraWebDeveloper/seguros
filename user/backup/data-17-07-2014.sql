CREATE DATABASE  IF NOT EXISTS `softmedico` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `softmedico`;
-- MySQL dump 10.13  Distrib 5.6.11, for Win32 (x86)
--
-- Host: localhost    Database: softmedico
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `adm_estado_civil`
--

DROP TABLE IF EXISTS `adm_estado_civil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_estado_civil` (
  `est_civ_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_civ_nombre` varchar(45) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`est_civ_id`),
  KEY `fk_adm_estado_civil_estado1_idx` (`est_id`),
  CONSTRAINT `fk_adm_estado_civil_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_estado_civil`
--

LOCK TABLES `adm_estado_civil` WRITE;
/*!40000 ALTER TABLE `adm_estado_civil` DISABLE KEYS */;
INSERT INTO `adm_estado_civil` VALUES (1,'Soltero (a)',1),(2,'Casado (a)',1),(3,'Viudo (a)',1),(4,'Unión Libre',1),(5,'Personalizado',1),(6,'Personalizado 2',1),(7,'prueba WPF 0',2),(8,'prueba WPF 1',2),(9,'prueba Editado',1),(10,'nPrueba edi',2),(11,'zxd',2),(12,'uno edit',2),(13,'Prueba nueva',1),(14,'Prueba 2',2),(15,'uno',1),(16,'prueba decano',1);
/*!40000 ALTER TABLE `adm_estado_civil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_grupo_sanguineo`
--

DROP TABLE IF EXISTS `adm_grupo_sanguineo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_grupo_sanguineo` (
  `gru_san_id` int(11) NOT NULL AUTO_INCREMENT,
  `gru_san_nombre` varchar(15) NOT NULL,
  `gru_san_factor_rh` varchar(2) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`gru_san_id`),
  KEY `fk_adm_grupo_sanguineo_estado1_idx` (`est_id`),
  CONSTRAINT `fk_adm_grupo_sanguineo_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_grupo_sanguineo`
--

LOCK TABLES `adm_grupo_sanguineo` WRITE;
/*!40000 ALTER TABLE `adm_grupo_sanguineo` DISABLE KEYS */;
INSERT INTO `adm_grupo_sanguineo` VALUES (1,'O','-',1),(2,'O','+',1),(3,'B','-',1),(4,'B','+',1),(5,'A','-',1),(6,'A','+',1),(7,'AB','-',1),(8,'AB','+',1),(9,'as EDIT','+',1),(10,'qw','-.',1),(11,'HG2','+',2);
/*!40000 ALTER TABLE `adm_grupo_sanguineo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_parentesco`
--

DROP TABLE IF EXISTS `adm_parentesco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_parentesco` (
  `par_id` int(11) NOT NULL AUTO_INCREMENT,
  `par_nombre` varchar(20) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`par_id`),
  KEY `fk_adm_parentezco_estado1_idx` (`est_id`),
  CONSTRAINT `fk_adm_parentezco_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_parentesco`
--

LOCK TABLES `adm_parentesco` WRITE;
/*!40000 ALTER TABLE `adm_parentesco` DISABLE KEYS */;
INSERT INTO `adm_parentesco` VALUES (1,'Hijo (a)',1),(2,'Padre',1),(3,'Madre',1),(4,'Hermano (a)',1),(5,'Primo (a)',1),(6,'Tio (a)',1),(7,'Abuelo (a)',1),(8,'Parentesco WPF edita',2),(9,'Especial',2);
/*!40000 ALTER TABLE `adm_parentesco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_sexo`
--

DROP TABLE IF EXISTS `adm_sexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_sexo` (
  `sex_id` int(11) NOT NULL AUTO_INCREMENT,
  `sex_nombre` varchar(20) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`sex_id`),
  KEY `fk_adm_sexo_estado1_idx` (`est_id`),
  CONSTRAINT `fk_adm_sexo_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_sexo`
--

LOCK TABLES `adm_sexo` WRITE;
/*!40000 ALTER TABLE `adm_sexo` DISABLE KEYS */;
INSERT INTO `adm_sexo` VALUES (1,'Masculino',1),(2,'Femenino',1),(3,'Prueba especial',1),(4,'Especial',1);
/*!40000 ALTER TABLE `adm_sexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_tipo_afiliacion`
--

DROP TABLE IF EXISTS `adm_tipo_afiliacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_tipo_afiliacion` (
  `tip_afi_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_afi_nombre` varchar(45) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`tip_afi_id`),
  KEY `fk_adm_afiliacion_tipo_estado1_idx` (`est_id`),
  CONSTRAINT `fk_adm_afiliacion_tipo_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_tipo_afiliacion`
--

LOCK TABLES `adm_tipo_afiliacion` WRITE;
/*!40000 ALTER TABLE `adm_tipo_afiliacion` DISABLE KEYS */;
INSERT INTO `adm_tipo_afiliacion` VALUES (1,'Particular',1),(2,'Afiliado',1),(3,'Tipo Afilicación WPF editado',1),(4,'Especial',1),(5,'1234',2);
/*!40000 ALTER TABLE `adm_tipo_afiliacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_tipo_documento`
--

DROP TABLE IF EXISTS `adm_tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_tipo_documento` (
  `tip_doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_doc_prefijo` varchar(5) NOT NULL,
  `tip_doc_nombre` varchar(45) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`tip_doc_id`),
  KEY `fk_adm_tipo_documento_estado1_idx` (`est_id`),
  CONSTRAINT `fk_adm_tipo_documento_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_tipo_documento`
--

LOCK TABLES `adm_tipo_documento` WRITE;
/*!40000 ALTER TABLE `adm_tipo_documento` DISABLE KEYS */;
INSERT INTO `adm_tipo_documento` VALUES (1,'C.C.','Cédula Ciudadanía',1),(2,'PP','Pasaporte',1),(3,'R.C','Regístro Civil',2),(4,'p','Prueba',1),(5,'E.S.','Especial',1);
/*!40000 ALTER TABLE `adm_tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_nombre` varchar(15) NOT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
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
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nombre` varchar(20) NOT NULL,
  `mod_lis_ruta_web` varchar(50) DEFAULT NULL,
  `mod_dependencia` int(11) NOT NULL DEFAULT '0',
  `mod_proyecto_desktop` varchar(45) DEFAULT NULL,
  `mod_directorio_desktop` varchar(45) DEFAULT NULL,
  `mod_clase_desktop` varchar(45) DEFAULT NULL,
  `mod_objeto_desktop` varchar(45) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`mod_id`),
  KEY `fk_Modulo_Estado_idx` (`est_id`),
  CONSTRAINT `fk_Modulo_Estado` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,'Accesorios',NULL,0,NULL,NULL,NULL,NULL,1),(2,'Usuarios',NULL,0,NULL,NULL,NULL,NULL,1),(3,'Pacientes',NULL,0,NULL,NULL,NULL,NULL,1),(4,'Estado Civil','estadocivil',1,'moduloAccesorios','Presentacion','winEstadoCivil','objEstadoCivil',1),(5,'Tipo Afiliación','tipoafiliacion',1,'moduloAccesorios','Presentacion','winTipoAfiliacion','objTipoAfiliacion',1),(6,'Parentesco','parentesco',1,'moduloAccesorios','Presentacion','winParentesco','objParentesco',1),(7,'Sexo','sexo',1,'moduloAccesorios','Presentacion','winSexo','objSexo',1),(8,'Usuarios','usuarios',2,'moduloUsuarios','Presentacion','winUsuarios','objUsuarios',1),(9,'Tipo Documento','tipodocumento',1,'moduloAccesorios','Presentacion','winTipoDocumento','objTipoDocumento',1),(10,'Grupo Sanguineo','gruposanguineo',1,'moduloAccesorios','Presentacion','winGrupoSanguineo','objGrupoSanguineo',1),(11,'Roles de Usuario','roles',2,'moduloUsuarios','Presentacion','winRoles','objRoles',1),(12,'Tipos de Usuario','tipousuario',2,'moduloUsuarios','Presentacion','winTipoUsuario','objTipoUsuario',1),(13,'Permisos de Usuario','permisoUsuario',2,'moduloUsuario','Presentacion','winPermisoUsuario','objPermisoUsuario',1);
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo_acceso`
--

DROP TABLE IF EXISTS `modulo_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo_acceso` (
  `usu_rol_id` int(11) NOT NULL,
  `mod_id` int(11) NOT NULL,
  KEY `fk_Acceso_modulo_Rol1_idx` (`usu_rol_id`),
  KEY `fk_Acceso_modulo_Modulo1_idx` (`mod_id`),
  CONSTRAINT `fk_Acceso_modulo_Modulo1` FOREIGN KEY (`mod_id`) REFERENCES `modulo` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Acceso_modulo_Rol1` FOREIGN KEY (`usu_rol_id`) REFERENCES `usuario_rol` (`usu_rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo_acceso`
--

LOCK TABLES `modulo_acceso` WRITE;
/*!40000 ALTER TABLE `modulo_acceso` DISABLE KEYS */;
INSERT INTO `modulo_acceso` VALUES (1,1),(1,2),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13);
/*!40000 ALTER TABLE `modulo_acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo_lista`
--

DROP TABLE IF EXISTS `modulo_lista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo_lista` (
  `mod_lis_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_lis_nombre` varchar(45) NOT NULL,
  `mod_lis_ruta` varchar(45) NOT NULL,
  `mod_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`mod_lis_id`),
  KEY `fk_modulo_lista_estado1_idx` (`est_id`),
  KEY `fk_modulo_lista_modulo1_idx` (`mod_id`),
  CONSTRAINT `fk_modulo_lista_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_lista_modulo1` FOREIGN KEY (`mod_id`) REFERENCES `modulo` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo_lista`
--

LOCK TABLES `modulo_lista` WRITE;
/*!40000 ALTER TABLE `modulo_lista` DISABLE KEYS */;
INSERT INTO `modulo_lista` VALUES (1,'Estado Civil','estadocivil',1,1),(2,'Tipo Afiliación','tipoafiliacion',1,1),(3,'Parentesco','parentesco',1,1),(4,'Sexo','sexo',1,1),(5,'Usuarios','usuarios',2,1),(6,'Tipo Documento','tipodocumento',1,1),(7,'Grupo Sanguineo','gruposanguineo',1,1),(8,'Roles de Usuario','roles',2,1);
/*!40000 ALTER TABLE `modulo_lista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `pac_id` int(11) NOT NULL AUTO_INCREMENT,
  `pac_nombre` varchar(50) NOT NULL,
  `pac_apellido` varchar(80) NOT NULL,
  `pac_correo` varchar(120) DEFAULT NULL,
  `pac_telefono_principal` varchar(20) NOT NULL,
  `pac_telefono_secundario` varchar(20) NOT NULL,
  `pac_celular` varchar(30) DEFAULT NULL,
  `pac_observaciones` text,
  `est_id` int(11) NOT NULL,
  `pac_fecha_crea` datetime NOT NULL,
  `pac_fecha_edita` datetime DEFAULT NULL,
  `sex_id` int(11) NOT NULL,
  `est_civ_id` int(11) NOT NULL,
  `gru_san_id` int(11) NOT NULL,
  `tip_doc_id` int(11) NOT NULL,
  `tip_afi_id` int(11) NOT NULL,
  PRIMARY KEY (`pac_id`),
  KEY `fk_paciente_estado1_idx` (`est_id`),
  KEY `fk_paciente_adm_sexo1_idx` (`sex_id`),
  KEY `fk_paciente_adm_estado_civil1_idx` (`est_civ_id`),
  KEY `fk_paciente_adm_grupo_sanguineo1_idx` (`gru_san_id`),
  KEY `fk_paciente_adm_tipo_documento1_idx` (`tip_doc_id`),
  KEY `fk_paciente_adm_afiliacion_tipo1_idx` (`tip_afi_id`),
  CONSTRAINT `fk_paciente_adm_afiliacion_tipo1` FOREIGN KEY (`tip_afi_id`) REFERENCES `adm_tipo_afiliacion` (`tip_afi_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paciente_adm_estado_civil1` FOREIGN KEY (`est_civ_id`) REFERENCES `adm_estado_civil` (`est_civ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paciente_adm_grupo_sanguineo1` FOREIGN KEY (`gru_san_id`) REFERENCES `adm_grupo_sanguineo` (`gru_san_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paciente_adm_sexo1` FOREIGN KEY (`sex_id`) REFERENCES `adm_sexo` (`sex_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paciente_adm_tipo_documento1` FOREIGN KEY (`tip_doc_id`) REFERENCES `adm_tipo_documento` (`tip_doc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paciente_estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(30) NOT NULL,
  `usu_apellido` varchar(50) NOT NULL,
  `usu_cedula` decimal(12,0) NOT NULL,
  `usu_direccion` varchar(120) DEFAULT NULL,
  `usu_telefono` varchar(20) DEFAULT NULL,
  `usu_correo` varchar(120) NOT NULL,
  `usu_pass` varchar(32) NOT NULL,
  `est_id` int(11) NOT NULL,
  `usu_tip_id` int(11) NOT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `fk_Usuario_Estado1_idx` (`est_id`),
  KEY `fk_Usuario_Tipo_usuario1_idx` (`usu_tip_id`),
  CONSTRAINT `fk_Usuario_Estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Tipo_usuario1` FOREIGN KEY (`usu_tip_id`) REFERENCES `usuario_tipo` (`usu_tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Juan Carlos','Castañeda Trujillo',80853139,'Cra 4 este # 32b - 31','9001586','jucactru54@hotmail.com','f86505db241750965d9038da6d62e02d',1,1),(2,'Mercedes','Trujillo',36152761,'Cra 4 este # 32b - 31 int 16 apt 347','7229576','jucactru54@gmail.com','8a959a823a171db167543b811f0ba9de',1,1),(3,'Armando','Castañeda Trujillo',79716116,'dir','3113252473','juancarlos@jucactru.com','f86505db241750965d9038da6d62e02d',1,1);
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
  `usu_rol_nombre` varchar(20) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`usu_rol_id`),
  KEY `fk_Rol_Estado1_idx` (`est_id`),
  CONSTRAINT `fk_Rol_Estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_rol`
--

LOCK TABLES `usuario_rol` WRITE;
/*!40000 ALTER TABLE `usuario_rol` DISABLE KEYS */;
INSERT INTO `usuario_rol` VALUES (1,'Super Administrador',1),(2,'Administrador',1),(3,'Atención General',1);
/*!40000 ALTER TABLE `usuario_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_tipo`
--

DROP TABLE IF EXISTS `usuario_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_tipo` (
  `usu_tip_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_tip_nombre` varchar(20) NOT NULL,
  `usu_rol_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`usu_tip_id`),
  KEY `fk_Tipo_usuario_Estado1_idx` (`est_id`),
  KEY `fk_Tipo_usuario_Rol1_idx` (`usu_rol_id`),
  CONSTRAINT `fk_Tipo_usuario_Estado1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tipo_usuario_Rol1` FOREIGN KEY (`usu_rol_id`) REFERENCES `usuario_rol` (`usu_rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_tipo`
--

LOCK TABLES `usuario_tipo` WRITE;
/*!40000 ALTER TABLE `usuario_tipo` DISABLE KEYS */;
INSERT INTO `usuario_tipo` VALUES (1,'Administrador',1,1),(2,'Contabilidad',1,1),(3,'Atención a usuario',3,1);
/*!40000 ALTER TABLE `usuario_tipo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-17  0:11:19
