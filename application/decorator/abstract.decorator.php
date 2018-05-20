<?php
/**
 * Include section
 */
require_once(LIB . 'abstractobject.class.php');


/**
 * This is the "basic decorator interface".
 */
interface IDecorator
{
    /**
     * Decorate
     *
     * @var stdClass $obj parameters
     *
     * @return string decorated Object
     */
    public function Decorate(stdClass $obj) : string;
}

/**
 * Class Decorator
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 * This is the "base Decorator class". All other "real" decorators extend this class.
 */
abstract class AbstractDecorator extends AbstractObject implements IDecorator
{
    /**
     * Decorate
     *
     * @var stdClass $obj parameters
     *
     * @return string decorated Object
     */
    abstract public function Decorate(stdClass $obj) : string;
}
