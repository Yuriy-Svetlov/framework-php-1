<?php
declare(strict_types=1);
namespace app\models\api;

use approot\AppModel;

// [1] https://github.com/webmozart/assert

class PostModel__GET extends AppModel
{


	public $post_id;


    function beforeValidation(): void{
    	
        // Sanitize variable
        //----------------

        //----------------        
    }


    public function rules(): array {

    	return [

            ["numeric", 
                ["post_id"]
            ],

    	];
    }


    function getData(){
        return [
            "error" => NULL,
            "status" => 200,
            "data" => ["post" => "Marie et Mark sont amis."],
        ];
    }


    function getErrorModel(){
        return [
            "error" => $this->getError()["message"],
            "status" => 304,
            "data" => NULL,
        ];
    }

}



