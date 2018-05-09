<?php
/**
 * Abstract controller
 */
require_once( MODEL . 'abstract.model.php' );

/**
 * Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class TagModel extends AbstractModel
{
    /**
     * Get all selected/grouped not selected tags from tags Table 
     */
    public function getTags()
    {
	$result = array();
	$selectedTags = Util::GetAlreadySelected("tag");
	$result[0] = array( "group_name" => "Selected", "tags"=> $selectedTags );

	$groups = $this->db->select("*")->from("groups")->all();
	foreach($groups as $k => $group) {
		$group_id = Util::GetAttribute( $group, 'group_id', -1);
		$group_name = Util::GetAttribute( $group, 'group_name', "");

		$result[$group_id] = array( "group_name" => $group_name, "tags"=> array() );
		$where = array( "tag_group_id" => $group_id );

		$tags = $this->db->select("*")->from("tags")->where($where)->all();
		$tags = Util::FilterSelectedTags( $selectedTags, $tags );

		$result[$group_id]['tags'] = $tags;
	}
	return $result;
    }
    /**
     * Get all tags for entry 
     */
    public function getEntryTags($entry_id)
    {
	$where = array( "entry_id" => $entry_id);
	$entry_tag_ids = $this->db->select("*")->from("entries_tags")->where($where)->all();

	$tag_ids = ""; $splitter = "";
	foreach($entry_tag_ids as $k => $entry_tag_id) {
		$tag_id = Util::GetAttribute( $entry_tag_id, 'tag_id', 0);
		$tag_ids = "{$tag_ids}{$splitter}{$tag_id}";
		$splitter = ",";
	}
	$where = array( "tag_id in ($tag_ids)" );
	return $this->db->select("*")->from("tags")->where($where)->all();
    }
}
