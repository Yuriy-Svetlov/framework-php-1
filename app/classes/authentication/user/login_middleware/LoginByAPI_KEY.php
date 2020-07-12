<?php
declare(strict_types=1);
namespace approot\classes\authentication\user\login_middleware;





/**
* 
*
*/
class LoginByAPI_KEY extends \approot\classes\authentication\user\LoginMiddleware
{

    public static $response_data = [
        "error" => "", 
        "status" => 200,
        "data" => NULL,
    ];


    /**
    *
    *
    */
    public static function init(){

        $verify = self::verifyRequestHeaders();

        static::$isGuest = ($verify === true) ? false : true;

    }


    /**
    *
    *
    */
    private static function verifyRequestHeaders(): bool{


        if (!function_exists('getallheaders')){

            function getallheaders(){
                $headers = [];
                foreach ($_SERVER as $name => $value)
                {

                   if (substr($name, 0, 5) == 'HTTP_'){
                       $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                   }
               }
               
               return $headers;
            }
        }

        $headers = getallheaders();

        if(is_array($headers) === false){
            \approot\classes\Logger::sendToLog("getallheaders() is not array [login] Class ".__CLASS__);

            self::responseData(NULL, "Authentication required", 401);
            return false;
        }

        if(array_key_exists("Authorization", $headers) === false){
            \approot\classes\Logger::sendToLog("Key Authorization is not exists in array headers [login] Class ".__CLASS__);
        
            self::responseData(NULL, "Authentication required", 401);
            return false;
        }

        return \app\models\UserAuthentication::verifyByAPI_KEY($headers["Authorization"]);
    }



    /**
    *
    *
    */
    public static function responseData(array $data = NULL, string $error = "", int $status = 200){

        if($data != NULL){
            LoginByAPI_KEY::$response_data["data"] = $data;
        }  

        if($error != ""){
            LoginByAPI_KEY::$response_data["error"] = $error;
        } 

        if($status != 200){
            LoginByAPI_KEY::$response_data["status"] = $status;
        } 

        return LoginByAPI_KEY::$response_data;
    }


}

