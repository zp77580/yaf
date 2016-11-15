<?php
namespace yk;
class Formfiter {
	public function form_chceck($params){
		//如果为空
		if(count($params) == 0){
			return array();
		}

		foreach ($params as $param_name) {
			$pos = strpos($param_name, "_");
			$type = substr($param_name, 0,$pos);
			$param = substr($param_name, $pos+1);
			$param_conf = $this->_getParamConf($type,$param);
			if($param_conf === false || $param_conf == NULL) {
				return false;
			}

			$url_data = $this->_getParamUrl($type,$param_conf);
			var_dump($url_data);
		}
		die;
	}

	public function _getParamConf($type,$param){
		$module_conf_name = APPLICATION_PATH . "/conf/".MODULE."/".$type.".ini";
		if( !file_exists($module_conf_name) ){
			$module_conf_name = APPLICATION_PATH . "/conf/common/".$type.".ini";
		}
		$config = new \Yaf\Config\Ini($module_conf_name);
		$tmp_config = $config->get($param);
		if($tmp_config !== NULL){
			return $tmp_config->toArray();
		}
		return false;
	}

	public function _getParamUrl($type,$param){
		if($type == 'post'){
			$data = htmlentities( \Yaf\Dispatcher::getInstance()->getRequest()->getPost($param['name']) );
		}elseif($type == 'get'){
			$data = htmlentities( \Yaf\Dispatcher::getInstance()->getRequest()->getQuery($param['name']));
		}elseif($type = 'url'){
			$data = htmlentities( \Yaf\Dispatcher::getInstance()->getParam($param['name']));
		}
		return $data;
	}



}