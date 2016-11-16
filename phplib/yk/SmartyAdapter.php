<?php

namespace yk;

class SmartyAdapter {

	public $_smarty;

	public function __construct(){
		require_once (LIB_PATH . '/yk/smarty/Smarty.class.php');
		$this->_smarty = new \Smarty();
		$smarty_config = \Yaf\Application::app()->getConfig()->smarty;
		foreach ($smarty_config as $key => $value) {
			$this->_smarty->$key = $value;
		}
	}

	public function assign($fis_data){
		$this->_smarty->assign($fis_data);
	}

	public function display($tpl){
		$this->_smarty->display($tpl);
	}

	public function ajax($fis_data){
		header("Content-type: application/json;charset=utf-8");
		echo json_encode($fis_data,JSON_UNESCAPED_UNICODE);
	}
}