<?php
namespace approot\classes;



/**
*
*
*/
class Request
{

    private $requestMethod;

    private $isGET = false;
    private $isPOST = false;
    private $isPUT = false;
    private $isHEAD = false;
    private $isDELETE = false;
    private $isPATCH = false;
    private $isOPTIONS = false;



    /**
    *
    *
    */
    public function init(){

        $this->requestMethod = $this->getRequestMethod();       
    }



    /**
    *
    *
    */
    private function getRequestMethod()
    {
        if(isset($_SERVER['REQUEST_METHOD']) === false){
            trigger_error("REQUEST_METHOD is not valid.", E_USER_ERROR);
            \approot\classes\ResponseCode::code(503);
        }

        $req = strtoupper($_SERVER['REQUEST_METHOD']);

        return $this->validateReqMethod($req);
    }



    /**
    *
    *
    */
    public function validateReqMethod($req){

        if($req == "GET"){
            $this->isGET = true;

        }else if($req == "POST"){
            $this->isPOST = true;

        }else if($req == "PUT"){
            $this->isPUT = true;

        }else if($req == "DELETE"){
            $this->isDELETE = true;

        }else if($req == "HEAD"){
            $this->isHEAD = true;

        }else if($req == "PATCH"){
            $this->isPATCH = true;

        }else if($req == "OPTIONS"){
            $this->isOPTIONS = true;

        }else{
            $msg = \approot\classes\Logger::sanitize("Invalid request method - ".$req);
            trigger_error($msg, E_USER_ERROR);

            \approot\classes\ResponseCode::code(503);
            return false;                
        }

        return true;        
    }



    /**
    *
    *
    */
    public function getMethod(){
        return $this->requestMethod;
    }



    /**
    *
    *
    */
    public function isGET(){
        return $this->isGET;
    }



    /**
    *
    *
    */
    public function isPOST(){
        return $this->isPOST;
    }



    /**
    *
    *
    */
    public function isPUT(){
        return $this->isPUT;
    }



    /**
    *
    *
    */
    public function isHEAD(){
        return $this->isHEAD;
    }



    /**
    *
    *
    */
    public function isDELETE(){
        return $this->isDELETE;
    }



    /**
    *
    *
    */
    public function isPATCH(){
        return $this->isPATCH;
    }



    /**
    *
    *
    */
    public function isOPTIONS(){
        return $this->isOPTIONS;
    }



    /**
    *
    *
    */
    public static function getParamGET($v){
        
        if(empty($_GET[$v]) !== true && is_string($_GET[$v]) === true){
            return $_GET[$v];
        }
        return NULL;
    }          



    /**
    *
    *
    */
    public static function getJSON(){
        
        $json = file_get_contents('php://input');
        if($json === false){
            return NULL;
        }

        if(is_string($json) === false){
            return NULL;
        }
        
        return json_decode($json, true);
    }  



    /**
    * 301 Moved Permanently
    * 302 Found, 302 Moved Temporarily
    */
    public function redirect(string $url, int $statusCode = 302): void{
        header('Location: '.$url, true, $statusCode);
        exit();        
    }



}