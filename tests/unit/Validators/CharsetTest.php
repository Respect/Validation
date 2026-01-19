<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\RuleTestCase;

use function mb_convert_encoding;

#[Group('validator')]
#[CoversClass(Charset::class)]
final class CharsetTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowsExceptionWhenCharsetIsNotValid(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('Invalid charset provided: "UTF-9"');

        new Charset('UTF-8', 'UTF-9');
    }

    /** @return iterable<array{Charset, mixed}> */
    public static function providerForValidInput(): iterable
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

    /** @return iterable<array{Charset, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Charset('ASCII');

        return [
            [$validator, '日本国'],
            [$validator, 'açaí'],
        ];
    }
}
