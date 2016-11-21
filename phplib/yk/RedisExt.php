<?php

namespace yk;
use Redis;

class RedisExt
{
	private static $_client = array();

	private static function init($redis_name){
		if( !isset($_client[$redis_name]) ){
			if(!isset(\conf\Db::$redis[$redis_name])){
				return false;
			}

			$redis_conf = \conf\Db::$redis[$redis_name];
			if(!isset(\yk\RedisExt::$_client[$redis_name])){
				\yk\RedisExt::$_client[$redis_name] = new Redis();

				try{
					\yk\RedisExt::$_client[$redis_name]->connect($redis_conf['ip'],$redis_conf['port']);
					if(!is_resource(\yk\RedisExt::$_client[$redis_name]->socket)){
						return false;
					}
				}catch (\Exception $e) {
					throw new \Exception($e->getMessage(),$e->getCode());
				}
			}else{
				echo "had existed<br/>";
				return ture;
			}
		}

	}

	public static function getRedis($redis_name){
		$ret = RedisExt::init($redis_name);
		if($ret === false){
			return false;
		}
		return \yk\RedisExt::$_client[$redis_name];
	}

	public function set($key,$value,$expire_time = 0,$redis_name = 'online'){
		$redis_ins = self::getRedis($redis_name);
		if($redis_ins == NULL || $redis_ins == false){
			return false;
		}
		if($expire_time > 0){
			$ret = $redis_ins->setex($key,$expire_time,$value);
		}else{
			$ret = $redis_ins->set($key,$value);
		}

		if($ret === false){
			return false;
		}
		return true;
	}

	public function del($key,$redis_name = 'online'){
		$redis_ins = self::getRedis($redis_name);
		if($redis_ins == NULL || $redis_ins == false){
			return false;
		}
		return $ret = $redis_ins->delete($key);
	}

	public function get($key, $redis_name = 'online'){
		$redis_ins = self::getRedis($redis_name);
		if( $redis_ins == NULL || $redis_ins === false) {
			return false;
		}
		return $redis_ins->get($key);
	}

	public function exists($key, $redis_name = 'online'){
		$redis_ins = self::getRedis($redis_name);
		if($redis_ins == NULL || $redis_ins == false){
			return false;
		}
		return $redis_ins->exists($key);
	}

	//得到一个key的生存时间
	public function ttl($key, $redis_name = 'online'){
		$redis_ins = self::getRedis($redis_name);
		if($redis_ins == NULL || $redis_ins == false){
			return false;
		}
		return $redis_ins->ttl($key);
	}

	public function hset($key, $field, $value, $expire_time = 0,$redis_name = 'online'){
		$redis_ins = self::getRedis($redis_name);
		if( $redis_ins ==NULL || $redis_ins == false ){
			return false;
		}
		if($expire_time > 0){
			return $redis_ins->hset($key,$field,$value);
		}else{
			$redis_ins->hset($key,$field,$value);
		    return $redis_ins->expire($key, $expire_time);
		}
	}

	public function hget($key,$field,$redis_name = 'online'){
		$redis_ins = self::getRedis($redis_name);
		if( $redis_ins == NULL || $redis_ins === false) {

			return false;
		}
		return $redis_ins->hget($key,$field);
	}

	public function hdel($key,$field,$redis_name = 'online'){
		$redis_ins = self::getRedis($redis_name);
		if( $redis_ins == NULL || $redis_ins === false) {
			return false;
		}
		return $redis_ins->hdel($key,$field);
	}

	public function hexists($key,$field,$redis_name = 'online'){
		$redis_ins = RedisExt::getRedis($redis_name);
		if( $redis_ins == NULL || $redis_ins === false) {
			return false;
		}
		return $redis_ins->hexists($key,$field);
	}

	//关闭所有连接
	public static function closeAllConns(){
		if(count(\yk\RedisExt::$_client) === 0){
			return true;
		}
		foreach(\yk\RedisExt::$_client as $conn){
			$conn->close();
		}
	}
}