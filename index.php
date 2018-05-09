<?php

/**
 * A recipe manager
 *
 * @package recipe
 * @author mikhail-leonov
 * @link https://github.com/mikhail-leonov/recipe/
 * @license http://opensource.org/licenses/MIT MIT License
 */



/**
 *
 * Define section
 *
 */
define( "DS", DIRECTORY_SEPARATOR );

define( "ROOT", dirname(__FILE__) . DS );
define( "APP", ROOT . "application" . DS );

define( "IMPORT", APP . "import" . DS );
define( "RULES", IMPORT . "rules" . DS );

define( "CONFIG",  APP  . "config" . DS );
define( "LIB",  APP . "libs" . DS );
define( "TEMP",  APP . "temp" . DS );

define( "MODEL",  APP . "model" . DS );
define( "CONTROLLER", APP . "controller" . DS ); 
define( "VIEW", APP . "view" . DS ); 
define( "FACTORY", APP . "factory" . DS ); 

define( "EXTLIB",  APP . "extlib" . DS );
define( "SMARTY",  EXTLIB . "smarty" . DS );



/**
 *
 * Production/Dev Settings
 *
 */
define('DEBUG', true); 
error_reporting(E_ALL); 

if(DEBUG == true) {
    error_reporting(E_ALL); 
} else {
    error_reporting(0); 
}


/**
 *
 * Load section
 *
 */
require_once( CONFIG . 'config.php' );
require_once( LIB . 'application.class.php' );

/**
 *
 * App start section
 *
 */
$app = new Application();
