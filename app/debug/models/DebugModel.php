<?php
namespace approot\debug\models;

use approot\AppModel;
use approot\functions\Assert;
// [1] https://github.com/webmozart/assert
// [2] https://github.com/Respect/Validation

class DebugModel extends AppModel
{

	private $path_log_error;

	        
    function init(){
        $config = \approot\App::getConfig();
        $path_log = $config["app"]["error_log"];    	
    	$this->path_log_error = $path_log;
    }


    function rules(){

		if(!Assert::validation("fileExists", $this->path_log_error)){
				throw new \InvalidArgumentException('The file <br>'.$this->path_log_error.'<br> does not found.');
			return false;
		}

    }


}





