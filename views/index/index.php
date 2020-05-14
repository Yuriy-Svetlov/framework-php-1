<?php
use approot\classes\Sanitize;


$h2 = Sanitize::html_sanitize($data["data"]["view"]["h2"]);

?>

<div style="background-color: #e9ede9; padding: 50px;">
	<h2>
		<?php echo $h2; ?>
	</h2>

	<a target="_blank" href="//my-framework-php/AdFGFggGHhhHHyhhhbfi9878IK/debug_panhel">Debug panel</a>
	<br>
	<br>
	Examples:
	<br>
	<a target="_blank" href="//my-framework-php/my">my-framework-php/my</a>
	<br>
	<a target="_blank" href="//my-framework-php/my/post">my-framework-php/my/post</a>
</div>