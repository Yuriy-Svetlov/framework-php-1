<?php
declare(strict_types=1);
namespace app\models;



/**
*
*
*/
class UserAuthentication implements \approot\classes\authentication\interfaces\UserIdentity
{


    //const COOKIE_KEY = "dj]2@fh`H[BNЁё~JJJ/u$uy%H4^hgt!*TY-hhjNMju=u888.,JuJm";



    /**
    *
    *
    */
    public static function verifyBySessionCookie(string $id)
    {
        // [1] Find in database by user ID
        // [2] Check user access 

        /*
        if($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']){
            // Remove session
            setcookie("PHPSESSID", "", time());
            $_SESSION = [];
            session_destroy();
            return false; 
        }
        */
        if($id !== "123"){
            return false;
        }

        return [
            "id" => "123", 
            "username" => "admin", 
            //"password" => "admin",
            'ban' => '0',
            "auth_key" => "qwerty-123"
        ];
    }



    /**
    *
    *
    */
    public static function verifyByCookie(string $data_cookie)
    {
        // [1] Get from cookie user ID and find in database user ID
        // [2] Check user access (Check fingerprint + other)

        /*
        if($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']){
            // Remove session
            setcookie("PHPSESSID", "", time());
            $_SESSION = [];
            session_destroy();
            return false; 
        }
        */

        
        if($data_cookie !== "gen_new_key-123"){
            return false;
        }

        return [
            "id" => "123", 
            "username" => "admin", 
            //"password" => "admin",
            'ban' => '0',
            "auth_key" => "gen_new_key-123"
        ];
    }









}
