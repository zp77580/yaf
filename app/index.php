<?php
define("ROOT_PATH", dirname(dirname(dirname(__FILE__))));
define("APP", "application");
define("APPLICATION_PATH", dirname(__FILE__));
define("APP_PATH", APPLICATION_PATH."/application");
define("TEM_PATH", APPLICATION_PATH."/template/");
define("LIB_PATH", ROOT_PATH."/yaf/phplib");

define("BASE_SITE", "http://".$_SERVER['HTTP_HOST']);
require_once LIB_PATH."/ut/Common.php";
$common = new \ut\Common();
$common->init();

$application = new Yaf\Application( APPLICATION_PATH . "/conf/application.ini" );
$application->bootstrap()->run();


