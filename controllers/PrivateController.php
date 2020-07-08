<?php
namespace app\controllers;

use approot\AppControllers;
use approot\App;




class PrivateController extends AppControllers
{


    private $base_layout = __DIR__ . '/../views/layouts/index.php';



    function afterInit($data){
        
        \approot\classes\authentication\user\login_middleware\LoginBySessionFile::init();
    }



    public function index()
    {   

        $view = __DIR__ . '/../views/private/index.php';

        if(App::$user::isGuest() === true){
            App::$request->redirect("http://".$_SERVER['SERVER_NAME']);
        }

        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            return $this->render($this->base_layout, 
            [
                "view" => $view
            ]);
        }
        //------------------------  

        \approot\classes\ResponseCode::code(404);
    }


}



