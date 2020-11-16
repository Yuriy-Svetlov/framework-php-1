<?php
namespace app\controllers;

use approot\App;
use approot\AppControllers;

class PrivateController extends AppControllers
{

    const LAYOUT_BASE = __DIR__ . '/../views/layouts/index.php';

    public function afterInit($data)
    {
        \approot\classes\authentication\user\login_middleware\LoginBySessionFile::init();
    }

    public function index()
    {
        if (App::$user::isGuest() === true) {
            App::$request->redirect("http://" . $_SERVER['SERVER_NAME']);
        }

        //------------------------
        // GET
        if (App::$request->isGET()) {
            return $this->render(self::LAYOUT_BASE,
                [
                    "view" => __DIR__ . '/../views/private/index.php',
                ]);
        }
        //------------------------

        \approot\classes\ResponseCode::code(404);
    }

}
