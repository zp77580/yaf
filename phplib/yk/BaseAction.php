<?php

namespace yk;
define("FROM_GET", 1);
define("FROM_POST", 2);
define("FROM_URL", 3);

abstract class BaseAction extends \Yaf\Action_Abstract {
	protected $params = array();
	protected $tpl_file = false;
	protected $valid_data = false;
	protected $_tpl_data = array(
		'errno' => \conf\BaseError::OK,
	);

	public function beforeInvoke(){
		//准备日志
		define("MODULE", strtolower($this->getRequest()->getModuleName()));
		$log_config = new \Yaf\Config\Ini( APPLICATION_PATH . "/conf/log.ini",'log');
		$log_config_arr = $log_config->toArray();
		$log_config_arr['strLogFile'] = ROOT_PATH.'/'.$log_config_arr['logPath'].'/'.MODULE.".log";
		//\ut\Log::init( $log_config_arr );


		$this->init();
		$formfiter = new \yk\Formfiter();
		$this->valid_data = $formfiter->form_chceck($this->params);
	}

	public function AfterInvoke($display_data){
		$smarty_adapter = new \yk\SmartyAdapter();
		
		if($this->tpl_file !== false){
			$smarty_adapter->assign($display_data);
			$smarty_adapter->display( $this->tpl_file);
		}else{
			$smarty_adapter->ajax($display_data);
		}
		\yk\Db::closeAllConns();
		return true;
	}
	public function execute(){
		try{
			$this->beforeInvoke();
			$ret = $this->invoke();
		}catch(\Exception $e) {
			$msg = $ex->getMessage();
			$code = $ex->getCode();
			$file = $ex->getFile();
			$line = $ex->getLine();
		}
		$this->_tpl_data['data'] = $ret;
		$this->AfterInvoke( $this->_tpl_data );
		return false;
	}


}