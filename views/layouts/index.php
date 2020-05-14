<?php
use approot\classes\Sanitize;


$title = Sanitize::html_sanitize($data["data"]["layout"]["title"]);
$h1 = Sanitize::html_sanitize($data["data"]["layout"]["h1"]);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?php echo $title; ?>
        </title>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width,initial-scale=1">
    </head>


    <body>

        <header style="background-color: #dddddd; padding: 50px;">
            <h1>
                <?php echo $h1; ?>  
            </h1>
        </header>
 
        <div>
	        <?php 
                if(is_array($data) === true){
                    if (array_key_exists('view', $data)) {
                        require $data["view"]; 
                    }
                }
            ?>
        </div>

        <footer style="background-color: #f4f8ff; padding: 50px;">
            <p>
                Fouter
            </p>
        </footer>


        

    </body>
</html>