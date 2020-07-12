<?php
namespace app\modules\api\v1\controllers;

use approot\App;
use approot\classes\authentication\user\login_middleware\LoginByAPI_KEY;


class UserController extends \approot\AppControllerAPI
{
    private $req;


    function afterInit($data){
        $this->req = App::$request;
    }


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


}



