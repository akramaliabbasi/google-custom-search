<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7c85816adbfec11539bff7cc077acc29
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Abbaiakram\\GoogleCustomSearch\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Abbaiakram\\GoogleCustomSearch\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7c85816adbfec11539bff7cc077acc29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7c85816adbfec11539bff7cc077acc29::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7c85816adbfec11539bff7cc077acc29::$classMap;

        }, null, ClassLoader::class);
    }
}