
-- --------------------------------------------------------

--
-- Table structure for table `entries_tags`
--

DROP TABLE IF EXISTS `entries_tags`;
CREATE TABLE IF NOT EXISTS `entries_tags` (
  `entry_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  UNIQUE KEY `composite` (`entry_id`,`tag_id`) USING BTREE,
  KEY `entry_id` (`entry_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

