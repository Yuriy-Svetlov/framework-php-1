<?php
namespace approot;

use approot\AppDB;

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


  	function __construct(array $data){
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
        $this->lang = \approot\App::getConfig()["app"]["lang"];     
    }


    /**
    *
    *
    */
    protected function afterInit(array $data){
        
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

        // Connections db close
        AppDB::closeConnections();

        require $path_layout;
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



