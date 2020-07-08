<?php
namespace app\controllers;

use approot\AppControllers;
use approot\App;




class IndexController extends AppControllers
{


    private $base_layout = __DIR__ . '/../views/layouts/index.php';



    function afterInit($data){
        
        $action = $data["action"];       
        if($action === "index" || $action === "login" || $action === "logout"){

           \approot\classes\authentication\user\login_middleware\LoginBySessionFile::init();
        }
    }



    public function index()
    {   
        
        $view = __DIR__ . '/../views/index/index.php';

        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            $data = [];
            $data["layout"]["title"] = "Hello World!";
            $data["view"]["h1"] = "Header";
            $data["view"]["h2"] = "View";

            return $this->render($this->base_layout, 
            [
                "view" => $view,                
                "data" => $data
            ]);

        }
        //------------------------  


        \approot\classes\ResponseCode::code(404);

    }




    public function login()
    {  
        $view = __DIR__ . '/../views/index/login.php';

        if(App::$user::isGuest() === false){
            App::$request->redirect("http://".$_SERVER['SERVER_NAME']);
        }

        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            return $this->render($this->base_layout, [ 
                "view" => $view
            ]);
        }else
        //------------------------


        //------------------------
        // POST
        //------------------------
        if(App::$request->isPOST()){

            $req = App::$request;
            $model = new \app\models\index\Login__POST();

            $data = $req::getJSON();
            $model->username = $data["username"];
            $model->password = $data["password"];
            $model->save_login = $data["save_login"];

            if($model->validation() === true){
                if($model->login() === true){
                    return $this->renderJSON(["status" => "OK"]);
                }

                return $this->renderJSON(["status" => "NO"]);
            }

            return $this->renderJSON([
                "status" => "NO", 
                "error" => [
                    "message" => $model->getError()["message"],
                    "property" => $model->getError()["property"],
                ]
            ]);
        }
        //------------------------ 


        \approot\classes\ResponseCode::code(404);

    }



    public function logout()
    {  

        if(App::$user::isGuest() === true){
            App::$request->redirect("http://".$_SERVER['SERVER_NAME']);
            return;
        }

        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            \approot\classes\authentication\user\login_middleware\Login::logout();
            App::$request->redirect("http://".$_SERVER['SERVER_NAME']);            
        }
        //------------------------

        \approot\classes\ResponseCode::code(404);

    }    



}



