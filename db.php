<?php

class DB {
	private $mysqli;
	private $host = 'localhost';
	private $username = 'root';
	private $password = 'root';
	private $database = 'test';
	/* 构造函数： 初始化连接数据库及设置字符编码 */
	function __construct() {
		$this->mysqli = new mysqli( $this->host, $this->username, $this->password, $this->database );
		if ( !$this->mysqli ) {
			die( '连接失败：' . $this->mysqli->connect_error );
		}
		$this->mysqli->query("set names utf8");
	}
	/* insert, update, delete */
	public function execute_dml( $sql ) {
		$result = $this->mysqli->query($sql) or die( "操作失败" . $this->mysqli->connect_error );
		if ( !$result ) {
			return 0;
		} else {
			if ( $this->mysqli->affected_rows > 0 ) {
				return 1;
			} else {
				return -1;
			}
		}
	}
	/* select */
	public function execute_dql( $sql ) {
		$result = $this->mysqli->query($sql) or die( "查询失败" . $this->mysqli->connect_error );
		return $result;
	}

	public function close() {
		$this->mysqli->close();
	}
}

?>
