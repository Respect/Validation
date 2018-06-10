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

use Respect\Validation\Test\RuleTestCase;
use function mb_convert_encoding;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Charset
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CharsetTest extends RuleTestCase
{
    /**
     * @test
     *
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Invalid charset
     */
    public function itShouldThrowsExceptionWhenCharsetIsNotValid(): void
    {
        new Charset('UTF-8', 'UTF-9');
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Charset('UTF-8'), ''],
            [new Charset('ISO-8859-1'), mb_convert_encoding('açaí', 'ISO-8859-1')],
            [new Charset('UTF-8', 'ASCII'), 'strawberry'],
            [new Charset('ASCII'), mb_convert_encoding('strawberry', 'ASCII')],
            [new Charset('UTF-8'), '日本国'],
            [new Charset('ISO-8859-1', 'EUC-JP'), '日本国'],
            [new Charset('UTF-8'), 'açaí'],
            [new Charset('ISO-8859-1'), 'açaí'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Charset('ASCII');

        return [
            [$rule, '日本国'],
            [$rule, 'açaí'],
        ];
    }
}
