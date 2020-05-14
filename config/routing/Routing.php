<?php
namespace app\config\routing;

use approot\AppRouting;


class Routing extends AppRouting
{



    public function init(){

    	//-----------------------------
    	// [/index]
    	//-----------------------------
    	$this->req("/", "\app\controllers\IndexController", "index", ["GET"]);
		//-----------------------------

    	//-----------------------------
    	// [/my]
    	//-----------------------------
		if($this->group("/my", ["POST","GET"])){

	        $this->req("/my", "\app\controllers\MyController", "index", ["GET"]);

	        $this->req("/my/post", "\app\controllers\MyController", "post");
		}
		//-----------------------------

        \approot\classes\ResponseCode::code(404);

    }


}



