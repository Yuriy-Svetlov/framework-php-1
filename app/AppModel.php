<?php
declare(strict_types=1);
namespace approot;


use approot\classes\Assert;



/**
*
*
*/
abstract class AppModel
{

    private $errorMessage;
    


    function __construct() {
        $this->init();
    }



    /**
    *
    *
    */
    protected function init(): void{

    }



    /**
    *
    *
    */
    protected function beforeValidation(): void{
        
    }



    /**
    *   Validation rules
    *   Uses the library to validate: https://github.com/webmozart/assert
    *   
    * @return array Array must contains data for validation
    * @example 
    *
    *   ["integer", 
    *        ["variable_1", "variable_2"],
    *        ["message" => "My custom message!"]
    *    ],
    *
    *    ["length", 
    *        ["variable_1", "variable_2"],
    *        [9, "message" => "My custom message!"]
    *    ],
    *   //-------------------------
    *
    *
    *   Using custom method
    *   //-------------------------
    *   ["custom_methods", 
    *        ["my_function", "my_function2"],
    *   ],
    *
    *    public function my_function(){
    *        if(1 == 2){
    *            throw new \InvalidArgumentException("Incorrect value");
    *        }
    *    }
    *    //-------------------------
    *
    */
    abstract protected function rules(): array;



    /**
    *
    *
    */
    final public function validation(): bool
    {
        $this->beforeValidation();
        return $this->validation_step_1($this->rules());
    }



    /**
    *
    *
    */
    private function validation_step_1(array $arr): bool{
        foreach ($arr as $key => $value) {
            $arguments = [];

            if (count($value) > 2) {
                $arguments = $value[2];
            }

            if($this->validation_step_2($value[0], $value[1], $arguments) !== true){
                return false;
            }
        }

        return true;
    }



    /**
    *
    *
    */
    private function validation_step_2(string $method, array $variables, array $arguments = []): bool{

        foreach ($variables as $key => $variable) {
            //------------------
            try {

                if($method !== "custom_methods"){
                    $args = array_merge([$this->$variable], $arguments);
                    \call_user_func_array('Webmozart\Assert\Assert::'.$method, $args);
                }else{
                    $this->$variable();
                }

            } catch (\InvalidArgumentException $e) {

                $arr = [];
                $arr["message"] = $e->getMessage();

                $labels_arr = $this->getLabels();
                if(array_key_exists($variable, $labels_arr) === true){
                    $arr["property"] = $labels_arr[$variable];
                }else{
                    $arr["property"] = $variable;
                }
                
                $arr["class"] = get_class($this);

                $this->setError($arr);
                return false;
            }
            //------------------
        }

        return true;
    }



    /**
    * Setting label name for value in current model.
    *    
    * @return array Array must contains data of labels names for values in current model        
    * @example 
    *    protected function getLabels(): array
    *    {
    *        return [
    *            "my_function2" => "My label name"
    *        ];
    *    }    
    */
    protected function getLabels(): array
    {
        return [];
    }



    /**
    *
    *
    */
    final public function getError(): array
    {
        return $this->errorMessage;
    }



    /**
    *
    *
    */
    final protected function setError(array $msg): void
    {
        // Sanitize message
        //-----------------------
        //$msg["message"] = \approot\classes\Sanitize::del_all_except($msg["message"]);
        $msg["message"] = strip_tags($msg["message"]);
        //-----------------------

        // Write to log file
        //-----------------------
        if(constant("APP1_DEBUG") === true){

            // Get web-configuration
            $config = \approot\App::getConfig();
            $path_log = $config["models"]["error_log"];

             // Create log file
            if(\approot\classes\Files::createFile($path_log) === true){
                $m = "[Error model validation][".$msg["message"]."] in Class [".$msg["class"]."] in Property [".$msg["property"]."]";
                \approot\classes\Files::writeToFile($path_log, $m);
            }
        }
        //-----------------------

        $this->errorMessage = $msg;
    }






}




