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
 * Tag
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Tag extends AbstractObject implements ObjectInterface
{
    /**
     * Properties
     */
    protected $tag_id;
    protected $tag_name;
    protected $tag_group_id;

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
     * Tag parameters assignement
     *
     * @var array $arr Tag parameters as array
     *
     * @return void
     */
    public function Assign(array $arr) {
	$this->tag_id = (int)$arr['tag_id'];
	$this->tag_name = (string)$arr['tag_name'];
	$this->tag_group_id = empty($arr['tag_group_id']) ? 0 : (int)$arr['tag_group_id'];
    }
    /**
     * Get Node Id 
     *
     * @return int node id
     */
    public function GetId() : int {
        return $this->tag_id;
    }
    /**
     * Get Node Name
     *
     * @return string node Name
     */
    public function GetName() : string {
        return str_replace( '"', '&quot;', $this->tag_name);
    }
    /**
     * Get Node Parent Id 
     *
     * @return int node id
     */
    public function GetParentId() : int {
        return $this->tag_group_id;
    }
    /**
     * Get Node Id Prefix
     *
     * @return string node id prefix
     */
    public function GetPrefix() : string {
        return 't_';
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
