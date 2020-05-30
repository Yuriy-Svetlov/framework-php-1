<?php
declare(strict_types=1);
namespace approot\classes\authentication\user\login_middleware;



/**
*
*
*/
class Login extends \approot\classes\authentication\user\LoginMiddleware
{



    /**
    *
    * $seconds (int) default 90 days = 7776000 sec
    */
    final public static function login(array $user_data, bool $save_user_login = false, int $seconds = 7776000): bool{

        if(isset($user_data['id']) === false){
            trigger_error("Array must contain user 'id'", E_USER_WARNING);
            return false; 
        }  

        if($save_user_login === false){

            return Login::startSession($user_data);
        }else{

            if(isset($user_data['auth_key']) === false){
                trigger_error("Array must contain 'auth_key'", E_USER_WARNING);
                return false; 
            } 

            if(static::setCookie($user_data['auth_key'], $seconds) === false){
                trigger_error("Cookie do not setted.", E_USER_WARNING);
            }

            return Login::startSession($user_data);
        }

        return false;
    }




    /**
    *
    *
    */
    private static function startSession(array $user_data){
        if(session_start() === true){
            $_SESSION['id'] = $user_data["id"];
            static::$isGuest = false;
            static::setIdentify($user_data);
            return true;
        }

        trigger_error("session not started", E_USER_ERROR); 
        return false;
    }



    /**
    *
    *
    */
    final public static function logout(){
        // Remove session cookie
        setcookie("PHPSESSID", "", time());  

        // Remove cookie
        static::setCookie("", 0);

        // Remove session
        $_SESSION = [];
        session_destroy();
    }


}