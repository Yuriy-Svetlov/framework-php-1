<?php
namespace approot;

use approot\AppDB;

/**
*
*
*/
class AppControllerAPI
{


  	public function __construct(array $data){
        $this->beforeInit($data);
  	    $this->init($data);
  		$this->afterInit($data);
    }


    /**
    *
    *
    */
    protected function beforeInit(array $data){

    }


    /**
    *
    *
    */
    private function init(array $data){
        // clear the old headers
        header_remove();   
    }


    /**
    *
    *
    */
    protected function afterInit(array $data){
        
    }


    /**
    * Response of data in JSON format
    *
    * @param array $data JSON data
    * @param bool|int $resp_code Code HTTP response, default 200. 
    * @param bool $header Header HTTP response, default is 'Content-Type: application/json', if will set 'false' this header will not be sended. 
    *   
    * @example $this->responseJSON(["status" => "1"]) 
    * @example $this->responseJSON(["status" => "1"], false, false)         
    */  
    final protected function responseJSON($data, $resp_code = true, $header = true){

        if($resp_code === true){
            http_response_code(200);
        }else{
            http_response_code($resp_code);
        }

        if($header){
            header('Content-Type: application/json');
        }

        // Connections db close
        AppDB::closeConnections();

        echo json_encode($data);
        die();
    }


    /**
    * String output
    *
    * @param string $str
    * @param bool $resp_code Code HTTP response, default 200. If will be 'false' HTTP code will not be setted. 
    * @param bool $header Header HTTP response, default is 'Content-type: text/html; charset=utf-8', if will set 'false' this header will not be sended. 
    *   
    * @example $this->responseStr("test")
    *
    * @example header('Content-Type: text/plain; charset=utf-8');
    * @example $this->responseStr("test", true, false)        
    */
    final protected function responseStr(string $str, $resp_code = true, $header = true){
        if($resp_code){
            http_response_code(200);
        }

        if($header){
            header('Content-type: text/html; charset=utf-8');
        }  

        // Connections db close
        AppDB::closeConnections();

        echo $str;
        die();
    }

}



