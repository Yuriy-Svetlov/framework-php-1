<?php
namespace app\config\routing;


class Routing extends \approot\AppRouting
{



    public function init(){

    	//-----------------------------
    	// [Index]
    	//-----------------------------
    	$this->req('/', '\app\controllers\IndexController', 'index', ['GET']);
        $this->req('/login', '\app\controllers\IndexController', 'login', ['GET']);
        $this->req('/logout', '\app\controllers\IndexController', 'logout', ['GET']);
		//-----------------------------

        //-----------------------------
        // [Private]
        //-----------------------------
        $this->req('/privpage', '\app\controllers\PrivateController', 'index', ['GET']);
        //-----------------------------

        //-----------------------------
        // [API]
        //-----------------------------
        if($this->group('/api', ['POST','GET'])){
            $this->req('/api/login', '\app\modules\api\v1\controllers\IndexController', 'login', ['POST']);

            $this->req('/api/user', '\app\modules\api\v1\controllers\UserController', 'user', ['GET']);
            $this->req('/api/user/friend', '\app\modules\api\v1\controllers\UserController', 'friend', ['GET']);

        }
        //-----------------------------

    	//-----------------------------
    	// [My]
    	//-----------------------------
        /*
		if($this->group('/api', ['POST','GET'])){

	        $this->req('/api', '\app\controllers\APIController', 'index', ['GET']);

	        $this->req('/api/post', '\app\controllers\APIController', 'post');
		}
        */
		//-----------------------------

        \approot\classes\ResponseCode::code(404);

    }


}



