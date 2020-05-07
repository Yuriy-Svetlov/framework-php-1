<?php
namespace approot;



/**
*   How to set error.
* 
* a)
* if use 
* throw new \InvalidArgumentException("Error text message.");
* log will be writed in [$errorMessage] and [error_validation.log].
* 
* b)
* if use 
* $this->setErrorMessage("Error text message.");
* log will be writed in [$errorMessage].
*
*/

abstract class AppModel
{

    private $errorMessage;
    


    function __construct() {
        $this->beforeInit();
        $this->init();
        $this->afterInit();
    }


    protected function beforeInit()
    {
        $this->errorMessage = "";
    }


    protected function init(){

    }


    protected function afterInit()
    {

    }


    abstract protected function rules();


    /**
    *
    *
    */
    public function validation()
    {
        try {
            if($this->rules() === false){
                return false;
            }
        } catch (\InvalidArgumentException $e) {
            $errorMsg = 'Error on line: '.$e->getLine().' in '.$e->getFile().' Message: <b>'.$e->getMessage().'</b>';
            $this->setError($e->getMessage());     
            return false;
        }     
        
        return true;   
    }


    public function getErrorMessage()
    {
        return $this->errorMessage;
    }


    protected function setErrorMessage($message)
    {
        $this->errorMessage = $message;
    }


    private function setError($message)
    {
        $config = \approot\App::getConfig();
        $path_log = $config["models"]["error_log"];

        if($this->createLogFile($path_log)){
            $this->writeToFile($path_log, $message);
        }

        $this->errorMessage = $message;
    }


    private function createLogFile($path_log)
    {
        if (file_exists($path_log) !== true) {   
            if(!fopen($path_log, "w")){
                trigger_error("The file 'error_validation.log' does not created. Path: ".$path_log, E_USER_ERROR);
                return false;
            }
        } 
        return true;         
    }

    private function writeToFile($path_log, $message)
    {
        $handle = fopen($path_log, "ab");
        $message = "[".date("d-M-Y H:i:s")."] ".$message.PHP_EOL;
        fwrite($handle, $message);
        fclose($handle);        
    }

}




