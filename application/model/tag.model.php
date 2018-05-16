<?php
/**
 * Include section
 */
require_once(MODEL . 'abstract.model.php');

/**
 * Tag Model
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
     *
     * @return array
     */
    public function getTags() : array
    {
        $result = array();
        $selectedTags = Util::GetAlreadySelected("tag");
        $result[0] = array( "group_name" => "Selected", "tags"=> $selectedTags );
            
        $order = array("group_order" => "ASC");
        $groups = $this->db->select("*")->from("groups")->order($order)->all();
        foreach ($groups as $k => $group) {
            $group_id = Util::GetAttribute($group, 'group_id', -1);
            $group_name = Util::GetAttribute($group, 'group_name', "");

            $result[$group_id] = array( "group_name" => $group_name, "tags"=> array() );
            $where = array( "tag_group_id" => $group_id );
            $order = array( "tag_name" => "ASC");
            
            $tags = $this->db->select("*")->from("tags")->where($where)->order($order)->all();
            $tags = Util::FilterSelectedTags($selectedTags, $tags);

            $result[$group_id]['tags'] = $tags;
        }
        return $result;
    }

    /**
     * Get all tags for entry
     *
     * @var string $entry_id
     *
     * @return array
     */
    public function getEntryTags(string $entry_id) : array
    {
        $where = array( "entry_id" => $entry_id);
        $entry_tag_ids = $this->db->select("*")->from("entries_tags")->where($where)->all();

        $tag_ids = "";
        $splitter = "";
        foreach ($entry_tag_ids as $k => $entry_tag_id) {
            $tag_id = Util::GetAttribute($entry_tag_id, 'tag_id', 0);
            $tag_ids = "{$tag_ids}{$splitter}{$tag_id}";
            $splitter = ",";
        }
        $where = array( "tag_id in ($tag_ids)" );
        return $this->db->select("*")->from("tags")->where($where)->all();
    }

    /**
     * Get all tag groups
     *
     * @return array
     */
    public function getGroups() : array
    {
        $order = array("group_order" => "ASC");
        return $this->db->select("*")->from("groups")->order($order)->all();
    }
}
