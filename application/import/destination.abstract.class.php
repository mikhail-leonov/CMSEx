<?php

/**
 * Require Abstractfactory
 */
require_once( LIB . 'abstractobject.class.php' );


/**
 * This is the "Abstract Destination data source class". 
 */
abstract class AbstractDestination extends AbstractObject
{
	public abstract function put($data, $keys, $settings);
}

