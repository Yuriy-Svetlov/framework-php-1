<?php
namespace approot;

use approot\classes\Request;
use approot\classes\Logger;
use app\config\routing\Routing;


/**
*
*
*/
class App
{
    private static $config;
    public static $request;
    public static $user = "\approot\classes\authentication\User";


    /**
    *
    *
    */
    final public function init($config)
    {
    	defined('APP1_DEBUG') or define('APP1_DEBUG', false);
        defined('APP1_ENV') or define('APP1_ENV', 'prod'); 

        // Web config
        self::$config = $config;

        // Logger
        if($config["logger"]["default"]["init"] === true){
            Logger::init($this);
        }

        // Define request
        (static::$request = new Request())->init();

        // Debug panel 
        if(constant("APP1_DEBUG") === true){
            (new \approot\debug\AppDebug())->init($this);
        }

        // Routing
        (new Routing($this))->init();
    }



    /**
    *
    *
    */
    final public static function getConfig(){
    	return self::$config;
    }



    /**
    *
    *
    */
    final public static function getAppRoot(){
        return __DIR__."/../";
    }
    
}



