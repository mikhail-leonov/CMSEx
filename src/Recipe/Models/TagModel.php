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

use \Klein\DataCollection\DataCollection;
use \Recipe\Utils\Util;
use \Recipe\Utils\Cookie;
use \Recipe\Objects\Tag;
use \Recipe\Collections\TagCollection;
use \Recipe\Abstracts\AbstractModel;
use \Recipe\Interfaces\ModelInterface;

/**
 * Tag Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class TagModel extends AbstractModel implements ModelInterface
{
    /**
     * 
     * Basic Tags operations
     * 
     */



    /**
     * getTags - Returns all Tags
     * 
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function getTags(DataCollection $params) : \stdClass {
        $result = 1;

        $selected = Util::GetAlreadySelected("tag");

        $order  = $this->GetSortOrder($params, "tag_name", "ASC" );
	$fields = $this->GetQueryFields($params);
        $limit  = $this->GetQueryLimit($params);
        $offset = $this->GetQueryOffset($params);

        $tags = $this->db->from('tags')->orderBy($order)->select($fields)->limit($limit)->offset($offset)->fetchAll();
        if (false === $tags) {
            $tags = [];
            $result = 0;
        }
        $tags = Util::FilterSelectedTags($selected, $tags);
        $tags = new TagCollection( $tags );
        return (object)[ 'result' => $result, 'data' => (object)[ 'tags' => $tags ] ];
    }
    /**
     * postTags - Create a new Tags
     * 
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function postTags(DataCollection $params) : \stdClass {
        $result = 0;
        $tag_name     = $params->get('tag_name', '');
        $tag_text     = $params->get('tag_text', '');
        $tag_group_id = $params->get('tag_group_id', 'null');
        if (!empty($tag_name)) {
            $fields = [ "tag_name" => $tag_name, "tag_text" => $tag_text, "tag_group_id" => $tag_group_id ];
            $query = $this->db->insertInto('tags')->values($fields)->execute();
            $result = 1;
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * putTags - Bulk update of Tags
     * 
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function putTags(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * deleteTags - Delete all Tags
     * 
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function deleteTags(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * getTag - Return a specified Tags
     * 
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function getTag(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * postTag - Not allowed
     * 
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function postTag(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * putTag - Update a specified Tags
     * 
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function putTag(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * deleteTag - Delete a specified Tags
     * 
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function deleteTag(DataCollection $params) : \stdClass {
        $result = 0;
        $tag_id   = $params->get('tag_id', 0);
        if (!empty($tag_id)) {
            $record = $this->db->deleteFrom('tags')->where('tag_id', $tag_id)->execute();
            if (false !== $record) {
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }




    /**
     * 
     * Basic Entry Tags operations
     * 
     */

    /**
     * Select a Tag 
     *
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function tagSelect(DataCollection $params) : \stdClass
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
     * Unselect a Tag
     *
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function tagUnselect(DataCollection $params) : \stdClass
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
     * Get all tags for entry
     *
     * @var DataCollection $params 
     * @return \stdClass { result: 0|1, data: object }; 
     */
    public function getEntryTags(DataCollection $params) : \stdClass {
        $result = 1;
        $entry_id   = $params->get("entry_id", 0);

        $order  = $this->GetSortOrder($params, "tag_name", "ASC" );
	$fields = $this->GetQueryFields($params);
        $limit  = $this->GetQueryLimit($params);
        $offset = $this->GetQueryOffset($params);

        $entry_tag_ids = $this->db->from('entries_tags')->where('entry_id', $entry_id)->fetchAll();
        $tag_ids = "";
        $splitter = "";
        foreach ($entry_tag_ids as $k => $entry_tag_id) {
            $tag_id = Util::GetAttribute($entry_tag_id, 'tag_id', 0);
            $tag_ids = "{$tag_ids}{$splitter}{$tag_id}";
            $splitter = ",";
        }
        $tags = $this->db->from('tags')->where("tag_id in ($tag_ids)")->orderBy($order)->select($fields)->limit($limit)->offset($offset)->fetchAll();
        if (false === $tags) {
            $tags = [];
        }
        $tags = new TagCollection( $tags ); 
        return (object)[ 'result' => $result, 'data' => (object)[ 'tags' => $tags ] ];
    }
    /**
     * searchEntryTags
     *
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function searchEntryTags(DataCollection $params) : \stdClass
    {
        $tags_text = $params->get('tags_text', '');
        $tags_text = trim($tags_text);
        $data = Util::FindTags($this, $tags_text);
        return (object)[ 'result' => $data['result'], 'data' => (object)['tags' => $data['data']] ];
    }
    /**
     * assignEntryTags
     *
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function assignEntryTags(DataCollection $params) : \stdClass
    {
        $result = 0;
        $entry_id = $params->get('entry_id', 0);
        if (0 !== $entry_id) {
            $tag_ids = $params->get('tag_ids', []);
            
            $data = Util::FindTagsById($this, $tag_ids);

            $tags = Util::GetAttribute($data, 'data', []);
            foreach ($tags as $k => $tag) {
                $fields = [ "tag_id" => $tag['tag_id'], "entry_id" => $entry_id ];
                $this->db->insertInto('entries_tags')->values($fields)->execute();
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * attachTagToEntry
     *
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function attachTagToEntry(DataCollection $params) : \stdClass
    {
        $result = 0;

        $tag_id   = $params->get('tag_id', 0);
        $entry_id = $params->get('entry_id', 0);
        if (!empty($tag_id) && !empty($entry_id)) {
            $fields = [ "tag_id" => $tag_id, "entry_id" => $entry_id ];
            $record = $this->db->insertInto('entries_tags')->values($fields)->execute();
            if (false !== $record) {
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * detachTagFromEntry
     *
     * @var DataCollection $params parameters
     * @return \stdClass { result: 0|1, data: object };
     */
    public function detachTagFromEntry(DataCollection $params) : \stdClass
    {
        $result = 0;

        $tag_id   = $params->get('tag_id', 0);
        $entry_id = $params->get('entry_id', 0);
        if (!empty($tag_id) && !empty($entry_id)) {
            $where = [ "tag_id" => $tag_id, "entry_id" => $entry_id ];
            $record = $this->db->delete()->from("entries_tags")->where($where)->execute();
            if (false !== $record) {
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }













    /**
     * Get all selected tags from tags Table
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function getSelectedTags() : \stdClass {
        $result = 1;
        $tags = Util::GetAlreadySelected("tag"); 
        if (false === $tags) {
            $tags = [];
            $result = 0;
        }
        $tags = new TagCollection( $tags );
        return (object)[ 'result' => $result, 'data' => (object)[ 'tags' => $tags ] ];
    }

    
    
}
