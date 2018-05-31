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

use Klein\DataCollection\DataCollection;

    /// <summary>
    /// Utils class
    /// </summary>
    class Util
    {
        /**
         * Get PUT request parameters
         *
         * @return DataCollection PUT parameters as a Klein collection object
         */
        public static function paramsPut() : DataCollection
        {
            $result = new DataCollection();
            $put = []; parse_str(file_get_contents('php://input'), $put);
            foreach($put as $k => $v) {
                $result->set($k, $v);
            }
            return $result;
        }

        /**
         * Get DELETE request parameters
         *
         * @return DataCollection PUT parameters as a Klein collection object
         */
        public static function paramsDelete() : DataCollection
        {
            return new DataCollection();
        }
	
        /**
         * Get Table list for DB connection settings
         *
         * @return array DB connection settings as array
         */
        public static function getCFG($arr) : array
        {
            return [
            'host'  => Util::GetAttribute($arr, 'host', ""),
            'user'  => Util::GetAttribute($arr, 'user', ""),
            'pass'  => Util::GetAttribute($arr, 'pass', ""),
            'name'  => Util::GetAttribute($arr, 'name', ""),
            'code'  => Util::GetAttribute($arr, 'code', ""),
            'table' => Util::GetAttribute($arr, 'table', "")
        ];
        }

        public static function obj2arr($obj)
        {
            $array = (array) $obj;
            foreach ($array as &$attribute) {
                if (is_object($attribute)) {
                    $attribute = self::obj2arr($attribute);
                }
            }
            return $array;
        }
        /// <summary>
        /// FindEntries
        /// </summary>
        public static function FindTag($obj, $part, &$arr)
        {
            $result = 0;
            $founds = $obj->db->from("tags")->where("tag_name LIKE '%$part%'")->fetchAll();
            if (is_array($founds)) {
                foreach($founds as $k => $found) {
                    $arr[ $found['tag_id'] ] = $found;
                    $result = 1;
                }  
            }
            $founds = $obj->db->from("tags")->where("tag_text LIKE '%$part%'")->fetchAll();
            if (is_array($founds)) {
                foreach($founds as $k => $found) {
                    $arr[ $found['tag_id'] ] = $found;
                    $result = 1;
                } 
            }
            return $result;
        }
        /// <summary>
        /// FindEntries
        /// </summary>
        public static function possibleWord($part)
        {
            $result = 1;
            if (mb_strlen($part) < 3) {
                $result = 0;
            }
            if (is_int($part)) {
                $result = 0;
            }
            return $result;
        }

        /// <summary>
        /// FindEntries
        /// </summary>
        public static function FindTags($obj, $text)
        {
            $arr = [];
            $result = 0;

            if (!empty($text)) {
                $parts = self::explodeEx(["\n", " ", ","], $text);
                foreach ($parts as $k => $part) {
                    $part = trim($part);
                    if ('' !==  $part) {
                        if (self::possibleWord($part)) {
                            if (self::FindTag($obj, $part, $arr)) {
                                $result = 1;
                            }
                            if (mb_strlen($part) >= 4) {
                                $part = mb_substr($part, 0, -1);
                                if (self::FindTag($obj, $part, $arr)) {
                                    $result = 1;
                                }
                            }
                            if (mb_strlen($part) >= 4) {
                                $part = mb_substr($part, 0, -1);
                                if (self::FindTag($obj, $part, $arr)) {
                                    $result = 1;
                                }
                            }
                            if (mb_strlen($part) >= 4) {
                                $part = mb_substr($part, 0, -1);
                                if (self::FindTag($obj, $part, $arr)) {
                                    $result = 1;
                                }
                            }
                            if (mb_strlen($part) >= 4) {
                                $part = mb_substr($part, 0, -1);
                                if (self::FindTag($obj, $part, $arr)) {
                                    $result = 1;
                                }
                            }
                        }
                    }
                }
            }
            return [ 'result' => $result, 'data' => $arr ];
        }

        public function mb_ucfirst($str)
        {
            $fc = mb_strtoupper(mb_substr($str, 0, 1));
            return $fc.mb_substr($str, 1);
        }

        /// <summary>
        /// Find Tags By Id
        /// </summary>
        public static function FindTagsById($obj, $ids)
        {
            $arr = [];
            $result = 0;

            if (!empty($ids)) {
                foreach ($ids as $k => $id) {
                    $id = trim($id);
                    if ('' !==  $id) {
                        $where = [ "tag_id" => $id ];
                        $founds = $obj->db->from("tags")->where("tag_id", $id)->fetchAll();
                        if (is_array($founds)) {
                            foreach($founds as $k => $found) {
                                $arr[ $found['tag_id'] ] = $found;
                                $result = 1;
                            } 
                        }
                    }
                }
            }
            return [ 'result' => $result, 'data' => $arr ];
        }

        /// <summary>
        /// Arr To xml Cnvertor
        /// </summary>
        public static function arr2xml($data, &$xml_data)
        {
            foreach ($data as $key => $value) {
                if (is_numeric($key)) {
                    $key = 'item'.$key; //dealing with <0/>..<n/> issues
                }
                if (is_array($value)) {
                    $subnode = $xml_data->addChild($key);
                    self::arr2xml($value, $subnode);
                } else {
                    $node->appendChild($no->createCDATASection($cdata_text));

                    $n = $xml_data->AddChild("$key");
                    $n->addCData(htmlspecialchars("$value"));
                }
            }
        }
        /// <summary>
        /// Dump
        /// </summary>
        public static function Dump($obj)
        {
            print("<pre>");
            var_dump($obj);
            print("</pre>");
        }

        /// <summary>
        /// Get Widget Content
        /// </summary>
        public static function GetAlreadySelected($name)
        {
            $result = [];
            $elements = Util::GetAttribute($_COOKIE, $name, []);
            foreach ($elements as $elements_id => $elements_title) {
                $result[] = [ "tag_id" => $elements_id, "tag_name" => $elements_title ];
            }
            return $result;
        }

        /// <summary>
        /// Explode Array
        /// </summary>
        public static function explodeEx($delimiters, $string)
        {
            $ready = str_replace($delimiters, $delimiters[0], $string);
            return explode($delimiters[0], $ready);
        }

        /// <summary>
        /// FilterSelectedTags
        /// </summary>
        public static function FilterSelectedTags($selected, $tags)
        {
            $result = [];
            foreach ($tags as $k => $tag) {
                if (!Util::IsTagSelected($selected, $tag)) {
                    $result[] = $tag;
                }
            }
            return $result;
        }
        /// <summary>
        /// IsTagSelected
        /// </summary>
        public static function IsTagSelected($selected, $tag)
        {
            $result = false;
            $tid = Util::GetAttribute($tag, 'tag_id', "");
            foreach ($selected as $key => $current) {
                $cid = Util::GetAttribute($current, 'tag_id', "");
                if ("$tid" ===  "$cid") {
                    $result = true;
                    break;
                }
            }
            return $result;
        }
        /// <summary>
        /// Get value from $attributes by name or return default value
        /// </summary>
        public static function GetAttribute($attributes, $name, $def)
        {
            $result = $def;
            if (isset($attributes)) {
                if (array_key_exists($name, $attributes)) {
                    $result = $attributes[ $name ];
                }
            }
            return $result;
        }
        /// <summary>
        /// Get value from $attributes by name or return default value
        /// </summary>
        public static function Get($value, $def)
        {
            $result = $def; if (isset($value)) { $result = $value; } return $result;
        }

        /// <summary>
        /// Get value from $attributes by name nested @cdata or return default value
        /// </summary>
        public static function GetCData($value, $name, $def)
        {
            $sub = Util::GetAttribute($value, $name, []);
            return Util::GetAttribute($sub, '@cdata', $def);
        }
        
        /// <summary>
        /// Drop mem cached data or not
        /// </summary>
        public static function IsReset()
        {
            $r = Util::GetAttribute($_GET, 'reset', 0);
            return ("{$r}" === "1");
        }
    
        /// <summary>
        /// Add left and right slash
        /// </summary>
        public static function Slash($url)
        {
            $result = $url;
            $result = Util::LSlash($result);
            $result = Util::RSlash($result);
            return $result;
        }
        
        /// <summary>
        /// Del left and right slash
        /// </summary>
        public static function UnSlash($url)
        {
            $result = $url;
            $result = Util::UnLSlash($result);
            $result = Util::UnRSlash($result);
            return $result;
        }
        
        /// <summary>
        /// Add left slash
        /// </summary>
        public static function LSlash($url)
        {
            $result = $url;
            if (substr($result, 0, 1) !== DIRECTORY_SEPARATOR) {
                $result = DIRECTORY_SEPARATOR . $result;
            }
            return $result;
        }
        
        /// <summary>
        /// Del left slash
        /// </summary>
        public static function UnLSlash($url)
        {
            $result = $url;
            if (substr($result, 0, 1) === DIRECTORY_SEPARATOR) {
                $result = substr($result, 1, strlen($result) - 1);
            }
            return $result;
        }
        
        /// <summary>
        /// Add right slash
        /// </summary>
        public static function RSlash($url)
        {
            $result = $url;
            if (substr($result, -1) !== DIRECTORY_SEPARATOR) {
                $result = $result . DIRECTORY_SEPARATOR ;
            }
            return $result;
        }
        
        /// <summary>
        /// Del right slash
        /// </summary>
        public static function UnRSlash($url)
        {
            $result = $url;
            if (substr($result, -1) === DIRECTORY_SEPARATOR) {
                $result = substr($result, 0, strlen($result) - 1);
            }
            return $result;
        }

        /// <summary>
        /// Encode HTML Entity
        /// </summary>
        public static function encodeHTMLEntity($text)
        {
            return htmlspecialchars($text, ENT_QUOTES);
        }
    }
