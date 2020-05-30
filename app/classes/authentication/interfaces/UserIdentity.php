<?php
namespace approot\classes\authentication\interfaces;




interface UserIdentity
{


    public static function verifyBySessionCookie(string $id);


    public static function verifyByCookie(string $data_cookie);


}