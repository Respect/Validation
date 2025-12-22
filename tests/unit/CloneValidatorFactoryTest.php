<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(CloneValidatorFactory::class)]
final class CloneValidatorFactoryTest extends TestCase
{
    #[Test]
    public function itClonesTheGivenValidatorToCreateAnotherOne(): void
    {
        $original = Validator::create();

        $factory = new CloneValidatorFactory($original);
        $created = $factory->create();

        self::assertNotSame($original, $created);
    }
}
