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
 * Directory enumeration class
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Dirs extends FS
{
    /**
     * Enumerate all directories (one level) without going deeper
     *
     * @var string $base Directory to be processed
     *
     * @return array return all found directories on this level
     */
    public static function Enumerate(string $base) : array
    {
        return self::_Execute($base, "AddItem", 0);
    }
    /**
     * Enumerate all directories and all subdirectories
     *
     * @var string $base Directory to be processed
     *
     * @return array return all found directories and all subdirectories
     */
    public static function EnumerateEx(string $base) : array
    {
        return self::_Execute($base, "AddItem", 1);
    }
    /**
     * Enumerate function for dir processing
     *
     * @var string $base Directory to be processed
     *
     * @var string $function Function to be called for item processing
     *
     * @var int $recursive 1|0 
     *
     * @return array return all found (0) directories and (1) all subdirectories
     */
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
