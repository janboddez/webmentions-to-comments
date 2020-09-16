<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0ae9377401b72b1ac6a478e25997d4b9
{
    public static $files = array (
        '757772e28a0943a9afe83def8db95bdf' => __DIR__ . '/..' . '/mf2/mf2/Mf2/Parser.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Masterminds\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Masterminds\\' => 
        array (
            0 => __DIR__ . '/..' . '/masterminds/html5/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'I' => 
        array (
            'IndieWeb' => 
            array (
                0 => __DIR__ . '/..' . '/indieweb/mention-client/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0ae9377401b72b1ac6a478e25997d4b9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0ae9377401b72b1ac6a478e25997d4b9::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit0ae9377401b72b1ac6a478e25997d4b9::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
