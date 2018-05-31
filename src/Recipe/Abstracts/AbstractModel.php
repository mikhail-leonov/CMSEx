<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */
 
namespace Recipe\Abstracts;

use \Recipe\Utils\Db;
use \Klein\DataCollection\DataCollection;
use \Recipe\Interfaces\ModelInterface;

/**
 * This is the "Base model class". All other "real" models extend this class.
 */
class AbstractModel implements ModelInterface
{
    /**
     * @var null Database Connection
     */
    public $db = null;
    /**
     * Whenever a model is created, we get the same database connection - i.e. DB Singelton.
     *
     * @return void
    */
    public function __construct()
    {
	$this->db = Db::GetInstance();
    }
    /**
     * GetSortOrder
     *
     * @var DataCollection $params parameters
     * @var string $field_name  Sort field
     * @var string $field_order Sort order 
     *
     * @return string  Sort order string for Query
    */
    public function GetSortOrder(DataCollection $params, string $field_name, string $field_order = 'ASC') : string
    {
        $result = "$field_name $field_order";
        if (isset($params)) {
            $sort_field = $params->get("sort_field", $field_name );
            $sort_order = $params->get("sort_order", $field_order);
            $sort_order = strtoupper($sort_order);
            $result = "$sort_field $sort_order";
        }; 
        return $result;
    }
    /**
     * GetQueryFields
     *
     * @var DataCollection $params parameters
     *
     * @return array  Fields to retrieve
    */
    public function GetQueryFields(DataCollection $params) : array
    {
        $result = [];
        if (isset($params)) {
            $fields = $params->get("fields", ""); 
            if ('' !== $fields) { 
                $fields = explode(",", $fields); 
            } else { 
                $fields = [];  
            } 
            $result = $fields;
        } 
        return $result;
    }
    /**
     * GetQueryLimit
     *
     * @var DataCollection $params parameters
     *
     * @return int  Result Rows limit 
    */
    public function GetQueryLimit(DataCollection $params) : int
    {
	$default = 99999;
        $limit = $default;
        if (isset($params)) {
	    $limit = $params->get("limit", $default);
	    $limit = intval($limit);
            if ($limit <= 0      ) { $limit = $default; }
            if ($limit > $default) { $limit = $default; }
        } 
	return $limit; 
    }
    /**
     * GetQueryOffset
     *
     * @var DataCollection $params parameters
     *
     * @return int  Result Rows limit 
    */
    public function GetQueryOffset(DataCollection $params) : int
    {
        $offset = 0;
        if (isset($params)) {
	    $offset = $params->get("offset", 0);
            $offset = intval($offset);
            if ($offset <= 0) { $offset = 0; }
        } 
	return $offset; 
    }
}
