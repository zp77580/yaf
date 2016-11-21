<?php

namespace conf;

class Db{
	public static $db = array(
		'app' => array(
			'server'=>'127.0.0.1',
			'port' => 3306,
			'user'=>'root',
			'passwd'=>'root',
			'timeout'=>2000,
			'db_name'=>'properties',
		),
	);

	public static $redis = array(
		'online' => array(
            'ip' => '127.0.0.1',
            'port' => 6379,
            ),
	);
	
}