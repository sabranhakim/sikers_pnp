<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9ab1a8e42f372a532bb94d1aa505b08
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb9ab1a8e42f372a532bb94d1aa505b08::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb9ab1a8e42f372a532bb94d1aa505b08::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb9ab1a8e42f372a532bb94d1aa505b08::$classMap;

        }, null, ClassLoader::class);
    }
}