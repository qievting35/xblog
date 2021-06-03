<?php
require(dirname(__FILE__) . "/../config/db_conf.inc");

// 生成标准的GUID
function guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

// 获取当前主题名称
function get_cur_theme()
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
	$s_sql = "select value from tb_sys_info where name ='cur_theme' limit 0,1 ;";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print(mysql_error());
		return "default";
	}

	$ret = "default";
	//提取数据
	if ($result) {
		while ( $row = $result->fetch_array()){
			$ret = $row['value'];
			break;
		}
		// 释放资源 
		$result->free();
	}

	// 关闭连接 
	$dbconn->close();

	return $ret;
}

// 获取用户已有权限列表
function get_auth_user($username)
{

	$auth_list = array();
	
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
	$s_sql ="call get_auth_user('{$username}');";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print(mysql_error());
		return $auth_list;
	}
	
	$s_sql ="select * from tb_tmp_ret;";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print(mysql_error());
		return $auth_list;
	}

	//提取数据
	if ($result) {
		while ( $row = $result->fetch_array()){
			$auth_list[] = $row['id_authority'];
		}
		// 释放资源 
		$result->free();
	}

	// 关闭连接 
	$dbconn->close();

	return $auth_list;
}

// 添加新的文章
function add_new_art($username, $category, $title, $intro, $thumb, $slide, $labels, $content)
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

	//执行SQL语句
	$s_guid = guid();
	
	$s_sql_labels_h = '';
	$s_sql_labels_b = '';
	$label_list = explode(' ',$labels);
	$s_sql_labels_h .= ' insert into tb_label_article(guid_art,label) ';
	$index = 0;
	foreach ($label_list as $label) {
		if (trim($label) != "") {
			if ($index > 0)	$s_sql_labels_b .= ' union all ';
			$s_sql_labels_b .= ' select ' . '\'' . $s_guid . '\' guid_art, ' . '\'' . $label . '\' label' ;
			$index += 1;
		}
	}
	$s_sql_labels = '';
	if ($s_sql_labels_b != '') {
		$s_sql_labels = $s_sql_labels_h . $s_sql_labels_b . ';';
	}
	
	$s_sql = ' insert into tb_article(username,id_category,guid,title,intro,thumb, slide, content, maketime) values(';
	$s_sql .= "'{$username}'," . "{$category}," . "'{$s_guid}'," . "'{$title}'," .
		"'{$intro}'," ."'{$thumb}'," . "'{$slide}'," . "'{$content}',"  . "now()" . '); ';
	$dbconn->query("SET NAMES 'UTF8'");
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print($dbconn->errno);
		return "";
	}

	$dbconn->query("SET NAMES 'UTF8'");
	$result=$dbconn->query($s_sql_labels);
	if(!$result) {
		print('>>> 添加文章标签失败，错误号：' . $dbconn->errno . ' <<<');
	}
	
	// 关闭连接 
	$dbconn->close();

	return $s_guid;
}

// 获取文章分类列表
function get_category()
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
	$s_sql = " select * from tb_category order by dn; ";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print(mysql_error());
		return false;
	}

	$cates = array();
	//提取数据
	if ($result) {
		while ( $row = $result->fetch_array()){
			array_push($cates, $row);
		}
		// 释放资源 
		$result->free();
	}

	// 关闭连接 
	$dbconn->close();

	return $cates;
}

// 获取系统配置项值
function get_sys_info($itemname)
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
	$s_sql = "select value from tb_sys_info where name ='{$itemname}' limit 0,1 ;";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print($dbconn->errno);
		return "";
	}

	$ret = "";
	//提取数据
	if ($result) {
		while ( $row = $result->fetch_array()){
			$ret = $row['value'];
			break;
		}
		// 释放资源 
		$result->free();
	}

	// 关闭连接 
	$dbconn->close();

	return $ret;
}


// 获取幻灯文章($top条)列表
function get_slide_arts($top)
{
	// 连接数据库
	global $g_dbhost;
	global $g_dbname;
	global $g_dba_username;
	global $g_dba_password;

	if ($top < 1) return false;
	$s_top = $top;

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
	
	$s_sql = " select * from tb_article where trim(ifnull(slide, '')) <> '' order by maketime limit 0, {$s_top}; ";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print($dbconn->errno);
		return false;
	}

	$arts = array();
	//提取数据
	if ($result) {
		while ( $row = $result->fetch_array()){
			$arts[] = $row;
		}
		// 释放资源 
		$result->free();
	}

	// 关闭连接 
	$dbconn->close();

	if (count($arts) < 1) return false;
	return $arts;
}

// 获取全部文章列表
function get_all_arts()
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
	$s_sql = "";
	$s_sql .= " select ";
	$s_sql .= " guid,username,title,intro,content,ifnull(thumb, '') thumb,slide,id_category,maketime ";
	$s_sql .= " from tb_article order by maketime; ";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print($dbconn->errno);
		return false;
	}

	$arts = array();
	//提取数据
	if ($result) {
		while ( $row = $result->fetch_array()){
			$arts[] = $row;
		}
		// 释放资源 
		$result->free();
	}

	// 关闭连接 
	$dbconn->close();

	if (count($arts) < 1) return false;
	return $arts;
}


// 获取文章的标签
function get_labels_art($s_aid)
{
	// 连接数据库
	global $g_dbhost;
	global $g_dbname;
	global $g_dba_username;
	global $g_dba_password;

	if (trim($s_aid) == '') return false;

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
	$s_sql = "";
	$s_sql .= " select distinct label from tb_label_article where guid_art = '{$s_aid}'; ";
	$result=$dbconn->query($s_sql);
	if(!$result) {
		print($dbconn->errno);
		return false;
	}

	$labels = array();
	//提取数据
	if ($result) {
		while ( $row = $result->fetch_array()){
			$labels[] = $row;
		}
		// 释放资源 
		$result->free();
	}

	// 关闭连接 
	$dbconn->close();

	if (count($labels) < 1) return false;
	return $labels;
}

?>
