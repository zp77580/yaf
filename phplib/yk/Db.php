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
				\yk\Db::$_client[$db_name]->connect(
					$db_conf['server'],
					$db_conf['user'],
					$db_conf['passwd'],
					$db_conf['db_name'],
					$db_conf['port']
				);
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

	//关闭所有db函数
	public static function closeAllConns(){
		if( count(\yk\Db::$_client === 0) ){
			return true;
		}
		foreach (\yk\Db::$_client as $conn) {
			$conn->close();
		}
	}


}