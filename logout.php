<?php

session_start();

// 释放所有的当前会话的相关变量
session_unset();
if (isset($_GET['for']))
	$url_redirect_req = $_GET['for'];
else
	$url_redirect_req = 'admin';
header("Location:./login.php?for='{$url_redirect_req}'");
?>
