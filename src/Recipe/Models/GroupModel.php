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

/**
 * Group Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class GroupModel extends \Recipe\Abstracts\AbstractModel implements \Recipe\Interfaces\ModelInterface
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
        $groups = $this->db->from("groups")->fetchAll();
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
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
}
