<?php 
    /// <summary>
    /// Require Util to operate
    /// </summary>
    require_once( LIB . 'util.class.php' );

    /// <summary>
    /// Cookie manager 
    /// </summary>
    class Cookie
    {
        /// <summary>
        /// Session field
        /// </summary>
	const SESSION = 0;
		
        /// <summary>
        /// Day field
        /// </summary>
	const DAY = 86400; // 24 * 60 * 60;
		
        /// <summary>
        /// Month field
        /// </summary>
	const MONTH = 2592000; // 30 * self::DAY;
		
        /// <summary>
        /// Year field
        /// </summary>
	const YEAR = 31536000 ; // 365 * self::DAY;
		
        /// <summary>
        /// Domain field
        /// </summary>
	const DOMAIN = "";
		
        /// <summary>
        /// Path field
        /// </summary>
	const PATH = "/";
		
        /// <summary>
        /// Set Cookie 
        /// </summary>
        public static function setCookie( $name, $values, $time = self::MONTH, $domain = self::DOMAIN, $path = self::PATH )
        {
		$time = time() + $time;
		if ( is_array( $values ) )
		{
			foreach( $values as $key => $value )
			{
				if ( is_array( $value ) )
				{
					Cookie::setCookie( "$name" . '[' . "$key" . ']', $value, 10 * Cookie::YEAR );
				}
				else
				{
					setcookie( "$name" . '[' . "$key" . ']', $value, $time, $path, $domain );
				}
			}
		}
		else
		{
			setcookie( $name, $values, $time, $path, $domain );
		}
		$_COOKIE[ $name ] = $values;
	}
		
        /// <summary>
        /// Get cookie $name 
        /// </summary>
	public static function getCookie( $name, $def = null )
	{
		return Util::GetAttribute($_COOKIE, $name, $def );
	}
		
        /// <summary>
        /// Delete cookie $name
        /// </summary>
	public static function delCookie( $name, $domain = self::DOMAIN, $path = self::PATH )
	{
		Cookie::setCookie( $name, false, - self::YEAR, $path, $domain );
		unset( $_COOKIE[ $name ] );
	}
		
        /// <summary>
        /// Get timestamp of End Of $period
        /// </summary>
	private static function EO( $period )
	{
		date_default_timezone_set('GMT'); 
		$d = new DateTime( "now" );
		$str = $d->format( $period );
		$d = new DateTime( "$str" );
		return intval( $d->format( "U" )) - time();
	}
		
        /// <summary>
        /// Get timestamp of End Of YEAR
        /// </summary>
	public static function EOY()
	{
		return Cookie::EO( 'Y-12-31 23:59:59' );
	}
		
        /// <summary>
        /// Get timestamp of End Of MONTH
        /// </summary>
	public static function EOM()
	{
		return Cookie::EO( 'Y-m-t 23:59:59' );
	}
		
        /// <summary>
        /// Get timestamp of End Of DAY
        /// </summary>
	public static function EOD()
	{
		return Cookie::EO( 'Y-m-d 23:59:59' );
	}
		
        /// <summary>
        /// Get 'Forever' cookie = 10 years
        /// </summary>
	public static function FOREVER( )
	{
		return 10 * Cookie::YEAR;
	}
		
        /// <summary>
        /// Set Cookie EOY 
        /// </summary>
        public static function setCookieEOY( $name, $values, $domain = self::DOMAIN, $path = self::PATH )
        {
		Cookie::setCookie( $name, $values, Cookie::EOY(), $domain = self::DOMAIN, $path = self::PATH );
	}
        /// <summary>
        /// Set Cookie EOM
        /// </summary>
        public static function setCookieEOM( $name, $values, $domain = self::DOMAIN, $path = self::PATH )
        {
		Cookie::setCookie( $name, $values, Cookie::EOM(), $domain = self::DOMAIN, $path = self::PATH );
	}
        /// <summary>
        /// Set Cookie EOD 
        /// </summary>
        public static function setCookieEOD( $name, $values, $domain = self::DOMAIN, $path = self::PATH )
        {
		Cookie::setCookie( $name, $values, Cookie::EOD(), $domain = self::DOMAIN, $path = self::PATH );
	}
        /// <summary>
        /// Set Cookie FOREVER
        /// </summary>
        public static function setCookieFOREVER( $name, $values, $domain = self::DOMAIN, $path = self::PATH )
        {
		Cookie::setCookie( $name, $values, Cookie::FOREVER(), $domain = self::DOMAIN, $path = self::PATH );
	}
}
?>
