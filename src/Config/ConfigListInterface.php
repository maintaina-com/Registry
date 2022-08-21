<?php

declare(strict_types=1);

namespace Horde\Registry\Config;

use Horde\Injector\Injector;
use Horde\Registry\Config\ConfigItemInterface;
use Horde\Registry\ConfigInterface;
use Psr\Container\ContainerInterface;
use Serializable;
use Traversable;

/**
 * Registry public interface
 *
 * TODO: Serializable
 */
interface ConfigListInterface extends ConfigItemInterface, Traversable
{
}
