<?php


$approot = \approot\App::getAppRoot();


// [Adding <style> in layout]
//---------------------------------
$style = file_get_contents($approot."media/common/css/index.css");
$this->addStyle('<style type="text/css">'.$style.'</style>');
//---------------------------------

// [Adding <style> in layout]
//---------------------------------
$style = file_get_contents($approot."media/views/index/login/css/login.css");
$this->addStyle('<style type="text/css">'.$style.'</style>');
//---------------------------------

// [Adding <script> as code in layout]
//---------------------------------
$script = file_get_contents($approot."media/views/index/login/js/login.js");
$this->addScriptBody("<script>$script</script>");
//---------------------------------
?>


<div style="padding-top: 130px; box-sizing: border-box; width: 250px; margin: 0 auto;">
	<div style="background-color: #e9ede9; padding: 30px 15px; box-sizing: border-box;">

	  	<form>
		    <label for="username_INPUT">Username</label>
		    <input type="text" id="username_INPUT" name="username" value="admin" placeholder="Your name..">
		    <div id="username" class="error"></div>


		    <label for="password_INPUT">Password</label>
		    <input type="text" id="password_INPUT" name="password" value="admin" placeholder="Your password..">
		    <div id="password" class="error"></div>

		    <!-- Checkbox -->
            
            <input type="checkbox" id="save_login_CHECKBOX" name="save_login" value="0">
            <label for="save_login_CHECKBOX">Save login</label>

            <br>

            <!-- Button -->
		    <button id="login_BUT" type="button" style="margin-top: 15px;" class="button__GI_m1">Sign in</button>
	  	</form>

	</div>
</div>

