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

/**
 * This is the "ViewFactory interface".
 */
interface ViewFactoryInterface
{
    /**
     * Method to build an View object of $name type \Recipe\Interfaces\ViewInterface;
     *
     * @var string $name View name to create
     *
     * @throws Exception if the provided name does not match existing php view files
     *
     * @return IView View we have created
     */
    public static function build(string $name) : \Recipe\Interfaces\ViewInterface;
}
