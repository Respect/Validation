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
 *
 * @covers \Respect\Validation\Rules\AlwaysValid
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paulo Eduardo <pauloelr@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class AlwaysValidTest extends TestCase
{
    public function providerForValidInput(): array
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
     * @test
     *
     * @dataProvider providerForValidInput
     */
    public function itShouldValidateInputWhenItIsAValidAlwaysValid($input): void
    {
        $rule = new AlwaysValid();

        self::assertTrue($rule->validate($input));
    }
}
