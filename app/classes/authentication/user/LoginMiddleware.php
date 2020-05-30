<?php
declare(strict_types=1);
namespace approot\classes\authentication\user;





/**
*
*
*/
class LoginMiddleware extends \approot\classes\authentication\User
{


    /**
    *
    *
    */
    protected static function setCookie($data, $seconds){

        $config = \approot\App::getConfig()["app"]["authentication"]["cookies"];

        return setcookie( "_identity", $data, 
        [
            "expires" => time()+$seconds,
            "path" => "/",
            "domain" => "",
            "secure" => $config["secure"],
            "httponly" => $config["httponly"],
            "samesite" => $config["samesite"],
        ]);
    }



    /**
    *
    *
    */
    protected static function session_valid_id($session_id)
    {
        return preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $session_id) > 0;
    }

}