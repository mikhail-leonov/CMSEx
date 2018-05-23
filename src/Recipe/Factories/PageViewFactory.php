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

/**
 * This is the "View factory class".
 * Extends AbstractFactory implements IViewFactory
 */
class PageViewFactory extends \Recipe\Abstracts\AbstractFactory implements \Recipe\Interfaces\ViewFactoryInterface
{
    /**
     * Method to build an View object of $name type IView
     *
     * @var string $name View name to create
     *
     * @throws ViewNotFoundException if the provided name does not match to any of existing php view files
     *
     * @return IView View we have created
     */
    public static function build(string $name) : IView
    {
        return new \Recipe\Views\PageView($name);
    }
}
