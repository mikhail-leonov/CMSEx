<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Utils;

use \Recipe\Utils\Util;

/**
 * This is the "Tree Builder class".
 */
class Tree {
    /**
     * Constructor
     *
     * @var string $name entity name
     *
     * @return Tree object
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    /**
     * Build Tree Node 
     *
     * @var array $item entity 
     *
     * @return array 
     */
    private function BuildNode(array $item) : array
    {
        return [ 'node' => $item, 'children' => [] ];
    }
    /**
     * Build Tree from array
     *
     * @var array $arr entity array to be converted to Tree
     *
     * @return array 
     */
    public function Build(array $arr) : array
    {
        $result = [];
	    foreach($arr as $k => $item) {
            $parent_id = Util::GetAttribute($item, $this->name . '_parent_id', 0);
	        if ( empty($parent_id) ) {
                $result[] = $this->BuildNode($item);
            } else {
                if ( !$this->Attach($result, $item) ) {
				    $result[] = $this->BuildNode($item);
				}
            }
        }
        return $result;
    }
    /**
     * Attach Node to tree
     *
     * @var array $arr entity array to be converted to Tree
     *
     * @return boolen
     */
    private function Attach(array &$arr, array $item)
    {
	    $result = false;
	    $found = $this->Find($arr, $item);
	    if (!empty($found)) {
			$found['children'][] = $this->BuildNode($item); $result = true;
		}
        return $result;
    }
    /**
     * Find parent node in the tree
     *
     * @var array $arr entity array to be converted to Tree
     *
     * @return array
     */
    private function Find(array $arr, array $item) : array
    {
	    $result = [];
		$parent_id = Util::GetAttribute($item, $this->name . '_parent_id', 0);
	    foreach($arr as $k => $v ) {
		    $id = Util::GetAttribute($v['node'], $this->name . '_id', 0);
			if ( $id === $parent_id ) {
			    $result = $v; break;
			} else {
			    $result = $this->Find($v['children'], $item);
				if (!empty($result)) { break; }
			}
		}
        return $result;
    }
}