<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd6354be1cb4c214e96afad6dcc61adef
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Phpml' => 
            array (
                0 => __DIR__ . '/..' . '/php-ai/php-ml/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitd6354be1cb4c214e96afad6dcc61adef::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitd6354be1cb4c214e96afad6dcc61adef::$classMap;

        }, null, ClassLoader::class);
    }
}
