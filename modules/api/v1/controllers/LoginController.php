<?php
declare (strict_types = 1);

namespace app\modules\api\v1\controllers;

use approot\App;
use approot\classes\authentication\user\login_middleware\LoginBySessionFile;
use app\modules\api\v1\models\index\Login__POST;

/**
 *
 *
 */
class LoginController extends \approot\AppControllerAPI_REST
{
    /**
     *
     *
     */
    public function afterInit(array $data): void
    {
        LoginBySessionFile::init();
    }

    /**
     *
     *
     */
    protected function getAll(): void
    {
        \approot\classes\Logger::sendToLog("---");
    }

    /**
     *
     *
     */
    protected function get(): void
    {

    }

    /**
     *
     *
     */
    protected function post(): void
    {
        if(App::$user::isGuest() === false){
            $this->responseJSON([
            "error" => "Moved Temporarily",
            "status" => 302
            ]);
        }

        $req = App::$request;
        $model = new Login__POST();

        $data = $req::getJSON();
        $model->username = $data["username"];
        $model->password = $data["password"];
        $model->save_login = $data["save_login"];

        if($model->validation() === true){
            if($model->login() === true){
                $this->responseJSON(["status" => "OK"]);
            }

            $this->responseJSON(["status" => "NO"]);
        }

        $this->responseJSON([
            "status" => "NO",
            "error" => [
            "message" => $model->getError()["message"],
            "property" => $model->getError()["property"],
            ]
        ]);
    }

    /**
     *
     *
     */
    protected function put(): void
    {

    }

    /**
     *
     *
     */
    protected function patch(): void
    {

    }

    /**
     *
     *
     */
    protected function delete(): void
    {

    }
}
