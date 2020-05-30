<?php
declare(strict_types=1);
namespace approot\classes\authentication;




/**
*
*
*/
class User
{


    protected static $isGuest = false;
    private static $user_identify = [];



    /**
    *
    *
    */
    final protected static function setIdentify(array $user_identify): void{

        User::$user_identify = $user_identify;
    }



    /**
    *
    *
    */
    final public static function getIdentify(): array{

        return User::$user_identify;
    }



    /**
    *
    *
    */
    final public static function isGuest(): bool{
        
        return User::$isGuest;
    }


}