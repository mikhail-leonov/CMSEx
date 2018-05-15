<?php
    /// <summary>
    /// Include section
    /// </summary>
    require_once(LIB . 'util.class.php');
    
    /// <summary>
    /// FileSystem class
    /// </summary>
    class FS
    {
        /// <summary>
        /// Strip root dir from dir list
        /// </summary>
        public static function StripRootDir($list, $root)
        {
            $result = array();
            foreach ($list as $k => $v) {
                $result[] = str_replace($root, "", $v);
            }
            return $result;
        }

        /// <summary>
        /// Strip file exstention from dir list
        /// </summary>
        public static function StripFileExt($list)
        {
            $result = array();
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
        public static function AddItem(&$arr, $item)
        {
            if (is_array($arr)) {
                array_push($arr, $item);
            }
        }
    }

    /// <summary>
    /// Directory enumeration class
    /// </summary>
    class Dirs extends FS
    {
        /// <summary>
        /// List dir (one level)
        /// </summary>
        public static function Enumerate($base)
        {
            return self::_Execute($base, "AddItem", 0);
        }

        /// <summary>
        /// List dir (recursive)
        /// </summary>
        public static function EnumerateEx($base)
        {
            return self::_Execute($base, "AddItem", 1);
        }

        /// <summary>
        /// Exec function for each dir (recursive)
        /// </summary>
        private static function _Execute($base, $function, $recursive = 1)
        {
            $dirlist = array();
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

    /// <summary>
    /// Files enumeration class
    /// </summary>
    class Files extends FS
    {
        /// <summary>
        /// List files (one level)
        /// </summary>
        public static function Enumerate($base)
        {
            return self::_Execute($base, "AddItem", 0);
        }

        /// <summary>
        /// List files (recursive)
        /// </summary>
        public static function EnumerateEx($base)
        {
            return self::_Execute($base, "AddItem", 1);
        }

        /// <summary>
        /// Exec function for each file (recursive)
        /// </summary>
        private static function _Execute($base, $function, $recursive = 1)
        {
            $filelist = array();
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
