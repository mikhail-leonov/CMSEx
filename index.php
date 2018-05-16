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
require_once('index.const');


/**
 *
 * Production/Dev Settings
 *
 */
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
