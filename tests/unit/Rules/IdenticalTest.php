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
 * @covers \Respect\Validation\Rules\Identical
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IdenticalTest extends RuleTestCase
{
    /**
     * @test
     */
    public function shouldPassCompareToParameterToException(): void
    {
        $compareTo = new stdClass();
        $rule = new Identical($compareTo);
        $exception = $rule->reportError('input');

        self::assertSame($compareTo, $exception->getParam('compareTo'));
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $object = new stdClass();

        return [
            [new Identical('foo'), 'foo'],
            [new Identical([]), []],
            [new Identical($object), $object],
            [new Identical(10), 10],
            [new Identical(10.0), 10.0],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Identical(42), '42'],
            [new Identical('foo'), 'bar'],
            [new Identical([1]), []],
            [new Identical(new stdClass()), new stdClass()],
            [new Identical(10), 10.0],
        ];
    }
}
