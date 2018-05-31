<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Objects;

use \Recipe\Utils\Util;
use \Recipe\Interfaces\ObjectInterface;
use \Recipe\Abstracts\AbstractObject;


/**
 * Group
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Group extends AbstractObject implements ObjectInterface
{
    /**
     * Properties
     */
    protected $group_id;
    protected $group_name;
    protected $group_parent_id;
    
    /**
     * Constructor
     *
     * @var array $arr Group parameters as array
     *
     * @return void
     */
    public function __construct(array $arr) {
	$this->assign($arr);
    }
    /**
     * Group parameters assignement
     *
     * @var array $arr Group parameters as array
     *
     * @return void
     */
    public function Assign(array $arr) {
	$this->group_id = (int)$arr['group_id'];
	$this->group_name = (string)$arr['group_name'];
	$this->group_parent_id = empty($arr['group_parent_id']) ? 0 : (int)$arr['group_parent_id'];
    }
    /**
     * Get Node Id 
     *
     * @return int node id
     */
    public function GetId() : int {
        return $this->group_id;
    }
    /**
     * Get Node Name
     *
     * @return string node Name
     */
    public function GetName() : string {
        return str_replace( '"', '&quot;', $this->group_name);
    }
    /**
     * Get Node Parent Id 
     *
     * @return int node id
     */
    public function GetParentId() : int {
        return $this->group_parent_id;
    }
    /**
     * Get Node Id Prefix
     *
     * @return string node id prefix
     */
    public function GetPrefix() : string {
        return 'g_';
    }
    /**
     * Get Node Id Parent Prefix
     *
     * @return string node id parent prefix
     */
    public function GetParentPrefix() : string {
        return 'g_';
    }
}
