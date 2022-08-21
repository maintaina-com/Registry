<?php

declare(strict_types=1);

namespace Horde\Registry\Config;

use ArrayIterator;
use Horde\Injector\Injector;
use Horde\Registry\ConfigItemInterface;
use Iterator;
use IteratorAggregate;
use Psr\Container\ContainerInterface;

/**
 * Represents one installed application
 *
 */
class ApplicationList implements ConfigListInterface, IteratorAggregate
{
    private array $applications = [];

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->applications);
    }

    public function __construct(PresentApplication ...$applications)
    {
        $this->applications = $applications;
    }
}
