
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
DROP TABLE IF EXISTS `tbl_car_maker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_car_maker` (
  `maker_id` int(5) NOT NULL AUTO_INCREMENT,
  `maker_name` varchar(100) NOT NULL,
  PRIMARY KEY (`maker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `tbl_car_maker` DISABLE KEYS */;
INSERT INTO `tbl_car_maker` VALUES (1,'AC');
/*!40000 ALTER TABLE `tbl_car_maker` ENABLE KEYS */;
DROP TABLE IF EXISTS `tbl_car_model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_car_model` (
  `model_id` int(5) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(100) NOT NULL,
  `maker_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`model_id`),
  KEY `maker_id` (`maker_id`),
  CONSTRAINT `tbl_car_model_ibfk_1` FOREIGN KEY (`maker_id`) REFERENCES `tbl_car_maker` (`maker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `tbl_car_model` DISABLE KEYS */;
INSERT INTO `tbl_car_model` VALUES (1,'Ace',1),(2,'Aceca',1),(3,'427',1),(4,'Greyhound',1),(5,'428',1),(6,'Cobra',1);
/*!40000 ALTER TABLE `tbl_car_model` ENABLE KEYS */;
DROP TABLE IF EXISTS `tbl_car_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_car_part` (
  `part_id` int(5) NOT NULL AUTO_INCREMENT,
  `part_name` varchar(100) NOT NULL,
  PRIMARY KEY (`part_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `tbl_car_part` DISABLE KEYS */;
INSERT INTO `tbl_car_part` VALUES (1,'Tail Light'),(2,'Air Bag Control Module'),(3,'Convertible Top Motor'),(4,'Communication Module'),(5,'Transmission Control Module'),(6,'Car Window Lifter'),(7,'Cylinder Block'),(8,'Front Axle'),(9,'Spindle Knuckle Front'),(10,'Fog Light Stalk'),(11,'Electric Door Motor'),(12,'Loaded Beam Axle'),(13,'Axle Shaft'),(14,'Starter Motor'),(15,'Power Steering Pump'),(16,'Window Regulator'),(17,'Side View Mirror'),(18,'Blower Motor'),(19,'Front Window Lifter'),(20,'Navigation Control Module'),(21,'Suspension Control Module'),(22,'ABS Control Module'),(23,'Door Assembly Front'),(24,'Carrier Assembly'),(25,'SAM Control Module'),(26,'Window Regulator Rear'),(27,'Turn Signal Lever'),(28,'Tailgate'),(29,'Interior Light Control Module'),(30,'AC Compressor Clutch'),(31,'Front Clip'),(32,'Wiper Motor Front'),(33,'Door Window Regulator Rear'),(34,'Speedometer Cluster'),(35,'Front Bumper Reinforcement'),(36,'Alternator'),(37,'Flywheel'),(38,'Lower Control Arm Front'),(39,'Seat Control Module'),(40,'Side Door Glass Front '),(41,'Brake Master Cylinder'),(42,'Rear Clip Assembly');
/*!40000 ALTER TABLE `tbl_car_part` ENABLE KEYS */;
DROP TABLE IF EXISTS `tbl_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_inventory` (
  `inv_id` int(5) NOT NULL AUTO_INCREMENT,
  `part_id` int(5) NOT NULL,
  `model_id` int(5) NOT NULL,
  PRIMARY KEY (`inv_id`),
  KEY `part_id` (`part_id`),
  KEY `model_id` (`model_id`),
  CONSTRAINT `tbl_inventory_ibfk_1` FOREIGN KEY (`part_id`) REFERENCES `tbl_car_part` (`part_id`),
  CONSTRAINT `tbl_inventory_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `tbl_car_model` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `tbl_inventory` DISABLE KEYS */;
INSERT INTO `tbl_inventory` VALUES (1,1,1),(2,2,1),(3,3,2),(4,4,2),(5,5,2),(6,6,3),(7,7,4),(8,8,1),(9,9,4),(10,10,2),(11,11,5),(12,12,2),(13,13,3),(14,14,6),(15,15,5),(16,16,6),(17,17,2),(18,18,6),(19,19,6),(20,20,1),(21,6,5),(22,21,5),(23,18,2),(24,22,5),(25,23,2),(26,24,1),(27,9,3),(28,25,3),(29,26,5),(30,24,4),(31,27,6),(32,28,6),(33,29,1),(34,30,2),(35,31,4),(36,32,5),(37,33,5),(38,34,3),(39,35,2),(40,36,4),(41,33,4),(42,37,6),(43,38,6),(44,8,5),(45,39,4),(46,15,6),(47,40,4),(48,41,3),(49,42,1),(50,4,1);
/*!40000 ALTER TABLE `tbl_inventory` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

