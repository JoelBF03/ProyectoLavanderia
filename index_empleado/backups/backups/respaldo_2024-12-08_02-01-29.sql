-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: practicas
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `archivo` varchar(255) NOT NULL,
  `fecha_generacion` datetime NOT NULL,
  `cli_cedula` int(11) DEFAULT NULL,
  PRIMARY KEY (`backup_id`),
  KEY `cli_cedula` (`cli_cedula`),
  CONSTRAINT `backups_ibfk_1` FOREIGN KEY (`cli_cedula`) REFERENCES `cliente2` (`cli_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `CLI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLI_NOMBRE` varchar(50) DEFAULT NULL,
  `mp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`CLI_ID`),
  KEY `mp_id` (`mp_id`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`mp_id`) REFERENCES `metodo_pago` (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'pepe',1),(2,'jose',4),(3,'yo',3),(5,'yi',1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente2`
--

DROP TABLE IF EXISTS `cliente2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente2` (
  `cli_cedula` int(11) NOT NULL,
  `cli_nombre` varchar(50) DEFAULT NULL,
  `cli_apellido` varchar(60) DEFAULT NULL,
  `cli_telefono` int(11) DEFAULT NULL,
  `cli_email` varchar(80) DEFAULT NULL,
  `cli_pwd` varchar(255) DEFAULT NULL,
  `cli_salt` varchar(255) DEFAULT NULL,
  `cli_rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cli_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente2`
--

LOCK TABLES `cliente2` WRITE;
/*!40000 ALTER TABLE `cliente2` DISABLE KEYS */;
INSERT INTO `cliente2` VALUES (1029384756,'Messi','Ronaldo',987654312,'messir@gmail.com','$2y$10$y9wynCAM9/Rz7.WA0A7w7.108HZ0z0eb3hqkoDIV9SUgD0GOop9FS','fc8a34398a2c2b3013474c0ac45282d1','cliente'),(1315721447,'Luis','Bodero',992492220,'joel@gmail.com','$2y$10$Cw/AD6K8p4hizn3AKBTMWu3bA6GjAUwx23UfglztGAG/SGzC172BG','2b9975c5cec3c92587cc17c94a5e4644','cliente'),(1315721448,'Ronaldo','Messi',987123466,'ronaldom@gmail.com','$2y$10$5/FXPDZtqzgmLcsEw2UOguP5N4pVz1vU9WKuGAUpkUAYek93UXoi2','764e2dcf6e833be5f058031022b24bcc','cliente'),(1315721449,'Joel','Bodero',912873455,'bodero@gmail.com','$2y$10$Zovs1X4jA0CAk3jTND4UQubHpSiix6WhX8NfFCzzkXNJZMefv1LJq','10ad97a250c61bd5552217eb791b746d','cliente'),(1999999999,'pepe','rodriguez',911111111,'peper@gmail.com','$2y$10$Bpu59zrhEoX7t.Ad5HAyX.ZRSJB1FHN91YXHRKMfT2.PIwXGIos8i','1be5c1aabb6357303be5554118877c9d','Empleado');
/*!40000 ALTER TABLE `cliente2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_pedido`
--

DROP TABLE IF EXISTS `estado_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_pedido` (
  `EP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `EP_DESCRIPCION` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`EP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_pedido`
--

LOCK TABLES `estado_pedido` WRITE;
/*!40000 ALTER TABLE `estado_pedido` DISABLE KEYS */;
INSERT INTO `estado_pedido` VALUES (1,'EN ESPERA...'),(2,'LAVANDO...'),(3,'SECANDO...'),(4,'PLANCHANDO...'),(5,'LISTO PARA ENTREGAR'),(6,'ENTREGADO');
/*!40000 ALTER TABLE `estado_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_pago`
--

DROP TABLE IF EXISTS `metodo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodo_pago` (
  `mp_id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pago`
--

LOCK TABLES `metodo_pago` WRITE;
/*!40000 ALTER TABLE `metodo_pago` DISABLE KEYS */;
INSERT INTO `metodo_pago` VALUES (1,'Efectivo'),(2,'Transferencia'),(3,'Tarjeta de crédito'),(4,'PayPal');
/*!40000 ALTER TABLE `metodo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `PED_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TL_ID` int(11) DEFAULT NULL,
  `TS_ID` int(11) DEFAULT NULL,
  `PED_ROPA` varchar(255) DEFAULT NULL,
  `PED_CANTIDAD` varchar(3) DEFAULT NULL,
  `PED_OBSERVACIONES` varchar(255) DEFAULT NULL,
  `PED_FECHA_ENTREGA_LOCAL` date DEFAULT NULL,
  `MP_ID` int(11) DEFAULT NULL,
  `cli_cedula` int(11) DEFAULT NULL,
  `EP_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PED_ID`),
  KEY `TL_ID` (`TL_ID`),
  KEY `TS_ID` (`TS_ID`),
  KEY `MP_ID` (`MP_ID`),
  KEY `cli_cedula` (`cli_cedula`),
  KEY `EP_ID` (`EP_ID`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`TL_ID`) REFERENCES `tipo_lavado` (`TL_ID`),
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`TS_ID`) REFERENCES `tipo_servicio` (`TS_ID`),
  CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`MP_ID`) REFERENCES `metodo_pago` (`mp_id`),
  CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`cli_cedula`) REFERENCES `cliente2` (`cli_cedula`),
  CONSTRAINT `pedido_ibfk_5` FOREIGN KEY (`EP_ID`) REFERENCES `estado_pedido` (`EP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (4,2,2,'Pantalon, RopaInterior','7','Lavar con poco detergente','2023-12-27',2,1315721447,1),(5,3,1,'Camisas, Pantalon, RopaInterior','25','Lavar con poco detergente','2023-12-28',1,1315721448,1),(6,1,1,'Camisas','10','Ninguna','2023-12-28',1,1315721448,2),(7,1,1,'Camisas, Vestidos, RopaInterior','10','Ninguna','2023-12-26',1,1315721448,3),(8,1,1,'Camisas, RopaInterior','11','Ninguna','2023-12-26',1,1315721448,6),(9,2,1,'Pantalon, Toallas','5','Ninguna','2023-12-26',1,1315721449,1),(10,3,3,'Camisas, Pantalon, Sudaderas','15','Usar mucho aromatizante','2023-12-30',3,1315721447,1),(11,1,1,'Camisas, Toallas','5','Lavar con mucho detergente','2024-12-08',1,1315721447,1);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_lavado`
--

DROP TABLE IF EXISTS `tipo_lavado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_lavado` (
  `TL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TL_DESCRIPCION` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`TL_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_lavado`
--

LOCK TABLES `tipo_lavado` WRITE;
/*!40000 ALTER TABLE `tipo_lavado` DISABLE KEYS */;
INSERT INTO `tipo_lavado` VALUES (1,'Lavado frio'),(2,'Lavado tibio'),(3,'Lavado caliente');
/*!40000 ALTER TABLE `tipo_lavado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicio`
--

DROP TABLE IF EXISTS `tipo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_servicio` (
  `TS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TS_DESCRIPCION` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`TS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio`
--

LOCK TABLES `tipo_servicio` WRITE;
/*!40000 ALTER TABLE `tipo_servicio` DISABLE KEYS */;
INSERT INTO `tipo_servicio` VALUES (1,'Lavado en seco'),(2,'Lavado y secado'),(3,'Lavado y planchado');
/*!40000 ALTER TABLE `tipo_servicio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-07 20:01:30
