<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Equals
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class EqualsTest extends RuleTestCase
{
    /**
     * @test
     */
    public function shouldPassCompareToParameterToException(): void
    {
        $compareTo = new stdClass();
        $equals = new Equals($compareTo);
        $exception = $equals->reportError('input');

        self::assertSame($compareTo, $exception->getParam('compareTo'));
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Equals('foo'), 'foo'],
            [new Equals([]), []],
            [new Equals(new stdClass()), new stdClass()],
            [new Equals(10), '10'],
            [new Equals(10), 10.0],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Equals('foo'), ''],
            [new Equals('foo'), 'bar'],
        ];
    }
}
