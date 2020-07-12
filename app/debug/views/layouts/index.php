<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Debug panel</title>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width,initial-scale=1">
    </head>

    <style type="text/css">

    	body{
    		margin: 0; 
    		padding: 0px;
    	}

    	nav{
            position: fixed;
    		width: 100%; 
    		background-color: #f1eeee; 
    		padding: 10px;
    	}

        .button, .button2 {
            padding: 8px 12px; 
            border: none;
            text-decoration: none; 
            border-radius: 2px; 
            box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px, rgba(0, 0, 0, 0.12) 0px 1px; 
            background-color: #8179f9;
            box-sizing: border-box; 
            color: white; 
            cursor: pointer;    
            outline: none;  
            font-size: 13px;
            font-family:  Roboto, Arial, sans-serif; 

            -moz-user-select: none !important;
            -webkit-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
            -o-user-select: none !important;
            user-select: none !important;       
        } 

        .button:hover{
            outline: none;
            background-color: #9d96fb;
        }
        .button:active{
            outline: none;
            background-color: #a59ffd;
            box-shadow: rgba(0,0,0,.12) -1px 4px 11px 0px, rgba(0,0,0,.12) 0 1px 1px 1px;
        }
        .button:focus {
            outline: none;
        } 




        .button2{
            padding: 8px 12px; 
            box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px, rgba(0, 0, 0, 0.12) 0px 1px; 
            background-color: #fff;
            color: #5a5a5a;
        } 

        .button2:hover{
            background-color: #eaeaea;
        }
        .button2:active{
            background-color: #eaeaea;
            box-shadow: rgba(0,0,0,.12) -1px 4px 11px 0px, rgba(0,0,0,.12) 0 1px 1px 1px;
        }
        .button2:focus {
            outline: none;
        }

        input{
            width: 50px;
        }	

        a{
            text-decoration: none;
        }
    </style>

    <body>
    	<nav>
    		<a id="log_error__A" href="#">
                <button class="button">
                    Show - error log
                </button>
            </a>
            <input id="log_error__INPUT" type="number" value="50">

            <a id="log_valid__A" href="#">
                <button style="margin-left: 30px;" class="button">
                    Show - validation log
                </button>
            </a>
            <input id="log_valid__INPUT" type="number" value="0">
    	</nav>

        <div style="padding-top: 50px; box-sizing: border-box;">
	       <?php echo $view; ?>
        </div>



        <script>
            const $log_error__INPUT = document.getElementById('log_error__INPUT'), 
                  $log_error__A = document.getElementById('log_error__A'),
                  $log_valid__INPUT = document.getElementById('log_valid__INPUT'),
                  $log_valid__A = document.getElementById('log_valid__A');

            var number_line = <?php echo '"'.$data["data"]["number_line"].'"' ?>,
                URL__error_log = "/"+<?php echo '"'.$data["data"]["panel_url_debug"].'"' ?>,
                $root_view = document.getElementById("root_view");


            // Init
            //---------------
            if($root_view != null){
                if($root_view.getAttribute("data-page-id") === "error_log"){
                    $log_error__INPUT.value = number_line;
                    $log_valid__INPUT.value = 50;

                    setURL($log_error__A, URL__error_log+"/error_log?number="+number_line);
                    setURL($log_valid__A, URL__error_log+"/validation_log?number="+50);                
                }else{
                    $log_error__INPUT.value = 50;
                    $log_valid__INPUT.value = number_line; 

                    setURL($log_error__A, URL__error_log+"/error_log?number="+50);
                    setURL($log_valid__A, URL__error_log+"/validation_log?number="+number_line);                               
                }
            }else{
                $log_error__INPUT.value = 50;
                $log_valid__INPUT.value = 50; 
                setURL($log_error__A, URL__error_log+"/error_log?number="+50);
                setURL($log_valid__A, URL__error_log+"/validation_log?number="+50);
            }
            //---------------            
            

            
            // Error log
            $log_error__INPUT.addEventListener('input', function(e){
                number_line = e.target.value;

                setURL($log_error__A, URL__error_log+"/error_log?number="+number_line);
                setURL($log_valid__A, URL__error_log+"/validation_log?number=50");
            });


            // Validation log
            $log_valid__INPUT.addEventListener('input', function(e){
                number_line = e.target.value;

                setURL($log_valid__A, URL__error_log+"/validation_log?number="+number_line);
                setURL($log_error__A, URL__error_log+"/error_log?number=50");
            });



            // Clear log
            function clearLog(url_log_delete){
                var $url = "//" + window.location.host + "/" + url_log_delete;
                console.log($url);
                sendRequest__DELETE($url);
            }



            function setURL($obj, url){
                $obj.href = url;
            }



            function sendRequest__DELETE(url){
                var xhr = new XMLHttpRequest();
                xhr.open("DELETE", url, true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function () {
                    
                    //----------------
                    if (xhr.readyState === 4) {
                        if(xhr.status === 200){

                            if(isJsonString(xhr.responseText)){
                                var json = JSON.parse(xhr.responseText);
                                if(json.status === "OK"){
                                    window.location.reload(false);
                                    return;
                                }
                            }
                        }
                        alert("Server error");
                    }
                    //----------------

                };
                var data = JSON.stringify({});
                xhr.send(data);
            }
            

            function isJsonString(str) {
                try {
                    JSON.parse(str);
                } catch (e) {
                    return false;
                }
                return true;
            }


        </script>

    </body>
</html>