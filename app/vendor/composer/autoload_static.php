<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit83f3b8003c0bdf1777fbc66c722eddce
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/..',
        ),
    );

    public static $classMap = array (
        'app\\App' => __DIR__ . '/../..' . '/App.php',
        'app\\AppControllers' => __DIR__ . '/../..' . '/AppControllers.php',
        'app\\AppModel' => __DIR__ . '/../..' . '/AppModel.php',
        'app\\AppRouting' => __DIR__ . '/../..' . '/AppRouting.php',
        'app\\controllers\\MyController' => __DIR__ . '/../..' . '/../controllers/MyController.php',
        'app\\models\\MyModel' => __DIR__ . '/../..' . '/../models/MyModel.php',
        'app\\settings\\routing\\Routing' => __DIR__ . '/../..' . '/../settings/routing/Routing.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit83f3b8003c0bdf1777fbc66c722eddce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit83f3b8003c0bdf1777fbc66c722eddce::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit83f3b8003c0bdf1777fbc66c722eddce::$classMap;

        }, null, ClassLoader::class);
    }
}