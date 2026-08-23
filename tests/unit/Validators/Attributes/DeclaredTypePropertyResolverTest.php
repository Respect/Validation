<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Attributes;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use ReflectionProperty;
use Respect\Validation\Test\Stubs\NestedAddress;
use Respect\Validation\Test\Stubs\WithClassTypedProperty;
use Respect\Validation\Test\Stubs\WithIntersectionTypeNested;
use Respect\Validation\Test\Stubs\WithUnionTypeNested;
use Respect\Validation\Test\Stubs\WithUntypedProperty;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\Given;

use function in_array;

#[Group('rule')]
#[CoversClass(DeclaredTypePropertyResolver::class)]
final class DeclaredTypePropertyResolverTest extends TestCase
{
    private DeclaredTypePropertyResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new DeclaredTypePropertyResolver();
    }

    #[Test]
    public function shouldReturnAttributesForNonBuiltinNamedType(): void
    {
        $property = new ReflectionProperty(WithClassTypedProperty::class, 'value');
        $attributes = new Attributes();

        $result = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $result);
        self::assertSame($attributes, $result[0]);
    }

    #[Test]
    public function shouldReturnAttributesForIntersectionType(): void
    {
        $property = new ReflectionProperty(WithIntersectionTypeNested::class, 'address');
        $attributes = new Attributes();

        $result = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $result);
        self::assertSame($attributes, $result[0]);
    }

    #[Test]
    public function shouldReturnGivenValidatorsForUnionType(): void
    {
        $property = new ReflectionProperty(WithUnionTypeNested::class, 'address');
        $attributes = new Attributes();

        $result = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $result);
        self::assertInstanceOf(Given::class, $result[0]);
        self::assertFalse(in_array($attributes, $result, true));
    }

    #[Test]
    public function shouldReturnEmptyForBuiltinNamedType(): void
    {
        $property = new ReflectionProperty(NestedAddress::class, 'street');
        $attributes = new Attributes();

        $result = $this->resolver->resolve($property, $attributes);

        self::assertSame([], $result);
    }

    #[Test]
    public function shouldReturnEmptyWhenPropertyHasNoDeclaredType(): void
    {
        $property = new ReflectionProperty(WithUntypedProperty::class, 'value');
        $attributes = new Attributes();

        $result = $this->resolver->resolve($property, $attributes);

        self::assertSame([], $result);
    }
}
