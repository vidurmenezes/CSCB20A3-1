CREATE DATABASE  IF NOT EXISTS `assignment3` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `assignment3`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: assignment3
-- ------------------------------------------------------
-- Server version	5.6.34-log

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
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `feedbackid` int(11) NOT NULL AUTO_INCREMENT,
  `instructorid` varchar(255) NOT NULL,
  `question1` varchar(255) NOT NULL,
  `question2` varchar(255) NOT NULL,
  `question3` varchar(255) NOT NULL,
  `question4` varchar(255) NOT NULL,
  PRIMARY KEY (`feedbackid`),
  UNIQUE KEY `feedbackid_UNIQUE` (`feedbackid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,'instid','q1 answer','q2 answer','q3 answer','q4 answer'),(2,'instaid','q1 answer','q2 answer','q3 answer','q4 answer'),(3,'instbid','q1 answer','q2 answer','q3 answer','q4 answer');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedbackquestions`
--

DROP TABLE IF EXISTS `feedbackquestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedbackquestions` (
  `QuestionNumber` int(11) NOT NULL AUTO_INCREMENT,
  `Question` varchar(255) NOT NULL,
  PRIMARY KEY (`QuestionNumber`),
  UNIQUE KEY `QuestionNumber_UNIQUE` (`QuestionNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbackquestions`
--

LOCK TABLES `feedbackquestions` WRITE;
/*!40000 ALTER TABLE `feedbackquestions` DISABLE KEYS */;
INSERT INTO `feedbackquestions` VALUES (1,'What do you like about the instructor teaching?'),(2,'What do you recommend the instructor to do to improve their teaching?'),(3,'What do you like about the labs?'),(4,'What do you recommend the lab instructors to do to improve their lab teaching?');
/*!40000 ALTER TABLE `feedbackquestions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructors` (
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(45) NOT NULL,
  `utorid` varchar(45) NOT NULL,
  PRIMARY KEY (`utorid`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `utorid_UNIQUE` (`utorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors`
--

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
INSERT INTO `instructors` VALUES ('instructorfa','instructorla','instructora@mail.utoronto.ca','instructora','instaid'),('instructorfb','instructorlb','instructorb@mail.utoronto.ca','instructorb','instbid'),('instructorfname','instructorlname','instructor@mail.utoronto.ca','instructor','instid');
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marks`
--

DROP TABLE IF EXISTS `marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marks` (
  `utorid` varchar(45) NOT NULL,
  `quiz1` double DEFAULT NULL,
  `quiz2` double DEFAULT NULL,
  `assignment1` double DEFAULT NULL,
  `assignment2` double DEFAULT NULL,
  `lab1` double DEFAULT NULL,
  `lab2` double DEFAULT NULL,
  `midterm` double DEFAULT NULL,
  `finalexam` double DEFAULT NULL,
  PRIMARY KEY (`utorid`),
  UNIQUE KEY `utorid_UNIQUE` (`utorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marks`
--

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` VALUES ('studenta',70,84,65.5,89.6,86.2,75.5,54.8,65.3),('studentb',60.5,45.3,95.8,62,75,46,78.1,65),('studentid',80,92.3,55.9,95.6,95.3,100,78.2,56);
/*!40000 ALTER TABLE `marks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remarks`
--

DROP TABLE IF EXISTS `remarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remarks` (
  `requestid` int(11) NOT NULL AUTO_INCREMENT,
  `requeststatus` tinyint(4) DEFAULT '1',
  `remarkitem` varchar(255) NOT NULL,
  `remarkreason` varchar(255) NOT NULL,
  `studentid` varchar(45) NOT NULL,
  PRIMARY KEY (`requestid`),
  UNIQUE KEY `requestid_UNIQUE` (`requestid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remarks`
--

LOCK TABLES `remarks` WRITE;
/*!40000 ALTER TABLE `remarks` DISABLE KEYS */;
INSERT INTO `remarks` VALUES (1,1,'quiz1','remark question 1','studentid'),(2,1,'quiz1','remark 3','studenta'),(3,1,'assignment1','remark 6','studentb'),(4,1,'quiz1','remark 1','studentb');
/*!40000 ALTER TABLE `remarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(45) NOT NULL,
  `utorid` varchar(45) NOT NULL,
  PRIMARY KEY (`utorid`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `utorid_UNIQUE` (`utorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES ('studentfa','studentla','studenta@mail.utoronto.ca','studenta','studenta'),('studentfb','studentlb','studentb@mail.utoronto.ca','studentb','studentb'),('studentfname','studentlname','student@mail.utoronto.ca','student','studentid');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tas`
--

DROP TABLE IF EXISTS `tas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tas` (
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(45) NOT NULL,
  `utorid` varchar(45) NOT NULL,
  PRIMARY KEY (`utorid`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `utorid_UNIQUE` (`utorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tas`
--

LOCK TABLES `tas` WRITE;
/*!40000 ALTER TABLE `tas` DISABLE KEYS */;
INSERT INTO `tas` VALUES ('tafa','tala','taa@mail.utoronto.ca','taa','taaid'),('tafb','talb','tab@mail.utoronto.ca','tab','tabid'),('tafname','talname','ta@mail.utoronto.ca','ta','taid');
/*!40000 ALTER TABLE `tas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-29 17:49:55
