<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Factories;

use \Recipe\Abstracts\AbstractFactory;
use \Recipe\Interfaces\DecoratorFactoryInterface;
use \Recipe\Interfaces\DecoratorInterface;

/**
 * This is the "Decorator factory class".
 * Extends AbstractFactory implements IDecoratorFactory
 */
class DecoratorFactory extends AbstractFactory implements DecoratorFactoryInterface
{
    /**
     * Method to build a Decorator object of $name type IDecorator
     *
     * @var string $name Decorator name to create
     *
     * @throws DecoratorNotFoundException if the provided name does not match to any of existing php Decorator file
     *
     * @return IDecorator Decorator we have created
     */
    public static function build(string $name) : DecoratorInterface
    {
        $className = "\\Recipe\\Decorators\\" . ucfirst(strtolower($name)) . "Decorator";
        return new $className();
    }
}
