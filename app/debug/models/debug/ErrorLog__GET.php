<?php
declare(strict_types=1);
namespace approot\debug\models\debug;

use approot\AppModel;




class ErrorLog__GET extends AppModel
{


	protected $path_log_error;
    public $number;
    private $panel_url_debug;


	        
    function beforeValidation(): void{

        $config = \approot\App::getConfig();
        $path_log = $config["app"]["error_log"];    	
    	$this->path_log_error = $path_log;

        $this->panel_url_debug = $config["debug_panel"]["panel_url"];

        // Sanitize variable
        //----------------

        //----------------        
    }



    function rules(): array{
        return [

            ["fileExists", 
                ["path_log_error"]
            ],

            ["numeric", 
                ["number"]
            ],

        ];
    }







    public function getData(){

        $msg_log = $this->tailCustom($this->path_log_error, $this->number);      
        if($msg_log === ""){
            $msg_log = "Here are no logs.";
        }

        //----------------
        $string = htmlspecialchars($msg_log, ENT_COMPAT | ENT_HTML5, "UTF-8");
        $pattern ='/(\[[0-9][0-9]-[a-zA-Z]+-[0-9][0-9][0-9][0-9] [0-9][0-9]:[0-9][0-9]:[0-9][0-9])/i';
        $replacement = '<hr>$1';
        $msg_log = preg_replace($pattern, $replacement, $string);
        //----------------


        //----------------
        $string = $msg_log;
        $pattern ='/(PHP Parse error|PHP Fatal error)/i';
        $replacement = '<span style="background-color: red;">$1</span>';
        $msg_log = preg_replace($pattern, $replacement, $string);
        //----------------


        //----------------
        $string = $msg_log;
        $pattern ='/(PHP Warning)/i';
        $replacement = '<span style="background-color: yellow;">$1</span>';
        $msg_log = preg_replace($pattern, $replacement, $string);
        //----------------

        //----------------
        $string = $msg_log;
        $pattern ='/(PHP Notice)/i';
        $replacement = '<span style="background-color: #7FFFD4;">$1</span>';
        $msg_log = preg_replace($pattern, $replacement, $string);
        //----------------  
        

        return [
            "log" => $msg_log, 
            "panel_url_debug" => $this->panel_url_debug,
            "number_line" => $this->number,
            "header_html" => "Error log",
            "detected_page" => "error_log",
            "page_id" => "error_log",
            "panel_url_debug" => $this->panel_url_debug,
            "url_log_delete" => $this->panel_url_debug . '/api/error_log',
        ];
    }






    /**
     * Slightly modified version of http://www.geekality.net/2011/05/28/php-tail-tackling-large-files/
     * @author Torleif Berger, Lorenzo Stanco
     * @link http://stackoverflow.com/a/15025877/995958
     * @license http://creativecommons.org/licenses/by/3.0/
     */
    private function tailCustom($filepath, $lines = 1, $adaptive = true) {

        // Open file
        $f = @fopen($filepath, "rb");
        if ($f === false) return false;

        // Sets buffer size, according to the number of lines to retrieve.
        // This gives a performance boost when reading a few lines from the file.
        if (!$adaptive) $buffer = 4096;
        else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));

        // Jump to last character
        fseek($f, -1, SEEK_END);

        // Read it and adjust line number if necessary
        // (Otherwise the result would be wrong if file doesn't end with a blank line)
        if (fread($f, 1) != "\n") $lines -= 1;
        
        // Start reading
        $output = '';
        $chunk = '';

        // While we would like more
        while (ftell($f) > 0 && $lines >= 0) {

            // Figure out how far back we should jump
            $seek = min(ftell($f), $buffer);

            // Do the jump (backwards, relative to where we are)
            fseek($f, -$seek, SEEK_CUR);

            // Read a chunk and prepend it to our output
            $output = ($chunk = fread($f, $seek)) . $output;

            // Jump back to where we started reading
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

            // Decrease our line counter
            $lines -= substr_count($chunk, "\n");

        }

        // While we have too many lines
        // (Because of buffer size we might have read too many)
        while ($lines++ < 0) {

            // Find first newline and remove all text before that
            $output = substr($output, strpos($output, "\n") + 1);

        }

        // Close file and return
        fclose($f);
        return trim($output);

    }






}





