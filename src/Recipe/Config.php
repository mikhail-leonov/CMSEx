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
    /// Config class
    /// </summary>
    class Config
    {
        /// <summary>
        /// Config file name
        /// </summary>
        public $fileName = "";

        /// <summary>
        /// Vars
        /// </summary>
        public $vars = [];

        /// <summary>
        /// Constructor
        /// </summary>
        public function __construct(string $fileName = "config.cfg")
        {
            if (empty($fileName)) {
                $this->fileName = defined("CONFIG") ? CONFIG : $fileName;
            } else {
                if (file_exists($fileName)) {
                    $this->fileName = $fileName;
                }
            }
            if (file_exists($this->fileName)) {
                $this->vars = parse_ini_file($this->fileName, true);
            }
        }

        /// <summary>
        /// Destructor
        /// </summary>
        public function __destruct()
        {
            unset($this->vars);
        }
        
        /// <summary>
        /// Get value
        /// </summary>
        public function Get($section, $key, $default = null, $replaces = null)
        {
            $result = $this->GetRaw($section, $key, $default);
            $result = $this->HandleVariables($result, $replaces);
            return \Recipe\Util::Get($result, $default) ;
        }
        
        /// <summary>
        /// Get value
        /// </summary>
        public function GetRaw($section, $key, $default = null)
        {
            $result = null;
            if (array_key_exists($section, $this->vars)) {
                if (array_key_exists($key, $this->vars[ $section ])) {
                    $result = $this->vars[ $section ][ $key ];
                }
            }
            return \Recipe\Util::Get($result, $default) ;
        }
        
        /// <summary>
        /// Set value
        /// </summary>
        public function Set($section, $key, $value)
        {
            $this->vars[ $section ][ $key ] = $value;
            $this->Save();
        }

        /// <summary>
        /// Save config content
        /// </summary>
        public function Save()
        {
            $content = "";
            foreach ($this->vars as $key => $elem) {
                $content .= "[".$key."]\n";
                foreach ($elem as $key2 => $elem2) {
                    $content .= $key2." = \"".$elem2."\"\n";
                }
                $content .= "\n";
            }
            if (!$handle = @fopen($this->fileName, 'w')) {
                error_log("Config::Save() - Could not open file('".$this->fileName."') for writing, error.");
            }
            if (!fwrite($handle, $content)) {
                error_log("Config::Save() - Could not write to open file('" . $this->fileName ."'), error.");
            }
            fclose($handle);
        }

        /// <summary>
        /// Enum all sections
        /// </summary>
        public function GetSections()
        {
            return array_keys($this->vars);
        }

        /// <summary>
        /// Enum all vars in the section
        /// </summary>
        public function GetKeys($section)
        {
            $result = [];
            $tmpArray = \Recipe\Util::GetAttribute($this->vars, $section, []);
            foreach ($tmpArray as $key => $value) {
                $newValue = $this->Get($section, $key, "");
                $result[ $key ] = $newValue;
            }
            return $result;
        }

        /// <summary>
        /// Enum all vars in the section
        /// </summary>
        public function GetRawKeys($section)
        {
            $result = [];
            $tmpArray = \Recipe\Util::GetAttribute($this->vars, $section, []);
            foreach ($tmpArray as $key => $value) {
                $newValue = $this->GetRaw($section, $key, "");
                $result[ $key ] = $newValue;
            }
            return $result;
        }

        /// <summary>
        /// Enum all vars in all sections
        /// </summary>
        public function GetAll()
        {
            $result = [];
            foreach ($this->vars as $key => $section) {
                $result[ $key ] = $this->GetKeys($key);
            }
            return $result;
        }

        /// <summary>
        /// Enum all vars in all sections
        /// </summary>
        public function GetRawAll()
        {
            $result = [];
            foreach ($this->vars as $key => $section) {
                $result[ $key ] = $this->GetRawKeys($key);
            }
            return $result;
        }
        
        /// <summary>
        /// Set variables identifiers to their values
        /// </summary>
        public function HandleVariables($value, $replaces)
        {
            $result = $value;
            if (!is_array($result)) {
                if (preg_match_all("/%%([A-Z0-9_:]+)%%/", $result, $match) !== false) {
                    if (is_array($match) && is_array($match[0])) {
                        foreach ($match[0] as $k => $v) {
                            $var = str_replace("%%", "", $v);
                            $var = strtolower($var);
                            list($section, $key) = explode(":", $var);
                        
                            $varValue = null;
                            if ($section == "var") {
                                if (array_key_exists($key, $replaces)) {
                                    $varValue = $replaces[$key];
                                }
                            }
                            if (!isset($varValue)) {
                                $varValue = $this->Get($section, $key, "");
                            }
                            $result = str_replace($v, $varValue, $result);
                        }
                    }
                }
            }
            return $result;
        }
    }
