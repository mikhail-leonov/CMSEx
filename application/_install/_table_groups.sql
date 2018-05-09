
-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(256) NOT NULL,
  `group_text` text NOT NULL,
  `group_ext_key` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_ext_key` (`group_ext_key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

