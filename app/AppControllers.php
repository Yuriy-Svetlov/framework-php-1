<?php
namespace approot;



class AppControllers
{


  	function __construct(){
        $this->beforeInit();
  	    $this->init();
  		$this->afterInit();
    }


    protected function beforeInit(){
        // clear the old headers
        header_remove();
    }


    protected function init(){
        
    }


    protected function afterInit(){
        
    }



    /**
    * Response of data in JSON format
    *
    * @param array $data JSON data
    * @param bool $resp_code Code HTTP response, default 200. If will be 'false' HTTP code will not be setted. 
    * @param bool $header Header HTTP response, default is 'Content-Type: application/json', if will set 'false' this header will not be sended. 
    *   
    * @example $this->json_response(["status" => "1"]) 
    * @example $this->json_response(["status" => "1"], false, false)         
    */  
    protected function json_response($data, $resp_code = true, $header = true){

        if($resp_code){
            http_response_code(200);
        }

        if($header){
            header('Content-Type: application/json');
        }

        echo json_encode($data);
        die();
    }


    /**
    * HTML document output
    *
    * @param string $path_layout Path to document HTML layout
    * @param array $data any data 
    * @param bool $resp_code Code HTTP response, default 200. If will be 'false' HTTP code will not be setted. 
    * @param bool $header Header HTTP response, default is 'Content-type: text/html; charset=utf-8', if will set 'false' this header will not be sended. 
    *   
    * @example $this->layout($this->base_layout, ["view" => $view])
    * @example $this->layout($this->base_layout, ["view" => $view], false, false)        
    */
    protected function layout($path_layout, $data, $resp_code = true, $header = true){

        if($resp_code){
            http_response_code(200);
        }

        if($header){
            header('Content-type: text/html; charset=utf-8');
        }

        require $path_layout;
        die();
    }


}



