<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function mb_strtoupper;
use function mt_rand;
use function random_int;
use function uniqid;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\PhpLabel
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PhpLabelTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new PhpLabel();

        return [
            [$rule, '_'],
            [$rule, 'foo'],
            [$rule, 'f00'],
            [$rule, uniqid('_')],
            [$rule, uniqid('a')],
            [$rule, mb_strtoupper(uniqid('_'))],
            [$rule, mb_strtoupper(uniqid('a'))],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new PhpLabel();

        return [
            [$rule, '%'],
            [$rule, '*'],
            [$rule, '-'],
            [$rule, 'f-o-o-'],
            [$rule, "\n"],
            [$rule, "\r"],
            [$rule, "\t"],
            [$rule, ' '],
            [$rule, 'f o o'],
            [$rule, '0ne'],
            [$rule, '0_ne'],
            [$rule, uniqid((string) random_int(0, 9))],
            [$rule, null],
            [$rule, mt_rand()],
            [$rule, 0],
            [$rule, 1],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, new DateTime()],
        ];
    }
}
