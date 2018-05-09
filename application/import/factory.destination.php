<?php

/**
 * Require Abstractfactory
 */
require_once( FACTORY . 'abstract.factory.php' );


/**
 * This is the "Destination data source factory class". 
 */
class DestinationFactory extends AbstractFactory
{
    /**
     * Method to build an Destination data source object of $name type
     */
    public static function build($name) {

	$destinationFileName = IMPORT . "destination." . strtolower($name) . '.class.php';
        $destination_name = ucfirst(strtolower($name)) . "Destination";

	if ( file_exists($destinationFileName)) {
	    require_once($destinationFileName);
            return new $destination_name();
	}
	throw new Exception("Destination [{$destination_name}] file is not found: {$destinationFileName}.");
    }
}

