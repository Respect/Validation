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
 * @covers \Respect\Validation\Rules\Luhn
 *
 * @author Alexander Gorshkov <mazanax@yandex.ru>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LuhnTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Luhn();

        return [
            '17 digits string' => [$rule, '2222400041240011'],
            '16 digits string' => [$rule, '340316193809364'],
            'integer' => [$rule, 6011000990139424],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Luhn();

        return [
            'invalid string' => [$rule, '2222400041240021'],
            'invalid integer' => [$rule, 340316193809334],
            'float' => [$rule, 222240004124001.1],
            'boolean true' => [$rule, true],
            'boolean false' => [$rule, false],
            'empty' => [$rule, ''],
            'object' => [$rule, new stdClass()],
            'array' => [$rule, [2222400041240011]],
        ];
    }
}
