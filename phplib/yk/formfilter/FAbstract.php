<?php
namespace yk\formfilter;

class FAbstract{
	public function vaild($result_raw,$param){
		$ret = $this->customVaild($result_raw,$param);
		return $ret;
	}
}