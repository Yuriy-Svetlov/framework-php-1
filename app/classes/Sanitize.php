<?php
namespace approot\classes;


/**
*
*
*/
class Sanitize
{



    /**
    *
    *
    */
    public static function html(string $str): string
    {
       return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, "UTF-8");   
    }




    /**
    *
    *
    */
    public static function del_all_except(string $str): string
    {
       return preg_replace('/([^\\\:\w \]\[]+)/ui', " ", $str);        
    }



}