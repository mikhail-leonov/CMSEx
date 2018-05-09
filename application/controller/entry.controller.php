<?php

/**
 * Abstract controller
 */
require_once( CONTROLLER . 'abstract.controller.php' );
require_once( FACTORY . 'model.factory.php ' );
require_once( FACTORY . 'view.factory.php' );

/**
 * Class Api Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class EntryController extends AbstractController
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
	$this->name = "entry";
    }
    /**
     * PAGE: api/index
     * This method handles what happens when you move to http://yourproject/entry/index
     */
    public function index( $params )
    {
	header('Location: /');
    }
    /**
     * PAGE: entry/view
     * This method handles what happens when you move to http://yourproject/entry/view/ID
     */
    public function view( $params )
    {
	$entry_id = Util::GetAttribute( $params, 0, "0");

	$pageView     = ViewFactory::build("page.page");

	$leftmenuView = ViewFactory::build("left_menu.part");
	$tagModel = ModelFactory::build("tag");
	$leftmenuView->assign("tags", $tagModel->getTags() );
	$pageView->assign("left_menu", $leftmenuView->fetch() );

	$entryviewView = ViewFactory::build("entry_view.part");
	
	$entry_tags = $tagModel->getEntryTags($entry_id);
	$entryviewView->assign("entry_tags", $entry_tags);

	$entryModel = ModelFactory::build("entry");
	$entry = $entryModel->get_content( $params );
	$entryviewView->assign("entry", $entry);

	$ingredientModel = ModelFactory::build("ingredient");
	$ingredients = $ingredientModel->getEntryIngredients($entry_id);
	$entryviewView->assign("ingredients", $ingredients);
	

	$pageView->assign("content", $entryviewView->fetch() );

        // Display Page
	$pageView->display();
    }
    /**
     * PAGE: entry/print
     * This method handles what happens when you move to http://yourproject/entry/print/ID
     */
    public function print( $params )
    {
	$entry_id = Util::GetAttribute( $params, 0, "0");

	$pageView     = ViewFactory::build("print.page");

	$entryviewView = ViewFactory::build("entry_print.part");
	
	$tagModel = ModelFactory::build("tag");
	$entry_tags = $tagModel->getEntryTags($entry_id);
	$entryviewView->assign("entry_tags", $entry_tags);

	$entryModel = ModelFactory::build("entry");
	$entry = $entryModel->get_content( $params );
	$entryviewView->assign("entry", $entry);

	$ingredientModel = ModelFactory::build("ingredient");
	$ingredients = $ingredientModel->getEntryIngredients($entry_id);
	$entryviewView->assign("ingredients", $ingredients);

	$pageView->assign("content", $entryviewView->fetch() );

        // Display Page
	$pageView->display();
    }
    /**
     * PAGE: entry/edit
     * This method handles what happens when you move to http://yourproject/entry/edit/ID
     */
    public function edit( $params )
    {
	$entry_id = Util::GetAttribute( $params, 0, "0");

	$pageView     = ViewFactory::build("edit.page");

	$leftmenuView = ViewFactory::build("left_menu.part");
	$tagModel = ModelFactory::build("tag");
	$leftmenuView->assign("tags", $tagModel->getTags() );
	$pageView->assign("left_menu", $leftmenuView->fetch() );

	$entryviewView = ViewFactory::build("entry_edit.part");
	
	$entry_tags = $tagModel->getEntryTags($entry_id);
	$entryviewView->assign("entry_tags", $entry_tags);

	$entryModel = ModelFactory::build("entry");
	$entry = $entryModel->get_content( $params );
	$entryviewView->assign("entry", $entry);

	$ingredientModel = ModelFactory::build("ingredient");
	$ingredients = $ingredientModel->getEntryIngredients($entry_id);
	$entryviewView->assign("ingredients", $ingredients);
	

	$pageView->assign("content", $entryviewView->fetch() );

        // Display Page
	$pageView->display();
    }    
    /**
     * PAGE: entry/save
     * This method handles what happens when you move to http://yourproject/entry/save/ID
     */
    public function save( $params )
    {
	$result = 0;
	$entry_id   = Util::GetAttribute( $_POST, "entry_id",   0  );
	$entry_name = Util::GetAttribute( $_POST, "entry_name", '' );
	$entry_text = Util::GetAttribute( $_POST, "entry_text", '' );

	$entry_id   = filter_var ( $entry_id  , FILTER_VALIDATE_INT );
	//$entry_name = filter_var ( $entry_name, FILTER_SANITIZE_SPECIAL_CHARS );
	//$entry_text = filter_var ( $entry_text, FILTER_SANITIZE_SPECIAL_CHARS );

	if ( (false !== $entry_id) && (false !== $entry_name) && (false !== $entry_text) ) {
		$entryModel = ModelFactory::build("entry");
		$result = $entryModel->updateEntry($entry_id, $entry_name, $entry_text);
	}
	print($result);
    }    

    /**
     * PAGE: entry/edittag
     * This method handles what happens when you move to http://yourproject/entry/edittags/ID
     */
    public function edittags( $params )
    {
	$entry_id = Util::GetAttribute( $params, 0, "0");

	$pageView     = ViewFactory::build("edit.page");

	$leftmenuView = ViewFactory::build("left_menu.part");
	$tagModel = ModelFactory::build("tag");
	$leftmenuView->assign("tags", $tagModel->getTags() );
	$pageView->assign("left_menu", $leftmenuView->fetch() );

	$entryviewView = ViewFactory::build("entry_edit.part");
	
	$entry_tags = $tagModel->getEntryTags($entry_id);
	$entryviewView->assign("entry_tags", $entry_tags);

	$entryModel = ModelFactory::build("entry");
	$entry = $entryModel->get_content( $params );
	$entryviewView->assign("entry", $entry);

	$ingredientModel = ModelFactory::build("ingredient");
	$ingredients = $ingredientModel->getEntryIngredients($entry_id);
	$entryviewView->assign("ingredients", $ingredients);
	

	$pageView->assign("content", $entryviewView->fetch() );

        // Display Page
	$pageView->display();
    }    
 
}