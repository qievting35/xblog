<?php

$cates = get_category();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href=<?php  print("\"./themes/" . $cur_theme . "/css/init.css\""); ?> />
	<link type="text/css" rel="stylesheet" href=<?php  print("\"./themes/" . $cur_theme . "/css/layout.css\""); ?> />
	<link type="text/css" rel="stylesheet" href=<?php  print("\"./themes/" . $cur_theme . "/css/mods.css\""); ?> />
	<script type="text/javascript" src=<?php  print("\"./themes/" . $cur_theme . "/js/jquery.min.js\""); ?>></script>
	<script type="text/javascript" src=<?php  print("\"./themes/" . $cur_theme . "/js/slider/main.js\""); ?>></script>
	<script type="text/javascript">
	$(document).ready(function(){
		var show_per_page = 18;
		var number_of_items = $('#area_artlist').children().size();
		var number_of_pages = Math.ceil(number_of_items/show_per_page);
		$('#current_page').val(0);
		$('#show_per_page').val(show_per_page);
		var navigation_html = '<a class="previous_link" href="javascript:previous();">上一页</a>';
		var current_link = 0;
		while(number_of_pages > current_link){
			navigation_html +=
			'<a class="page_link" href="javascript:go_to_page(' +
				current_link +')" longdesc="' + current_link +'">'+
						(current_link + 1) +'</a>';
			current_link++;
		}
		navigation_html += '<a class="next_link" href="javascript:next();">下一页</a>';
		$('#page_navigation').html(navigation_html);
		$('#page_navigation .page_link:first').addClass('active_page');
		$('#area_artlist').children().css('display', 'none');
		$('#area_artlist').children().slice(0, show_per_page).css('display', 'block');	
	});
	function previous(){
		new_page = parseInt($('#current_page').val()) - 1;
		if($('.active_page').prev('.page_link').length==true){
			go_to_page(new_page);
		}
	}
	function next(){
		new_page = parseInt($('#current_page').val()) + 1;
		if($('.active_page').next('.page_link').length==true){
			go_to_page(new_page);
		}
	}
	function go_to_page(page_num){
		var show_per_page = parseInt($('#show_per_page').val());
		start_from = page_num * show_per_page;
		end_on = start_from + show_per_page;
		$('#area_artlist').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
		$('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
		$('#current_page').val(page_num);
	}
	</script>
	<style>
	#page_navigation a{
		padding:3px;
		border:1px solid gray;
		margin:2px;
		color:black;
		text-decoration:none
	}
	.active_page{
		background:darkblue;
		color:white !important;
	}
	</style>

	
    <title><?php print(get_sys_info('sitename')); ?> - 首页</title>
  </head>
  <body>
	<a name="head"></a>
    <div id="area_head">
      <div id="area_head_center">
		<div id="mod_logo"><a href="/"></a></div>
		<div id="area_head_left">
		  <div id="wrap_ad_top"></div>
		  <div id="wrap_menu">
			<span class="cls_menu_item_cur">首页</span>
			<?php
			foreach ($cates as $cate) {
				print("<span class=\"cls_menu_item\">" . "<a href=\"index.php?category=" . $cate['id'] . "\">" .$cate['name'] . "</a>" . "</span>");
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
		<div id = "area_recommended">
		  <div id = "wrap_xslider">
			<div class="xslider">
			  <ul class="rotaion_list">
				<?php
				$arts = get_slide_arts(5);
				$s_slide = "";
				if ($arts) {
					foreach ($arts as $art) {
						$s_slide .= "<li><a href=\"./article?id={$art['guid']}\">";
						$s_slide .= "<img src=\"{$art['slide']}\" width=\"600\" height=\"338\"";
						$s_slide .= " alt=\"{$art['title']}\" /></a></li>";
						print($s_slide);$s_slide = "";
					}
				}
				?>
			  </ul>
			</div>
			<script type="text/javascript">
			$(".xslider").start({auto:true});
			</script>
		  </div>
		  <div id = "wrap_editor_choices">
			<div class="choice">
			  <a href="http://nzhichao.baijia.baidu.com/article/244488" class="img" target="_blank">
				<img src="upload/choices/1.jpg" />
				<span class="bg"></span>
				<p class="title">专访朱啸虎：滴滴会不会并购优步？</p>
				<span class="shape"></span>
			  </a>
			</div>

			<div class="choice">
			  <a href="http://nzhichao.baijia.baidu.com/article/244488" class="img" target="_blank">
				<img src="upload/choices/2.jpg" />
				<span class="bg"></span>
				<p class="title">专访朱啸虎：滴滴会不会并购优步？</p>
				<span class="shape"></span>
			  </a>
			</div>

			<div class="choice">
			  <a href="http://nzhichao.baijia.baidu.com/article/244488" class="img" target="_blank">
				<img src="upload/choices/3.jpg" />
				<span class="bg"></span>
				<p class="title">专访朱啸虎：滴滴会不会并购优步？</p>
				<span class="shape"></span>
			  </a>
			</div>
		  </div>
		</div>
		<div class="area_space_left">
		</div>


		<input type='hidden' id='current_page' />
		<input type='hidden' id='show_per_page' />
		<div id="area_artlist">

		  <?php

		  $arts = get_all_arts();
		  $s_arts = "";
		  $s_art_h = "";
		  $s_art_b = "";
		  $s_art_f = "";

		  if ($arts) {
			  foreach ($arts as $art) {
				  $s_thumb = '';
				  if ( trim($art['thumb']) == '') {
					  $s_thumb = "./themes/{$cur_theme}/img/nothumb.jpg";
				  } else {
					  $s_thumb = $art['thumb'];
				  }
				  $s_art_h = <<<EOT
				  <div class="article hasImg">
				  <p class="article-pic">
				  <a href="./article.php?id={$art['guid']}" target="_blank" mon="col=13&amp;pn=4&amp;a=12">
				  <img src="{$s_thumb}" />
				  </a>
				  </p>
				  <h3>
				  <a href="./article.php?id={$art['guid']}" target="_blank" mon="col=13&amp;pn=4">
				  {$art['title']}
				  </a>
				  </h3>
				  <p class="article-text1">
				  {$art['intro']}
				  </p>
				  
				  <div class="article-info">
				  作者：<a href="./author.php?name={$art['username']}" class="article-author" target="_blank">{$art['username']}</a>
				  发表于：<span class="tm">{$art['maketime']}</span>
				  <span class="count">阅读：1029 次</span>
				  <div class="bdsharebuttonbox" >
				  <a href="#" class="bds_more" data-cmd="more"></a>
				  <a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
				  <a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
				  <a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a>
				  <a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a>
				  <a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a>
				  </div>
				  <script>
				  window._bd_share_config={
					  "common":{
						  "bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},
						  "image":{
							  "viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},
						  "selectShare":{
							  "bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}
				  };
				  with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src=
					  'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
				  </script>
				  <p class="labels">

EOT;
				  $s_art_f = <<<EOT
				  </p>
				  </div>
				  </div>
EOT;
				  $labels = get_labels_art($art['guid']);$s_art_b = "";
				  if ($labels) {
					  foreach ($labels as $label) {
						  $s_art_b .= "<span class=\"label\">" .
							  "<a class=\"labelnm\" href=\"./label?name={$label['label']}\"".
							  " target=\"_blank\">{$label['label']}</a></span>";
					  }
				  }
				  $s_arts .= $s_art_h . $s_art_b . $s_art_f;
			  }
			  print($s_arts);
		  }


		  ?>
		  
		</div>
		<div id='page_navigation' class="bar_page" style="visibility:visible;"></div>
		
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
		<div id="wrap_hot_comments">
		  <div class="cls_bar_title_left">
			<div class="cls_title_left">热门评论</div><div class="cls_subtitle_left">HOT COMMENTS<hr/></div>
		  </div>
		  <div class="cls_body_left">
			<div id="hot_comments">
			  <ul>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/e09a62646368656e6a69616e675e14" />
					<i>bdchenjiang</i>
					<span>11月22日 20:24</span>
				  </div>
				  <div class="comment-inner">
					<p>整天苹果苹果的！拿了多少宣传费？乔帮主都挂了，苹果日落西山迟早事！</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://apple.baijia.baidu.com/article/239149" target="_blank">iPhone7或将成为苹果的第一款三防手机</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/549dd1f3b4d0cba7b8e7e705" />
					<i>洋葱帅哥</i>
					<span>11月20日 20:30</span>
				  </div>
				  <div class="comment-inner">
					<p>到家手动关闭网络  就用Wi-Fi    2015年11月1日  流量就少了  用的客户端查看的 客服查看结果也是...</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://maoqiying.baijia.baidu.com/article/237619" target="_blank">工信部自曝流量不清零内幕：为了运营商营收！</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/84735a484f4e4747554fc5a9c3f1b9a4be6c" />
					<i>ZHONGGUO农民工</i>
					<span>10月30日 19:09</span>
				  </div>
				  <div class="comment-inner">
					<p>我是农民也是井底之蛙，我认为是敢不敢搞的问题，它是为了钱，你是为了活命。你首先要想的是能把它搞伤成什么样，你要是把...</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://liaobaoping.baijia.baidu.com/article/212422" target="_blank">美国军舰闯入南海，中国需要三思而行</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/d75cd0c7bfd541696f6e65b9c2b6c07b35" />
					<i>星空Aione孤独</i>
					<span>10月30日 17:51</span>
				  </div>
				  <div class="comment-inner">
					<p>可以理性地解决，但绝不是你所谓的搁置争议，共同开发，南海是我们中国人的，如果对于我们中国的土地都需要共同开发的话，...</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://liaobaoping.baijia.baidu.com/article/212422" target="_blank">美国军舰闯入南海，中国需要三思而行</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/5fd6c7e7bfd53737303131340e81" />
					<i>晴空770114</i>
					<span>10月30日 15:49</span>
				  </div>
				  <div class="comment-inner">
					<p>你是美国的走狗吧！在这说三道四的，“去你家欺负你的妻儿”，你还需要商量吗？</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://liaobaoping.baijia.baidu.com/article/212422" target="_blank">美国军舰闯入南海，中国需要三思而行</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/6733c4d6c4d6ccd48206" />
					<i>闹闹淘</i>
					<span>10月30日 14:35</span>
				  </div>
				  <div class="comment-inner">
					<p>你说的很对，老百姓就是井底之蛙，匹夫之勇。因为决策权没有，说也是废话，贪官们更不在意，因为他们经济富裕，可随意签证...</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://liaobaoping.baijia.baidu.com/article/212422" target="_blank">美国军舰闯入南海，中国需要三思而行</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/5bcbc8bcc4bebacdc9d01246" />
					<i>燃木和尚</i>
					<span>10月30日 14:22</span>
				  </div>
				  <div class="comment-inner">
					<p>只想说：这次三思，下次四思五思，再下次怕是想五思六思也没人愿意去思了1</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://liaobaoping.baijia.baidu.com/article/212422" target="_blank">美国军舰闯入南海，中国需要三思而行</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/d294b9feb9fed0c4ccacbac38c77" />
					<i>哈哈心态好</i>
					<span>10月14日 02:59</span>
				  </div>
				  <div class="comment-inner">
					<p>过几年你会对你说的话后悔，为什么说出这种没脑子的话呢 //@床垮了:越来越恶心这个女人了，就只会眼红。</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://jiangbojing.baijia.baidu.com/article/192143" target="_blank">董明珠说小米是小偷，雷军敢回应吗？</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/d294b9feb9fed0c4ccacbac38c77" />
					<i>哈哈心态好</i>
					<span>10月14日 02:59</span>
				  </div>
				  <div class="comment-inner">
					<p>没实业，互联网什么金融、平台、软件企业都要枯萎倒闭。实业才是创造真实的财富</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://jiangbojing.baijia.baidu.com/article/192143" target="_blank">董明珠说小米是小偷，雷军敢回应吗？</a>
					</span>
				  </div>
				</li>
				<li>
				  <div class="author-info">
					<img class="avt" src="http://tb.himg.baidu.com/sys/portraitn/item/f4ed7975616e686532303030400f" />
					<i>yuanhe2000</i>
					<span>10月11日 23:25</span>
				  </div>
				  <div class="comment-inner">
					<p>一配胡言，现在人们要求高了，对手机也逐渐提高了要求，你这不负责任的话是对国产手机设计者最大的伤害.中国人就要实在.</p>
				  </div>
				  <div class="comment-refer">
					<em class="comment-icon"></em>
					<span class="t">
					  来源<a href="http://baiming.baijia.baidu.com/article/189729" target="_blank">中国手机应该认清自己的现实，从中低端做起</a>
					</span>
				  </div>
				</li>
			  </ul>
			</div>
		  </div>
		</div>
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
