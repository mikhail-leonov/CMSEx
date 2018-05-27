<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Decorators;

use \Recipe\Utils\Util;
use \Recipe\Abstracts\AbstractDecorator;
use \Recipe\Interfaces\DecoratorInterface;

/**
 * Array Class Decorator
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 */
class ArrayDecorator extends AbstractDecorator implements DecoratorInterface
{
    /**
     * Decorate
     *
     * @var stdClass $obj parameters
     *
     * @return array array decorated Object
     */
    public function Decorate(\stdClass $obj) : string
    {
        return print_r(Util::obj2arr($obj), 1);
    }
}
