<?php
	/// <summary>
	/// Utils class
	/// </summary>
	class Util
	{
		/// <summary>
		/// Arr To xml Cnvertor
		/// </summary>
		static function arr2xml( $data, &$xml_data ) 
		{
    			foreach( $data as $key => $value ) {
        			if( is_numeric($key) ){
            				$key = 'item'.$key; //dealing with <0/>..<n/> issues
        			}
        			if( is_array($value) ) {
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
		static function Dump( $obj )
		{
			print("<pre>");
			var_dump( $obj );
			print("</pre>");
		}
		/// <summary>
		/// Explode Array
		/// </summary>
		function explodeEx( $delimiters, $string ) 
		{
			$ready = str_replace( $delimiters, $delimiters[0], $string );
			return explode( $delimiters[0], $ready );
		}

		/// <summary>
		/// Get Widget Content
		/// </summary>
		static function GetAlreadySelected($name)
		{
			$result = array();
			$elements = Util::GetAttribute( $_COOKIE, $name, array() );
			foreach( $elements as $elements_id => $elements_title ) {
				$result[] = array( "tag_id" => $elements_id, "tag_name" => $elements_title );
			}
			return $result;
		}

		/// <summary>
		/// FilterSelectedTags
		/// </summary>
		static function FilterSelectedTags( $selected, $tags )
		{
			$result = array(); foreach( $tags as $k => $tag ) { if ( !Util::IsTagSelected( $selected, $tag ) ) { $result[] = $tag; } } return $result;
		}
		/// <summary>
		/// IsTagSelected
		/// </summary>
		static function IsTagSelected( $selected, $tag )
		{
			$result = false;
			$tid = Util::GetAttribute( $tag, 'tag_id', "" );
			foreach( $selected as $key => $current ) { $cid = Util::GetAttribute( $current, 'tag_id', "" ); if ( "$tid" ===  "$cid" ) { $result = true; break; } }
			return $result;
		}
		/// <summary>
		/// Get value from $attributes by name or return default value
		/// </summary>
		static function GetAttribute( $attributes, $name, $def )
		{
			$result = $def;
			if ( isset( $attributes ) ) {
				if ( array_key_exists( $name, $attributes ) ) {
					$result = $attributes[ $name ];
				}
			}
			return $result;
		}
		/// <summary>
		/// Get value from $attributes by name nested @cdata or return default value
		/// </summary>
		static function GetCData( $value, $name, $def )
		{
	    		$sub = Util::GetAttribute( $value, $name, [] );
		    	return Util::GetAttribute( $sub, '@cdata', $def );
		}
		
		/// <summary>
		/// Drop mem cached data or not
		/// </summary>
		static function IsReset()
		{
			$r = Util::GetAttribute( $_GET, 'reset', 0 );
			return ( "{$r}" === "1" );
		}	
	
		/// <summary>
		/// Add left and right slash
		/// </summary>
		static function Slash($url)
		{
			$result = $url;
			$result = Util::LSlash( $result );
			$result = Util::RSlash( $result );
			return $result;
		}
		
		/// <summary>
		/// Del left and right slash
		/// </summary>
		static function UnSlash($url)
		{
			$result = $url;
			$result = Util::UnLSlash( $result );
			$result = Util::UnRSlash( $result );
			return $result;
		}
		
		/// <summary>
		/// Add left slash
		/// </summary>
		static function LSlash($url)
		{
			$result = $url;
			if ( substr( $result, 0, 1 ) !== DIRECTORY_SEPARATOR ) {
				$result = DIRECTORY_SEPARATOR . $result;
			}
			return $result;
		}
		
		/// <summary>
		/// Del left slash
		/// </summary>
		static function UnLSlash($url)
		{
			$result = $url;
			if ( substr( $result, 0, 1 ) === DIRECTORY_SEPARATOR  ) {
				$result = substr( $result, 1, strlen( $result ) - 1 );
			}
			return $result;
		}
		
		/// <summary>
		/// Add right slash
		/// </summary>
		static function RSlash($url)
		{
			$result = $url;
			if ( substr( $result, -1 ) !== DIRECTORY_SEPARATOR  ) {
				$result = $result . DIRECTORY_SEPARATOR ;
			}
			return $result;
		}
		
		/// <summary>
		/// Del right slash
		/// </summary>
		static function UnRSlash($url)
		{
			$result = $url;
			if ( substr( $result, -1 ) === DIRECTORY_SEPARATOR  ) {
				$result = substr( $result, 0, strlen( $result ) - 1 );
			}
			return $result;
		}

		/// <summary>
		/// Encode HTML Entity
		/// </summary>
		static function encodeHTMLEntity($text)
		{
			return htmlspecialchars($text, ENT_QUOTES); 
		}
	
	}
