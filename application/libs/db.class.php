<?php 
/**
 * Include section
 */
require_once(LIB . 'util.class.php');

final class DB
{
    /**
     * Call this method to get DB singleton instance
     */
    public static function instance()
    {
        static $instance = false;
        if ($instance === false) {
            $instance = new DB();
            $instance->connect($GLOBALS["dbcfg"]);
        }
        return $instance;
    }
    /**
     * Make constructor private, so nobody can call "new Class".
     */
    private function __construct()
    {
    }
    /**
     * Make clone magic method private, so nobody can clone instance.
     */
    private function __clone()
    {
    }
    /**
     * Make sleep magic method private, so nobody can serialize instance.
     */
    private function __sleep()
    {
    }
    /**
     * Make wakeup magic method private, so nobody can unserialize instance.
     */
    private function __wakeup()
    {
    }

    /**
     * Internal variables
     */
    private $query;
    private $cache;
    private $sqlQuery;
    private $map;
    private $table;
    private $field;
    private $where;
    private $group;
    private $order;
    private $limit;
    private $distinct;
    private $dbh;
    private $stmt;

    /**
     * pdo connect to mysql
     */
    public function connect($cfg)
    {
        $host = $cfg['host'];
        $name = $cfg['name'];
        $user = $cfg['user'];
        $pass = $cfg['pass'];
        $char = "utf8";
        if (isset($cfg['char'])) {
            $char = $cfg['char'];
        }
        $dsn = "mysql:host={$host};dbname={$name};charset={$char}";
        $options = array( PDO::ATTR_PERSISTENT => true );
        $this->dbh = new PDO($dsn, $user, $pass, $options);
    }
    /**
         * Escape parameter
      	 */
    public function Escape($value)
    {
        return $this->dbh->quote($value);
    }






    /**
         * Entry step functions
      	 */






    
    /**
         * Set internal query directly from sql OR Exit point - return SQL query string
      	 */
    public function sql($sql = "")
    {
        if ($sql !== "") {
            $this->clean();
            $this->sqlQuery = $sql;
            return $this;
        } else {
            $this->build();
            return $this->sqlQuery;
        }
    }
    /**
         * Entry point for Select query
      	 */
    public function select($field)
    {
        $this->clean();
        $this->field($field);
        $this->query = "SELECT";
        return $this;
    }
    /**
         * Entry point for Insert query
      	 */
    public function insert($field)
    {
        $this->clean();
        $this->field($field);
        $this->query = "INSERT";
        return $this;
    }
    /**
         * Entry point for Update query
      	 */
    public function update($field)
    {
        $this->clean();
        $this->field($field);
        $this->query = "UPDATE";
        return $this;
    }
    /**
         * Entry point for Replace query
     * Testing REQURED
     */
    public function replace($field)
    {
        $this->clean();
        $this->field($field);
        $this->query = "REPLACE";
        return $this;
    }
    /**
         * Entry point for Delete query
      	 */
    public function delete($field)
    {
        $this->clean();
        $this->field($field);
        $this->query = "DELETE";
        return $this;
    }







    /**
         * Middle step functions
      	 */








