<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;

use function mb_convert_encoding;

#[Group('rule')]
#[CoversClass(Charset::class)]
final class CharsetTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowsExceptionWhenCharsetIsNotValid(): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessage('Invalid charset provided: `["UTF-9"]`');

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
        $rule = new Charset('ASCII');

        return [
            [$rule, '日本国'],
            [$rule, 'açaí'],
        ];
    }
}
