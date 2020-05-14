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
        //------------------------
        if(App::$request->isGET()){
            
            $model = new \approot\debug\models\debug\Index__GET();

            if($model->validation() != false){
                $data = $model->getData();

                return $this->return_Layout($this->base_layout, 
                [
                    "data" => $data
                ]);
            }  

            return $this->return_Str($model->getError()["message"]);          
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
        //------------------------
        if($req->isGET()){
            $model = new \approot\debug\models\debug\ErrorLog__GET();
            $model->number = $req::getParamGET("number");

            if($model->validation() != false){
                $data = $model->getData();

                return $this->return_Layout($this->base_layout, 
                [
                    "view" => $view,
                    "data" => $data
                ]);
            }

            return $this->return_Str($model->getError()["message"]);
        }
        //------------------------


        //------------------------
        // DELETE
        //------------------------
        if($req->isDELETE()){
            $model = new \approot\debug\models\debug\ErrorLog__DELETE();

            if($model->validation() != false){
                if($model->clearData() === true){
                    $this->return_JSON(["status" => "OK"]);
                }   
            }

            $this->return_JSON(["status" => "NO"]);
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
        //------------------------
        if($req->isGET()){
            $model = new \approot\debug\models\debug\ValidationLog__GET();
            $model->number = $req::getParamGET("number");

            if($model->validation() != false){
                $data = $model->getData();

                return $this->return_Layout($this->base_layout, 
                [
                    "view" => $view,
                    "data" => $data
                ]);
            }

            return $this->return_Str($model->getError()["message"]);
        }
        //------------------------


        //------------------------
        // DELETE
        //------------------------
        if($req->isDELETE()){
            $model = new \approot\debug\models\debug\ValidationLog__DELETE();

            if($model->validation() != false){
                if($model->clearData() === true){
                    $this->return_JSON(["status" => "OK"]);
                }   
            }

            $this->return_JSON(["status" => "NO"]);
        }
        //------------------------


        \approot\classes\ResponseCode::code(404);
    }



}



