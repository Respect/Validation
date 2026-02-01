<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\Validators\Stub;
use Respect\Validation\ValidatorBuilder;

#[Group('validator')]
#[CoversClass(KeySet::class)]
final class KeySetTest extends TestCase
{
    #[Test]
    public function nonKeyRelatedRuleShouldNotBeAllowed(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('You must provide only key-related rules');

        new KeySet(new Equals('foo'));
    }

    /** @return iterable<string, array{KeySet, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'correct keys, with passing rule' => [new KeySet(new Key('foo', Stub::pass(1))), ['foo' => 'bar']];
        yield 'multiple correct keys, with passing rules' => [
            new KeySet(new Key('foo', Stub::pass(1)), new Key('bar', Stub::pass(1)), new Key('baz', Stub::pass(1))),
            ['foo' => 'value1', 'bar' => 'value2', 'baz' => 'value3'],
        ];
    }

    /** @return iterable<string, array{KeySet, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'not an array' => [new KeySet(new KeyExists('foo')), null];
        yield 'missing keys' => [new KeySet(new KeyExists('foo')), []];
        yield 'extra keys, missing keys' => [
            new KeySet(new KeyExists('foo')),
            ['baz' => 'qux'],
        ];

        yield 'extra keys, failed rule' => [
            new KeySet(new Key('foo', Stub::pass(1))),
            ['foo' => 'bar', 'baz' => 'qux'],
        ];

        yield 'missing key, failed rule' => [
            new KeySet(new Key('foo', Stub::fail(1)), new KeyExists('bar')),
            ['foo' => 'bar', 'baz' => 'qux'],
        ];

        yield 'extra keys, with failing rule' => [
            new KeySet(new Key('foo', Stub::fail(1))),
            ['foo' => 'bar', 'baz' => 'qux'],
        ];

        yield 'correct keys, with failing rule' => [new KeySet(new Key('foo', Stub::fail(1))), ['foo' => 'bar']];
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldEvaluateShortCircuitValidInput(KeySet $validator, mixed $input): void
    {
        self::assertTrue($validator->evaluateShortCircuit($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldNotEvaluateShortCircuitValidInput(KeySet $validator, mixed $input): void
    {
        self::assertFalse($validator->evaluateShortCircuit($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForValidInput')]
    public function shouldEvaluateValidInput(KeySet $validator, mixed $input): void
    {
        self::assertTrue($validator->evaluate($input)->hasPassed);
    }

    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function shouldNotEvaluateValidInput(KeySet $validator, mixed $input): void
    {
        self::assertFalse($validator->evaluate($input)->hasPassed);
    }

    #[Test]
    public function shouldExtractKeyRelatedValidatorsFromValidatorBuilder(): void
    {
        $validator = new KeySet(ValidatorBuilder::init(new Key('foo', Stub::pass(2)), new Key('bar', Stub::pass(2))));

        self::assertTrue($validator->evaluate(['foo' => 'value1', 'bar' => 'value2'])->hasPassed);
        self::assertTrue($validator->evaluateShortCircuit(['foo' => 'value1', 'bar' => 'value2'])->hasPassed);
    }

    #[Test]
    public function shouldShortCircuitStopEvaluatingAfterFirstFailure(): void
    {
        $stub1 = new Stub(false);
        $stub2 = Stub::daze();
        $stub3 = Stub::daze();
        $validator = new KeySet(new Key('foo', $stub1), new Key('bar', $stub2), new Key('baz', $stub3));

        $result = $validator->evaluateShortCircuit(['foo' => 'value', 'bar' => 'value', 'baz' => 'value']);

        self::assertFalse($result->hasPassed);
        self::assertCount(1, $stub1->inputs);
        self::assertCount(0, $stub2->inputs);
        self::assertCount(0, $stub3->inputs);
    }
}
