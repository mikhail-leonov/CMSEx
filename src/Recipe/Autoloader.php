<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

class Recipe_Autoloader
{
   /**
     * Filepath to Recipe root
     *
     * @var string
     */
    public static $RECIPE_DIR = null;

    /**
     * Registers Recipe_Autoloader as an SPL autoloader.
     *
     * @param bool $prepend Whether to prepend the autoloader or not.
     */
    public static function register($prepend = false)
    {
        self::$RECIPE_DIR = defined('RECIPE_DIR') ? RECIPE_DIR : dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;

        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            spl_autoload_register(array(__CLASS__, 'autoload'), true, $prepend);
        } else {
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }
    }

    /**
     * Handles auto loading of classes.
     *
     * @param string $class A class name.
     */
    public static function autoload($class)
    {
        $file = self::$RECIPE_DIR . strtolower($class) . ".php";
        if (is_file($file)) {
           include $file;
        }
        return;
    }
}
