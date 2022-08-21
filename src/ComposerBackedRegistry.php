<?php

declare(strict_types=1);

namespace Horde\Registry;

use Composer\InstalledVersions;
use Horde\Hordectl\Command\Import\App;
use Horde\Injector\Injector;
use Horde\Registry\Config\ApplicationList;
use Psr\Container\ContainerInterface;
use Twig\TokenParser\ApplyTokenParser;

/**
 * Composer backed registry intended for the discovery phase or live development.
 * This registry is caching between requests by design
 */
class ComposerBackedRegistry implements Registry
{
    public function __construct(private Injector|ContainerInterface $container)
    {
        // Implicitly discovers and sets up with the autoloader
        $this->listApplications();
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
    public function listApplications(): ApplicationList
    {
        // Preliminary implementation
        if ($this->getContainer()->has(ApplicationList::class)) {
            return $this->getContainer()->get(ApplicationList::class);
        }
        // Discover and set

        // We don't use getInstalledPackagesByType() as we want to mind provides(), too
        foreach (InstalledVersions::getInstalledPackages() as $packageName) {
        }
        return new ApplicationList();
    }

    /**
     * Check if an application is present.
     *
     * @return bool
     */
    public function hasApplication(string $application): bool
    {
        return false;
    }
}
