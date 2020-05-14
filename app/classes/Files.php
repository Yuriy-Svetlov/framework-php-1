<?php
namespace approot\classes;


/**
*
*
*/
class Files
{



    /**
    *
    *
    */
    public static function createFile(string $path)
    {
        if (file_exists($path) !== true) {   
            $handle = fopen($path, "w");
            if($handle === false){
                $msg = "File does not created. Path: ".$path;
                trigger_error($msg, E_USER_ERROR);
                return false;
            }
            fclose($handle);
        } 
        return true;         
    }



    /**
    *
    *
    */
    public static function writeToFile(string $path, string $message)
    {
        $handle = fopen($path, "ab");
        $message = "[".date("d-M-Y H:i:s")."] ".$message.PHP_EOL;
        fwrite($handle, $message);
        fclose($handle);        
    }



}