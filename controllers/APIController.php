<?php
namespace app\controllers;

use approot\AppControllers;
use approot\App;
use approot\classes\authentication\user\login_middleware\LoginByAPI_KEY;

class APIController extends AppControllers
{


    private $req;


    function afterInit(){

        $this->req = App::$request;
        //LoginByAPI_KEY::init();

    }



    public function index()
    {   

        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            $model = new \app\models\api\IndexModel__GET();
            $model->userid = $this->req::getParamGET("userid");

            if($model->validation()){

                return $this->renderJSON($model->getData()); 
            }

            return $this->renderJSON($model->getErrorModel()); 
        }
        //------------------------  

        \approot\classes\ResponseCode::code(404);
    }



    public function post()
    {
        LoginByAPI_KEY::init();

        if(App::$user::isGuest() === true){
            return $this->renderJSON(LoginByAPI_KEY::$response_data); 
        }

        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            $model = new \app\models\api\PostModel__GET();
            $model->post_id = $this->req::getParamGET("post_id");

            if($model->validation()){

                return $this->renderJSON($model->getData());                
            }

            return $this->renderJSON($model->getErrorModel());
        }
        //------------------------  

        \approot\classes\ResponseCode::code(404);
    }



}



