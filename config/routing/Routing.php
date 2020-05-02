<?php
namespace app\config\routing;

use app\AppRouting;


class Routing extends AppRouting
{


    public function init(){

    	//-----------------------------
		if($this->group("/upload", ["POST","PUT","GET"])){

	        if($this->all("/upload", "\app\controllers\MyController", "index", ["GET"])){
	            return;
	        }else 
	        if($this->all("/upload/post", "\app\controllers\MyController", "post")){
	            return;
	        }
		}
		//-----------------------------

        $this->error404();
    }



}



