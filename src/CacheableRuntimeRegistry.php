<?php

declare(strict_types=1);

namespace Horde\Registry;

use Horde\Injector\Injector;
use Horde\Registry\Config\ApplicationList;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * Composer backed registry intended for the discovery phase or live development.
 */
class CacheableRuntimeRegistry implements Registry
{
    public function __construct(
        private Injector|ContainerInterface $container,
        private ?CacheInterface $cache = null,
        private string $cacheKey = self::class . __DIR__
    ) {
    }
    /**
     * Expose the DI Container instance internally used
     *
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * List the available applications disregarding their readiness
     *
     * This is supposed to be static during a normal operations cycle
     *
     * @return iterable<string> The identifier strings used in the DI container
     */
    public function listApplications(): iterable
    {
        // Preliminary implementation
        return new ApplicationList();
    }

    /**
     * Check if an application is present.
     *
     * @string The application by its vendor/package name
     *
     * @return bool
     */
    public function hasApplication(string $application): bool
    {
        return false;
    }
}
