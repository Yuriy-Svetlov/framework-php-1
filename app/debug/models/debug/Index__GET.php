<?php
declare(strict_types=1);
namespace approot\debug\models\debug;

use approot\AppModel;




class Index__GET extends AppModel
{



    public $number;
    private $panel_url_debug;


	        
    function beforeValidation(): void{

        $config = \approot\App::getConfig();
        $path_log = $config["app"]["error_log"];    	

        $this->panel_url_debug = $config["debug_panel"]["panel_url"];
        $this->number = 50;

        // Sanitize variable
        //----------------

        //----------------        
    }



    function rules(): array{
        return [

            ["numeric", 
                ["number"]
            ],

        ];
    }




    public function getData(){

        return [
            "panel_url_debug" => $this->panel_url_debug,
            "number_line" => $this->number,
        ];
    }



}





