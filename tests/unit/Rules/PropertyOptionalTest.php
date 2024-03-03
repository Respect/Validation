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

#[Group('rule')]
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

        $rule = new PropertyOptional('foo', $wrapped);
        $rule->evaluate($object);

        self::assertEquals([$object->foo], $wrapped->inputs);
    }

    #[Test]
    public function itShouldUpdateWrappedRuleNameWithTheGivenName(): void
    {
        $property = 'foo';
        $wrapped = Stub::daze();

        new PropertyOptional($property, $wrapped);

        self::assertEquals($property, $wrapped->getName());
    }

    #[Test]
    public function itShouldNotUpdateWrappedRuleNameWithTheGivenNameWhenRuleAlreadyHasName(): void
    {
        $name = 'bar';

        $wrapped = Stub::daze();
        $wrapped->setName($name);

        new PropertyOptional('foo', $wrapped);

        self::assertEquals($name, $wrapped->getName());
    }
}
