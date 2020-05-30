<?php
namespace app\config\routing;

use approot\AppRouting;


class Routing extends AppRouting
{



    public function init(){

    	//-----------------------------
    	// [Index]
    	//-----------------------------
    	$this->req("/", "\app\controllers\IndexController", "index", ["GET"]);
        $this->req("/login", "\app\controllers\IndexController", "login", ["GET", "POST"]);
        $this->req("/logout", "\app\controllers\IndexController", "logout", ["GET"]);
		//-----------------------------

        //-----------------------------
        // [Private]
        //-----------------------------
        $this->req("/privpage", "\app\controllers\PrivateController", "index", ["GET"]);
        //-----------------------------

    	//-----------------------------
    	// [My]
    	//-----------------------------
		if($this->group("/my", ["POST","GET"])){

	        $this->req("/my", "\app\controllers\MyController", "index", ["GET"]);

	        $this->req("/my/post", "\app\controllers\MyController", "post");
		}
		//-----------------------------

        \approot\classes\ResponseCode::code(404);

    }


}



