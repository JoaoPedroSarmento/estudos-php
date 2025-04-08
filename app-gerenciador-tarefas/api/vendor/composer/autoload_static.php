<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd3aa05a349a992d79ed35c68cd9cd7df
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
        1 => __DIR__ . '/../..' . '/src/controller',
        2 => __DIR__ . '/../..' . '/src/excecoes',
        3 => __DIR__ . '/../..' . '/src/model',
        4 => __DIR__ . '/../..' . '/src/model/times',
        5 => __DIR__ . '/../..' . '/src/model/usuarios',
        6 => __DIR__ . '/../..' . '/src/util',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInitd3aa05a349a992d79ed35c68cd9cd7df::$fallbackDirsPsr4;
            $loader->classMap = ComposerStaticInitd3aa05a349a992d79ed35c68cd9cd7df::$classMap;

        }, null, ClassLoader::class);
    }
}
