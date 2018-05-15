<?php

/**
 * Include section
 */
require_once(LIB . 'config.class.php');

class Language
{
    public $cfg = null;
    /**
     * Load appropriate language file
     */
    public function __construct($lang)
    {
        $cfgFileName = LANGUAGE . $lang . ".lang";
        if (file_exists($cfgFileName)) {
            $this->cfg = new Config($cfgFileName);
        }
    }
}
