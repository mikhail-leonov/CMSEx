<?php

/**
 * Require AbstractDestination
 */
require_once( IMPORT . 'source.abstract.class.php' );

/**
 * This is the "WEB Source data source class". 
 */
class WebSource extends AbstractSource
{
	public function get($settings) 
	{
		$result = "";
	    	$url = Util::GetCData( $settings, 'sourceUrl', "" );
		if ( '' !== $url ) {
			$result = file_get_contents($url);
		}
		return $result;
	}
}

