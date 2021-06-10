<link href="../plugins/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" rel="stylesheet" type="text/css" />  
<script type="text/javascript" src="../plugins/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
<script type="text/javascript">      

    SyntaxHighlighter.all();

</script>
<?php

require(dirname(__FILE__) . "/../lib/common.inc");

session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['username'])){
	print("您尚未登录，请先登录！");
	exit();
}

$username = $_SESSION['username'];

$err = 0;

$noauth = false;
$auths = get_auth_user($username);
if (!isset($auths)) {
	$noauth = true;
} else {
	if (count($auths) == 0) {
		$noauth = true;
	} else {
		$noauth = true;
		foreach($auths as $auth){
			if ($auth == 1) {
				$noauth = false; break;
			}
		}
	}
}
if ($noauth) $err = -1;

$s_guid = "";
if ($err == 0) {
	if (isset($_POST['category'])) {$category = $_POST['category'];} else {$category = '';}
	if (isset($_POST['title'])) {$title = $_POST['title'];} else {$title = '';}
	if (isset($_POST['intro'])) {$intro = $_POST['intro'];} else {$intro = '';}
	if (isset($_POST['thumb'])) {$thumb = $_POST['thumb'];} else {$thumb = '';}
	if (isset($_POST['slide'])) {$slide = $_POST['slide'];} else {$slide = '';}
	if (isset($_POST['labels'])) {$labels = $_POST['labels'];} else {$labels = '';}
	if (isset($_POST['content'])) {$content = $_POST['content'];} else {$content = '';}

	if (( $category == '' ) or ( $title == "" ) or ( $content == "" )) {
		$err = 1;	
	}
	if ( $category == '' ) {print('文章分类为空！');echo($_POST['category']);}
	if ( $title == "" ) {print('文章标题为空！');echo($_POST['title']);}
	if ( $content == "" ) {print('文章内容为空！');echo($_POST['content']);}
}

if ($err == 0) {
	$s_guid = add_new_art($username,$category, $title, $intro, $thumb, $slide, $labels, $content);
	if ($s_guid == "") {
		$output = "执行添加新文章失败！";
	} else {
		$output = "";
		$output .= ' 分类：' . strval($category) . '<br />';
		$output .= ' 标题：' . $title . ' GUID: ' . $s_guid . '<br />';
		$output .= '简介：' . $intro . '<br />';
		$output .= '缩略图：' . $thumb . '<br />';
		$output .= '幻灯图：' . $slide . '<br />';
		$output .= ' 标签：' . $labels . '<br />';
		$output .= "<hr />";
		$output .= $content;
		$output .= "<br /><hr/>以上是用POST方法接收到内容！";
	}
} else {
	if ($err == -1) {
		$output = "添加新文章失败，您不具有发布新文章的权限，请联系管理员以获得相应权限！";
	}
	if ($err == 1) {
		$output = "请求参数有误，请通过合法途径发表文章！";
	}
}

print($output);

?>

