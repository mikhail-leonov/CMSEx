
-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(256) NOT NULL,
  `tag_text` text NOT NULL,
  `tag_ext_key` varchar(128) DEFAULT NULL,
  `tag_group_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tag_ext_key` (`tag_ext_key`),
  KEY `tag_group_id` (`tag_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

