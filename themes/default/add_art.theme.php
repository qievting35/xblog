<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>符动乾坤 - 发布新的文章</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<link href="../plugins/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" charset="utf-8" src="../plugins/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../plugins/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="../plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
  </head>
  <body style="background-color:silver;" onLoad="OnLoad()">
	<div style="background-color:silver;margin-left: auto;margin-right: auto;width:800px;">
      <h1  style="text-align:center;">发布新的文章</h1>
	  <p>
		<span style="width:75px;">文章分类: </span>
		<select onchange="on_set_category(this)" name="art_category" id="art_category" style="width:150px;height:32px;">
		  <?php
		  // 输出文章分类列表
		  $cates = get_category();
		  if ($cates){
			  foreach ($cates as $cate) {
				  print('<option value =' . strval($cate['id']) . '>' . $cate['name'] . '</option>');
			  }
		  }
		  ?>
		</select>
	  </p>
	  <p>
		<span style="width:75px;">文章标题: </span>
		<input name="art_title" type="text" id="art_title" style="width:400px;height:24px;">
	  </p>
	  <p>
		<div style="width:75px;">内容简介: </div>
		<textarea name="art_intro" id="art_intro" style="margin-left:75px;width:400px;height:80px;"></textarea>
	  </p>
	  <p>
		<span style="width:75px;">缩略图片: </span>
		<input readonly name="art_thumb" type="text" id="art_thumb" name="art_thumb" style="width:400px;height:24px;">
		<input type="button" name="btn_get_thumb" value=" ... " onClick="up_thumb();">
	  </p>
	  <p>
		<span style="width:75px;">幻灯图片: </span>
		<input readonly name="art_slide" type="text" id="art_slide" name="art_slide" style="width:400px;height:24px;">
		<input type="button" name="btn_get_slide" value=" ... " onClick="up_slide();">　</p>
	  </p>
	  <p>
	  <span style="width:75px;">文章标签: </span>
	  <input name="art_labels" type="text" id="art_labels" style="width:715px;height:24px;">
	  </p>
	  
	  <script id="editor" type="text/plain" style="width:100%;height:300px;"></script>
	  <script id="editor_thumb" type="text/plain" style="width:800px;height:500px;"></script>
	  <script id="editor_slide" type="text/plain" style="width:800px;height:500px;"></script>
	  
	</div>

	<script type="text/javascript">

	// 创建主编辑器
	var ue = UE.getEditor('editor',{
		initialFrameWidth :800,//设置编辑器宽度
		initialFrameHeight:300,//设置编辑器高度
		scaleEnabled:false
	});

	// ueditor内容变化事件
	ue.addListener( "contentchange", function () {
		document.getElementById("frm_commit").content.value = ue.getContent();
    } );

	// 用来接收缩略图的编辑器
	var editor_thumb = UE.getEditor('editor_thumb');
	editor_thumb.ready(function () {
		editor_thumb.hide();
		editor_thumb.addListener('beforeInsertImage', function (t, arg) {
			document.getElementsByName("art_thumb")[0].value=arg[0].src;
			document.getElementById("frm_commit").thumb.value=arg[0].src;
		});
	});
	// 打开缩略图选择对话框
	function up_thumb() {
		var myImage = editor_thumb.getDialog("insertimage");
		myImage.open();
	}

	// 用来接收幻灯图的编辑器
	var editor_slide = UE.getEditor('editor_slide');
	editor_slide.ready(function () {
		editor_slide.hide();
		editor_slide.addListener('beforeInsertImage', function (t, arg) {
			document.getElementsByName("art_slide")[0].value=arg[0].src;
			document.getElementById("frm_commit").slide.value=arg[0].src;
		});
	});
	// 打开幻灯图选择对话框
	function up_slide() {
		var myImage = editor_slide.getDialog("insertimage");
		myImage.open();
	}

	// 提交文章内容
	function up_all(){
		if (!UE.getEditor('editor').hasContents()){
			alert('请先填写内容!');
			return false;
		}
		return true;
	}

	// 文章分类设置事件处理
	function on_set_category(obj)
	{
		document.getElementById("frm_commit").category.value = obj.value;
	}
	
	// 标题内容发生变化处理过程
	var element_title = document.getElementById("art_title");
	if("\v"=="v") {
		element_title.onpropertychange = title_change;
	}else{
		element_title.addEventListener("input",title_change,false);
	}
	function title_change(){
		document.getElementById("frm_commit").title.value = document.getElementById("art_title").value;
	}

	// 简介内容发生变化处理过程
	var element_intro = document.getElementById("art_intro");
	if("\v"=="v") {
		element_intro.onpropertychange = intro_change;
	}else{
		element_intro.addEventListener("input",intro_change,false);
	}
	function intro_change(){
		document.getElementById("frm_commit").intro.value = document.getElementById("art_intro").value;
	}

	// 标签内容发生变化处理过程
	var element_labels = document.getElementById("art_labels");
	if("\v"=="v") {
		element_labels.onpropertychange = labels_change;
	}else{
		element_labels.addEventListener("input",labels_change,false);
	}
	function labels_change(){
		document.getElementById("frm_commit").labels.value = document.getElementById("art_labels").value;
	}
	
	</script>

	<div style="width:800px;height:36px;padding-top:16px;background-color:silver;margin-left:auto;margin-right: auto;">
	  <div style="float:right;width:55px;height:100%;margin:0px;padding:0px;">
		<form id="frm_commit" method="post"  action = 'show.php' target='mainFram' onsubmit="return up_all();">
		  <input name="category" type="hidden" id="category" value="<?php
																	if ($cates){
																		foreach ($cates as $cate) {
																			print(strval($cate['id']) . '" />');break;
																		}
																	} else {print('" />');}
																	?>
		  <input name="title" type="hidden" id="title" />
		  <input name="intro" type="hidden" id="intro" />
		  <input name="thumb" type="hidden" id="thumb" />
		  <input name="slide" type="hidden" id="slide" />
		  <input name="labels" type="hidden" id="labels" />
		  <input name="content" type="hidden" id="content" />
		  <input type="submit" name="Submit" value=" 提交 " />　
		</form>
	  </div>
	</div>
	<script type="text/javascript" src="../plugins/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
	<script type="text/javascript">      
	$(function(){
		SyntaxHighlighter.all();
	});
	</script>
  </body>
</html>
