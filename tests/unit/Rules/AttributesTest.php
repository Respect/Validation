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
use Respect\Validation\Test\Stubs\WithAttributes;
use Respect\Validation\Test\TestCase;

#[Group(' rule')]
#[CoversClass(Attributes::class)]
final class AttributesTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonObjectTypes')]
    public function shouldNotEvaluateNonObjects(mixed $input): void
    {
        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    #[DataProvider('providerForObjectTypesWithoutAttributes')]
    public function shouldEvaluateObjectsWithoutPhpAttributes(object $input): void
    {
        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithValidPropertyValues')]
    public function shouldNotEvaluateObjectsWithValidPropertyValues(object $input): void
    {
        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithInvalidPropertyValues')]
    public function shouldNotEvaluateObjectsWithInvalidPropertyValues(object $input): void
    {
        self::assertInvalidInput(new Attributes(), $input);
    }

    /** @return array<string, array{object}> */
    public static function providerForObjectsWithValidPropertyValues(): array
    {
        return [
            'All' => [
                new WithAttributes(
                    'John Doe',
                    '2020-06-23',
                    'john.doe@gmail.com',
                    '+31206241111',
                    'Amstel 1 1011 PN AMSTERDAM Noord-Holland'
                ),
            ],
            'Only required' => [new WithAttributes('Jane Doe', '2017-11-30', 'janedoe@yahoo.com')],
        ];
    }

    /** @return array<array{object}> */
    public static function providerForObjectsWithInvalidPropertyValues(): array
    {
        return [
            [new WithAttributes('Jane Doe', '2017-11-30')],
            [new WithAttributes('', 'not a date', 'not an email', 'not a phone number')],
            [new WithAttributes('', '1912-06-23', 'john.doe@gmail.com', '+1234567890')],
            [new WithAttributes('John Doe', '1912-06-23', 'not an email', '+1234567890')],
            [new WithAttributes('John Doe', 'not a date', 'john.doe@gmail.com', '+1234567890')],
            [new WithAttributes('John Doe', '1912-06-23', 'john.doe@gmail.com', 'not a phone number')],
        ];
    }
}
