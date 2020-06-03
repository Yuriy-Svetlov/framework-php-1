<?php
namespace approot;



/**
*
*
*/
class AppControllers
{

    protected $lang = "";
    protected $title = "";
    protected $meta_tags = "";
    protected $links_head = "";
    protected $style = "";
    protected $scripts_body = "";



  	function __construct(){
        $this->beforeInit();
  	    $this->init();
  		$this->afterInit();
    }



    /**
    *
    *
    */
    protected function beforeInit(){

    }



    /**
    *
    *
    */
    private function init(){
        // clear the old headers
        header_remove();   
        $this->lang = \approot\App::getConfig()["app"]["lang"];     
    }



    /**
    *
    *
    */
    protected function afterInit(){
        
    }



    /**
    * Response of data in JSON format
    *
    * @param array $data JSON data
    * @param bool|int $resp_code Code HTTP response, default 200. 
    * @param bool $header Header HTTP response, default is 'Content-Type: application/json', if will set 'false' this header will not be sended. 
    *   
    * @example $this->renderJSON(["status" => "1"]) 
    * @example $this->renderJSON(["status" => "1"], false, false)         
    */  
    final protected function renderJSON($data, $resp_code = true, $header = true){

        if($resp_code === true){
            http_response_code(200);
        }else{
            http_response_code($resp_code);
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
    * @example $this->render($this->base_layout, ["view" => $view])
    * @example $this->render($this->base_layout, ["view" => $view], false, false)        
    */
    final protected function render(string $path_layout, array $data = [], bool $resp_code = true, bool $header = true): void{

        if($resp_code){
            http_response_code(200);
        }

        if($header){
            header('Content-type: text/html; charset=utf-8');
        }
 
        $view = "";
        if(count($data) > 0){
            if (array_key_exists('view', $data)) {
                ob_start();
                require $data["view"];
                $view = ob_get_clean();
            }
        }

        require $path_layout;
        die();
    }



    /**
    * String output
    *
    * @param string $str
    * @param bool $resp_code Code HTTP response, default 200. If will be 'false' HTTP code will not be setted. 
    * @param bool $header Header HTTP response, default is 'Content-type: text/html; charset=utf-8', if will set 'false' this header will not be sended. 
    *   
    * @example $this->renderStr("test")
    *
    * @example header('Content-Type: text/plain; charset=utf-8');
    * @example $this->renderStr("test", true, false)        
    */
    final protected function renderStr(string $str, $resp_code = true, $header = true){
        if($resp_code){
            http_response_code(200);
        }

        if($header){
            header('Content-type: text/html; charset=utf-8');
        }  

        echo $str;
        die();
    }

    

    /**
    *
    *
    */
    protected function addMetaTag(string $meta_tag): void{
        $this->meta_tags = $this->meta_tags.$meta_tag;
    }



    /**
    *
    *
    */
    protected function addLinkHead(string $links_head): void{
        $this->links_head = $this->links_head.$links_head;
    }



    /**
    *
    *
    */
    protected function addStyle(string $style): void{
        $this->style = $this->style.$style;
    }



    /**
    *
    *
    */
    protected function addScriptBody(string $scripts_body): void{
        $this->scripts_body = $this->scripts_body.$scripts_body;
    }


}



