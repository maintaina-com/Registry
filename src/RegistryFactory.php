<?php

declare(strict_types=1);

namespace Horde\Registry;

use Composer\InstalledVersions;
use Horde\Injector\Injector;
use Horde\Injector\TopLevel;
use Psr\Container\ContainerInterface;
use RuntimeException;
use Twig\Error\RuntimeError;

/**
 * Assemble a Registry
 */
class RegistryFactory
{
    /**
     * Automatically find out the right implementation
     *
     * @return Registry
     * @throws RuntimeException
     */
    public static function autodetect(): Registry
    {
        // Installed/autoloaded composer scenario
        if (class_exists(InstalledVersions::class)) {
            return self::createComposerBackedRegistry();
        }
        throw new RuntimeException('No registry version could be autodetected');
    }

    public static function createComposerBackedRegistry(?ContainerInterface $container = null): ComposerBackedRegistry
    {
        $container ??= new Injector(new TopLevel());
        return new ComposerBackedRegistry($container);
    }
}
