<?php
namespace approot\debug\modules\api\v1\controllers;

use approot\App;
use approot\debug\modules\api\v1\models\debug\ErrorLog__DELETE;
use approot\debug\modules\api\v1\models\debug\ValidationLog__DELETE;


class DebugController extends \approot\AppControllerAPI
{

	private $req;


    function afterInit($data){
        $this->req = App::$request;
    }


    public function errorLog()
    {
        // DELETE
        if($this->req->isDELETE()){
            $model = new ErrorLog__DELETE();

            if($model->validation() != false){
                if($model->clearData() === true){
                    $this->responseJSON(["status" => "OK"]);
                }   
            }

            $this->responseJSON(["status" => "NO"]);
        }
        
        \approot\classes\ResponseCode::code(404);
    }


    public function errorValidationLog()
    {
        // DELETE
        if($this->req->isDELETE()){
            $model = new ValidationLog__DELETE();

            if($model->validation() != false){
                if($model->clearData() === true){
                    $this->responseJSON(["status" => "OK"]);
                }   
            }

            $this->responseJSON(["status" => "NO"]);
        }

        \approot\classes\ResponseCode::code(404);
    }


}



