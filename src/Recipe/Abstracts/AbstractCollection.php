<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Abstracts;

use \Recipe\Interfaces\ObjectInterface;
use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * Abstract Data Collection
 *
 * A generic collection class to contain array-like data, specifically
 * designed to work with HTTP data (request params, session data, etc)
 *
 */
abstract class AbstractCollection implements IteratorAggregate, ArrayAccess, Countable, JsonSerializable
{

    /**
     * Class properties
     */

    /**
     * Collection of data attributes
     *
     * @type array
     */
    protected $attributes;

    /**
     * Constructor
     */
    public function __construct() {
    }

    /**
     * Assign items from array as Data Collection typed objects
     *
     * @param array $arr   Array with elements to insert
     * @return void
     */
    abstract public function assign(array $arr); 

    /**
     * Returns all of the key names in the collection
     *
     * If an optional mask array is passed, this only
     * returns the keys that match the mask
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->attributes);
    }

    /**
     * Returns all of the attributes in the collection
     *
     * If an optional mask array is passed, this only
     * returns the keys that match the mask
     *
     * @return array
     */
    public function all($mask = null, $fill_with_nulls = true)
    {
        return $this->attributes;
    }

    /**
     * Return an attribute of the collection
     *
     * Return a default value if the key doesn't exist
     *
     * @param string $key           The name of the parameter to return
     * @param mixed  $default_val   The default value of the parameter if it contains no value
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }
        return $default;
    }

    /**
     * Set an attribute of the collection
     *
     * @param string $key   The name of the parameter to set
     * @param mixed  $value The value of the parameter to set
     * @return DataCollection
     */
    public function set($key, $value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * Replace the collection's attributes
     *
     * @param array $attributes The attributes to replace the collection's with
     * @return DataCollection
     */
    public function replace(array $attributes = array())
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * See if an attribute exists in the collection
     *
     * @param string $key   The name of the parameter
     * @return boolean
     */
    public function exists($key)
    {
        // Don't use "isset", since it returns false for null values
        return array_key_exists($key, $this->attributes);
    }

    /**
     * Remove an attribute from the collection
     *
     * @param string $key   The name of the parameter
     * @return void
     */
    public function remove($key)
    {
        unset($this->attributes[$key]);
    }

    /**
     * Clear the collection's contents
     *
     * Semantic alias of a no-argument `$this->replace` call
     *
     * @return DataCollection
     */
    public function clear()
    {
        return $this->replace();
    }

    /**
     * Check if the collection is empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return empty($this->attributes);
    }

    /**
     * Magic "__get" method
     *
     * Allows the ability to arbitrarily request an attribute from
     * this instance while treating it as an instance property
     *
     * @see get()
     * @param string $key   The name of the parameter to return
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Magic "__set" method
     *
     * Allows the ability to arbitrarily set an attribute from
     * this instance while treating it as an instance property
     *
     * @see set()
     * @param string $key   The name of the parameter to set
     * @param mixed  $value The value of the parameter to set
     * @return void
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Magic "__isset" method
     *
     * Allows the ability to arbitrarily check the existence of an attribute
     * from this instance while treating it as an instance property
     *
     * @see exists()
     * @param string $key   The name of the parameter
     * @return boolean
     */
    public function __isset($key)
    {
        return $this->exists($key);
    }

    /**
     * Magic "__unset" method
     *
     * Allows the ability to arbitrarily remove an attribute from
     * this instance while treating it as an instance property
     *
     * @see remove()
     * @param string $key   The name of the parameter
     * @return void
     */
    public function __unset($key)
    {
        $this->remove($key);
    }

    /**
     * Get the aggregate iterator
     *
     * IteratorAggregate interface required method
     *
     * @see \IteratorAggregate::getIterator()
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->attributes);
    }

    /**
     * Get an attribute via array syntax
     *
     * Allows the access of attributes of this instance while treating it like an array
     *
     * @see \ArrayAccess::offsetGet()
     * @see get()
     * @param string $key   The name of the parameter to return
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Set an attribute via array syntax
     *
     * Allows the access of attributes of this instance while treating it like an array
     *
     * @see \ArrayAccess::offsetSet()
     * @see set()
     * @param string $key   The name of the parameter to set
     * @param mixed  $value The value of the parameter to set
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Check existence an attribute via array syntax
     *
     * Allows the access of attributes of this instance while treating it like an array
     *
     * @see \ArrayAccess::offsetExists()
     * @see exists()
     * @param string $key   The name of the parameter
     * @return boolean
     */
    public function offsetExists($key)
    {
        return $this->exists($key);
    }

    /**
     * Remove an attribute via array syntax
     *
     * Allows the access of attributes of this instance while treating it like an array
     *
     * @see \ArrayAccess::offsetUnset()
     * @see remove()
     * @param string $key   The name of the parameter
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->remove($key);
    }

    /**
     * Count the attributes via a simple "count" call
     *
     * Allows the use of the "count" function (or any internal counters)
     * to simply count the number of attributes in the collection.
     *
     * @see \Countable::count()
     * @return int
     */
    public function count()
    {
        return count($this->attributes);
    }
    /**
     * jsonSerialize
     *
     * @return array  Objects to retrieve
    */
    public function jsonSerialize() : array {
        return $this->all();
    }
}
