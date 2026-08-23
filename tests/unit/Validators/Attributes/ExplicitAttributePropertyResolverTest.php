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
use Respect\Validation\Test\Stubs\WithExplicitAttributesAttributeProperty;
use Respect\Validation\Test\Stubs\WithExplicitStringTypeProperty;
use Respect\Validation\Test\Stubs\WithNoValidatorAttributes;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\StringType;

use function in_array;

#[Group('rule')]
#[CoversClass(ExplicitAttributePropertyResolver::class)]
final class ExplicitAttributePropertyResolverTest extends TestCase
{
    private ExplicitAttributePropertyResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new ExplicitAttributePropertyResolver();
    }

    #[Test]
    public function shouldReturnEmptyWhenPropertyHasNoValidatorAttributes(): void
    {
        $property = new ReflectionProperty(WithNoValidatorAttributes::class, 'value');
        $attributes = new Attributes();

        $result = $this->resolver->resolve($property, $attributes);

        self::assertSame([], $result);
    }

    #[Test]
    public function shouldReturnValidatorWhenPropertyHasSingleValidatorAttribute(): void
    {
        $property = new ReflectionProperty(WithExplicitStringTypeProperty::class, 'name');
        $attributes = new Attributes();

        $result = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $result);
        self::assertInstanceOf(StringType::class, $result[0]);
        self::assertFalse(in_array($attributes, $result, true));
    }

    #[Test]
    public function shouldReturnAttributesWhenPropertyHasAttributesAttribute(): void
    {
        $property = new ReflectionProperty(WithExplicitAttributesAttributeProperty::class, 'address');
        $attributes = new Attributes();

        $result = $this->resolver->resolve($property, $attributes);

        self::assertCount(1, $result);
        self::assertSame($attributes, $result[0]);
        self::assertTrue(in_array($attributes, $result, true));
    }
}
