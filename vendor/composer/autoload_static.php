<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc4fbdaaa490aa5348a919614d9db1184
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc4fbdaaa490aa5348a919614d9db1184::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc4fbdaaa490aa5348a919614d9db1184::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc4fbdaaa490aa5348a919614d9db1184::$classMap;

        }, null, ClassLoader::class);
    }
}