<?php
namespace approot;



/**
*
*
*/
class AppRouting
{


    private $url;
    private $app;



   function __construct(App $app) {
       $this->app = $app;
       $this->url = parse_url("http://myapp.com".$_SERVER["REQUEST_URI"], PHP_URL_PATH);
   }



    /**
    * For routing all or selectively requests
    *
    * @param string|regexp $url URL routing or regular expression which require set 'true' for $regex
    * @param classlink $controller Controller class
    * @param string $fun URL Controller function  
    * @param false|array $request_method 'false' - all request methods are allowed  or array of allow request methods      
    * @param boolean $reg_exp if 'true' will be use regular expression in $url     
    *
    * @return boolean false is not match URL or not match request method
    *   
    * @example $this->req('/upload/post', '\app\controllers\MyController', 'index')
    * @example $this->req('/upload/post', '\app\controllers\MyController', 'index', ['GET']) 
    * @example $this->req("/^\/upload\/post.*$/", '\app\controllers\MyController', 'index', ['GET'], true)       
    */        
    protected function req($url, $controller, $fun, $request_method = false, $reg_exp = false){

        if($request_method !== false){
            if(in_array($this->app::$request->getMethod(), $request_method) === false){
                return false;
            }
        }

        $arr = [];
        $arr["action"] = $fun;

        if(!$reg_exp){
            if($this->url === $url){
                (new $controller($arr))->$fun();
                return true;
            }
        }else{
            if(preg_match($url, $this->url)){                
                (new $controller($arr))->$fun();
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
            if(in_array($this->app::$request->getMethod(), $request_method) === false){
                return false;
            }
        }

        if(!$reg_exp){
            if(preg_match('/^'.preg_quote($url, '/').'.*$/', 
                $this->url)){
                return true;
            }
        }else{
            if(preg_match($url, $this->url)){
                return true;
            } 
        }
 
        return false;             
    }



}



