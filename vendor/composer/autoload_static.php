<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd7ecbc8a78635cf7e8009a9a05aa8324
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'splitbrain\\phpcli\\' => 18,
            'splitbrain\\PHPArchive\\' => 22,
        ),
        'd' => 
        array (
            'dokuwiki\\plugin\\upgrade\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'splitbrain\\phpcli\\' => 
        array (
            0 => __DIR__ . '/..' . '/splitbrain/php-cli/src',
        ),
        'splitbrain\\PHPArchive\\' => 
        array (
            0 => __DIR__ . '/..' . '/splitbrain/php-archive/src',
        ),
        'dokuwiki\\plugin\\upgrade\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitd7ecbc8a78635cf7e8009a9a05aa8324::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd7ecbc8a78635cf7e8009a9a05aa8324::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd7ecbc8a78635cf7e8009a9a05aa8324::$classMap;

        }, null, ClassLoader::class);
    }
}
