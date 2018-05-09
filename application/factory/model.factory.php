<?php


/**
 * Require Abstractfactory
 */
require_once( FACTORY . 'abstract.factory.php' );


/**
 * This is the "Model factory class". 
 */
class ModelFactory extends AbstractFactory
{
    /**
     * Method to build an Model object of $name type
     */
    public static function build($name) {
	$modelFileName = MODEL . strtolower($name) . '.model.php';
	if ( file_exists($modelFileName)) {
	    require_once($modelFileName);
	    $model_name = $name . "Model";
            return new $model_name();
	}
	throw new Exception("Model [{$model_name}] file is not found: {$modelFileName}.");
    }
}
