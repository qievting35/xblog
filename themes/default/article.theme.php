<?php

$cates = get_category();
$article = get_article($s_aid);

$s_cate_name = "";
foreach ($cates as $cate) {
	if ($cate['id'] == $article['id_category']) {
		$s_cate_name = $cate['name'];break;
	}
}

$s_html_title = "";

if ($s_cate_name == "")
	$s_html_title = get_sys_info('sitename');
else
	$s_html_title = get_sys_info('sitename') . ' - ' . $s_cate_name;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="./plugins/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" rel="stylesheet" type="text/css" />  
	<link type="text/css" rel="stylesheet" href=<?php  print("\"./themes/" . $cur_theme . "/css/init.css\""); ?> />
	<link type="text/css" rel="stylesheet" href=<?php  print("\"./themes/" . $cur_theme . "/css/layout.css\""); ?> />
	<link type="text/css" rel="stylesheet" href=<?php  print("\"./themes/" . $cur_theme . "/css/mods.css\""); ?> />
	<script type="text/javascript" src=<?php  print("\"./themes/" . $cur_theme . "/js/jquery.min.js\""); ?>></script>
	<script type="text/javascript" src="./plugins/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
	<script type="text/javascript">

    SyntaxHighlighter.all();

	</script>
	<script type="text/javascript" src=<?php  print("\"./themes/" . $cur_theme . "/js/slider/main.js\""); ?>></script>
    <title><?php print($s_html_title); ?></title>
  </head>
  <body>
	<a name="head"></a>
    <div id="area_head">
      <div id="area_head_center">
		<div id="mod_logo"><a href="/"></a></div>
		<div id="area_head_left">
		  <div id="wrap_ad_top"></div>
		  <div id="wrap_menu">
			<span class="cls_menu_item"><a href="./index.php">首页</a></span>
			<?php
			foreach ($cates as $cate) {
				$s_cls = "cls_menu_item";
				if (trim(strval($cate['id'])) == trim(strval($article['id_category']))) $s_cls = "cls_menu_item_cur";
				print("<span class=\"{$s_cls}\">" . "<a href=\"index.php?category=" . $cate['id'] . "\">" .$cate['name'] . "</a>" . "</span>");
			}
			?>
			<span  id="search_box">
			  <form method="get" action="http://baijia.baidu.com/" onsubmit="return chkForm(this);">
				<input name="tn" value="search" type="hidden" />
				<input id="edt_search" maxlength="24" name="word" autocomplete="off" type="text" />
				<input value="" type="submit" />
			  </form>
			</span>
			<span class="cls_menu_item"><a href="about.php">关于本站</a></span>
		  </div>
		</div>
      </div>
    </div>
    <div id="area_head_bottom">
    </div>
    <div id="area_body">
      <div id= "area_left">
		<h1 style="text-align:center;font-size:32px;padding-bottom:32px;"><?php print($article['title']); ?></h1>
		<?php
		print("<div class=\"article-info\" style=\"padding-bottom:16px;text-align:center;\">");
		print("作者：<a href=\"./author.php?name={$article['username']}\" class=\"article-author\" target=\"_blank\">{$article['username']}</a>&nbsp;&nbsp;");
		print("发表于：<span class=\"tm\">{$article['maketime']}&nbsp;&nbsp;</span>");
		print("<span class=\"count\">阅读：1029 次</span></div>");

		print("<div style=\"background-color:#eeeeee;padding-bottom:16px;padding-top:16px;padding-left:16px;padding-right:8px;	line-height:normal;font-size:14px;\">");
		print($article['intro']);
		print("</div><br />");
		print("<div class=\"art_content\">");
		print($article['content']);
		print("</div><br />");
		?>
      </div>
      <div id = "area_right">
		<div id="wrap_cellulitis">
		  <ul id="hex">
			<li class="p1">
			  <a href="http://www.sharejs.com"><b></b><span>邮件服务</span><em></em></a>
			</li>
			<li>
			  <a href="index.html"><b></b><span>官方QQ群</span><em></em></a>
			</li>
			<li class="p2">
			  <a href="http://www.sharejs.com"><b></b><span>本站论坛</span><em></em></a>
			</li>
			<li class="p2">
			  <a class="inner" href="../boxes/"><b></b><span>结构化意识论</span><em></em></a>
			</li>
			<li class="p2">
			  <a href="../mozilla/"><b></b><span>XBase@GIT</span><em></em></a>
			</li>
			<li class="p1 p2">
			  <a href="../ie/"><b></b><span>RSS订阅</span><em></em></a>
			</li>
			<li class="p2">
			  <a href="../opacity/"><b></b><span>收藏本站</span><em></em></a>
			</li>
		  </ul>
		</div>
		
		<div class="area_space_right"></div>
		
		<div id="wrap_ad_banner1">
		  <iframe height=338 width=336 src="http://player.youku.com/embed/XMTM4NzI4ODE2NA==" allowfullscreen></iframe>
		</div>
		
		<div class="area_space_right"></div>
		
		<!-- 标签云 开始 -->
		<div id="wrap_tagcoud">
		  <div class="cls_bar_title_left">
			<div class="cls_title_left">最热标签</div><div class="cls_subtitle_left">HOT TAGS<hr/></div>
		  </div>
		  <div class="cls_body_left">
			<div id="tagcloud">
			  <a href="localhost/bootstrap" class="tag-link-109" title="9个话题" style="font-size: 10pt;">Bootstrap</a>
			  <a href="localhost/cms%e4%b8%bb%e9%a2%98" class="tag-link-43" title="43个话题" style="font-size: 10pt;">CMS主题</a>
			  <a href="localhost/tangstyle" class="tag-link-28" title="3个话题" style="font-size: 10pt;">TangStyle</a>
			  <a href="localhost/wordpress" class="tag-link-10" title="297个话题" style="font-size: 10pt;">wordpress</a>
			  <a href="localhost/wordpress%e4%b8%bb%e9%a2%98" class="tag-link-11" title="289个话题" style="font-size: 10pt;">wordpress主题</a>
			  <a href="localhost/wordpress%e4%b8%bb%e9%a2%98%e4%b9%8b%e5%ae%b6" class="tag-link-32" title="288个话题" style="font-size: 10pt;">wordpress</a>
			  <a href="localhost/%e4%b8%89%e6%a0%8f" class="tag-link-30" title="19个话题" style="font-size: 10pt;">三栏</a>
			  <a href="localhost/%e4%bc%81%e4%b8%9a%e4%b8%bb%e9%a2%98" class="tag-link-53" title="26个话题" style="font-size: 10pt;">企业主题</a>
			  <a href="localhost/%e5%8d%95%e6%a0%8f" class="tag-link-13" title="31个话题" style="font-size: 10pt;">单栏</a>
			  <a href="localhost/%e5%8d%9a%e5%ae%a2%e4%b8%bb%e9%a2%98" class="tag-link-40" title="192个话题" style="font-size: 10pt;">博客主题</a>
			  <a href="localhost/%e5%8f%8c%e6%a0%8f" class="tag-link-16" title="157个话题" style="font-size: 10pt;">双栏</a>
			  <a href="localhost/%e5%93%8d%e5%ba%94%e5%bc%8f" class="tag-link-29" title="68个话题" style="font-size: 10pt;">响应式</a>
			  <a href="localhost/%e5%9b%be%e7%89%87%e4%b8%bb%e9%a2%98" class="tag-link-45" title="19个话题" style="font-size: 10pt;">图片主题</a>
			  <a href="localhost/%e5%a4%9a%e5%bd%a9" class="tag-link-323" title="5个话题" style="font-size: 10pt;">多彩</a>
			  <a href="localhost/%e5%a4%a7%e6%b0%94" class="tag-link-54" title="204个话题" style="font-size: 10pt;">大气</a>
			  <a href="localhost/%e5%b0%8f%e6%b8%85%e6%96%b0" class="tag-link-200" title="44个话题" style="font-size: 10pt;">小清新</a>
			  <a href="localhost/%e6%89%81%e5%b9%b3%e5%8c%96" class="tag-link-215" title="46个话题" style="font-size: 10pt;">扁平化</a>
			  <a href="localhost/%e6%97%b6%e5%85%89%e8%bd%b4" class="tag-link-162" title="5个话题" style="font-size: 10pt;">时光轴</a>
			  <a href="localhost/%e6%97%b6%e5%b0%9a" class="tag-link-291" title="4个话题" style="font-size: 10pt;">时尚</a>
			  <a href="localhost/%e6%9e%81%e7%ae%80" class="tag-link-209" title="8个话题" style="font-size: 10pt;">极简</a>
			  <a href="localhost/%e6%a9%99%e8%89%b2" class="tag-link-116" title="7个话题" style="font-size: 10pt;">橙色</a>
			  <a href="localhost/%e6%b1%89%e5%8c%96%e4%b8%bb%e9%a2%98" class="tag-link-36" title="12个话题" style="font-size: 10pt;">汉化主题</a>
			  <a href="localhost/%e6%b7%98%e5%ae%9d%e5%ae%a2%e4%b8%bb%e9%a2%98" class="tag-link-61" title="14个话题" style="font-size: 10pt;">淘宝客主题</a>
			  <a href="localhost/%e6%b8%85%e6%96%b0" class="tag-link-42" title="11个话题" style="font-size: 10pt;">清新</a>
			  <a href="localhost/%e6%b8%85%e6%99%b0" class="tag-link-24" title="41个话题" style="font-size: 10pt;">清晰</a>
			  <a href="localhost/%e6%b8%85%e7%88%bd" class="tag-link-127" title="5个话题" style="font-size: 10pt;">清爽</a>
			  <a href="localhost/%e7%80%91%e5%b8%83%e6%b5%81" class="tag-link-20" title="9个话题" style="font-size: 10pt;">瀑布流</a>
			  <a href="localhost/%e7%81%b0%e8%89%b2" class="tag-link-17" title="74个话题" style="font-size: 10pt;">灰色</a>
			  <a href="localhost/%e7%8c%ab10" class="tag-link-285" title="5个话题" style="font-size: 10pt;">猫10</a>
			  <a href="localhost/%e7%99%bd%e8%89%b2" class="tag-link-14" title="102个话题" style="font-size: 10pt;">白色</a>
			  <a href="localhost/%e7%ae%80%e6%b4%81" class="tag-link-25" title="175个话题" style="font-size: 10pt;">简洁</a>
			  <a href="localhost/%e7%ae%80%e7%ba%a6" class="tag-link-27" title="23个话题" style="font-size: 10pt;">简约</a>
			  <a href="localhost/%e7%ba%a2%e8%89%b2" class="tag-link-66" title="8个话题" style="font-size: 10pt;">红色</a>
			  <a href="localhost/%e7%bb%8f%e5%85%b8" class="tag-link-18" title="21个话题" style="font-size: 10pt;">经典</a>
			  <a href="localhost/%e7%bb%bf%e8%89%b2" class="tag-link-126" title="17个话题" style="font-size: 10pt;">绿色</a>
			  <a href="localhost/%e8%87%aa%e9%80%82%e5%ba%94" class="tag-link-178" title="22个话题" style="font-size: 10pt;">自适应</a>
			  <a href="localhost/%e8%93%9d%e8%89%b2" class="tag-link-22" title="42个话题" style="font-size: 10pt;">蓝色</a>
			  <a href="localhost/%e8%b4%a8%e6%84%9f" class="tag-link-67" title="38个话题" style="font-size: 10pt;">质感</a>
			  <a href="localhost/%e9%a3%8e%e6%a0%bc%e7%8b%ac%e7%89%b9" class="tag-link-47" title="24个话题" style="font-size: 10pt;">风格独特</a>
			  <a href="localhost/%e9%bb%91%e8%89%b2" class="tag-link-46" title="55个话题" style="font-size: 10pt;">黑色</a>	</div>
		  </div>
		</div>
		<!-- 标签云 结束 -->
		
		<div class="area_space_right"></div>
		
		<!-- 热评文章列表 开始 -->
		<div id="wrap_hot_arts">
		  <div class="cls_bar_title_left">
			<div class="cls_title_left">热评文章</div><div class="cls_subtitle_left">HOT ARTICLES<hr/></div>
		  </div>
		  <div class="cls_body_left">
			<ul class="cls_art_list">
			  <li>
				<p><a href="http://www.thesct.net" mon="name=bjhotarticle">人工智能对抗ISIS：西点军校毕业生发现了什么？</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/232725" mon="name=bjhotarticle">我心目中2015年十大华语烂片</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/232375" mon="name=bjhotarticle">股市背离市场涨势能否持续？</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/231721" mon="name=bjhotarticle">动漫进入圈地时代：腾讯入口、光线发行、奥飞内容？</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/232505" mon="name=bjhotarticle">爆料：百度也要开银行了，将和中信成立合资银行</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/231599" mon="name=bjhotarticle">黑莓最后的尊严</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/231727" mon="name=bjhotarticle">高潮之下的网易，头上悬着达摩克里斯之剑</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/232755" mon="name=bjhotarticle">京东Q3财报：连亏八季，增长趋缓，腾讯红利见底</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/232606" mon="name=bjhotarticle">京东Q3营收首现负增长 京东牌“泰坦尼克”拐角已现</a></p>
			  </li>
			  <li>
				<p><a href="http://www.thesct.net/231925" mon="name=bjhotarticle">来自中国的机器人，几乎无所不能，连美国人都看傻眼</a></p>
			  </li>
			</ul>
		  </div>
		</div>
		<!-- 热评文章列表 结束 -->

		<div class="area_space_right"></div>
		
		<!-- 热门评论列表 开始 -->

		<!-- 热门评论 结束 -->

      </div>
    </div>

	
    <div id="area_space_foot"></div>
	
    <div id="area_foot">
	  <a name="foot"></a>
	  <div id="footer">

		<div id="flinks">
		  <span id="flinks_title">友情链接：</span>
		  <a href="http://www.waptw.com/" title="手机软件" target="_blank">手机软件</a>
		  <a href="http://www.uc.cn/" title="手机浏览器 " target="_blank">手机浏览器 </a>
		  <a href="http://www.dospy.com/" title="dospy智能手机网" target="_blank">智能手机网</a>
		  <a href="http://www.9game.cn/" title="手机游戏下载" target="_blank">手机游戏下载</a>
		  <a href="http://www.appchina.com/" title="安卓市场" target="_blank">安卓市场</a>
		  <a href="http://mobile.yesky.com/" title="天极手机" target="_blank">天极手机</a>
		  <a href="http://apk.91.com" title="91安卓游戏软件" target="_blank">91安卓游戏软件</a>
		  <a href="http://tech.ifeng.com/digi/mobile/" title="凤凰手机频道" target="_blank">凤凰手机频道</a>
		  <a href="http://bbs.hiapk.com/  " title="安卓论坛" target="_blank">安卓论坛</a>
		  <a href="http://www.anqu.com" title="安趣" target="_blank">安趣</a>
		  <a href="http://www.958shop.com " title="手机网" target="_blank">手机网</a>
		  <a href="http://www.shendu.com/" title="深度安卓门户" target="_blank">深度安卓门户</a>
		</div>
		
		<div id="copyright">
		  <p>Copyright © 2014-2016 符动乾坤 版权所有</p><br />
		  <p>站长邮箱： xy_god@thesct.net</p><br />
		</div>
		冀ICP备14018418号
		<div class="clearfix"></div>
	  </div>
    </div>
	
	<div id="indicator">
	  <div id="shang" onclick="location.href='#head'"></div>
	  <div id="zhong_w">
		<div id="zhong">
		  <div class="weixin">
			<img src=<?php  print("\"./themes/" . $cur_theme . "/img/weixin.jpg\""); ?> width="150" height="150" />
		  </div>
		</div>
	  </div>
	  <div id="xia" onclick="location.href='#foot'"></div>
	</div>	
	
  </body>
</html>
