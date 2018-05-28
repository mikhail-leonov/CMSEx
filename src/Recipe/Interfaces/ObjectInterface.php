<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Interfaces;

/**
 * This is the "Object interface".
 */
interface ObjectInterface
{
    /**
     * Object parameters assignement
     *
     * @var array $arr Group parameters as array
     *
     * @return void
     */
    public function assign(array $arr);
    /**
     * Get Node Id 
     *
     * @return int node id
     */
    public function getId() : int ;
    /**
     * Get Node Name
     *
     * @return string node Name
     */
    public function getName() : string;
    /**
     * Get Node Parent Id 
     *
     * @return int node id
     */
    public function getParentId() : int;
    /**
     * Get Node Id Prefix
     *
     * @return string node id prefix
     */
    public function getPrefix() : string;
    /**
     * Get Node Id Parent Prefix
     *
     * @return string node id parent prefix
     */
    public function getParentPrefix() : string;
}


