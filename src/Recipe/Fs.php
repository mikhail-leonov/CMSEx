<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe;

    /// <summary>
    /// FileSystem class
    /// </summary>
    class Fs
    {
        /// <summary>
        /// Strip root dir from dir list
        /// </summary>
        public static function StripRootDir(array $list, string $root) : array
        {
            $result = [];
            foreach ($list as $k => $v) {
                $result[] = str_replace($root, "", $v);
            }
            return $result;
        }

        /// <summary>
        /// Strip file exstention from dir list
        /// </summary>
        public static function StripFileExt(array $list) : array
        {
            $result = [];
            foreach ($list as $k => $v) {
                $arr = explode(".", $v);
                unset($arr[ count($arr) - 1 ]);
                $result[] = implode(".", $arr);
            }
            return $result;
        }
        
        /// <summary>
        /// AddDir
        /// </summary>
        public static function AddItem(array &$arr, string $item)
        {
            if (is_array($arr)) {
                array_push($arr, $item);
            }
        }
    }

