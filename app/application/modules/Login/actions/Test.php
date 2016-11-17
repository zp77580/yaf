<?php

class TestAction extends yk\BaseAction {
	public function init(){
	    $this->params = ['get_id','get_name'];
	}
	public function invoke(){
		$dao1 = \yk\Db::getDb('app');
		$dao1->startTransaction();
	    $sql = "select aid from properties.properties_album limit 1";
		$res = $dao1->query($sql);
		$dao1->commit();
		var_dump($res);
		die;
		$ret = $this->valid_data;
		return $ret;
	}
}