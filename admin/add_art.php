<?php

require(dirname(__FILE__) . "/../lib/common.inc");
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['username'])) {
	print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />");
	print("您尚未登录，请先登录！");
	header("Location:../login.php?for=admin");
	exit();
}

$username = $_SESSION['username'];
$cur_theme = get_cur_theme();

$auths = get_auth_user($username);

$noauth = false;
if (!isset($auths)) {
	$noauth = true;
} else {
	if (count($auths) == 0) {
		$noauth = true;
	} else {
		$noauth = false;
	}
}

$passed = false;
if (!$noauth) {
	foreach($auths as $auth) {
		if($auth == 1) {$passed = true;break;}
	}
}

if (!$passed) {
	print('您不具有发布文章的权限，请联系管理员申请此权限，谢谢！');
	exit();
}

require(dirname(__FILE__) . "/../themes/" . $cur_theme . "/add_art.theme.php");

?>
