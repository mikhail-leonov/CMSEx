
--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries_tags`
--
ALTER TABLE `entries_tags`
  ADD CONSTRAINT `entry_id_constraint` FOREIGN KEY (`entry_id`) REFERENCES `entries` (`entry_id`),
  ADD CONSTRAINT `tag_id_constraint` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `property_entry_id_2` FOREIGN KEY (`property_entry_id`) REFERENCES `entries` (`entry_id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tag_group_id_constraint` FOREIGN KEY (`tag_group_id`) REFERENCES `groups` (`group_id`);
