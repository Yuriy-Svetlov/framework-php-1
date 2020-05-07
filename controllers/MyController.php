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
            return $this->return_JSON(["status" => "1"]);
        }

        return $this->return_JSON(["status" => "2"]);
    }



    public function post()
    {
        return $this->return_JSON(["status" => "2"]);
    }

}



