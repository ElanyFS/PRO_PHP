<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8610f5416b46249e6fa67941b8efbb2f
{
    public static $files = array (
        'ee81c80c1e5909316ff038d9d7f9b239' => __DIR__ . '/../..' . '/app/helpers/constants.php',
        '8bc4183245d2a87933a6d2626df13b62' => __DIR__ . '/../..' . '/app/router/router.php',
        'a14e9838e830ff9603ee78620c1671b9' => __DIR__ . '/../..' . '/app/router/routes.php',
        'e477b60f38b9cff1dc7fcfe2a4357a1c' => __DIR__ . '/../..' . '/app/core/controller.php',
        '172eabd95d947b73e87b919add7d2d22' => __DIR__ . '/../..' . '/app/controllers/Home.php',
        'bbf1ae681a36fd4f4a3d6f6b6aa44401' => __DIR__ . '/../..' . '/app/controllers/User.php',
        '7ddb79b62574f5e86e505ebb646b899f' => __DIR__ . '/../..' . '/app/database/connect.php',
        '66fd6e1ecb032cf4203a2e268f68c9f5' => __DIR__ . '/../..' . '/app/database/fetch.php',
    );

    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'app\\controllers\\Home' => __DIR__ . '/../..' . '/app/controllers/Home.php',
        'app\\controllers\\User' => __DIR__ . '/../..' . '/app/controllers/User.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8610f5416b46249e6fa67941b8efbb2f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8610f5416b46249e6fa67941b8efbb2f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8610f5416b46249e6fa67941b8efbb2f::$classMap;

        }, null, ClassLoader::class);
    }
}
