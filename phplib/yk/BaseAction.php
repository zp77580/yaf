<?php

namespace yk;
define("FROM_GET", 1);
define("FROM_POST", 2);
define("FROM_URL", 3);

abstract class BaseAction extends \Yaf\Action_Abstract {
	protected $params = array();
	protected $tpl_file = false;
	protected $valid_data = false;

	public function beforeInvoke(){
		define("MODULE", strtolower($this->getRequest()->getModuleName()));
		$this->init();
		$formfiter = new \yk\Formfiter();
		$formfiter->form_chceck($this->params);
	}
	public function execute(){
		$this->beforeInvoke();
	}
}