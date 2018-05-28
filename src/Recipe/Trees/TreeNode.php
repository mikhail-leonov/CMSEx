<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Trees;

use \Recipe\Interfaces\ObjectInterface;

/**
 * This is the TreeNode class
 */
class TreeNode
{
    /**
     * @var int $id Node ID 
     */
    public $id = NULL;
    /**
     * @var string $data Value associated with current tree node 
     */
    public $data = null;
    /**
     * @var araay $children List of subnodes associated with current tree node 
     */
    public $children = [];

    /**
     * Constructor
     *
     * @var int $id Node ID 
     *
     * @var any $data Value associated with current tree node 
     *
     * @return void
     */
    public function __construct(ObjectInterface $obj) {
	$this->id = $obj->GetPrefix() . $obj->GetId();
	$this->data = $obj;
    }
    /**
     * Add sub node 
     *
     * @var TreeNode $node Adding new sub-Node to child list
     *
     * @return void
     */
    public function GetData() {
	return $this->data;
    }
    /**
     * Add sub node 
     *
     * @var TreeNode $node Adding new sub-Node to child list
     *
     * @return void
     */
    public function add(TreeNode $node) {
	$obj = $node->GetData();
        $id = $obj->GetPrefix() . $obj->GetId();
	$this->children[ $id ] = $node;
    }
}