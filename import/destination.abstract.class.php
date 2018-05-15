<?php

/**
 * Require Abstractfactory
 */
require_once(LIB . 'abstractobject.class.php');

/**
 * This is the "Destination interface".
 */
interface IDestination
{
    public function put($data, $keys, $settings);
}

/**
 * This is the "Abstract Destination data source class".
 */
abstract class AbstractDestination extends AbstractObject implements IDestination
{
    abstract public function put($data, $keys, $settings);
}
