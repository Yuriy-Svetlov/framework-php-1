<?php
namespace app\modules\api\v1\controllers;

use approot\App;
use approot\classes\authentication\user\login_middleware\LoginBySessionFile;
use app\modules\api\v1\models\index\Login__POST;


class IndexController extends \approot\AppControllerAPI
{


    function afterInit($data){
        LoginBySessionFile::init();
    }


    public function login()
    {  
        if(App::$user::isGuest() === false){
            return $this->responseJSON([
                "error" => "Moved Temporarily", 
                "status" => 302
            ]);             
        }

        // POST
        if(App::$request->isPOST()){
            $req = App::$request;
            $model = new Login__POST();

            $data = $req::getJSON();
            $model->username = $data["username"];
            $model->password = $data["password"];
            $model->save_login = $data["save_login"];

            if($model->validation() === true){
                if($model->login() === true){
                    return $this->responseJSON(["status" => "OK"]);
                }

                return $this->responseJSON(["status" => "NO"]);
            }

            return $this->responseJSON([
                "status" => "NO", 
                "error" => [
                    "message" => $model->getError()["message"],
                    "property" => $model->getError()["property"],
                ]
            ]);
        }

        \approot\classes\ResponseCode::code(404);

    }

}



