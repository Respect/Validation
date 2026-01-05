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
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Property::class)]
final class PropertyTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForScalarValues')]
    public function itShouldAlwaysInvalidateNonObjectValues(mixed $input): void
    {
        self::assertInvalidInput(new Property('foo', Stub::daze()), $input);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithMissingProperties')]
    public function itShouldAlwaysInvalidateMissingProperties(string $propertyName, object $object): void
    {
        self::assertInvalidInput(new Property($propertyName, Stub::fail(1)), $object);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithExistingProperties')]
    public function itShouldValidateExistingPropertiesWithWrappedRule(string $propertyName, object $object): void
    {
        self::assertValidInput(new Property($propertyName, Stub::pass(1)), $object);
    }

    #[Test]
    #[DataProvider('providerForObjectsWithExistingProperties')]
    public function itShouldInvalidateExistingPropertiesWithWrappedRule(string $propertyName, object $object): void
    {
        self::assertInvalidInput(new Property($propertyName, Stub::fail(1)), $object);
    }

    #[Test]
    public function itShouldValidatePropertyWithTheWrappedRule(): void
    {
        $object = new stdClass();
        $object->foo = 'bar';

        $wrapped = Stub::pass(1);

        $validator = new Property('foo', $wrapped);
        $validator->evaluate($object);

        self::assertEquals([$object->foo], $wrapped->inputs);
    }
}
