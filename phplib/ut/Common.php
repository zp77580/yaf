<?php
namespace ut;
class Common{
	
	public function init(){
		spl_autoload_register(__CLASS__."::autoload");
	}

	static function autoload($classname){
		$first = strpos($classname, "\\");
		$prefix = substr($classname, 0, $first);
		if(empty($prefix) && !empty($classname)){
			$prefix = $classname;
		}
		$autoloade = array(
			'yk' => LIB_PATH,
			'ut' => LIB_PATH,
		);
		$autoloade = isset($autoloade[$prefix]) === true ? $autoloade[$prefix] : APP_PATH;
		$new_file = $autoloade."/".str_replace('\\', '/', $classname).'.php';
		if(file_exists($new_file)){
			require_once $new_file;
		}
	}
}