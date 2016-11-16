<?php


class DanliAction extends yk\BaseAction {
	public function init(){
	    $this->params = ['get_id','get_name'];
	}
	public function invoke(){
		$dao1 = \yk\Db::getDb('app');
		$dao2 = \yk\Db::getDb('app');
		$dao3 = \yk\Db::getDb('app');
		var_dump($dao1);
		var_dump($dao2);
		var_dump($dao3);die;
		$ret = $this->valid_data;
		return $ret;
	}
}