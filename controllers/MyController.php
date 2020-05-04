<?php
namespace app\controllers;

use approot\AppControllers;

use app\models\MyModel;

class MyController extends AppControllers
{



    public function index()
    {
        $model = new MyModel();
        if($model->validation()){
            return $this->json_response(["status" => "1"]);
        }

        return $this->json_response(["status" => "2"]);
    }



    public function post()
    {
        return $this->json_response(["status" => "2"]);
    }

}



