<?php
namespace app;

use app\config\routing\Routing;





class App
{

    public function init()
    {
    	defined('APP1_DEBUG') or define('APP1_DEBUG', false);
        defined('APP1_ENV') or define('APP1_ENV', 'prod'); 

        $debug = constant("APP1_DEBUG");

        // Log
        $this->settingLog($debug);

        // Routing
        (new Routing())->init(); 
    }





    private function settingLog($debug)
    {
		//-----------
		/*
		; display_errors
		;   Default Value: On
		;   Development Value: On
		;   Production Value: Off

		; display_startup_errors
		;   Default Value: Off
		;   Development Value: On
		;   Production Value: Off

		; error_reporting
		;   Default Value: E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
		;   Development Value: E_ALL
		;   Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT

		; log_errors
		;   Default Value: Off
		;   Development Value: On
		;   Production Value: On
		*/

		if($debug){
			// FOR DEV
			error_reporting(E_ALL);
			ini_set("display_errors", 1);
			ini_set("display_startup_errors", 1);
		}else{
			// FOR PROD
			error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
			ini_set("display_errors", 0);
		}

		ini_set("log_errors", 1);

		$path_log = __DIR__ . '/../runtime/logs/error.log';

		$file_create = true;
		if (file_exists($path_log) !== true) {   
			if(!fopen($path_log, "w")){
				$file_create = false;
			}
		}	

		if($file_create){
			ini_set("error_log", $path_log);
		}
		//-----------
    }

}



