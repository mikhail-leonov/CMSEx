<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe;

/**
 * Class Abstract Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 * This is the "base controller class". All other "real" controllers extend this class.
 */
abstract class AbstractController implements \Recipe\Controllers\ControllerInterface
{
    /**
     * @var string|null Controller name
     */
    public $name = "";

    /**
     * Set Controller name inside constructor with overriden in child class setControllerName function
     *
     * @return void
     */
    public function __construct()
    {
        $this->setControllerName();
    }
    /**
     * Set Controller name
     *
     * @return void
     */
    abstract public function setControllerName();
}