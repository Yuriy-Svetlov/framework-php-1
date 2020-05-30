<?php
declare(strict_types=1);
namespace approot\classes\authentication\user\login_middleware;





/**
* 
*
*/
class LoginByAPI_KEY extends \approot\classes\authentication\user\LoginMiddleware
{


    /**
    *
    * $seconds (int) default 90 days = 7776000 sec
    */
    final public static function login(): bool{

 

        return false;
    }

}

