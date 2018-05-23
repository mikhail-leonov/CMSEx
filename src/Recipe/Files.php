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
    /// Files enumeration class
    /// </summary>
    class Files extends FS
    {
        /// <summary>
        /// List files (one level)
        /// </summary>
        public static function Enumerate(string $base) : array
        {
            return self::_Execute($base, "AddItem", 0);
        }

        /// <summary>
        /// List files (recursive)
        /// </summary>
        public static function EnumerateEx(string $base) : array
        {
            return self::_Execute($base, "AddItem", 1);
        }

        /// <summary>
        /// Exec function for each file (recursive)
        /// </summary>
        private static function _Execute(string $base, string $function, int $recursive = 1) : array
        {
            $filelist = [];
            $base = Util::RSlash($base);
            if (is_dir($base)) {
                $dh = opendir($base);
                while (false !== ($dir = readdir($dh))) {
                    if (($dir !== '.') && ($dir !== '..')) {
                        $subbase = $base . $dir;
                        if (is_dir($subbase)) {
                            if ($recursive === 1) {
                                $sublist = Files::_Execute($subbase, $function, $recursive);
                                foreach ($sublist as $k => $sub) {
                                    self::$function($filelist, $sub);
                                }
                            }
                        } else {
                            self::$function($filelist, $subbase);
                        }
                    }
                }
                closedir($dh);
            }
            return $filelist;
        }
    }
