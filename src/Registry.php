<?php

declare(strict_types=1);

namespace Horde\Registry;

use Horde\Injector\Injector;
use Psr\Container\ContainerInterface;

/**
 * Registry public interface
 */
interface Registry
{
    /**
     * Expose the DI Container instance internally used
     *
     * @return Injector|ContainerInterface
     */
    public function getContainer(): Injector|ContainerInterface;

    /**
     * List the available applications disregarding their readiness
     *
     * @return iterable<string> The identifier strings used in the DI container
     */
    public function listApplications(): iterable;

    /**
     * Check if an application is present.
     *
     * @return bool
     */
    public function hasApplication(string $application): bool;
}
