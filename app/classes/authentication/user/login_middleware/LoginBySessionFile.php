<?php
declare(strict_types=1);
namespace approot\classes\authentication\user\login_middleware;




/**
*
*
*/
class LoginBySessionFile extends \approot\classes\authentication\user\LoginMiddleware
{



    /**
    *
    *
    */
    public static function init(){
        $user_data = self::detectMethodLogin();

        static::$isGuest = ($user_data === false) ? true : false;

        if($user_data !== false){
            static::setIdentify($user_data);
        }    
    }



    /**
    *
    *
    */
    private static function detectMethodLogin(){

        // [1] Try to [Login by session cookies]
        if(isset($_COOKIE['PHPSESSID']) === true){
            if(is_string($_COOKIE['PHPSESSID']) !== true || $_COOKIE['PHPSESSID'] === ""){
                return false;
            }

            if(static::session_valid_id($_COOKIE['PHPSESSID']) === false)
            {
                return false;
            }

            return LoginBySessionFile::loginBySessionCookies($_COOKIE['PHPSESSID']);
        }else 

        // [2] Try to [Login by cookies]
        if(isset($_COOKIE['_identity']) === true){
            if(is_string($_COOKIE['_identity']) !== true || $_COOKIE['_identity'] === ""){
                return false;    
            }

            if(strlen($_COOKIE['_identity']) > 150)
            {
                return false;
            }

            return LoginBySessionFile::loginByCookies($_COOKIE['_identity']);
        }
        
        return false;   
    }



    /**
    *
    *
    */
    private static function loginBySessionCookies(string $id_session){

        $save_path = ini_get("session.save_path");
        if($save_path !== false && $save_path != ""){ 
            
            // ------------------
            if (file_exists($save_path."/sess_".$id_session) === true) {

                if(session_start() !== true){
                    trigger_error("session not started Class [loginBySessionCookies]".__CLASS__, E_USER_ERROR);
                    return false;
                }

                if(isset($_SESSION['id']) === false){
                    trigger_error("Array must contain user 'id' Class [loginBySessionCookies]".__CLASS__, E_USER_ERROR); 
                    return false; 
                }    

                // Get data user from database by ID
                $user_data = \app\models\UserAuthentication::verifyBySessionCookie($_SESSION['id']);
                if($user_data === false){
                    return false;
                }

                if(is_array($user_data) === false){
                    trigger_error("It is not array. Class [loginBySessionCookies]".__CLASS__, E_USER_ERROR);
                    return false;
                }

                if(count($user_data) === 0){
                    trigger_error("Array must not be empty. Class [loginBySessionCookies]".__CLASS__, E_USER_ERROR);
                    return false;
                }

                self::garbageСollector($save_path);

                return $user_data;
            } else {
                // Remove cookie
                setcookie("PHPSESSID", $id_session, time());
            }
            // ------------------
        }

        return false;
    }



    /**
    *
    *
    */
    private static function loginByCookies(string $data_cookie){

        $user_data = \app\models\UserAuthentication::verifyByCookie($data_cookie);
        if($user_data === false){
            // Remove cookie
            static::setCookie("", 0);
            return false;
        }

        if(is_array($user_data) === false){
            trigger_error("It is not array. Class [loginByCookies]".__CLASS__, E_USER_ERROR);
            return false;
        }

        if(count($user_data) === 0){
            trigger_error("Array must not be empty. Class [loginByCookies]".__CLASS__, E_USER_ERROR);
            return false;
        }

        if(isset($user_data['id']) === false){
            trigger_error("Array must contain user 'id'", E_USER_ERROR);
            return false; 
        } 

        if(session_start() !== true){
            trigger_error("session not started", E_USER_ERROR);
            return false;
        }

        $_SESSION['id'] = $user_data["id"];

        return $user_data;

    }



    /**
    *
    *
    */
    private static function garbageСollector(string $session_save_path): void{
        $gc_time = $session_save_path.'/php_session_last_gc';
        $gc_period = 86400; // Once a day. 

        if (file_exists($gc_time)) {
            if (filemtime($gc_time) < time() - $gc_period) {
                session_gc();
                touch($gc_time);
            }
        } else {
            touch($gc_time);
        }
    }


}