<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit0427d20c04ac6e831e344836a2ba468b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit0427d20c04ac6e831e344836a2ba468b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit0427d20c04ac6e831e344836a2ba468b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit0427d20c04ac6e831e344836a2ba468b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
