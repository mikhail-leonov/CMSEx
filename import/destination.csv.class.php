<?php

/**
 * Require AbstractDestination
 */
require_once(IMPORT . 'destination.abstract.class.php');

/**
 * This is the "CSV Destination data source class".
 */
class CsvDestination extends AbstractDestination
{
    public function put($data, $keys, $settings)
    {
    }
}
