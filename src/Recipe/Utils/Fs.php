<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Utils;

/**
 * FileSystem class
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Fs
{
    /**
     * Strip out root dir from dir list
     *
     * @var array $arr Array of items
     *
     * @var string $root Root path to be removed from each $arr element
     *
     * @return array Array of stripped out items
     */
    public static function StripRootDir(array $arr, string $root) : array
    {
        $result = [];
        foreach ($arr as $k => $v) {
            $result[] = str_replace($root, "", $v);
        }
        return $result;
    }
    /**
     * Strip out file exstention from dir list
     *
     * @var array $arr Array of items
     *
     * @return array Array of stripped out items
     */
    public static function StripFileExt(array $arr) : array
    {
        $result = [];
        foreach ($arr as $k => $v) {
            $parts = explode(".", $v);
            unset($parts[ count($parts) - 1 ]);
            $result[] = implode(".", $parts);
        }
        return $result;
    }
    /**
     * Add Directory Item $item to $arr array
     *
     * @var array $arr Array of items
     *
     * @var array $arr Array of items
     *
     * @return void
     */
    public static function AddItem(array &$arr, string $item)
    {
        if (is_array($arr)) {
            array_push($arr, $item);
        }
    }
}

