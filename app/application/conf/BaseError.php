<?php

namespace conf;
class BaseError {
	const OK = 0;
	static $error_static_url;
}

BaseError::$error_static_url = array(
	BaseError::OK => "OK",

);