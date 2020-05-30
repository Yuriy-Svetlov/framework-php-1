<?php
use approot\classes\Sanitize;
use approot\App;

$user_identify = App::$user::getIdentify();

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
            body{
                margin: 0px;
                background-color: #f2f2f2;
            }

            nav{
                padding: 12px 30px 12px 10px;
                background-color: #706f6f;
                text-align: right; 
                font-size: 16px;
            }

            header{
                background-color: #dddddd;
                padding: 5px 50px 5px 50px;
            }

            footer{
                background-color: #f4f8ff;
                padding: 0px 50px 0px 50px;
            }

            .footer {
              position: fixed;
              left: 0;
              bottom: 0;
              width: 100%;
              background-color: #c8c8c8;
              color: white;
              text-align: center;
            }

            nav > a{
                margin-right: 20px;
            }        
        </style>

    </head>

            
    <body>

        <nav>
            <a style="color: #dfdfdf;" href="/">Home</a>

            <?php if(App::$user::isGuest() === true){ ?>
                <a style="color: #dfdfdf;" href="/login">Login</a>
            <?php }else{ ?>
                <a style="color: #dfdfdf;" href="/privpage">Private page</a>
                <a style="color: #dfdfdf;" href="/logout">Logout - (<?php echo $user_identify["username"] ?>)</a>
            <?php } ?>
        </nav>

        <div>
	        <?php echo $view; ?>
        </div>

        <footer class="footer">
            <p>Footer</p>
        </footer>

        <?php echo $this->scripts_body; ?>
    </body>
</html>