<?php
/**
 * Include section
 */
require_once(DECORATOR . 'abstract.decorator.php');
require_once(LIB . 'xml.class.php');

/**
 * XML Class Decorator
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 */
class XmlDecorator extends AbstractDecorator
{
    /**
     * Decorate
     *
     * @var stdClass $obj parameters
     *
     * @return string decorated Object
     */
    public function Decorate(stdClass $obj) : string {
    
	$obj = Util::obj2arr( $obj );
	$xml = Array2XML::createXML('root', $obj);
	return $xml->saveXML();
    
    }
}
