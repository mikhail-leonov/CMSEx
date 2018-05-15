<?php
/**
 * Include section
 */
require_once(MODEL . 'abstract.model.php');

/**
 * Entry Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class EntryModel extends AbstractModel
{
    /**
     * Get all selected/grouped niot selected tags from tags Table
     * 
     * @var array $params parameters
     * 
     * @return array
     */
    public function get_content(array $params) : array
    {
        $result = array();
        $entry_id = (count($params)> 0) ? $params[0] : 0;
        if (intval($entry_id) > 0) {
            $where = array( "entry_id" => $entry_id );
            $result = $this->db->select("*")->from("entries")->where($where)->first();
        }
        return $result;
    }

    /**
     * Update Entry in Entries table by entry_id
     * 
     * @var string $entry_id
     * 
     * @var string $entry_name
     * 
     * @var string $entry_text
     * 
     * @return int 0|1
     */
    public function updateEntry(string $entry_id, string $entry_name, string $entry_text) : int
    {
        $result = 0;
        $where = array( "entry_id" => $entry_id );
        $fields = array("entry_name" => $entry_name, "entry_text" => $entry_text);
        $result = $this->db->update($fields)->into("entries")->where($where)->exec();
        return $result;
    }
}
