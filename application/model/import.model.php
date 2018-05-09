<?php
/**
 * Abstract controller
 */
require_once( MODEL . 'abstract.model.php' );
require_once( LIB . 'fs.class.php' );
require_once( IMPORT . 'factory.source.php' );
require_once( IMPORT . 'factory.destination.php' );

/**
 * Model
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
     */
    public function getRules()
    {
	$result = array();

	$files = Files::Enumerate( RULES );	
	foreach($files as $k => $file ) {
		$rule_name = str_replace( "_", " ", str_replace( ".rule.xml", "", str_replace( RULES, '', $file)));
		$rule_file_name = str_replace( RULES, '', $file);
		$result[] = [ 'rule_name' => $rule_name, 'rule_file_name' => $rule_file_name ];
	}

	return $result;
    }
    
    /**
     * Save rule as xml file
     */
    public function save($rule_file_name)
    {
	    foreach( $_POST['src'] as $k => &$r  ) { $r = array( '@cdata' => $r ); }	
	    foreach( $_POST['dst'] as $k => &$r  ) { $r = array( '@cdata' => $r ); }	
	    foreach( $_POST['rule'] as $k => &$r ) { $r = array( '@cdata' => $r ); }	
	    foreach( $_POST['key'] as $k => &$r  ) { $r = array( '@cdata' => $r ); }	
	    foreach( $_POST['settings'] as $k => &$r ) { $r = array( '@cdata' => $r ); }	

	    $xml = Array2XML::createXML('root', $_POST);
	    file_put_contents( $rule_file_name, $xml->saveXML() );
    }
    
    /**
     * Load rule xml file
     */
    public function load($rule_file_name)
    {
	$xml = file_get_contents($rule_file_name);
	return XML2Array::createArray($xml);
    }
    
    /**
     * Load rule xml file
     */
    public function start($rule_file_name)
    {
	$xml = file_get_contents($rule_file_name);
	$rule = XML2Array::createArray($xml);
	$root = Util::GetAttribute( $rule, 'root', [] );

	$src  = Util::GetAttribute( $root, 'src', [] );
	$dst  = Util::GetAttribute( $root, 'dst', [] );
	$rule = Util::GetAttribute( $root, 'rule', [] );
	$key  = Util::GetAttribute( $root, 'key', [] );
	$settings = Util::GetAttribute( $root, 'settings', [] );
	
	$this->run($src, $dst, $key, $settings, $rule);
    }

    /**
     * Run data query/process/save operation
     */
    public function run($src, $dst, $keys, $settings, $rule)
    {
	$env = $this->buildEnv($src, $dst);

	require_once( LIB . 'html.class.php' );

    	$sourceType = Util::GetCData( $src, 'sourceType', '' );
	$dataSource = SourceFactory::build($sourceType);

    	$destType = Util::GetCData( $dst, 'destinationType', '' );
	$dataDestination = DestinationFactory::build($destType);
	
	$ruleCondition = Util::GetAttribute( $settings, 'ruleCondition', [] );
	$ruleAfter = Util::GetAttribute( $settings, 'ruleAfter', [] );
	
	$source = $dataSource->get($src);
	$result = $this->proccessItem($env, $source, $ruleCondition);
	if ( $result ) {

		$data = $this->proccess($env, $source, $rule);
		$dataDestination->put($data, $keys, $dst);

		$this->proccessItem($env, $source, $ruleAfter);
	}
    }
    
    /**
     * proccess data according to a rule
     */
    public function buildEnv($src, $dst)
    {
	$result = [];
	foreach($src as $name => $item) {
		$result[$name] = Util::GetCData( $src, $name, '' );
	}
	foreach($dst as $name => $item) {
		$result[$name] = Util::GetCData( $dst, $name, '' );
	}
	return $result;
    }

    /**
     * proccess data according to a rule
     */
    public function proccess($env, $data, $rule)
    {
	$result = [];
	foreach($rule as $k => $item) {
		$result[$k] = $this->proccessItem($env, $data, $item);
	}
	return $result;
    }

    /**
     * proccess data according to a rule line
     */
    public function proccessItem($env, $data, $item)
    {
	$result = '';
	$item  = Util::GetAttribute( $item, '@cdata', '' );
	if ( '' !== $item ) {
	    eval( $item );
	}
	return $result;
    }

    /**
     * test connection rule settings
     */
    public function test()
    {
 	$result = 0;
    	$type = Util::GetAttribute( $_POST, 'type', "" );
	if ( "sql" === $type) {
		$meta = new DBMeta( $this->getCFG( $_POST ) );
		if ( $meta->testConnection() ) { $result = 1; }
		$meta = null;
	}
	if ( "web" === $type) {
	    	$url = Util::GetAttribute( $_POST, 'url', "" );
		if ( !empty($url) ) {
			$content = file_get_contents($url);
			if ( !empty($content) ) {
				$result = 1;
			}
		}
	}
	return $result;
    }

    /**
     * Get Table metadata settings
     */
    public function table()
    {
 	$result = array();
    	$type = Util::GetAttribute( $_POST, 'type', "" );
	if ( "sql" === $type) {
		$meta = new DBMeta( $this->getCFG( $_POST ) );
		$result = $meta->tableMeta();
	}
	return $result;
    }

    /**
     * Get Table list for DB connection settings
     */
    public function tablelist()
    {
 	$result = array();
    	$type = Util::GetAttribute( $_POST, 'type', "" );
	if ( "sql" === $type) {
		$meta = new DBMeta( $this->getCFG( $_POST ) );
		$result = $meta->tableList();
	}
	return $result;
    }

    /**
     * Get Table list for DB connection settings
     */
    public function getCFG( $arr )
    {
	return [
    		'host'  => Util::GetAttribute( $arr, 'host' , "" ),
	    	'user'  => Util::GetAttribute( $arr, 'user' , "" ),
	    	'pass'  => Util::GetAttribute( $arr, 'pass' , "" ),
    		'name'  => Util::GetAttribute( $arr, 'name' , "" ),
	    	'code'  => Util::GetAttribute( $arr, 'code' , "" ),
	    	'table' => Util::GetAttribute( $arr, 'table', "" )
	];
    }

}
