<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

/*
 * Load and register Recipe Autoloader
 */
if (!class_exists('Recipe_Autoloader')) {
    require dirname(__FILE__) . '/Autoloader.php';
}
Recipe_Autoloader::register(true);
