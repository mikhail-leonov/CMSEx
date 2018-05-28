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

/**
 * entry
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Entry implements ObjectInterface
{
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
     * entry parameters assignement
     *
     * @var array $arr entry parameters as array
     *
     * @return void
     */
    public function Assign(array $arr) {
	$this->entry_id = (int)$arr['entry_id'];
	$this->entry_name = (string)$arr['entry_name'];
	$this->entry_group_id = 0;
	$this->entry_text = (string)$arr['entry_text'];
    }
    /**
     * Get Node Id 
     *
     * @return int node id
     */
    public function GetId() : int {
        return $this->entry_id;
    }
    /**
     * Get Node Name
     *
     * @return string node Name
     */
    public function GetName() : string {
        return $this->entry_name;
    }
    /**
     * Get Node Parent Id 
     *
     * @return int node id
     */
    public function GetParentId() : int {
        return $this->entry_group_id;
    }
    /**
     * Get Node Id Prefix
     *
     * @return string node id prefix
     */
    public function GetPrefix() : string {
        return 'e_';
    }
    /**
     * Get Id Parent Prefix
     *
     * @return string node id parent prefix
     */
    public function GetParentPrefix() : string {
        return 't_';
    }
    /**
     * Get Entry Name
     *
     * @return string node Name
     */
    public function GetText() : string {
        return $this->entry_text;
    }
}
