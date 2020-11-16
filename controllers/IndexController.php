<?php
declare (strict_types = 1);

namespace app\controllers;

use approot\App;
use approot\AppControllers;

class IndexController extends AppControllers
{
    const LAYOUT_BASE = __DIR__ . '/../views/layouts/index.php';

    public function afterInit($data)
    {
        $action = $data["action"];

        if ($action === "index" || $action === "login" || $action === "logout") {
            \approot\classes\authentication\user\login_middleware\LoginBySessionFile::init();
        }
    }

    public function index()
    {
        // GET
        //------------------------
        if (App::$request->isGET()) {

            $data = [];
            $data["layout"]["title"] = "Hello World!";
            $data["view"]["h1"] = "Header";
            $data["view"]["h2"] = "View";

            return $this->render(self::LAYOUT_BASE,
                [
                    "view" => __DIR__ . '/../views/index/index.php',
                    "data" => $data,
                ]);
        }
        //------------------------

        \approot\classes\ResponseCode::code(404);
    }

    public function login()
    {
        if (App::$user::isGuest() === false) {
            App::$request->redirect("http://" . $_SERVER['SERVER_NAME']);
        }

        // GET
        //------------------------
        if (App::$request->isGET()) {

            return $this->render(self::LAYOUT_BASE, [
                "view" => __DIR__ . '/../views/index/login.php',
            ]);
        }
        //------------------------

        \approot\classes\ResponseCode::code(404);
    }

    public function logout()
    {
        if (App::$user::isGuest() === true) {
            App::$request->redirect("http://" . $_SERVER['SERVER_NAME']);
        }

        // GET
        //------------------------
        if (App::$request->isGET()) {

            \approot\classes\authentication\user\login_middleware\Login::logout();
            App::$request->redirect("http://" . $_SERVER['SERVER_NAME']);
        }
        //------------------------

        \approot\classes\ResponseCode::code(404);

    }

}
