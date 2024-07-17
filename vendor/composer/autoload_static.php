<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbb62fbad28d62bc877447375abe46cb6
{
    public static $prefixesPsr0 = array (
        'N' => 
        array (
            'Net_DNS2' => 
            array (
                0 => __DIR__ . '/..' . '/pear/net_dns2',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitbb62fbad28d62bc877447375abe46cb6::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitbb62fbad28d62bc877447375abe46cb6::$classMap;

        }, null, ClassLoader::class);
    }
}