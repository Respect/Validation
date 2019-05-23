<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\NotEmoji
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
final class NotEmojiTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
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
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
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
