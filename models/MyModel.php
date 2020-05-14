<?php
namespace app\models;

use approot\AppModel;

// [1] https://github.com/webmozart/assert

class MyModel extends AppModel
{


	public $my_variable;


    function beforeValidation(): void{
    	
        // Sanitize variable
        //----------------

        //----------------        
    }


    public function rules(): array {

    	return [

            ["numeric", 
                ["my_variable"]
            ],

    	];
    }


}



