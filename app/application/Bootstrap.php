<?php

class Bootstrap extends Yaf\Bootstrap_Abstract {
	public function _initRouter(){
		$uri = Yaf\Dispatcher::getInstance()->getRequest()->getRequestUri();
		$uri_list = explode("/", $uri);
		array_shift($uri_list);
		$module = trim($uri_list[0]);
		if($module == ''){
			$module = \conf\Router::DEFAULT_MODULE;
		}
		$new_uri = array(
			'module' => $module,
		);
		if( count($uri_list) == 2 ){
			$new_uri['action'] = $uri_list[1];
		}
		if( count($uri_list) == 3 ){
			$new_uri['controller'] = $uri_list[1];
			$new_uri['action'] = $uri_list[2];
		}
		//print_r($new_uri);die;
		//处理路由
		$router = Yaf\Dispatcher::getInstance()->getRouter();   //获取路由器
		$route = new Yaf\Route\Rewrite( $uri_list[0] , $new_uri);
		$router->addRoute($uri_list[0], $route);
	}
}