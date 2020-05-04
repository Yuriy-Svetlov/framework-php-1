<?php
namespace app\config\routing;

use approot\AppRouting;


class Routing extends AppRouting
{


    public function init(){

    	//-----------------------------
    	// [/upload]
    	//-----------------------------
		if($this->group("/upload", ["POST","PUT","GET"])){

	        if($this->req("/upload", "\app\controllers\MyController", "index", ["GET"])){
	            return;
	        }else 
	        if($this->req("/upload/post", "\app\controllers\MyController", "post")){
	            return;
	        }
		}
		//-----------------------------

        $this->error404();
    }



}



