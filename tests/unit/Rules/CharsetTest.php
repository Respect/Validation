<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;

use function mb_convert_encoding;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Charset
 */
final class CharsetTest extends RuleTestCase
{
    /**
     * @test
     */
    public function itShouldThrowsExceptionWhenCharsetIsNotValid(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('Invalid charset');

        new Charset('UTF-8', 'UTF-9');
    }

    /**
     * @return array<array{Charset, mixed}>
     */
    public static function providerForValidInput(): array
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
     * @return array<array{Charset, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Charset('ASCII');

        return [
            [$rule, '日本国'],
            [$rule, 'açaí'],
        ];
    }
}
