<?php

require(dirname(__FILE__) . "/../config/db_conf.inc");

// 验证用户名和密码
function idverify($username, $password)
{
	// 连接数据库
	global $g_dbhost;
	global $g_dbname;
	global $g_dba_username;
	global $g_dba_password;

	$dbconn = new mysqli($g_dbhost,$g_dba_username,$g_dba_password);
	if($dbconn->errno){
		exit($dbconn->_errno);
	}
	
	$dbconn->query("SET NAMES 'UTF8'");
	$dbconn->query("SET CHARACTER SET UTF8");
	$dbconn->query("SET CHARACTER_SET_RESULTS=UTF8'");
	
	//选择数据库
	$dbconn->select_db($g_dbname);

	//执行MySQL语句
	$s_sql = "select * from tb_user where name ='" . $username . "';";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print(mysql_error());
		return false;
	}

	$ret = false;
	//提取数据
	if ($result) {
		while ( $row = $result->fetch_array()){
			if (($row["name"] == $username) && ( $row["password"] == $password)){
				$ret = true;
				break;
			}
		}
		// 释放资源 
		$result->free();
	}
	
	// 关闭连接 
	$dbconn->close();

	return $ret;
}

?>