    /**
         * Middle step fill table variable
      	 */
    public function from($table)
    {
        $this->table = $table;
        return $this;
    }
    /**
         * Middle step fill table variable
      	 */
    public function into($table)
    {
        $this->table = $table;
        return $this;
    }
    /**
         * Middle step fill mapping variable
     * Testing REQURED
     */
    public function map($key)
    {
        $this->map = $key;
        return $this;
    }
    /**
         * Middle step fill cache variable
     * Testing REQURED
     */
    public function cache($val)
    {
        $this->cache = ($val === 1);
        return $this;
    }
    /**
         * Middle step fill field variable
      	 */
    public function field($field)
    {
        $this->field = $this->assign($this->field, $field);
        return $this;
    }
    /**
         * Middle step fill order variable
      	 */
    public function order($order)
    {
        $this->order = $this->assign($this->order, $order);
        return $this;
    }
    /**
         * Middle step fill group variable
      	 */
    public function group($group)
    {
        $this->group = $this->assign($this->group, $group);
        return $this;
    }
    /**
         * Middle step fill where variable
      	 */
    public function where($where)
    {
        $this->where = $this->assign($this->where, $where);
        return $this;
    }
    /**
         * Middle step fill limit variable
      	 */
    public function limit($limit1, $limit2)
    {
        $this->limit = array( $limit1, $limit2 );
        return $this;
    }
    /**
         * Middle step fill distinct variable
      	 */
    public function distinct()
    {
        $this->distinct = "DISTINCT";
        return $this;
    }
    /**
         * Middle step bing query variables
     * Testing REQURED
     */
    public function bind($pos, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                   $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($pos, $value, $type);
        return $this;
    }
    /**
         * Middle step - NO exec query, Log built sql
      	 */
    public function log()
    {
        $this->build();
        error_log($this->sqlQuery);
        return $this;
    }
    /**
         * Middle step - NO exec query, print built sql
      	 */
    public function print()
    {
        $this->build();
        print($this->sqlQuery . "\n");
        return $this;
    }






    /**
         * Internal functions
      	 */







