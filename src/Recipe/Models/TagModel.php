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

use \Recipe\Util;

/**
 * Tag Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class TagModel extends \Recipe\Abstracts\AbstractModel implements \Recipe\Interfaces\ModelInterface
{
    /**
     * Get all tag groups
     *
     * @return array
     */
    public function getGroups() : array
    {
        return $this->db->from('groups')->orderBy("group_id ASC")->fetchAll();
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
        $tags = $this->db->from('tags')->orderBy("tag_name ASC")->fetchAll();
        return Util::FilterSelectedTags($selected, $tags);
    }

    /**
     * Get all tags for entry
     *
     * @var int $entry_id
     *
     * @return array
     */
    public function getEntryTags(int $entry_id) : array
    {
        $entry_tag_ids = $this->db->from('entries_tags')->where('entry_id', $entry_id)->fetchAll();
        $tag_ids = "";
        $splitter = "";
        foreach ($entry_tag_ids as $k => $entry_tag_id) {
            $tag_id = Util::GetAttribute($entry_tag_id, 'tag_id', 0);
            $tag_ids = "{$tag_ids}{$splitter}{$tag_id}";
            $splitter = ",";
        }
		return $this->db->from('tags')->where("tag_id in ($tag_ids)")->orderBy("tag_group_id ASC")->fetchAll();
    }
}
