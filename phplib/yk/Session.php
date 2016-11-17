<?php

namespace yk;

class Session{
	public static function getSession($key){
		//return isset($_SESSION[$key])?$_SESSION[$key]:NULL;
		return \Yaf\Session::getInstance()->__get($key);
	}

	public static function setSession($key,$value){
		//$_SESSION[$key] = $value;
		\Yaf\Session::getInstance()->__set($key,$value);
	}

	public static function unsetSession($key){
		//unset($_SESSION[$key]);
		\Yaf\Session::getInstance()->__unset($key);
	}
}