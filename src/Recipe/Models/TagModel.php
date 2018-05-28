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
     * getTags - Returns all Tags
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function getTags(DataCollection $params) : \stdClass {
        $result = 1;

        $selected = Util::GetAlreadySelected("tag");
        $tags = $this->db->from('tags')->orderBy("tag_name ASC")->fetchAll();
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
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function postTags(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * putTags - Bulk update of Tags
     * 
     * @var DataCollection $params parameters
     *
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
     *
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
     *
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
     *
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
     *
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
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function deleteTag(DataCollection $params) : \stdClass {
        $result = 0;
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

    /**
     * Get all tags for entry
     *
     * @var int $entry_id
     *
     * @return \stdClass { result: 0|1, data: object }; 
     */
    public function getEntryTags(int $entry_id) : \stdClass {
        $result = 1;

        $entry_tag_ids = $this->db->from('entries_tags')->where('entry_id', $entry_id)->fetchAll();
        $tag_ids = "";
        $splitter = "";
        foreach ($entry_tag_ids as $k => $entry_tag_id) {
            $tag_id = Util::GetAttribute($entry_tag_id, 'tag_id', 0);
            $tag_ids = "{$tag_ids}{$splitter}{$tag_id}";
            $splitter = ",";
        }
        $tags = $this->db->from('tags')->where("tag_id in ($tag_ids)")->orderBy("tag_group_id ASC")->fetchAll();
        if (false === $tags) {
            $tags = [];
        }
        $tags = new TagCollection( $tags ); 
        return (object)[ 'result' => $result, 'data' => (object)[ 'tags' => $tags ] ];
    }

}
