<?php
declare (strict_types = 1);

namespace app\config\routing;

class Routing extends \approot\AppRouting
{

    public function init()
    {
        // [Non-private pages]
        //-----------------------------
        $this->req('/', '\app\controllers\IndexController', 'index', ['GET']);
        $this->req('/login', '\app\controllers\IndexController', 'login', ['GET']);
        $this->req('/logout', '\app\controllers\IndexController', 'logout', ['GET']);
        //-----------------------------

        // [Private pages]
        //-----------------------------
        $this->req('/privpage', '\app\controllers\PrivateController', 'index', ['GET']);
        //-----------------------------

        // [API v1] 
        // RESTful - Destruction of structure WEB of controllers
        //-----------------------------
        if ($this->group('/api', ['POST', 'GET'])) {
            // IndexController
            $this->req('/api/login', '\app\modules\api\v1\controllers\LoginController');

            // UserController
            $this->req('/api/user', '\app\modules\api\v1\controllers\UserController');
            $this->req('/api/user/friend', '\app\modules\api\v1\controllers\user\FriendController');
        }
        //-----------------------------

        // [API v2 - ]
        // WEBPAGE - With save of structure WEB of controllers
        /*
        //-----------------------------
        if ($this->group('/api', ['POST', 'GET'])) {
            // IndexController
            $this->req('/api/login', '\app\modules\api\v1\controllers\IndexController');

            // UserController
            $this->req('/api/user', '\app\modules\api\v1\controllers\UserController');
            $this->req('/api/user/friend', '\app\modules\api\v1\controllers\UserController');
        }
        //-----------------------------
        */

        \approot\classes\ResponseCode::code(404);
    }

}
