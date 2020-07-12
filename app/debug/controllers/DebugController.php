<?php
namespace approot\debug\controllers;

use approot\AppControllers;
use approot\App;


class DebugController extends AppControllers
{

    private $base_layout = __DIR__ . '/../views/layouts/index.php';



    public function index()
    {
        //------------------------
        // GET
        if(App::$request->isGET()){
            
            $model = new \approot\debug\models\debug\Index__GET();

            if($model->validation() != false){
                $data = $model->getData();

                return $this->render($this->base_layout, 
                [
                    "data" => $data
                ]);
            }  

            return $this->renderStr($model->getError()["message"]);          
        }
        //------------------------  


        \approot\classes\ResponseCode::code(404);
    }



    public function errorLog()
    {

        $req = App::$request;
        $view = __DIR__ . '/../views/debug/index.php';


        //------------------------
        // GET
        if($req->isGET()){
            $model = new \approot\debug\models\debug\ErrorLog__GET();
            $model->number = $req::getParamGET("number");

            if($model->validation() != false){
                $data = $model->getData();

                return $this->render($this->base_layout, 
                [
                    "view" => $view,
                    "data" => $data
                ]);
            }

            return $this->renderStr($model->getError()["message"]);
        }
        //------------------------

        \approot\classes\ResponseCode::code(404);
    }




    public function errorValidationLog()
    {

        $req = App::$request;
        $view = __DIR__ . '/../views/debug/index.php';

        //------------------------
        // GET
        if($req->isGET()){
            $model = new \approot\debug\models\debug\ValidationLog__GET();
            $model->number = $req::getParamGET("number");

            if($model->validation() != false){
                $data = $model->getData();

                return $this->render($this->base_layout, 
                [
                    "view" => $view,
                    "data" => $data
                ]);
            }

            return $this->renderStr($model->getError()["message"]);
        }
        //------------------------

        \approot\classes\ResponseCode::code(404);
    }



}