    /**
         * Clean all internal store variables
      	 */
    private function clean()
    {
        $this->map = null;
        $this->cache = false;
        $this->sqlQuery = "";
        $this->query = "";
        $this->table = "";
        $this->field = array();
        $this->where = array();
        $this->group = array();
        $this->order = array();
        $this->limit = array();
        $this->distinct = "";
    }
    /**
         * Internal assign function to be used in prop assigning
      	 */
    private function assign($arr, $val)
    {
        if (is_array($val)) {
            $arr = array_merge($arr, $val);
        } else {
            $arr[] = $val;
        }
        return $arr;
    }
    /**
         * Internal function for building appropriate query
      	 */
    private function build()
    {
        $result = "";
        if ($this->query == "SELECT") {
            $result = $this->buildSelect();
        }
        if ($this->query == "INSERT") {
            $result = $this->buildInsert();
        }
        if ($this->query == "UPDATE") {
            $result = $this->buildUpdate();
        }
        if ($this->query == "REPLACE") {
            $result = $this->buildReplace();
        }
        if ($this->query == "DELETE") {
            $result = $this->buildDelete();
        }
        if ($this->query == "COUNT") {
            $result = $this->buildCount() ;
        }
        if (trim($result) !== "") {
            $this->sqlQuery = trim($result);
        }
    }
    /**
         * Internal function for building SELECT query
      	 */
    private function buildSelect()
    {
        $fields   = trim($this->buildSelectFields());
        $distinct = trim($this->buildDistinct());
        $where    = trim($this->buildWhere());
        $order    = trim($this->buildOrder());
        $group    = trim($this->buildGroup());
        $limit    = trim($this->buildLimit());
        return "SELECT {$distinct} {$fields} FROM `{$this->table}` {$where} {$group} {$order} {$limit}";
    }
    /**
         * Internal function for building UPDATE query
      	 */
    private function buildUpdate()
    {
        $fields   = trim($this->buildSetFields());
        $where    = trim($this->buildWhere());
        $order    = trim($this->buildOrder());
        return "UPDATE `{$this->table}` SET {$fields} {$where} {$order}";
    }
    /**
         * Internal function for building COUNT query
      	 */
    private function buildCount()
    {
        $where    = trim($this->buildWhere());
        return "SELECT SUM(1) as count FROM `{$this->table}` {$where}";
    }
    /**
         * Internal function for building INSERT query
      	 */
    private function buildInsert()
    {
        $fields   = trim($this->buildInsertFields());
        $values   = trim($this->buildInsertValues());
        $where    = trim($this->buildWhere());
        return "INSERT INTO `{$this->table}` ({$fields}) VALUES ({$values}) {$where}";
    }
    /**
         * Internal function for building REPLACE query
     * Testing REQURED
     */
    private function buildReplace()
    {
        $fields   = trim($this->buildInsertFields());
        $values   = trim($this->buildInsertValues());
        return "REPLACE INTO `{$this->table}` ({$fields}) VALUES ({$values})";
    }
    /**
         * Internal function for building DELETE query
      	 */
    private function buildDelete()
    {
        $where    = trim($this->buildWhere());
        return "DELETE FROM `{$this->table}` {$where}";
    }
    /**
         * Internal function for building SELECT query fields
      	 */
    private function buildSelectFields()
    {
        $result = "*";
        if (count($this->field) > 0) {
            $result = "";
            $splitter = "";
            foreach ($this->field as $k => $v) {
                $result = "{$result}{$splitter} {$v}";
                $splitter = ", ";
            }
            $result = trim($result);
        }
        return $result;
    }
    /**
         * Internal function for building INSERT query fields
      	 */
    private function buildInsertFields()
    {
        $result = "";
        $splitter = "";
        foreach ($this->field as $k => $v) {
            $result = "{$result}{$splitter} {$k}";
            $splitter = ", ";
        }
        return trim($result);
    }
    /**
         * Internal function for building INSERT query values
      	 */
    private function buildInsertValues()
    {
        $result = "";
        $splitter = "";
        foreach ($this->field as $k => $v) {
            if ('null' !== strtolower($v)) {
                $v = "'{$v}'";
            }
            $result = "{$result}{$splitter} {$v}";
            $splitter = ", ";
        }
        return trim($result);
    }
    /**
         * Internal function for building UPDATE query set fields
      	 */
    private function buildSetFields()
    {
        $result = "";
        $splitter = "";
        foreach ($this->field as $k => $v) {
            if ('null' !== strtolower($v)) {
                $v = "'{$v}'";
            }
            $result = "{$result}{$splitter} {$k} = {$v}";
            $splitter = ", ";
        }
        return trim($result);
    }
    /**
         * Internal function for building WHERE query condition
      	 */
    private function buildWhere()
    {
        $result = "";
        if (count($this->where) > 0) {
            $result = " WHERE";
            $splitter = "";
            foreach ($this->where as $k => $v) {
                $cond = "";
                if (!is_int($k)) {
                    $cond = "{$cond} {$k} = '{$v}'";
                } else {
                    $cond = "{$cond} {$v}";
                }
                $result = trim("{$result}{$splitter}{$cond}");
                $splitter = " AND ";
            }
        }
        return trim($result);
    }
    /**
         * Internal function for building DISTINCT query condition
      	 */
    private function buildDistinct()
    {
        return trim($this->distinct);
    }
    /**
         * Internal function for building ORDER BY query part
      	 */
    private function buildOrder()
    {
        $result = "";
        if (isset($this->order)) {
            if (count($this->order) > 0) {
                $result = " ORDER BY ";
                $splitter = "";
                foreach ($this->order as $k => $v) {
                    $result = "{$result}{$splitter} {$k} {$v}";
                    $splitter = ", ";
                }
            }
        }
        return trim($result);
    }
    /**
         * Internal function for mapping result
     * Optimization REQIUIRED
     * Testing REQURED
     */
    private function buildMap($rows)
    {
        $result = array();
        if (!isset($this->map)) {
            $result = $rows;
        } else {
            foreach ($rows as $key => $row) {
                $result [ $row[ $this->map ] ] = $row;
            }
        }
        return $result;
    }
    /**
         * Internal function for building GROUP BY query part
      	 */
    public function buildGroup()
    {
        $result = "";
        if (count($this->group) > 0) {
            $result = " GROUP BY ";
            $splitter = "";
            foreach ($this->group as $k => $v) {
                $result = "{$result}{$splitter} {$v}";
                $splitter = ", ";
            }
        }
        return trim($result);
    }
    /**
         * Internal function for building LIMIT query part
      	 */
    public function buildLimit()
    {
        $result = "";
        if (isset($this->limit)) {
            if (count($this->limit) > 0) {
                $result = " LIMIT ";
                $splitter = "";
                foreach ($this->limit as $k => $v) {
                    $result = "{$result}{$splitter} {$v}";
                    $splitter = ", ";
                }
            }
        }
        return trim($result);
    }






