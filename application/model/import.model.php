<?php
/**
 * Include section
 */
require_once(MODEL . 'abstract.model.php');
require_once(LIB . 'fs.class.php');
require_once(IMPORT . 'factory.source.php');
require_once(IMPORT . 'factory.destination.php');

/**
 * Import Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ImportModel extends AbstractModel
{
    /**
     * Get all rules stored in RULES dir
     * 
     * @return array rules as array
     */
    public function getRules() : array
    {
        $result = array();

        $files = Files::Enumerate(RULES);
        foreach ($files as $k => $file) {
            $rule_name = str_replace("_", " ", str_replace(".rule.xml", "", str_replace(RULES, '', $file)));
            $rule_file_name = str_replace(RULES, '', $file);
            $result[] = [ 'rule_name' => $rule_name, 'rule_file_name' => $rule_file_name ];
        }

        return $result;
    }
    
    /**
     * Save rule as xml file
     * 
     * @var string $rule_file_name  Rule file name to save
     * 
     * @return void
     */
    public function save(string $rule_file_name)
    {
        foreach ($_POST['src'] as $k => &$r) {
            $r = array( '@cdata' => $r );
        }
        foreach ($_POST['dst'] as $k => &$r) {
            $r = array( '@cdata' => $r );
        }
        foreach ($_POST['rule'] as $k => &$r) {
            $r = array( '@cdata' => $r );
        }
        foreach ($_POST['key'] as $k => &$r) {
            $r = array( '@cdata' => $r );
        }
        foreach ($_POST['settings'] as $k => &$r) {
            $r = array( '@cdata' => $r );
        }

        $xml = Array2XML::createXML('root', $_POST);
        file_put_contents($rule_file_name, $xml->saveXML());
    }
    
    /**
     * Load rule xml file
     * 
     * @var string $rule_file_name  Rule file name to save
     * 
     * @return array Rule fields as array
     */
    public function load(string $rule_file_name) : array
    {
        $xml = file_get_contents($rule_file_name);
        return XML2Array::createArray($xml);
    }
    
    /**
     * Load rule xml file
     * 
     * @var string $rule_file_name  Rule file name to start executing
     * 
     * @return void
     */
    public function start(string $rule_file_name)
    {
        $xml = file_get_contents($rule_file_name);
        $rule = XML2Array::createArray($xml);
        $root = Util::GetAttribute($rule, 'root', []);

        $src  = Util::GetAttribute($root, 'src', []);
        $dst  = Util::GetAttribute($root, 'dst', []);
        $rule = Util::GetAttribute($root, 'rule', []);
        $key  = Util::GetAttribute($root, 'key', []);
        $settings = Util::GetAttribute($root, 'settings', []);
    
        $this->run($src, $dst, $key, $settings, $rule);
    }

    /**
     * Run data query/process/save operation
     * 
     * @var array $src Source data
     * 
     * @var array $dst Destination data
     * 
     * @var array $key Key data for table destination
     * 
     * @var array $settings settings
     * 
     * @var array $rule rule to execute
     * 
     * @return void
     */
    public function run($src, $dst, $keys, $settings, $rule)
    {
        $env = $this->buildEnv($src, $dst);

        require_once(LIB . 'html.class.php');

        $sourceType = Util::GetCData($src, 'sourceType', '');
        $dataSource = SourceFactory::build($sourceType);

        $destType = Util::GetCData($dst, 'destinationType', '');
        $dataDestination = DestinationFactory::build($destType);
    
        $ruleCondition = Util::GetAttribute($settings, 'ruleCondition', []);
        $ruleAfter = Util::GetAttribute($settings, 'ruleAfter', []);
    
        $source = $dataSource->get($src);
        $result = $this->proccessItem($env, $source, $ruleCondition);
        if ($result) {
            $data = $this->proccess($env, $source, $rule);
            $dataDestination->put($data, $keys, $dst);

            $this->proccessItem($env, $source, $ruleAfter);
        }
    }
    
    /**
     * proccess data according to a rule
     * 
     * @var array $src Source data
     * 
     * @var array $dst Destination data
     * 
     * @return array 
     */
    public function buildEnv($src, $dst) : array
    {
        $result = [];
        foreach ($src as $name => $item) {
            $result[$name] = Util::GetCData($src, $name, '');
        }
        foreach ($dst as $name => $item) {
            $result[$name] = Util::GetCData($dst, $name, '');
        }
        return $result;
    }

    /**
     * proccess data according to a rule
     * 
     * @var array $env Environment data
     * 
     * @var array $data Data from source
     * 
     * @var array $rule Rule to execute
     * 
     * @return array 
     */
    public function proccess($env, $data, $rule) : array
    {
        $result = [];
        foreach ($rule as $k => $item) {
            $result[$k] = $this->proccessItem($env, $data, $item);
        }
        return $result;
    }

    /**
     * proccess data according to a rule line
     * 
     * @var array $env Environment data
     * 
     * @var array $data Data from source
     * 
     * @var array $item Rule field to execute
     * 
     * @return string
     */
    public function proccessItem($env, $data, $item) : string
    {
        $result = '';
        $item  = Util::GetAttribute($item, '@cdata', '');
        if ('' !== $item) {
            eval($item);
        }
        return $result;
    }

    /**
     * Test connection rule settings
     * 
     * @return int 0|1
     */
    public function test() : int
    {
        $result = 0;
        $type = Util::GetAttribute($_POST, 'type', "");
        if ("sql" === $type) {
            $meta = new DBMeta($this->getCFG($_POST));
            if ($meta->testConnection()) {
                $result = 1;
            }
            $meta = null;
        }
        if ("web" === $type) {
            $url = Util::GetAttribute($_POST, 'url', "");
            if (!empty($url)) {
                $content = file_get_contents($url);
                if (!empty($content)) {
                    $result = 1;
                }
            }
        }
        return $result;
    }

    /**
     * Get Table metadata settings
     * 
     * @return array Table metadata settings as array
     */
    public function table() : array
    {
        $result = array();
        $type = Util::GetAttribute($_POST, 'type', "");
        if ("sql" === $type) {
            $meta = new DBMeta($this->getCFG($_POST));
            $result = $meta->tableMeta();
        }
        return $result;
    }

    /**
     * Get Table list for DB connection settings
     * 
     * @return array Tables in DB as array 
     */
    public function tablelist() : array
    {
        $result = array();
        $type = Util::GetAttribute($_POST, 'type', "");
        if ("sql" === $type) {
            $meta = new DBMeta($this->getCFG($_POST));
            $result = $meta->tableList();
        }
        return $result;
    }

    /**
     * Get Table list for DB connection settings
     * 
     * @return array DB connection settings as array
     */
    public function getCFG($arr) : array
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
}
