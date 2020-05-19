<?php
use approot\classes\Sanitize;

$h1 = Sanitize::html($data["data"]["layout"]["h1"]);

?>
<!DOCTYPE html>
<html lang="<?php echo $this->lang; ?>">
    <head>
        <title>
            <?php echo Sanitize::html($this->title); ?>
        </title>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width,initial-scale=1">
        <?php echo $this->meta_tags; ?>
        <?php echo $this->links_head; ?>
        <?php echo $this->style; ?>

        <style type="text/css">
            header{
                background-color: #dddddd;
                padding: 10px 50px 10px 50px;
            }

            footer{
                background-color: #f4f8ff;
                padding: 10px 50px 10px 50px;
            }
        </style>
    </head>


    <body>
        <header>
            <h1>
                <?php echo $h1; ?>  
            </h1>
        </header>
 
        <div>
	        <?php echo $view; ?>
        </div>

        <footer>
            <p>
                Fouter
            </p>
        </footer>

        <?php echo $this->scripts_body; ?>
    </body>
</html>