    /**
         * Exit points
      	 */





    

    /**
         * Exit point - exec query, TRUE/FALSE result returned
      	 */
    public function exec()
    {
        $this->build();
        $this->stmt = $this->dbh->prepare($this->sqlQuery);
        return $this->stmt->execute();
    }
    /**
         * Exit point - NO exec query, count( result ) returned
     * Testing REQURED
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    /**
         * Exit point - exec query, all rows of result returned as array
      	 */
    public function all()
    {
        $this->exec();
        return $this->buildMap($this->stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    /**
         * Exit point - exec query, return row number
      	 */
    public function count()
    {
        $this->query = "COUNT";
        return Util::GetAttribute($this->first(), "count", 0);
    }
    /**
         * Exit point - exec query, first row of result returned as array
      	 */
    public function first()
    {
        $this->exec();
        return $this->buildMap($this->stmt->fetch(PDO::FETCH_ASSOC));
    }
    /**
         * Exit point - NO exec query, var_dump built sql
      	 */
    public function dump($stop = false)
    {
        Util::Dump($this->sqlQuery);
        if ($stop) {
            die();
        }
        return $this;
    }
    /**
         * Exit point - exec query, random row of result returned as array
     * Optimization REQIUIRED
     */
    public function random()
    {
        $rows = $this->all();

        $result = array();
        $rowCount = count($rows);
        if ($rowCount > 0) {
            $result = $rows[ Rand(0, $rowCount - 1) ];
        }
        return $result;
    }
}



class DBMeta
{
    /**
         * Internal variables
      	 */
    private $dbh;
    private $stmt;
    private $name;
    private $table;

    /**
     * Constructor
      */
    public function __construct($cfg)
    {
        $host = Util::GetAttribute($cfg, 'host', '');
        $name = Util::GetAttribute($cfg, 'name', '');
        $user = Util::GetAttribute($cfg, 'user', '');
        $pass = Util::GetAttribute($cfg, 'pass', '');
        $this->table = Util::GetAttribute($cfg, 'table', '');

        $char = "utf8";
        if (isset($cfg['char'])) {
            $char = $cfg['char'];
        }
        $dsn = "mysql:host={$host};dbname={$name};charset={$char}";
        $options = array( PDO::ATTR_PERSISTENT => true );
        $this->dbh = new PDO($dsn, $user, $pass, $options);
        $this->name = $name;
    }

    /**
     * Call this method to test DB connection settings
      */
    public function testConnection()
    {
        try {
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = true;
        } catch (PDOException $e) {
            $result = false;
        }
        return $result;
    }
    /**
     * Call this method to get Table columns metadata settings
      */
    public function tableMeta()
    {
        try {
            $sql = "SELECT * FROM information_schema.columns  WHERE (table_schema= :dbname and table_name = :tablename) order by ordinal_position";
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->bindParam(':dbname', $this->name, PDO::PARAM_STR, 24);
            $this->stmt->bindParam(':tablename', $this->table, PDO::PARAM_STR, 24);
            $this->stmt->execute();
            $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $result = array();
        }
        return $result;
    }
    /**
     * Call this method to get ALL DB table list
      */
    public function tableList()
    {
        try {
            $sql = "SELECT table_name FROM information_schema.tables where table_schema= :dbname";
            $this->stmt = $this->dbh->prepare($sql);
            $this->stmt->bindParam(':dbname', $this->name, PDO::PARAM_STR, 24);
            $this->stmt->execute();
            $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $result = array();
        }
        return $result;
    }
}
