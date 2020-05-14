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
    	// Check access for IPs
    	$this->access_ip($app->getConfig());

    	// Routing to Controller
    	$this->init_routing($app->getConfig());
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



    /**
    *
    *
    */
    private function init_routing($web_config){
        $url = parse_url("http://myapp.com".$_SERVER["REQUEST_URI"], PHP_URL_PATH);

        $debug_url = $web_config["debug_panel"]["panel_url"];
        // [Index]
        if($url === "/".$debug_url){
            (new \approot\debug\controllers\DebugController())->index();
            die();

        }else if($url === "/".$debug_url."/error_log"){
            (new \approot\debug\controllers\DebugController())->errorLog();
            die();  

        }else if($url === "/".$debug_url."/validation_log"){
            (new \approot\debug\controllers\DebugController())->errorValidationLog();
            die();          
        }
    }



}



