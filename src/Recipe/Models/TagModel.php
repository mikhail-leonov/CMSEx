<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Models;

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
     * Get all tag groups
     *
     * @return array
     */
    public function getGroups() : array
    {
        $order = ["group_id" => "ASC"];
        return $this->db->select("*")->from("groups")->order($order)->all();
    }

    /**
     * Get all selected tags from tags Table
     *
     * @return array
     */
    public function getSelectedTags() : array
    {
        return Util::GetAlreadySelected("tag");
    }

    /**
     * Get all tags from tags Table
     *
     * @return array
     */
    public function getTags() : array
    {
        $selected = Util::GetAlreadySelected("tag");
        $order = ['tag_name' => 'ASC'];
        $tags = $this->db->select("*")->from("tags")->order($order)->all();
        return Util::FilterSelectedTags($selected, $tags);
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
        $where = [ "entry_id" => $entry_id];
        $entry_tag_ids = $this->db->select("*")->from("entries_tags")->where($where)->all();

        $tag_ids = "";
        $splitter = "";
        foreach ($entry_tag_ids as $k => $entry_tag_id) {
            $tag_id = Util::GetAttribute($entry_tag_id, 'tag_id', 0);
            $tag_ids = "{$tag_ids}{$splitter}{$tag_id}";
            $splitter = ",";
        }
        $where = [ "tag_id in ($tag_ids)" ];
        $order = [ 'tag_group_id' => 'ASC' ];
        return $this->db->select("*")->from("tags")->where($where)->order($order)->all();
    }
}
