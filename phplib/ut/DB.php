<?php

namespace ut;

class DB{
    const FETCH_RAW = 0;    // return raw mysqli_result
    const FETCH_ROW = 1;    // return numeric array
    const FETCH_ASSOC = 2;  // return associate array
    const FETCH_OBJ = 3;    // return \ut\DBResult object

	private $dbConf = NULL;
	private $isConnected = false;
	private $mysql = NULL;

	public function __construct(){
		$this->mysql = mysqli_init();
	}


	public function connect($host, $uname = NULL, $passwd = NULL, $dbname = NULL, $port = NULL, $flags = 0)
    {
        $port = intval($port);
        if(!$port)
        {
            $port = 3306;
        }

        $this->dbConf = array(
            'host' => $host,
            'port' => $port,
            'uname' => $uname,
            'passwd' => $passwd,
            'flags' => $flags,
            'dbname' => $dbname,
        );
        $this->isConnected = $this->mysql->real_connect(
            $host, $uname, $passwd, $dbname, $port, NULL, $flags
        );
        return $this->isConnected;
    }

    public function close(){
        if(!$this->isConnected){
            return;
        }
        $this->isConnected = false;
        $this->mysql->close();
    }

    public function query($sql,$fetchType = \ut\DB::FETCH_ASSOC, $bolUseResult = false){
        $res = $this->mysql->query($sql, $bolUseResult ? MYSQLI_USE_RESULT:MYSQLI_STORE_RESULT);
        if(is_bool($res) || $res === NULL){
            return false;    
        }else{
            switch ($fetchType) {
                case \ut\DB::FETCH_ASSOC:
                    $ret = array();
                    while($row = $res->fetch_assoc())
                    {
                        $ret[] = $row;
                    }
                    $res->free();
                    break;

                case \ut\DB::FETCH_ROW:
                    $ret = array();
                    while($row = $res->fetch_row())
                    {
                        $ret[] = $row;
                    }
                    $res->free();
                    break;       
                default:
                    $ret = $res;
                    break;
            }
        }
        return $ret;
    }


    public function startTransaction()
    {
        $sql = 'START TRANSACTION';
        return $this->query($sql);
    }

    public function commit()
    {
        return $this->mysql->commit();
    }

    public function rollback()
    {
        return $this->mysql->rollback();
    }


}