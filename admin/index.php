<?php

require(dirname(__FILE__) . "/../lib/common.inc");
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['username'])){
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

require(dirname(__FILE__) . "/../themes/" . $cur_theme . "/admin.theme.php");

?>
