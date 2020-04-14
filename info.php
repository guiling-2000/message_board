<?php

class Info {
  private $mysqli;
	private $host = 'localhost';
	private $username = 'root';
	private $password = 'root';
	private $database = 'test';

  public function __construct() {
    $this->connect();
  }

  public function run() {
    define('PAGESIZE', 4);
    $page_id = isset($_GET['id']) ? $_GET['id'] : 1;

    $query = " select * from message_board limit " . PAGESIZE . ' offset ' . PAGESIZE * ($page_id-1);
    $result = $this->select($query);
    $content = $this->success($result);

    return $content;
  }

  public function connect() {
    $this->mysqli = new mysqli( $this->host, $this->username, $this->password, $this->database );
		if ( !$this->mysqli ) {
			die( '连接失败：' . $this->mysqli->connect_error );
		}
  }

  public function select($sql) {
    $result = $this->mysqli->query($sql);
    return $result;
  }

  public function getCount() {
    $query = " select count(*) as num_rows from message_board ";
    $result = $this->select($query);
    $row = $result->fetch_assoc();

    return $row['num_rows'];
  }

  public function success($data) {
    $total_nums = intval($this->getCount());
    $content = [
      "code" => 1,
      "message" => "success",
      "info" => [
        "page_size" => 4,              // 每一页的留言数量
        "total_nums" => $total_nums,   // 总的留言数量
        "data" => []                   // 二维数组，包含留言信息
      ]
    ];

    while ( $row = $data->fetch_assoc() ) {
      $content['info']['data'][] = $row;
    }

    return $content;
  }

}

$info = new Info();
// var_dump($info->run());
echo JSON_encode($info->run());
