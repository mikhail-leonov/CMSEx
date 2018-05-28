<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Collections;

use \Recipe\Abstracts\AbstractCollection;
use \Recipe\Objects\Tag;

/**
 * Tag Collection
 *
 * A generic collection class to contain array-like data, specifically
 * designed to work with HTTP data (request params, session data, etc)
 *
 */
class TagCollection extends AbstractCollection
{
    /**
     * Constructor
     *
     * @param array $attributes The data attributes of this collection
     */
    public function __construct(array $attributes = [])
    {
        $this->assign($attributes);
    }

    /**
     * Assign items from array as Data Collection typed objects
     *
     * @param array $attributes   Array with elements to insert
     * @return void
     */
    public function assign(array $attributes) {
        foreach ($attributes as $index => $attribute) {
            $obj = new Tag($attribute);
            $this->set($obj->GetId(), $obj);
        }
    } 
}
