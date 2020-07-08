<?php
namespace app\classes\db;





/**
*   @example new \approot\AppDB("db_master");
*   @example $db_master = \approot\AppDB::use("db_master");
*   @example \app\classes\db\Task_db::insert($db_master, "hello@mail.com");
*/
class Task_db 
{ 



	const TABLE_NAME = 'task';



    /**
    *
    *
    */
    static function insert(\mysqli $db, $email, $user_name, $description){

        $sql = "INSERT INTO " . self::TABLE_NAME . " 
                (email, user_name, description) 
                VALUES 
                (?, ?, ?)";

        $stmt = $db->prepare($sql);

        if(false === $stmt){
            $msg = "Failure prepare query. ";
            $msg .= "errno: (" . $db->errno . ") ";
            $msg .= "error: (" . $db->error . ") ";
            \approot\classes\Logger::sendToLog($msg); 
            return false;
        }

        $bind_param = $stmt->bind_param("sss", $email, $user_name, $description);
        if (false === $bind_param) {
            $msg = "Failure bind param. ";
            $msg .= "errno: " . $stmt->errno . " ";
            $msg .= "error: " . $stmt->error . " ";
            \approot\classes\Logger::sendToLog($msg);
            return false;
        }

        if (false === $stmt->execute()) {
            $msg = "Failure execute query.";
            $msg .= "errno: " . $stmt->errno . " ";
            $msg .= "error: " . $stmt->error . " ";
            \approot\classes\Logger::sendToLog($msg);            
            return false; 
        }

        $stmt->close();

        return true;
    }



}


?>