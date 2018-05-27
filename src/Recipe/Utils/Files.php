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
 * File enumeration class
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Files extends FS
{
    /**
     * Enumerate all files (one level) without going deeper
     *
     * @var string $base Directory to be processed
     *
     * @return array return all found files on this level
     */
    public static function Enumerate(string $base) : array
    {
        return self::_Execute($base, "AddItem", 0);
    }
    /**
     * Enumerate all files and all subfiles
     *
     * @var string $base Directory to be processed
     *
     * @return array return all found files and all subfiles
     */
    public static function EnumerateEx(string $base) : array
    {
        return self::_Execute($base, "AddItem", 1);
    }
    /**
     * Enumerate function for file processing
     *
     * @var string $base Directory to be processed
     *
     * @var string $function Function to be called for item processing
     *
     * @var int $recursive 1|0 
     *
     * @return array return all found (0) files and (1) all subfiles
     */
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
