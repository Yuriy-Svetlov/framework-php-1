<?php
declare(strict_types=1);

namespace app\modules\api\v1\models\index;

use approot\AppModel;



class Login__POST extends AppModel
{


	public $username;
    public $password;
    public $save_login;
    


    function beforeValidation(): void{
    	
        //----------------
        // Sanitize
        // No need 
        // Instead need use - PDO
        // https://stackoverflow.com/questions/9144414/function-to-sanitize-input-to-mysql-database
        //----------------
    }


    public function rules(): array {

    	return [

            ["stringNotEmpty", 
                ["username", "password"]
            ],

            ["string", 
                ["username", "password"]
            ],

            ["same", 
                ["username", "password"],
                ["admin"]
            ],

            ["boolean", 
                ["save_login"]
            ],

    	];
    }




    function login(){
        $user_data['id'] = "123";
        $user_data['username'] = $this->username;
        $user_data['password'] = $this->password;
        $user_data['auth_key'] = "gen_new_key-123";

        // Query to db
        // And other...
        //if(!password_verify($this->password, $user_data['password'])){
        //    return false;
        //} 

        $login = "\approot\classes\authentication\user\login_middleware\Login";

        if($login::login($user_data, $this->save_login) !== true){
            return false;
        }

        return true;
    }


}



