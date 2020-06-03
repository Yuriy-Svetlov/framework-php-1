<?php
use approot\classes\Sanitize;

$h1 = Sanitize::html($data["data"]["view"]["h1"]);
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
$style = file_get_contents($approot."media/views/index/index/css/index.css");
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
$script = file_get_contents($approot."media/views/index/index/js/index.js");
$this->addScriptBody("<script>$script</script>");
//---------------------------------
//======================================


?>


<header>
    <h1>
        <?php echo $h1; ?>  
    </h1>
</header>


<div style="background-color: #e9ede9; padding: 50px;">
	<h2>
		<?php echo $h2; ?>
	</h2>

	<a target="_blank" href="/AdFGFggGHhhHHyhhhbfi9878IK/debug_panhel">
		Debug panel
	</a>



	<!-- =================== -->
	<hr>
	[request] GET "/api" (without authentication)
	<br>
	[response]: data <strong>must be valid</strong> in model.
	<br>
	<a target="_blank" href="/api?userid=3535">
		/api
	</a>


	<hr>
	[request] GET "/api" (without authentication)
	<br>
	[response]: data <strong>must not be valid</strong> in model.
	<br>
	<a target="_blank" href="/api?userid=3535uuu">
		/api
	</a>
	<hr>
	<!-- =================== -->





	<!-- =================== -->
	[request] GET "/api/post" (with authentication by API_KEY)
	<br>
	[response]: data <strong>must be valid</strong> in model.
	<br>
	<button id="api_post_2__BUT__GET" style="margin-top: 10px;" class="button__GI_m1">
		Get username
	</button> 
	<div id="api_post_2__result"></div>
	<hr>


	[request] GET "/api/post" (with authentication by API_KEY)
	<br>
	[response]: data <strong>must not be valid</strong> in model.
	<br>
	<button id="api_post_1__BUT__GET" style="margin-top: 10px;" class="button__GI_m1">
		Get username
	</button> 
	<div id="api_post_1__result"></div>
	<hr>
	<!-- =================== -->






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

	<div style="padding-top: 10px; padding-bottom: 200px; box-sizing: border-box;">
		<hr>
		Test private pages
		<br>
	    <a style="color: #dfdfdf; color: blue;" href="/privpage">Private page</a>
	    <br>
	    <a style="color: #dfdfdf; color: blue;" href="/logout">Logout</a>
	</div>
</div>


