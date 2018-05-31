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

use Klein\DataCollection\DataCollection;
use \Recipe\Objects\Group;
use \Recipe\Collections\GroupCollection;
use \Recipe\Abstracts\AbstractModel;
use \Recipe\Interfaces\ModelInterface;

/**
 * Group Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class GroupModel extends AbstractModel implements ModelInterface
{
    /**
     * getGroups - Returns all groups
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function getGroups(DataCollection $params) : \stdClass {
        $result = 1;

        $order  = $this->GetSortOrder($params, "group_name", "ASC" );
	$fields = $this->GetQueryFields($params);
        $limit  = $this->GetQueryLimit($params);
        $offset = $this->GetQueryOffset($params);

        $groups     = $this->db->from("groups")->orderBy($order)->select($fields)->limit($limit)->offset($offset)->fetchAll();
        if (false === $groups) { $groups = []; $result = 0; }
        $groups = new GroupCollection( $groups );
        return (object)[ 'result' => $result, 'data' => (object)[ 'groups' => $groups ] ];
    }
    /**
     * postGroups - Create a new groups
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function postGroups(DataCollection $params) : \stdClass {
        $result = 0;
        $group_name  = $params->get('group_name', '');
        if (!empty($group_name)) {
            $fields = [ "group_name" => $group_name ];
            $record = $this->db->insertInto('groups')->values($fields)->execute();
            if (false !== $record) {
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * putGroups - Bulk update of groups
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function putGroups(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * deleteGroups - Delete all groups
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function deleteGroups(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * getGroup - Return a specified groups
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function getGroup(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * postGroup - Not allowed
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function postGroup(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * putGroup - Update a specified groups
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function putGroup(DataCollection $params) : \stdClass {
        $result = 0;
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    /**
     * deleteGroup - Delete a specified groups
     * 
     * @var DataCollection $params parameters
     *
     * @return \stdClass { result: 0|1, data: object };
     */
    public function deleteGroup(DataCollection $params) : \stdClass {
        $result = 0;
        $group_id   = $params->get('group_id', 0);
        if (!empty($group_id)) {
            $record = $this->db->deleteFrom('groups')->where('group_id', $group_id)->execute();
            if (false !== $record) {
                $result = 1;
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
}
