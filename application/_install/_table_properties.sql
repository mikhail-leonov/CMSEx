
-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_entry_id` int(11) NOT NULL,
  `property_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `property_value` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`property_id`),
  UNIQUE KEY `entry_property_constraint` (`property_entry_id`,`property_name`),
  KEY `property_entry_id` (`property_entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
