
-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

DROP TABLE IF EXISTS `entries`;
CREATE TABLE IF NOT EXISTS `entries` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `entry_text` text COLLATE utf8_unicode_ci NOT NULL,
  `entry_ext_key` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`entry_id`),
  UNIQUE KEY `entry_ext_key` (`entry_ext_key`),
  KEY `entry_url` (`entry_url`(255))
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

