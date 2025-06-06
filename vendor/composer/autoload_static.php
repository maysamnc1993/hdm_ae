<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf6f07120384c0dbb89f79da80e3ede00
{
    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'JThem\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'JThem\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf6f07120384c0dbb89f79da80e3ede00::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf6f07120384c0dbb89f79da80e3ede00::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf6f07120384c0dbb89f79da80e3ede00::$classMap;

        }, null, ClassLoader::class);
    }
}
