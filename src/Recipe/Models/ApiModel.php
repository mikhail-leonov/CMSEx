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
use \Recipe\Utils\Cookie;
use Klein\DataCollection\DataCollection;
use \Recipe\Abstracts\AbstractModel;
use \Recipe\Interfaces\ModelInterface;


/**
 * API Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ApiModel extends AbstractModel implements ModelInterface
{
    /**
     * Select Tag
     *
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function SelectTag(DataCollection $params) : \stdClass
    {
        $result = 0;
        $tag_id   = $params->get('tag_id'  , '');
        $tag_name = $params->get('tag_name', '');
        if ( (!empty($tag_id)) && (!empty($tag_name)) ) {
            Cookie::setCookieFOREVER("tag[$tag_id]", $tag_name);
            $result = 1;
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * Unselect Tag
     *
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function UnselectTag(DataCollection $params) : \stdClass
    {
        $result = 0;
        $tag_id   = $params->get('tag_id'  , '');
        $tag_name = $params->get('tag_name', '');
        if ( (!empty($tag_id)) && (!empty($tag_name)) ) {
            Cookie::setCookie("tag[$tag_id]", false, - Cookie::YEAR);
            $result = 1;
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    
    /**
     * new_tag
     *
     * @var array $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function NewTag(array $params) : \stdClass
    {
        $result = 0;

        $tag_name     = Util::GetAttribute($params, 'tag_name', '');
        $tag_text     = Util::GetAttribute($params, 'tag_text', '');
        $tag_group_id = Util::GetAttribute($params, 'tag_group_id', 0);

        if (!empty($tag_name)) {
            if (!empty($tag_group_id)) {
                $fields = [ "tag_name" => $tag_name, "tag_text" => $tag_text, "tag_group_id" => $tag_group_id ];
                $this->db->insert($fields)->into("tags")->exec();
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    
    /**
     * FindTags
     *
     * @var array $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function FindTags(array $params) : \stdClass
    {
        $tags_text = Util::GetAttribute($params, 'tags_text', '');
        $tags_text = trim($tags_text);
        $data = Util::FindTags($this, $tags_text);
        return (object)[ 'result' => $data['result'], 'data' => (object)['tags' => $data['data']] ];
    }
    
    /**
     * AssignTags
     *
     * @var array $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function AssignTags(array $params) : \stdClass
    {
        $result = 0;
        $entry_id = Util::GetAttribute($params, 'entry_id', 0);
        if (0 !== $entry_id) {
            $tag_ids = Util::GetAttribute($params, 'tag_ids', []);

            $data = Util::FindTagsById($this, $tag_ids);

            $tags = Util::GetAttribute($data, 'data', []);
            foreach ($tags as $k => $tag) {
                $fields = [ "tag_id" => $tag['tag_id'], "entry_id" => $entry_id ];
                $this->db->insert($fields)->into("entries_tags")->exec();
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    
    /**
     * Save Entry
     *
     * @var array $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function SaveEntry(array $params) : \stdClass
    {
        $result = 0;
        $entry_id   = Util::GetAttribute($_POST, "entry_id", 0);
        $entry_name = Util::GetAttribute($_POST, "entry_name", '');
        $entry_text = Util::GetAttribute($_POST, "entry_text", '');

        $entry_id   = filter_var($entry_id, FILTER_VALIDATE_INT);

        if ((0 !== $entry_id) && ('' !== $entry_name) && ('' !== $entry_text)) {
            $entryModel = ModelFactory::build("entry");
            $result = $entryModel->UpdateEntry($entry_id, $entry_name, $entry_text);
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    
    /**
     * Save New Entry
     *
     * @var array $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function SaveNewEntry(array $params) : \stdClass
    {
        $result = 0;
        $entry_name = Util::GetAttribute($_POST, "entry_name", '');
        $entry_text = Util::GetAttribute($_POST, "entry_text", '');
        $data = [];

        if (('' !== $entry_name) && ('' !== $entry_text)) {
            $entryModel = ModelFactory::build("entry");
            $entry_id = $entryModel->CreateEntry($entry_name, $entry_text);
            if (0 !== $entry_id) {
                $data = ['entry_id' => $entry_id];
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)$data ];
    }
}
