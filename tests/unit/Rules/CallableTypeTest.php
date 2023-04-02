<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\WithMethods;
use stdClass;

use const INF;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\CallableType
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CallableTypeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new CallableType();

        return [
            [$rule, static fn() => null],
            [$rule, 'trim'],
            [$rule, WithMethods::class . '::publicStaticMethod'],
            [$rule, [new WithMethods(), 'publicMethod']],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new CallableType();

        return [
            [$rule, ' '],
            [$rule, INF],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, null],
        ];
    }
}
