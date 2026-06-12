<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DI\Container;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\ContainerArgumentsResolver;
use Respect\Validation\Test\Stubs\WithAttributes;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Transformers\StubTransformer;
use Respect\Validation\Test\Validators\Injectable;
use Respect\Validation\Transformers\Transformer;

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

    #[Test]
    public function shouldCreateAttributeValidatorsWithArgumentsFromContainerWhenResolverIsGiven(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => new StubTransformer()]));

        $input = new class {
            #[Injectable('some name')]
            public string $property = 'value';
        };

        self::assertValidInput(new Attributes($resolver), $input);
    }

    #[Test]
    public function shouldCreateAttributeValidatorsFromContainerWhenResolverGivenAndAttributeHasNoConstructor(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container());

        $input = new class {
            #[AlwaysValid]
            public string $property = 'value';
        };

        self::assertValidInput(new Attributes($resolver), $input);
    }

    #[Test]
    public function shouldCreateAttributeValidatorsWithTheirDefaultsWithoutResolver(): void
    {
        $input = new class {
            #[Injectable('some name')]
            public string $property = 'value';
        };

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
}
