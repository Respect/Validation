<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function mb_strtoupper;
use function mt_rand;
use function random_int;
use function uniqid;

#[Group('validator')]
#[CoversClass(PhpLabel::class)]
final class PhpLabelTest extends RuleTestCase
{
    /** @return iterable<array{PhpLabel, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new PhpLabel();

        return [
            [$validator, '_'],
            [$validator, 'foo'],
            [$validator, 'f00'],
            [$validator, uniqid('_')],
            [$validator, uniqid('a')],
            [$validator, mb_strtoupper(uniqid('_'))],
            [$validator, mb_strtoupper(uniqid('a'))],
        ];
    }

    /** @return iterable<array{PhpLabel, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new PhpLabel();

        return [
            [$validator, '%'],
            [$validator, '*'],
            [$validator, '-'],
            [$validator, 'f-o-o-'],
            [$validator, "\n"],
            [$validator, "\r"],
            [$validator, "\t"],
            [$validator, ' '],
            [$validator, 'f o o'],
            [$validator, '0ne'],
            [$validator, '0_ne'],
            [$validator, uniqid((string) random_int(0, 9))],
            [$validator, null],
            [$validator, mt_rand()],
            [$validator, 0],
            [$validator, 1],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, new DateTime()],
        ];
    }
}
