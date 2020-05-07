<?php
namespace approot\functions;

use Webmozart\Assert\Assert as WebmozartAssert;


class Assert
{

    public static function validation($method, $params){
        try {
            WebmozartAssert::$method($params);
        } catch (\InvalidArgumentException $e) {
            return false;
        }
        return true;
    }

}