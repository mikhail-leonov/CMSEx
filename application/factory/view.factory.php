<?php
/**
 * Require Abstractfactory
 */
require_once(FACTORY . 'abstract.factory.php');
require_once(VIEW . 'abstract.view.php');
require_once(EXCEPTION . 'view.exception.php');

/**
 * This is the "ViewFactory interface".
 */
interface IViewFactory
{
    /**
     * Method to build an View object of $name type IView
     *
     * @var string $name View name to create
     *
     * @throws Exception if the provided name does not match existing php view files
     *
     * @return IView View we have created
     */
    public static function build(string $name) : IView;
}

/**
 * This is the "View factory class".
 * Extends AbstractFactory implements IViewFactory
 */
class ViewFactory extends AbstractFactory implements IViewFactory
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
        $filename = '';
        if (strpos($name, ".page") !== false) {
            $filename = VIEW . 'page.view.php';
            require_once($filename);
            return new PageView($name);
        }
        if (strpos($name, ".part") !== false) {
            $filename = VIEW . 'part.view.php';
            require_once($filename);
            return new PartView($name);
        }
        throw new ViewNotFoundException($name, $filename);
    }
}
