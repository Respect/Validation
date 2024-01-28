<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(NotEmoji::class)]
final class NotEmojiTest extends RuleTestCase
{
    /**
     * @return array<array{NotEmoji, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $sut = new NotEmoji();

        return [
            'Numbers' => [$sut, '0123456789'],
            'Alpha' => [$sut, 'ABCDEFGHIKLMNOPQRSTVXYZabcdefghiklmnopqrstvxyz'],
            'Symbols' => [$sut, '&"\'(-_)@-*/+.'],
            'Unicode symbols' => [$sut, 'çàéè⁊ǷÞÐÆ'],
            'Arabic' => [$sut, 'ضصثقفغعهخحجشسيبلاتنمكطئءؤرلاىةوزظذ'],
            'Russian' => [$sut, 'русский'],
            'Japanese' => [$sut, 'ろぬふあうえおやゆよわ゛へちついすかんなにらせれせ゜たqとしはきくまのりもろむてさそひこみねるめ!'],
        ];
    }

    /**
     * @return array<array{NotEmoji, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $sut = new NotEmoji();

        return [
            'Smileys & People' => [$sut, '🤣'],
            'Backhand Index Pointing Right with modifier' => [$sut, '👉🏿'],
            'Santa Claus with modifier' => [$sut, '🎅🏾'],
            'Man Frowning with modifier' => [$sut, '🙍🏻‍♂️'],
            'Animals & Nature' => [$sut, '🐵'],
            'Food & Drink' => [$sut, '🍎'],
            'Travel & Places' => [$sut, '⛰️'],
            'Activities' => [$sut, '🎈'],
            'Objects' => [$sut, '📢'],
            'Symbols from Unicode 4.0' => [$sut, '⚠️'],
            'Symbols from Unicode 7.0' => [$sut, '⏺️'],
            'Symbols from Unicode 6.0' => [$sut, '✅'],
            'Flags Emoji 1.0' => [$sut, '🇹🇳'],
            'Flags Emoji 4.0' => [$sut, '🏳️‍🌈'],
            'Flags Emoji 5.0' => [$sut, '🏴󠁧󠁢󠁥󠁮󠁧󠁿'],
            'Flags Emoji 11.0' => [$sut, '🏴‍☠️'],
            'Flags' => [$sut, '🇹🇳'],
            'Mixed with text' => [$sut, 'this is a pizza 🍕'],
            'Array' => [$sut, []],
            'Bool' => [$sut, true],
            'Object' => [$sut, new stdClass()],
        ];
    }
}
