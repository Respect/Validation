<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Stubs\CyclicNode;
use Respect\Validation\Test\Stubs\NestedAddress;
use Respect\Validation\Test\Stubs\NestedPassThrough;
use Respect\Validation\Test\Stubs\NestedValidated;
use Respect\Validation\Test\Stubs\NestedWithAttributes;
use Respect\Validation\Test\Stubs\NestedWithoutAttributes;
use Respect\Validation\Test\Stubs\WithAttributes;
use Respect\Validation\Test\Stubs\WithAttributesNotLastOnNested;
use Respect\Validation\Test\Stubs\WithCyclicAttributes;
use Respect\Validation\Test\Stubs\WithDeeplyNestedAttributes;
use Respect\Validation\Test\Stubs\WithExplicitAttributesOnNested;
use Respect\Validation\Test\Stubs\WithIntersectionTypeNested;
use Respect\Validation\Test\Stubs\WithNestedAttributes;
use Respect\Validation\Test\Stubs\WithNestedWithoutAttributes;
use Respect\Validation\Test\Stubs\WithNullableNestedAttributes;
use Respect\Validation\Test\Stubs\WithUnionTypeNested;
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
                    'Amstel 1 1011 PN AMSTERDAM Noord-Holland',
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

    #[Test]
    public function shouldRecursivelyValidateNestedObjectsWithAttributes(): void
    {
        $validAddress = new NestedAddress('123 Main St', 'Springfield');
        $input = new WithNestedAttributes('John Doe', $validAddress);

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRecursivelyValidateNestedObjectsWithInvalidValues(): void
    {
        $invalidAddress = new NestedAddress('', 'not a city');
        $input = new WithNestedAttributes('John Doe', $invalidAddress);

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRecursivelyValidateNestedObjectPropertyFails(): void
    {
        $invalidAddress = new NestedAddress('123 Main St', '');
        $input = new WithNestedAttributes('John Doe', $invalidAddress);

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldNotRecursivelyValidateNestedObjectsWithoutAttributes(): void
    {
        $nested = new NestedWithoutAttributes('anything');
        $input = new WithNestedWithoutAttributes('John Doe', $nested);

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldHandleNullableNestedObjectsWhenNull(): void
    {
        $input = new WithNullableNestedAttributes('John Doe', null);

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldHandleNullableNestedObjectsWhenValid(): void
    {
        $validAddress = new NestedAddress('123 Main St', 'Springfield');
        $input = new WithNullableNestedAttributes('John Doe', $validAddress);

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldHandleNullableNestedObjectsWhenInvalid(): void
    {
        $invalidAddress = new NestedAddress('', '');
        $input = new WithNullableNestedAttributes('John Doe', $invalidAddress);

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateDeeplyNestedSkippingEmptyLevels(): void
    {
        $leaf = new NestedValidated('hello');
        $middle = new NestedPassThrough($leaf);
        $top = new NestedPassThrough($middle);
        $input = new WithDeeplyNestedAttributes('John Doe', $top);

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldInvalidateDeeplyNestedSkippingEmptyLevels(): void
    {
        $leaf = new NestedValidated('');
        $middle = new NestedPassThrough($leaf);
        $top = new NestedPassThrough($middle);
        $input = new WithDeeplyNestedAttributes('John Doe', $top);

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRecursivelyValidateUnionTypeNestedWhenValid(): void
    {
        $input = new WithUnionTypeNested('John Doe', '123 Main St');

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRecursivelyValidateUnionTypeNestedWhenValidNestedAttributes(): void
    {
        $validAddress = new NestedAddress('123 Main St', 'Springfield');
        $input = new WithUnionTypeNested('John Doe', $validAddress);

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRecursivelyValidateUnionTypeNestedWhenInvalid(): void
    {
        $invalidAddress = new NestedAddress('', '');
        $input = new WithUnionTypeNested('John Doe', $invalidAddress);

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRecursivelyValidateIntersectionTypeNestedWhenValid(): void
    {
        $validAddress = new NestedWithAttributes('123 Main St', 'Springfield');
        $input = new WithIntersectionTypeNested('John Doe', $validAddress);

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRecursivelyValidateIntersectionTypeNestedWhenInvalid(): void
    {
        $invalidAddress = new NestedWithAttributes('', '');
        $input = new WithIntersectionTypeNested('John Doe', $invalidAddress);

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateNestedObjectWithExplicitAttributesWhenValid(): void
    {
        $validAddress = new NestedAddress('123 Main St', 'Springfield');
        $input = new WithExplicitAttributesOnNested('John Doe', $validAddress);

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldValidateNestedObjectWithExplicitAttributesWhenInvalid(): void
    {
        $invalidAddress = new NestedAddress('', '');
        $input = new WithExplicitAttributesOnNested('John Doe', $invalidAddress);

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldNotDuplicateAttributesWhenNotTheLastAttributeOnNestedProperty(): void
    {
        $input = new WithAttributesNotLastOnNested(new NestedAddress('123 Main St', 'Springfield'));

        self::assertValidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRejectSelfReferencingCyclicObjectGraph(): void
    {
        $node = new CyclicNode('hello');
        $node->next = $node;

        $input = new WithCyclicAttributes('John Doe', $node);

        self::assertInvalidInput(new Attributes(), $input);
    }

    #[Test]
    public function shouldRejectMutualCyclicObjectGraph(): void
    {
        $nodeA = new CyclicNode('hello');
        $nodeB = new CyclicNode('world');
        $nodeA->next = $nodeB;
        $nodeB->next = $nodeA;

        $input = new WithCyclicAttributes('John Doe', $nodeA);

        self::assertInvalidInput(new Attributes(), $input);
    }
}
