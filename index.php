<?php

require(dirname(__FILE__) . "/./lib/common.inc");
session_start();

if(!isset($_SESSION['username'])){
	$username = '';
} else {
	$username = $_SESSION['username'];
}

$cur_theme = get_cur_theme();
require(dirname(__FILE__) . "/./themes/" . $cur_theme . "/index.theme.php");

?>
