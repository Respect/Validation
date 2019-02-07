<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\NotException
 * @covers \Respect\Validation\Rules\Not
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Caio César Tavares <caiotava@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class NotTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     *
     * @dataProvider providerForValidNot
     *
     * @test
     *
     * @param mixed $input
     */
    public function not(Validatable $rule, $input): void
    {
        $not = new Not($rule);
        $not->assert($input);
    }

    /**
     * @dataProvider providerForInvalidNot
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     *
     * @test
     *
     * @param mixed $input
     */
    public function notNotHaha(Validatable $rule, $input): void
    {
        $not = new Not($rule);
        $not->assert($input);
    }

    /**
     * @dataProvider providerForSetName
     *
     * @test
     */
    public function notSetName(Validatable $rule): void
    {
        $not = new Not($rule);
        $not->setName('Foo');

        self::assertEquals('Foo', $not->getName());
        self::assertEquals('Foo', $rule->getName());
    }

    /**
     * @return mixed[][]
     */
    public function providerForValidNot(): array
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
     * @return mixed[][]
     */
    public function providerForInvalidNot(): array
    {
        return [
            [new IntVal(), 123],
            [new AllOf(new AnyOf(new NumericVal(), new IntVal())), 13.37],
            [new AnyOf(new NumericVal(), new IntVal()), 13.37],
            [Validator::anyOf(Validator::numericVal(), Validator::intVal()), 13.37],
        ];
    }

    /**
     * @return Validatable[][]
     */
    public function providerForSetName(): array
    {
        return [
            [new IntVal()],
            [new AllOf(new NumericVal(), new IntVal())],
            [new Not(new Not(new IntVal()))],
            [Validator::intVal()->setName('Bar')],
            [Validator::noneOf(Validator::numericVal(), Validator::intVal())],
        ];
    }
}
