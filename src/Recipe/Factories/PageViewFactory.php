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

use \Recipe\Views\PageView;
use \Recipe\Abstracts\AbstractFactory;
use \Recipe\Interfaces\ViewInterface;
use \Recipe\Interfaces\ViewFactoryInterface;

/**
 * This is the "View factory class".
 * Extends AbstractFactory implements IViewFactory
 */
class PageViewFactory extends AbstractFactory implements ViewFactoryInterface
{
    /**
     * Method to build an View object of $name type \Recipe\Interfaces\ViewInterface;
     *
     * @var string $name View name to create
     *
     * @throws ViewNotFoundException if the provided name does not match to any of existing php view files
     *
     * @return IView View we have created
     */
    public static function build(string $name) : ViewInterface
    {
        return new PageView($name);
    }
}
