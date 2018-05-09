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
class EntryModel extends AbstractModel
{
    /**
     * Get all selected/grouped niot selected tags from tags Table 
     */
    public function get_content( $params )
    {
	$result = array();
	$entry_id = (count($params)> 0) ? $params[0] : 0;
	if ( intval($entry_id) > 0) {
		$where = array( "entry_id" => $entry_id );
		$result = $this->db->select("*")->from("entries")->where($where)->first();
	}
	return $result;
    }

    /**
     * Update Entry in Entries table by entry_id
     */
    public function updateEntry($entry_id, $entry_name, $entry_text)
    {
	$result = 0;
	$where = array( "entry_id" => $entry_id );
	$fields = array("entry_name" => $entry_name, "entry_text" => $entry_text);
	$result = $this->db->update($fields)->into("entries")->where($where)->exec();
	return $result;
    }

}
