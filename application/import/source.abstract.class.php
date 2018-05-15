<?php

/**
 * Require Abstractfactory
 */
require_once(LIB . 'abstractobject.class.php');

/**
 * This is the "Source interface".
 */
interface ISource
{
    public function get($settings);
}

/**
 * This is the "Abstract Destination data source class".
 */
abstract class AbstractSource extends AbstractObject implements ISource
{
    abstract public function get($settings);
}
