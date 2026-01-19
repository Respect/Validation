<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;
use stdClass;

#[Group('validator')]
#[CoversClass(PropertyOptional::class)]
final class PropertyOptionalTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForScalarValues')]
    public function itShouldAlwaysValidateNonObjectValues(mixed $input): void
    {
        self::assertValidInput(new PropertyOptional('foo', Stub::daze()), $input);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithMissingProperties')]
    public function itShouldAlwaysValidateMissingProperties(string $propertyName, object $object): void
    {
        self::assertValidInput(new PropertyOptional($propertyName, Stub::daze()), $object);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithExistingProperties')]
    public function itShouldValidateExistingPropertiesWithWrappedRule(string $propertyName, object $object): void
    {
        self::assertValidInput(new PropertyOptional($propertyName, Stub::pass(1)), $object);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithExistingProperties')]
    public function itShouldInvalidateExistingPropertiesWithWrappedRule(string $propertyName, object $object): void
    {
        self::assertInvalidInput(new PropertyOptional($propertyName, Stub::fail(1)), $object);
    }

    #[Test]
    public function itShouldValidatePropertyWithTheWrappedRule(): void
    {
        $object = new stdClass();
        $object->foo = 'bar';

        $wrapped = Stub::pass(1);

        $validator = new PropertyOptional('foo', $wrapped);
        $validator->evaluate($object);

        self::assertEquals([$object->foo], $wrapped->inputs);
    }
}
