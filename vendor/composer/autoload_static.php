<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd7635ad1d2cb3e723a58438c4249106f
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Komboamina\\Ulizeko\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Komboamina\\Ulizeko\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd7635ad1d2cb3e723a58438c4249106f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd7635ad1d2cb3e723a58438c4249106f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd7635ad1d2cb3e723a58438c4249106f::$classMap;

        }, null, ClassLoader::class);
    }
}