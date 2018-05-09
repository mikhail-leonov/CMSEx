<?php


/**
 * Require Abstractfactory
 */
require_once( FACTORY . 'abstract.factory.php' );
require_once( VIEW . 'abstract.view.php' );

/**
 * This is the "View factory class". 
 */
class ViewFactory extends AbstractFactory
{
    /**
     * Method to build an Model object of $name type
     */
    public static function build($name) {
	if ( strpos( $name, ".page" ) !== false ) {
	    require_once( VIEW . 'page.view.php' );
	    return new PageView($name);
	}
	if ( strpos( $name, ".part" ) !== false ) {
	    require_once( VIEW . 'part.view.php' );
	    return new PartView($name);
	}
	throw new Exception("View [{$name}] file is not found.");
    }
}
