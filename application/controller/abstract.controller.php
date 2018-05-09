<?php

/**
 * Include section
 */
require_once( LIB . 'abstractobject.class.php' );
require_once( LIB . 'db.class.php' );

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
abstract class AbstractController extends AbstractObject
{
    /**
     * @var null Controller name
     */
    public $name = "";

    /**
     * Whenever a controller is created, we open a database connection. 
     * The idea behind is to have ONE connection that can be shared between all models.
     */
    function __construct()
    {
	$this->setControllerName();
    }
    /**
     * setCommonViewProps
     */
    abstract function setControllerName();
}
