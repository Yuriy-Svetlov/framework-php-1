<?php
declare(strict_types=1);

namespace approot\debug\controllers;

use approot\AppControllers;


class DebugController extends AppControllers
{

    private $base_layout = __DIR__ . '/../views/layouts/index.php';


    public function index()
    {
        
        $model = new \approot\debug\models\DebugModel();
        $view = __DIR__ . '/../views/debug/index.php';

        if($model->validation() !== false){
           return $this->return_Layout($this->base_layout, ["view" => $view]);
        }

        return $this->return_Str($model->getErrorMessage());
    }

}



