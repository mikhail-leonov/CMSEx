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
use \Recipe\Objects\Entry;
use \Recipe\Collections\EntryCollection;
use \Recipe\Abstracts\AbstractModel;
use \Recipe\Interfaces\ModelInterface;

/**
 * Entry Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class EntryModel extends AbstractModel implements ModelInterface
{
    /**
     * getEntries - Returns all Entries
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function getEntries(DataCollection $params) : \stdClass {
        $result = 1;
	$entries = $this->db->from("entries")->fetchAll();
        if (false === $entries) {
            $entries = [];
            $result = 0;
        }
        $entries = new EntryCollection( $entries );
        return (object)[ 'result' => $result, 'data' => (object)[ 'entries'=> $entries ] ];
    }
    /**
     * postEntries - Create a new Entries
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function postEntries(DataCollection $params) : \stdClass {
        $result = 0;

        $entry_name = $params->get('entry_name', '');
        $entry_text = $params->get('entry_text', '');

        if (!empty($entry_name) && !empty($entry_text)) {
            $fields = [ "entry_name" => $entry_name, "entry_text" => $entry_text ];
            $record = $this->db->insertInto('entries')->values($fields)->execute();
            if (false !== $record) {
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * putEntries - Bulk update of Entries
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function putEntries(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * deleteEntries - Delete all Entries
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function deleteEntries(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * getEntry - Return a specified Entry
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function getEntry(DataCollection $params) : \stdClass {
        $result = 0;
        $entry_id = $params->get('entry_id', '');

        if (!empty($entry_id)) {
            $where = [ "entry_id" => $entry_id ];

            $entries = $this->db->from("entries")->where("entry_id", $entry_id)->fetchAll();

            if (false === $entries) {
                $entry = [];
            } else {
                if (count($entries) > 0) {
                    $entry = $entries[0];
                    $result = 1;
                } else {
                    $entry = [];
                }
            }
        }
        $entry = new Entry( $entry );
        return (object)[ 'result' => $result, 'data' => (object)[ 'entry' => $entry ] ];
    }
    /**
     * postEntry - Not allowed
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function postEntry(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * putEntry - Update a specified Entry
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function putEntry(DataCollection $params) : \stdClass {
        $result = 0;
        $entry_id = $params->get('entry_id', '');
        $entry_name = $params->get('entry_name', '');
        $entry_text = $params->get('entry_text', '');
        if (!empty($entry_id) && !empty($entry_name) && !empty($entry_text)) {
            $fields = [ "entry_name" => $entry_name, "entry_text" => $entry_text ];
            $update = $this->db->update('entries')->set($fields)->where("entry_id", $entry_id);
            if (false !== $update) {
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * deleteEntry - Delete a specified Entry
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function deleteEntry(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }

    /**
     * Get all selected Entries
     *
     * @var DataCollection $params Parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function GetSelectedEntries(DataCollection $params) : \stdClass {
        $result = 0; 
        $entries = [];
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
                $entries = $this->db->from("entries")->where("entry_id in ($selectedIds)")->fetchAll();
                $result = 1; 
            }
        }
        if (false === $entries) {
            $entries = [];
        }
        $entries = new EntryCollection( $entries );
        return (object)[ 'result' => $result, 'data' => (object)[ 'entries' => $entries ] ];
    }

    /**
     * Get all found Entries
     *
     * @var DataCollection $params Parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function GetFoundEntries(DataCollection $params)  : \stdClass {
        $result = 0;  
        $entries = [];
        $q = $params->get('q', '');
        if (!empty($q)) {
            $entries = $this->db->from("entries")->where("entry_name LIKE '%{$q}%' OR entry_text LIKE '%{$q}%'")->fetchAll();
            $result = 1;  
            if (false === $entries) {
                $entries = [];
                $result = 0;  
            }
        }
        if (false === $entries) {
            $entries = [];
        }
        $entries = new EntryCollection( $entries );
        return (object)[ 'result' => $result, 'data' => (object)[ 'entries' => $entries ] ];
    }

}
