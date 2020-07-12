<?php
declare(strict_types=1);

namespace app\modules\api\v1\models\user;

use approot\AppModel;

// [1] https://github.com/webmozart/assert

class UserModel__GET extends AppModel
{
    const RANGE_MIN__1 = 1;
    const RANGE_MAX__1 = 1;
    
	public $userid;


    function beforeValidation(): void {
        // Sanitize variable
        //----------------
        //----------------        
    }


    public function rules(): array {

    	return [

            ['numeric', 
                ['userid']
            ],

            ['range', 
                [
                    'userid'
                ],
                [
                    self::RANGE_MIN__1, 
                    self::RANGE_MAX__1, 
                    'message' => 
                        'Line length must be between ' 
                        . self::RANGE_MIN__1 . ' and ' 
                        . self::RANGE_MAX__1 . ' characters.'
                ]
            ]
    	];
    }


    public function getData(){
        return [
            'error' => NULL,
            'status' => 200,
            'data' => [
                'id' => 1,
                'link' => 'http://example.com/user/1',
                'avatar' => 'http://example.com/img/user/avatar/1',
                'name' => 'Marie',
                'email' => 'marie@mail.com',
                'friends' => [
                    [
                        'id' => 2,
                        'link' => 'http://example.com/user/2',
                        'avatar' => 'http://example.com/img/user/avatar/2',
                        'name' => 'Poul'
                    ],
                    [
                        'id' => 3,
                        'link' => 'http://example.com/user/3',
                        'avatar' => 'http://example.com/img/user/avatar/3',
                        'name' => 'Anna'
                    ],                    
                ],
            ],
        ];
    }


    public function getErrorModel(){
        return [
            "error" => [
                "property" => $this->getError()["property"],
                "message" => $this->getError()["message"],
            ],
            'status' => 304,
            'data' => NULL,
        ];
    }

}



