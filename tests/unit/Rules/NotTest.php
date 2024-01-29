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
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

#[Group('rule')]
#[CoversClass(Not::class)]
final class NotTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForValidNot')]
    public function not(Validatable $rule, mixed $input): void
    {
        $this->expectNotToPerformAssertions();

        $not = new Not($rule);
        $not->assert($input);
    }

    #[Test]
    #[DataProvider('providerForInvalidNot')]
    public function notNotHaha(Validatable $rule, mixed $input): void
    {
        $not = new Not($rule);

        $this->expectException(ValidationException::class);

        $not->assert($input);
    }

    #[Test]
    #[DataProvider('providerForSetName')]
    public function notSetName(Validatable $rule): void
    {
        $not = new Not($rule);
        $not->setName('Foo');

        self::assertEquals('Foo', $not->getName());
        self::assertEquals('Foo', $not->getNegatedRule()->getName());
    }

    /**
     * @return array<array{Validatable, mixed}>
     */
    public static function providerForValidNot(): array
    {
        return [
            [new IntVal(), ''],
            [new IntVal(), 'aaa'],
            [new AllOf(new NoWhitespace(), new Digit()), 'as df'],
            [new AllOf(new NoWhitespace(), new Digit()), '12 34'],
            [new AllOf(new AllOf(new NoWhitespace(), new Digit())), '12 34'],
            [new AllOf(new NoneOf(new NumericVal(), new IntVal())), 13.37],
            [new NoneOf(new NumericVal(), new IntVal()), 13.37],
            [Validator::noneOf(Validator::numericVal(), Validator::intVal()), 13.37],
        ];
    }

    /**
     * @return array<array{Validatable, mixed}>
     */
    public static function providerForInvalidNot(): array
    {
        return [
            [new IntVal(), 123],
            [new AllOf(new AnyOf(new NumericVal(), new IntVal())), 13.37],
            [new AnyOf(new NumericVal(), new IntVal()), 13.37],
            [Validator::anyOf(Validator::numericVal(), Validator::intVal()), 13.37],
        ];
    }

    /**
     * @return array<array{Validatable}>
     */
    public static function providerForSetName(): array
    {
        return [
            'non-allOf' => [new IntVal()],
            'allOf' => [new AllOf(new NumericVal(), new IntVal())],
            'not' => [new Not(new Not(new IntVal()))],
            'allOf with name' => [Validator::intVal()->setName('Bar')],
            'noneOf' => [Validator::noneOf(Validator::numericVal(), Validator::intVal())],
        ];
    }
}
