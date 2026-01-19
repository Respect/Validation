<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Guilherme Siani <guilherme@siani.com.br>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: João Torquato <joao.otl@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('validator')]
#[CoversClass(IterableType::class)]
final class IterableTypeTest extends TestCase
{
    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForIterableTypes')]
    public function itShouldValidateIterableTypes(iterable $input): void
    {
        $validator = new IterableType();

        self::assertValidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForNonIterableTypes')]
    public function itShouldInvalidateNonIterableTypes(mixed $input): void
    {
        $validator = new IterableType();

        self::assertInvalidInput($validator, $input);
    }
}
