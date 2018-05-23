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

/**
 * This is the "base abstract factory class". All other "real" factories extend this class.
 */
abstract class AbstractFactory 
{
    /**
     * Abstract method to build an object of $name type
     * Can't declare return result type since derived
     * classes will not be able to override it
     *
     * @var string $name Modelname to create
     */
    abstract public static function build(string $name);
}
