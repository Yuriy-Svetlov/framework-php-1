<?php
declare(strict_types=1);
namespace approot\debug\modules\api\v1\models\debug;

use approot\AppModel;




class ValidationLog__DELETE extends AppModel
{


	protected $path_log_error;


	        
    function beforeValidation(): void{

        $config = \approot\App::getConfig();
        $path_log = $config["models"]["error_log"];    	
    	$this->path_log_error = $path_log;

         // Create log file
        \approot\classes\Files::createFile($this->path_log_error);
    }



    function rules(): array{
        return [

            ["fileExists", 
                ["path_log_error"]
            ],

        ];
    }




    public function clearData(){

        $handle = fopen($this->path_log_error, "w");
        if($handle === false){
                $msg = "File does not created. Path: ".$this->path_log_error;
                \approot\classes\Logger::sendToLog($msg);
            return false;
        }
        fclose($handle);
        
        return true;
    }













}





