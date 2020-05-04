<?php
namespace approot\debug\controllers;

use approot\AppControllers;


class DebugController extends AppControllers
{

    private $base_layout = __DIR__ . '/../views/layouts/index.php';


    public function index()
    {
        $view = __DIR__ . '/../views/debug/index.php'; 

        $this->view($this->base_layout, ["view" => $view]);
    }

}



