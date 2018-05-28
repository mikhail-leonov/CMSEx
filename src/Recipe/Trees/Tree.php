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

use \Recipe\Objects\Tag;
use \Recipe\Objects\Group;
use \Recipe\Trees\TreeNode;
use \Recipe\Interfaces\ObjectInterface;
use \Recipe\Collections\GroupCollection;
use \Recipe\Collections\TagCollection;

/**
 * This is the Tree class
 */
class Tree
{
    /**
     * @var TreeNode $roots Tree root nodes
     */
    public $roots = null;
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
	$this->roots = [];
    }
    /**
     * Search node with id = $node_id
     *
     * @var int $node_id Search a node with given id
     *
     * @var TreeNode $node|null Search starting point if null then start from the top
     *
     * @return TreeNode|null - found node or null
     */
    function &find(string $node_id, TreeNode $node = null) {

        $result = null;
        if (!isset($node)) {
            if( count($this->roots) > 0 ) {
                foreach($this->roots as $k => $child) {
                    $result = &$this->find($node_id, $child);
                    if (isset($result)) { break; }
                }
            }
        }
        if (isset($node)) {
            if ($node_id === $node->id) {
                $result = &$node;
            }
            if (!isset($result)) {
                foreach($node->children as $k => $child) {
                    $result = &$this->find($node_id, $child);
                    if (isset($result)) { break; }
                }
            }
        }
        return $result;
    }
    /**
     * Search node with id = $node_id
     *
     * @var TreeNode $node a new node to add 
     *
     * @return void
     */
    function add(ObjectInterface $obj) {
    
        $node = new TreeNode($obj);
        $parent_id = $obj->GetParentPrefix() . $obj->GetParentId();

        if (0 === $parent_id) {
            $this->roots[] = $node;
        } else {
            $found = &$this->find($parent_id);
            if (isset($found)) {
                $found->add($node);
            } else {
                $this->roots[] = $node;
            }
        }  
    }
    /**
     * Assign Groups to tree data from plain array
     *
     * @var GroupCollection $nodes Nodes to be added to the Tree
     *
     * @return void
     */
    function AssignGroups(GroupCollection $nodes) {
        foreach($nodes as $k => $child) {
            $this->add($child); 
        }
    }
    /**
     * Assign Tags to tree data from plain array
     *
     * @var TagCollection $nodes Nodes to be added to the Tree
     *
     * @return void
     */
    function AssignTags(TagCollection $nodes) {
        foreach($nodes as $k => $child) {
            $this->add($child); 
        }
    }
}