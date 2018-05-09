<?php

/**
 * Require Abstractfactory
 */
require_once( LIB . 'abstractobject.class.php' );

/**
 * This is the "Abstract Destination data source class". 
 */
abstract class AbstractSource extends AbstractObject
{
	public abstract function get($settings);
}

