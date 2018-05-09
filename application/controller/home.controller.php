<?php

/**
 * Abstract controller
 */
require_once( CONTROLLER . 'abstract.controller.php' );
require_once( FACTORY . 'model.factory.php' );
require_once( FACTORY . 'view.factory.php' );

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class HomeController extends AbstractController
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
	$this->name = "home";
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index( $params )
    {
	$pageView     = ViewFactory::build("page.page");

	$leftmenuView = ViewFactory::build("left_menu.part");
	$tagModel = ModelFactory::build("tag");
	$leftmenuView->assign("tags", $tagModel->getTags() );
	$pageView->assign("left_menu", $leftmenuView->fetch() );

	$entryView = ViewFactory::build("entry.part");
	$recipeModel = ModelFactory::build("recipe");
	$recipiesView   = ViewFactory::build("recipies.part");
	$recipiesView->assign("entries", $recipeModel->getRecipies() );

	$pageView->assign("content", $recipiesView->fetch() );

        // Display Page
	$pageView->display();
    }

}
