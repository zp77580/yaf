<?php

namespace yk;

class Db{
	private static $_client = array();
	//页面级单例
	private static function init($db_name){
		if( !isset($_client[$db_name]) ){
			if( !isset(\conf\Db::$db[$db_name]) ){
				return false;
			}

			$db_conf = \conf\Db::$db[$db_name];

			if(!isset(\yk\Db::$_client[$db_name])){
				\yk\Db::$_client[$db_name] = new \ut\DB();
			}else{
				echo "had existed<br/>";
				return ture;
			}
		}


	}

	public static function getDb($db_name){
		$ret = self::init($db_name);
		if($ret === false){
			return false;
		}
		return \yk\Db::$_client[$db_name];
	}


}