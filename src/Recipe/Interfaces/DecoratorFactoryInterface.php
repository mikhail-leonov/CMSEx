<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Interfaces;

use \Recipe\Interfaces\DecoratorInterface;

/**
 * This is the "DecoratorFactory interface".
 */
interface DecoratorFactoryInterface
{
    /**
     * Method to build an Model object of $name type IDecorator
     *
     * @var string $name Decorator name to create
     *
     * @throws Exception if the provided name does not match existing php Decorator file
     *
     * @return IDecorator Decorator we have created
     */
    public static function build(string $name) : DecoratorInterface;
}

