<?php
namespace ut;

class Log
{
	const LOG_LEVEL_NONE    = 0x00;
	const LOG_LEVEL_FATAL   = 0x01;
	const LOG_LEVEL_WARNING = 0x02;
	const LOG_LEVEL_NOTICE  = 0x04;
	const LOG_LEVEL_TRACE   = 0x08;
	const LOG_LEVEL_DEBUG   = 0x10;
	const LOG_LEVEL_ALL     = 0xFF;


	public static $arrLogLevels = array(
		self::LOG_LEVEL_NONE    => 'NONE',
		self::LOG_LEVEL_FATAL   => 'FATAL',
		self::LOG_LEVEL_WARNING => 'WARNING',
		self::LOG_LEVEL_NOTICE  => 'NOTICE',
		self::LOG_LEVEL_TRACE	=> 'TRACE',
		self::LOG_LEVEL_DEBUG   => 'DEBUG',
		self::LOG_LEVEL_ALL     => 'ALL',
	);

	protected $intLevel;
	protected $strLogFile;
	protected $arrSelfLogFiles;
	protected $intLogId;
	protected $intMaxFileSize;
	protected $addNotice = '';

	private static $instance = null;

	private function __construct($arrLogConfig = '')
	{
		if( ! is_array($arrLogConfig)) {
			$module = strtolower(\Yaf\Dispatcher::getInstance()->getRequest()->getModuleName ());
			$log_config = new \Yaf\Config\Ini(APPLICATION_PATH . "/conf/log.ini", 'log');
			$log_config_arr = $log_config->toArray();
			$arrLogConfig['strLogFile'] = ROOT_PATH."/". $log_config_arr['logPath'] ."/".MODULE. ".log";
		}

		$this->intLevel         = intval($arrLogConfig['intLevel']);
		$this->strLogFile		= $arrLogConfig['strLogFile'];
		$this->arrSelfLogFiles  = $arrLogConfig['arrSelfLogFiles'];
		// use framework logid as default
		$this->intLogId		= 0;
		$this->intMaxFileSize	= $arrLogConfig['intMaxFileSize'];
	}

	public static function init($arrLogConfig) {
		if(self::$instance == null) {
			self::$instance = new \ut\Log($arrLogConfig);
		}
	}

	public static function newInstance($arrLogConfig) {
		if(self::$instance !== null) {
			self::$instance =null;
		}
		self::$instance = new \ut\Log($arrLogConfig);
	}

	public static function getInstance()
	{
		if( self::$instance === null )
		{
			self::$instance = new \ut\Log();
		}

		return self::$instance;
	}

	public function writeLog($intLevel, $str, $errno = 0, $arrArgs = null, $depth = 0)
	{
		
	}

}
