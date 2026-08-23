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
use Respect\Validation\Test\Stubs\StubPropertyResolver;
use Respect\Validation\Test\Stubs\WithMixedProperty;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\IntType;
use Respect\Validation\Validators\StringType;

#[Group('rule')]
#[CoversClass(CompositePropertyResolver::class)]
final class CompositePropertyResolverTest extends TestCase
{
    private ReflectionProperty $property;

    private Attributes $attributes;

    protected function setUp(): void
    {
        $object = new WithMixedProperty();
        $this->property = new ReflectionProperty($object::class, 'value');
        $this->attributes = new Attributes();
    }

    #[Test]
    public function shouldReturnEmptyWhenNoResolversProvided(): void
    {
        $resolver = new CompositePropertyResolver();

        $result = $resolver->resolve($this->property, $this->attributes);

        self::assertSame([], $result);
    }

    #[Test]
    public function shouldReturnEmptyWhenAllResolversReturnEmpty(): void
    {
        $empty = new StubPropertyResolver();

        $resolver = new CompositePropertyResolver($empty, $empty);

        $result = $resolver->resolve($this->property, $this->attributes);

        self::assertSame([], $result);
    }

    #[Test]
    public function shouldConcatenateResultsFromAllResolvers(): void
    {
        $first = new StubPropertyResolver(new StringType());
        $second = new StubPropertyResolver(new IntType());

        $resolver = new CompositePropertyResolver($first, $second);

        $result = $resolver->resolve($this->property, $this->attributes);

        self::assertCount(2, $result);
        self::assertInstanceOf(StringType::class, $result[0]);
        self::assertInstanceOf(IntType::class, $result[1]);
    }

    #[Test]
    public function shouldConcatenateAttributesAlongsideOtherValidators(): void
    {
        $attributes = $this->attributes;

        $terminal = new StubPropertyResolver($attributes);
        $other = new StubPropertyResolver(new StringType());

        $resolver = new CompositePropertyResolver($terminal, $other);

        $result = $resolver->resolve($this->property, $attributes);

        self::assertCount(2, $result);
        self::assertSame($attributes, $result[0]);
        self::assertInstanceOf(StringType::class, $result[1]);
    }

    #[Test]
    public function shouldCollapseDuplicateAttributesAcrossResolvers(): void
    {
        $attributes = $this->attributes;

        // Both resolvers emit the same Attributes instance, as happens for a
        // class-typed property annotated with #[Attributes] (DeclaredType and
        // ExplicitAttribute each return [$attributes]). The composite must
        // collapse them so the nested Attributes validator runs only once.
        $first = new StubPropertyResolver($attributes);
        $second = new StubPropertyResolver($attributes);

        $resolver = new CompositePropertyResolver($first, $second);

        $result = $resolver->resolve($this->property, $attributes);

        self::assertSame([$attributes], $result);
    }
}
