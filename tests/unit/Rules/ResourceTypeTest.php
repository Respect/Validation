<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('validator')]
#[CoversClass(ResourceType::class)]
final class ResourceTypeTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForResourceType')]
    public function shouldValidateValidInput(mixed $input): void
    {
        self::assertValidInput(new ResourceType(), $input);
    }

    #[Test]
    #[DataProvider('providerForNonResourceType')]
    public function shouldValidateInvalidInput(mixed $input): void
    {
        self::assertInvalidInput(new ResourceType(), $input);
    }
}
