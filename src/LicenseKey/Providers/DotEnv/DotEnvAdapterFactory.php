<?php
declare(strict_types=1);

namespace PivvenIT\Composer\Installers\ACFPro\LicenseKey\Providers\DotEnv;

class DotEnvAdapterFactory
{
    /**
     * @param \Dotenv\Dotenv|null $dotEnv
     * @return DotEnvAdapterInterface
     */
    public static function build($dotEnv = null): DotEnvAdapterInterface
    {
        if (self::isV4($dotEnv)) {
            // vlucas/phpdotenv ^4.0
            return new DotEnvV4Adapter();
        } else {
            // vlucas/phpdotenv ^3.0
            return new DotEnvV3Adapter();
        }
    }

    /**
     * @param \Dotenv\Dotenv|null $dotEnv
     * @return bool
     */
    public static function isV4($dotEnv = null): bool
    {
        // Here we deliberately specify the namespace as string,
        // to prevent autoloading from kicking in on load of this file
        // This way we can mock it easier in a test
        return method_exists(is_null($dotEnv) ? 'Dotenv\\Dotenv' : get_class($dotEnv), 'createImmutable');
    }
}
