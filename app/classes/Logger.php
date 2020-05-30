<?php
namespace approot\classes;


/**
*
* 
*/
class Logger
{



    /**
    *    https://www.php.net/manual/ru/errorfunc.constants.php
    */
    public static function init($app): void
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

        if(constant("APP1_DEBUG") === true){
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


        $path_log = $app::getConfig()["app"]["error_log"];

        if(\approot\classes\Files::createFile($path_log) === true){
            ini_set("error_log", $path_log);
        }
    }



    /**
    *
    * @example \approot\classes\Logger::sendToLog(string $msg);
    */
    public static function sendToLog($msg): void{
        $path_log = \approot\App::getConfig()["app"]["error_log"];

        $msg = "[".date("d-M-Y H:i:s")."] ".$msg.PHP_EOL;

        if(error_log(addslashes($msg), 3, $path_log) !== true){
            trigger_error("Does not writed - error_log", E_USER_ERROR);
        }        
    }



}