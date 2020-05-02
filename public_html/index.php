<?php

// comment out the following two lines when deployed to production
defined('APP1_DEBUG') or define('APP1_DEBUG', true);
defined('APP1_ENV') or define('APP1_ENV', 'dev'); 



require __DIR__ . '/../app/vendor/autoload.php';


(new app\App())->init();




// comment out the following two lines when deployed to production
//defined('YII_DEBUG') or define('YII_DEBUG', true);
//defined('YII_ENV') or define('YII_ENV', 'dev');

//require __DIR__ . '/../vendor/autoload.php';
//require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

//$config = require __DIR__ . '/../config/web.php';

//(new yii\web\Application($config))->run();