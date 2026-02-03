<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Aleksandr Gorshkov <mazanax@yandex.ru>
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Luhn::class)]
final class LuhnTest extends RuleTestCase
{
    /** @return iterable<array{Luhn, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Luhn();

        return [
            '17 digits string' => [$validator, '2222400041240011'],
            '16 digits string' => [$validator, '340316193809364'],
            'integer' => [$validator, 6011000990139424],
        ];
    }

    /** @return iterable<array{Luhn, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Luhn();

        return [
            'invalid string' => [$validator, '2222400041240021'],
            'invalid integer' => [$validator, 340316193809334],
            'float' => [$validator, 222240004124001.1],
            'boolean true' => [$validator, true],
            'boolean false' => [$validator, false],
            'empty' => [$validator, ''],
            'object' => [$validator, new stdClass()],
            'array' => [$validator, [2222400041240011]],
        ];
    }
}
