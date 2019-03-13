-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: admin_goodwillcomputerworkscrm
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.16.04.2

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
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `announcement_id` int(10) NOT NULL AUTO_INCREMENT,
  `date_posted` int(10) NOT NULL,
  `employee_posted` int(10) NOT NULL,
  `announcement_subject` varchar(30) DEFAULT NULL,
  `announcement` text,
  PRIMARY KEY (`announcement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commons`
--

DROP TABLE IF EXISTS `commons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commons` (
  `common_id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) DEFAULT NULL,
  `value` varchar(250) DEFAULT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`common_id`)
) ENGINE=MyISAM AUTO_INCREMENT=442 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commons_categories`
--

DROP TABLE IF EXISTS `commons_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commons_categories` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `computer_returns`
--

DROP TABLE IF EXISTS `computer_returns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_returns` (
  `return_id` int(10) NOT NULL AUTO_INCREMENT,
  `reason` text CHARACTER SET utf8,
  `return_date` int(10) DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `computer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `store_id` int(10) DEFAULT NULL,
  `sale_date` int(10) DEFAULT NULL,
  `sales_person` int(10) DEFAULT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=MyISAM AUTO_INCREMENT=711 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `computer_sales`
--

DROP TABLE IF EXISTS `computer_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_sales` (
  `sale_id` int(10) NOT NULL AUTO_INCREMENT,
  `sale_date` int(10) DEFAULT NULL,
  `warranty` int(10) DEFAULT NULL,
  `computer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `location_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`sale_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6762 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `computer_templates`
--

DROP TABLE IF EXISTS `computer_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_templates` (
  `computer_template_id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  `make` varchar(30) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `os` varchar(30) DEFAULT NULL,
  `processor` varchar(30) DEFAULT NULL,
  `memory` varchar(30) DEFAULT NULL,
  `hard_drive` int(10) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`computer_template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `computers`
--

DROP TABLE IF EXISTS `computers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computers` (
  `computer_id` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(30) DEFAULT NULL,
  `location` int(10) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `make` varchar(30) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `serial` varchar(30) DEFAULT NULL,
  `os` varchar(30) DEFAULT NULL,
  `processor` varchar(30) DEFAULT NULL,
  `processor_speed` varchar(5) DEFAULT NULL,
  `memory` varchar(30) DEFAULT NULL,
  `hard_drive` int(10) DEFAULT NULL,
  `optical_drive` varchar(30) DEFAULT NULL,
  `notes` text,
  `price` decimal(10,2) DEFAULT NULL,
  `employee` int(10) DEFAULT NULL,
  `system_number` varchar(10) DEFAULT NULL,
  `date_added` int(10) NOT NULL,
  `coa` varchar(30) DEFAULT NULL,
  `label_printed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`computer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7338 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customer_notes`
--

DROP TABLE IF EXISTS `customer_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_notes` (
  `customer_note_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer` int(10) NOT NULL,
  `employee` int(10) NOT NULL,
  `date_added` int(10) NOT NULL,
  `note` text NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `date_modified` int(10) DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`customer_note_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2154 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customer_requests`
--

DROP TABLE IF EXISTS `customer_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_requests` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `date_requested` int(10) NOT NULL,
  `date_closed` int(10) NOT NULL,
  `request` text NOT NULL,
  `employee_entered` int(10) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=234 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `date_added` int(10) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` char(5) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `mobile` char(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `referral` varchar(30) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6346 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `employee_clockin_clockout`
--

DROP TABLE IF EXISTS `employee_clockin_clockout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_clockin_clockout` (
  `clock_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `store_id` int(10) NOT NULL,
  `clock_in` int(10) DEFAULT NULL,
  `clock_out` int(10) DEFAULT NULL,
  `clock_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`clock_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5947 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `employee_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `location` char(1) NOT NULL,
  `employee_last_name` varchar(30) NOT NULL,
  `employee_first_name` varchar(30) NOT NULL,
  `employee_phone` char(10) NOT NULL,
  `employee_email` varchar(30) NOT NULL,
  `online` int(10) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `location_id` int(10) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` char(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hours` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `log_type` varchar(30) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `employee_id` int(10) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65533 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `request_type` char(55) DEFAULT NULL,
  `request_priority` int(10) DEFAULT NULL,
  `request_store_id` int(10) DEFAULT NULL,
  `date_requested` int(10) DEFAULT NULL,
  `date_due` int(10) DEFAULT NULL,
  `date_closed` int(10) DEFAULT NULL,
  `request` text,
  `contact` char(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `request_from` int(10) DEFAULT NULL,
  `employee_entered` int(10) DEFAULT NULL,
  `employee_closed` int(10) DEFAULT NULL,
  `request_received` char(255) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=195 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_last_name` varchar(30) DEFAULT NULL,
  `user_first_name` varchar(30) DEFAULT NULL,
  `online` int(10) DEFAULT NULL,
  `avatar` varchar(150) DEFAULT NULL,
  `location` char(1) DEFAULT NULL,
  `start_page` varchar(30) DEFAULT NULL,
  `security_level` int(1) DEFAULT NULL,
  `user_date_added` int(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work_order_notes`
--

DROP TABLE IF EXISTS `work_order_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_order_notes` (
  `work_order_note_id` int(10) NOT NULL AUTO_INCREMENT,
  `work_order_id` int(10) DEFAULT NULL,
  `employee` int(10) DEFAULT NULL,
  `date_added` int(10) DEFAULT NULL,
  `note` text,
  `active` tinyint(1) DEFAULT NULL,
  `date_modified` int(10) DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`work_order_note_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21424 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work_orders`
--

DROP TABLE IF EXISTS `work_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_orders` (
  `work_order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) DEFAULT NULL,
  `take_in_employee` int(10) DEFAULT NULL,
  `take_in_date` int(10) DEFAULT NULL,
  `work_order_status` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `make` varchar(30) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `serial` varchar(30) DEFAULT NULL,
  `work_order_type` varchar(30) DEFAULT NULL,
  `description` text,
  `location_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`work_order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4086 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-13 15:11:22
