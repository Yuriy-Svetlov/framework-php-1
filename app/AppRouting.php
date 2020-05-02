<?php
namespace app;



class AppRouting
{



    /**
    * For routing all requests
    *
    * @param string|regexp $url URL routing or regular expression which require set 'true' for $regex
    * @param classlink $controller Controller class
    * @param string $fun URL Controller function  
    * @param false|array $request_method 'false' - all request methods are allowed  or array of allow request methods      
    * @param boolean $reg_exp if 'true' will be use regular expression in $url     
    *
    * @return boolean false is not match URL or not match request method
    *   
    * @example $this->all("/upload/post", \app\controllers\MyController::class, "index")
    * @example $this->all("/upload/post", \app\controllers\MyController::class, "index", ["GET"]) 
    * @example $this->all("/^\/upload\/post$/", \app\controllers\MyController::class, "index", ["GET"], true)       
    */        
    protected function all($url, $controller, $fun, $request_method = false, $reg_exp = false){

        if($request_method !== false){
            if(!in_array(@$_SERVER['REQUEST_METHOD'], $request_method)){
                return false;
            }
        }

        if(!$reg_exp){
            if($_SERVER['REQUEST_URI'] === $url){
                (new $controller())->$fun();
                return true;
            }
        }else{
            if(preg_match($url, $_SERVER['REQUEST_URI'])){
                (new $controller())->$fun();
                return true;
            } 
        }

        return false;       
    }



    /**
    * For group routing
    *
    * @param string|regexp $url URL routing or regular expression which require set 'true' for $regex
    * @param false|array $request_method 'false' - all request methods are allowed  or array of allow request methods
    * @param boolean $reg_exp if 'true' will be use regular expression in $url   
    *
    * @return boolean false is not match URL or not match request method
    *   
    * @example $this->group("/upload") // all request methods are allowed
    * @example $this->group("/upload", ["POST","PUT","GET"]) 
    * @example $this->group("/^\/upload\/post.+$/", ["POST","PUT","GET"], true)        
    */
    protected function group($url, $request_method = false, $reg_exp = false){
        
        if($request_method !== false){
            if(!in_array(@$_SERVER['REQUEST_METHOD'], $request_method)){
                return false;
            }
        }

        if(!$reg_exp){
            if(preg_match('/^'.preg_quote($url, '/').'.*$/', 
                $_SERVER['REQUEST_URI'])){
                return true;
            }
        }else{
            if(preg_match($url, $_SERVER['REQUEST_URI'])){
                return true;
            } 
        }
 
        return false;             
    }



    protected function error404(){
        http_response_code(404);
        die();
    }



}



