<?php
declare(strict_types=1);
namespace app\models\my;

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



