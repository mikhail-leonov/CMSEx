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
     * Get Entry from Entries table by entry_id
     *
     * @var array $params parameters
     *
     * @return array
     */
    public function GetEntryData(string $entry_id) : array
    {
        $result = [];
        if (!empty($entry_id)) {
            $where = [ "entry_id" => $entry_id ];
            $entry = $this->db->select("*")->from("entries")->where($where)->first();
            if (false !== $entry) {
                $result = $entry;
            }
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
    public function UpdateEntry(string $entry_id, string $entry_name, string $entry_text) : int
    {
        $result = 0;
	if (!empty($entry_id)) {
            $where = [ "entry_id" => $entry_id ];
            $fields = [ "entry_name" => $entry_name, "entry_text" => $entry_text ];
            if (false !== $this->db->update($fields)->into("entries")->where($where)->exec()) {
                $result = 1;
	    }
        }
        return $result;
    }


    /**
     * Insert New Entry in Entries table
     *
     * @var string $entry_name
     *
     * @var string $entry_text
     *
     * @return int 0|N entry_id
     */
    public function CreateEntry(string $entry_name, string $entry_text) : int
    {
        $result = 0;
	if (!empty($entry_name)) {
	    if (!empty($entry_text)) {
                $fields = [ "entry_name" => $entry_name, "entry_text" => $entry_text ];
                $this->db->insert($fields)->into("entries")->exec();
                $record = $this->db->select("*")->from("entries")->where($fields)->first();
                if (false !== $record) {
                    $result = $record['entry_id'];
	        }
            }
	}
        return $result;
    }
}
