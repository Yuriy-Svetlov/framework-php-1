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
        if($_SERVER['REQUEST_URI'] === "/".$web_config["debug_panel"]["panel_url"]){
            
            var_dump("expression");
            die();
        }
    }



}



