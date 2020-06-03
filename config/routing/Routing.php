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
		if($this->group("/api", ["POST","GET"])){

	        $this->req("/api", "\app\controllers\APIController", "index", ["GET"]);

	        $this->req("/api/post", "\app\controllers\APIController", "post");
		}
		//-----------------------------

        \approot\classes\ResponseCode::code(404);

    }


}



