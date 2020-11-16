<?php
namespace app\modules\api\v1\controllers;

use approot\App;
use approot\classes\Request;

/**
 *
 *
 */
class UserController extends \approot\AppControllerAPI_REST
{

    /**
     *
     *
     */
    protected function get(): void
    {
        $model = new \app\modules\api\v1\models\user\UserModel__GET();
        $model->userid = Request::getParamGET('userid');
        if($model->validation()){
            $this->responseJSON($model->getData()); 
        }

        $this->responseJSON($model->getErrorModel());
    }

/*
    public function user()
    {   
        $model = new \app\modules\api\v1\models\user\UserModel__GET();
        $model->userid = $this->req::getParamGET('userid');

        // GET
        if($model->validation()){
            return $this->responseJSON($model->getData()); 
        }

        return $this->responseJSON($model->getErrorModel()); 

        \approot\classes\ResponseCode::code(404);
    }



    public function friend()
    {
        LoginByAPI_KEY::init();
        
        if(App::$user::isGuest() === true){
            return $this->responseJSON([
                "error" => "Authentication required", 
                "status" => 401
            ]); 
        }

        // GET
        if(App::$request->isGET()){
            $model = new \app\modules\api\v1\models\user\FriendModel__GET();
            $model->userid = $this->req::getParamGET('userid');

            if($model->validation()){
                return $this->responseJSON($model->getData());                
            }

            return $this->responseJSON($model->getErrorModel());
        }

        \approot\classes\ResponseCode::code(404);
    }
*/

}



