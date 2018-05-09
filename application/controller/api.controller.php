<?php

/**
 * Abstract controller
 */
require_once( CONTROLLER . 'abstract.controller.php' );
require_once( FACTORY . 'model.factory.php ' );

/**
 * Class Api Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ApiController extends AbstractController
{
    /**
     * Whenever a controller is created, we set it's name
     */
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Implementation AbstractController setControllerName function
     */
    function setControllerName()
    {
	$this->name = "api";
    }
    /**
     * PAGE: api/index
     * This method handles what happens when you move to http://yourproject/api/index
     */
    public function index( $params )
    {
	header('Location: /');
    }
    /**
     * PAGE: api/select_tag
     * This method handles what happens when you move to http://yourproject/api/select_tag
     */
    public function select_tag( $params )
    {
	$apiModel = ModelFactory::build("api");
	$apiModel->select_tag();
	header('Location: /');
    }
    /**
     * PAGE: api/unselect_tag
     * This method handles what happens when you move to http://yourproject/api/unselect_tag
     */
    public function unselect_tag( $params )
    {
	$apiModel = ModelFactory::build("api");
	$apiModel->unselect_tag();
	header('Location: /');
    }

}