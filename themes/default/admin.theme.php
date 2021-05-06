<?php

function should_display($deps, $auths)
{
	if ($deps == null) return 'true';

	foreach($auths as $auth){
		foreach($deps as $dep){
			if($dep == $auth) return 'true';
		}
	}

	return 'false';
}

function get_auth_menu($auths)
{
	$auth_menu = array(
		array(
			array('m','M9','内容管理', should_display(array(01,02,03),$auths),''),
				array('s','M9','增加文章',should_display(array(01),$auths),'./add_art.php'),
				array('s','M9','文章列表',should_display(array(01, 02, 03),$auths),'./art_list.php')
		),
			array(
				array('m','M4','评论管理',should_display(array(05,06),$auths),''),
					array('s','M4','评论列表',should_display(array(05, 06),$auths),'./comment_list.php')
			),
			array(
				array('m','M10','系统管理',should_display(array(10),$auths),''),
					array('s','M10','用户管理',should_display(array(10),$auths),'./user_manage.php'),
					array('s','M10','百度搜索',should_display(array(10),$auths),'http://www.baidu.com')
			),
			array(
				array('m','M10','测试一下',should_display(null,$auths),''),
					array('s','M10','超级测试',should_display(null,$auths),'./user_manage.php'),
					array('s','M10','百度搜索',should_display(null,$auths),'http://www.baidu.com')
			)
	);

	return $auth_menu;
}

$auth_menu = '';
$s_auth_menu = '';

if ($noauth) {
	$auth_menu = "no auth here!";
} else {
	$auth_menu = get_auth_menu($auths);
	foreach ($auth_menu as $menu) {
		$i = 0;
		foreach ($menu as $item) {
			if ($i == 0) {
				if ($item[3] == 'false') {break;}
				$s_auth_menu .= "<li><h4  class=\"{$item[1]}\"><span></span>{$item[2]}</h4><div class=\"list-item none\">";
			} elseif ($i == (count($menu) - 1)) {
				if ($item[3] == 'true') {
					$s_auth_menu .= "<a href=\"{$item[4]}\" target=\"mainFram\">{$item[2]}</a>";
				}
				$s_auth_menu .= "</div></li>";
			} else {
				if ($item[3] == 'true') {
					$s_auth_menu .= "<a href=\"{$item[4]}\" target=\"mainFram\">{$item[2]}</a>";
				}
			}
			$i += 1;
		}
	}
}

?>

<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>符动乾坤-后台管理</title>
<link type="text/css" rel="stylesheet" href=<?php  print("\"../themes/" . $cur_theme . "/css/admin/style.css\""); ?> />
<script type="text/javascript" src=<?php  print("\"../themes/" . $cur_theme . "/js/admin/jquery-1.8.3.min.js\""); ?>></script>
<script type="text/javascript" src=<?php  print("\"../themes/" . $cur_theme . "/js/admin/menu.js\""); ?>></script>
</head>

<body>
<div class="top"></div>
<div id="header">
  <div class="logo">符动乾坤 后台管理系统</div>
	<div class="navigation">
		<ul>
		 	<li>欢迎您！</li>
			<li><a href=""><?php print($username); ?></a></li>
			<li><a href="">设置</a></li>
			<li><a href="../logout.php?for=admin">退出</a></li>
		</ul>
	</div>
</div>
<div id="content">
	<div class="left_menu">
	  <ul id="nav_dot">
		<?php print($s_auth_menu); ?>
  </ul>
		</div>
		<div class="m-right">
			<div class="main">
				<iframe name="mainFram" frameborder="0" scrolling="auto" height="100%" width="100%"></iframe>
			</div>
		</div>
</div>
<div class="bottom"></div>
<div id="footer"><p>Copyright © 2014-2016 符动乾坤 版权所有&nbsp;&nbsp;<span style="color:yellow;">冀ICP备14018418号</span>&nbsp;&nbsp;站长邮箱：xy_god@thesct.net</p></div>
<script>navList(12);</script>
</body>
</html>
