<?php

// comment out the following two lines when deployed to production
defined('APP1_DEBUG') or define('APP1_DEBUG', true);
defined('APP1_ENV') or define('APP1_ENV', 'dev'); 



require __DIR__ . '/../app/vendor/autoload.php';


(new app\App())->init();



//$config = require __DIR__ . '/../config/web.php';

