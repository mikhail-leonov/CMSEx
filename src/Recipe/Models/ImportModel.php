<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Models;

/**
 * Import Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ImportModel extends \Recipe\Abstracts\AbstractModel implements \Recipe\Interfaces\ModelInterface
{
    /**
     * Get all rules stored in RULES dir
     *
     * @return array Get Rules list
     */
    public function getRules() : array
    {
        $rules = [];
        $files = Files::Enumerate(RULES);
        foreach ($files as $k => $file) {
            $rule_name = str_replace("_", " ", str_replace(".rule.xml", "", str_replace(RULES, '', $file)));
            $rule_file_name = str_replace(RULES, '', $file);
            $rules[] = [ 'rule_name' => $rule_name, 'rule_file_name' => $rule_file_name ];
        }
        return $rules;
    }
    
    /**
     * Save rule as xml file
     *
     * @var array $params Parameters
     *
     * @return \stdClass Save rule { result: 0|1, data: object };
     */
    public function save(array $params) : \stdClass
    {
        $result = 0;

        $settings = \Recipe\Util::GetAttribute($params, 'settings', []);
        $title = \Recipe\Util::GetAttribute($settings, 'ruleTitle', '');
        $title = trim($title);
        if ('' !== $title) {
            $slug = str_replace(' ', '_', strtolower($title));
            $rule_file_name = RULES . $slug . ".rule.xml";

            foreach ($params['src'] as $k => &$r) {
                $r = [ '@cdata' => $r ];
            }
            foreach ($params['dst'] as $k => &$r) {
                $r = [ '@cdata' => $r ];
            }
            foreach ($params['rule'] as $k => &$r) {
                $r = [ '@cdata' => $r ];
            }
            foreach ($params['key'] as $k => &$r) {
                $r = [ '@cdata' => $r ];
            }
            foreach ($params['settings'] as $k => &$r) {
                $r = [ '@cdata' => $r ];
            }

            $xml = Array2XML::createXML('root', $_POST);
            file_put_contents($rule_file_name, $xml->saveXML());

            $result = 1;
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }
    
    /**
     * Load rule xml file
     *
     * @var array $params Parameters
     *
     * @return \stdClass Load rule { result: 0|1, data: object };
     */
    public function load(array $params) : \stdClass
    {
        $result = 0;
        $rule = [];
        $rule_file_name = \Recipe\Util::GetAttribute($params, 'rule_file_name', '');
        $rule_file_name = RULES . $rule_file_name;
        if (file_exists($rule_file_name)) {
            $xml = file_get_contents($rule_file_name);
            $rule = XML2Array::createArray($xml);
            $result = 1;
        }
        return (object)[ 'result' => $result, 'data' => (object)[ 'rule' => $rule ] ];
    }
    
    /**
     * Load rule xml file
     *
     * @var array $params
     *
     * @return \stdClass Load rule result { result: 0|1, data: object };
     */
    public function start(array $params) : \stdClass
    {
        $result = 0;
        $settings = \Recipe\Util::GetAttribute($params, 'settings', []);
        $title = \Recipe\Util::GetAttribute($settings, 'ruleTitle', '');
        $title = trim($title);
        if ('' !== $title) {
            $slug = str_replace(' ', '_', strtolower($title));
            $rule_file_name = RULES . $slug . ".rule.xml";

            $xml = file_get_contents($rule_file_name);
            $rule = XML2Array::createArray($xml);
            $root = \Recipe\Util::GetAttribute($rule, 'root', []);

            $src  = \Recipe\Util::GetAttribute($root, 'src', []);
            $dst  = \Recipe\Util::GetAttribute($root, 'dst', []);
            $rule = \Recipe\Util::GetAttribute($root, 'rule', []);
            $key  = \Recipe\Util::GetAttribute($root, 'key', []);
            $settings = \Recipe\Util::GetAttribute($root, 'settings', []);
    
            $this->run($src, $dst, $key, $settings, $rule);

            $result = 1;
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
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
    protected function run($src, $dst, $keys, $settings, $rule)
    {
        $env = $this->BuildEnv($src, $dst);

        require_once(LIB . 'html.class.php');

        $sourceType = \Recipe\Util::GetCData($src, 'sourceType', '');
        $dataSource = SourceFactory::build($sourceType);

        $destType = \Recipe\Util::GetCData($dst, 'destinationType', '');
        $dataDestination = DestinationFactory::build($destType);
    
        $ruleCondition = \Recipe\Util::GetAttribute($settings, 'ruleCondition', []);
        $ruleAfter = \Recipe\Util::GetAttribute($settings, 'ruleAfter', []);
    
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
    protected function BuildEnv($src, $dst) : array
    {
        $result = [];
        foreach ($src as $name => $item) {
            $result[$name] = \Recipe\Util::GetCData($src, $name, '');
        }
        foreach ($dst as $name => $item) {
            $result[$name] = \Recipe\Util::GetCData($dst, $name, '');
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
    protected function proccess($env, $data, $rule) : array
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
    protected function proccessItem($env, $data, $item) : string
    {
        $result = '';
        $item  = \Recipe\Util::GetAttribute($item, '@cdata', '');
        if ('' !== $item) {
            eval($item);
        }
        return $result;
    }

    /**
     * Test connection rule settings
     *
     * @return \stdClass Table metadata settings as array { result: 0|1, data: object };
     */
    public function test() : \stdClass
    {
        $result = 0;

        $type = \Recipe\Util::GetAttribute($_POST, 'type', "");
        if ("sql" === $type) {
            $meta = new DBMeta(\Recipe\Util::getCFG($_POST));
            if ($meta->testConnection()) {
                $result = 1;
            }
            $meta = null;
        }
        if ("web" === $type) {
            $url = \Recipe\Util::GetAttribute($_POST, 'url', "");
            if (!empty($url)) {
                $content = file_get_contents($url);
                if (!empty($content)) {
                    $result = 1;
                }
            }
        }
        return (object)[ 'result' => $result, 'data' => (object)[] ];
    }

    /**
     * Get Table metadata settings
     *
     * @return \stdClass Table metadata settings as array { result: 0|1, data: object };
     */
    public function table() : \stdClass
    {
        $result = 0;
        $list = [];
        $type = \Recipe\Util::GetAttribute($_POST, 'type', "");
        if ("sql" === $type) {
            $meta = new DBMeta(\Recipe\Util::getCFG($_POST));
            $list = $meta->tableMeta();
            $result = 1;
        }
        return (object)[ 'result' => $result, 'data' => (object)[ 'list' => $list ] ];
    }

    /**
     * Get Table list for DB connection settings
     *
     * @return \stdClass Tables in DB as array { result: 0|1, data: object };
     */
    public function tablelist() : \stdClass
    {
        $result = 0;
        $list = [];
        $type = \Recipe\Util::GetAttribute($_POST, 'type', "");
        if ("sql" === $type) {
            $meta = new DBMeta(\Recipe\Util::getCFG($_POST));
            $list = $meta->tableList();
            $result = 1;
        }
        return (object)[ 'result' => $result, 'data' => (object)[ 'list' => $list ] ];
    }
}
