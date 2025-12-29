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
#[CoversClass(Emoji::class)]
final class EmojiTest extends RuleTestCase
{
    /** @return iterable<array{Emoji, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new Emoji();

        return [
            'Numbers' => [$sut, '0123456789'],
            'Alpha' => [$sut, 'ABCDEFGHIKLMNOPQRSTVXYZabcdefghiklmnopqrstvxyz'],
            'Symbols' => [$sut, '&"\'(-_)@-*/+.'],
            'Unicode symbols' => [$sut, 'çàéè⁊ǷÞÐÆ'],
            'Arabic' => [$sut, 'ضصثقفغعهخحجشسيبلاتنمكطئءؤرلاىةوزظذ'],
            'Russian' => [$sut, 'русский'],
            'Japanese' => [$sut, 'ろぬふあうえおやゆよわ゛へちついすかんなにらせれせ゜たqとしはきくまのりもろむてさそひこみねるめ!'],
            'Mixed with text' => [$sut, 'this is a pizza 🍕'],
            'Array' => [$sut, []],
            'Bool' => [$sut, true],
            'Object' => [$sut, new stdClass()],
        ];
    }

    /** @return iterable<array{Emoji, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Emoji();

        return [
            // Basic categories
            'Smileys & People' => [$sut, '🤣'],
            'Animals & Nature' => [$sut, '🐵'],
            'Food & Drink' => [$sut, '🍎'],
            'Travel & Places' => [$sut, '⛰️'],
            'Activities' => [$sut, '🎈'],
            'Objects' => [$sut, '📢'],

            // Skin tone modifiers
            'Backhand Index Pointing Right with modifier' => [$sut, '👉🏿'],
            'Santa Claus with modifier' => [$sut, '🎅🏾'],
            'Man Frowning with modifier' => [$sut, '🙍🏻‍♂️'],
            'Woman with skin tone' => [$sut, '👩🏽'],

            // Symbols from various Unicode versions
            'Symbols from Unicode 4.0' => [$sut, '⚠️'],
            'Symbols from Unicode 6.0' => [$sut, '✅'],
            'Symbols from Unicode 7.0' => [$sut, '⏺️'],

            // Flags
            'Flags Emoji 1.0' => [$sut, '🇹🇳'],
            'Flags Emoji 4.0' => [$sut, '🏳️‍🌈'],
            'Flags Emoji 5.0' => [$sut, '🏴󠁧󠁢󠁥󠁮󠁧󠁿'],
            'Flags Emoji 11.0' => [$sut, '🏴‍☠️'],
            'Country flag USA' => [$sut, '🇺🇸'],
            'Country flag Japan' => [$sut, '🇯🇵'],
            'Scotland subdivision flag' => [$sut, '🏴󠁧󠁢󠁳󠁣󠁴󠁿'],
            'Wales subdivision flag' => [$sut, '🏴󠁧󠁢󠁷󠁬󠁳󠁿'],

            // Keycap sequences
            'Keycap digit one' => [$sut, '1️⃣'],
            'Keycap digit zero' => [$sut, '0️⃣'],
            'Keycap hash' => [$sut, '#️⃣'],
            'Keycap asterisk' => [$sut, '*️⃣'],

            // ZWJ sequences - families
            'Family man woman girl boy' => [$sut, '👨‍👩‍👧‍👦'],
            'Couple with heart' => [$sut, '👩‍❤️‍👨'],
            'Kiss' => [$sut, '👩‍❤️‍💋‍👨'],

            // ZWJ sequences - professions
            'Woman health worker' => [$sut, '👩‍⚕️'],
            'Man technologist' => [$sut, '👨‍💻'],
            'Woman firefighter' => [$sut, '👩‍🚒'],

            // Emoji 13.0 (2020)
            'Emoji 13.0 Smiling Face with Tear' => [$sut, '🥲'],
            'Emoji 13.0 Ninja' => [$sut, '🥷'],
            'Emoji 13.0 Anatomical Heart' => [$sut, '🫀'],
            'Emoji 13.0 Lungs' => [$sut, '🫁'],
            'Emoji 13.0 Pinched Fingers' => [$sut, '🤌'],
            'Emoji 13.0 Beaver' => [$sut, '🦫'],
            'Emoji 13.0 Polar Bear' => [$sut, '🐻‍❄️'],

            // Emoji 13.1 (2021)
            'Emoji 13.1 Heart on Fire' => [$sut, '❤️‍🔥'],
            'Emoji 13.1 Mending Heart' => [$sut, '❤️‍🩹'],
            'Emoji 13.1 Face Exhaling' => [$sut, '😮‍💨'],
            'Emoji 13.1 Face in Clouds' => [$sut, '😶‍🌫️'],
            'Emoji 13.1 Woman with Beard' => [$sut, '🧔‍♀️'],

            // Emoji 14.0 (2021)
            'Emoji 14.0 Melting Face' => [$sut, '🫠'],
            'Emoji 14.0 Saluting Face' => [$sut, '🫡'],
            'Emoji 14.0 Face with Open Eyes and Hand Over Mouth' => [$sut, '🫢'],
            'Emoji 14.0 Face with Peeking Eye' => [$sut, '🫣'],
            'Emoji 14.0 Dotted Line Face' => [$sut, '🫥'],
            'Emoji 14.0 Biting Lip' => [$sut, '🫦'],
            'Emoji 14.0 Coral' => [$sut, '🪸'],
            'Emoji 14.0 Lotus' => [$sut, '🪷'],

            // Emoji 15.0 (2022)
            'Emoji 15.0 Shaking Face' => [$sut, '🫨'],
            'Emoji 15.0 Pink Heart' => [$sut, '🩷'],
            'Emoji 15.0 Light Blue Heart' => [$sut, '🩵'],
            'Emoji 15.0 Grey Heart' => [$sut, '🩶'],
            'Emoji 15.0 Moose' => [$sut, '🫎'],
            'Emoji 15.0 Donkey' => [$sut, '🫏'],
            'Emoji 15.0 Wing' => [$sut, '🪽'],
            'Emoji 15.0 Goose' => [$sut, '🪿'],
            'Emoji 15.0 Jellyfish' => [$sut, '🪼'],
            'Emoji 15.0 Hyacinth' => [$sut, '🪻'],
            'Emoji 15.0 Pea Pod' => [$sut, '🫛'],
            'Emoji 15.0 Folding Hand Fan' => [$sut, '🪭'],
            'Emoji 15.0 Hair Pick' => [$sut, '🪮'],
            'Emoji 15.0 Maracas' => [$sut, '🪇'],
            'Emoji 15.0 Flute' => [$sut, '🪈'],
            'Emoji 15.0 Khanda' => [$sut, '🪯'],

            // Emoji 15.1 (2023)
            'Emoji 15.1 Head Shaking Horizontally' => [$sut, '🙂‍↔️'],
            'Emoji 15.1 Head Shaking Vertically' => [$sut, '🙂‍↕️'],
            'Emoji 15.1 Phoenix' => [$sut, '🐦‍🔥'],
            'Emoji 15.1 Lime' => [$sut, '🍋‍🟩'],
            'Emoji 15.1 Brown Mushroom' => [$sut, '🍄‍🟫'],

            // Emoji 16.0 (2024)
            'Emoji 16.0 Face with Bags Under Eyes' => [$sut, '🫟'],
            'Emoji 16.0 Fingerprint' => [$sut, '🪬'],
            'Emoji 16.0 Leafless Tree' => [$sut, '🪾'],
            'Emoji 16.0 Root Vegetable' => [$sut, '🫜'],
            'Emoji 16.0 Harp' => [$sut, '🪉'],
            'Emoji 16.0 Shovel' => [$sut, '🪏'],

            // Multiple emojis in sequence
            'Multiple basic emojis' => [$sut, '😀😃😄'],
            'Multiple flags' => [$sut, '🇺🇸🇬🇧🇯🇵'],
            'Multiple keycaps' => [$sut, '1️⃣2️⃣3️⃣'],
        ];
    }
}
