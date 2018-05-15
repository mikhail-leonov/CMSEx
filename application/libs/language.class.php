<?php
/**
 * Include section
 */
require_once(LIB . 'config.class.php');

/**
 * Language Class
 */
class Language
{
    public $cfg = null;
    /**
     * Load appropriate language file
     * 
     * @return void
     */
    public function __construct($lang)
    {
        $cfgFileName = LANGUAGE . $lang . ".lang";
        if (file_exists($cfgFileName)) {
            $this->cfg = new Config($cfgFileName);
        }
    }
}
