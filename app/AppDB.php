<?php
declare(strict_types=1);
namespace approot;



/**
*
*
*/
class AppDB
{



    public static $connection = [];

    private $mysqli;
    private $servername;
    private $db_name;
    private $username;    
    private $password;
    private $port;
    private $charset;



    function __construct(string $db_name){
        $config = \approot\App::getConfig();
        $path_config = $config["app"]["dbs"][$db_name];

        $arr = require __DIR__ . $path_config;
        $this->servername = $arr["servername"];
        $this->db_name = $arr["db_name"];
        $this->username = $arr["username"];       
        $this->password = $arr["password"];
        $this->port = $arr["port"];
        $this->charset = $arr["charset"];

        // connect check db
        if(array_key_exists($db_name, self::$connection) !== false) {
            \approot\classes\Logger::sendToLog("Connection exists: ".$db_name);
            return;
        }

        // Create connection to db
        $this->createConnection($db_name);
    }    



    /**
    *
    *
    */
    private function createConnection(string $db_name){
        // Create connection
        $this->mysqli = new \mysqli(
            $this->servername, 
            $this->username, 
            $this->password, 
            $this->db_name, 
            (int) $this->port
        );

        $this->mysqli->set_charset($this->charset);

        // Check connection
        if ($this->mysqli->connect_errno) {
            $msg = "Connection to db failed. ";
            $msg .= "Error number: " . $this->mysqli->connect_errno . " ";
            $msg .= "Error: " . $this->mysqli->connect_error . " ";
            trigger_error($msg, E_USER_WARNING);
            return;
        } 

        self::$connection[$db_name] = $this->mysqli;
    }



    /**
    *
    *
    */
    public static function use(string $db_name){
        return self::$connection[$db_name];
    }



    /**
    *
    *
    */
    public static function closeConnections(){
        foreach(self::$connection as $key => $value) { 
            self::$connection[$key]->close();
        }         
    }



}

