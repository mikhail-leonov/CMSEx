<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

// Set some configuration values
ini_set('session.use_cookies', 0);      // Don't send headers when testing sessions
ini_set('session.cache_limiter', '');   // Don't send cache headers when testing sessions

// Load our autoloader, and add our Test class namespace
$autoloader = require(__DIR__ . '/../vendor/autoload.php');
$autoloader->add('Recipe\Tests', __DIR__);

// Load our functions bootstrap
require(__DIR__ . '/functions-bootstrap.php');
