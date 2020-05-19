<?php
namespace app\controllers;

use approot\AppControllers;
use approot\App;


class IndexController extends AppControllers
{


    private $base_layout = __DIR__ . '/../views/layouts/index.php';





    public function index()
    {

        $view = __DIR__ . '/../views/index/index.php';


        //------------------------
        // GET
        //------------------------
        if(App::$request->isGET()){

            $data = [];
            $data["layout"]["title"] = "Hello World!";
            $data["layout"]["h1"] = "Header";

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


}



