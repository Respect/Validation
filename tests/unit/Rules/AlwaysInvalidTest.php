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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\AlwaysInvalid
 */
class AlwaysInvalidTest extends TestCase
{
    public function providerForValidAlwaysInvalid()
    {
        return [
            [0],
            [1],
            ['string'],
            [true],
            [false],
            [null],
            [''],
            [[]],
            [['array_full']],
        ];
    }

    /**
     * @dataProvider providerForValidAlwaysInvalid
     */
    public function testShouldValidateInputWhenItIsAValidAlwaysInvalid($input): void
    {
        $rule = new AlwaysInvalid();

        self::assertFalse($rule->validate($input));
    }
}
