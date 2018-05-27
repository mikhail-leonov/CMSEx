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

use \Recipe\Utils\Util;
use \Klein\DataCollection\DataCollection;

/**
 * Entry Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class EntryModel extends \Recipe\Abstracts\AbstractModel  implements \Recipe\Interfaces\ModelInterface
{
    /**
     * Get all Entries
     *
     * @var DataCollection $params Parameters
     *
     * @return array All entries matched to selected Tags
     */
    public function GetAllEntries(DataCollection $params) : array
    {
        return $this->db->from("entries")->fetchAll();
    }
    /**
     * Get all selected Entries
     *
     * @var DataCollection $params Parameters
     *
     * @return array All entries matched to selected Tags
     */
    public function GetSelectedEntries(DataCollection $params) : array
    {
        $result = [];
        $selectedTags = Util::GetAlreadySelected("tag");
        if (count($selectedTags) > 0) {

            $found = [];
            foreach ($selectedTags as $k => $tag) {
                $tag_id = Util::GetAttribute($tag, 'tag_id', "");
                $current = [];
                $items = $this->db->from('entries_tags')->where("tag_id", $tag_id)->orderBy("entry_id ASC")->select('entry_id')->fetchAll();
                foreach($items as $idx => $item) {
                    $entry_id = Util::GetAttribute($item, 'entry_id', "");
                    $current[ $entry_id ] = $entry_id;
                }
                if (0 === $k ) {
                    $found = $current;
                } else {
                    $found = array_intersect_key ($found, $current);
                }
            }
            if (count($found) > 0 ) {
                $selectedIds = implode(",", $found);
                $result = $this->db->from("entries")->where("entry_id in ($selectedIds)")->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Get all found Entries
     *
     * @var DataCollection $params Parameters
     *
     * @return array All entries matched to selected Tags
     */
    public function GetFoundEntries(DataCollection $params) : array
    {
        $result = [];
        $q = $params->get('q', '');
        if (!empty($q)) {
            $result = $this->db->from("entries")->where("entry_name LIKE '%{$q}%' OR entry_text LIKE '%{$q}%'")->fetchAll();
        }
        return $result;
    }

    /**
     * Get Entry from Entries table by entry_id
     *
     * @var DataCollection $params parameters
     *
     * @return array
     */
    public function GetEntryById(int $entry_id) : array
    {
        $result = [];
        if (!empty($entry_id)) {
            $where = [ "entry_id" => $entry_id ];
            $entry = $this->db->from("entries")->where("entry_id", $entry_id)->fetchAll();
            if (count($entry) > 0) {
                $result = $entry[0];
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
     * @var array $params
     *
     * @return int 0|N entry_id
     */
    public function CreateEntry(array $params) : int
    {
        $result = 0;
        $entry_name = Util::GetAttribute($params, 'entry_name', ''); 
        $entry_text = Util::GetAttribute($params, 'entry_text', ''); 
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

    /**
     * Bulk update all Entries in Entries table
     *
     * @var array $params
     *
     * @return int 0|N entry_id
     */
    public function BulkUpdate(array $params) 
    {

    }
    
    /**
     * Delete All Entries in Entries table
     *
     * @var array $params
     *
     * @return int 0|N entry_id
     */
    public function DeleteAll(array $params) 
    {

    }


}
