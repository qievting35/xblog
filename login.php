
<?php

require(dirname(__FILE__) . "/./lib/idverify.inc");
require(dirname(__FILE__) . "/./lib/common.inc");
session_start();

define("ls_logged_noact", 0,true);
define("ls_nolog_noact", 1,true);
define("ls_logged_1", 2,true);
define("ls_logged_2", 3,true);
define("ls_nolog", 4,true);
define("ls_failedcheck", 5,true);

$login_status = ls_nolog_noact;

if( !isset($_POST['username']) || !isset($_POST['username']) ){ // 未输入登录信息
	if (isset($_SESSION['username'])) { // 已经登陆
		$login_status = ls_logged_noact;;
	}else {                             // 尚未登录
		$login_status = ls_nolog_noact;;
	}
} else {                                                        // 已输入登录信息
	
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	
	if (idverify($username, $password)){// 登录成功
		if (isset($_SESSION['username'])) { // 已经登陆
			if ($_SESSION['username'] == $username){
				$login_status = ls_logged_1;;
			} else {
				$login_status = ls_logged_2;
			}
		} else {                            // 尚未登录
			$_SESSION['username'] = $username;
			$login_status = ls_nolog;
		}
	}else{                            // 登录失败
		$login_status = ls_failedcheck;
	}
}

$cur_theme = get_cur_theme();

require(dirname(__FILE__) . "/./themes/" . $cur_theme . "/login.theme.php");

?>
