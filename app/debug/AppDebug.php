<?php
namespace approot\debug;



class AppDebug
{

    public function init($web_config)
    {
    	// Check access for IPs
    	$this->access_ip($web_config);

    	// Routing to Controller
    	$this->routing($web_config);
    }




    private function access_ip($web_config){
		if (!in_array(@$_SERVER['REMOTE_ADDR'], $web_config["debug_panel"]["allow_ips"])) {
			http_response_code(404);
			die();
		} 
    }


    private function routing($web_config){
        $url = parse_url("http://myapp.com".$_SERVER["REQUEST_URI"], PHP_URL_PATH);

        // [Index]
        if($url === "/".$web_config["debug_panel"]["panel_url"]){
            (new \approot\debug\controllers\DebugController())->index();
            die();
        }
    }

}



