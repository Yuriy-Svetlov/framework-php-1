<?php
namespace approot\classes;

use approot\AppDB;



/**
*
*
*/
class ResponseCode
{



    /**
    *
    *
    */
    public static function code($code){

        // Connections db close
        AppDB::closeConnections();

        http_response_code($code);
        die();
    }



    /* Unrealised */
    /* Path to error page must to get from web.config */
    /*
    public static function code_pageHTML($code){
    	http_response_code($code);
        die();
    }
    */


}