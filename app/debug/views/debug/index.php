<?php

$url_log_delete = $data["data"]["url_log_delete"];

?>

<div id="root_view" data-page-id="<?php echo $data["data"]["page_id"]; ?>" style="width: 90%; margin: 0 auto; background-color: white; padding: 10px; box-sizing: border-box;">

	<h2 style="margin: 0px; padding: 5px 0px 5px 0px; box-sizing: border-box; font-size: 18px; ">
		<?php echo $data["data"]["header_html"]; ?>
	</h2>

	<div style="padding: 5px 0px 10px 0px; box-sizing: border-box;">
		<button onclick="clearLog(<?php echo "'" . $url_log_delete . "'" ?>)" class="button2">Crear log</button>
	</div>	

	<div style="background-color: white; padding: 10px; box-sizing: border-box; height: 500px; overflow-y: scroll; border: 1px solid #e5e5e5; border-radius: 5px; ">
	<?php echo $data["data"]["log"]; ?>
	</div>

</div>