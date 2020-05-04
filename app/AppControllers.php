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


    protected function json_response($data, $resp_code = true, $header_json = true){

        if($resp_code){
            http_response_code(200);
        }

        if($header_json){
            header('Content-Type: application/json');
        }

        echo json_encode($data);
        die();
    }


    protected function view($path_layout, $data, $resp_code = true, $header = true){

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



