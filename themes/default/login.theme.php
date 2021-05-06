<?php

$msg_checkfailed= <<<EOT
	<br />
	<div style="color:red;">验证失败，用户名或者密码错误，请重新输入！</div>
EOT;

$username="";
if (isset($_SESSION['username'])){ $username = $_SESSION['username'];}

$msg_notrelogin = <<<EOT
<div style="color:red;">用户：{$username}, 已经登录，请勿重复登录！</div>
EOT;

$msg_ef = "用户：" . $username . "已登录，请退出当前用户再进行登录";
$msg_exitfirst = <<<EOT
<div style="color:red;">{$msg_ef}</div>
EOT;

$url_redirect = "";
if (isset($_GET['for'])) {
	if($_GET['for'] == 'admin'){
		$url_redirect_req = "./admin/index.php";
	} else {
		$url_redirect_req = "./" . $_GET['for'] . ".php";
	}
} else {
	$url_redirect_req = "./admin/index.php";
}

if (isset($_POST['for'])) {
	if($_POST['for'] == 'admin'){
		$url_redirect = "./admin/index.php";
	} else {
		$url_redirect = "./" . $_POST['for'] . ".php";
	}
} else {
	$url_redirect = "./admin/index.php";
}

$cur_theme = get_cur_theme();

$login_box= <<<EOT
    <div class="page-container">
      <h1>会员登录</h1>
      <form action="login.php" method="post">
        <input type="text" name="username" class="username" placeholder="用户名">
        <input type="password" name="password" class="password" placeholder="密码">
		<input id= "for" type="hidden" value="{$url_redirect_req}" />
        <button type="submit" name="submit">登录</button>
        <div class="error"><span>+</span></div>
      </form>
    </div>    

EOT;

if (
	($login_status == ls_logged_noact) ||
		($login_status == ls_logged_1) ||
		($login_status == ls_logged_1)){ // 如果已登录
	$url_redirect = $url_redirect_req; //则直接跳转
}

$msg_redirect= <<<EOT
<script language="javascript" type="text/javascript"> 
	window.setTimeout("window.location='{$url_redirect}'",2000);
</script>
EOT;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php print("./themes/" . $cur_theme); ?>/css/login/init.css">
    <link rel="stylesheet" href="<?php print("./themes/" . $cur_theme); ?>/css/login/style.css">
    <title>符动乾坤 - 登录系统：</title>
  </head>
  <body>
	<?php
	
	switch($login_status){
		case	ls_logged_noact: // 无请求，已登录
			print($msg_redirect);
			break;
		case	ls_nolog_noact:  // 无请求, 未登录
			print($login_box);
			break;
		case	ls_logged_1:     // 有请求，已登录，且同名
			print($msg_notrelogin);
			print($msg_redirect);
			break;
		case	ls_logged_2:     // 有请求，已登录，且异名
			print($msg_exitfirst);
			print($msg_redirect);
			break;
		case	ls_nolog:        // 有请求，未登录
			print($msg_redirect);
			break;
		case	ls_failedcheck:  // 有请求，验证失败
			print($login_box);
			print($msg_checkfailed);
			break;
	}
	?>
  </body>
</html>
