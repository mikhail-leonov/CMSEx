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
    /// Directory enumeration class
    /// </summary>
    class Dirs extends FS
    {
        /// <summary>
        /// List dir (one level)
        /// </summary>
        public static function Enumerate(string $base) : array
        {
            return self::_Execute($base, "AddItem", 0);
        }

        /// <summary>
        /// List dir (recursive)
        /// </summary>
        public static function EnumerateEx(string $base) : array
        {
            return self::_Execute($base, "AddItem", 1);
        }

        /// <summary>
        /// Exec function for each dir (recursive)
        /// </summary>
        private static function _Execute(string $base, string $function, int $recursive = 1) : array
        {
            $dirlist = [];
            if (is_dir($base)) {
                $dh = opendir($base);
                $base = Util::RSlash($base);
                while (false !== ($dir = readdir($dh))) {
                    if (($dir !== '.') && ($dir !== '..')) {
                        $subbase = $base . $dir;
                        if (is_dir($subbase)) {
                            self::$function($dirlist, $subbase);
                            if ($recursive === 1) {
                                $subdirlist = Dirs::_Execute($subbase, $function, $recursive);
                                foreach ($subdirlist as $k => $sub) {
                                    self::$function($dirlist, $sub);
                                }
                            }
                        }
                    }
                }
                closedir($dh);
            }
            return $dirlist;
        }
    }
