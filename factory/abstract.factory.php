<?php
/**
 * Include section
 */
require_once(LIB . 'abstractobject.class.php');
require_once(MODEL . 'abstract.model.php');

/**
 * This is the "base abstract factory class". All other "real" factories extend this class.
 */
abstract class AbstractFactory extends AbstractObject
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
