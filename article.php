
<?php

require(dirname(__FILE__) . "/./lib/common.inc");
session_start();

if (!isset($_GET['id'])) {
	header("Location:./index.php");
	exit();
}

$s_aid = $_GET['id'];

if(!isset($_SESSION['username'])){
	$username = '';
} else {
	$username = $_SESSION['username'];
}

$cur_theme = get_cur_theme();

require(dirname(__FILE__) . "/./themes/" . $cur_theme . "/article.theme.php");

?>
