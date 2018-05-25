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

use \Recipe\Abstracts\AbstractDecorator;
use \Recipe\Interfaces\DecoratorInterface;

/**
 * XML Class Decorator
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 */
class NullDecorator extends AbstractDecorator implements DecoratorInterface
{
    /**
     * Decorate
     *
     * @var stdClass $obj parameters
     *
     * @return any non-decorated Object
     */
    public function Decorate(\stdClass $obj) : string
    {
        return print_r($obj, 1);
    }
}
