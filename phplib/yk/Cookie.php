<?php

namespace yk;

class Cookie
{
	static $G_COOKIE = 'yaf';
	
	public static function get_cookie($name){
		if(isset($_COOKIE[self::$G_COOKIE . $name])){
			return $_COOKIE[self::$G_COOKIE . $name];
		}
		return false;
	}

	public static function set_cookie($name,$value = '', $expire = null,$path = '/', $domain = null, $secure = false){
		if(is_null($expire)){
			$expire = time() + 3600*24;
		}
		return setcookie(self::$G_COOKIE.$name, $value, $expire, $path, $domain, $secure);
	} 

}