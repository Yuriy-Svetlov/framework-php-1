<?php
use approot\classes\Sanitize;


$h2 = Sanitize::html($data["data"]["view"]["h2"]);

//======================================
// HEAD
//======================================

// [Change lang in layout]
$this->lang = "fr";


// [Change title in layout]
$this->title = "Change Title!";


// [Adding <meta> in layout]
$this->addMetaTag('<meta name="GENERATOR" content="Microsoft FrontPage 4.0">');



$approot = \approot\App::getAppRoot();

// [Adding <style> in layout]
//---------------------------------
$style = file_get_contents($approot."views_media/index/css/index.css");
$this->addStyle('<style type="text/css">'.$style.'</style>');
//---------------------------------



// [Adding <link> in layout]
//---------------------------------
$link_css = "/media/css/test_tag_link.css";
$this->addLinkHead('<link rel="stylesheet" href="'.$link_css.'">');
//---------------------------------
//======================================



//======================================
// BODY
//======================================

// [Adding <script> as link in layout]
//---------------------------------
$link_js = "/media/js/link.js";
$this->addScriptBody('<script src="'.$link_js.'"></script>');
//---------------------------------


// [Adding <script> as code in layout]
//---------------------------------
$script = file_get_contents($approot."views_media/index/js/index.js");
$this->addScriptBody("<script>$script</script>");
//---------------------------------
//======================================


?>

<div style="background-color: #e9ede9; padding: 50px;">
	<h2>
		<?php echo $h2; ?>
	</h2>

	<a target="_blank" href="/AdFGFggGHhhHHyhhhbfi9878IK/debug_panhel">
		Debug panel
	</a>
	<br>
	<a target="_blank" href="/my">
		test - is not valid data in model (/my)
	</a>
	<br>
	<a target="_blank" href="/my/post">
		test - is valid data in model (/my/post)
	</a>

	<hr>

	<div style="padding-top: 10px;">
		Test adding style link to head.
		<br>
		<div class="test_tag_link" style="padding: 10px; width: 100%;">		
			Here background color should be orange
		</div>
	</div>	

	<div style="padding-top: 10px;">
		<hr>
		Check added script in body of layout
		<br>
		<button id="but2" style="margin-top: 10px;">
			Click me
		</button>
	</div>

	<div style="padding-top: 10px;">
		<hr>
		Check added script in body of layout
		<br>
		Check added style in head of layout
		<br>
		
		<button id="but1" style="margin-top: 10px;" class="button__GI_m1">
			Click me
		</button>
	</div>
</div>


