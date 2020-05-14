<?php
namespace app\controllers;

use approot\AppControllers;
use approot\App;


class MyController extends AppControllers
{



    public function index()
    {

        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            $model = new \app\models\MyModel();
            $model->my_variable = "u123";

            if($model->validation()){
                return $this->return_JSON(["status" => "OK"]);
            }

            return $this->return_JSON([
                "status" => "NO", 
                "message" => $model->getError()["message"],
            ]);

        }
        //------------------------  

        \approot\classes\ResponseCode::code(404);
    }



    public function post()
    {

        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            $model = new \app\models\MyModel();
            $model->my_variable = 123;

            if($model->validation()){
                return $this->return_JSON(["status" => "OK"]);
            }

            return $this->return_JSON([
                "status" => "NO", 
                "message" => $model->getError()["message"],
            ]);
        }
        //------------------------  

        \approot\classes\ResponseCode::code(404);
    }



}



