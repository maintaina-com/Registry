<?php

declare(strict_types=1);

namespace Horde\Registry\Config;

use Horde\Injector\Injector;
use Horde\Registry\ConfigItem;
use IteratorAggregate;
use Psr\Container\ContainerInterface;

/**
 * Represents one present application
 */
class PresentApplication implements ConfigItemInterface
{
    public function __construct()
    {
    }
}
