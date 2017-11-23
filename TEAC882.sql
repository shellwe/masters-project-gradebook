CREATE DATABASE  IF NOT EXISTS `teac882b` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `teac882b`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: teac882b
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `hint` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,3,'','isn\'t it obvious?'),(2,3,'first answer','isn\'t it obvious?'),(3,3,'I am changing this again','this should work'),(4,3,'something','something'),(5,3,'test','test'),(6,3,'adding new','adding new'),(7,3,'test','isn\'t it obvious?'),(8,3,'test','isn\'t it obvious?'),(9,3,'does this add a new?','does this add a new?'),(10,3,'test','test'),(11,3,'t','t'),(12,3,'test','test'),(13,3,'Is this now adding!?','i hope so');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `announcement` text,
  `message_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES (1,'This is the name of the class','Here are some details of the class.  We meet on Mondays at 7 p.m. and blobity blobity blah.  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum','This is the announcement, I chose success','alert alert-success');
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gradebook`
--

DROP TABLE IF EXISTS `gradebook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gradebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questions_id` varchar(45) DEFAULT NULL,
  `tests_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gradebook`
--

LOCK TABLES `gradebook` WRITE;
/*!40000 ALTER TABLE `gradebook` DISABLE KEYS */;
/*!40000 ALTER TABLE `gradebook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) DEFAULT NULL,
  `question` varchar(45) DEFAULT NULL,
  `question_type` varchar(45) DEFAULT NULL,
  `hint` varchar(45) DEFAULT NULL,
  `correct_answer` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,0,'What is the meaning of life','it is not cake',NULL,NULL),(2,0,'what is the test id',NULL,'only time will tell',NULL),(3,1,'something',NULL,'something','6'),(4,1,'Should I start this song off with a question?',NULL,'or say what\'s on my mind',NULL),(5,1,'something',NULL,'something',NULL),(6,1,'Should I add a question?',NULL,'you should add a question',NULL),(7,1,'test 6',NULL,'hope it works',NULL),(8,1,'test',NULL,'test',NULL),(9,1,'7',NULL,'',NULL),(10,1,'HEY USE ME!!!!!!!!!!!!!!',NULL,'use this one',NULL),(11,1,'test me again',NULL,'editing old',NULL);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `respeatable` varchar(45) DEFAULT NULL,
  `test_intro` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,'test use this',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf intro this is an example intro this is an example intro this is an example intro this is an example intro dssdf'),(2,'',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,''),(3,'',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'something here as well'),(4,'something here',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'something here as well'),(5,'something',NULL,'1234-12-12 00:00:00','1234-12-15 00:00:00',NULL,'this is the intro'),(6,'something',NULL,'1234-12-12 00:00:00','1234-12-15 00:00:00',NULL,'this is the intro'),(7,'something',NULL,'1234-12-12 00:00:00','1234-12-15 00:00:00',NULL,'this is the intro'),(8,'something',NULL,'1234-12-12 00:00:00','1234-12-15 00:00:00',NULL,'this is the intro'),(9,'somethingaasdf',NULL,'1234-12-12 00:00:00','1234-12-15 00:00:00',NULL,'this is the introasdf'),(10,'somethingaasdf',NULL,'1234-12-12 00:00:00','1234-12-15 00:00:00',NULL,'this is the introasdf');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_group` int(11) DEFAULT NULL,
  `first` varchar(100) DEFAULT NULL,
  `last` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'shellwe@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',1,'Shawn','Hellwege','109 N 32nd St','Apt 1','Lincoln','NE','68503','Instructional Technology',NULL,NULL),(2,NULL,'bob@sacredheart.com','81dc9bdb52d04dc20036dbd8313ed055',2,'Bob','Kelso',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,'john@sacredheart.com','81dc9bdb52d04dc20036dbd8313ed055',2,'John','Doreon',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,'janitor@sacredheart.com','81dc9bdb52d04dc20036dbd8313ed055',2,'Jani','Tor',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(5,NULL,'turk@sacredheart.com','81dc9bdb52d04dc20036dbd8313ed055',2,'Turk','Turkleton',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00'),(6,NULL,'elliot@sacredheart.com','81dc9bdb52d04dc20036dbd8313ed055',2,'Elliot','Reed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2013-04-29 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-30 22:13:08
