<?php

declare(strict_types=1);
/**
 * Copyright 2009-2021 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (LGPL). If you
 * did not receive this file, see http://www.horde.org/licenses/lgpl21.
 *
 * @category Horde
 * @package  Exception
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @author   Ralf Lang <lang@b1-systems.de>
 * @license  http://www.horde.org/licenses/lgpl21 LGPL 2.1
 */

namespace Horde\Registry\Test;

use Horde\Registry\ComposerBackedRegistry;
use Horde\Registry\RegistryFactory;
use PHPUnit\Framework\TestCase;

/**
 * Trivial tests for the Horde\Registry.
 *
 * @category Horde
 * @package  Exception
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.horde.org/licenses/lgpl21 LGPL 2.1
 */
class RegistryFactoryTest extends TestCase
{
    public function testCreateComposerBackedRegistry()
    {
        $this->assertInstanceOf(ComposerBackedRegistry::class, RegistryFactory::createComposerBackedRegistry());
    }
}
