# framework-php-1

Very simple/slim framework for PHP

### Basic stracture

/app/

/config/

/config/routing/

/controllers/ 

/models/

/public_html/

/runtime/ 

/runtime/logs/

/views/

/views/layout/



### Routing
Example in
`/config/routing/Routing.php`

```
* @param `$url` (string|regexp) [mandatory] - URL or regular expression. If use regular expression to need set parameter `$reg_exp` to `true`.
*
* @param `$controller` (string) [mandatory] - Classlink to controller
*
* @param `$action` (string) [mandatory] - Name of action function in controller.
*
* @param `$request_method` (false|array) [not mandatory, default is false] - all request methods are allowed  or array of allow request methods
*
* @param `$reg_exp` (boolean) [not mandatory, default is false] - if `true` will be use regular expression in `$url`
*
* @return (boolean) - false is not match URL or not match request method
```
`req($url, $controller, $action, $request_method, $reg_exp)`


Example 

```php
$this->req("/", "\app\controllers\IndexController", "index");

$this->req("/list", "\app\controllers\IndexController", "list", ["GET", "POST"]);

$this->req("/^\/upload\/post.*$/", "\app\controllers\MyController", "post", ["POST"], true);
```
Additional example located  in `/config/routing/Routing.php`


### Group routing

```
* @param `$url` (string|regexp) [mandatory] - URL or regular expression. If use regular expression to need set parameter `$reg_exp` to `true`.
*
* @param `$request_method` (false|array) [not mandatory, default is false] - all request methods are allowed  or array of allow request methods
*
* @param `$reg_exp` (boolean) [not mandatory, default is false] - if `true` will be use regular expression in `$url`
*
* @return `return` (boolean) - false is not match URL or not match request method
```
`
group($url, $request_method, $reg_exp)
`

Example 

```php
if($this->group("/my", ["POST","GET"])){

    $this->req("/my", "\app\controllers\MyController", "index", ["GET"]);

    $this->req("/my/post", "\app\controllers\MyController", "post");
}
```


### Controller

Example in 
`models/controllers/`

    * Response of data in JSON format
    *
    * @param array $data JSON data
    * @param bool $resp_code Code HTTP response, default 200. If will be 'false' HTTP code will not be setted. 
    * @param bool $header Header HTTP response, default is 'Content-Type: application/json', if will set 'false' this header will not be sended. 
    *   
    * @example $this->return_JSON(["status" => "1"]) 
    * @example $this->return_JSON(["status" => "1"], false, false)         
    */ 

`return_JSON($data, $resp_code, $header)`



    /**
    * HTML document output
    *
    * @param string $path_layout Path to document HTML layout
    * @param array $data any data 
    * @param bool $resp_code Code HTTP response, default 200. If will be 'false' HTTP code will not be setted. 
    * @param bool $header Header HTTP response, default is 'Content-type: text/html; charset=utf-8', if will set 'false' this header will not be sended. 
    *   
    * @example $this->return_Layout($this->base_layout, ["view" => $view])
    * @example $this->return_Layout($this->base_layout, ["view" => $view], false, false)        
    */

`return_Layout($path_layout, $data, $resp_code, $header)`


    /**
    * String output
    *
    * @param string $str
    * @param bool $resp_code Code HTTP response, default 200. If will be 'false' HTTP code will not be setted. 
    * @param bool $header Header HTTP response, default is 'Content-type: text/html; charset=utf-8', if will set 'false' this header will not be sended. 
    *   
    * @example $this->return_Str("test")
    *
    * @example header('Content-Type: text/plain; charset=utf-8');
    * @example $this->return_Str("test", true, false)        
    */

`return_Str($str, $resp_code, $header)`


### Model

Example in 
`models/MyModel`

    /**
    *   Validation rules
    *   Uses the library to validate: https://github.com/webmozart/assert
    *   
    * @return array Array must contains data for validation
    * @example 
    *
    *    ["integer", 
    *        ["variable_1", "variable_2"],
    *        ["message" => "My custom message!"]
    *    ],
    *
    *    ["integer", 
    *        ["variable_3", "variable_4"],
    *    ],
    *
    *    ["length", 
    *        ["variable_1", "variable_2"],
    *        [9, "message" => "My custom message!"]
    *    ],
    *
    *    ["lengthBetween", 
    *        ["variable_1", "variable_2"],
    *        [10, 20, "message" => "My custom message!"]
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
    *    // My function in current model of class 
    *    public function my_function(){
    *        if(1 == 2){
    *            throw new \InvalidArgumentException("Incorrect value");
    *        }
    *    }
    *    //-------------------------
    *
    */


`rules()`


    /**
    * Call before validation
    */

`beforeValidation()`


    /**
    * Call from controller for validation
    *
    * @return (boolean) `false` is no data valid
    */

`validation()`


    /**
    * Setting label name for value in current model.
    *    
    * @return array Array must contains data of labels names for values in current model        
    * @example 
    *    protected function getLabels(): array
    *    {
    *        return [
    *            "my_function2" => "My label name 1",
    *            "my_value" => "My label name 2",
    *        ];
    *    }    
    */
`getLabels()`

    /**
    * Get data of error validation
    *   
    * @return string
    */
`getError()`
    
    /**
    * Set error validation
    *
    * @param $msg (array) - Data array - $arr["message"] - Message error, $arr["property"] - variable * name, $arr["class"] - current class of model 
    *
    */
`setError($msg)`
    

    /**
    * Sanitize error message. May be redefine in current model.
    *
    *@return string
    */
    `sanitizeMessage`
Source code
```php
    protected function sanitizeMessage(string $msg): string
    {
        return preg_replace('/([^\\\:\w \]\[]+)/ui', "-", $msg);
    }
```

Разработка сайтов [Веб-студия Харьков](https://web-studio.kh.ua)


## Bugs
  * github - [https://github.com/semiromid/framework-php-1/issues](https://github.com/semiromid/framework-php-1/issues) 

## Author
SEMINA TAMARA


## License
MIT License

Copyright (c) 2020 TAMARA SEMINA

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.