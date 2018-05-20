<?php
/**
 * Include section
 */
require_once(DECORATOR . 'abstract.decorator.php');
require_once(LIB . 'util.class.php');

/**
 * Array Class Decorator
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 */
class ArrayDecorator extends AbstractDecorator
{
    /**
     * Decorate
     *
     * @var stdClass $obj parameters
     *
     * @return array array decorated Object
     */
    public function Decorate(stdClass $obj) : string
    {
        return print_r(Util::obj2arr($obj), 1);
    }
}
