<?php
namespace approot\debug;



/**
*
*
*/
class AppDebug
{



    /**
    *
    *
    */
    public function init($app)
    {

    	// Routing to Controller
    	$this->init_routing($app);
    }



    /**
    *
    *
    */
    private function init_routing($app){
        $url = parse_url("http://myapp.com".$_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $web_config = $app->getConfig();
        $debug_url = $web_config["debug_panel"]["panel_url"];
        
        // [Index]
        if($url === "/".$debug_url){
            $this->access_ip($app->getConfig());
            (new \approot\debug\controllers\DebugController())->index();
            die();

        }else if($url === "/".$debug_url."/error_log"){
            $this->access_ip($app->getConfig());
            (new \approot\debug\controllers\DebugController())->errorLog();
            die();  

        }else if($url === "/".$debug_url."/validation_log"){
            $this->access_ip($app->getConfig());
            (new \approot\debug\controllers\DebugController())->errorValidationLog();
            die();          
        }
    }



    /**
    *
    *
    */
    private function access_ip($web_config){
        if (in_array(@$_SERVER['REMOTE_ADDR'], $web_config["debug_panel"]["allow_ips"]) == false) {
            \approot\classes\ResponseCode::code(404);
        } 
    }


}



