<?php
/**
 * Include section
 */
require_once(LIB . 'abstractobject.class.php');
require_once(LIB . 'db.class.php');


/**
 * This is the "basic controller interface".
 */
interface IController
{
    /**
     * Set Controller name
     *
     * @return void
     */
    public function setControllerName();
}


/**
 * Class Api Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 * This is the "base controller class". All other "real" controllers extend this class.
 */
abstract class AbstractController extends AbstractObject implements IController
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
