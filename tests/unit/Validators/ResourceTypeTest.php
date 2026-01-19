<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

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
