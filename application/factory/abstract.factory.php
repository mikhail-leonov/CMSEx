<?php

/**
 * Include section
 */
require_once( LIB . 'abstractobject.class.php' );

/**
 * This is the "base factory class". All other "real" factories extend this class.
 */
abstract class AbstractFactory extends AbstractObject
{
    /**
     * Abstract method to build an object of $name type
     */
    public static abstract function build($name);
}
